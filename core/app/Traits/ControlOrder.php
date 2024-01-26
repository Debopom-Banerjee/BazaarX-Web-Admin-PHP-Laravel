<?php 

namespace App\Traits;
use Exception;
use App\Models\Payment;
use App\Models\Order;
use App\Models\MailSmsTemplate;
use App\Models\UserInviter;
use App\Models\UserReward;
use App\Models\Service;
use App\Models\Code;
use App\Models\CaseWorkstream;
use App\Models\Transaction;
use App\User;
use Razorpay\Api\Api;
trait ControlOrder
{
    public function createOrder($request)
    {
        //get API Configuration
        $api = new Api(config('razorpay.api_key'), config('razorpay.api_secret'));

        //Fetch payment information by rzrpay_payment_id
        $payment = $api->payment->fetch($request->get('rzrpay_payment_id'));

        // Validating Payment
        if ($request->has('rzrpay_payment_id') && $request->get('rzrpay_payment_id') != null) {
            try {
                $api->payment->fetch($request->get('rzrpay_payment_id'))    // for resolving error we removed semicolon
                ->capture(array('amount' => $payment['amount']));
            } catch (\Exception $e) {
                return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
            }
        }

        $affiliate_id = $request->get('affiliate_id');
        $order_to = User::whereId(auth()->id())->first();

        // Checking Order Meta
        $order = Order::where('id', $request->get('order_id'))->with('service')->first();
        if(!$order){
            return response()->json(['message' => 'Order Not Found!'], 500);
        }

        $service_data = Service::whereId($order->type_id)->first();
        if(!$service_data){
            return response()->json(['message' => 'Service Not Found!'], 500);
        }

        // Marking Order as Paid
        $order->update([
            'payment_status' => Order::PAYMENT_STATUS_PAID,
        ]);
        
        // Refreshing Order Data
        $order = Order::where('id', $request->get('order_id'))->with('service')->first();

        //// Mail BLock
        //Send Mail for Admin (New Order)
        try {
            //code...
            $mailcontent_data = MailSmsTemplate::where('code','=',"admin-order-creation-mail")->first();
            if($mailcontent_data){
            $user = User::find($order->user_id);
            $arr=[
                    '{id}'=> $order->id,
                    '{name}'=>NameById( $user->id),
                    '{date}'=>$order->created_at,
                ];
            $action_button = null;
            $email = getSetting('admin_email') ?? 'satyamiit04@gmail.com';
            TemplateMail($email,$mailcontent_data,$user->email,$mailcontent_data->type, $arr, $mailcontent_data, $chk_data = null ,$mail_footer = null, $action_button);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }

        $orderStatus = orderStatus($order->status)['name'];
        
        //Send Mail to Customer (Order Places)
        try {
            $this->sms()
            ->to(auth()->user()->phone)
            ->template('1707166228952287158')
            ->setMessage("Dear " . auth()->user()->name . " " . auth()->user()->last_name . ",\nThanks for availing " . $order->service->title . " service. Service Status is " . $orderStatus . ". Click here http://dev.gofinx.com/app for next steps\nThanks You!\nTeam GoFinx.com")
            ->send();

            $mailcontent_data = MailSmsTemplate::where('code','=',"order-placed")->first();
            if($mailcontent_data){
            $user = User::find($order->user_id);
            $arr=[
                '{order_id}'=> $order->id,
                '{name}'=>NameById( $user->id),
                '{date}'=>$order->created_at,
            ];
            $action_button = null;
            TemplateMail($user->name,$mailcontent_data,$user->email,$mailcontent_data->type, $arr, $mailcontent_data, $chk_data = null ,$mail_footer = null, $action_button);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
        //// End Mail BLock

        // Creating Chat workstream for customer
        CaseWorkstream::create([
            'name' => $order->service->title,
            'description' => $order->service->title,
            'author_id' => auth()->id(),
            'case_id' => $order->id,
        ]);

        // Checking Referral Adjustments
        // This is checking if buyer does not has any referred by - It will assign inviter as his/her referral
        $inviter_chk = UserInviter::where('user_id', auth()->id())->first();
        if(!$inviter_chk){
            UserInviter::Create([
                'user_id' => auth()->id(),
                'inviter_id' => $affiliate_id
            ]);
            $inviter_chk = UserInviter::where('user_id', auth()->id())->first();
            
            //// Start Give Refer & Earn Reward to Inviter of Customer
            $discount_amount_value = 500;
            $code = Code::create([
                'code' => strtoupper(getUniqueCode()),
                'expires_at' => now()->addMonths(3),
                'type' => 1,
                'value' => $discount_amount_value,
                'max_uses' => 1,
            ]);

            // Sync User Rewards
            UserReward::create([
                'user_id'=> $inviter_chk->inviter_id,
                'type' => Code::class,
                'type_id' => $code->id,
                'status' => 1 
            ]);
            //// Stop Give Refer & Earn Reward to Inviter of Customer
        }
        
        // Benefits Distribution 
        // 1. Checking Referral Of Customer - 1% Commission
        if($inviter_chk){
            //// Start Create Wallet log record for give 1% commission
            $inviter_data = User::whereId($inviter_chk->inviter_id)->first();
            $inviter_amount = getInviterAmount($order->total);
            $after_balance = 0;
            pushWalletLog($inviter_chk->inviter_id,'credit',$inviter_amount,$after_balance,'User 1% commission credited on your wallet for #OID'.$order->id);

            Payment::create([
                'order_id'=> $order->id,
                'user_id'=> $inviter_chk->inviter_id,
                'r_payment_id'=> null,
                'status'=> Payment::STATUS_PENDING_GOFINX_APPROVAL,
                'type' => Payment::TYPES_ONE_PERCENT_COMMISSION,
                'month'=> now()->format('Y-m'),
                'amount'=> $inviter_amount,
                'remark'=> 'User 1% commission credited on your wallet for #OID'.$order->id,
            ]);
            
            // Send SMS/Mail to inviter regarding 1% commission
            try{
                $url = "http://dev.gofinx.com/app";
                $message = 'Dear ' . $inviter_data->name . ', "Greetings! Your have earned Rs ' . $inviter_amount . '. Click here ' . $url . ' to redeem"' . " \nTeam GoFinx.com";

                $this->sms()
                ->to($inviter_data->phone)
                ->template('1707167482064870593')
                ->setMessage($message)
                ->send();

                $mailcontent_data = MailSmsTemplate::where('code', '=', "Affiliate EarnXPayout")->first();
                if ($mailcontent_data) {
                    $arr = [
                        '{name}' => $inviter_data->name,
                        '{amount}' => $inviter_amount,
                        '{company}' => env('app_name'),
                    ];
                    $action_button = null;
                    TemplateMail($inviter_data->name, $mailcontent_data->code, $inviter_data->email, $mailcontent_data->type, $arr, $mailcontent_data, null, null, $action_button);
                }
            }catch(Exception $e){

            }
            //// End Create Wallet log record for give 1% commission 
        }
      
        
        //// 3. Preparing For Affiliate Direct Commission 
        if($affiliate_id != ''  && $affiliate_id != auth()->id()){
            $affiliation_type = $service_data->affiliation_type;
            
            if ($affiliation_type=='Percent'){
               $affiliation_amount = round((($service_data->price) * ($service_data->affiliation_value)) / 100);
            }else{
                 $affiliation_amount = $service_data->affiliation_value;
            }
            
            // Check Affiliate
            $user = User::where('id', $affiliate_id)->first();
            
            if (!$user) {
                // return $this->error('Order placed successfully!', 200);
                return response()->json(['message' => 'Order placed successfully!'], 200);
            }else{
                $user->wallet_balance = $user->wallet_balance+$affiliation_amount;

                $transaction = $user->save();
                if($transaction){
                    $txn = new Transaction;
                    $txn['user_id'] =  $user->id;
                    $txn['service_id'] = $service_data->id; 
                    $txn['txn_id'] = 'TXN-'.mt_rand(10000000, 99999999);
                    $txn_id= Transaction::where('txn_id', $txn['txn_id'])->first();
                    if($txn_id == $txn['txn_id']){
                        $txn['txn_id'] = 'TXN-'.mt_rand(10000000, 99999999);
                    }
                    $txn['amount'] = $affiliation_amount;
                    $txn['type'] = 'Earning';
                    $txn['affiliated_id'] = auth()->id();
                    $txn['razorpayPaymentId'] = '';
                    $txn['razorpayStatus'] = '';
                    $txn['remark'] = 'With reference to order #OD'.getPrefixZeros($order->id).', you have earned Rs '.$affiliation_amount.'.';
                    $txn->save();
                }
                
            }
        }
        //// End Preparing For Affiliate Direct Commission 

        info(auth()->user()->phone);
        return $this->successMessage('Order placed successfully!');
    }
}
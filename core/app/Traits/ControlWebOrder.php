<?php 

namespace App\Traits;
use Exception;
use App\Models\Payment;
use App\Models\Order;
use App\Models\MailSmsTemplate;
use App\Models\UserInviter;
use App\Models\AffiliateItem;
use App\Models\Service;
use App\User;
use Razorpay\Api\Api;
trait ControlWebOrder
{
    public function createWebOrder($request)
    {
        $input = $request->all();   

        //get API Configuration
        $api = new Api(env('API_RAZOR_KEY'),env('API_RAZOR_SECRET'));

        //Fetch payment information by rzrpay_payment_id
        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        // Validating Payment
        if(count($input)  && !empty($input['razorpay_payment_id'])) 
        {
            try 
            {
                $response = $api->payment->fetch($input['razorpay_payment_id'])
                ->capture(array('amount'=>$payment['amount'])); 

                $order = Order::whereId($response->notes['orderid'])->first();
                if(!$order){
                    return redirect()->route('guest-checkout.index',$response->notes['code'])->withError('We are experiencing technical difficulties processing this order. Please contact BazaarX with your questions.'); 
                }

                if($order->payment_status == Order::PAYMENT_STATUS_PAID){
                    return redirect()->route('guest-checkout.index',$response->notes['code'])->withError('Transaction deined, This orderID has been already paid. Please contact BazaarX incase you charged twiced.'); 
                }

                // Marking Order as Paid
                $order->update([
                    'status' => Order::STATUS_ABOUT_TO_START,
                    'payment_status' => Order::PAYMENT_STATUS_PAID,
                ]);

                $order = Order::whereId($response->notes['orderid'])->first();
                $service_data = Service::where('id',$order->type_id)->first();
                if(!$service_data){
                    return redirect()->route('guest-checkout.index',$response->notes['code'])->withError('We are experiencing technical difficulties processing this order for this service. Please contact BazaarX for refund or other queries.');
                }

                if($order->payment_status == Order::PAYMENT_STATUS_PAID){
                    //Send Mail to Admin on order place
                    try {
                        $mailcontent_data = MailSmsTemplate::where('code','=',"admin-order-creation-mail")->first();
                        if($mailcontent_data){
                        $user = User::find($order->user_id);
                        $arr=[
                                '{id}'=> $order->id,
                                '{name}'=>NameById( $user->id),
                                '{date}'=>$order->created_at,
                            ];
                        $action_button = null;
                        // $email = 'satyamiit04@gmail.com';
                        $email = getSetting('admin_email') ?? 'satyamiit04@gmail.com';
                        TemplateMail($email,$mailcontent_data,$user->email,$mailcontent_data->type, $arr, $mailcontent_data, $chk_data = null ,$mail_footer = null, $action_button);
                        }
                    } catch (\Throwable $th) {
                        //throw $th;
                    }

                    //Send mail to User for order place
                    try {
                        $mailcontent_data = MailSmsTemplate::where('code','=',"order-placed")->first();
                        if($mailcontent_data){
                        $user = User::find($order->user_id);
                        $arr=[
                                '{order_id}'=> $order->id,
                                '{name}'=>NameById( $user->id),
                                '{date}'=>$order->created_at,
                                '{service}'=>$service_data->title,
                            ];
                        $action_button = null;
                        TemplateMail($user->name,$mailcontent_data,$user->email,$mailcontent_data->type, $arr, $mailcontent_data, $chk_data = null ,$mail_footer = null, $action_button);
                        }
                    } catch (\Throwable $th) {
                        //throw $th;
                    }


                    // Chk existing wallet log amount to add amount 
                    if($order->referred_by != null){
                        $affiliate_data = User::whereId($order->referred_by)->first();
                        // Create or Update Wallet log record for give commission on service price
                        $affiliate_item = AffiliateItem::where('code',$response->notes['code'])->first();
                        if(!$affiliate_item && $response->notes['code']){
                            return redirect()->route('guest-checkout.index',$response->notes['code'])->withError('We are experiencing technical difficulties processing this order for this affilate code. Please contact BazaarX for refund or other queries.');
                        }

                        // Giving Commission 
                        $commission_amount = $order->commission;
                        $after_balance = 0;
                        pushWalletLog($order->referred_by,'credit',$commission_amount,$after_balance,'Commission credited on your wallet for shared services.');

                        Payment::create([
                            'order_id'=> $order->id,
                            'user_id'=> $order->referred_by,
                            'r_payment_id'=> null,
                            'status'=> Payment::STATUS_PENDING_GOFINX_APPROVAL,
                            'type' => Payment::TYPES_REFERRAL_COMMISSION,
                            'month'=> now()->format('Y-m'),
                            'amount'=> $commission_amount,
                            'remark'=> "Distributing Referral Commission",
                        ]);
                        try{
                            $url = 'http://dev.gofinx.com/app';
                            $message = 'Dear ' . $affiliate_data->name . ', "Greetings! Your have earned Rs ' . $commission_amount . '. Click here ' . $url . ' to redeem"' . " \nTeam GoFinx.com";
                            // Send SMS to affiliate for inviter commision
                            $this->sms()
                            ->to($affiliate_data->phone)
                            ->template('1707167482064870593')
                            ->setMessage($message)
                            ->send();
                        }catch(\Exception $e){
            
                        }

                        //Send mail for commission
                        $mailcontent_data = MailSmsTemplate::where('code', '=', "ReferredCommission")->first();
                        if ($mailcontent_data) {
                            $arr = [
                                '{name}' => $affiliate_data->name,
                                '{amount}' => $commission_amount,
                                '{link}' => "http://dev.gofinx.com/app",
                            ];
                            $action_button = null;
                            TemplateMail($affiliate_data->name, $mailcontent_data->code, $affiliate_data->email, $mailcontent_data->type, $arr, $mailcontent_data, null, null, $action_button);
                        }

                    }

                    // Create Wallet log record for give 1% commission
                    $inviter_data = null;
                    $inviter_chk = UserInviter::where('user_id',$order->user_id)->first();
                    if($inviter_chk){
                        $inviter_data = User::whereId($inviter_chk->inviter_id)->first();
                    }else{
                        if ($response->notes['code'] != null) {
                            // Check if user come by share Url
                            $affiliate_item = AffiliateItem::where('code',$response->notes['code'])->first();
                            $inviter_id = $affiliate_item->user_id;
                        }else{
                            // Check if Order has referred by
                            $inviter_id = $order->referred_by;
                        }
                        if (isset($inviter_id) && $inviter_id != null) {
                            $inviter_data = UserInviter::create([
                                'user_id' => $order->user_id,
                                'inviter_id' => $inviter_id
                            ]);
                        }
                    }
                    // for give 1% commission
                    if ($inviter_data != null) {
                        $inviter_amount = getInviterAmount($order->total);
                        $after_balance = 0;
                        pushWalletLog($inviter_chk->inviter_id,'credit',$inviter_amount,$after_balance,'User referral commission credited on your wallet');
                        Payment::create([
                            'order_id'=> $order->id,
                            'user_id'=> $inviter_chk->inviter_id,
                            'r_payment_id'=> null,
                            'status'=> Payment::STATUS_PENDING_GOFINX_APPROVAL,
                            'type' => Payment::TYPES_REWARD,
                            'month'=> now()->format('Y-m'),  
                            'amount'=> $inviter_amount,
                            'remark'=> "Distributing 1% Reward",
                        ]);


                        try{
                            $url = 'http://dev.gofinx.com/app';
                            $message = 'Dear ' . $inviter_data->name . ', "Greetings! Your have earned Rs ' . $inviter_amount . '. Click here ' . $url . ' to redeem"' . " \nTeam GoFinx.com";
                            // Send SMS/Mail to inviter fro 1% commission
                            $this->sms()
                            ->to($inviter_data->phone)
                            ->template('1707167482064870593')
                            ->setMessage($message)
                            ->send();

                            $mailcontent_data = MailSmsTemplate::where('code', '=', "AffiliationEarning")->first();
                            if ($mailcontent_data) {
                                $arr = [
                                    '{name}' => $inviter_data->name,
                                    '{amount}' => $inviter_amount,
                                    '{link}' => "http://dev.gofinx.com/app",
                                ];
                                $action_button = null;
                                TemplateMail($inviter_data->name, $mailcontent_data->code, $inviter_data->email, $mailcontent_data->type, $arr, $mailcontent_data, null, null, $action_button);
                            }
                        }catch(\Exception $e){
            
                        }

                    }
                }

                \Session::forget('discount_amount');
                \Session::forget('discount_code');

                auth()->loginUsingId($order->user_id);
                return redirect(route('thankyou'))->withSuccess("Your order has been successfully placed with reference #OID$order->id, our team will contact you for the next steps.");

            } 
            catch (\Exception $e) 
            {
                return  $e->getMessage();
            }            
        }
    }
}
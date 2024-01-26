<?php

namespace App\Http\Controllers;
use App\Models\Service;
use App\Models\WalletLog;
use App\Models\UserInviter;
use App\Models\Category;
use App\Models\Portfolio;
use App\User;
use App\Models\Payment;
use App\Models\Order;
use App\Models\Code;
use App\Models\AffiliateItem;
use App\Models\MailSmsTemplate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Traits\CanSendSMS;
use App\Traits\ControlWebOrder;

class GuestCheckoutController extends Controller
{
    use CanSendSMS,ControlWebOrder;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$code)
    {
        $affiliate_item = AffiliateItem::where('code',$code)->first();
        if(!$affiliate_item){
            return redirect()->route('login')->with('error','Sorry, this page does not exist');
        }
        $service = Service::where('id', $affiliate_item->service_id)->first();
        if(!$service){
            return redirect()->route('login')->with('error','Sorry, this service does not avilable anymore');
        }
        $cap = $affiliate_item->amount;
        $affiliate_id = $affiliate_item->user_id;
        return view('guest-checkout.index',compact('service', 'cap','affiliate_id','code'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function applyCoupon(Request $request)
    {
        try {
            if($request->promoCode != ''){
                $code =  $request->code;
                $affiliate_item = AffiliateItem::where('code',$request->code)->first();
                $service = Service::where('id', $affiliate_item->service_id)->first();
                $cap = $affiliate_item->amount;
                $affiliate_id = $affiliate_item->user_id;
                
                $promo_code = Code::where('code',$request->promoCode);
                $promoCodeCount = Order::where('promo_code',$request->promoCode)->count();
                $validCode =  $promo_code->where('expires_at','>=',now())->latest()->first();
                if(!$validCode || !$promo_code->first() || $promo_code->value('max_uses') <= $promoCodeCount){

                    \Session::forget('discount_amount');
                    \Session::forget('discount_code');

                    return response()->json([
                        'status' => 'error',
                        'message' => 'This code is not valid.'
                    ]);
                }
                if($request->amount){
                    $totalAmt = 0;
                    if($validCode->type == 0){
                        $discountAmt = $request->amount*$validCode->value/100;
                        if($request->amount > $discountAmt){
                            $totalAmt = $request->amount-$discountAmt;
                        }else{
                            $discountAmt =  $request->amount;
                        }
                    }else{
                        $discountAmt = $validCode->value;
                        if($request->amount > $discountAmt){
                            $totalAmt = $request->amount-$validCode->value;
                        }else{
                            $discountAmt =  $request->amount;
                        }
                    }
                }

                \Session::put('discount_amount', $discountAmt);
                \Session::put('discount_code', $request->promoCode);

                $html = view('guest-checkout.includes.order-list', compact('code','service','cap'))->render();

                return response()->json([
                    'status' => 'success',
                    'amount' => $totalAmt,
                    'html' => $html,
                    'message' => 'Promocode Applied Successfully!'
                ]);
            }
        } catch (\Throwable $th) {
            return back()->with('error','Somthing went wrong'.$th);
        }
    }
    public function removeCoupon(Request $request)
    {
        if($request->promoCode != ''){
            $code =  $request->code;
            $affiliate_item = AffiliateItem::where('code',$request->code)->first();
            $cap = $affiliate_item->amount;
            $service = Service::where('id', $affiliate_item->service_id)->first();
            $promo_code = Code::where('code',$request->promoCode);
            $promoCodeCount = Order::where('promo_code',$request->promoCode)->count();
            $validCode =  $promo_code->where('expires_at','>=',now())->latest()->first();
            if(!$validCode || !$promo_code->first() || $promo_code->value('max_uses') <= $promoCodeCount){
                return response()->json([
                    'status' => 'ERROR',
                    'message' => 'Not Valid!'
                ]);
            }
            $amt = $request->amount ?? 0;
            if($request->amount && $request->discount){
                $amt = (int)$request->amount;
            }
            \Session::forget('discount_amount');
            \Session::forget('discount_code');

            $html = view('guest-checkout.includes.order-list', compact('code','service','cap'))->render();

            return response()->json([
                'status' => 'SUCCESS',
                'html' => $html,
                'amount' => $cap,
                'message' => 'Promocode Removed Successfully!'
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            if($request->has('code')){
                $code =  $request->code;
                $affiliate_item = AffiliateItem::where('code',$request->code)->first();
                $cap = $affiliate_item->amount;
            }else{
                $code =  null;
                $cap = $request->amount;
            }
            $discount_amount = 0;
            $discount_coupon = null;
            if(\Session::has('discount_amount')){
                $discount_amount = \Session::get('discount_amount');
            }
            if(\Session::has('discount_code')){
                $discount_coupon = \Session::get('discount_code');
            }

            $service_data = Service::whereId($request->service_id)->first();
            $user = User::where('email',$request->email)->first();
            if(!$user){
                $user = User::create([
                    'name'     => $request->first_name,
                    'last_name'     => $request->last_name,
                    'email'    => $request->email,
                    'country'    => 101,
                    'state'    => $request->state_id,
                    'city'    => $request->city_id,
                    'pincode'    => $request->pincode,
                    'address'    => $request->address,
                    'status'    => 1,
                    'password' => Hash::make($request->email),
                ]);
                $user->syncRoles('User'); 
            }
            if ($service_data) {
                if ($service_data->permission['portfolio'] == 1) {
                    $portfolio_data = Portfolio::where('service_id', $service_data->id)->get();
                } else {
                    $portfolio_data = null;
                }
                
                $txn = generateUniqueTxn();
                $price = $cap;
                $sub_total = $cap;
                $total = $cap-$discount_amount;
                if($total > 0){
                    $total = $total;
                }else{
                    $total = 10;
                }

                // Address Processing
                $from = systemInvoiceAddress();
                $to = userInvoiceAddress($user->id);
                $permission = $service_data->permission;

                // Create Order
                $order = new Order;
                $order['user_id'] = $user->id;
                $order['referred_by'] = isset($affiliate_item) ? $affiliate_item->user_id : null;
                $order['type'] = "Service";
                $order['type_id'] = $service_data->id;
                $order['txn_no'] = $txn;
                $order['discount'] = $discount_amount;
                $order['tax'] = null;
                $order['sub_total'] = $sub_total;
                $order['promo_code'] = $discount_coupon;
                $order['total'] = $total;
                $order['price'] = $price;
                $order['status'] = Order::STATUS_ABOUT_TO_START;
                $order['payment_status'] = Order::PAYMENT_STATUS_UNPAID;
                $order['payment_gateway'] = 'RazorPay';
                $order['remarks'] = null;
                $order['from'] = json_encode($from);
                $order['to'] = json_encode($to);
                $order['service_data'] = $portfolio_data;
                $order['date'] = now()->format('Y-m-d');
                $order['permission'] = $permission;
                $order['source'] = "Web";
                $order['commission'] = $cap-($service_data->price-$service_data->affiliation_value);
                $order->save();

                return  view('guest-checkout.includes.checkpoint', compact('code','service_data','cap','user','order'));
            } else {
                return back()->with('error','Something Went Wrong !');
            }
        } catch (\Exception $e) {
            return $this->error('Something Went Wrong !');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function payment(Request $request){
        return  $data = $this->createWebOrder($request);
    }
            
    //     \Session::put('success', 'Payment successful, your order will be despatched in the next 48 hours.');
    //     return redirect()->route('panel.partner.leads.index');
    // }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
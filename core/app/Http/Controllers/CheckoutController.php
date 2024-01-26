<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Service;
use App\Models\Code;
use App\Models\Order;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$id)
    {
        $id = decrypt($id);
        $service = Service::where('id',$id)->first();
        return view('auth-checkout.index',compact('service'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function validateMerchant(Request $request)
    {
        // Perform merchant validation and return merchant session
        // Simulated response for illustration purposes
        $response = [
            'merchantSession' => 'your_simulated_merchant_session'
        ];
        return response()->json($response);
    }
    public function processPayment(Request $request)
    {
        // Process payment and return success response
        return response()->json(['status' => 'success']);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function razorPaySuccess(Request $request)
    {
        // return $request->all();
        $data = [
            'user_id' => auth()->id()??1,
            'order_id' => $request->order_id,
            'r_payment_id' => $request->payment_id,
            'amount' => $request->amount,
        ];

        $getId = Payment::create($data);  

        $arr = array('msg' => 'Payment successfully credited', 'status' => true);
        return redirect(route('checkout'))->with('success','Payment Successfully!');
        // return Response()->json($arr);  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function applyCoupon(Request $request)
    {
        try {
            if($request->promoCode != ''){
                $service = Service::where('id', $request->service_id)->first();
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
                    $totalAmt = 10;
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

                $html = view('auth-checkout.cart-list', compact('service'))->render();

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
            $promo_code = Code::where('code',$request->promoCode);
            $promoCodeCount = Order::where('promo_code',$request->promoCode)->count();
            $service = Service::where('id', $request->service_id)->first();
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

            $html = view('auth-checkout.cart-list', compact('service'))->render();

            return response()->json([
                'status' => 'SUCCESS',
                'html' => $html,
                'message' => 'Promocode Removed Successfully!'
            ]);
        }
    }

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

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Code;
use App\Models\Order;

class PromoCodeController extends Controller
{


    //promocode validate
    public function validation(Request $request)
    {
       if($request->validation!=null){
        $promoCode = Code::where('code',$request->validation)->whereDate('expires_at','>', now())->first();
         if($promoCode == null){
            return $this->error("Invalide Promocode!");
         }else{
            $max_use = Order::where('promo_code',$promoCode->code)->where('payment_status',2)->count();
            if($max_use > $promoCode->max_uses){
                return $this->error(" This Promocode Has Exceed There Limits !");
            }else{
                $order = Order::find($request->order_id);
                if($order){
                    if($promoCode->type == 0){
                        $discountamount = ($order->sub_total *$promoCode->value)/100;
                    }elseif($promoCode->type == 1){
                        $discountamount = $promoCode->value;
                    }
                    $order->promo_code = $request->validation;
                    $order->discount = $discountamount;
                    $order->save();
                    return $this->success($promoCode);
                }else{
                    return $this->error("Order not found!");
                }
            }
         }
       }else{
         return $this->error(" This Promocode Has Exceed There Limits !");
       }

    }


}

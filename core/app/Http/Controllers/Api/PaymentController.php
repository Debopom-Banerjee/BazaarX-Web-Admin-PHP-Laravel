<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class PaymentController extends Controller
{
    public function paymentStatus($id){
        try{
        $order_id = $id;
        if($order_id > 0){
               $order = Order::where('id',$order_id)->first();
               $order->update([
                 'payment_status'=>2,
               ]);

            /* notification start  admin*/
                // $data  = [
                //     'user_id' =>auth()->id(),
                //     'title' =>"New Order Placed",
                //     'notification' => $order->user->name." has placed an order.",
                //     'link' => route('panel.orders.show',$order->user->id)
                // ];
                // pushOnSiteNotification($data);
            /* notification end  admin*/


            /* mail start  admin*/
                    // $mail_data =MailSmsTemplate::where('code','New Order Placed')->first();
                    //     $arr = [
                    //         '{customer_name}' => $order->user->name,
                    //         '{service_name}' => "My Service",
                    //         '{sub_total}' => format_price($order->sub_total),
                    //         '{total}'=>format_price($order->total),
                    //         '{discount}'=>format_price($order->discount),
                    //         '{promocode}'=>$order->promo_code
                    //     ];
                    // customMail("Admin","admin@test.com",$mail_data,$arr);
            /* mail end admin*/


            /* mail start  user*/
                // $mail_data =MailSmsTemplate::where('code','Order Placed')->first();
                // $arr = [
                //         '{customer_name}' => $order->user->name,
                //         '{service_name}' => "My Service",
                //         '{sub_total}' => format_price($order->sub_total),
                //         '{total}'=>format_price($order->total),
                //         '{discount}'=>format_price($order->discount),
                //         '{promocode}'=>$order->promo_code
                //     ];
                // customMail(auth()->name(),"user@test.com",$mail_data,$arr);
           /* mail end user*/
            return $this->success('Payment status Is Paid');
                    
                 
        }



        }catch(\Exception $e){
            info($e->getMessage());
            return $this->error('ERROR: Something went wrong!');
        } catch(\Error $e){
            info($e->getMessage());
            return $this->error('ERROR: Something went wrong!');
        }
    }
}

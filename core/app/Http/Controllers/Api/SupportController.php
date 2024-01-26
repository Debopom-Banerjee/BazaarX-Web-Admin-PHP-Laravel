<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MailSmsTemplate;
use Illuminate\Http\Request;
use App\Models\SupportTicket;

class SupportController extends Controller
{


    //support show
    public function getSupport(Request $request)
    { 
        try {
            $page = $request->has('page') ? $request->get('page') : 1;
            $limit = $request->has('limit') ? $request->get('limit') : $this->resultLimit;

            $support = SupportTicket::query();
            if ($request->get('order_id')) {
                $support->where('order_id', $request->get('order_id'));
            }
            // $support->where('user_id',auth()->id());
            $support->where('user_id', auth()->id())->latest()->limit($limit)->offset(($page - 1) * $limit)->get();
            $support = $support->paginate();
            if ($support) {
                return $this->success($support);
            } else {
                return $this->error('Something Went Wrong!');
            }

        } catch (\Exception $e) {
            info($e->getMessage());
            return $this->error('Something went wrong!');
        } catch (\Error $e) {
            info($e->getMessage());
            return $this->error('Something went wrong!');
        }


    }


    public function postSupport(Request $request)
    {
         
        $request->validate([
            'message' => 'required',
            'subject' => 'required',
            'orderId' => 'sometimes'
        ]);

        try {
            $support = SupportTicket::create([
                'message' => $request->message,
                'subject' => $request->subject,
                'status' => 0,
                'order_id' => $request->orderId ?? null,
                'user_id' => auth()->id()
            ]);
          
            /* mail start  user*/
            $mail_data = MailSmsTemplate::where('code', 'support-ticket-created')->first();
            $arr = [
                '{ticket_id}' => $support->id,
            ];
//            customMail(auth()->name(), auth()->user()->email, $mail_data, $arr);
            customMail(auth()->user()->name, "shoabkhan33@gmail.com", $mail_data, $arr);


            return $this->successMessage('Created Successfully !');

            } catch (\Exception $e) {
                info($e->getMessage());
                return $this->error('Something went wrong!');
            } 
            


    }


}

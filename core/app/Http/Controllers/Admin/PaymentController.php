<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\User;
use App\Models\BankDetail;
use App\Traits\CanSendSMS;

class PaymentController extends Controller
{
    use CanSendSMS;
    public function approve(Request $request,Payment $payment){
        try{
                $payment->update([
                    'status' => 1,
                    'r_payment_id' => null
                ]);
                return back()->with('success', 'Payment Approved Successfully!');
        } catch(\Error $e){
            info($e->getMessage());
            return $this->error('ERROR: Something went wrong!');
        }
    }
    public function reject(Request $request){
        try{
            $payment = Payment::where('id',$request->id)->first(); 
            $payment->update([
                'status' => 3,
                'r_payment_id' => $request->reason
            ]);
            return back()->with('success','Payment has been rejected!');
        } catch(\Error $e){
            info($e->getMessage());
            return $this->error('ERROR: Something went wrong!');
        }
    }
    public function forcePay(Request $request,Payment $payment){  
        try{
            $user = User::where('id', $payment->user_id)->first();
            $bankDetail = BankDetail::where('user_id',$payment->user_id)->first();
            $amount = round($payment->amount);
            if(!$bankDetail){
                return back()->with('error',"No Bank Account found associated with the given user details. Please Update bank Account Details!");
            }

            // Payout
            $payoutInfo = [
                'account_number' => env('API_RAZOR_X_ACCOUNTNO'),
                'fund_account_id' => $bankDetail->fundAccountId,
                'amount' => $amount*100,
                'mode' => "NEFT",
                'purpose' => "payout",
                'queue_if_low_balance' => true,
                'currency' => "INR",
            ];
            
                $payout = getPayoutData($payoutInfo);
                
                if($payout == null){
                    return back()->with('error',"Payout API not working!");
                }
                
                if(isset($payout->error->description)){
                    return back()->with('error',"RAZORPAY ERROR: ".$payout->error->description);
                }
           
                
            // Update Payment
                $payment->update([
                    'r_payment_id' => $payout->id,
                    'payout_date' => now(),
                    'status' => 2, // paid 
                ]);

            // SMS
            $this->sms()
            ->to($user->phone)
            ->template('1707167506730819565')
            ->setMessage('Dear '. $user->name .'",Congratulations ! The payout for Rs '. $amount .' is initialized. Payout generally arrives in 24-48 hours once initialized. Regards, Team GoFinx')
            ->send();

            return back()->with('success','Payment has been paid successfully!');
        } catch(\Error $e){
            info($e->getMessage());
            return $this->error('ERROR: '.$e->getMessage());
        }
    }
        
}

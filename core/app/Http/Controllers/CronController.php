<?php 
/**
 *
 * @category zStarter
 *
 * @ref zCURD
 * @author  Defenzelite <hq@defenzelite.com>
 * @license https://www.defenzelite.com Defenzelite Private Limited
 * @version <zStarter: 1.1.0>
 * @link    https://www.defenzelite.com
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\BankDetail;
use App\Traits\CanSendSMS;
use App\Models\Payment;

class CronController extends Controller
{
    use CanSendSMS;
    public function payments()
    {
        $iterations = 0;
        $payed = 0;
        $failed_txn = '';
        // Set Approved Payment Records
        
        $users = Payment::where('status', 1)
       ->where('month','!=',null)
       ->where('month',now()->format('Y-m'))
       ->select('user_id')
       ->groupBy('user_id')
       ->get();

        foreach ($users as $key => $user_list) {
            ++$iterations;
            $payments = Payment::whereUserId($user_list->user_id)
            ->where('status', 1)
            ->where('month','!=',null)
            ->where('month',now()->format('Y-m'))->get();

            $amount = round($payments->sum('amount'));

            $user = User::where('id', $user_list->user_id)->first();
            $bankDetail = BankDetail::where('user_id',$user->id)->first();

            if(!$bankDetail){
                $failed_txn .= " #UID ".$user->id." ($user->name) Rupees $amount - Payout failed due to no bank account. ";
                continue;
                // return $this->error("No Bank Account found associated with the given user details. Please Update bank Account Details!");
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
                if(!isset($payout->id)){
                    $failed_txn .= " #UID".$user->id." ($user->name) Rupees $amount (Ac: $bankDetail->fundAccountId) - Payout failed - ".@$payout->error->description; 
                    continue;
                    // return $this->error("Payout API not working!");
                }else{
                    // Update Payment
                    foreach($payments as $payment){
                        $payment->update([
                            'r_payment_id' => $payout->id,
                            'payout_date' => now(),
                            'status' => 2, // paid 
                        ]);
                        ++$payed;
                    }
                    
                    // SMS
                    $this->sms()
                    ->to($user->phone)
                    ->template('1707167506730819565')
                    ->setMessage("Dear " . $user->name . " " . $user->last_name . ",\nCongratulations !\nThe payout for Rs " . $user->wallet_balance . " is initialized. Payout generally arrives in 24-48 hours once initiated.\n\nRegards,\nTeam GoFinx")
                    ->send();
                }
        }
        return $this->success("Looped $iterations, Paid $payed. Payout Initiated Successfully! | Payload = $failed_txn");

    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\BankDetails;
use App\Models\MailSmsTemplate;
use App\Traits\CanSendSMS;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Razorpay\Api\Api;
use App\User;
use DB;
use Auth;
use App\Mail;

class BalanceController extends Controller
{
        use CanSendSMS;
        
    public function index(Request $request)
    {
        try {
            
            $user = Auth::user();
            $user_id = $user->id;
            $userData = User::where('id','=',$user_id)->first();;
            $data['wallet'] = $userData->wallet_balance;
            $data['earning'] = Transaction::where('user_id','=',$user_id)->where('type','earning')->latest()->get();
            $data['withdrawl'] = Transaction::where('user_id','=',$user_id)->where('type','withdrawl')->latest()->get();
            
            return $this->success($data);
        } catch (\Exception $e) {
            info($e->getMessage());
            return $this->error('Something went wrong!');
        }
    }
    
    public function payout($id)
    {
        $user = User::whereId($id)->first();
        $BankDetails = BankDetails::where('user_id','=',$id)->first();
        $user_name = @$user->name.' '.@$user->last_name;
        
        if ($BankDetails){
            if ($user->wallet_balance >= env('MIN_PAYOUT_AMOUNT')){
                $payoutInfo = [
                    'account_number' => env('API_RAZOR_X_ACCOUNTNO'),
                    'fund_account_id' => $BankDetails->fundAccountId,
                    'amount' => $user->wallet_balance * 100,
                    'mode' => "NEFT",
                    'purpose' => "payout",
                    'queue_if_low_balance' => true,
                    'currency' => "INR",
                ];
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.razorpay.com/v1/payouts",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_USERPWD => env('API_RAZOR_X_KEY') . ":" . env('API_RAZOR_X_SECRET'),
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30000,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => json_encode($payoutInfo),
                    CURLOPT_HTTPHEADER => array(
                        "accept: */*",
                        "accept-language: en-US,en;q=0.8",
                        "content-type: application/json",
                    ),
                ));
                
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);
        
                if ($err) {
                   return $this->error("Something went wrong");
                } 
                
                $data = json_decode($response);
                
                if ($data){
                    $txn = new Transaction;
                    $txn['user_id'] = $id; 
                    $txn['txn_id'] = 'TXN-'.mt_rand(10000000, 99999999);
                    $txn_id= Transaction::where('txn_id', $txn['txn_id'])->first();
                    if($txn_id == $txn['txn_id']){
                        $txn['txn_id'] = 'TXN-'.mt_rand(10000000, 99999999);
                    }
                    $txn['amount'] = $user->wallet_balance;
                    $txn['type'] = 'Withdrawl';
                    $txn['affiliated_id'] = 0;
                    $txn['razorpayPaymentId'] = $data->id;
                    $txn['razorpayStatus'] = $data->status;
                    $txn['remark'] ='You have withdraw Rs '.$user->wallet_balance.'.';
                    $txn->save();
                    
                    // $mailcontent_data = MailSmsTemplate::where('code','=',"Payout")->first();
                    // if($mailcontent_data){
                    //     $arr=[
                    //         '{name}'=> $user->name . " " . $user->last_name,
                    //         '{amount}'=>$user->wallet_balance,
                    //         ];
                    //     $action_button = null;
                    //     TemplateMail($user->name,$mailcontent_data,$user->email,$mailcontent_data->type, $arr, $mailcontent_data ,$mail_footer = null, $action_button);
                    // }
                    
                    
                    $user->wallet_balance = 0;
                    $user->save();
                    
                   /* try{
                        $this->sms()
                        ->to($user->phone)
                        ->template('1707167506730819565')
                        ->setMessage("Dear " . $user->name . " " . $user->last_name . ",\nCongratulations !\nThe payout for Rs " . $user->wallet_balance . " is initialized. Payout generally arrives in 24-48 hours once initiated.\n\nRegards,\nTeam GoFinx")
                        ->send();
                    }catch(Exception $e){
                        
                    }*/
                    
                    return $this->success("Payout Initiated Successfully!");
                }else{
                    return $this->error("Something went wrong!");
                }
            }else{
                return $this->error("Min balance for payout is Rs100!");
            }
        }else{
            return $this->error("No Bank Account found associated with the given user details. Please Update bank Account Details!");
        }
    }
    
    public function bankDetail(Request $request)
    {
        $user = Auth::user();
        
        $validation = Validator::make($request->all(),
        [ 'name' => 'required','accountNumber' => array('required', 'regex:/^\d{9,18}$/'),
        //   'ifscCode' => array('required', 'regex:/^[A-Za-z]{4}\d{7}$/')
        'ifscCode' => array('required', 'regex:/^[A-Za-z]{4}0[A-Za-z\d]{6}$/')
        ],
        ['accountNumber.z' => 'The provided Account Number is Invalid!','ifscCode.regex' => 'The provided Ifsc Code is Invalid!']);
        
        if ($validation -> fails()){
               return $this->error($validation->errors()->first());
        }else{
            $user_id = $user->id;
            
            
            $contactInfo = [
                'name' => $request->name
            ];
            
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.razorpay.com/v1/contacts",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_USERPWD => env('API_RAZOR_X_KEY') . ":" . env('API_RAZOR_X_SECRET'),
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30000,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($contactInfo),
                CURLOPT_HTTPHEADER => array(
                    "accept: */*",
                    "accept-language: en-US,en;q=0.8",
                    "content-type: application/json",
                ),
            ));
            
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            if ($err) {
               return $this->error("Something went wrong");
            } 
            
            $contactInfoId = json_decode($response)->id; 
            
            $bankAccount = ["name"=>$request->name,"ifsc"=>$request->ifscCode,"account_number"=>$request->accountNumber];
            
            $fundAccountInfo = [
                "contact_id"=>$contactInfoId,
                "account_type"=>"bank_account",
                "bank_account"=> $bankAccount
            ];
            
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.razorpay.com/v1/fund_accounts",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_USERPWD => env('API_RAZOR_X_KEY') . ":" . env('API_RAZOR_X_SECRET'),
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30000,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($fundAccountInfo),
                CURLOPT_HTTPHEADER => array(
                    "accept: */*",
                    "accept-language: en-US,en;q=0.8",
                    "content-type: application/json",
                ),
            ));
            
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            
            if ($err) {
               return $this->error("Something went wrong");
            } 
            
            $fundAccountId = json_decode($response) -> id;
            
            $bankData = [
                'user_id' => $user_id,
                'ifscCode' => $request->ifscCode,
                'name' => $request->name,
                'accountNumber' => $request->accountNumber,
                'contactInfoId' => $contactInfoId,
                'fundAccountId' => $fundAccountId,
            ];
            
            $BankDetails = BankDetails::where('user_id','=',$user_id)->first();
                    
            if (!$BankDetails){
                $qb = BankDetails::insert($bankData);
            }else{
                $qb = BankDetails::where('user_id','=',$user_id)->update($bankData);
            }
            
            return $this->successMessage('Payment detail updated successfully!');
            
        }
    }
    
    public function getBankDetail(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;
        return $this->success(BankDetails::where('user_id','=',$user_id)->first());
    } 
}
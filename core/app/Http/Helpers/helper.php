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

use Twilio\Rest\Client;
// from shn

// for dynamic mail

//User File create
if(!function_exists('makeUserDirectory')){
    function makeUserDirectory($user_id){
        $folderName =  $user_id.'/';
        $path =   storage_path('app/public/files/'.$folderName);  
        if(!file_exists($path)){   
            File::makeDirectory($path, 0777, true, true);
        } 
        return true;
    }
}

//Service File create
if(!function_exists('makeUserServiceDirectory')){
    function makeUserServiceDirectory($user_id, $service_id, $prefix = 'S'){

        // Make Parent Level
        makeUserDirectory($user_id);

        $folderName =  $prefix.$service_id.'/';
        $path =   storage_path("app/public/files/$user_id/$folderName");  
        
        if(!file_exists($path)){     
            File::makeDirectory($path, 0777, true, true);
        } 
        return true;
    }
}

//Service File create
if(!function_exists('makeUserServiceOrderDirectory')){
    function makeUserServiceOrderDirectory($user_id, $service_id, $order_id, $prefix = 'O'){

        // Make Parent Level
        makeUserServiceDirectory($user_id, $service_id, 'S');

        $folderName =  $prefix.$order_id.'/';
        $path =   storage_path("app/public/files/$user_id/S$service_id/$folderName");  
        
        if(!file_exists($path)){     
            File::makeDirectory($path, 0777, true, true);
        } 
        return true;
    }
}



if (!function_exists('DynamicMailTemplateFormatter')) {
    function DynamicMailTemplateFormatter($body, $variable_names, $var_list)
    {
        // Make it Foreachable
        // return $variable_names;
        $variable_names = explode(', ', $variable_names);
        $i = 1;
        $data = "";
        foreach ($variable_names as $item) {
            if ($i == 1) {
                if(array_key_exists($item,$var_list)){
                    $data =  str_replace($item, $var_list[$item], $body);
                    $i += 1;
                }
            } else {
                if(array_key_exists($item,$var_list)){
                    $data =  str_replace($item, $var_list[$item], $data);
                }
            }
        }
        return $data;
    }
}
// get auth profile image

if (!function_exists('getAuthProfileImage')) {
    function getAuthProfileImage($path){
        $profile_img = asset('storage/backend/users/'.$path);
        if($profile_img != null){
            return $profile_img;
        }else{
            asset('backend/default/default-avatar.png');
        }
    }
}

if (!function_exists('getArticleImage')) {
    function getArticleImage($path){
        $profile_img = asset('storage/backend/article/'.$path);
        if($profile_img){
            return $profile_img;
        }else{
            asset('backend/default/default-avatar.png');
        }
    }
}

// custommail template with template table
if (!function_exists('asset')) {
    function asset($path,$secure=null){
        $timestamp = @filemtime(public_path($path)) ?: 0;
        return asset($path, $secure) . '?' . $timestamp;
    }
}

if (!function_exists('getSupportTicketStatus')) {
    function getSupportTicketStatus($id = -1)
        {
            if($id == -1){
                return [
                    ['id'=>0,'name'=>'Under Working','color'=>'secondary'],
                    ['id'=>1,'name'=>'Reply Received','color'=>'warning'],
                    ['id'=>2,'name'=>'Resolved','color'=>'success'],
                    ['id'=>3,'name'=>'Rejected','color'=>'danger'],
                    ['id'=>4,'name'=>'Close','color'=>'danger'],
                    ];
                }else{
                    foreach(getSupportTicketStatus() as $row){
                    if($row['id'] == $id){
                    return $row;
                    }
                }
            }
        }
}
if (!function_exists('getRequirementStatus')) {
    function getRequirementStatus($id = -1)
        {
            if($id == -1){
                return [
                    ['id'=>0,'name'=>'Hot','color'=>'danger'],
                    ['id'=>1,'name'=>'Cold','color'=>'primary'],
                    ['id'=>2,'name'=>'Warm','color'=>'success'],
                    ];
                }else{
                    foreach(getRequirementStatus() as $row){
                    if($row['id'] == $id){
                    return $row;
                    }
                }
            }
        }
}
if (!function_exists('getRequirementType')) {
    function getRequirementType($id = -1)
        {
            if($id == -1){
                return [
                    ['id'=>0,'name'=>'Public','color'=>'success','description'=>'public to everyone'],
                    ['id'=>1,'name'=>'Private','color'=>'info','description'=>'those have link'],
             
                    ];
                }else{
                    foreach(getRequirementType() as $row){
                    if($row['id'] == $id){
                    return $row;
                    }
                }
            }
        }
}
    if(!function_exists('getSupportTicketPrefix')){
        function getSupportTicketPrefix($id){
            return '#SUPTICK'.$id;
        }
    }
// custommail template with template table
if (!function_exists('customMail')) {
    function customMail($name,$to,$mailcontent_data,$arr,$cc = null ,$bcc = null ,$action_btn = null ,$attachment_path = null ,$attachment_name = null ,$attachment_mime = null){
        $to = $to;
        $data['name'] = $name;
        $name = $name;
        $chk_data = $mailcontent_data;
        $data['subject'] = DynamicMailTemplateFormatter($mailcontent_data->title, $mailcontent_data->variables, $arr);
        $data['subject'] = str_replace('{app_name}',getSetting('app_name'),$data['subject']);
        $subject = $mailcontent_data->title;
        $data['t_footer'] = str_replace('{app_name}',getSetting('app_name'),$mailcontent_data->footer);
        $t_data = DynamicMailTemplateFormatter($chk_data->body ,$chk_data->variables ,$arr);
        $t_data = str_replace('{app_name}',getSetting('app_name'),$t_data);
        $data['t_data'] = $t_data;
        $data['action_button'] = $action_btn;
        $data['attachment_path'] = $attachment_path;
        $data['attachment_name'] = $attachment_name;
        $data['cc'] = $cc == null ? [] : $cc;
        $data['bcc'] = $bcc == null ? [] : $cc;
        if($mailcontent_data->type == 1){
            try{
                $mail = \Mail::to($to);
                if($cc != null){
                     $mail->cc($cc, getSetting('mail_from_name'));
                 }
                 if($bcc != null){
                     $mail->bcc($bcc, getSetting('mail_from_name'));
                 }
                 
                 $mail->send(new App\Mail\CustomMail($data));
            }catch(Exception $e){
                return $e->getMessage();
            }
        }
        if($mailcontent_data->type == 2){
            // sms
            manualSms($to,$t_data);
        }
        if($mailcontent_data->type == 3){
            // whatsapp
        }
    }
}
if(!function_exists('getEnquiryStatus')){
    function getEnquiryStatus($id = -1){
        if($id == -1){
        return [
            ['id'=>0,'name'=>"New" ,'color' =>"primary"],
            ['id'=>1,'name'=>"Completed",'color' =>"success"],
            ['id'=>2,'name'=>"Cancelled",'color' =>"danger"],
            ['id'=>3,'name'=>"Hold",'color' =>"warning"],

        ];
        }else{
            foreach(getEnquiryStatus() as $row){
                if($id == $row['id']){
                return $row;
            }
        }
        return ['id'=>0,'name'=>'','color'=>''];
        }
    }
}
if(!function_exists('getPayoutStatus')){
    function getPayoutStatus($id = -1){
        if($id == -1){
        return [
            ['id'=>1,'name'=>"Unpaid" ,'color' =>"danger"],
            ['id'=>2,'name'=>"Paid",'color' =>"success"],
            ['id'=>3,'name'=>"Refund Processing",'color' =>"warning"],
            ['id'=>4,'name'=>"Hold",'color' =>"info"],

        ];
        }else{
            foreach(getPayoutStatus() as $row){
                if($id == $row['id']){
                return $row;
            }
        }
        return ['id'=>0,'name'=>'','color'=>''];
        }
    }
}
if(!function_exists('getPaymentStatus')){
    function getPaymentStatus($id = -1){
        if($id == -1){
        return [
            ['id'=>0,'name'=>"Pending BazaarX Approval" ,'color' =>"warning"],
            ['id'=>1,'name'=>"Approved By GoFinx, Payment Scheduled" ,'color' =>"info"],
            ['id'=>2,'name'=>"Payment Transferred",'color' =>"success"],
            ['id'=>3,'name'=>"Payment Cancelled",'color' =>"danger"],

        ];
        }else{
            foreach(getPaymentStatus() as $row){
                if($id == $row['id']){
                return $row;
            }
        }
        return ['id'=>0,'name'=>'','color'=>''];
        }
    }
}
if(!function_exists('getTransactionType')){
    function getTransactionType($id = -1){
        if($id == -1){
        return [
            ['id'=>0,'name'=>"Credit" ,'color' =>"danger"],
            ['id'=>1,'name'=>"Debit",'color' =>"success"],

        ];
        }else{
            foreach(getTransactionType() as $row){
                if($id == $row['id']){
                return $row;
            }
        }
        return ['id'=>0,'name'=>'','color'=>''];
        }
    }
}
if (!function_exists('pushWalletLog')) {
    function pushWalletLog($user_id,$type,$amount,$after_balance,$remark)
    {
        $wallet_record = App\Models\WalletLog::create([
            'user_id'=>$user_id,
            'type'=>$type,
            'amount'=>$amount,
            'after_balance'=>$after_balance,
            'remark'=>$remark,
        ]);

    }
}

// custommail template with template table
if (!function_exists('TemplateMail')) {
    function TemplateMail($name, $code, $to, $mail_type, $arr, $mailcontent_data, $mail_footer = null, $action_button = null)
    {
        
        $to = $to;
        $data['name'] = $name;
        $name = $name;
        $data['subject'] = DynamicMailTemplateFormatter($mailcontent_data->title, $mailcontent_data->variables, $arr);
        $subject = $mailcontent_data->title;
        $data['type_id'] = $mail_type;
        $type_id = $mail_type;
        $chk_data = $mailcontent_data;
        $data['t_footer'] = $mail_footer;

        $t_data =  DynamicMailTemplateFormatter($chk_data->body, $chk_data->variables, $arr);
        $data['t_data'] = $t_data;
        $data['action_button'] = $action_button;

        // Mail Sender
        \Mail::send('emails.dynamic-custom', $data, function ($message) use ($to, $name, $subject) {
            $message->to($to, $name)->subject($subject);
            $message->from(getSetting('mail_from_address'), getSetting('app_name'));
        });

        // EmailLog Capture
        // App\EmailLog::create([
        //     'subject' => $data['subject'],
        //     'email' => $to,
        //     'user_id' => auth()->id() ?? null,
        //     'sent_by' => 37,
        //     'type' => 'automatic',
        //     'datetime' => now(),
        // ]);
        return true;
    }
}

// manual Email without template table
if (!function_exists('StaticMail')) {
    function StaticMail($name, $to, $subject, $body, $mail_footer = null, $action_button = null, $cc = null, $bcc = null,$attachment_path = null ,$attachment_name = null ,$attachment_mime = null)
    {
        if($cc == null){
            $cc = '';
        }
        if($bcc == null){
            $bcc = '';
        }
        $data['name'] = $name;
        $data['subject'] = $subject;
        $data['t_footer'] = $mail_footer;
        $data['t_data'] = $body;
        $data['action_button'] = $action_button;

        // Mail Sender
        try{
            \Mail::send('emails.dynamic-custom', $data, function ($body) use ($to, $name,$cc, $bcc, $subject,$attachment_path,$attachment_name,$attachment_mime) {
                $body->to($to, $name)->subject($subject);
                if($cc != null){
                    $body->cc($cc,getSetting('mail_from_name'));
                }
                if($bcc != null){
                    $body->bcc($bcc, getSetting('mail_from_name'));
                }
                if($attachment_path != null)
                {
                    $body->attach($attachment_path, [
                            'as'    => $attachment_name,
                            'mime'  => $attachment_mime,
                        ]);
                }
                $body->from(getSetting('mail_from_address'), getSetting('mail_from_name'));
            });
            return "done";
        }catch(Exception $e){
            return $e->getMessage();
        }
    }
}
// Send Sms By Api
if (!function_exists('sendSms')) {
    function sendSms($number,$msg,$template_id){

        // $number must be comma separated values
        // $msg must be normal text
        $response = Http::withHeaders([
            'authkey' => '366553Aka2FC7OmM612e3ed7P1',
            'accept' => 'application/json'
        ])->get('http://otpsms.vision360solutions.in/api/sendhttp.php', [
            'mobiles' => $number,
            'message' => $msg,
            'sender' => "DEZLTE",
            'route' => 4,
            'country' => 91,
            'response' => "json",
            'DLT_TE_ID' => $template_id,
        ]);
        if($response){
            return $response;
        }else{
            return false;
        }
    }
}

// manual SMS By Twilio Account
if (!function_exists('manualSms')) {
    function manualSms($number,$msg)
    {
        $accountSid = getSetting('twilio_account_sid');
        $authToken  = getSetting('twilio_auth_token');
        $accountnumber  = getSetting('twilio_account_number');
        $client = new Client($accountSid, $authToken);
        $client->messages->create('+91'.$number,
            array(
                'from' => $accountnumber,
                'body' => $msg
            )
        );
    }
}


// old data recover
if (!function_exists('selectSelecter')) {
    function selectSelecter($old_val, $updated_val, $compare_val)
    {
        if ($old_val != null) {
            $result = $old_val == $compare_val ? "selected" : '';
        } elseif ($updated_val != null) {
            $result = $updated_val == $compare_val ? "selected" : '';
        } else {
            $result = '';
        }
        return $result;
    }
}

// from DFV

// currency amount cleaner 
if (!function_exists('currencyAmountCleaner')) {
    function currencyAmountCleaner($val)
    {
        $x = substr($val, 1);
        return str_replace(',', '', $x);
    }
}

if (!function_exists('getOrderHashCode')) {
    function getOrderHashCode($order_id)
    {
        return '#OID'.$order_id;
    }
}
if (!function_exists('getTicketHashCode')) {
    function getTicketHashCode($ticket_id)
    {
        return '#SUPTIC'.$ticket_id;
    }
}
if (!function_exists('getLeadHashCode')) {
    function getLeadHashCode($lead_id)
    {
        return '#LID'.$lead_id;
    }
}


// from albuhaira
// Age Calculator
function ageCalculator($dob)
{
    if (!empty($dob)) {
        $birthdate = new DateTime($dob);
        $today   = new DateTime('today');
        $age = $birthdate->diff($today)->y;
        return $age;
    } else {
        return 0;
    }
}
// get Browser
function getBrowser()
{
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    } elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }
   
    // Next get the name of the useragent yes seperately and for good reason
    if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
        $bname = 'Internet Explorer';
        $ub = "MSIE";
    } elseif (preg_match('/Firefox/i', $u_agent)) {
        $bname = 'Mozilla Firefox';
        $ub = "Firefox";
    } elseif (preg_match('/Chrome/i', $u_agent)) {
        $bname = 'Google Chrome';
        $ub = "Chrome";
    } elseif (preg_match('/Safari/i', $u_agent)) {
        $bname = 'Apple Safari';
        $ub = "Safari";
    } elseif (preg_match('/Opera/i', $u_agent)) {
        $bname = 'Opera';
        $ub = "Opera";
    } elseif (preg_match('/Netscape/i', $u_agent)) {
        $bname = 'Netscape';
        $ub = "Netscape";
    }
   
    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }
   
    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
            $version= $matches['version'][0];
        } else {
            $version= $matches['version'][1];
        }
    } else {
        $version= $matches['version'][0];
    }
   
    // check if we have a number
    if ($version==null || $version=="") {
        $version="?";
    }
   
    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'    => $pattern
    );
}




// get Image
if(!function_exists('getImage')){
    function getImage($path = null,$name = null, $type = 'placeholder'){
        if($name != null){
          return  '<img src="'.$path.'">';
        }else{
            if($type == 'placeholder'){
              return  '<img src={{'.asset("frontend/images/placeholder.png").'}}>';
            }
        }
    }
}
if(!function_exists('uploaded_asset')){
    function uploaded_asset($path = null,$name = null, $type = 'placeholder'){
        if($name != null){
          return  '<img src="'.$path.'">';
        }else{
            if($type == 'placeholder'){
              return  '<img src={{'.asset("frontend/images/placeholder.png").'}}>';
            }
        }
    }
}

// check and create dir
if(!function_exists('checkAndCreateDir')){
    function checkAndCreateDir($path){
        // Create directory if not exist
        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }
    }
}

if(!function_exists('systemInvoiceAddress')){
    function systemInvoiceAddress(){
      return [
        'name'=>"Gofinx",
        'address_line_1'=>"H No 303, Tower 16,Chd Avenue Sec",
        'address_line_2'=>"71, Gurgaon, Haryana (122018)",
        'email'=>"info@gofinx.com",
        'phone'=>"+917892144176",
        'gst'=>"06ANXPA1674N3ZE",
      ];
    }
}
if(!function_exists('userInvoiceAddress')){
    function userInvoiceAddress($user_id){
        $user = \App\User::whereId($user_id)->first();
        if($user){
            return [
              'name'=>$user->name.' '.$user->last_name,
              'address_line_1'=>$user->address,
              'address_line_2'=> fetchFirst('App\Models\City',$user->city,'name').', '.fetchFirst('App\Models\State',$user->state,'name').', '.fetchFirst('App\Models\Country',$user->country,'name').' '.$user->pincode,
              'email'=>$user->email,
              'phone'=>$user->phone,
              'gst'=>'null',
            ];
        }else{
            return [
                'name'=>null,
                'address_line_1'=>null,
                'address_line_2'=>null,
                'email'=>null,
                'phone'=>null,
                'gst'=>null,
              ];
        }
    }
}

// Convert 1000 into 1k
function thousandsCurrencyFormat($number = null) {

    $suffixByNumber = function () use ($number) {
        if ($number < 1000) {
            return sprintf('%d', $number);
        }

        if ($number < 1000000) {
            return sprintf('%d%s', floor($number / 1000), 'K+');
        }

        if ($number >= 1000000 && $number < 1000000000) {
            return sprintf('%d%s', floor($number / 1000000), 'M+');
        }

        if ($number >= 1000000000 && $number < 1000000000000) {
            return sprintf('%d%s', floor($number / 1000000000), 'B+');
        }

        return sprintf('%d%s', floor($number / 1000000000000), 'T+');
    };

    return $suffixByNumber();
}
function generate_uuid() {
    return sprintf( '%04x%04x-%04x',
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
        mt_rand( 0, 0xffff ),
    );

}
if(!function_exists('getDocumentType')){
    function getDocumentType($id = -1){
        if($id == -1){
        return [
            ['id'=>1,'name'=>"PAN Card" ],
            ['id'=>2,'name'=>"Aadhaar Card"],

        ];
        }else{
            foreach(getDocumentType() as $row){
                if($id == $row['id']){
                return $row;
            }
        }
        return ['id'=>0,'name'=>''];
        }
    }
}
if (!function_exists('UserRole')) {
    function UserRole($id)
    {
        return App\User::find($id)->roles[0]->name ?? '';
    }
}
if (!function_exists('getContactInfoData')) {
    function getContactInfoData($contactInfo)
    {
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
                CURLOPT_POSTFIELDS => $contactInfo,
                CURLOPT_HTTPHEADER => array(
                    "accept: */*",
                    "accept-language: en-US,en;q=0.8",
                    "content-type: application/json",
                ),
            ));
            
            $response = curl_exec($curl);
            
          return json_decode($response); 
    }
}
if (!function_exists('getFundInfoData')) {
    function getFundInfoData($fundInfo)
    {
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
                CURLOPT_POSTFIELDS => $fundInfo,
                CURLOPT_HTTPHEADER => array(
                    "accept: */*",
                    "accept-language: en-US,en;q=0.8",
                    "content-type: application/json",
                ),
            ));
            
            $response = curl_exec($curl);
            
          return  json_decode($response); 
    }
}
if (!function_exists('getPayoutData')) {
    function getPayoutData($payoutInfo)
    {
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
        return  json_decode($response); 
    }
}

if (!function_exists('getOS')) {
    function getOS() {
        $ua = strtolower($_SERVER['HTTP_USER_AGENT']);
        if(stripos($ua,'android') !== false) { // && stripos($ua,'mobile') !== false) {
            return "android";
        }
        return 'not android';
    }
}
if (!function_exists('getTotalEarningsByPartnerId')) {
    function getTotalEarningsByPartnerId($partner_id) {
        $orderIds = App\Models\Order::where('partner_id',$partner_id)->pluck('id');
        if($orderIds){
             $payment = App\Models\Payment::whereIn('order_id',$orderIds)->where('status',App\Models\Payment::STATUS_PAYMENT_TRANSFERRED)->sum('amount');
        }else{
            $payment = 0;
        }
        return $payment;
    }
}
if (!function_exists('getInviterAmount')) {
    function getInviterAmount($total_amount)
    {
        $percentage = getSetting('inviter_percent');
        $amount = $total_amount;
        $result = ($amount * $percentage) / 100;
        // $result = ($amount * $percentage) / (100 + $percentage);
        return $result;
    }
}
if (!function_exists('getCategoriesByCode')) {
    function getCategoriesByCode($code)
    {
        $chk = App\Models\CategoryType::whereCode($code)->first();
        if($chk){
            // Role Checking
            // Admin
            if(auth()->check()){
                if(AuthRole() == "Admin"){
                    return App\Models\Category::select('id','name','category_type_id','parent_id','icon')->whereCategoryTypeId($chk->id)->whereLevel(1)->latest()->get();
                }
            }else{
                return App\Models\Category::select('id','name','category_type_id','parent_id','icon')->whereCategoryTypeId($chk->id)->latest()->get();
            }
        }
        return [];
    }
}

if (!function_exists('stringMasker')) {
    function stringMasker($string, $startChars, $endChars, $maskChar = 'x') 
    {
        if ($startChars + $endChars > strlen($string)) {
            return str_repeat($maskChar, strlen($string));
          }
          
          $unmaskedStart = substr($string, 0, $startChars);
          $unmaskedEnd = substr($string, -$endChars);
          $maskedMiddle = str_repeat($maskChar, strlen($string) - $startChars - $endChars);
          
          return $unmaskedStart . $maskedMiddle . $unmaskedEnd;
    }
}
if (!function_exists('getLeadUniqueCode')) {
    function getLeadUniqueCode($length = 8) 
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = '';
        for ($i = 0; $i < $length; $i++) {
            $randomIndex = rand(0, strlen($characters) - 1);
            $code .= $characters[$randomIndex];
        }
        $exist_code = App\Models\Requirement::where('code', $code)->first();
        if ($exist_code) {
            $code = getUniqueCode();
        }
        return $code;
    }
}
if (!function_exists('getUniqueCode')) {
    function getUniqueCode($length = 8) 
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = '';
        for ($i = 0; $i < $length; $i++) {
            $randomIndex = rand(0, strlen($characters) - 1);
            $code .= $characters[$randomIndex];
        }
        $exist_code = App\Models\AffiliateItem::where('code', $code)->first();
        if ($exist_code) {
            $code = getUniqueCode();
        }
        return $code;
    }
}
if (!function_exists('getLeadAmount')) {
    function getLeadAmount($lead)
    {
        $leadOrderCount = App\Models\Order::where('type','Lead')->where('type_id',$lead->id)->count();
        $price = $lead->price;
        if($leadOrderCount != 0){
            if ($leadOrderCount == 1) {
                $result = ($price / 100) * 80;
            }elseif($leadOrderCount == 2){
                $result = ($price / 100) * 60;
            }else{
                $result = ($price / 100) * 40;
            }
            return round($result,2);
        }else{
            return round($price,2);
        }
    }
}


function slugify($text, string $divider = '-')
{
  // replace non letter or digits by divider
  $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);

  // trim
  $text = trim($text, $divider);

  // remove duplicate divider
  $text = preg_replace('~-+~', $divider, $text);

  // lowercase
  $text = strtolower($text);

  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}
if(!function_exists('getSlidersByCode')){
    function getSlidersByCode($code){
        $slider = App\Models\SliderType::where('title', $code)->first();
        if($slider){ 
            return App\Models\Slider::where('slider_type_id', $slider->id)->get();
        }
         return [];
    }
}
if(!function_exists('callMasking')){
    function callMasking($form_number,$mobile_number){
        $curl = curl_init();
        curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://panelv2.cloudshope.com/api/outbond_call?from_number='.$form_number.'&mobile_number='.$mobile_number,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer 297646|O4gGfqAhGjL1Og1AcH0jLtkDhjYNv7fOJ9hOMkD5'
            ),
        ));
        $response = curl_exec($curl); 
        $data =  json_decode($response);

        return $data->data;
    }
}

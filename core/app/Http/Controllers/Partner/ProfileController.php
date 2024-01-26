<?php

namespace App\Http\Controllers\Partner;

use App\User;
use App\Models\UserKyc;
use App\Models\MailSmsTemplate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function submitDoc(Request $request)
    { 
      try {
            $eKyc = UserKyc::where('user_id',auth()->id())->first();
            if($eKyc){
                 $eKyc_details = json_decode($eKyc->details);
            }
            if($request->hasFile("document_front")){
                $front_image = $request->file('document_front');
                $path = storage_path() . '/app/public/backend/user/docs';
                $front_image_name = 'doc_' .rand(000, 999).'.' . $front_image->getClientOriginalExtension();
                $front_image->move($path, $front_image_name);
                $document_front = $front_image_name;
            } else if(isset($eKyc_details)){
                $document_front = $eKyc_details->document_front;
            }else{
                $document_front = null;
            }   
            
            if($request->hasFile("document_back")){
                $back_image = $request->file('document_back');
                $path = storage_path() . '/app/public/backend/user/docs';
                $back_image_name = 'doc_' .rand(000, 999).'.' . $back_image->getClientOriginalExtension();
                $back_image->move($path, $back_image_name);
                $document_back = $back_image_name;
            } else if(isset($eKyc_details)){
                $document_back = $eKyc_details->document_back;
            }else{
                $document_back = null;
            } 
            $details = [
                'document_type' => $request->document_type,
                'document_number' => $request->document_number,
                'document_front' => $document_front,
                'document_back' => $document_back,
            ];
                    
            if(!$eKyc){
                UserKyc::create([
                    'user_id' => auth()->id(),
                    'details' => json_encode($details),
                    'status' => 0,
                ]);
            }else{
                $eKyc->update([
                    'user_id' => auth()->id(),
                    'details' => json_encode($details),
                    'status' => 0,
                ]);
            }
            $mailcontent_data = MailSmsTemplate::where('code','=',"KYC-document-submit")->first();
                if($mailcontent_data){
                $arr=[
                    '{name}'=>NameById(auth()->id()),
                    ];
                $action_button = null;
                TemplateMail(auth()->user()->name,$mailcontent_data,getSetting('frontend_footer_email'),$mailcontent_data->type, $arr, $mailcontent_data, $chk_data = null ,$mail_footer = null, $action_button);
                }
            return back()->with('success','Documents added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }
}

<?php

namespace App\Http\Controllers\Partner;

use App\Models\BankDetail;
use App\Models\Payment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
            $length = 10;
            if(request()->get('length')){
                $length = $request->get('length');
            }
            $bankDetails = BankDetail::query();
            if($request->get('search')){
                $users->where('ifscCode','like','%'.$request->get('search').'%')
                    ->orWhere('accountNumber','like','%'.$request->get('search').'%')
                    ->orWhere('name','like','%'.$request->get('search').'%');
            }
           if($request->get('from') && $request->get('to')) {
               $bankDetails->whereBetween('created_at', [\Carbon\carbon::parse($request->from)->format('Y-m-d'),\Carbon\Carbon::parse($request->to)->format('Y-m-d')]);
           }
            $bankDetails = $bankDetails->where('user_id',auth()->id())->paginate($length);
           if ($request->ajax()) {
               return view('backend.partner.account.load', ['bankDetails' => $bankDetails])->render();  
           }

           
     //  $service = 
       return view('backend.partner.account.index', compact('bankDetails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.partner.account.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            // Call Contact API
            $contactInfo = [
                'name' => $request->name
            ];
            $contactData = getContactInfoData(json_encode($contactInfo));
            if($contactData == null){
                return $this->error("API response given null");
            }

            // Call Fund Account API
            $bankAccount = ["name"=>$request->name,"ifsc"=>$request->ifscCode,"account_number"=>$request->accountNumber];

            $fundInfo = [
                "contact_id"=>$contactData->id,
                "account_type"=>"bank_account",
                "bank_account"=> $bankAccount
            ];

            $fundData = getFundInfoData(json_encode($fundInfo));
            if($fundData == null){
                return $this->error("API response given null");
            }
            if(isset($fundData->error)){
                return back()->with('error',$fundData->error->description);
            }

            BankDetail::create([
                'user_id' => $request->user_id,
                'name' => $request->name,
                'ifscCode' => $request->ifscCode,
                'accountNumber' => $request->accountNumber,
                'fundAccountId' => $fundData->id,
                'contactInfoId' => $contactData->id,
            ]);
             return redirect()->route('panel.partner.account.index')->with('success','Account Added Successfully');
        }catch(Exception $e){
            return back()->with('error', 'There was an error: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BankDetail  $bankDetail
     * @return \Illuminate\Http\Response
     */
    public function show(BankDetail $bankDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BankDetail  $bankDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(BankDetail $bankDetail)
    {
        return view('backend.partner.account.edit', compact('bankDetail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BankDetail  $bankDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BankDetail $bankDetail)
    {
        // return $bankDetail;
        try{
            $bankDetail->update([
                'user_id' => $request->user_id,
                'name' => $request->name,
                'ifscCode' => $request->ifscCode,
                'accountNumber' => $request->accountNumber,
                'fundAccountId' => $bankDetail->fundAccountId,
                'contactInfoId' => $bankDetail->contactInfoId,
            ]);
            return redirect()->route('panel.partner.account.index')->with('success','Account Updated Successfully');
        }catch(Exception $e){
            return back()->with('error', 'There was an error: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BankDetail  $bankDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankDetail $bankDetail)
    {
        try{
            if($bankDetail){
                $bankDetail->delete();
                return back()->with('success','Account Deleted Successfully');
            }
            return back()->with('error','Record not found');
        }catch(Exception $e){
            return back()->with('error', 'There was an error: ' . $e->getMessage());
        }
    }
    public function statement(Request $request)
    {
        $length = 10;
        if(request()->get('length')){
            $length = $request->get('length');
        }
        $payments = Payment::query();
        if($request->get('search')){
            $users->where('ifscCode','like','%'.$request->get('search').'%')
                ->orWhere('accountNumber','like','%'.$request->get('search').'%')
                ->orWhere('name','like','%'.$request->get('search').'%');
        }
        if($request->get('from') && $request->get('to')) {
            $payments->whereBetween('created_at', [\Carbon\carbon::parse($request->from)->format('Y-m-d'),\Carbon\Carbon::parse($request->to)->format('Y-m-d')]);
        }
        if(request()->has('status') && request()->get('status') != null){
            $payments = $payments->where('status',request()->get('status'));
        }
        if(request()->has('partner_id') && request()->get('partner_id') != null){
            $payments = $payments->where('user_id',request()->get('partner_id'));
        }
        if(AuthRole() == 'Admin'){
            $payments = $payments->latest()->paginate($length);
        }else{
            $payments = $payments->where('user_id',auth()->id())->latest()->paginate($length);
        }
        if ($request->ajax()) {
            return view('backend.partner.account.statement-load', ['payments' => $payments])->render();  
        }

        return view('backend.partner.account.statement', compact('payments'));
    }
}

<?php


namespace App\Http\Controllers\Panel;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Payout;

class PayoutController extends Controller
{
    

    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
     public function index(Request $request)
     {
         $length = 10;
         if(request()->get('length')){
             $length = $request->get('length');
         }
         $payouts = Payout::query();
         
            if($request->get('search')){
                $payouts->where('id','like','%'.$request->search.'%')
                                ->orWhere('type','like','%'.$request->search.'%')
                                ->orWhere('status','like','%'.$request->search.'%')
                ;
            }
            
            if($request->get('from') && $request->get('to')) {
                $payouts->whereBetween('created_at', [\Carbon\carbon::parse($request->from)->format('Y-m-d'),\Carbon\Carbon::parse($request->to)->format('Y-m-d')]);
            }

            if($request->get('asc')){
                $payouts->orderBy($request->get('asc'),'asc');
            }
            if($request->has('status') && $request->get('status') != null){
                $payouts->whereStatus($request->get('status'));
            }
            if($request->get('desc')){
                $payouts->orderBy($request->get('desc'),'desc');
            }
            $payouts = $payouts->paginate($length);

            if ($request->ajax()) {
                return view('panel.payouts.load', ['payouts' => $payouts])->render();  
            }
 
        return view('panel.payouts.index', compact('payouts'));
    }

    
        public function print(Request $request){
            $payouts = collect($request->records['data']);
                return view('panel.payouts.print', ['payouts' => $payouts])->render();  
           
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        try{
            return view('panel.payouts.create');
        }catch(Exception $e){            
            return back()->with('error', 'There was an error: ' . $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'user_id'     => 'required',
            'amount'     => 'required',
            'type'     => 'required',
            'status'     => 'required',
            'approved_by'     => 'required',
            'approved_at'     => 'required',
        ]);
        
        try{
                  
                  
            $payout = Payout::create($request->all());
            return redirect()->route('panel.payouts.index')->with('success','Payout Created Successfully!');
        }catch(Exception $e){            
            return back()->with('error', 'There was an error: ' . $e->getMessage())->withInput($request->all());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function show(Payout $payout)
    {
        try{
            return view('panel.payouts.show',compact('payout'));
        }catch(Exception $e){            
            return back()->with('error', 'There was an error: ' . $e->getMessage());
        }
    }
    public function updateStatus(Request $request,Payout $payout)
    {
        if($request->status == 1){
            $payout->update([
                'txn_no' => $request->txn_no
            ]);
            $user = User::whereId($payout->user_id)->first();
            $after_balance = $user->wallet_balance - $payout->amount;
            $user->update([
                'wallet_balance' =>  $after_balance
            ]);
        }else{
            $payout->update([
                'remark' => $request->remark
            ]);
        }
        $payout->update([
            'approved_by' => Authrole(),
            'approved_at' => now(),
            'status' => $request->status,
            'remark' => 'Admin accept your payout request'
        ]);



        try{
            return back()->with('success','Transaction Updated Successfully');
        }catch(Exception $e){            
            return back()->with('error', 'There was an error: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function edit(Payout $payout)
    {   
        try{
            
            return view('panel.payouts.edit',compact('payout'));
        }catch(Exception $e){            
            return back()->with('error', 'There was an error: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request,Payout $payout)
    {
        
        $this->validate($request, [
                        'user_id'     => 'required',
                        'amount'     => 'required',
                        'type'     => 'required',
                        'status'     => 'required',
                        'approved_by'     => 'required',
                        'approved_at'     => 'required',
                    ]);
                
        try{
                              
            if($payout){
                          
                $chk = $payout->update($request->all());

                return redirect()->route('panel.payouts.index')->with('success','Record Updated!');
            }
            return back()->with('error','Payout not found')->withInput($request->all());
        }catch(Exception $e){            
            return back()->with('error', 'There was an error: ' . $e->getMessage())->withInput($request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Payout $payout)
    {
        try{
            if($payout){
                                            
                $payout->delete();
                return back()->with('success','Payout deleted successfully');
            }else{
                return back()->with('error','Payout not found');
            }
        }catch(Exception $e){
            return back()->with('error', 'There was an error: ' . $e->getMessage());
        }
    }
}

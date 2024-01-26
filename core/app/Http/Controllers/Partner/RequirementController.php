<?php


namespace App\Http\Controllers\Partner;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Requirement;
use App\User;
use App\Models\Order;
use App\Models\CategoryType;
use Razorpay\Api\Api;
use App\Models\Category;

class RequirementController extends Controller
{
    

    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
     public function index(Request $request)
     {

        $length = 20;
        if(request()->get('length')){
            $length = $request->get('length');
        }
        if(request()->has('code') && request()->get('code') != null){
            $requirement =  Requirement::where('code',request()->get('code'))->first();
        }
        $requirements = Requirement::query();
            if($request->get('search')){
                $requirements->where('id','like','%'.$request->search.'%')
                    ->orWhere('title','like','%'.$request->search.'%')
                    ->orWhere('price','like','%'.$request->search.'%')
                    ->orWhere('location','like','%'.$request->search.'%')
                ;
            }
            if($request->get('budget_id')){
                $requirements->where('budget',request()->get('budget_id'));
            }
            if($request->get('search')){
                $requirements->orWhereHas('title',function($q){
                    $q->where('title','like','%'.request()->get('search').'%');
                  });
            }
            if($request->get('from') && $request->get('to')) {
                $requirements->whereBetween('created_at', [\Carbon\Carbon::parse($request->from)->format('Y-m-d').' 00:00:00',\Carbon\Carbon::parse($request->to)->format('Y-m-d')." 23:59:59"]);
            }
            if($request->get('category_id')){
                $requirements->whereHas('category',function($q){
                    $q->where('id','like','%'.request()->get('category_id').'%')
                    ->orWhere('name','like','%'.request()->get('category_id').'%');
                });
            }
            if($request->get('sub_category_id')){
                $requirements->whereHas('subCategory',function($q){
                    $q->where('id','like','%'.request()->get('sub_category_id').'%')
                    ->orWhere('name','like','%'.request()->get('sub_category_id').'%');
                });
            }
            $auth_lead_ids = Order::where('type','Lead')->where('user_id',auth()->id())->pluck('type_id');
            $requirements = $requirements->whereNotIn('id',$auth_lead_ids)->latest()->paginate($length);

            $categories = Category::where('category_type_id',25)->where('level', 1)->select('id','name')->get();
            $subCategories = Category::where('category_type_id',25)->where('level', 2)->select('id','name')->get();
            $budget_categories = Category::where('category_type_id',26)->select('id','name')->get();

            if ($request->ajax()) {
                return view('partner.requirements.load', ['requirements' => $requirements,'categories'=>$categories,'budget_categories'=>$budget_categories])->render();  
            }
        return view('partner.requirements.index', compact('requirements','categories','subCategories','budget_categories'));
    }

    public function myLeadIndex(Request $request)
     {
        $length = 10;
        if(request()->get('length')){
            $length = $request->get('length');
        }
    
        $requirements = Requirement::query();
         
            if($request->get('search')){
                $requirements->where('id','like','%'.$request->search.'%')
                    ->orWhere('title','like','%'.$request->search.'%')
                    ->orWhere('price','like','%'.$request->search.'%')
                    ->orWhere('location','like','%'.$request->search.'%')
                ;
            }
            if($request->get('search')){
                $requirements->orWhereHas('user',function($q){
                    $q->where('id','like','%'.request()->get('search').'%')
                    ->orWhere('name','like','%'.request()->get('search').'%')
                    ->orWhere('phone','like','%'.request()->get('search').'%');
                  });
            }

            if($request->get('search')){
                $requirements->orWhereHas('title',function($q){
                    $q->where('title','like','%'.request()->get('search').'%');
                  });
            }

            if($request->get('budget')){
                $requirements->orWhereHas('budget',function($q){
                    $q->where('budget','like','%'.request()->get('search').'%');
                  });
            }
            if($request->get('category_id')){
                $requirements->whereHas('category',function($q){
                    $q->where('id','like','%'.request()->get('category_id').'%')
                    ->orWhere('name','like','%'.request()->get('category_id').'%');
                });
            }
            $auth_lead_ids = Order::where('type','Lead')->where('user_id',auth()->id())->pluck('type_id');
            $requirements = $requirements->whereIn('id',$auth_lead_ids)->latest()->paginate($length);
            $budget_categories = Category::where('category_type_id',26)->select('id','name')->get();
            $categories = Category::where('category_type_id',25)->where('level', 1)->select('id','name')->get();
            if ($request->ajax()) {
                return view('partner.requirements.my-lead.load', ['requirements' => $requirements,'categories'=>$categories,'budget_categories'=>$budget_categories])->render();  
            }
 
        return view('partner.requirements.my-lead.index', compact('requirements','categories','budget_categories'));
    }

        public function print(Request $request){
            $requirements = collect($request->records['data']);
                return view('partner.requirements.print', ['requirements' => $requirements])->render();  
           
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        try{
            $categories = Category::where('category_type_id',25)->select('id','name')->get();
            $budget_categories = Category::where('category_type_id',26)->select('id','name')->get();
            return view('partner.requirements.create',compact('categories','budget_categories'));
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
                'title'     => 'required',
                'category_id'     => 'sometimes',
                'sub_category_id'     => 'sometimes',
                'price'     => 'required',
                'customer_info'     => 'nullable',
                'location'     => 'sometimes',
                'status'     => 'required',
                'budget'     => 'sometimes',
                'type'     => 'required',
            ]);
        
        try{
            $customer_info=[
                'name' =>$request->name,
                'phone' =>$request->phone,
                'email' =>$request->email,
            ] ; 
            $requirement= Requirement::create([
                'title' => $request->title,
                'category_id' => $request->category_id,
                'sub_category_id' => $request->sub_category_id,
                'price' => $request->price,
                'location' => $request->location,
                'budget' => $request->budget,
                'type' => $request->type,
                'customer_info'=> $customer_info,
                'status'=> $request->status,
                'created_by'=> $request->created_by,
                'location'=> $request->location,

            ]);    
            // $requirement = Requirement::create($request->all());
         return redirect()->route('panel.requirements.index')->with('success','Requirement Created Successfully!');
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
    public function show(Requirement $requirement)
    {
        try{
            return view('partner.requirements.show',compact('requirement'));
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
    public function edit(Requirement $requirement)
    {   
        try{
            $categories = Category::where('category_type_id',25)->select('id','name')->get();
            $budget_categories = Category::where('category_type_id',26)->select('id','name')->get();
            return view('partner.requirements.edit',compact('requirement','budget_categories','categories'));
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
    public function update(Request $request,Requirement $requirement)
    {
        
        $this->validate($request, [
            'title'     => 'required',
            'category_id'     => 'sometimes',
            'sub_category_id'     => 'sometimes',
            'price'     => 'required',
            'cunstomer_info'     => 'nullable',
            'location'     => 'sometimes',
            'status'     => 'required',
            'budget'     => 'sometimes',
            'type'     => 'required',
        ]);
    
        try{
                                 
            if($requirement){
                $customer_info=[
                    'name' =>$request->name,
                    'phone' =>$request->phone,
                    'email' =>$request->email,
                ] ; 
                $request['customer_info'] = $customer_info;
                 $chk = $requirement->update($request->all());

                return redirect()->route('panel.requirements.index')->with('success','Record Updated!');
            }
            return back()->with('error','Requirement not found')->withInput($request->all());
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
    public function destroy(Requirement $requirement)
    {
        try{
            if($requirement){                   
                $requirement->delete();
                return back()->with('success','Requirement deleted successfully');
            }else{
                return back()->with('error','Requirement not found');
            }
        }catch(Exception $e){
            return back()->with('error', 'There was an error: ' . $e->getMessage());
        }
    }


    public function getLeadData(Request $request)
    {
        try{
            $requirement = Requirement::where('id',$request->requirement_id)->first();
            if($requirement){
                $category = fetchFirst('App\Models\Category',$requirement->category_id,'name','--');
                $sub_category = fetchFirst('App\Models\Category',$requirement->sub_category_id,'name','--');
                $status_badge = '<span class="badge badge-'.getRequirementStatus($requirement->status)['color'].'">'.getRequirementStatus($requirement->status)['name'].'<span>';
                $actual_price = $requirement->price;
                $customer_name = $actual_price == 0 ? $requirement->customer_info['name'] : stringMasker($requirement->customer_info['name'], 1,2);
                $customer_phone = $actual_price == 0 ? $requirement->customer_info['phone'] : stringMasker($requirement->customer_info['phone'], 3,2);
                $customer_email = $actual_price == 0 ? $requirement->customer_info['email'] : stringMasker($requirement->customer_info['email'], 3,3);
                $created_at = '<i class="ik ik-clock"></i> '.getFormattedDate($requirement->created_at);
                $budget = '<span class="fw-700 text-muted"> Budget : </span>'.'</span>'.'<span class="fw-700 text-primary">'.'₹'. $requirement->getBudget->name.'<span>';
                $price = '<span class="fw-700 text-muted"> Price : </span>'.'<span class="fw-700 text-primary">'.format_price(getLeadAmount($requirement)).'<span>';
                return response()->json(
                    [
                        'customer_name'=> $customer_name,
                        'customer_phone'=> $customer_phone,
                        'customer_email'=> $customer_email,
                        'status_badge' => $status_badge,
                        'category'=> $category,
                        'sub_category'=> $sub_category,
                        'requirement'=> $requirement,
                        'created_at' => $created_at,
                        'price'=> $price,
                        'budget'=> $budget,
                        'actual_price'=> $actual_price,
                        'status'=> 'success',
                        'message' => 'Success',
                        'title' => 'Requirement found!'
                    ]
                );
            }else{
                return response()->json(
                    [
                        'status'=>'error',
                        'message' => 'Error',
                        'title' => 'Requirement not found'
                    ]
                );
            }
        }catch(Exception $e){
            return response()->json(
                [
                    'status'=>'error',
                    'message' => 'Error',
                    'title' => $e->getMessage()
                ]
            );
        }
    }

    public function checkpoint(Request $request)
    {
        $requirement = Requirement::where('id',$request->requirement_id)->firstOrFail();
        $price = getLeadAmount($requirement);
        return view('partner.requirements.checkpoint', compact('requirement','price'));  
    }
    
    public function pay(Request $request)
    {
        $input = $request->all();        
        $api = new Api(env('API_RAZOR_KEY'), env('API_RAZOR_SECRET'));
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        if(count($input)  && !empty($input['razorpay_payment_id'])) 
        {
            try 
            {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount'])); 
                $txn = generateUniqueTxn();
                $price = $payment['amount']/100;
                $sub_total = $payment['amount']/100;
                $total = $payment['amount']/100;
                $from = systemInvoiceAddress();
                $to = userInvoiceAddress(auth()->id());
                $portfolio = null;
                $permission = null;
                // $permission = '{"chat":0,"attachment":"0","portfolio":0}';
                // Order Creation
                $order = Order::create([
                    'user_id' => auth()->id(),
                    'type' => 'Lead',
                    'type_id' => $response->notes['requirementid'],
                    'txn_no' => $txn,
                    'discount' => null,
                    'tax' => null,
                    'sub_total' => $sub_total,
                    'total' => $total,
                    'price' => $price,
                    'status' => 1,
                    'payment_status' => 1,
                    'payment_gateway' => 'RazorPay',
                    'remarks' => null,
                    'from' => json_encode($from),
                    'to' => json_encode($to),
                    'service_data' => $portfolio,
                    'date' => now()->format('Y-m-d'),
                    'permission' => $permission,
                    'partner_id' => 0,
                    'commission' => 0,
                    'source' => "Web",
                ]);
                return redirect()->route('panel.partner.leads.index')->withSuccess('Payment successful, Now you can access lead information');
            } 
            catch (\Exception $e) 
            {
                return redirect()->back()->withError($e->getMessage());
            }            
        }
    }
    
}

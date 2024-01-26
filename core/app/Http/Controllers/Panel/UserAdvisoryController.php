<?php


namespace App\Http\Controllers\Panel;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\UserAdvisory;
use App\User;

class UserAdvisoryController extends Controller
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
         $user_advisories = UserAdvisory::query();
         
            if($request->get('search')){
                $user_advisories->where('id','like','%'.$request->search.'%')
                                ->orWhere('user_id','like','%'.$request->search.'%')
                ;
            }
            
            if($request->get('from') && $request->get('to')) {
                $user_advisories->whereBetween('created_at', [\Carbon\carbon::parse($request->from)->format('Y-m-d'),\Carbon\Carbon::parse($request->to)->format('Y-m-d')]);
            }

            if($request->get('asc')){
                $user_advisories->orderBy($request->get('asc'),'asc');
            }
            if($request->get('desc')){
                $user_advisories->orderBy($request->get('desc'),'desc');
            }
            $user_advisories = $user_advisories->latest()->paginate($length);

            if ($request->ajax()) {
                return view('panel.user_advisories.load', ['user_advisories' => $user_advisories])->render();  
            }
 
        return view('panel.user_advisories.index', compact('user_advisories'));
    }

    
        public function print(Request $request){
            $user_advisories = collect($request->records['data']);
                return view('panel.user_advisories.print', ['user_advisories' => $user_advisories])->render();  
           
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        try{
            return view('panel.user_advisories.create');
        }catch(Exception $e){            
            return back()->with('error', 'There was an error: ' . $e->getMessage());
        }
    }

    public function userAdvisoryShow($id)
    {
       $advisory_record = UserAdvisory::whereId($id)->first();
        //  return json_decode($user_advisory->user_detail);
         try{
             return view('panel.user_advisories.user-advisory-show',compact('advisory_record'));
         }catch(Exception $e){            
             return back()->with('error', 'There was an error: ' . $e->getMessage());
         }
    }

    public function myAdvisories($user_id)
    {
       $my_advisory_records = UserAdvisory::whereUserId($user_id)->get();
        //  try{
             if($my_advisory_records){
                 return view('panel.user_advisories.my-advisories',compact('my_advisory_records'));
            }else{
                return back()->with('error', 'No records yet!');

             }
        //  }catch(Exception $e){            
        //      return back()->with('error', 'There was an error: ' . $e->getMessage());
        //  }
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // return $request->all();
        // $this->validate($request, [
            //                 'user_id'     => 'required',
            //                 'user_detail'     => 'sometimes',
            //                 'assests'     => 'sometimes',
            //                 'liabilities'     => 'sometimes',
            //                 'goals'     => 'sometimes',
            //                 'budget'     => 'sometimes',
            //                 'risk_assessment'     => 'sometimes',
            //             ]);
            
            
            //profile form
            $user_details = json_encode([
                'name'=>$request->name,
                'dob'=>$request->dob,
                'married'=>$request->married,
                'smoke'=>$request->smoke,
                'no_dependents'=>$request->no_dependents,
                'salary_business'=>$request->salary_business,
                'total_dependent'=>$request->total_dependent
            ]);
            
            //assests form
            $assest_detail = json_encode([
                'assests' =>$request->assests,
                'assets_amount' =>$request->assets_amount,
                'stock'=>$request->stock,
                'stock_amount' =>$request->stock_amount,
                'debet_instrument'=>$request->debet_instrument,
                'debet_instrument_amount'=>$request->debet_instrument_amount,
                'precious'=>$request->precious,
                'precious_amount'=>$request->precious_amount,
                'other_liablities'=>$request->other_liablities,
                'other_liablities_amount'=>$request->other_liablities_amount,
            
        ]);
        
        //liabilities form
        $liabilities_detail = json_encode([
            'personal_loan'=>$request->personal_loan,
            'personal_loan_amount'=>$request->personal_loan_amount,
            'short_loan'=>$request->short_loan,
            'short_loan_amount'=>$request->short_loan_amount,
        ]);
        
        
        //goals form
        $goals_detail = json_encode([
            'vacation'=>$request->vacation,
            'vacation_years'=>$request->vacation_years,
            'collage_education1'=>$request->collage_education1,
            'collage_education_year1'=>$request->collage_education_year1,
            'collage_education2'=>$request->collage_education2,
            'collage_education_year2'=>$request->collage_education_year2,
            'house_property'=>$request->house_property,
            'house_property_year'=>$request->house_property_year,
            'retirement'=>$request->retirement,
            'retirement_year'=>$request->retirement_year,
            
        ]);
        
        
        //budget form
        $budget_detail = json_encode([
            'salary_source'=>$request->salary_source,
            'other_source'=>$request->other_source,
            'loan_expenses'=>$request->loan_expenses,
            'insurance_expenses'=>$request->insurance_expenses,
            'other_expenses'=>$request->other_expenses,
            'tax'=>$request->tax,
            'life_insurance_amount'=>$request->life_insurance_amount,
            'medical_amount'=>$request->medical_amount,
        ]);
        
        //risk form
        $risk_detail = json_encode([
            'job_secure'=>$request->job_secure,
            'paying_loans'=>$request->paying_loans,
            'bougth_stock'=>$request->bougth_stock,
            'mutual_fund'=>$request->mutual_fund,
            'decling'=>$request->decling,
            'save_income'=>$request->save_income,
            'invest'=>$request->invest,
            'lost_bear'=>$request->lost_bear,
            'financial_risk'=>$request->financial_risk,
            'avg_salary'=>$request->avg_salary,
            
        ]);
        
        // try{              
            $user_advisory = UserAdvisory::create([
                'user_id'=>auth()->id(),
                'user_detail'=>$user_details,
                'assests'=>$assest_detail,
                'liabilities'=>$liabilities_detail,
                'goals'=>$goals_detail,
                'budget'=>$budget_detail,
                'risk_assessment'=>$risk_detail
            ]);
            return redirect()->route('user-advisory.show',$user_advisory->id);
                
        // }catch(Exception $e){            
        //     return back()->with('error', 'There was an error: ' . $e->getMessage())->withInput($request->all());
        // }
    }

    public function createUserAdvisory($user_id){
        // return "s";
        $user = User::whereId($user_id)->first();
        if(!$user){abort(404);}
        auth()->loginUsingId($user_id);
       
         //attachment
       try{
        $check = false;

        if(!$user_id){
            abort(404);
        }

        return view('panel.user_advisories.user-create-advisory',compact('check'));
        
       }catch(Execption $e){
         return back()->with('error', 'There was an error: ' . $e->getMessage());
       }
    }
    /**
     * Display the specified resource.
     *
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_advisory  = UserAdvisory::where('id',$id)->where('user_id',auth()->id())->first();
        //  return json_decode($user_advisory->user_detail);
        try{
            return view('panel.user_advisories.show',compact('user_advisory'));
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
    public function edit(UserAdvisory $user_advisory)
    {   
        try{
            
            return view('panel.user_advisories.edit',compact('user_advisory'));
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
    public function update(Request $request,UserAdvisory $user_advisory)
    {
        
        $this->validate($request, [
                        'user_id'     => 'required',
                        'user_detail'     => 'sometimes',
                        'assests'     => 'sometimes',
                        'liabilities'     => 'sometimes',
                        'goals'     => 'sometimes',
                        'budget'     => 'sometimes',
                        'risk_assessment'     => 'sometimes',
                    ]);
                
        try{
                               
            if($user_advisory){
                           
                $chk = $user_advisory->update($request->all());

                return redirect()->route('panel.user_advisories.index')->with('success','Record Updated!');
            }
            return back()->with('error','User Advisory not found')->withInput($request->all());
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
    public function destroy(UserAdvisory $user_advisory)
    {
        try{
            if($user_advisory){
                                              
                $user_advisory->delete();
                return back()->with('success','User Advisory deleted successfully');
            }else{
                return back()->with('error','User Advisory not found');
            }
        }catch(Exception $e){
            return back()->with('error', 'There was an error: ' . $e->getMessage());
        }
    }
    public function updateStatus($id, $status)
    {
        UserAdvisory::where('id', $id)->update([
            'is_paid' => $status,
        ]);

        return back()->with('success', 'Status updated successfully');
    }
}

<?php


namespace App\Http\Controllers\Panel;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\MedicalInsuranceLogic;

class MedicalInsuranceLogicController extends Controller
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
         $medical_insurance_logics = MedicalInsuranceLogic::query();
         
            if($request->get('search')){
                $medical_insurance_logics->where('id','like','%'.$request->search.'%')
                                ->orWhere('family_income','like','%'.$request->search.'%')
                                ->orWhere('insurance_amount','like','%'.$request->search.'%')
                ;
            }
            
            if($request->get('from') && $request->get('to')) {
                $medical_insurance_logics->whereBetween('created_at', [\Carbon\carbon::parse($request->from)->format('Y-m-d'),\Carbon\Carbon::parse($request->to)->format('Y-m-d')]);
            }

            if($request->get('asc')){
                $medical_insurance_logics->orderBy($request->get('asc'),'asc');
            }
            if($request->get('desc')){
                $medical_insurance_logics->orderBy($request->get('desc'),'desc');
            }
            $medical_insurance_logics = $medical_insurance_logics->paginate($length);

            if ($request->ajax()) {
                return view('panel.medical_insurance_logics.load', ['medical_insurance_logics' => $medical_insurance_logics])->render();  
            }
 
        return view('panel.medical_insurance_logics.index', compact('medical_insurance_logics'));
    }

    
        public function print(Request $request){
            $medical_insurance_logics = collect($request->records['data']);
                return view('panel.medical_insurance_logics.print', ['medical_insurance_logics' => $medical_insurance_logics])->render();  
           
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        try{
            return view('panel.medical_insurance_logics.create');
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
                        'family_income'     => 'required',
                        'insurance_amount'     => 'required',
                        'of_family_members'     => 'required',
                        'coverage_required_for_family'     => 'required',
                        'approx_premium'     => 'required',
                    ]);
        
        try{
                 
                 
            $medical_insurance_logic = MedicalInsuranceLogic::create($request->all());
        
        /**
        *     $mailcontent_data = App\Models\MailSmsTemplate::where('code','=',"Welcome")->first();
        *    $arr=[
        *        '{name}'=>"User",
        *        '{id}'=>"MYID",
        *        '{phone}'=>"",
        *        '{email}'=>"",
        *    ];
        *   customMail("Admin",getSetting('admin_email'),$mailcontent_data,$arr,null ,null ,$action_btn = null ,asset('storage/backend/logos/white-logo-662.png') ,"white-logo-662.png" ,$attachment_mime = null); 
        */
                        
        /**
        *   $data_notification = [
        *       'title' => "New Information ",
        *      'notification' => "MedicalInsuranceLogic Created Successfully!",
        *      'link' => "#",
        *      'user_id' => auth()->id(),
        *   ];
        *   pushOnSiteNotification($data_notification); 
        */
                    return redirect()->route('panel.medical_insurance_logics.index')->with('success','Medical Insurance Logic Created Successfully!');
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
    public function show(MedicalInsuranceLogic $medical_insurance_logic)
    {
        try{
            return view('panel.medical_insurance_logics.show',compact('medical_insurance_logic'));
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
    public function edit(MedicalInsuranceLogic $medical_insurance_logic)
    {   
        try{
            
            return view('panel.medical_insurance_logics.edit',compact('medical_insurance_logic'));
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
    public function update(Request $request,MedicalInsuranceLogic $medical_insurance_logic)
    {
        
        $this->validate($request, [
                        'family_income'     => 'required',
                        'insurance_amount'     => 'required',
                        'of_family_members'     => 'required',
                        'coverage_required_for_family'     => 'required',
                        'approx_premium'     => 'required',
                    ]);
                
        try{
                             
            if($medical_insurance_logic){
                         
                $chk = $medical_insurance_logic->update($request->all());

                return redirect()->route('panel.medical_insurance_logics.index')->with('success','Record Updated!');
            }
            return back()->with('error','Medical Insurance Logic not found')->withInput($request->all());
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
    public function destroy(MedicalInsuranceLogic $medical_insurance_logic)
    {
        try{
            if($medical_insurance_logic){
                                          
                $medical_insurance_logic->delete();
                return back()->with('success','Medical Insurance Logic deleted successfully');
            }else{
                return back()->with('error','Medical Insurance Logic not found');
            }
        }catch(Exception $e){
            return back()->with('error', 'There was an error: ' . $e->getMessage());
        }
    }
}

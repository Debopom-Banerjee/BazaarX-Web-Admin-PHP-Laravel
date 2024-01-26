<?php


namespace App\Http\Controllers\Panel;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\AssumptionLogic;

class AssumptionLogicController extends Controller
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
         $assumption_logics = AssumptionLogic::query();
         
            if($request->get('search')){
                $assumption_logics->where('id','like','%'.$request->search.'%')
                                ->orWhere('scenerio','like','%'.$request->search.'%')
                                ->orWhere('year','like','%'.$request->search.'%')
                ;
            }
            
            if($request->get('from') && $request->get('to')) {
                $assumption_logics->whereBetween('created_at', [\Carbon\carbon::parse($request->from)->format('Y-m-d'),\Carbon\Carbon::parse($request->to)->format('Y-m-d')]);
            }

            if($request->get('asc')){
                $assumption_logics->orderBy($request->get('asc'),'asc');
            }
            if($request->get('desc')){
                $assumption_logics->orderBy($request->get('desc'),'desc');
            }
            $assumption_logics = $assumption_logics->paginate($length);

            if ($request->ajax()) {
                return view('panel.assumption_logics.load', ['assumption_logics' => $assumption_logics])->render();  
            }
 
        return view('panel.assumption_logics.index', compact('assumption_logics'));
    }

    
        public function print(Request $request){
            $assumption_logics = collect($request->records['data']);
                return view('panel.assumption_logics.print', ['assumption_logics' => $assumption_logics])->render();  
           
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        try{
            return view('panel.assumption_logics.create');
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
                        'scenerio'     => 'required',
                        'expectancy'     => 'required',
                    ]);
        
        try{
                 
                 
            $assumption_logic = AssumptionLogic::create($request->all());
        
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
        *      'notification' => "AssumptionLogic Created Successfully!",
        *      'link' => "#",
        *      'user_id' => auth()->id(),
        *   ];
        *   pushOnSiteNotification($data_notification); 
        */
                    return redirect()->route('panel.assumption_logics.index')->with('success','Assumption Logic Created Successfully!');
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
    public function show(AssumptionLogic $assumption_logic)
    {
        try{
            return view('panel.assumption_logics.show',compact('assumption_logic'));
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
    public function edit(AssumptionLogic $assumption_logic)
    {   
        try{
            
            return view('panel.assumption_logics.edit',compact('assumption_logic'));
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
    public function update(Request $request,AssumptionLogic $assumption_logic)
    {
        
        $this->validate($request, [
                        'scenerio'     => 'required',
                        'expectancy'     => 'required',
                    ]);
                
        try{
                             
            if($assumption_logic){
                         
                $chk = $assumption_logic->update($request->all());

                return redirect()->route('panel.assumption_logics.index')->with('success','Record Updated!');
            }
            return back()->with('error','Assumption Logic not found')->withInput($request->all());
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
    public function destroy(AssumptionLogic $assumption_logic)
    {
        try{
            if($assumption_logic){
                                          
                $assumption_logic->delete();
                return back()->with('success','Assumption Logic deleted successfully');
            }else{
                return back()->with('error','Assumption Logic not found');
            }
        }catch(Exception $e){
            return back()->with('error', 'There was an error: ' . $e->getMessage());
        }
    }
}

<?php


namespace App\Http\Controllers\Panel;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\InvestorType;

class InvestorTypeController extends Controller
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
         $investor_types = InvestorType::query();
         
            if($request->get('search')){
                $investor_types->where('id','like','%'.$request->search.'%')
                                ->orWhere('category','like','%'.$request->search.'%')
                                ->orWhere('score','like','%'.$request->search.'%')
                ;
            }
            
            if($request->get('from') && $request->get('to')) {
                $investor_types->whereBetween('created_at', [\Carbon\carbon::parse($request->from)->format('Y-m-d'),\Carbon\Carbon::parse($request->to)->format('Y-m-d')]);
            }

            if($request->get('asc')){
                $investor_types->orderBy($request->get('asc'),'asc');
            }
            if($request->get('desc')){
                $investor_types->orderBy($request->get('desc'),'desc');
            }
            $investor_types = $investor_types->paginate($length);

            if ($request->ajax()) {
                return view('panel.investor_types.load', ['investor_types' => $investor_types])->render();  
            }
 
        return view('panel.investor_types.index', compact('investor_types'));
    }

    
        public function print(Request $request){
            $investor_types = collect($request->records['data']);
                return view('panel.investor_types.print', ['investor_types' => $investor_types])->render();  
           
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        try{
            return view('panel.investor_types.create');
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
                        'category'     => 'required',
                        'score'     => 'required',
                    ]);
        
        try{
              
              
            $investor_type = InvestorType::create($request->all());
        
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
        *      'notification' => "InvestorType Created Successfully!",
        *      'link' => "#",
        *      'user_id' => auth()->id(),
        *   ];
        *   pushOnSiteNotification($data_notification); 
        */
                    return redirect()->route('panel.investor_types.index')->with('success','Investor Type Created Successfully!');
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
    public function show(InvestorType $investor_type)
    {
        try{
            return view('panel.investor_types.show',compact('investor_type'));
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
    public function edit(InvestorType $investor_type)
    {   
        try{
            
            return view('panel.investor_types.edit',compact('investor_type'));
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
    public function update(Request $request,InvestorType $investor_type)
    {
        
        $this->validate($request, [
                        'category'     => 'required',
                        'score'     => 'required',
                    ]);
                
        try{
                          
            if($investor_type){
                      
                $chk = $investor_type->update($request->all());

                return redirect()->route('panel.investor_types.index')->with('success','Record Updated!');
            }
            return back()->with('error','Investor Type not found')->withInput($request->all());
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
    public function destroy(InvestorType $investor_type)
    {
        try{
            if($investor_type){
                                    
                $investor_type->delete();
                return back()->with('success','Investor Type deleted successfully');
            }else{
                return back()->with('error','Investor Type not found');
            }
        }catch(Exception $e){
            return back()->with('error', 'There was an error: ' . $e->getMessage());
        }
    }
}

<?php


namespace App\Http\Controllers\Panel;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\DebtLogic;

class DebtLogicController extends Controller
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
         $debt_logics = DebtLogic::query();
         
            if($request->get('search')){
                $debt_logics->where('id','like','%'.$request->search.'%')
                                ->orWhere('institutions','like','%'.$request->search.'%')
                                ->orWhere('type_of_bank','like','%'.$request->search.'%')
                ;
            }
            
            if($request->get('from') && $request->get('to')) {
                $debt_logics->whereBetween('created_at', [\Carbon\carbon::parse($request->from)->format('Y-m-d'),\Carbon\Carbon::parse($request->to)->format('Y-m-d')]);
            }

            if($request->get('asc')){
                $debt_logics->orderBy($request->get('asc'),'asc');
            }
            if($request->get('desc')){
                $debt_logics->orderBy($request->get('desc'),'desc');
            }
            $debt_logics = $debt_logics->paginate($length);

            if ($request->ajax()) {
                return view('panel.debt_logics.load', ['debt_logics' => $debt_logics])->render();  
            }
 
        return view('panel.debt_logics.index', compact('debt_logics'));
    }

    
        public function print(Request $request){
            $debt_logics = collect($request->records['data']);
                return view('panel.debt_logics.print', ['debt_logics' => $debt_logics])->render();  
           
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        try{
            return view('panel.debt_logics.create');
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
                        'institutions'     => 'required',
                        'type_of_bank'     => 'required',
                        'rate'     => 'required',
                        'period'     => 'required',
                    ]);
        
        try{
                
                
            $debt_logic = DebtLogic::create($request->all());
        
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
        *      'notification' => "DebtLogic Created Successfully!",
        *      'link' => "#",
        *      'user_id' => auth()->id(),
        *   ];
        *   pushOnSiteNotification($data_notification); 
        */
                    return redirect()->route('panel.debt_logics.index')->with('success','Debt Logic Created Successfully!');
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
    public function show(DebtLogic $debt_logic)
    {
        try{
            return view('panel.debt_logics.show',compact('debt_logic'));
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
    public function edit(DebtLogic $debt_logic)
    {   
        try{
            
            return view('panel.debt_logics.edit',compact('debt_logic'));
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
    public function update(Request $request,DebtLogic $debt_logic)
    {
        
        $this->validate($request, [
                        'institutions'     => 'required',
                        'type_of_bank'     => 'required',
                        'rate'     => 'required',
                        'period'     => 'required',
                    ]);
                
        try{
                            
            if($debt_logic){
                        
                $chk = $debt_logic->update($request->all());

                return redirect()->route('panel.debt_logics.index')->with('success','Record Updated!');
            }
            return back()->with('error','Debt Logic not found')->withInput($request->all());
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
    public function destroy(DebtLogic $debt_logic)
    {
        try{
            if($debt_logic){
                                        
                $debt_logic->delete();
                return back()->with('success','Debt Logic deleted successfully');
            }else{
                return back()->with('error','Debt Logic not found');
            }
        }catch(Exception $e){
            return back()->with('error', 'There was an error: ' . $e->getMessage());
        }
    }
}

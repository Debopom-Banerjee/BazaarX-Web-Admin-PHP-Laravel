<?php


namespace App\Http\Controllers\Panel;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\UserInviter;

class UserInviterController extends Controller
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
         $user_inviters = UserInviter::query();
         
            if($request->get('search')){
                $user_inviters->where('id','like','%'.$request->search.'%')
                                ->orWhere('user_id','like','%'.$request->search.'%')
                ;
            }
            
            if($request->get('from') && $request->get('to')) {
                $user_inviters->whereBetween('created_at', [\Carbon\carbon::parse($request->from)->format('Y-m-d'),\Carbon\Carbon::parse($request->to)->format('Y-m-d')]);
            }

            if($request->get('asc')){
                $user_inviters->orderBy($request->get('asc'),'asc');
            }
            if($request->get('desc')){
                $user_inviters->orderBy($request->get('desc'),'desc');
            }
            $user_inviters = $user_inviters->paginate($length);

            if ($request->ajax()) {
                return view('panel.user_inviters.load', ['user_inviters' => $user_inviters])->render();  
            }
 
        return view('panel.user_inviters.index', compact('user_inviters'));
    }

    
        public function print(Request $request){
            $user_inviters = collect($request->records['data']);
                return view('panel.user_inviters.print', ['user_inviters' => $user_inviters])->render();  
           
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        try{
            return view('panel.user_inviters.create');
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
            'inviter_id'     => 'required',
        ]);
        
        try{
            $user_inviter = UserInviter::create($request->all());
            return redirect()->route('panel.user_inviters.index')->with('success','User Inviter Created Successfully!');
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
    public function show(UserInviter $user_inviter)
    {
        try{
            return view('panel.user_inviters.show',compact('user_inviter'));
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
    public function edit(UserInviter $user_inviter)
    {   
        try{
            
            return view('panel.user_inviters.edit',compact('user_inviter'));
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
    public function update(Request $request,UserInviter $user_inviter)
    {
        
        $this->validate($request, [
                        'user_id'     => 'required',
                        'inviter_id'     => 'required',
                    ]);
                
        try{
                          
            if($user_inviter){
                      
                $chk = $user_inviter->update($request->all());

                return redirect()->route('panel.user_inviters.index')->with('success','Record Updated!');
            }
            return back()->with('error','User Inviter not found')->withInput($request->all());
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
    public function destroy(UserInviter $user_inviter)
    {
        try{
            if($user_inviter){
                                    
                $user_inviter->delete();
                return back()->with('success','User Inviter deleted successfully');
            }else{
                return back()->with('error','User Inviter not found');
            }
        }catch(Exception $e){
            return back()->with('error', 'There was an error: ' . $e->getMessage());
        }
    }
}

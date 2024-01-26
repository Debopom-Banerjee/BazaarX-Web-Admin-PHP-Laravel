<?php


namespace App\Http\Controllers\Panel;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\InvestmentOption;

class InvestmentOptionController extends Controller
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
         $investment_options = InvestmentOption::query();
         
            if($request->get('search')){
                $investment_options->where('id','like','%'.$request->search.'%')
                                ->orWhere('mutual_fund','like','%'.$request->search.'%')
                                ->orWhere('allocation','like','%'.$request->search.'%')
                ;
            }
            
            if($request->get('from') && $request->get('to')) {
                $investment_options->whereBetween('created_at', [\Carbon\carbon::parse($request->from)->format('Y-m-d'),\Carbon\Carbon::parse($request->to)->format('Y-m-d')]);
            }

            if($request->get('asc')){
                $investment_options->orderBy($request->get('asc'),'asc');
            }
            if($request->get('desc')){
                $investment_options->orderBy($request->get('desc'),'desc');
            }
            $investment_options = $investment_options->paginate($length);

            if ($request->ajax()) {
                return view('panel.investment_options.load', ['investment_options' => $investment_options])->render();  
            }
 
        return view('panel.investment_options.index', compact('investment_options'));
    }

    
        public function print(Request $request){
            $investment_options = collect($request->records['data']);
                return view('panel.investment_options.print', ['investment_options' => $investment_options])->render();  
           
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        try{
            return view('panel.investment_options.create');
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
                        'mutual_fund'     => 'required',
                        'allocation'     => 'required',
                        'scrip_name'     => 'required',
                        'tenure'     => 'required',
                        'type'     => 'required',
                    ]);
        
        try{
                 
                 
            $investment_option = InvestmentOption::create($request->all());
        
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
        *      'notification' => "InvestmentOption Created Successfully!",
        *      'link' => "#",
        *      'user_id' => auth()->id(),
        *   ];
        *   pushOnSiteNotification($data_notification); 
        */
                    return redirect()->route('panel.investment_options.index')->with('success','Investment Option Created Successfully!');
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
    public function show(InvestmentOption $investment_option)
    {
        try{
            return view('panel.investment_options.show',compact('investment_option'));
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
    public function edit(InvestmentOption $investment_option)
    {   
        try{
            
            return view('panel.investment_options.edit',compact('investment_option'));
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
    public function update(Request $request,InvestmentOption $investment_option)
    {
        
        $this->validate($request, [
                        'mutual_fund'     => 'required',
                        'allocation'     => 'required',
                        'scrip_name'     => 'required',
                        'tenure'     => 'required',
                        'type'     => 'required',
                    ]);
                
        try{
                             
            if($investment_option){
                         
                $chk = $investment_option->update($request->all());

                return redirect()->route('panel.investment_options.index')->with('success','Record Updated!');
            }
            return back()->with('error','Investment Option not found')->withInput($request->all());
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
    public function destroy(InvestmentOption $investment_option)
    {
        try{
            if($investment_option){
                                          
                $investment_option->delete();
                return back()->with('success','Investment Option deleted successfully');
            }else{
                return back()->with('error','Investment Option not found');
            }
        }catch(Exception $e){
            return back()->with('error', 'There was an error: ' . $e->getMessage());
        }
    }
}

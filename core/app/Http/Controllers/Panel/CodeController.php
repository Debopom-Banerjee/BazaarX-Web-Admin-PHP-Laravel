<?php


namespace App\Http\Controllers\Panel;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Code;

class CodeController extends Controller
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
         $codes = Code::query();
         
            if($request->get('search')){
                $codes->where('id','like','%'.$request->search.'%')
                                ->orWhere('code','like','%'.$request->search.'%')
                ;
            }
            
            if($request->get('from') && $request->get('to')) {
                $codes->whereBetween('created_at', [\Carbon\carbon::parse($request->from)->format('Y-m-d'),\Carbon\Carbon::parse($request->to)->format('Y-m-d')]);
            }

            if($request->get('asc')){
                $codes->orderBy($request->get('asc'),'asc');
            }
            if($request->get('desc')){
                $codes->orderBy($request->get('desc'),'desc');
            }
            $codes = $codes->paginate($length);

            if ($request->ajax()) {
                return view('panel.codes.load', ['codes' => $codes])->render();  
            }
 
        return view('panel.codes.index', compact('codes'));
    }

    
        public function print(Request $request){
            $codes = collect($request->records['data']);
                return view('panel.codes.print', ['codes' => $codes])->render();  
           
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        try{
            return view('panel.codes.create');
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
            'code'     => 'sometimes',
            'expires_at'     => 'sometimes',
            'type'     => 'sometimes',
            'precentage'     => 'sometimes',
            'max_uses'     => 'sometimes',
        ]);
        
        try{
                 
                 
            $code = Code::create($request->all());
            return redirect()->route('panel.codes.index')->with('success','Code Created Successfully!');
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
    public function show(Code $code)
    {
        try{
            return view('panel.codes.show',compact('code'));
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
    public function edit(Code $code)
    {   
        try{
            
            return view('panel.codes.edit',compact('code'));
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
    public function update(Request $request,Code $code)
    {

       
       // return $request->all();
        
        $this->validate($request, [
                        'code'     => 'sometimes',
                        'expires_at'     => 'sometimes',
                        'type'     => 'sometimes',
                        'precentage'     => 'sometimes',
                        'max_uses'     => 'sometimes',
                    ]);
                
        try{
                             
            if($code){
                         
                $chk = $code->update($request->all());

                return redirect()->route('panel.codes.index')->with('success','Record Updated!');
            }
            return back()->with('error','Code not found')->withInput($request->all());
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
    public function destroy(Code $code)
    {
        try{
            if($code){
                                          
                $code->delete();
                return back()->with('success','Code deleted successfully');
            }else{
                return back()->with('error','Code not found');
            }
        }catch(Exception $e){
            return back()->with('error', 'There was an error: ' . $e->getMessage());
        }
    }
}

<?php


namespace App\Http\Controllers\Panel;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Portfolio;
use App\Models\Service;
class PortfolioController extends Controller
{
    

    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
     public function index(Request $request)
     {
        $service_id =  $request->get('service');
         $length = 10;
         if(request()->get('length')){
             $length = $request->get('length');
         }
        $portfolios = Portfolio::query();
        
        $service_title = Service::whereId($service_id)->first()->title;
         
       //  $portfoliosPage = Portfolio::all()->paginate($length);
        //  $portfolios = Portfolio::where('service_id',$service_id)->paginate(10);
 
       // dd($portfoliosData);
         
            if($request->get('search')){
                $portfolios->where('id','like','%'.$request->search.'%')
                                ->orWhere('title','like','%'.$request->search.'%')
                ;
            }
            
            if($request->get('from') && $request->get('to')) {
                $portfolios->whereBetween('created_at', [\Carbon\carbon::parse($request->from)->format('Y-m-d'),\Carbon\Carbon::parse($request->to)->format('Y-m-d')]);
            }

            if($request->get('asc')){
                $portfolios->orderBy($request->get('asc'),'asc');
            }
            if($request->get('desc')){
                $portfolios->orderBy($request->get('desc'),'desc');
            }
            if($request->get('service')){
                $portfolios->where('service_id',$request->get('service'));
            }
           $portfolios = $portfolios->paginate($length);

            if ($request->ajax()) {
                return view('panel.portfolios.load', ['portfolios' => $portfolios])->render();  
            }
 
       // return view('panel.portfolios.index', compact('portfolios','service_id'));
        return view('panel.portfolios.index', compact('portfolios','service_title'));
    }

    
        public function print(Request $request){
            $portfolios = collect($request->records['data']);
                return view('panel.portfolios.print', ['portfolios' => $portfolios])->render();  
           
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
       
      
        try{
            return view('panel.portfolios.create');
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
                        'service_id'     => 'required',
                        'title'     => 'required',
                        'description'     => 'sometimes',
                        'is_publish'=>'sometimes',
                        'buy_link'     => 'sometimes',
                    ]);
        
        try{
            if(!$request->has('is_publish')){
                $request['is_publish'] = 0; 
            }
                
              
            $portfolio = Portfolio::create($request->all());
                            return redirect()->route('panel.portfolios.index',['service'=>$request->service_id])->with('success','Portfolio Created Successfully!');
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
    public function show(Portfolio $portfolio)
    {
        try{
            return view('panel.portfolios.show',compact('portfolio'));
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
    public function edit(Portfolio $portfolio)
    {   
        try{
            
            return view('panel.portfolios.edit',compact('portfolio'));
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
    public function update(Request $request,Portfolio $portfolio)
    {
        
        $this->validate($request, [
                        'service_id'     => 'required',
                        'title'     => 'required',
                        'description'     => 'sometimes',
                        'is_publish'=>'sometimes',
                        'buy_link'     => 'sometimes',
                    ]);
                    
                
        try{
            if(!$request->has('is_publish')){
                $request['is_publish'] = 0; 
            }
                      
           
            if($portfolio){       
                $chk = $portfolio->update($request->all());
                return redirect()->route('panel.portfolios.index',['service'=>$request->service_id])->with('success','Record Updated!');
            }
            return back()->with('error','Portfolio not found')->withInput($request->all());
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
    public function destroy(Portfolio $portfolio)
    {
        try{
            if($portfolio){
                                        
                $portfolio->delete();
                return back()->with('success','Portfolio deleted successfully');
            }else{
                return back()->with('error','Portfolio not found');
            }
        }catch(Exception $e){
            return back()->with('error', 'There was an error: ' . $e->getMessage());
        }
    }
}

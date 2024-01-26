<?php


namespace App\Http\Controllers\Panel;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CaseWorkstreamMessage;
use App\Models\CaseWorkstream;
use App\Models\CaseWorkstreamParticipant;
use App\Models\Portfolio;
use App\User;
class TestimonialsController extends Controller
{
    
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }

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
         $services = Testimonial::query();
         
            if($request->get('asc')){
                $services->orderBy($request->get('asc'),'asc');
            }
            if($request->get('desc')){
                $services->orderBy($request->get('desc'),'desc');
            }
            $services->latest();
            $services = $services->paginate($length);

            if ($request->ajax()) {
                return view('panel.testimonials.load', ['services' => $services])->render();  
            }
 
        return view('panel.testimonials.index', compact('services'));
    }

    
        public function print(Request $request){
            $services = collect($request->records['data']);
                return view('panel.testimonials.print', ['services' => $services])->render();  
           
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        try{
            return view('panel.testimonials.create');
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
         $permission_arr = [];
        
        $this->validate($request, [
                        'title'     => 'required',
                        'description'     => 'sometimes',
                    ]);
                   
        try{
           if($request->hasFile("banner_file")){
                $supported_image = array('gif','jpg','jpeg','png','svg','webp');         
                $ext =   $request->file("banner_file")->getClientOriginalExtension();
                if(in_array($ext, $supported_image)){
                    $request['video_img'] = $this->uploadFile($request->file("banner_file"), "services")->getFilePath();
                }else{
                    return back()->with('error', 'Please upload an valid file');
                }
   
            } else {
                return back()->with('error', 'Please upload an file for banner');
            }

            // $request['permission'] = json_encode($permission_arr,true);
            $request['permission'] = $permission_arr;
            $service = Testimonial::create($request->all());
                return redirect()->route('panel.testimonial.index')->with('success','Testimonials Created Successfully!');
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
    public function show($order_item_id)
    {
       
        try{
            if($order_item_id){
                $order_item = OrderItem::whereId($order_item_id)->first();
                $order = Order::whereId($order_item->order_id)->first();
                
                $service = Testimonial::whereId($order_item->item_id)->first();
                $user = User::whereId($order->user_id)->first();
               // dd(json_decode($order->service_data));
               
                $service = Testimonial::whereId($order_item->item_id)->first();
                //   $order = Order::whereId($order_item->order_id)->first();
                 $workStream = CaseWorkstream::where('case_id',$order_item_id)->first();
                if($workStream){
                    $message = CaseWorkstreamMessage::whereWorkstreamId($workStream->id)->get();
                }else{
                    $message = null;
                    $workStream = null;
                }
                
                return view('panel.testimonials.show',compact('service','order_item','order','message','workStream','user'));
            }else{
                return back()->with('error', 'Your Service not Found!');
            }
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
    public function edit($id)
    {   
        $testimonial = Testimonial::find($id);
        try{
            
            return view('panel.testimonials.edit',compact('testimonial'));
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
    public function update(Request $request,$id)
    {
        $permission_arr = [];
        
        $this->validate($request, [
                        'title'     => 'required',
                        'description'     => 'sometimes',
                    ]);
                   
                
        try{
            if($request->hasFile("banner_file")){
                $supported_image = array('gif','jpg','jpeg','png','svg','webp');         
                $ext =   $request->file("banner_file")->getClientOriginalExtension();
                if(in_array($ext, $supported_image)){
                    $request['video_img'] = $this->uploadFile($request->file("banner_file"), "services")->getFilePath();
                }else{
                    return back()->with('error', 'Please upload an valid file');
                }
   
            } else {
                return back()->with('error', 'Please upload an file for banner');
            }
             $testimonial = Testimonial::find($id);                 
            if($testimonial){
                  
                          
                $chk = $testimonial->update($request->all());

                return redirect()->route('panel.testimonial.index')->with('success','Record Updated!');
            }
            return back()->with('error','Service not found')->withInput($request->all());
        }catch(Exception $e){            
            return back()->with('error', 'There was an error: ' . $e->getMessage())->withInput($request->all());
        }
    }

 //Service Category
    public function category(Request $request){
           $category_id = $request->get('category_id');
           $length = 10;
           if(request()->get('length')){
               $length = $request->get('length');
           }
           $services = Testimonial::query();
           
              if($request->get('search')){
                  $services->where('id','like','%'.$request->search.'%')
                                  ->orWhere('title','like','%'.$request->search.'%')
                                  ->orWhere('price','like','%'.$request->search.'%')
                                  ->orWhere('mrp','like','%'.$request->search.'%')
                  ;
              }
              
              if($request->get('from') && $request->get('to')) {
                  $services->whereBetween('created_at', [\Carbon\carbon::parse($request->from)->format('Y-m-d'),\Carbon\Carbon::parse($request->to)->format('Y-m-d')]);
              }
  
              if($request->get('asc')){
                  $services->orderBy($request->get('asc'),'asc');
              }
              if($request->get('desc')){
                  $services->orderBy($request->get('desc'),'desc');
              }
              if($request->get('category_id')){
                  $services->where('category_id',$request->get('category_id'));
              }
              $services = $services->paginate($length);
  
              if ($request->ajax()) {
                  return view('panel.testimonial.load', ['services' => $services])->render();  
              }
   
          return view('panel.testimonials.index', compact('services','category_id'));
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       // return $service->id;
       $testimonial = Testimonial::find($id);  
        try{
            if($testimonial){
                      
                $testimonial->delete();
                return back()->with('success','Testimonial deleted successfully');
                  
            }else{
                return back()->with('error','Service not found');
            }
        }catch(Exception $e){
            return back()->with('error', 'There was an error: ' . $e->getMessage());
        }
    }
}

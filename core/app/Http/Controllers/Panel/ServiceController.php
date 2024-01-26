<?php

    namespace App\Http\Controllers\Panel;
    use App\Http\Controllers\Controller;

    use Illuminate\Http\Request;
    use App\Models\Service;
    use App\Models\Category;
    use App\Models\Media;
    use App\Models\Order;
    use App\Models\OrderItem;
    use App\Models\CaseWorkstreamMessage;
    use App\Models\CaseWorkstream;
    use App\Models\CaseWorkstreamParticipant;
    use App\Models\Portfolio;
    use App\User;
    class ServiceController extends Controller
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
            $services = Service::query();
            
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

                if($request->get('category_id')){
                    $services->where('category_id',$request->get('category_id'));
                }
                if($request->get('asc')){
                    $services->orderBy($request->get('asc'),'asc');
                }
                if($request->get('desc')){
                    $services->orderBy($request->get('desc'),'desc');
                }
                $services->latest();
                $services = $services->paginate($length);

                if ($request->ajax()) {
                    return view('panel.services.load', ['services' => $services])->render();  
                }
    
            return view('panel.services.index', compact('services'));
        }

        
            public function print(Request $request){
                $services = collect($request->records['data']);
                    return view('panel.services.print', ['services' => $services])->render();  
            
            }

        /**
         * Show the form for creating a new resource.
         *
         * @return  \Illuminate\Http\Response
         */
        public function create()
        {
            try{
                $document_categories = Category::whereCategoryTypeId(23)->get();
                return view('panel.services.create',compact('document_categories'));
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
                'banner'     => 'sometimes|mimes:jpg,png,jpeg',
                'is_publish'     => 'sometimes',
                'category_id'     => 'required',
                'permission'     => 'sometimes',
                'price'     => 'required',
                'mrp'     => 'sometimes',
                'benefit'=>'sometimes',
                'document'=>'sometimes',
                'deliverable'=>'sometimes',
                'affiliation_value'=>'required_with:affiliation_desc|nullable',
                'affiliation_desc'=>'required_with:affiliation_value|nullable'
            ]);
            // dd($request);
            $permission_arr['chat'] = $request->get('chat')??0;
            $permission_arr['attachment'] = $request->get('attachment')??0;
            $permission_arr['portfolio'] = $request->get('portfolio')??0;
        // return $permission_arr;
            
            try{
                if($request->hasFile("web_banner_file")){
                    $supported_image = array('gif','jpg','jpeg','png');         
                    $ext =   $request->file("web_banner_file")->getClientOriginalExtension();
                    if(in_array($ext, $supported_image)){
                        $request['web_banner'] = $this->uploadFile($request->file("web_banner_file"), "services")->getFilePath();
                    }else{
                        return back()->with('error', 'Please upload an valid file');
                    }
    
                }
                if($request->hasFile("banner_file")){
                    $supported_image = array('gif','jpg','jpeg','png');         
                    $ext =   $request->file("banner_file")->getClientOriginalExtension();
                    if(in_array($ext, $supported_image)){
                        $request['banner'] = $this->uploadFile($request->file("banner_file"), "services")->getFilePath();
                    }else{
                        return back()->with('error', 'Please upload an valid file');
                    }
    
                } else {
                    return back()->with('error', 'Please upload an file for banner');
                }
                // $request['permission'] = json_encode($permission_arr,true);
                $request['permission'] = $permission_arr;
                $service = Service::create($request->all());
                    return redirect()->route('panel.services.index')->with('success','Service Created Successfully!');
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
                    
                    $service = Service::whereId($order_item->item_id)->first();
                    $user = User::whereId($order->user_id)->first();
                // dd(json_decode($order->service_data));
                
                    $service = Service::whereId($order_item->item_id)->first();
                    //   $order = Order::whereId($order_item->order_id)->first();
                    $workStream = CaseWorkstream::where('case_id',$order_item_id)->first();
                    if($workStream){
                        $message = CaseWorkstreamMessage::whereWorkstreamId($workStream->id)->get();
                    }else{
                        $message = null;
                        $workStream = null;
                    }
                    
                    return view('panel.services.show',compact('service','order_item','order','message','workStream','user'));
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
        public function edit(Service $service)
        {   
            try{
                $document_categories = Category::whereCategoryTypeId(23)->get();
                $medias = Media::whereType('Service')->whereTypeId($service->id)->get();
                return view('panel.services.edit',compact('service','document_categories','medias'));
            }catch(Exception $e){            
                return back()->with('error', 'There was an error: ' . $e->getMessage());
            }
        }
        public function chatStore(Request $request)
        {   
            try{
                $rec = CaseWorkstreamMessage::create([
                    'workstream_id'=>$request->workstream_id,
                    'user_id'=>auth()->id(),
                    'message'=>$request->message,
                    'type'=>$request->type,
                ]);
                return back()->with('suceess',"Chat Sent Successfully!");
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
        public function update(Request $request,Service $service)
        {
            $permission_arr = [];
            $this->validate($request, [
                'title'     => 'required',
                'description'     => 'sometimes',
                'banner'     => 'sometimes',
                'is_publish'     => 'sometimes',
                'category_id'     => 'required',
                'permission'     => 'sometimes',
                'price'     => 'required',
                'mrp'     => 'sometimes',
                'benefit'=>'sometimes',
                'document'=>'sometimes',
                'deliverable'=>'sometimes',
                'affiliation_value'=>'required_with:affiliation_desc|nullable',
                'affiliation_desc'=>'required_with:affiliation_value|nullable',
                'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            
            $permission_arr['chat'] = $request->get('chat')??0;
            $permission_arr['attachment'] = $request->get('attachment')??0;
            $permission_arr['portfolio'] = $request->get('portfolio')??0;
                    
            try{
                if($service){
                    if($request->hasFile("banner_file")){
                        $supported_image = array('gif','jpg','jpeg','png');         
                        $ext =   $request->file("banner_file")->getClientOriginalExtension();
                        if(in_array($ext, $supported_image)){
                            $request['banner'] = $this->uploadFile($request->file("banner_file"), "services")->getFilePath();
                            $this->deleteStorageFile($service->banner);
                        }else{
                            return back()->with('error', 'Please upload an valid file');
                        }
                    } else {
                        $request['banner'] = $service->banner;
                    }
                    if($request->hasFile("web_banner_file")){
                        $supported_image = array('gif','jpg','jpeg','png');         
                        $ext =   $request->file("web_banner_file")->getClientOriginalExtension();
                        if(in_array($ext, $supported_image)){
                            $request['web_banner'] = $this->uploadFile($request->file("web_banner_file"), "services")->getFilePath();
                            $this->deleteStorageFile($service->web_banner);
                        }else{
                            return back()->with('error', 'Please upload an valid file');
                        }
                    } else {
                        $request['web_banner'] = $service->web_banner;
                    }
                    // Promotional Banner
                    if ($request->has('promotional_banner')) {
                        foreach ($request->promotional_banner as $file) {
                            // Store File
                            $folder = 'storage/promotional_banner';
                            $path = storage_path() . '/app/public/promotional_banner/';
                            $file_name = $file->getClientOriginalName();
                            $imageName = $service->id . rand(00000, 99999) . '.' . $file->getClientOriginalExtension();
                            $file->move($path, $imageName);
                            $file_path = $folder.'/'.$imageName;
                            // Media Record
                            $media = Media::create([
                                'type' => 'Service',
                                'type_id' => $service->id,
                                'file_name' => $file_name,
                                'path' => $file_path,
                                'extenstion' => $file->getClientOriginalExtension(),
                                'file_type' => "Document",
                                'tag' => "PromotionalBanner",
                            ]);
                        }
                    }

                    if(!$request->has('is_publish')){
                        $request['is_publish'] = 0;
                    }
                    if(!$request->has('is_featured')){
                        $request['is_featured'] = 0;
                    }
                    if(!$request->has('is_flagship')){
                        $request['is_flagship'] = 0;
                    }
                    if(!$request->has('is_dynamic_rate')){
                        $request['is_dynamic_rate'] = 0;
                    }
                    // $request['permission'] = json_encode($permission_arr,true);          
                    $request['permission'] = $permission_arr;          
                    $chk = $service->update($request->all());

                    return redirect()->route('panel.services.index')->with('success','Record Updated!');
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
            $services = Service::query();
            
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
                    return view('panel.services.load', ['services' => $services])->render();  
                }
    
            return view('panel.services.index', compact('services','category_id'));
        }



        /**
         * Remove the specified resource from storage.
         *
         * @param    int  $id
         * @return  \Illuminate\Http\Response
         */
        public function destroy(Service $service)
        {
        // return $service->id;
        
            
            try{
                if($service){
                // $orderId = OrderItem::where('item_id','=',$service->id)->pluck('order_id');   
                $orderId = Order::where('type_id',$service->id)->pluck('type_id');
                //  $portfolioId = Portfolio::with('service')->get();
                $portfolioId = Service::whereId($service->id)->with('portfolio')->first();
                $portfolioArrId =  $portfolioId->portfolio->pluck('id');
                
                
                if($portfolioArrId->count() > 0){
                    Portfolio::whereIn('id',$portfolioArrId)->delete();
                //    foreach($portfolioArrId as $id){
                //     Portfolio::where('id',$id)->forcedDelete();
                //    }
                    
                }
                //  return $orderId;
                    if(count($orderId) > 0){
                        return back()->with("error","This Service Can't be delete !");
                    }else{
                        $this->deleteStorageFile($service->banner);         
                        $service->delete();
                        return back()->with('success','Service deleted successfully');
                    }  
                
                }else{
                    return back()->with('error','Service not found');
                }
            }catch(Exception $e){
                return back()->with('error', 'There was an error: ' . $e->getMessage());
            }
        }
        public function deleteMedia(Request $request,$id)
        {
            try{
                $media = Media::where('id',$id)->first();
                if($media){
                    unlinkfile($media->path,$media->file_name);  
                    $media->delete();
                    return back()->with('success','Media deleted successfully');
                }else{
                    return back()->with('error','Media not found');
                }
            }catch(Exception $e){
                return back()->with('error', 'There was an error: ' . $e->getMessage());
            }
        }
    }

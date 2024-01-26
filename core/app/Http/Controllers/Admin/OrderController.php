<?php


namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\CaseWorkstreamMessage;
use App\Models\CaseWorkstream;
use App\Models\CaseWorkstreamParticipant;
use App\Models\Order;
use App\Models\WalletLog;
use App\Models\UserInviter;
use App\Models\OrderItem;
use App\Models\Service;
use App\Models\Media;
use App\Models\Payment;
use App\Models\Review;
use App\Models\Payout;
use App\Models\Portfolio;
use App\User;
use App\Models\MailSmsTemplate;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Code;


class OrderController extends Controller
{
    
   

    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
     public function index(Request $request)
     {
         $length = 20;
         if(request()->get('length')){
             $length = $request->get('length');
         }
         $orders = Order::query();
         
         
       //  $service = Service::where('id',$order-)
            // if($request->get('search')){
            //     $orders->where('id','like','%'.$request->search.'%')
            //         ->orWhere('txn_no','like','%'.$request->search.'%')
            //         ->orWhere('amount','like','%'.$request->search.'%');
            // }
           if($request->get('search')){
              $orders->orWhereHas('user',function($q){
                $q->where('id','like','%'.request()->get('search').'%')
                ->orWhere('name','like','%'.request()->get('search').'%')
                ->orWhere('phone','like','%'.request()->get('search').'%')
                ;
              })->orWhereHas('service',function($q){
                $q->where('id','like','%'.request()->get('search').'%')
                ->orWhere('title','like','%'.request()->get('search').'%')
                ->orWhere('slug','like','%'.request()->get('search').'%')
                ;
              })
              ->orWhere('id','like','%'.request()->get('search').'%');
           }
            
            if($request->get('from') && $request->get('to')) {
                $orders->whereBetween('created_at', [\Carbon\Carbon::parse($request->from)->format('Y-m-d').' 00:00:00',\Carbon\Carbon::parse($request->to)->format('Y-m-d')." 23:59:59"]);
                // $orders->whereBetween('created_at', [\Carbon\carbon::parse(now())->format('Y-m-d'),\Carbon\Carbon::parse(now())->format('Y-m-d')]);
            }
            if($request->get('today') =='order'){
                $orders->whereDate('created_at',now()->format('Y-m-d'));
            }

            if($request->get('asc')){
                $orders->orderBy($request->get('asc'),'asc');
            }
            if($request->get('desc')){
                $orders->orderBy($request->get('desc'),'desc');
            }
            if($request->category_id){
                $orders->where('status',$request->category_id);
            }
            if(request()->has('payment_status') && request()->get('payment_status') != null){
                $orders->where('payment_status',request()->get('payment_status'));
            }
            $type = request()->get('type');
            if(request()->has('type') && request()->get('type') != null){
                $orders->where('type',request()->get('type'));
            }
            if(request()->has('partner_id') && request()->get('partner_id')){
                if(UserRole(request()->get('partner_id')) == 'Partner'){
                    $orders->where('partner_id',request()->get('partner_id'));
                }
            }
            if(AuthRole() == 'Partner') {
                $orders = $orders->where('partner_id',auth()->id())->latest()->paginate($length);
            }elseif(AuthRole() == 'User'){
                $orders = $orders->where('user_id',auth()->id())->latest()->paginate($length);
            }else{
                $orders = $orders->withSum(['payment as totalPartnerCommision' => function($query){
                    $query->whereIn('status',[0,1,2]);
                }],'amount')->withSum(['payment as paymentTransferAmt' => function($q){
                    $q->where('status',2);
                }],'amount')->latest()->paginate($length);
            }
            if ($request->ajax()) {
               
                return view('backend.admin.orders.load', ['orders' => $orders,'type'=>$type])->render();  
            }
        return view('backend.admin.orders.index', compact('orders', 'type'));
    }

    
        public function print(Request $request){
            $orders = collect($request->records['data']);
                return view('backend.admin.orders.print', ['orders' => $orders])->render();  
           
        }
     

        public function createStream($id){
           
            try{
                $chat = CaseWorkStream::create([
                    'name'=>auth()->user()->name,
                    'description'=>auth()->user()->name,
                    'author_id'=>auth()->id(),
                    'case_id'=>$id,
                    'status'=>1,
                    'type'=>0,
                 ]);
                 return redirect()->back()->with('success','chat is successfully initialize');
            }catch(Exception $e){
                return back()->with('error', 'There was an error: ' . $e->getMessage());
            }
        }
    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        try{
            return view('backend.admin.orders.create');
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
        $this->validate($request,[
            'phone'     => 'required',
            'service_id'     => 'required',
        ]);
        
        try{
            $user = User::where('phone',$request->phone)->first();
            $service = Service::where('id',$request->service_id)->first();
            $txn = generateUniqueTxn();
            $price = $request->price ?? $service->price;
            $sub_total = $request->price ?? $service->price;
            $total = $request->price ?? $service->price;
            // Address Processing
            $from = systemInvoiceAddress();
            $to = userInvoiceAddress($user->id);
            $permission = $service->permission;
            // service_data 
            if ($service->permission['portfolio'] == 1) {
                $portfolio = Portfolio::where('service_id', $service->id)->get();
            } else {
                $portfolio = null;
            }
            $commission = auth()->user()->commission ?? 20;
            if(AuthRole() == 'Partner'){
                $partnerId = auth()->id();
            }else{
                $partnerId = null;
            }
            $order = Order::create([
                'user_id' => $user->id,
                'type' => 'Service',
                'type_id' => $request->service_id,
                'txn_no' => $user->id,
                'txn_no' => $txn,
                'discount' => null,
                'tax' => null,
                'sub_total' => $sub_total,
                'total' => $total,
                'price' => $price,
                'status' => 1,
                'payment_status' => 1,
                'payment_gateway' => 'RazorPay',
                'remarks' => null,
                'from' => json_encode($from),
                'to' => json_encode($to),
                'service_data' => $portfolio,
                'date' => now()->format('Y-m-d'),
                'permission' => $permission,
                'partner_id' => $partnerId,
                'commission' => $commission,
                'source' => "Web",
            ]);

            // Create Wallet log record for give 1% commission
            $inviter = UserInviter::where('user_id', auth()->id());
            if($inviter->exists()){
                $inviter_id = $inviter->first()->value('inviter_id');
                $exist_wallet_amount = WalletLog::where('user_id',$inviter_id)->sum('amount');
                $inviter_amount = getInviterAmount($total);
                $after_balance = $exist_wallet_amount + $inviter_amount;
                pushWalletLog($inviter_id,'credit',$inviter_amount,$after_balance,'User referral commission credited on your wallet');
            }

            //Send Mail for Admin
            try {
                //code...
                $mailcontent_data = MailSmsTemplate::where('code','=',"admin-order-creation-mail")->first();
                if($mailcontent_data){
                $user = User::find($order->user_id);
                $arr=[
                        '{id}'=> $order->id,
                        '{name}'=>NameById( $user->id),
                        '{date}'=>$order->created_at,
                    ];
                $action_button = null;
                // $email = 'satyamiit04@gmail.com';
                $email = getSetting('admin_email') ?? 'satyamiit04@gmail.com';
                TemplateMail($email,$mailcontent_data,$user->email,$mailcontent_data->type, $arr, $mailcontent_data, $chk_data = null ,$mail_footer = null, $action_button);
                }
            } catch (\Throwable $th) {
                //throw $th;
            }

            //Send mail to User for order place
            try {
                //code...
                $mailcontent_data = MailSmsTemplate::where('code','=',"order-placed")->first();
                if($mailcontent_data){
                $user = User::find($order->user_id);
                $arr=[
                        '{order_id}'=> $order->id,
                        '{name}'=>NameById( $user->id),
                        '{date}'=>$order->created_at,
                    ];
                $action_button = null;
                TemplateMail($user->name,$mailcontent_data,$user->email,$mailcontent_data->type, $arr, $mailcontent_data, $chk_data = null ,$mail_footer = null, $action_button);
                }
            } catch (\Throwable $th) {
                //throw $th;
            }
            
            try {
                // Email send to user
                $mail_data = MailSmsTemplate::where('code','order-placed')->first();
                $arr = [
                        '{name}' => $user->name,
                        '{service}' => $service->title,
                        '{order_id}' => '#OD'.getPrefixZeros($order->id),
                        '{date}' => $order->date,
                    ];
                    customMail($user->name,$user->email,$mail_data,$arr);
            } catch (\Throwable $th) {
                return back()->with('error', 'Order Created but unable to send mail');
            }
            try {
                // Sending Push Notification to Customer
                if($user->fcm_token != null){   
                    $this->fcm()
                    ->setFcmServer(env('FCM_SERVER_KEY'), env('FCM_SENDER_ID'))
                    ->setTokens([$user->fcm_token])
                    ->setTitle('GoFinx')
                    ->setBody('Send you a proposal for '.$service->title)
                    ->send();
                }
            } catch (\Throwable $th) {
                return back()->with('error', 'Order Created but unable to send Push Notification');
            }

            return redirect()->route('panel.orders.ordershow',[$order->id,'active' => 'chat'])->with('success','Order Created Successfully!');
        }catch(Exception $e){            
            return back()->with('error', 'There was an error: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        try{
           return view('backend.admin.orders.summary',compact('order'));
        //    return view('backend.admin.orders.summary',compact('order','reviews'));
        }catch(Exception $e){            
            return back()->with('error', 'There was an error: ' . $e->getMessage());
        }
    }
    public function getUser(Request $request)
    {
        
        try{
           $user = User::where('phone',$request->phone)->where('phone','!=',null)->first();
           if ($user) {
                return response(['user'=>$user,'found'=>1],200);
            }else{
                return response(['found'=>0],200);
            }
            return response(404);
        }catch(Exception $e){            
            return back()->with('error', 'There was an error: ' . $e->getMessage());
        }
    }
    public function getServicePrice(Request $request)
    {
        
        try{
           $service = Service::where('id',$request->id)->first();
           if ($service) {
                return response(['service'=>$service,'found'=>1],200);
            }else{
                return response(['found'=>0],200);
            }
            return response(404);
        }catch(Exception $e){            
            return back()->with('error', 'There was an error: ' . $e->getMessage());
        }
    }

    public function userPortfolioRecode(Order $order)
    {
    
         try{
             return view('backend.admin.orders.user-portfolio-show',compact('order'));
         }catch(Exception $e){            
             return back()->with('error', 'There was an error: ' . $e->getMessage());
         }
    }
    //order show
    public function orderShow(Request $request,$order_id)
    {
         $length = 8;
        // if(authRole() != 'Admin'){
             
        // }
     
        try{
            if($order_id){
                if(AuthRole() == 'Partner'){
                    $orderArr = Order::whereId($order_id)->where('partner_id',auth()->id())->first();
                    if($orderArr){
                        $order = $orderArr;
                    }
                }else{
                    $order = Order::whereId($order_id)->first();
                }
                // $permissions = json_decode($order->permission);
                $permissions = ($order->permission);

                 $service = Service::where('id',$order->type_id)->first();
             
                 $user =  User::whereId($order->user_id)->first();
                
                 $workStream = CaseWorkstream::where('case_id',$order_id)->first();

                 //attachment
                 $attachments = Media::query();
     
                 if($order_id > 0){
                    $attachments->where('type_id',$order_id)->whereType('Order')->whereTag('Attachment');
                 }
                 $attachments = $attachments->paginate($length);

                if($workStream){
                    $message = CaseWorkstreamMessage::whereWorkstreamId($workStream->id)->get();
                }else{
                    $message = null;
                    $workStream = null;
                }

                $customer_review = Review::where('type',Order::class)->where('type_id',$order->id)->where('user_id',$order->user_id)->first();

                $payments = Payment::where('order_id', $order->id)
                ->where('type',Payment::TYPES_MILESTONE)
                ->get();
                return view('backend.admin.orders.show',compact('service','order','message','workStream','user','attachments','permissions','payments','customer_review'));
            }else{
                return back()->with('error', 'Your Service not Found!');
            }
        }catch(Exception $e){            
            return back()->with('error', 'There was an error: ' . $e->getMessage());
        }
    }


    //fileManager


    public function fileManager(Request $request){
        
        $order_id = $request->order_id;
        $order_data = Order::whereId($order_id)->firstOrFail();
       
        try{
          
             // Check Folder Avilablity
            makeUserServiceOrderDirectory($order_data->user_id, $order_data->type_id, $order_data->id, $prefix = 'O');
            
            foreach($request->file('files') as $file){
                // Store File
            
                $folder = $order_data->user_id.'/S'.$order_data->type_id.'/O'.$order_data->id;
                $file_prefix = $order_data->user_id.'-S'.$order_data->type_id.'-O'.$order_data->id;
                $path = storage_path() . '/app/public/files/'.$folder;
                $file_name = $file->getClientOriginalName();
                $imageName = $file_prefix .$order_data->user_id.rand(00000, 99999).'.' . $file->getClientOriginalExtension();
                $file->move($path, $imageName);
                $file_path = $folder.'/'.$imageName;
                // Media Record
               $media = Media::create([
                    'type' => 'Order',
                    'type_id' => $order_id,
                    'category_id' => $request->category_id,
                    'file_name' => $file_name,
                    'path' => $file_path,
                    'extenstion' => $file->getClientOriginalExtension(),
                    'file_type' => "Document",
                    'tag' => "Attachment",
                ]);
            }
            return back()->with('success','Attachment Saved!');

        }catch(Exception $e){
            return back()->with('error', 'There was an error: ' . $e->getMessage());
        }
       

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     * // $service_title = Service::where('id',1)->first();
     */
    public function invoice(Order $order)
    {   

        try{
           
             $promo_code = Code::whereCode( $order->promo_code)->first();
              
             $from_invoice =  json_decode($order->from);
             $to_invoice = json_decode($order->to);
             
             
           // return view('backend.admin.orders.invoice',compact('order','order_items'));
           return view('backend.admin.orders.invoice',compact('order','promo_code','from_invoice','to_invoice'));
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
    public function update(Request $request,Order $order)
    {
        
      
        $this->validate($request, [
            'user_id'     => 'required',
            'txn_no'     => 'required',
            'discount'     => 'sometimes',
            'tax'     => 'sometimes',
            'sub_total'     => 'required',
            'total'     => 'required',
            'status'     => 'sometimes',
            'payment_gateway'     => 'sometimes',
            'remarks'     => 'sometimes',
            'from'     => 'sometimes',
            'to'     => 'sometimes',
        ]);
                
        try{
                                   
            if($order){
                $request['status'] = 0;      
                       
                $chk = $order->update($request->all());

                return redirect()->route('panel.orders.index')->with('success','Record Updated!');
            }
         
            return back()->with('error','Order not found');
        }catch(Exception $e){            
            return back()->with('error', 'There was an error: ' . $e->getMessage());
        }
    }

   public function updateStatus(Request $request,$id){
        try{
                $order =  Order::where('id', $id)->with('user')->first();
                $service =  Order::where('id', $id)->with('service')->first();
                if($request->orderStatus > 0 && $id != 0){
                    $order->update([
                        'status' => $request->orderStatus
                    ]);
                }

                /* notification to user */
                    $o_status = orderStatus($request->orderStatus)['name'] ?? 'Completed';
                    $o_id = "#OD".getPrefixZeros($order->id);
                    $data  = [
                        'user_id' =>$order->user_id,
                        'title' =>"Order Updated",
                        'notification' => "Your order $o_id marked as $o_status",
                        'link' => "#"
                    ];
                    pushOnSiteNotification($data);   
                /* notification to user */


                /* mail to  user*/
                // Payout Create
                    if($request->orderStatus == 4){
                        $mail_data =MailSmsTemplate::where('code','Order Updated')->first();
                        $arr = [
                                '{user_name}' => $order->user->name,
                                '{service_title}' => $service->service->title,
                            ];
                        customMail($order->user->name,$order->user->email,$mail_data,$arr);
                    }    
                /* mail to user*/
              
                return back()->with('success','Record Updated!');
            }catch(Exception $e){            
                return back()->with('error', 'There was an error: ' . $e->getMessage());
            }      
      
   }
   public function updatePaymentStatus(Request $request,$id){
    try{
            $order =  Order::where('id', $id)->with('user')->first();
            $order->payment_status;
            if($order->payment_status == 1 && $id != 0){
                $order->update([
                    'payment_status' => 2
                ]);
            }else{
                $order->update([
                    'payment_status' => 1
                ]);
            }
            return back()->with('success','Record Updated!');
        }catch(Exception $e){            
            return back()->with('error', 'There was an error: ' . $e->getMessage());
        }      
  
}

  public function orderStatus(Request $request,$status){
      
      
      $length = 10;
      if(request()->get('length')){
          $length = $request->get('length');
      }
      $orders = Order::query();
      
         if($request->get('search')){
             $orders->where('id','like','%'.$request->search.'%')
                 ->orWhere('txn_no','like','%'.$request->search.'%')
                 ->orWhere('amount','like','%'.$request->search.'%');
         }
       
         
         if($request->get('from') && $request->get('to')) {
             $orders->whereBetween('created_at', [\Carbon\carbon::parse($request->from)->format('Y-m-d'),\Carbon\Carbon::parse($request->to)->format('Y-m-d')]);
         }

         if($request->get('asc')){
             $orders->orderBy($request->get('asc'),'asc');
         }
         if($request->get('desc')){
             $orders->orderBy($request->get('desc'),'desc');
         }
         if($status == 0){
            $orders->where('status','<',3);
        }
        if($status > 0){
            $orders->where('status',$status);
        }
        
         $orders = $orders->paginate($length);

         if ($request->ajax()) {
             return view('backend.admin.orders.load', ['orders' => $orders,'status'=>$status])->render();  
         }

     return view('backend.admin.orders.index', compact('orders'));
  }


  public function userInvoice(Request $request, $order_id){
   
    try{
        $order = Order::whereId($order_id)->firstOrFail();
        $promo_code = Code::whereCode( $order->promo_code)->first();
         
        $from_invoice =  json_decode($order->from);
        $to_invoice = json_decode($order->to);
        
        
        // return view('backend.admin.orders.invoice',compact('order','order_items'));
        return view('backend.admin.orders.invoice',compact('order','promo_code','from_invoice','to_invoice'));
    }catch(Exception $e){            
        return back()->with('error', 'There was an error: ' . $e->getMessage());
    }
  }

    /**
     * Remove the specified resource from storage.
     *
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {

        try{
            if($order){
                foreach($order->items as $item){
                    $item->delete();
                }                           
                $order->delete();
                return back()->with('success','Order deleted successfully');
            }else{
                return back()->with('error','Order not found');
            }
        }catch(Exception $e){
            return back()->with('error', 'There was an error: ' . $e->getMessage());
        }
    }
    public function deleteImg($media_id)
    {
        try{
            if($media_id){
                $media = Media::where('id',$media_id)->first();
          
               try {
                unlink(storage_path('app/public/files/'.$media->path));
               } catch (\Throwable $th) {
                //throw $th;
               }
                $media->delete();
                return back()->with('success','Media deleted successfully');
            }else{
                return back()->with('error','Media not found');
            }
        }catch(Exception $e){
            return back()->with('error', 'There was an error: ' . $e->getMessage());
        }
    }


    public function userOrderAttachment($order_id, $user_id){
        // return "s";
        $user = User::whereId($user_id)->first();
        if(!$user){abort(404);}
        auth()->loginUsingId($user_id);
       
         //attachment
       try{
        $check = false;
        $order = Order::whereId($order_id)->where('user_id',$user->id)->first();

        if($order->user_id != $user_id){
            abort(404);
        }

        $attachments = Media::query();
        if($order != null){
           $order_id = $order->id;
           $attachments->where('type_id',$order_id)->whereType('Order')->whereTag('Attachment');
           
           $attachments = $attachments->Simplepaginate(10);
          $check = true;
        
           return view('backend.admin.orders.userOrderAttachment',compact('attachments','order_id','check'));
       
        }else{
            
            return view('backend.admin.orders.userOrderAttachment',compact('check'));
        }
        
       }catch(Execption $e){
         return back()->with('error', 'There was an error: ' . $e->getMessage());
       }
    }
    public function assignTo(Request $request,Order $order)
    {
        $this->validate($request, [
            'commission'     => 'max:100',
        ]);
        try{
            if($order){
                $order->update([
                    'partner_id'=> $request->partner_id,
                    'commission'=> $request->commission
                ]);

            //Send Mail for Partner
            try {
                //code...
                $mailcontent_data = MailSmsTemplate::where('code','=',"assign-project-to-partner")->first();
                if($mailcontent_data){
                $user = User::find($order->partner_id);
                $arr=[
                        '{id}'=> $order->id,
                        '{name}'=>NameById( $user->id),
                        '{ordername}'=>$order->name,
                        '{date}'=>$order->created_at,
                    ];
                $action_button = null;
                TemplateMail($user->email,$mailcontent_data,$user->email,$mailcontent_data->type, $arr, $mailcontent_data, $chk_data = null ,$mail_footer = null, $action_button);
                }
            } catch (\Throwable $th) {
                //throw $th;
            }
                return back()->with('success','Partner Assigned successfully');
            }else{
                return back()->with('error','Order not found');
            }
        }catch(Exception $e){
            return back()->with('error', 'There was an error: ' . $e->getMessage());
        }
    }
    public function changeAssignTo(Request $request,Order $order)
    {
        try{
            if($order){
                $order->update([
                    'partner_id'=> null,
                    'commission'=> null
                ]);
                return back();
            }else{
                return back()->with('error','Order not found');
            }
        }catch(Exception $e){
            return back()->with('error', 'There was an error: ' . $e->getMessage());
        }
    }
    public function paymentStore(Request $request,Order $order)
    {
        try{
            if($order){
                foreach ($request->payments as $key => $payment) {
                    Payment::create([
                        'order_id' => $order->id,
                        'user_id' => $order->partner_id,
                        'r_payment_id' => null,
                        'status' => Payment::STATUS_PENDING_GOFINX_APPROVAL,
                        'type' => Payment::TYPES_MILESTONE,
                        'remark' => 'Milestone for order:'.$order->getPrefix(),
                        'month' => \Carbon\Carbon::parse($payment['month'])->format('Y-m'),
                        'amount' => $payment['amount'],
                    ]);
                }
                return back()->with('success','Payment added successfully');

            }else{
                return back()->with('error','Order not found');
            }
        }catch(Exception $e){
            return back()->with('error', 'There was an error: ' . $e->getMessage());
        }
    }

    public function placeCall(Request $request)
    {
        try{
            if(!request()->has('user_id')){
                return response()->json(['type'=> $request->type,'status' => 'error','message'=>'User not Found!']);
            }
            $user = User::where('id',$request->user_id)->first();
            $from_number = auth()->user()->phone;
            $mobile_number = $user->phone;
            if($from_number == null){
                return response()->json(['type'=> $request->type,'status' => 'error','message'=>'This user dose not have any phone number.']);
            }
            if($mobile_number == null){
                return response()->json(['type'=> $request->type,'status' => 'error','message'=>'Please add your phone number first.']);
            }
            $phone = callMasking($from_number,$mobile_number);
            return response()->json(['type'=> $request->type,'status' => 'success','message'=>'Phone number found','phone'=>$phone]);
        }catch(Exception $e){            
            return back()->with('error', 'There was an error: ' . $e->getMessage());
        }
    }
  
}

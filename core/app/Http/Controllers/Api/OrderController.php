<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Code;
use App\Models\MailSmsTemplate;
use App\Models\Media;
use App\Traits\CanSendSMS;
use App\Traits\ControlOrder;
use Exception;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Payment;
use App\Models\UserReward;
use App\Models\Order;
use App\Models\Portfolio;
use App\Models\CaseWorkstream;
use App\Models\CaseWorkstreamMessage;
use App\Models\Transaction;
use App\User;
use App\Models\Category;
use App\Models\WalletLog;
use App\Models\UserInviter;
use Razorpay\Api\Api;

class OrderController extends Controller
{
    use CanSendSMS,ControlOrder;
    //order status
    public function status(Request $request)
    {
        try {
            $page = $request->has('page') ? $request->get('page') : 1;
            $limit = $request->has('limit') ? $request->get('limit') : $this->resultLimit;
            $orders = Order::query();
            if ($request->get('status')) {
                $orders->where('status', $request->get('status'));
            }
            $orders->where('user_id', auth()->id());
            $orders = $orders->with(['service' => function ($q) {
                $q->select(['id', 'title', 'banner','service_duration']);}])
            ->with('review')
            ->limit($limit)->offset(($page - 1) * $limit)
                ->when($request->has('my_service') && $request->get('my_service') == 1, function ($q) {
                    $q->where('payment_status', 2);
                })
                ->latest()
                ->get()
                ->makehidden(['deleted_at', 'type', 'from', 'to', 'service_data', 'remarks']);
            return $this->success($orders);
        } catch (\Exception $e) {
            return $this->error('Service Not Found!' . $e->getMessage());
        }

    }

    //order detail
    public function detail($id)
    {
        try {
            $order_id = $id;
            if ($order_id > 0) {
                $order_detail = Order::where('user_id', auth()->id())->where('id', $order_id)->with('service')->get();
                // return $order_detail;
                if ($order_detail->count() > 0) {
                    return response([
                        'data' => $order_detail,
                        'message' => "Order Created Successfully!",
                        'success' => 1
                    ]);
                } else {
                    return $this->error('Order Not Exist !');
                }

            } else {
                return $this->error('Order Not Exist !');
            }


        } catch (\Exception $e) {
            info($e->getMessage());
            return $this->error('Something went wrong!');
        } catch (\Error $e) {
            info($e->getMessage());
            return $this->error('Something went wrong!');
        }
    }


    //order chat store
    public function store(Request $request, $id)
    {
        try {
            $order_id = $id;
            if ($order_id > 0) {
                $request->validate([
                    'message' => 'required'
                ]);

                if ($request->get('workstream_id')) {
                    $storeChat = CaseWorkstreamMessage::create([
                        'workstream_id' => $request->workstream_id,
                        'user_id' => auth()->id(),
                        'type' => $request->type ?? 0,
                        'message' => $request->message
                    ]);
                } else {
                    $chk = CaseWorkstream::where('case_id', $order_id)->first();
                    if ($chk) {
                        return $this->error('Your chat already initiated please send workstream Id!');
                    } else {
                        $order = Order::find($order_id);
                        $room = CaseWorkstream::create([
                            'author_id' => auth()->id(),
                            'case_id' => $order_id,
                            'status' => 1,
                            'type' => 0,
                            'name' => $order->service->name ?? auth()->user()->name . rand(000, 999),
                            'description' => $order->remarks,
                        ]);
                        $storeChat = CaseWorkstreamMessage::create([
                            'workstream_id' => $room->id,
                            'user_id' => auth()->id(),
                            'type' => $request->type ?? 0,
                            'message' => $request->message
                        ]);
                    }
                }
                return $this->successMessage('Message send Successfully');

            } else {
                return $this->error('Something went wrong!');
            }

        } catch (\Exception $e) {
            info($e->getMessage());
            return $this->error('Something went wrong!');
        } catch (\Error $e) {
            info($e->getMessage());
            return $this->error('Something went wrong!');
        }
    }


    public function chats(Request $request, $id)
    {
        try {
            $order_id = $id;
            if ($order_id > 0) {
                $page = $request->has('page') ? $request->get('page') : 1;
                $limit = $request->has('limit') ? $request->get('limit') : $this->resultLimit;

                $case_workstream_id = CaseWorkstream::where('case_id', $id)->first();

                $case_workstream_message = CaseWorkstreamMessage::where('workstream_id', $case_workstream_id)
                    ->latest()->limit($limit)->offset(($page - 1) * $limit)->get();
                return $this->success($case_workstream_message);

            } else {
                return $this->error('Something went wrong!');
            }

        } catch (\Exception $e) {
            info($e->getMessage());
            return $this->error('Something went wrong!');
        } catch (\Error $e) {
            info($e->getMessage());
            return $this->error('Something went wrong!');
        }
    }

    //order portfolio
    public function portfolio($id)
    {
        $order_id = $id;
        try {
            $service_data = Order::whereId($order_id)->value('service_data');

            if ($service_data == null) {
                return $this->error('Portfolio Not Exist');
            } else {
                return $this->success($service_data);
            }

        } catch (\Exception $e) {
            info($e->getMessage());
            return $this->error('Something went wrong!');
        } catch (\Error $e) {
            info($e->getMessage());
            return $this->error('Something went wrong!');
        }
    }

    public function checkoutShow($id)
    {
        try {
            $order_id = $id;
            $order = Order::where('id', $order_id)->with('service')->first();

            if ($order->service->document != null) {
                $order->service->documents = $order->service->document;
                $order->service->document = collect(Category::select('id','name')->whereIn('id', $order->service->document)->pluck('name')->toArray())->join(', ');
            }else{
                $order->service->documents = $order->service->document;
                $order->service->document = null;
            }

            return $this->success($order);
        } catch (\Exception $e) {
            info($e->getMessage());
            return $this->error('Something went wrong!');
        } catch (\Error $e) {
            info($e->getMessage());
            return $this->error('Something went wrong!');
        }
    }


    public function checkout(Request $request, $id){
        try {
            $service_data = Service::whereId($id)->first();
            if ($service_data) {
                if ($service_data->document != null) {
                    $service_data->documents = $service_data->document;
                    $service_data->document = collect(Category::select('id','name')->whereIn('id',$service_data->document)->pluck('name')->toArray())->join(', ');
                }else{
                    $service_data->documents = $service_data->document;
                    $service_data->document = null;
                }
                if ($service_data->permission['portfolio'] == 1) {
                    $portfolio_data = Portfolio::where('service_id', $service_data->id)->get();
                } else {
                    $portfolio_data = null;
                }
                $order_from = User::whereId(auth()->id())->first();
                $order_to = User::whereId(auth()->id())->first();
                // $portfolio = portfolio::where('service_id',$service_data->id)->get();
                // return $portfolio;
                $txn = generateUniqueTxn();
                $price = $service_data->price;
                $sub_total = $service_data->price;
                $total = $service_data->price;

                // Address Processing
                $from = systemInvoiceAddress();
                $to = userInvoiceAddress(auth()->id());
                $permission = $service_data->permission;

                // Create Order
                $order = new Order;
                $order['user_id'] = auth()->id();
                $order['type'] = "Service";
                $order['type_id'] = $service_data->id;
                $order['txn_no'] = $txn;
                $order['discount'] = null;
                $order['tax'] = null;
                $order['sub_total'] = $sub_total;
                $order['total'] = $total;
                $order['price'] = $price;
                $order['status'] = Order::STATUS_ABOUT_TO_START;
                $order['payment_status'] = Order::PAYMENT_STATUS_UNPAID;
                $order['payment_gateway'] = 'RazorPay';
                $order['remarks'] = null;
                $order['from'] = json_encode($from);
                $order['to'] = json_encode($to);
                $order['service_data'] = $portfolio_data;
                $order['date'] = now()->format('Y-m-d');
                $order['permission'] = $permission;
                $order['referred_by'] = $request->referred_by ?? 0;
                $order['source'] = "App";
                $order->save();
                
                
                // Document 
                // $order['document'] = $service_data->document;
                // $order['documents'] = $service_data->documents;

                /* notification start  admin*/
                //  $data  = [
                //     'user_id' =>auth()->id(),
                //     'title' =>"New Order Created",
                //     'notification' => auth()->user()." has created new order.",
                //     'link' => route('panel.orders.show',auth()->id())
                // ];
                // pushOnSiteNotification($data);
                /* notification end admin*/

                /* notification start  user*/
                // $data  = [
                //     'user_id' =>auth()->id(),
                //     'title' =>"Your Order is Created",
                //     'notification' =>"You have created new order.",
                //     'link' => "#"
                // ];
                // pushOnSiteNotification($data);
                /* notification end user*/
                // \App\User::role(2)->first()->id;

                /* mail start  user*/
                // $mail_data =MailSmsTemplate::where('code','Order Created')->first();
                // $arr = [
                //         '{customer_name}' => $order->user->name,
                //         '{service_name}' => "My Service",
                //         '{sub_total}' => format_price($order->sub_total),
                //         '{total}'=>format_price($order->total),
                //         '{discount}'=>format_price($order->discount),
                //         '{promocode}'=>$order->promo_code
                //     ];
                // customMail(auth()->name(),"user@test.com",$mail_data,$arr);
                /* mail end user*/


                // $folderName = 'U'.$id.'/';
                // $path =   storage_path('app/public/services/'.$folderName);
                // if(!file_exists($path)){
                //     makeUserDirectory($path);
                // }
                // makeServiceDirectory()
                $order = $order->makeHidden('service');
                return $this->success($order);
            } else {
                return response([
                    'success' => 0,
                    'message' => "Service not exists"
                ]);
            }
        } catch (Exception $e) {
            return $this->error('Something Went Wrong !');
        }
    }


    //promocode validate
    public function applyPromo(Request $request){
        if ($request->has('code') && !is_null($request->get('code'))) {
            $promoCode = Code::where('code', $request->get('code'))->whereDate('expires_at', '>', now())->first();
            if (!$promoCode) {
                return $this->error("We are sorry, but this promo code is no longer valid or expired. Please choose another one.");
            } else {
                $max_use = Order::where('promo_code', $promoCode->code)->where('payment_status', 2)->count();
                if ($max_use > $promoCode->max_uses) {
                    return $this->error(" This promo code Has Exceed There Limits!");
                } else {
                    $order = Order::find($request->get('order_id'));
                    if ($order) {
                        if($order->sub_total > 450){
                            if ($promoCode->type == 0) {
                                $discountAmount = ($order->sub_total * $promoCode->value) / 100;
                                if($order->sub_total < $discountAmount){
                                    $discountAmount = $order->sub_total;
                                }
                            } elseif ($promoCode->type == 1) {
                                $discountAmount = $promoCode->value;
                                if($order->sub_total < $discountAmount){
                                    $discountAmount = $order->sub_total;
                                }
                            }
                            $order->promo_code = $request->get('code');
                            $order->discount = $discountAmount;
                            $order->total = $order->sub_total - $discountAmount;
                            $order->save();
                            return $this->successMessage('Promo code applied!');
                        } else {
                            return $this->error("Orders should have a minimum value of ₹450.");
                        }
                    } else {
                        return $this->error("Order not found!");
                    }
                }
            }
        } else {
            $order = Order::find($request->get('order_id'));
            $order->discount = null;
            $order->promo_code = null;
            $order->total = $order->sub_total;
            $order->save();
            return $this->successMessage("Promo code removed!");
        }
    }

    public function createStream($id){
        try {
            $chkOrderId = Order::whereId($id)->where('user_id', auth()->id())->first();

            if ($chkOrderId != null) {
                $chkstream = CaseWorkStream::where('case_id', $id)->first();
                if ($chkstream != null) {
                    return back()->with('error', 'There was an error: ');
                } else {
                    $chat = CaseWorkStream::create([
                        'name' => auth()->user()->name,
                        'description' => auth()->user()->name,
                        'author_id' => auth()->id(),
                        'case_id' => $id,
                        'status' => 1,
                        'type' => 0,
                    ]);
                    return $this->successMessage('Your chat is initialized');
                }
            } else {
                return back()->with('error', 'There was an error: ');
            }

        } catch (Exception $e) {
            return back()->with('error', 'There was an error: ' . $e->getMessage());
        }
    }

    public function sendSMS(Request $request){
        try{
            $url = "http://dev.gofinx.com/app";
            $inviter_amount = '30';
            $phone = '6266554669';
            $full_name = "AnjaliChourasiya";
            $message = 'Dear ' . $full_name . ', "Greetings! Your have earned Rs ' . $inviter_amount . '. Click here ' . $url . ' to redeem"' . " \nTeam GoFinx.com";

            // Send SMS for inviter commission
            $this->sms()
            ->to($phone)
            ->template('1707167482064870593')
            ->setMessage($message)
            ->send();
            return 'done';
        }catch(Exception $e){

        }
    }
    public function capturePaymentAndUpdateOrder(Request $request){
        // Place New Order
       return $data = $this->createOrder($request);
    }


    public function attachments(Request $request, $order_id)
    {
        try{
            $order = Order::whereId($order_id)->where('user_id', auth()->id())->first();

            $attachments = Media::query();
            $order_id = $order->id;
            $attachments->where('type_id', $order_id)->where('type', 'Order')->whereTag('Attachment');
            $attachments = $attachments->get();
            return $this->success($attachments);

        }catch(\Exception $e){
            return $this->error("Something went wrong. " . $e->getMessage(), 200);
        }
    }

    public function deleteAttachment($id)
    {
        Media::where('id', $id)->delete();
        return $this->successMessage('Attachment deleted successfully.');
    }

    public function storeAttachments(Request $request)
    {
        $order_id = $request->order_id;
        $order_data = Order::whereId($order_id)->firstOrFail();

        try{
            // Check Folder Avilablity
            makeUserServiceOrderDirectory($order_data->user_id, $order_data->type_id, $order_data->id);

            foreach ($request->file('files') as $file) {
                // Store File
                $folder = $order_data->user_id . '/S' . $order_data->type_id . '/O' . $order_data->id;
                $file_prefix = $order_data->user_id . '-S' . $order_data->type_id . '-O' . $order_data->id;
                $path = storage_path() . '/app/public/files/' . $folder;
                $file_name = $file->getClientOriginalName();
                $imageName = $file_prefix . $order_data->user_id . rand(00000, 99999) . '.' . $file->getClientOriginalExtension();
                $file->move($path, $imageName);
                $file_path = $folder . '/' . $imageName;
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
            return $this->successMessage('Attachment saved.');

        }catch(\Exception | \Error $e){
            return $this->error('There was an error: ' . $e->getMessage(), 200);
        }
    }
    
    public function getAttachmentCategoryList(Request $request)
    {
        $service = Service::where('id', Order::where('id',$request->id)->where('type', 'Service')->value('type_id'))->first();
        
        if ($service != null && is_array($service->document)) {
            $catIds = $service->document;
        }else{
            $catIds = [];
        }
        $categories = Category::where('category_type_id',23)->whereIn('id', $catIds)->select('id','name')->get();
        return response([
            'message' => 'Success',
            'status' => 'success',
            'data'    => $categories,
        ]);

    }
    public function getOrderByStatus(Request $request)
    {
        if(request()->has('referred_by') && request()->get('referred_by') != null) {
            $service_ids = Order::where('referred_by',request()->get('referred_by'))->whereBetween('created_at', [\Carbon\Carbon::parse(request()->get('from'))->format('Y-m-d'),\Carbon\Carbon::parse(request()->get('to'))->format('Y-m-d')])->distinct('type_id')->pluck('type_id');

            $services = Service::whereIn('id',$service_ids)->select(['id','title'])->get();
            
            // $service = [];
            foreach ($services as $key => $service) {
                $service['paid_orders'] = Order::whereTypeId($service->id)
                ->where('referred_by',request()->get('referred_by'))
                ->whereBetween('created_at', [\Carbon\Carbon::parse(request()->get('from'))->format('Y-m-d'),\Carbon\Carbon::parse(request()->get('to'))->format('Y-m-d')])
                ->where('payment_status',Order::PAYMENT_STATUS_PAID)->get()->count();
                
                $lead_orders = Order::whereTypeId($service->id)
                ->where('referred_by',request()->get('referred_by'))
                ->whereBetween('created_at', [\Carbon\Carbon::parse(request()->get('from'))->format('Y-m-d'),\Carbon\Carbon::parse(request()->get('to'))->format('Y-m-d')])
                ->where('payment_status',Order::PAYMENT_STATUS_UNPAID)->get()->count();

                $service['lead_orders'] = $service['paid_orders'] + $lead_orders;

                $service['commission_sum'] = Transaction::whereUserId(auth()->user()->id)->whereServiceId($service->id)->whereType('earning')->get()->sum('amount');
            }
            return response([
                'message' => 'Success',
                'status' => 'success',
                'data' => $services,
            ]);
        }
        return $this->error('Please Provide a Reference');
    }
    public function forcePay(Request $request,$id)
    {
        $order = Order::where('id',$id)->first();
        if ($order) {

            // Check status 
            if($order->payment_status == Order::PAYMENT_STATUS_PAID){
                return $this->error('Order Already Paid.');
            }

            $order->update(['payment_status' => Order::PAYMENT_STATUS_PAID]);
            return $this->successMessage('Order Paid.');
        } else {
            return $this->error('Order not found.');
        }
        

    }
}

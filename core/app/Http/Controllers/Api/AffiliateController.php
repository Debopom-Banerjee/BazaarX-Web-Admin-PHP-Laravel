<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\UserInviter;
use App\Models\Slider;
use App\Models\Service;
use App\Traits\CanSendSMS;
use App\Models\Faq;
use App\Models\Payment;
use App\Models\WalletLog;
use App\Models\CaseWorkstream;
use App\Models\CaseWorkstreamMessage;
use App\Models\Order;

class AffiliateController extends Controller
{    
    use CanSendSMS;
   public function home(Request $request)
    {   
        try {
            $user = User::where('id',auth()->id())->first();
            $wallet_balance = Payment::whereUserId($user->id)->sum('amount');
            $inviterCount = UserInviter::where('inviter_id', auth()->id())->count();
            $serviceCount = Service::where('is_publish', 1)->count();
            
            $order = Order::where('referred_by',$user->id)
            ->where('payment_status',Order::PAYMENT_STATUS_PAID)->get();

            $lifeLimeSales = $order->count();
            $sales_volume = $order->sum('total');

            $reviews = Slider::whereSliderTypeId(5)->select('id','title','description','slider_type_id')->inRandomOrder()->limit(7)->get();

            $videoTutorials = Slider::whereSliderTypeId(6)->select('id','title','description','slider_type_id','link','image','app_link')->inRandomOrder()->limit(7)->get();

            $banners = Slider::whereSliderTypeId(4)->select('id','title','slider_type_id','image','app_link')->inRandomOrder()->limit(5)->get();
            $search = Service::where('is_publish', 1)->inRandomOrder()->get(['id', 'title', 'banner']);
            $services = Service::select(['id', 'title', 'banner', 'affiliation_type', 'affiliation_value', 'affiliation_desc', 'is_publish', 'category_id','is_flagship'])
            ->where('is_publish', 1)
            ->where('is_flagship', 1)
            ->latest()
            ->get()
            ->take(10);


            $faqs = Faq::where('category_id', 44)->get();

            $current_month_amount = Payment::where('user_id',auth()->id())
            ->whereMonth('created_at',now()->format('m'))
            ->sum('amount');

            $order_ids = Order::where('user_id',auth()->id())->whereNotIn('status', [Order::STATUS_CANCELLED, Order::STATUS_COMPLETED])->where('payment_status',Order::PAYMENT_STATUS_PAID)->pluck('id');

            $caseWorkstream_ids = CaseWorkstream::whereIn('case_id',$order_ids)->pluck('id');
            $workstreamMessage = CaseWorkstreamMessage::whereIn('workstream_id',$caseWorkstream_ids)->latest()->first();
            $is_readed = 1;
            if($workstreamMessage){
                if($workstreamMessage->user_id != auth()->id()){
                    $is_readed = 0;
                }else{
                    $is_readed = 1;
                }
            }
            return $this->success([
                'total_wallet_balance'=>$wallet_balance,
                'total_inviter'=>$inviterCount,
                'total_service'=>$serviceCount,
                'life_time_sales'=>$lifeLimeSales,
                'sales_volume'=>$sales_volume,
                'current_month_amount'=>$current_month_amount,
                'reviews'=>$reviews,
                'video_tutorials'=>$videoTutorials,
                'banners'=>$banners,
                'search' => $search,
                'services' => $services,
                'faqs' => $faqs,
                'is_readed' => $is_readed,
            ]);
        } catch (\Throwable $th) {
            return $this->error("Error: " . $th->getMessage());
        }
    }
    public function showSalesVolume(Request $request)
    {   
        try {
            $orders = Order::select('id','type_id','user_id','referred_by','total','txn_no','commission','price','created_at')->where('referred_by',auth()->user()->id)
            ->where('payment_status',Order::PAYMENT_STATUS_PAID)
            ->with('service', function($q){
                $q->select('title','id');
            })
            ->with('user', function($q){
                $q->select('name','last_name','id');
            })
            ->latest()->get();
            return $this->success([
                'orders'=>$orders
            ]);
        } catch (\Throwable $th) {
            return $this->error("Error: " . $th->getMessage());
        }
    }
}

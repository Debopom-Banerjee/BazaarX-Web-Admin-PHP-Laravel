<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\UserInviter;
use App\Models\Service;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\Review;

class AffiliateController extends Controller
{
    
    public function home(Request $request)
    {   
        try {
            $user = User::where('id',auth()->id())->first();
            $wallet_balance = $user->wallet_balance;
            $inviterCount = UserInviter::where('user_id', auth()->id())->count();
            $serviceCount = Service::where('is_publish', 1)->count();

            $service_ids = Order::where('referred_by',auth()->id())
            ->pluck('type_id');
            $lifeLimeSales = Transaction::whereUserId(auth()->user()->id)->whereIn('service_id',$service_ids)->whereType('earning')->get()->sum('amount');

            $sales_volume = Service::whereIn('id',$service_ids)
            ->sum('affiliation_value'); 

            $reviews = Review::select('id','name','email','description','rating')->get();
            return $this->success([
                'total_wallet_balance'=>$wallet_balance,
                'total_inviter'=>$inviterCount,
                'total_service'=>$serviceCount,
                'life_time_sales'=>$lifeLimeSales,
                'sales_volume'=>$sales_volume,
                'reviews'=>$reviews,
            ]);
        } catch (\Throwable $th) {
            return $this->error("Error: " . $th->getMessage());
        }
    }
    public function dynamicLinkGenerate(Request $request,$id)
    {   
        try {
            $request->validate([
                'amount' => 'required',
            ]);
            $service = Service::where('id',$id)->first();
            if(!$service){
                return $this->error('Service not found');
            }
            $generated_link = env('APP_URL').'api/v1/service/' . $id.'?amount='.$request->amount;
            return $this->success([
                'generated_link'=>$generated_link,
            ]);
        } catch (\Throwable $th) {
            return $this->error("Error: " . $th->getMessage());
        }
    }
    public function showSalesVolume(Request $request)
    {   
        try {
            $service_ids = Order::where('referred_by',auth()->id())
            ->pluck('type_id');
            $services = Service::whereIn('id',$service_ids)
            ->select('id','category_id','title','affiliation_value','created_at','price','mrp')
            ->with('category',function($q){
                $q->select('id','name');
            })
            ->get(); 
            return $this->success([
                'services'=>$services,
            ]);
        } catch (\Throwable $th) {
            return $this->error("Error: " . $th->getMessage());
        }
    }
}

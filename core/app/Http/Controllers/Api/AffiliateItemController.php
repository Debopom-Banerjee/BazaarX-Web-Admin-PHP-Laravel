<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AffiliateItem;

class AffiliateItemController extends Controller
{
    
    public function generateShareableUrl(Request $request)
    {   
        if ($request->service_id == null) {
            return $this->error('Please provide service id');
        }
        if ($request->user_id == null) {
            return $this->error('Please provide user id');
        }
        if ($request->amount == null) {
            return $this->error('Please provide amount');
        }
        $exist_affiliate_item = AffiliateItem::where('service_id',$request->service_id)->where('user_id',$request->user_id)->where('amount',$request->amount)->first();
        if ($exist_affiliate_item) {
            $exist_affiliate_item->update(['view' => $exist_affiliate_item->view + 1]);
            if($exist_affiliate_item->link == null){
                $url = route('guest-checkout.index',$exist_affiliate_item->code);
                $exist_affiliate_item->update(['link' => $url]);
            }
            return $this->success($exist_affiliate_item->link);
        }
        $affiliateItem = AffiliateItem::create([
            'user_id' => $request->user_id,
            'service_id' => $request->service_id,
            'amount' => $request->amount,
            'code' => getUniqueCode(),
            'view' => 1,
        ]);
        $url = route('guest-checkout.index',$affiliateItem->code);
        $affiliateItem->update(['link' => $url]);
        return $this->success($url);
    }
}

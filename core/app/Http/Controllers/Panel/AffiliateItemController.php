<?php


namespace App\Http\Controllers\Panel;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\AffiliateItem;

class AffiliateItemController extends Controller
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


        $affiliate_items = AffiliateItem::query();

        if($request->has('user_id') && $request->get('user_id') != null) {
            $affiliate_items->where('user_id',$request->get('user_id'));
        }
        if($request->get('search')){
            $affiliate_items->where('id','like','%'.$request->search.'%')
                    ->orWhere('amount','like','%'.$request->search.'%')
                    ->orWhere('code','like','%'.$request->search.'%')
                    ->orWhereHas('user',function($query) use($request){
                        $query->where('name','like','%'.$request->search.'%');
                    })
                    ->orWhereHas('service',function($query) use($request){
                        $query->where('title','like','%'.$request->search.'%');
                    })
            ;
        }
        $affiliate_items = $affiliate_items->paginate($length);

            if ($request->ajax()) {
                return view('panel.affiliate-item.load', ['affiliate_items' => $affiliate_items])->render();  
            }
 
        return view('panel.affiliate-item.index', compact('affiliate_items'));
    }

}

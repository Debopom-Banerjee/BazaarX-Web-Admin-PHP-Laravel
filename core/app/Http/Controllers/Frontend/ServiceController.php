<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Service;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $slug = null)
    { 
        if($slug != null){
            $name = str_replace('-',' ',$slug);
          $category = Category::whereName($name)->with('services')->firstOrFail();
            return view('frontend.website.service.index',compact('category'));
        }else{
            abort(404);
        }
    }
    
    public function listDetails(Request $request)
    { 
        return view('frontend.website.service.listing-detail');
    }
    public function productDetails(Request $request,$id)
    { 
         $services = Service::find($id);  
        return view('frontend.website.service.product-details',compact('services'));
    }
    public function cart(Request $request)
    { 
        return view('frontend.website.service.cart');
    }
    public function successOrder(Request $request)
    { 
        return view('frontend.website.service.success-order');
    }
    public function getServiceData(Request $request)
    { 
        if($request->id != null){
            $service = Service::where('id',$request->id)->first();

            if(!$service){
                return response()->json(['error' => "This service is not available"], 404);
            }

            if (is_array($service->document)) {
                $documents = $service->document;
                $service['document'] = collect(Category::select('id','name')->whereIn('id', $service->document)->pluck('name')->toArray())->join(', ');
            }
            $related_services = Service::where('category_id',$service->category->id)->whereNotIn('id',[$service->id])->take(3)->get();
            // Check service exist or not 
            if (!$service) {
                return response()->json(['error' => "Service not found"], 401);
            }
            return view('frontend.modal.service-load',['service' => $service,'related_services' => $related_services])->render();

        }
        return response()->json(['error' => "Please select at least one service."], 401);
    }
    public function getSubCategory(Request $request)
    {
        $category = Category::whereId($request->category_id)->first();
        $sub_categories = $category->categories;
        $html = '<option value="" readonly>Select Sub Category</option>';
        foreach ($sub_categories as $index => $sub_category) {
            $html .= '<option value="'.$sub_category->id.'">'.$sub_category->name.'</option>';
        }
        return $html;
    }
   
}
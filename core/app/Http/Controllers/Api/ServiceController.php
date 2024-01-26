<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Media;


class ServiceController extends Controller
{
    public function index()
    {
       $categories = Category::where('category_type_id', 15)->with(['services' => function($q){
            $q->select(['id', 'title', 'banner', 'affiliation_type', 'affiliation_value', 'affiliation_desc', 'is_publish', 'category_id'])->published();
        }])->get();
        return $this->success($categories);
    }

    public function getServiceCategories(){
        // $categories = Category::where('category_type_id', 15)
        // ->select('id','name','level','icon','category_type_id','parent_id')
        // ->with('categories',function($q){
        //     $q->select('id','name','level','category_type_id','parent_id');
        // })
        // ->get();
        $categories = Category::where('category_type_id', 15)
        ->select('id','name','level','icon','category_type_id','parent_id')
        ->with('categories',function($q){
            $q->select('id','name','level','category_type_id','parent_id');
        })
        ->where('level',1)
        ->get();
        foreach ($categories as $key => $category) {
           foreach ($category->categories as $key => $subCategory) {
                $subCategory['count'] = Service::where('category_id',$category->id)->where('sub_category_id',$subCategory->id)->count();
           }
        }
        return $this->success($categories);
    }
    public function searchIndex(){
        $services = Service::query();
        
        if(!request()->get('category_id')){
            return $this->error('Category Id Not Found!');
        }
        if(!request()->get('sub_category_id')){
            return $this->error('Sub Category Id Not Found!');
        }
        if(request()->has('category_id') && request()->get('category_id') != null && request()->has('sub_category_id') && request()->get('sub_category_id') != null){
            $services->where('category_id',request()->get('category_id'))->where('sub_category_id',request()->get('sub_category_id'));
        }
        $services = $services->select(['id', 'title', 'banner', 'affiliation_type', 'affiliation_value', 'affiliation_desc', 'is_publish', 'category_id','sub_category_id'])->where('is_publish',1)->get();
        return $this->success($services);
    }
    public function show($id)
    {
        try {
            $data = Service::find($id);
            if (is_array($data->document)) {
                $data->documents = $data->document;
                $data->document = collect(Category::select('id','name')->whereIn('id', $data->document)->pluck('name')->toArray())->join(', ');
            }else{
                $data->documents = $data->document;
                $data->document = null;
            }
            if ($data["affiliation_type"] == "Percent"){
                $data["affiliation_value"] = round((($data["affiliation_value"] * $data["price"]) / 100));
            }else{
                $data["affiliation_value"] = (int)$data["affiliation_value"];
            }
            $data['medias'] = Media::where('type','Service')->where('type_id',$data->id)->select(['id','file_name','path'])->get();
            // $data['expected_delivery_at'] = $data;
            return $this->success($data);
        } catch (\Exception $e) {
            info($e->getMessage());
            return $this->error('Something went wrong!');
        }
    }
}
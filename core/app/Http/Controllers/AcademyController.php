<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
class AcademyController extends Controller
{
    public function index(Request $request){
        if($request->has('ref') && $request->get('ref') == 'mob'){
            session()->put('mob',1);
        }
        if($request->has('sliderType')){
            $sliders = Slider::where('slider_type_id',6)->Simplepaginate(10);
        }else{
            $sliders = Slider::Simplepaginate(10);
        }
         return view('frontend.website.academy.index',compact('sliders'));
    }
}

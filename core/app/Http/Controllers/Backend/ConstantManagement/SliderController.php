<?php
/**
 *
 * @category zStarter
 *
 * @ref zCURD
 * @author  Defenzelite <hq@defenzelite.com>
 * @license https://www.defenzelite.com Defenzelite Private Limited
 * @version <zStarter: 1.1.0>
 * @link    https://www.defenzelite.com
 */


namespace App\Http\Controllers\Backend\ConstantManagement;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    protected $path;
    public function __construct()
    {
        $this->path =   storage_path() . "/app/public/backend/constant-management/sliders/";
    }

    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try{
            $sliders = Slider::whereSliderTypeId(request()->get('slidertype'))->latest()->get();
            return view('backend.constant-management.sliders.index',compact('sliders'));
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
            return view('backend.constant-management.sliders.create');
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
        $this->validate($request, [
            'title'     => 'required',
            // 'image_file'     => 'required',
        ]);

        try{
            if($request->hasFile('image_file')) {
                $image = $request->file('image_file');
                $path = $this->path;
                $imageName = 'image_'.rand(00000, 99999).'.' . $image->getClientOriginalExtension();
                $image->move($path, $imageName);
                $request['image']=$imageName;
            } else{
                $request['image']= null;
            }


            $link = $request->get('link');
            if(Str::contains($link, '?v=')){
                $pattern = '/\?v=(?<id>\w+[-]?\w+)[\&]?/i';
                preg_match($pattern, $link, $matches);
                $link = "https://www.youtube.com/embed/" . $matches['id'];
            }

            Slider::create([
                'title' => $request->get('title'),
                'link' => $link,
                'image' => $request['image'],
                'description' => $request->get('description'),
                'slider_type_id' => $request->get('slider_type_id'),
                'status' => $request->get('status'),
            ]);
            return redirect(route('backend.constant-management.sliders.index')."?slidertype=".$request->slider_type_id)->with('success','Slider Created Successfully!');
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
    public function show(Slider $slider)
    {
        try{
            return view('backend.constant-management.sliders.show',compact('slider'));
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
    public function edit(Slider $slider)
    {
        try{

            return view('backend.constant-management.sliders.edit',compact('slider'));
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
    public function update(Request $request,Slider $slider)
    {
        $this->validate($request, [
            'title'     => 'required',
        ]);

        try{

            if($slider){
                if($request->hasFile('image_file')) {
                    if ($slider->image != null) {
                        unlinkfile(substr($this->path, 0, -1), $slider->image);
                    }
                    $image = $request->file('image_file');
                    $path = $this->path;
                    $imageName = 'image_'.rand(00000, 99999).'.' . $image->getClientOriginalExtension();
                    $image->move($path, $imageName);
                    $request['image']=$imageName;
                } else  {
                    $request['image'] = $slider->image;
                }
                if(!$request->status) {
                    $request['status']  = 0;
                } else{
                    $request['status']  = 1;
                }

                $link = $request->get('link');
                if(Str::contains($link, '?v=')){
                    $pattern = '/\?v=(?<id>\w+)[\&]?/i';
                    preg_match($pattern, $link, $matches);
                    $link = "https://www.youtube.com/embed/" . $matches['id'];
                }

                $slider->update([
                    'title' => $request->get('title'),
                    'link' => $link,
                    'app_link' => $request['app_link'],
                    'image' => $request['image'],
                    'description' => $request->get('description'),
                    'status' => $request->get('status'),
                ]);

                // $chk = $slider->update($request->all());

                return redirect(route('backend.constant-management.sliders.index')."?slidertype=".$request->slider_type_id)->with('success','Record Updated!');
            }
            return back()->with('error','Slider not found');
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
    public function destroy(Slider $slider)
    {
        try{

            if($slider){
                    $slider->delete();
                    return back()->with('success', 'Record Deleted!');
            }
            return back()->with('error','Slider not found');
        }catch(Exception $e){
            return back()->with('error', 'There was an error: ' . $e->getMessage());
        }
    }
}

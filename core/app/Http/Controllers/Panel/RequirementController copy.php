<?php


namespace App\Http\Controllers\Panel;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Requirement;
use App\Models\CategoryType;
use App\Models\Category;

class RequirementController extends Controller
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
         $requirements = Requirement::query();
         
            if($request->get('search')){
                $requirements->where('id','like','%'.$request->search.'%')
                                ->orWhere('title','like','%'.$request->search.'%')
                                ->orWhere('price','like','%'.$request->search.'%')
                                ->orWhere('location','like','%'.$request->search.'%')
                ;
            }
            
            if($request->get('from') && $request->get('to')) {
                $requirements->whereBetween('created_at', [\Carbon\carbon::parse($request->from)->format('Y-m-d'),\Carbon\Carbon::parse($request->to)->format('Y-m-d')]);
            }

            if($request->get('category_id')){
                $requirements->where('category_id',$request->get('category_id'));
            }
            if($request->get('sub_category_id')){
                $requirements->where('sub_category_id',$request->get('sub_category_id'));
            }
            if($request->get('asc')){
                $requirements->orderBy($request->get('asc'),'asc');
            }
            if($request->get('desc')){
                $requirements->orderBy($request->get('desc'),'desc');
            }
            $requirements = $requirements->paginate($length);
            $categories = Category::where('category_type_id',25)->where('level', 1)->select('id','name')->get();
            $subCategories = Category::where('category_type_id',25)->where('level', 2)->select('id','name')->get();
            if ($request->ajax()) {
                return view('panel.requirements.load', ['requirements' => $requirements])->render();  
            }
 
        return view('panel.requirements.index', compact('requirements','categories','subCategories'));
    }

        public function print(Request $request){
            $requirements = collect($request->records['data']);
                return view('panel.requirements.print', ['requirements' => $requirements])->render();  
           
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        try{
            $categories = getCategoriesByCode('RequirementCategory'); 
            $budget_categories = Category::where('category_type_id',26)->select('id','name')->get();
            return view('panel.requirements.create',compact('categories','budget_categories'));
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
                        'category_id'     => 'sometimes',
                        'sub_category_id'     => 'sometimes',
                        'price'     => 'required',
                        'customer_info'     => 'nullable',
                        'location'     => 'sometimes',
                        'status'     => 'required',
                        'budget'     => 'sometimes',
                        'type'     => 'required',
                    ]);
        
        try{
            $customer_info=[
                'name' =>$request->name,
                'phone' =>$request->phone,
                'email' =>$request->email,
            ] ; 
            $requirement= Requirement::create([
                'title' => $request->title,
                'category_id' => $request->category_id,
                'sub_category_id' => $request->sub_category_id,
                'price' => $request->price,
                'location' => $request->location,
                'budget' => $request->budget,
                'type' => $request->type,
                'customer_info'=> $customer_info,
                'status'=> $request->status,
                'created_by'=> $request->created_by,
                'location'=> $request->location,

            ]);    
            // $requirement = Requirement::create($request->all());
         return redirect()->route('panel.requirements.index')->with('success','Requirement Created Successfully!');
        }catch(Exception $e){            
            return back()->with('error', 'There was an error: ' . $e->getMessage())->withInput($request->all());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function show(Requirement $requirement)
    {
        try{
            return view('panel.requirements.show',compact('requirement'));
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
    public function edit(Requirement $requirement)
    {   
        try{
            $categories = getCategoriesByCode('RequirementCategory'); 
            $budget_categories = Category::where('category_type_id',26)->select('id','name')->get();
            return view('panel.requirements.edit',compact('requirement','budget_categories','categories'));
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
    public function update(Request $request,Requirement $requirement)
    {
        
        $this->validate($request, [
                        'title'     => 'required',
                        'category_id'     => 'sometimes',
                        'sub_category_id'     => 'sometimes',
                        'price'     => 'required',
                        'cunstomer_info'     => 'nullable',
                        'location'     => 'sometimes',
                        'status'     => 'required',
                        'budget'     => 'sometimes',
                        'type'     => 'required',
                    ]);
                
        try{
                                 
            if($requirement){
                $customer_info=[
                    'name' =>$request->name,
                    'phone' =>$request->phone,
                    'email' =>$request->email,
                ] ; 
                $request['customer_info'] = $customer_info;
                 $chk = $requirement->update($request->all());

                return redirect()->route('panel.requirements.index')->with('success','Record Updated!');
            }
            return back()->with('error','Requirement not found')->withInput($request->all());
        }catch(Exception $e){            
            return back()->with('error', 'There was an error: ' . $e->getMessage())->withInput($request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Requirement $requirement)
    {
        try{
            if($requirement){
                                                  
                $requirement->delete();
                return back()->with('success','Requirement deleted successfully');
            }else{
                return back()->with('error','Requirement not found');
            }
        }catch(Exception $e){
            return back()->with('error', 'There was an error: ' . $e->getMessage());
        }
    }
    public function getSubcategory(Request $request)
    {
        // return $request->all();
        try{
            $html = null;
            $category_id = $request->id;
            if(is_array($category_id)){
                $data = Category::whereIn('parent_id','=',$category_id)->get();
            }else{
                $data = Category::where('parent_id','=',$category_id)->get();
            }
    
            foreach($data as $option){
                $selected = $request->sub_category_id == $option->id ? 'selected' : '';
                $html .=  "<option value='".$option->id."'".$selected.">".$option->name."</option>";
            }
            return response($html, 200);
        }catch(Exception $e){            
            return back()->with('error', 'There was an error: ' . $e->getMessage());
        }
    }
}

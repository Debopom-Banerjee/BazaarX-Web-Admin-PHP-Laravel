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

namespace App\Http\Controllers\Admin\ConstantManagement;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $length = 10;
        if(request()->get('length')){
            $length = $request->get('length');
        }
            $article = Article::query();
            //   return $request->all();
             if($request->get('from') && $request->get('to') ){
            //  return explode(' - ', $request->get('date')) ;
             $article->whereBetween('created_at', [\Carbon\Carbon::parse($request->from)->format('Y-m-d'),\Carbon\Carbon::parse($request->to)->format('Y-m-d')]);
             }
            if($request->get('category')){
                $article->where('category_id','=',$request->get('category'));
            }
            if($request->get('type')){
                $article->where('type',$request->get('type'));
            }
            $article= $article->latest()->paginate($length);
            if ($request->ajax()) {
                return view('backend.constant-management.article.load', ['article' => $article])->render();  
            }
            return view('backend.constant-management.article.index', compact('article'));

    }
    public function print(Request $request){
        // return $request->all();
        // return $request->articles;
        //    return json_decode($request->articles,true);
        $articles = collect($request->records['data']);
        return view('backend.constant-management.article.print', ['articles' => $articles])->render();  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.constant-management.article.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // try {
            $this->validate($request, [
                'title' => 'required',
                'user_id' => 'required',
                'category_id' => 'required',
                'description_banner'=>'required',
                'description'=>'required',
                'slug'=>'required',
            ]);
            $data = new Article();
            $data->title=$request->title;
            $data->slug = \Str::slug($request->title);
            $data->user_id=auth()->id();
            $data->category_id=$request->category_id;
            $data->is_publish=$request->is_publish;
            $data->type=$request->type;
            $data->seo_title=$request->seo_title;
            $data->seo_keywords=$request->seo_keywords;
            $data->short_description=$request->short_description;
            $data->description=$request->description;
            if ($request->hasFile('description_banner')) {
                $image = $request->file('description_banner');
                $path = storage_path('app/public/backend/article');
                $imageName = 'article' . $data->id.rand(000, 999).'.' . $image->getClientOriginalExtension();
                $image->move($path, $imageName);
                $data->description_banner=$imageName;
            }else{
                $data['description_banner'] = null;
            }
            $data->save();
            return redirect(route('panel.constant_management.article.index'))->with('success', 'Article created successfully.');
        // } catch (\Exception $e) {
        //     return back()->with('error', 'Error: ' . $e->getMessage());
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        //
       // return "drg";
        $article = Article::whereId($id)->first();
        return view('backend.constant-management.article.show', compact('article'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $article = Article::whereId($id)->first();
        return view('backend.constant-management.article.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $request->all();
        try {
            $data = Article::whereId($id)->first();
            $data->title=$request->title;
            $data->slug = \Str::slug($request->title);
            $data->user_id=auth()->id();
            $data->category_id=$request->category_id;
            $data->seo_title=$request->seo_title;
            $data->seo_keywords=$request->seo_keywords;
            $data->short_description=$request->short_description;
            $data->description=$request->description;
            if ($request->hasFile('description_banner')) {
                if ($data->description_banner != null) {
                    unlinkfile(storage_path() . '/app/public/backend/article', $data->description_banner);
                }
                $image = $request->file('description_banner');
                $path = storage_path('app/public/backend/article');
                $imageName = 'article' . $data->id.rand(000, 999).'.' . $image->getClientOriginalExtension();
                $image->move($path, $imageName);
                $data->description_banner=$imageName;
            }
            if(!$request->has('is_publish')){
                $data->is_publish = 0;
            }else{
                $data->is_publish = 1;
            }
            $data->save();
            return redirect(route('panel.constant_management.article.index'))->with('success', 'Article   update successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $chk = Article::whereId($id)->delete();
        if ($chk) {
            return back()->with('success', 'Article Deleted Successfully!');
        }
    }
}

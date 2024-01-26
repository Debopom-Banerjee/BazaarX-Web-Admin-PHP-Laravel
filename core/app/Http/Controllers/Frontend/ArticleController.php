<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('ref') && $request->get('ref') == 'mob'){
            session()->put('mob', 1);
        }
        // Article type is Blogs
        $articles = Article::whereIsPublish(1)->where('type',1)->with('user')->simplePaginate(12);
        return view('frontend.website.article.index',compact('articles'));
    }
    public function resources(Request $request)
    {
        // Article type is Resources
        $articles = Article::whereIsPublish(1)->where('type',2)->with('user')->simplePaginate(12);
        return view('frontend.website.resources.index',compact('articles'));
    }
   
    public function show($slug)
    {
        
        $article = Article::where('slug',$slug)->with('user')->first();
        return view('frontend.website.article.show',compact('article'));
    }
   
}
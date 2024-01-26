<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\WebsitePage;
use App\Models\Category;
use App\Models\Article;

class SiteMapController extends Controller
{
    // public function sitemap()
    // {
    //     return Response::view('sitemap')->header('Content-Type', 'application/xml');
    // }
    public function sitemap()
    {
        // Work Categories
        
        $services = Service::latest()->get();      
        $serviceCategories = Category::whereCategoryTypeId(15)->get();
        $blogs = Article::where('is_publish',1)->latest()->take(4)->get();
        $pages = WebsitePage::where('status',1)->get();
        $xml = "?>";

        return response()->view('sitemap', [
            'services' => $services,
            'xml' => $xml,
            'serviceCategories' => $serviceCategories,
            'blogs' => $blogs,
            'pages' => $pages,
        ])->header('Content-Type', 'text/xml');
    }
    
}
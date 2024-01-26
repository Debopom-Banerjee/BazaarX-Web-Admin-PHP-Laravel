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

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Spatie\Permission\Models\Role;
use App\Models\UserEnquiry;
use App\Models\Article;
use App\Models\NewsLetter;
use App\Models\WebsitePage;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Order;
use App\Models\Category;
use App\Models\Testimonial;

class HomeController extends Controller
{

    public function index()
    {
        $slider = Slider::where('slider_type_id',11)
        ->where('status', 1)
        ->first(['id', 'title', 'image','link','description']);
        $home_sliders = Slider::where('slider_type_id', 5)->where('status', 1)
        ->get(['id', 'title', 'image','link','description']);

        $services = Service::where('is_featured',1)->get();
        
        $explore_sliders = getSlidersByCode('BazaarX Web Home Featured Banners');
        $news_sliders = getSlidersByCode('BazaarX Web Home In News Logos');
        $partners_clients_sliders = getSlidersByCode('BazaarX Web Home Partner Logos');

        $blogs = Article::where('is_publish',1)->latest()->take(4)->get();
        $testimonials = Testimonial::where('type','testimonials')->latest()->take(10)->get();
        $customersCount = User::role('User')->count();
        $totalOrdersValue = Order::sum('total');
        $deliveredOrders = Order::where('status',4)->count();
        $serviceOfferings = Service::where('is_publish',1)->count();
        $categories = Category::whereCategoryTypeId(15)->where('parent_id',null)->get();
        return view('frontend.index', compact('services','slider','home_sliders','categories','explore_sliders','blogs','testimonials','customersCount','totalOrdersValue','deliveredOrders','serviceOfferings','news_sliders','partners_clients_sliders'));
    }
    public function notFound()
    {
        return view('global.error');
    }
    public function maintanance()
    {
        return view('global.maintanance');
    }

    public function page($slug = null)
    {

        if($slug != null){
            $page = WebsitePage::where('slug', '=', $slug)->whereStatus(1)->first();

                if(!$page){
                    abort(404);
                }
        }else{
            $page = null;
        }
        return view('frontend.page',compact('page'));
    }


    public function dashboard()
    {
       if(AuthRole() == 'Partner') {
           $orders = Order::where('partner_id',auth()->id())->latest()->paginate(5);
        }else{
           $orders = Order::where('user_id',auth()->id())->latest()->paginate(5);
       }
        if(getSetting('sms_verify') && auth()->user()->is_verified){
            return redirect()->route('sms.verify')->with(['phone' => auth()->user()->phone]);
        }elseif(getSetting('email_verify') && auth()->user()->email_verified_at == null){
            return redirect()->route('verification.notice');
        }else{
            return view('pages.dashboard',compact('orders'));
        }
    }


    public function smsVerification(Request $request)
    {
        if(auth()->check()){
            $user = auth()->user();
        }else{
            $user = User::where('phone', $request->phone)->first();
        }

        if($user->temp_otp != null){
            if($user->temp_otp = $request->verification_code){
                $user->update(['is_verified' => 1,'temp_otp'=>null ]);
                return redirect()->route('panel.dashboard');
                return $request->all();
            }else{
                return back()->with('error','OTP Mismatch');
            }
        }else{
            return back()->with('error','Try Again');
        }
    }

    public function clearCache()
    {
        \Artisan::call('cache:clear');
        return view('clear-cache');
    }

    // public function about()
    // {
    //     // return redirect('/login');
    //     return view('frontend.website.about');
    // }
    public function aboutIndex()
    {
        $teams = Slider::where('slider_type_id',8)->where('status',1)->latest()->get();
        return view('frontend.website.about.index',compact('teams'));
    }

    public function searchIndex(Request $request)
    {
        $length = 28;
        $services = Service::query();
        if($request->get('search')){
            $services->where(function($query) use ($request) {
                $query->where('title', 'like', '%' . $request->search . '%')
                      ->where('is_publish',1)
                      ->orWhere('slug', 'like', '%' . $request->search . '%')
                      ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }
        $categories = Category::whereCategoryTypeId(15)->where('parent_id',null)->get();

        if(request()->has('category_id') && request()->get('category_id') != null && request()->has('sub_category_id') && request()->get('sub_category_id') != null ){
            $services->where('category_id',request()->get('category_id'))
            ->where('sub_category_id',request()->get('sub_category_id'));
        } elseif (request()->has('category_id') && request()->get('category_id') != null ) {
            $services->where('category_id',request()->get('category_id'));
        }

        $services = $services->where('is_publish',1)->simplePaginate($length);
        return view('frontend.website.search.index',compact('categories','services'));
    }
    public function jobIndex()
    {
        $sliders = getSlidersByCode('BazaarX Web Career Vacancies');
        return view('frontend.website.job.index',compact('sliders'));
    }

    public function storeNewsletter(Request $request)
    {
        // 1: Email, 2: Phone
        $news = NewsLetter::create([
            'type' => 1,
            'value' => $request->email,
        ]);

        // Assuming you want to send a JSON response
        return response()->json(['message' => 'Subscribed Successfully!']);
    }


    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logoutAs()
    {
        // If for some reason route is getting hit without someone already logged in
        if (!auth()->user()) {
            return redirect()->url('/');
        }

        // If admin id is set, relogin
        if (session()->has('admin_user_id') && session()->has('temp_user_id')) {
            // Save admin id
            $admin_id = session()->get('admin_user_id');

            session()->forget('admin_user_id');
            session()->forget('temp_user_id');

            // Re-login admin
            auth()->loginUsingId((int) $admin_id);

            // Redirect to backend user page
            return redirect()->route('panel.users.index',['?role='.AuthRole()]);
        } else {
            // return 'f';
            session()->forget('admin_user_id');
            session()->forget('temp_user_id');

            // Otherwise logout and redirect to login
            auth()->logout();

            return redirect('/');
        }
    }


    public function downloadApp(Request $request){
        {
            if(getOS() == 'android'){
                return redirect('https://play.google.com/store/apps/details?id=com.gofinx.app');
            }
            return redirect('https://apps.apple.com/us/app/gofinx/id6444019342');
        }
    }
    public function thankyou(Request $request){
        {
            return view('frontend.thankyou.index');
        }
    }
    public function trackOrder(Request $request){
        {
            $orderID = request()->get('order_id');
            $order = null;
            if($orderID){
               $order = Order::where('id',$orderID)->first();
            }
            return view('frontend.track-order.index',compact('order'));
        }
    }
    public function becomePartner(Request $request){
        {
            return view('frontend.website.become-partner.index');
        }
    }
    public function shareService(Request $request,$slug){
        {
            $service = Service::where('slug',$slug)->where('is_publish',1)->first();

            if(!$service){
                abort(404);
            }

            if (is_array($service->document)) {
                $documents = $service->document;
                $service['document'] = collect(Category::select('id','name')->whereIn('id', $service->document)->pluck('name')->toArray())->join(', ');
            }
            $related_services = Service::where('category_id',$service->category->id)->whereNotIn('id',[$service->id])->take(3)->get();
            return view('frontend.website.service.share',compact('service','related_services'));
        }
    }
    public function sendAppLink(Request $request){
        {
            return back()->with('success','Sending link to given number successfully');
        }
    }
}

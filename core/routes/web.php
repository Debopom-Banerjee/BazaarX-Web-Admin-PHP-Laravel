<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Frontend\ArticleController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Panel\UserAdvisoryController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Panel\UserAddresController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SocialLoginController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\SiteMapController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ConstantManagement\WorldController;
use App\Http\Controllers\AcademyController;
use App\Http\Controllers\Frontend\ServiceController;
use App\Http\Controllers\CronController;
use App\Http\Controllers\GuestCheckoutController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Admin\PaymentController;

use App\Http\Controllers\Panel\TestimonialsController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

/*

|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


  Route::get('/qb', function () {
    return url('frontend/assets/img/app-banner.png');
    return session()->forget('mob');
      return callMasking(8823874387,8823874387);
      return view('test');
    return UserRole(621);
    $services = App\Models\Service::all();
    foreach($services as $service){
        $service->update(['is_featured' => 0]);
    }

    return "S";

    //  $users = App\User::where('referal_code',null)->get();
    // foreach($users as $user){
    //     $user->update(['referal_code' => strtoupper(\Str::random(7))]);
    // }
    // return 'success';
    return route('panel.partner.leads.explore',['code' => 'dsh746']);
    // Send SMS
    $this->sms()
    ->to('6266554669')
    ->template('1707164507719278973')
    ->setMessage("Hey Anjali, You got a $amount for the Inviter Commission - GoFinx.com")
    ->send();
    return 'done';
    return dd(getInviterAmount(1999));
    $user_no_role = \App\User::get();
    foreach($user_no_role as $user){
        if(UserRole($user->id) == ''){
            $user->syncRoles(3);
        }
    }
    return "S";
    return getUniqueCode();
    $Phno= 8305546538;
    $Msg='Hii';
    $Password='zvor9882ZV';
    $SenderID='GOFINX';
    $UserID='satyamiit';
    $EntityID='1701162824834055338';
    $TemplateID = '1707164507719278973';
    $msg = Illuminate\Support\Facades\Http::get('http://www.nimbusit.biz/api/SmsApi/SendSingleApi?UserID='.$UserID.'&Password='.$Password.'&SenderID='.$SenderID.'&Phno='.$Phno.'&Msg='.urlencode($Msg).'&EntityID='.$EntityID.'&TemplateID='.$TemplateID);

    return dd($msg);
    return "S";
});


    /***********Invoice Route START**********/
    Route::get('/finance/invoice/view/{id}',[OrderController::class,'userInvoice'])->name('userInvoice');
    /***********Invoice Route END**********/

    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
    // Frontend Route Start-------------------------------------------------------------------------------------
        Route::get('/', [HomeController::class,'index'])->name('index');
        Route::get('/about', [HomeController::class,'aboutIndex'])->name('about.index');
        Route::get('/search', [HomeController::class,'searchIndex'])->name('search.index');
        Route::get('page-error', [HomeController::class,'notFound'])->name('error.index');
        Route::get('maintanance', [HomeController::class,'maintanance'])->name('maintanance.index');
        Route::post('/newsletter/store', [HomeController::class,'storeNewsletter'])->name('newsletter.store');
        Route::post('send-app-link', [HomeController::class,'sendAppLink'])->name('send.app-link');
        // Articles
        Route::get('/resources', [ArticleController::class,'resources'])->name('resources.index');
        Route::get('/blogs', [ArticleController::class,'index'])->name('article.index');
        Route::get('/blog/{slug}', [ArticleController::class,'show'])->name('article.show');
        // Videos-
        Route::get('/academy',[AcademyController::class,'index'])->name('academy');
        Route::get('/career',[HomeController::class,'jobIndex'])->name('job.index');
        // Contact
        Route::get('/contact', [ContactController::class,'index'])->name('contact.index');
        Route::post('/contact/store', [ContactController::class,'store'])->name('contact.store');
        // thankyou
        Route::get('/thankyou', [HomeController::class,'thankyou'])->name('thankyou');
        //tracking order
        Route::get('/track-order', [HomeController::class,'trackOrder'])->name('order-tracking');
        Route::get('/become-partner', [HomeController::class,'becomePartner'])->name('become-partner');
        // Service Share
        Route::get('/service/{slug}', [HomeController::class,'shareService'])->name('service.show');
        // Attachment
        Route::get('sos-access/attachment/{order_id}/{user_id}',[OrderController::class,'userOrderAttachment'])->name('userOrderAttachment');
        Route::get('sos-access/advisory/{a_id}',[UserAdvisoryController::class,'userAdvisoryShow'])->name('user-advisory.show');
        Route::get('sos-access/portfolio/{order}',[OrderController::class,'userPortfolioRecode'])->name('user-portfolio');
        Route::get('/sos-create-advisory/{user_id}', [UserAdvisoryController::class,'createUserAdvisory'])->name('user-create-advisory');
        
        Route::get('/my-advisory-reports/{user_id}', [UserAdvisoryController::class,'myAdvisories'])->name('my-advisory-reports');

        Route::get('/page', function () {   
            return view('frontend.index'); 
        });
        Route::get('/services/{slug?}', [ServiceController::class,'index'])->name('service.index');
        Route::get('/service/{id}/show', [ServiceController::class,'productDetails'])->name('product.details');
        
        Route::get('/success-order', [ServiceController::class,'successOrder'])->name('success.order');
        Route::get('/get/service-data', [ServiceController::class,'getServiceData'])->name('get-service-data');

        Route::get('/get-sub-category', [ServiceController::class,'getSubCategory'])->name('get-sub-category');

        // Route::get('/list-details', [ServiceController::class,'listDetails'])->name('list.details');

        // Route::get('/thankyou', function () {   
        //     return view('frontend.thankyou.index'); 
        // });
        

        //academy route
        // Customer Routes
        Route::group(['middleware' => ['auth'],'namespace' => '/customer', 'prefix' => 'customer', 'as' => 'customer.'], function () {
            Route::get('/account', [CustomerController::class,'account'])->name('profile');
            Route::get('/notifications', [CustomerController::class,'notification'])->name('notification');
            Route::get('/setting', [CustomerController::class,'setting'])->name('setting');
            Route::get('/wallet', [WalletController::class,'index'])->name('wallet');
            Route::get('/address', [CustomerController::class,'address'])->name('address');
            Route::post('/address', [UserAddresController::class,'store'])->name('address.store');
            Route::post('/info-update/{id}', [CustomerController::class,'updateAccountInfo'])->name('update.info');
            Route::post('/verify-ekyc', [CustomerController::class,'ekycVerify'])->name('ekyc.store');
            Route::get('/address/delete/{id}', [UserAddresController::class,'destroy'])->name('address.destroy');
            Route::post('/address/update/', [UserAddresController::class,'update'])->name('address.update');
            Route::get('/payout-request', [WalletController::class,'refundRequest'])->name('payout.request.index');
            Route::post('/payout-store', [WalletController::class,'payoutStore'])->name('payout.store');
            Route::post('/wallet/logs', [WalletController::class,'storeWalletLog'])->name('wallet-log.store');
            Route::group(['middleware' => ['web'],'namespace' => '/order', 'prefix' => 'order', 'as' => 'order.'], function () {
                Route::get('/', [CustomerController::class,'orderIndex'])->name('index');
                Route::get('/invoice/{o_id}', [CustomerController::class,'invoice'])->name('invoice');
            });
        });


        Route::get('login', [LoginController::class,'showLoginForm'])->name('login');
        Route::post('login', [LoginController::class,'login']);
        Route::get('get-otp-by-number', [LoginController::class,'getOtp'])->name('send-number-to-get-otp');
        Route::post('login-with-otp', [LoginController::class,'loginWithOtp'])->name('login-with-otp');
        Route::get('register', [RegisterController::class,'showRegistrationForm'])->name('register');
        Route::post('register', [RegisterController::class,'register']);
        
        // Socialite Routes
        Route::get('login/{provider}', [SocialLoginController::class, 'login'])->name('social.login');
        Route::get('login/{provider}/callback', [SocialLoginController::class, 'login']);

        //Email Verification Routes
        Route::get('/email/verify', function () {
            return view('auth.verify');
        })->middleware('auth')->name('verification.notice');
        Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
            $request->fulfill();
            return redirect('panel/dashboard');
        })->middleware(['auth', 'signed'])->name('verification.verify');
        Route::post('/email/verification-notification', function (Request $request) {
            $request->user()->sendEmailVerificationNotification();
        
            return back()->with('message', 'Verification link sent!');
        })->middleware(['auth', 'throttle:6,1'])->name('verification.resend');


        //SMS Verification routes
        Route::get('/sms/verify', function () {
            return view('auth.sms-verify');
        })->name('sms.verify');
        Route::post('/sms/verify', [HomeController::class,'smsVerification'])->name('sms.verify');

        //Password Routes
        Route::get('password/forget', function () {
            return view('global.forgot-password');
        })->name('password.forget');
        Route::post('password/email', [ForgotPasswordController::class,'sendResetLinkEmail'])->name('password.email');
        Route::get('password/reset/{token}', [ResetPasswordController::class,'showResetForm'])->name('password.reset');
        Route::post('password/reset', [ResetPasswordController::class,'reset'])->name('password.update');
        
        // Route::get('paysuccess', [CheckoutController::class, 'razorPaySuccess'])->name('checkout.razorpay');
        
        // Frontend Route END-------------------------------------------------------------------------------------
        

        
        
        Route::group(['middleware' => 'auth'], function () {
            // logout route
            Route::get('/logout', [LoginController::class,'logout']);
        });



    Route::get('get-states', [WorldController::class,'getStates'])->name('world.get-states');
    Route::get('get-cities', [WorldController::class,'getCities'])->name('world.get-cities');

Route::get('/offline', function () { return view('vendor/laravelpwa/offline'); });

Route::get('/page/{slug}', [HomeController::class,'page'])->name('page.slug');
//  Routes For Backend only

// Payments Cron
Route::get('order-payments/17RYA729', [CronController::class,'payments']);
//app route
Route::get('/app', [HomeController::class,'downloadApp']);


//testimonial in admin
Route::get('/panel/testimonial/list', [TestimonialsController::class,'index'])->name('panel.testimonial.index');
Route::get('/panel/testimonial/add', [TestimonialsController::class,'create'])->name('panel.testimonial.add');
Route::post('/panel/testimonial/store', [TestimonialsController::class,'store'])->name('panel.testimonial.store');
Route::get('/panel/testimonial/edit/{id}', [TestimonialsController::class,'edit'])->name('panel.testimonial.edit');
Route::post('/panel/testimonial/update/{id}', [TestimonialsController::class,'update'])->name('panel.testimonial.update');
Route::get('/panel/testimonial/print', [TestimonialsController::class,'print'])->name('panel.testimonial.print');
Route::get('/panel/testimonial/destroy/{id}', [TestimonialsController::class,'destroy'])->name('panel.testimonial.destroy');

// Guest Checkout
Route::group(['prefix' => 'guest-checkout', 'as' => 'guest-checkout.'], function () {
    Route::get('/index/{code}', [GuestCheckoutController::class,'index'])->name('index');
    Route::post('/store', [GuestCheckoutController::class,'store'])->name('store');
    Route::post('/payment', [GuestCheckoutController::class,'payment'])->name('payment');
    Route::post('/coupon/apply', [GuestCheckoutController::class,'applyCoupon'])->name('coupon.apply');
    Route::post('/coupon/remove', [GuestCheckoutController::class,'removeCoupon'])->name('coupon.remove');
});
Route::group(['prefix' => 'checkout', 'as' => 'checkout.'], function () {
    Route::get('/{id}', [CheckoutController::class,'index'])->name('index');
    Route::post('/store', [CheckoutController::class,'store'])->name('store');
    Route::post('/coupon/apply', [CheckoutController::class,'applyCoupon'])->name('coupon.apply');
    Route::get('/coupon/remove', [CheckoutController::class,'removeCoupon'])->name('coupon.remove');
    Route::post('/apple-pay/validate-merchant', [CheckoutController::class,'validateMerchant']);
});

// SiteMap 
Route::get('sitemap-gen.xml', [SiteMapController::class,'sitemap'])->name('sitemap.index');

Route::group([], function () {
    require_once(__DIR__ . '/panel.php');
    require_once(__DIR__ . '/crudgen.php');
});


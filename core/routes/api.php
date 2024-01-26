<?php

use App\Http\Controllers\Api\ChatController;
use App\Http\Controllers\Api\NotificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AffiliateController;
use App\Http\Controllers\Api\RolesController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PromoCodeController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\SupportController;
use App\Http\Controllers\Api\BalanceController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\AffiliateItemController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('login', [AuthController::class, 'login']);
Route::post('send-phone-otp', [AuthController::class, 'sendPhoneOtp']);
Route::post('login-with-otp', [AuthController::class, 'loginWithOtp']);
Route::post('social-login', [AuthController::class, 'socialLogin']);
Route::get('get-states', [AuthController::class, 'getStates']);
Route::get('get-cities', [AuthController::class, 'getCities']);
Route::post('register', [AuthController::class, 'register']);
Route::post('google-register', [AuthController::class, 'googleSignUp']);
Route::post('reset-password', [AuthController::class, 'resetPassword']);
Route::post('verify-otp', [AuthController::class, 'verifyOtp']);
Route::post('reset-change-password', [AuthController::class, 'changeResetPassword']);
Route::post('payout/{id}', [BalanceController::class, 'payout']);

Route::group(['middleware' => 'auth:api'], function () {

    Route::get('logout', [AuthController::class, 'logout']);
    Route::post('update-device-token', [AuthController::class, 'updateDeviceToken']);


    Route::get('profile', [AuthController::class, 'profile']);
    Route::post('change-password', [AuthController::class, 'changePassword']);
    Route::post('update-profile', [AuthController::class, 'updateProfile']);
    Route::get('notifications', [NotificationController::class, 'index']);


    // Service Controler
    Route::get('services', [ServiceController::class,'index']);
    Route::get('service/{id}', [ServiceController::class,'show'])->name('panel.services.edit');
    
    /// My Rewards
    Route::get('my-rewards', [UserController::class, 'myRewards']);


    //Order Controller
    Route::get('send-sms', [OrderController::class, 'sendSMS']);

    Route::get('order', [OrderController::class, 'status']);

    Route::get('order/detail/{id}', [OrderController::class, 'detail']);
    Route::get('order/chat/{id}', [OrderController::class, 'chats']);
    Route::post('order/chat/{id}', [OrderController::class, 'store']);
    Route::get('order/portfolio/{id}', [OrderController::class, 'portfolio']);
    Route::post('checkout/verify', [OrderController::class, 'capturePaymentAndUpdateOrder']);
    Route::post('checkout/{id}', [OrderController::class, 'checkout']);
    Route::get('checkout/show/{id}', [OrderController::class, 'checkoutShow']);
    Route::get('order/chatInit/{id}', [OrderController::class, 'createStream']);
    Route::get('order-count', [OrderController::class, 'getOrderByStatus']);
    Route::get('order/force-pay/{id}', [OrderController::class, 'forcePay']);
    
    //Balance Controller
    Route::get('balance', [BalanceController::class, 'index']);
    Route::post('bankDetail', [BalanceController::class, 'bankDetail']);
    Route::get('getBankDetail', [BalanceController::class, 'getBankDetail']);

    // Chat Routes
    Route::get('chats', [ChatController::class, 'index']);
    Route::post('chats', [ChatController::class, 'store']);
    Route::get('chats/{id}', [ChatController::class, 'show']);
    Route::get('my-referrals', [AuthController::class, 'myReferrals']);

    //Promo Code Controller
    Route::get('/apply-promo', [OrderController::class, 'applyPromo']);


    // Profile Controller
    Route::get('profile/details', [ProfileController::class, 'getDetails']);
    Route::get('profile/address', [ProfileController::class, 'getAddress']);
    Route::post('profile/details', [ProfileController::class, 'postDetails']);
    Route::post('profile/address-update', [ProfileController::class, 'postAddress']);

    Route::get('attachments/{id}', [OrderController::class, 'attachments']);
    Route::post('store-attachments', [OrderController::class, 'storeAttachments']);
    Route::delete('attachments/{id}', [OrderController::class, 'deleteAttachment']);
    Route::get('get/attachment-categories', [OrderController::class, 'getAttachmentCategoryList']);
    
    Route::get('get-service-categories', [ServiceController::class, 'getServiceCategories']);
    Route::get('search', [ServiceController::class, 'searchIndex']);

    //support Controller
    Route::get('/support', [SupportController::class, 'getSupport']);
    Route::post('/support', [SupportController::class, 'postSupport']);


    Route::get('home', [UserController::class,'home']);
    // Only those have manage_user permission will get access
    // Delete User
    Route::get('/user-delete', [UserController::class, 'userDelete']);
    
    // Route::group(['middleware' => 'can:manage_user'], function () {
        Route::get('/users', [UserController::class, 'list']);
        Route::post('/user/create', [UserController::class, 'store']);
        Route::get('/user/{id}', [UserController::class, 'profile']);
        Route::get('/user/delete/{id}', [UserController::class, 'delete']);
        Route::post('/user/change-role/{id}', [UserController::class, 'changeRole']);
        Route::get('/place-call-mask', [UserController::class, 'placeCallMask']);
        
    // });

    //only those have manage_role permission will get access
    Route::group(['middleware' => 'can:manage_role|manage_user'], function () {
        Route::get('/roles', [RolesController::class, 'list']);
        Route::post('/role/create', [RolesController::class, 'store']);
        Route::get('/role/{id}', [RolesController::class, 'show']);
        Route::get('/role/delete/{id}', [RolesController::class, 'delete']);
        Route::post('/role/change-permission/{id}', [RolesController::class, 'changePermissions']);
    });


    //only those have manage_permission permission will get access
    Route::group(['middleware' => 'can:manage_permission|manage_user'], function () {
        Route::get('/permissions', [PermissionController::class, 'list']);
        Route::post('/permission/create', [PermissionController::class, 'store']);
        Route::get('/permission/{id}', [PermissionController::class, 'show']);
        Route::get('/permission/delete/{id}', [PermissionController::class, 'delete']);
    });
    
    // Review
    Route::get('/review/{order_id}', [ReviewController::class, 'index']);
    Route::post('/review/store/{order_id}', [ReviewController::class, 'store']);

});


Route::group(['namespace' => 'Api','prefix' => 'medical-insurance-logics','as' =>'medical_insurance_logics.','middleware' =>  ["api", "auth:api"]], function () {
        Route::get('/', ['uses' => 'MedicalInsuranceLogicController@index']);
        Route::post('/', ['uses' => 'MedicalInsuranceLogicController@store']);
        Route::get('/{medical_insurance_logic}', ['uses' => 'MedicalInsuranceLogicController@show']);
        Route::put('/{medical_insurance_logic}', ['uses' => 'MedicalInsuranceLogicController@update']);
        Route::delete('/{medical_insurance_logic}', ['uses' => 'MedicalInsuranceLogicController@destroy']);
    });



Route::group(['namespace' => 'Api','prefix' => 'assumption-logics','as' =>'assumption_logics.','middleware' =>  ["api", "auth:api"]], function () {
        Route::get('/', ['uses' => 'AssumptionLogicController@index']);
        Route::post('/', ['uses' => 'AssumptionLogicController@store']);
        Route::get('/{assumption_logic}', ['uses' => 'AssumptionLogicController@show']);
        Route::put('/{assumption_logic}', ['uses' => 'AssumptionLogicController@update']);
        Route::delete('/{assumption_logic}', ['uses' => 'AssumptionLogicController@destroy']);
    });



Route::group(['namespace' => 'Api','prefix' => 'investor-types','as' =>'investor_types.','middleware' =>  ["api", "auth:api"]], function () {
        Route::get('/', ['uses' => 'InvestorTypeController@index']);
        Route::post('/', ['uses' => 'InvestorTypeController@store']);
        Route::get('/{investor_type}', ['uses' => 'InvestorTypeController@show']);
        Route::put('/{investor_type}', ['uses' => 'InvestorTypeController@update']);
        Route::delete('/{investor_type}', ['uses' => 'InvestorTypeController@destroy']);
    });



    Route::group(['namespace' => 'Api','prefix' => 'investment-options','as' =>'investment_options.','middleware' =>  ["api", "auth:api"]], function () {
        Route::get('/', ['uses' => 'InvestmentOptionController@index']);
        Route::post('/', ['uses' => 'InvestmentOptionController@store']);
        Route::get('/{investment_option}', ['uses' => 'InvestmentOptionController@show']);
        Route::put('/{investment_option}', ['uses' => 'InvestmentOptionController@update']);
        Route::delete('/{investment_option}', ['uses' => 'InvestmentOptionController@destroy']);
    });
    
    // Affiliate 
    Route::get('/get/shareable-url', [AffiliateItemController::class, 'generateShareableUrl']);
    Route::group(['namespace' => 'Api','prefix' => 'affiliates','as' =>'affiliates.','middleware' =>  ["api", "auth:api"]], function () {
        Route::get('/home', [AffiliateController::class, 'home']);
        Route::get('/get-sales-volume', [AffiliateController::class, 'showSalesVolume']);
    });


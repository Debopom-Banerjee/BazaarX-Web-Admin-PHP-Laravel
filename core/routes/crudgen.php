<?php
use App\Http\Controllers\CrudGenrator\CrudGenController;

Route::group(['middleware' => 'can:manage_dev','prefix' => 'dev/crudgen', 'as' => 'crudgen.'], function () {

    Route::get('/', [CrudGenController::class,'index'])->name('index');
    Route::get('/bulkimport', [CrudGenController::class,'bulkImport'])->name('bulkimport');
    Route::Post('/bulkimport/generate', [CrudGenController::class,'bulkImportGenerate'])->name('bulkimport.generate');
    Route::post('/generate', [CrudGenController::class,'generate'])->name('generate');
    Route::get('/getcol', [CrudGenController::class,'getColumns'])->name('getcol');
});

Route::group(['namespace' => 'Admin\ConstantManagement', 'prefix' => 'backend/constant-management/slider-types','as' =>'backend.constant-management.slider_types.'], function () {
    Route::get('index', ['uses' => 'SliderTypeController@index', 'as' => 'index']);
    Route::get('create', ['uses' => 'SliderTypeController@create', 'as' => 'create']);
    Route::post('store', ['uses' => 'SliderTypeController@store', 'as' => 'store']);
    Route::get('edit/{slider_type}', ['uses' => 'SliderTypeController@edit', 'as' => 'edit']);
    Route::post('update/{slider_type}', ['uses' => 'SliderTypeController@update', 'as' => 'update']);
    Route::get('delete/{slider_type}', ['uses' => 'SliderTypeController@destroy', 'as' => 'destroy']);
}); 

Route::group(['namespace' => 'Backend\ConstantManagement', 'prefix' => 'backend/constant-management/sliders','as' =>'backend.constant-management.sliders.'], function () {
    Route::get('index', ['uses' => 'SliderController@index', 'as' => 'index']);
    Route::get('create', ['uses' => 'SliderController@create', 'as' => 'create']);
    Route::post('store', ['uses' => 'SliderController@store', 'as' => 'store']);
    Route::get('edit/{slider}', ['uses' => 'SliderController@edit', 'as' => 'edit']);
    Route::post('update/{slider}', ['uses' => 'SliderController@update', 'as' => 'update']);
    Route::get('delete/{slider}', ['uses' => 'SliderController@destroy', 'as' => 'destroy']);
}); 

    Route::group(['namespace' => 'Admin\ConstantManagement', 'prefix' => 'backend/constant-management/news-letters','as' =>'backend/constant-management.news_letters.'], function () {
        Route::get('index', ['uses' => 'NewsLetterController@index', 'as' => 'index']);
        Route::get('create', ['uses' => 'NewsLetterController@create', 'as' => 'create']);
        Route::post('store', ['uses' => 'NewsLetterController@store', 'as' => 'store']);
        Route::get('edit/{news_letter}', ['uses' => 'NewsLetterController@edit', 'as' => 'edit']);
        Route::post('update/{news_letter}', ['uses' => 'NewsLetterController@update', 'as' => 'update']);
        Route::get('delete/{news_letter}', ['uses' => 'NewsLetterController@destroy', 'as' => 'destroy']);
        Route::get('/launchcampaign', ['uses' => 'NewsLetterController@launchcampaignShow', 'as' => 'launchcampaign.show']);
        Route::post('launchcampaign', ['uses' => 'NewsLetterController@runCampaign', 'as' => 'run.campaign']);
    }); 
    

    Route::group(['namespace' => 'Admin', 'prefix' => 'backend/site-content-managements','as' =>'backend.site_content_managements.'], function () {
        Route::get('index', ['uses' => 'SiteContentManagementController@index', 'as' => 'index']);
        Route::get('create', ['uses' => 'SiteContentManagementController@create', 'as' => 'create']);
        Route::post('store', ['uses' => 'SiteContentManagementController@store', 'as' => 'store']);
        Route::get('edit/{site_content_management}', ['uses' => 'SiteContentManagementController@edit', 'as' => 'edit']);
        Route::post('update/{site_content_management}', ['uses' => 'SiteContentManagementController@update', 'as' => 'update']);
        Route::get('delete/{site_content_management}', ['uses' => 'SiteContentManagementController@destroy', 'as' => 'destroy']);
    }); 
    Route::group(['namespace' => 'Admin', 'prefix' => 'backend/constant-management/faqs','as' =>'backend/constant-management.faqs.'], function () {
        Route::get('index', ['uses' => 'FaqController@index', 'as' => 'index']);
        Route::get('create', ['uses' => 'FaqController@create', 'as' => 'create']);
        Route::post('store', ['uses' => 'FaqController@store', 'as' => 'store']);
        Route::get('edit/{faq}', ['uses' => 'FaqController@edit', 'as' => 'edit']);
        Route::post('update/{faq}', ['uses' => 'FaqController@update', 'as' => 'update']);
        Route::get('delete/{faq}', ['uses' => 'FaqController@destroy', 'as' => 'destroy']);
    });

    
    
    Route::group(['middleware' => 'auth'], function () {
        Route::group(['middleware' => 'can:manage_orders','namespace' => 'Admin', 'prefix' => 'panel/orders','as' =>'panel.orders.'], function () {
            Route::get('', ['uses' => 'OrderController@index', 'as' => 'index']);
            Route::any('/print', ['uses' => 'OrderController@print', 'as' => 'print']);
            Route::get('create', ['uses' => 'OrderController@create', 'as' => 'create']);
            Route::post('store', ['uses' => 'OrderController@store', 'as' => 'store']);
            Route::get('/{order}', ['uses' => 'OrderController@show', 'as' => 'show']);
            Route::get('invoice/{order}', ['uses' => 'OrderController@invoice', 'as' => 'invoice']);
            //Route::get('show/{order}', ['uses' => 'OrderController@show', 'as' => 'show']);
            Route::get('summary/{order}', ['uses' => 'OrderController@show', 'as' => 'show']);
            Route::post('update/{order}', ['uses' => 'OrderController@update', 'as' => 'update']);
            Route::get('delete/{order}', ['uses' => 'OrderController@destroy', 'as' => 'destroy']);
            Route::post('updateStatus/{order}', ['uses' => 'OrderController@updateStatus', 'as' => 'updateStatus']);
            Route::get('update-payment-status/{order}', ['uses' => 'OrderController@updatePaymentStatus', 'as' => 'update-payment-status']);
            Route::get('show/{order}', ['uses' => 'OrderController@orderShow', 'as' => 'ordershow']);
            Route::get('status/{order}', ['uses' => 'OrderController@orderStatus', 'as' => 'orderstatus']);
            Route::post('/fileManager', ['uses' => 'OrderController@fileManager', 'as' => 'fileManager']);
            Route::get('/delete-img/{id}', ['uses' => 'OrderController@deleteImg', 'as' => 'delete-img']);
            Route::get('/chat/{id}', ['uses' => 'OrderController@createStream', 'as' => 'create-stearm']);
            Route::post('/assign-to/{order}', ['uses' => 'OrderController@assignTo', 'as' => 'assign-to']);
            Route::get('/change-assign-to/{order}', ['uses' => 'OrderController@changeAssignTo', 'as' => 'change-assign-to']);
            Route::post('/store/payment/{order}', ['uses' => 'OrderController@paymentStore', 'as' => 'payment-store']);
            Route::get('/get/user-record', ['uses' => 'OrderController@getUser', 'as' => 'get.user-record']);
            Route::get('/get/service-price', ['uses' => 'OrderController@getServicePrice', 'as' => 'get.service-price']);
            Route::get('/place/call', ['uses' => 'OrderController@placeCall', 'as' => 'place-call']);

           
        }); 
        Route::group(['namespace' => 'Panel', 'prefix' => 'panel/services','as' =>'panel.services.'], function () {
            Route::get('', ['uses' => 'ServiceController@index', 'as' => 'index']);
            Route::any('/print', ['uses' => 'ServiceController@print', 'as' => 'print']);
            Route::get('create', ['uses' => 'ServiceController@create', 'as' => 'create']);
            Route::post('store', ['uses' => 'ServiceController@store', 'as' => 'store']);
           // Route::get('/{service}', ['uses' => 'ServiceController@show', 'as' => 'show']);
            Route::get('edit/{service}', ['uses' => 'ServiceController@edit', 'as' => 'edit']);
            Route::post('update/{service}', ['uses' => 'ServiceController@update', 'as' => 'update']);
            Route::post('chat/store', ['uses' => 'ServiceController@chatStore', 'as' => 'chat.store']);
            Route::get('delete/{service}', ['uses' => 'ServiceController@destroy', 'as' => 'destroy']);
            Route::post('category', ['uses' => 'ServiceController@category', 'as' => 'category']);
            Route::get('delete-media/{id}', ['uses' => 'ServiceController@deleteMedia', 'as' => 'delete-media']);
    }); 
        
        
});   
Route::group(['middleware' => 'auth'], function () {
Route::group(['namespace' => 'Panel', 'prefix' => 'panel/payouts','as' =>'panel.payouts.'], function () {
    Route::get('', ['uses' => 'PayoutController@index', 'as' => 'index']);
    Route::any('/print', ['uses' => 'PayoutController@print', 'as' => 'print']);
    Route::get('create', ['uses' => 'PayoutController@create', 'as' => 'create']);
    Route::post('store', ['uses' => 'PayoutController@store', 'as' => 'store']);
    Route::get('/{payout}', ['uses' => 'PayoutController@show', 'as' => 'show']);
    Route::get('edit/{payout}', ['uses' => 'PayoutController@edit', 'as' => 'edit']);
    Route::post('update-status/{payout}/', ['uses' => 'PayoutController@updateStatus', 'as' => 'status']);
    Route::post('update/{payout}', ['uses' => 'PayoutController@update', 'as' => 'update']);
    Route::get('delete/{payout}', ['uses' => 'PayoutController@destroy', 'as' => 'destroy']);
}); 
    
    
    

Route::group(['namespace' => 'Panel', 'prefix' => 'panel/user-addres','as' =>'panel.user_addres.'], function () {
        Route::get('', ['uses' => 'UserAddresController@index', 'as' => 'index']);
        Route::any('/print', ['uses' => 'UserAddresController@print', 'as' => 'print']);
        Route::get('create', ['uses' => 'UserAddresController@create', 'as' => 'create']);
        Route::post('store', ['uses' => 'UserAddresController@store', 'as' => 'store']);
        Route::get('/{user_addre}', ['uses' => 'UserAddresController@show', 'as' => 'show']);
        Route::get('edit/{user_addre}', ['uses' => 'UserAddresController@edit', 'as' => 'edit']);
        Route::post('update/{user_addre}', ['uses' => 'UserAddresController@update', 'as' => 'update']);
        Route::get('delete/{user_addre}', ['uses' => 'UserAddresController@destroy', 'as' => 'destroy']);
    }); 

    
    Route::group(['middleware' => 'auth','namespace' => 'Panel', 'prefix' => 'panel/filemanager','as' =>'panel.filemanager.'], function () {
            Route::get('', ['uses' => 'FileManager@index', 'as' => 'index']);
    }); 
    Route::group(['middleware' => 'auth','namespace' => 'Panel', 'prefix' => 'panel/qr','as' =>'panel.qr.'], function () {
            Route::get('', ['uses' => 'QRController@index', 'as' => 'index']);
    }); 
    Route::group(['middleware' => 'auth','namespace' => 'Panel', 'prefix' => 'panel/map','as' =>'panel.map.'], function () {
            Route::get('', ['uses' => 'QRController@map', 'as' => 'index']);
    }); 
    
    

Route::group(['namespace' => 'Panel', 'prefix' => 'panel/user-kycs','as' =>'panel.user_kycs.'], function () {
        Route::get('', ['uses' => 'UserKycController@index', 'as' => 'index']);
        Route::any('/print', ['uses' => 'UserKycController@print', 'as' => 'print']);
        Route::get('create', ['uses' => 'UserKycController@create', 'as' => 'create']);
        Route::post('store', ['uses' => 'UserKycController@store', 'as' => 'store']);
        Route::get('/{user_kyc}', ['uses' => 'UserKycController@show', 'as' => 'show']);
        Route::get('edit/{user_kyc}', ['uses' => 'UserKycController@edit', 'as' => 'edit']);
        Route::post('update/{user_kyc}', ['uses' => 'UserKycController@update', 'as' => 'update']);
        Route::get('delete/{user_kyc}', ['uses' => 'UserKycController@destroy', 'as' => 'destroy']);
    }); 
    
    

    

Route::group(['namespace' => 'Panel', 'prefix' => 'panel/user-inviters','as' =>'panel.user_inviters.'], function () {
        Route::get('', ['uses' => 'UserInviterController@index', 'as' => 'index']);
        Route::any('/print', ['uses' => 'UserInviterController@print', 'as' => 'print']);
        Route::get('create', ['uses' => 'UserInviterController@create', 'as' => 'create']);
        Route::post('store', ['uses' => 'UserInviterController@store', 'as' => 'store']);
        Route::get('/{user_inviter}', ['uses' => 'UserInviterController@show', 'as' => 'show']);
        Route::get('edit/{user_inviter}', ['uses' => 'UserInviterController@edit', 'as' => 'edit']);
        Route::post('update/{user_inviter}', ['uses' => 'UserInviterController@update', 'as' => 'update']);
        Route::get('delete/{user_inviter}', ['uses' => 'UserInviterController@destroy', 'as' => 'destroy']);
    }); 
    
    

Route::group(['namespace' => 'Panel', 'prefix' => 'panel/portfolios','as' =>'panel.portfolios.'], function () {
        Route::get('', ['uses' => 'PortfolioController@index', 'as' => 'index']);
        Route::any('/print', ['uses' => 'PortfolioController@print', 'as' => 'print']);
        Route::get('/create', ['uses' => 'PortfolioController@create', 'as' => 'create']);
        Route::post('store', ['uses' => 'PortfolioController@store', 'as' => 'store']);
        Route::get('/{portfolio}', ['uses' => 'PortfolioController@show', 'as' => 'show']);
        Route::get('edit/{portfolio}', ['uses' => 'PortfolioController@edit', 'as' => 'edit']);
        Route::post('update/{portfolio}', ['uses' => 'PortfolioController@update', 'as' => 'update']);
        Route::get('delete/{portfolio}', ['uses' => 'PortfolioController@destroy', 'as' => 'destroy']);
    }); 
    
    

Route::group(['namespace' => 'Panel', 'prefix' => 'panel/codes','as' =>'panel.codes.'], function () {
        Route::get('', ['uses' => 'CodeController@index', 'as' => 'index']);
        Route::any('/print', ['uses' => 'CodeController@print', 'as' => 'print']);
        Route::get('create', ['uses' => 'CodeController@create', 'as' => 'create']);
        Route::post('store', ['uses' => 'CodeController@store', 'as' => 'store']);
        Route::get('/{code}', ['uses' => 'CodeController@show', 'as' => 'show']);
        Route::get('edit/{code}', ['uses' => 'CodeController@edit', 'as' => 'edit']);
        Route::post('update/{code}', ['uses' => 'CodeController@update', 'as' => 'update']);
        Route::get('delete/{code}', ['uses' => 'CodeController@destroy', 'as' => 'destroy']);
    }); 

Route::group(['namespace' => 'Panel', 'prefix' => 'panel/user-advisories','as' =>'panel.user_advisories.'], function () {
        Route::get('', ['uses' => 'UserAdvisoryController@index', 'as' => 'index']);
        Route::any('/print', ['uses' => 'UserAdvisoryController@print', 'as' => 'print']);
        Route::get('create', ['uses' => 'UserAdvisoryController@create', 'as' => 'create']);
        Route::post('store', ['uses' => 'UserAdvisoryController@store', 'as' => 'store']);
        Route::get('/{user_advisory}', ['uses' => 'UserAdvisoryController@show', 'as' => 'show']);
        Route::get('edit/{user_advisory}', ['uses' => 'UserAdvisoryController@edit', 'as' => 'edit']);
        Route::post('update/{user_advisory}', ['uses' => 'UserAdvisoryController@update', 'as' => 'update']);
        Route::get('delete/{user_advisory}', ['uses' => 'UserAdvisoryController@destroy', 'as' => 'destroy']);
        Route::get('update-status/{user_advisory}/{status}', ['uses' => 'UserAdvisoryController@updateStatus', 'as' => 'update-status']);
    }); 
    
    

// Route::group(['namespace' => 'Panel', 'prefix' => 'panel/customers','as' =>'panel.customers.'], function () {
//         Route::get('', ['uses' => 'CustomerController@index', 'as' => 'index']);
//         Route::any('/print', ['uses' => 'CustomerController@print', 'as' => 'print']);
//         Route::get('create', ['uses' => 'CustomerController@create', 'as' => 'create']);
//         Route::post('store', ['uses' => 'CustomerController@store', 'as' => 'store']);
//         Route::get('/{customer}', ['uses' => 'CustomerController@show', 'as' => 'show']);
//         Route::get('edit/{customer}', ['uses' => 'CustomerController@edit', 'as' => 'edit']);
//         Route::post('update/{customer}', ['uses' => 'CustomerController@update', 'as' => 'update']);
//         Route::get('delete/{customer}', ['uses' => 'CustomerController@destroy', 'as' => 'destroy']);
//     }); 
    
    

Route::group(['namespace' => 'Panel', 'prefix' => 'panel/medical-insurance-logics','as' =>'panel.medical_insurance_logics.'], function () {
        Route::get('', ['uses' => 'MedicalInsuranceLogicController@index', 'as' => 'index']);
        Route::any('/print', ['uses' => 'MedicalInsuranceLogicController@print', 'as' => 'print']);
        Route::get('create', ['uses' => 'MedicalInsuranceLogicController@create', 'as' => 'create']);
        Route::post('store', ['uses' => 'MedicalInsuranceLogicController@store', 'as' => 'store']);
        Route::get('/{medical_insurance_logic}', ['uses' => 'MedicalInsuranceLogicController@show', 'as' => 'show']);
        Route::get('edit/{medical_insurance_logic}', ['uses' => 'MedicalInsuranceLogicController@edit', 'as' => 'edit']);
        Route::post('update/{medical_insurance_logic}', ['uses' => 'MedicalInsuranceLogicController@update', 'as' => 'update']);
        Route::get('delete/{medical_insurance_logic}', ['uses' => 'MedicalInsuranceLogicController@destroy', 'as' => 'destroy']);
    }); 
    
    

Route::group(['namespace' => 'Panel', 'prefix' => 'panel/assumption-logics','as' =>'panel.assumption_logics.'], function () {
        Route::get('', ['uses' => 'AssumptionLogicController@index', 'as' => 'index']);
        Route::any('/print', ['uses' => 'AssumptionLogicController@print', 'as' => 'print']);
        Route::get('create', ['uses' => 'AssumptionLogicController@create', 'as' => 'create']);
        Route::post('store', ['uses' => 'AssumptionLogicController@store', 'as' => 'store']);
        Route::get('/{assumption_logic}', ['uses' => 'AssumptionLogicController@show', 'as' => 'show']);
        Route::get('edit/{assumption_logic}', ['uses' => 'AssumptionLogicController@edit', 'as' => 'edit']);
        Route::post('update/{assumption_logic}', ['uses' => 'AssumptionLogicController@update', 'as' => 'update']);
        Route::get('delete/{assumption_logic}', ['uses' => 'AssumptionLogicController@destroy', 'as' => 'destroy']);
    }); 
    
    

Route::group(['namespace' => 'Panel', 'prefix' => 'panel/investor-types','as' =>'panel.investor_types.'], function () {
        Route::get('', ['uses' => 'InvestorTypeController@index', 'as' => 'index']);
        Route::any('/print', ['uses' => 'InvestorTypeController@print', 'as' => 'print']);
        Route::get('create', ['uses' => 'InvestorTypeController@create', 'as' => 'create']);
        Route::post('store', ['uses' => 'InvestorTypeController@store', 'as' => 'store']);
        Route::get('/{investor_type}', ['uses' => 'InvestorTypeController@show', 'as' => 'show']);
        Route::get('edit/{investor_type}', ['uses' => 'InvestorTypeController@edit', 'as' => 'edit']);
        Route::post('update/{investor_type}', ['uses' => 'InvestorTypeController@update', 'as' => 'update']);
        Route::get('delete/{investor_type}', ['uses' => 'InvestorTypeController@destroy', 'as' => 'destroy']);
    }); 
    
    

Route::group(['namespace' => 'Panel', 'prefix' => 'panel/debt-logics','as' =>'panel.debt_logics.'], function () {
        Route::get('', ['uses' => 'DebtLogicController@index', 'as' => 'index']);
        Route::any('/print', ['uses' => 'DebtLogicController@print', 'as' => 'print']);
        Route::get('create', ['uses' => 'DebtLogicController@create', 'as' => 'create']);
        Route::post('store', ['uses' => 'DebtLogicController@store', 'as' => 'store']);
        Route::get('/{debt_logic}', ['uses' => 'DebtLogicController@show', 'as' => 'show']);
        Route::get('edit/{debt_logic}', ['uses' => 'DebtLogicController@edit', 'as' => 'edit']);
        Route::post('update/{debt_logic}', ['uses' => 'DebtLogicController@update', 'as' => 'update']);
        Route::get('delete/{debt_logic}', ['uses' => 'DebtLogicController@destroy', 'as' => 'destroy']);
    }); 
    
    

Route::group(['namespace' => 'Panel', 'prefix' => 'panel/investment-options','as' =>'panel.investment_options.'], function () {
        Route::get('', ['uses' => 'InvestmentOptionController@index', 'as' => 'index']);
        Route::any('/print', ['uses' => 'InvestmentOptionController@print', 'as' => 'print']);
        Route::get('create', ['uses' => 'InvestmentOptionController@create', 'as' => 'create']);
        Route::post('store', ['uses' => 'InvestmentOptionController@store', 'as' => 'store']);
        Route::get('/{investment_option}', ['uses' => 'InvestmentOptionController@show', 'as' => 'show']);
        Route::get('edit/{investment_option}', ['uses' => 'InvestmentOptionController@edit', 'as' => 'edit']);
        Route::post('update/{investment_option}', ['uses' => 'InvestmentOptionController@update', 'as' => 'update']);
        Route::get('delete/{investment_option}', ['uses' => 'InvestmentOptionController@destroy', 'as' => 'destroy']);
    }); 
    
    

    Route::group(['namespace' => 'Panel', 'prefix' => 'panel/requirements','as' =>'panel.requirements.'], function () {
        Route::get('', ['uses' => 'RequirementController@index', 'as' => 'index']);
        Route::any('/print', ['uses' => 'RequirementController@print', 'as' => 'print']);
        Route::get('create', ['uses' => 'RequirementController@create', 'as' => 'create']);
        Route::post('store', ['uses' => 'RequirementController@store', 'as' => 'store']);
        Route::get('/{requirement}', ['uses' => 'RequirementController@show', 'as' => 'show']);
        Route::get('edit/{requirement}', ['uses' => 'RequirementController@edit', 'as' => 'edit']);
        Route::post('update/{requirement}', ['uses' => 'RequirementController@update', 'as' => 'update']);
        Route::get('delete/{requirement}', ['uses' => 'RequirementController@destroy', 'as' => 'destroy']);
        Route::post('/get-subcategory', ['uses' => 'RequirementController@getSubcategory', 'as' => 'get-subcategory']);
    }); 
    Route::group(['namespace' => 'Panel', 'prefix' => 'panel/affiliate-items','as' =>'panel.affiliate-items.'], function () {
        Route::get('', ['uses' => 'AffiliateItemController@index', 'as' => 'index']);
    }); 
    
});   


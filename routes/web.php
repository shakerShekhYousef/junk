<?php

use App\Http\Controllers\Api\ApiPaymentResponseController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\dashboard\BookController;
use App\Http\Controllers\dashboard\CalendarController;
use App\Http\Controllers\dashboard\ClassController;
use App\Http\Controllers\dashboard\HomeController;
use App\Http\Controllers\dashboard\OrderController;
use App\Http\Controllers\dashboard\PackageController;
use App\Http\Controllers\dashboard\ReportController;
use App\Http\Controllers\dashboard\SessionController;
use App\Http\Controllers\dashboard\UserController;
use App\Http\Controllers\dashboard\PaymentSettingsController;
use App\Http\Controllers\front\FrontUserController;
use App\Http\Controllers\payment\CcavController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
//
Auth::routes();
//
//front-home
// Route::get('/', function () {
//     return view('front.home');
// })->name('front-home');

Route::middleware('auth')->get('viewemailrate/{id}', [FrontUserController::class, 'viewemailrate'])->name('web_view_email_rate');

Route::get('/', [FrontUserController::class, 'frontindex'])->name('front-home');
Route::middleware('admin_api')->get('/dashboard', [HomeController::class, 'index'])->name('home');
Route::get('logout/{message?}', [HomeController::class, 'logout'])->name('web_logout');
Route::post('signup', [RegisterController::class, 'create'])->name('signUp');
Route::post('smallcreate', [RegisterController::class, 'smallcreate'])->name('web_small_create');
Route::get('verifyemail/{token}', [UserController::class, 'verifyemail']);

// service rating
Route::post('servicerate/{id}', [FrontUserController::class, 'servicerate'])->name('web_service_rate');
Route::get('getuserrate/{id}', [FrontUserController::class, 'getuserrate'])->name('web_get_user_rate');

// calander group

Route::get('calanderdatashow/{classid?}/{musicid?}/{coachid?}/{weekid?}/{direcion?}', function () {
    return view('front.empty');
})->name('web_calander_data_show');
Route::get('calanderdatashow/{classid?}/{musicid?}/{coachid?}/{weekid?}/{direcion?}', [CalendarController::class, 'calanderdatashow'])->name('web_calander_data_show');
Route::group(['middleware' => 'auth'], function () {
    // Route::get('calendar', [CalendarController::class, 'index'])->name('calendar');
    // Route::get('backcalanderdatashow/{classid?}/{musicid?}/{coachid?}/{weekid?}/{direcion?}', [CalendarController::class, 'backcalanderdatashow'])->name('back_calander_data_show');
    Route::get('calanderdata/{id}/{date?}', [CalendarController::class, 'calanderdata'])->name('web_calander_data');
});
Route::group(['middleware' => ['auth', 'admin_api']], function () {
    Route::get('backcalanderdatashow/{classid?}/{musicid?}/{coachid?}/{weekid?}/{direcion?}', [CalendarController::class, 'backcalanderdatashow'])->name('back_calander_data_show');
    // Route::get('calanderdata/{id}/{date?}', [CalendarController::class, 'calanderdata'])->name('web_calander_data');
});
//
// users group
Route::group(['middleware' => 'auth'], function () {
    Route::post('addfreepackage', [FrontUserController::class, 'addfreepackage'])->name('web_add_free_package1');
    Route::post('userinfoupdate/{id}', [RegisterController::class, 'update'])->name('web_user_info_update');
    Route::middleware('admin_api')->get('createcoachview', [UserController::class, 'createcoachview'])->name('web_create_coach_view');
    Route::middleware('admin_api')->get('showcoach/{user}', [UserController::class, 'showcoach'])->name('web_show_coach');
    Route::middleware('admin_api')->get('editcoach/{user}', [UserController::class, 'editcoach'])->name('web_edit_coach');
    Route::middleware('admin_api')->delete('deletecoach/{id}', [UserController::class, 'destroycoach'])->name('web_delete_coach');
    Route::middleware('admin_api')->put('updatecoach/{user}', [UserController::class, 'updatecoach'])->name('web_update_coach');
    Route::middleware('admin_api')->get('indexcoaches', [UserController::class, 'indexcoaches'])->name('web_index_coaches');
    // Route::get('indexusers', [UserController::class, 'indexusers'])->name('web_index_users');
    Route::middleware('admin_api')->get('viewusersdatatable', [UserController::class, 'viewusersdatatable'])->name('web_view_users_data_table');
    Route::middleware('admin_api')->post('usersdatatable', [UserController::class, 'usersdatatable'])->name('web_users_data_table');

    Route::middleware('admin_api')->get('viewcoachesdatatable', [UserController::class, 'viewcoachesdatatable'])->name('web_view_coaches_data_table');
    Route::middleware('admin_api')->post('coachesdatatable', [UserController::class, 'coachesdatatable'])->name('web_coaches_data_table');
    Route::middleware('admin_api')->post('createcoach', [UserController::class, 'createcoach'])->name('web_create_coach');
    Route::middleware('admin_api')->resource('users', UserController::class);
    Route::post('adduserinfo/{id}', [UserController::class, 'adduserinfo'])->name('web_add_user_info');
    Route::post('edituserinfo/{id}', [UserController::class, 'edituserinfo'])->name('web_edit_user_info');
    // Route::get('getsessionusers/{sessionid}', [UserController::class, 'getsessionusers'])->name('web_get_session_users');
    Route::get('getcurrentusersessions', [FrontUserController::class, 'getcurrentusersessions'])->name('web_get_current_user_sessions');
    Route::get('getprevioususersessions', [FrontUserController::class, 'getprevioususersessions'])->name('web_get_previous_user_sessions');
    Route::get('getuserpackages', [FrontUserController::class, 'getuserpackages'])->name('web_get_user_packages');
    Route::get('getuserpayments', [FrontUserController::class, 'getuserpayments'])->name('web_get_user_payments');
    Route::get('getsessionusersindate/{sessionid}:{date}', [UserController::class, 'getsessionusersindate'])->name('web_get_session_users_id_date');
    Route::middleware('admin_api')->get('getfees', [FrontUserController::class, 'getfees'])->name('web_get_fees');
    Route::get('getuserfees', [FrontUserController::class, 'getuserfees'])->name('web_get_user_fees');
    Route::middleware('admin_api')->get('listservicerates', [UserController::class, 'listservicerates'])->name('web_list_service_rates');
    Route::middleware('admin_api')->delete('destroyrate/{id}', [UserController::class, 'destroyrate'])->name('web_destroy_rate');
});

// report group
// Route::group(['middleware' => 'auth'], function () {
//     Route::resource('jreports', ReportController::class);
//     Route::get('approverequest/{id}', [ReportController::class, 'approverequest'])->name('web_approve_cancel_class_request');
//     Route::post('createrequest', [ReportController::class, 'createrequest'])->name('web_create_request');
// });

// orders group
Route::group(['middleware' => ['auth', 'admin_api']], function () {
    Route::get('getordersinfo', [OrderController::class, 'getordersinfo'])->name('web_get_orders_info');
    Route::post('getordersinfodatatable', [OrderController::class, 'getordersinfodatatable'])->name('web_get_orders_info_data_table');
    Route::get('getorderinfobyid/{id}', [OrderController::class, 'getorderinfobyid'])->name('web_get_order_info_by_id');
    Route::get('getordersinfofiltered/{package?}/{user?}/{date?}/{type?}', [OrderController::class, 'getordersinfofiltered'])->name('web_get_orders_info_filtered');
});


// classes group
Route::prefix('classes')->middleware('auth', 'admin_api')->group(function () {
    Route::resource('classes', ClassController::class);
    // Route::post('createcancelclassrequest', [ClassController::class, 'createcancelclassrequest'])->name('web_create_cancel_class_request');
    // Route::get('showcancelclassrequests', [ClassController::class, 'showcancelclassrequests'])->name('web_show_cancel_class_requests');
});

///
// sessions group
Route::prefix('sessions')->middleware('auth')->group(function () {
    Route::middleware('admin_api')->resource('sessions', SessionController::class);
    Route::get('attendsession/{session?}', [SessionController::class, 'attendsession'])->name('web_attend_session');
    Route::middleware('admin_api')->get('generatesessionqrcode/{id?}', [SessionController::class, 'generatesessionqrcode'])->name('web_generate_session_qrcode');
    Route::middleware('admin_api')->get('getsessionqrcode/{id?}', [SessionController::class, 'getsessionqrcode'])->name('web_get_session_qrcode');
    // Route::post('changesessionschedule/{id?}', [SessionController::class, 'changesessionschedule'])->name('web_change_session_schedule');
    Route::get('getsessiondata/{id?}', [SessionController::class, 'getsessiondata'])->name('web_get_session_data');
    Route::middleware('admin_api')->post('adminattendsession', [SessionController::class, 'adminattendsession'])->name('web_admin_attend_session');
    Route::middleware('admin_api')->get('attendmembertosessionview', [SessionController::class, 'attendmembertosessionview'])->name('web_attend_member_to_session_view');
    // Route::get('getsessionusersinclass/{id}', [SessionController::class, 'getsessionusersinclass'])->name('web_get_session_users_in_session');
    Route::middleware('admin_api')->get('getsessionsforuserinday/{id}', [SessionController::class, 'getsessionsforuserinday'])->name('web_get_sessions_for_user_in_day');
    Route::middleware('admin_api')->get('generatesessiondailyqrcode/{id?}', [SessionController::class, 'generatesessiondailyqrcode'])->name('web_generate_session_daily_qrcode');
    Route::middleware('admin_api')->get('generatesessiondailyqrcodeview', [SessionController::class, 'generatesessiondailyqrcodeview'])->name('web_generate_session_daily_qrcode_view');
    Route::middleware('admin_api')->get('getcompletedsessions', [SessionController::class, 'getcompletedsessions'])->name('web_get_completed_sessions');
    Route::middleware('admin_api')->get('getuncompletedsessions', [SessionController::class, 'getuncompletedsessions'])->name('web_get_uncompleted_sessions1');
});

// packages group
Route::get('fclassf',[ PackageController::class, 'firstclassfree'])->name('fclassf');
Route::prefix('packages')->middleware('auth')->group(function () {
    Route::resource('packages', PackageController::class);
});
Route::prefix('musics')->middleware('auth', 'admin_api')->group(function () {
    Route::resource('musics', \App\Http\Controllers\dashboard\MusicController::class);
});
// books group
Route::prefix('books')->middleware('auth')->group(function () {
    // Route::get('getAvalilableForBooking', [BookController::class, 'getAvalilableForBooking'])->name('web_get_Avalilable_For_Booking');
    Route::resource('books', BookController::class);
    Route::middleware('admin_api')->get('viewexpirationofpurchase', [BookController::class, 'viewexpirationofpurchase'])->name('web_view_expiration_of_purchase');
});

//payment setting
Route::get('payment/{id}', [PaymentSettingsController::class, 'edit'])->name('payment');
Route::put('payment/{id}', [PaymentSettingsController::class, 'update'])->name('payment.update');

//calendar front

Route::get('front-calendar', function () {
    return view('front.calendar');
})->name('front-calendar');
//signUp
// Route::get('signUp', function () {
//     return view('front.signUp');
// })->name('signUp');
//signUp
Route::get('login', function () {
    return view('front.customer_login');
})->name('login');
//about junk
Route::get('about', function () {
    return view('front.about');
})->name('about');
//about us
Route::get('about-us', function () {
    return view('front.about-us');
})->name('about-us');
//packages
Route::get('buy-packages', [\App\Http\Controllers\front\PackageController::class, 'index'])->name('buy-packages');
Route::middleware('auth')->get('payWithCcav/{id}', [\App\Http\Controllers\payment\CcavController::class, 'dropdownhandler'])->name('dropdownpayWithCcav');
Route::middleware('auth')->post('payWithCcav', [\App\Http\Controllers\payment\CcavController::class, 'handler'])->name('payWithCcav');
Route::middleware('auth')->post('payWithCcav/response', [\App\Http\Controllers\payment\CcavResponseController::class, 'response'])->name('payWithCcav.response');
Route::middleware('auth')->post('fpayWithCcav', [\App\Http\Controllers\payment\CcavController::class, 'freezehandler'])->name('fpayWithCcav');
Route::middleware('auth')->post('fpayWithCcav/response', [\App\Http\Controllers\payment\CcavResponseController::class, 'freezresponse'])->name('fpayWithCcav.response');
Route::middleware('auth')->post('feepayWithCcav', [\App\Http\Controllers\payment\CcavController::class, 'feeshandler'])->name('feepayWithCcav');
Route::middleware('auth')->post('feepayWithCcav/response', [\App\Http\Controllers\payment\CcavResponseController::class, 'feesresponse'])->name('feepayWithCcav.response');
Route::middleware('auth')->post('api.payWithCcav/response', [ApiPaymentResponseController::class, 'response'])->name('api_payWithCcav.response');
Route::middleware('auth')->post('api.fpayWithCcav/response', [ApiPaymentResponseController::class, 'freezresponse'])->name('api_fpayWithCcav.response');
Route::middleware('auth')->post('api.feepayWithCcav/response', [ApiPaymentResponseController::class, 'feesresponse'])->name('api_feepayWithCcav.response');


//contact us
Route::get('contact-us', function () {
    return view('front.contact-us');
})->name('contact-us');
//covid-19
Route::get('covid-19', function () {
    return view('front.covid19');
})->name('covid-19');
//class information
Route::get('class-information', function () {
    return view('front.information');
})->name('class-information');
//junk-jams
Route::get('junk-jams', function () {
    return view('front.junk-jams');
})->name('junk-jams');
//privacy & policy
Route::get('privacy-policy', function () {
    return view('front.privacy-policy');
})->name('privacy-policy');
//classes
Route::get('our-classes', function () {
    return view('front.classes');
})->name('front-classes');
//terms & conditions
Route::get('terms-conditions', function () {
    return view('front.terms-conditions');
})->name('terms-conditions');
//the team
Route::get('team', function () {
    return view('front.team');
})->name('team');

route::prefix('frontusers')->middleware('auth')->group(function () {
    Route::get('myprofile', [FrontUserController::class, 'myprofile'])->name('my-profile');
    Route::post('update/{id}', [FrontUserController::class, 'update'])->name('web_front_update');
});

<?php

use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ApiClassController;
use App\Http\Controllers\Api\ApiMusicController;
use App\Http\Controllers\Api\ApiPackageController;
use App\Http\Controllers\Api\ApiReportController;
use App\Http\Controllers\Api\ApiUserController;
use App\Http\Controllers\Api\ApiSessionController;
use App\Http\Controllers\Api\ApiBookController;
use App\Http\Controllers\Api\ApiCalendarController;
use App\Http\Controllers\Api\ApiPaymentController;
use App\Http\Controllers\Api\ApiPaymentResponseController;
use App\Http\Controllers\dashboard\ReportController;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//

Route::post('login', [ApiAuthController::class, 'login']);
Route::post('register', [ApiUserController::class, 'register'])->name('api_store_user');
Route::post('loginUser', [ApiUserController::class, 'login']);
Route::post('smallRegister', [ApiUserController::class, 'smallcreate']);


// users group
Route::get('listcoaches', [ApiUserController::class, 'listcoaches']);
Route::prefix('usersapi')->middleware(['auth:api', 'admin_api'])->group(function () {
    Route::get('users', [ApiUserController::class, 'index']);
    Route::get('user/{id}', [ApiUserController::class, 'show'])->name('api_show_user');
    Route::post('addcoach', [ApiUserController::class, 'createcoach']);
    Route::post('updatecoach/{id}', [ApiUserController::class, 'updatecoach']);
    Route::get('showcoach/{id}', [ApiUserController::class, 'showcoach']);
    Route::delete('deletecoach/{id}', [ApiUserController::class, 'deletecoach']);
    Route::get('newMembers', [ApiUserController::class, 'newMembers']);
    Route::get('usersdatatable', [ApiUserController::class, 'usersdatatable']);
    Route::post('user', [ApiUserController::class, 'store'])->name('api_create_user');

    Route::post('user/{id}', [ApiUserController::class, 'update'])->name('api_update_user');
    Route::delete('user/{id}', [ApiUserController::class, 'destroy'])->name('api_delete_users');

    Route::post('adduserinfo/{id}', [ApiUserController::class, 'adduserinfo'])->name('api_add_user_info');
    Route::post('edituserinfo/{id}', [ApiUserController::class, 'edituserinfo'])->name('api_edit_user_info');
});

// users class
Route::get('classes', [ApiClassController::class, 'index'])->name('api_get_classes');
Route::prefix('classes')->middleware('auth:api')->group(function () {
    Route::get('class/{id}', [ApiClassController::class, 'show'])->name('api_show_class');

    Route::get('getcompletedclasses', [ApiClassController::class, 'getcompletedclasses'])->name('api_get_completed_classes');
    Route::get('getremainingclassess/{id}', [ApiClassController::class, 'getremainingclassess'])->name('api_get_remaining_classess');
});

Route::prefix('classes')->middleware(['auth:api', 'admin_api'])->group(function () {
    Route::post('class', [ApiClassController::class, 'store'])->name('api_store_class');
    Route::post('editclass/{id}', [ApiClassController::class, 'update'])->name('api_update_class');
    Route::delete('class/{id}', [ApiClassController::class, 'destroy'])->name('api_delete_class');
});

Route::get('sessions', [ApiSessionController::class, 'index'])->name('api_get_sessions');
Route::prefix('sessions')->middleware('auth:api')->group(function () {

    Route::get('completed', [ApiSessionController::class, 'getcompletedsessions'])->name('api_get_completed_sessions');
    Route::get('uncompleted', [ApiSessionController::class, 'getuncompletedsessions'])->name('api_get_uncompleted_sessions');
    Route::get('show/{id}', [ApiSessionController::class, 'show'])->name('api_show_session');
});

///sessions
Route::prefix('sessions')->middleware(['auth:api', 'admin_api'])->group(function () {
    Route::post('session', [ApiSessionController::class, 'store'])->name('api_store_session');
    Route::post('session/{id}', [ApiSessionController::class, 'update'])->name('api_update_session');
    Route::post('session', [ApiSessionController::class, 'adminattendsession'])->name('api_attend_session');
    Route::delete('session/{id}', [ApiSessionController::class, 'destroy'])->name('api_delete_session');

    Route::get('qrcode/{id}', [ApiSessionController::class, 'generatesessiondailyqrcode'])->name('api_qrcode');
});
///////////////books
Route::prefix('books')->middleware('auth:api')->group(function () {
    Route::get('getuserfees', [ApiBookController::class, 'getuserfees'])->name('api_get_user_fees');
    Route::post('book', [ApiBookController::class, 'store'])->name('api_store_book');
});
Route::prefix('books')->middleware(['auth:api', 'admin_api'])->group(function () {
    Route::get('getfees', [ApiBookController::class, 'getfees'])->name('api_get_fees');
    Route::get('books', [ApiBookController::class, 'index'])->name('api_get_books');
    Route::get('book/{id}', [ApiBookController::class, 'show'])->name('api_show_book');
    Route::post('book/{id}', [ApiBookController::class, 'update'])->name('api_update_book');
    Route::delete('book/{id}', [ApiBookController::class, 'destroy'])->name('api_destroy_book');



    Route::get('view', [ApiBookController::class, 'viewexpirationofpurchase']);
});

/////////////////packages group
Route::prefix('packages')->middleware('auth:api')->group(function () {

    Route::get('package/{id}', [ApiPackageController::class, 'show'])->name('api_show_package');
    Route::post('package', [ApiPackageController::class, 'store'])->name('api_store_package');
});
Route::get('packages', [ApiPackageController::class, 'index'])->name('api_get_packages');

Route::prefix('packages')->middleware(['auth:api', 'admin_api'])->group(function () {
    Route::delete('package/{id}', [ApiPackageController::class, 'destroy'])->name('api_destroy_package');
    Route::post('package/{id}', [ApiPackageController::class, 'update'])->name('api_update_package');
});
///////////////////musics group

Route::get('musics', [ApiMusicController::class, 'index'])->name('api_get_musics');
Route::prefix('musics')->middleware('auth:api')->group(function () {
    Route::get('music/{id}', [ApiMusicController::class, 'show'])->name('api_show_music');
});
Route::prefix('musics')->middleware(['auth:api', 'admin_api'])->group(function () {
    Route::post('music', [ApiMusicController::class, 'store'])->name('api_create_music');
    Route::post('music/{id}', [ApiMusicController::class, 'update'])->name('api_update_music');
    Route::delete('music/{id}', [ApiMusicController::class, 'destroy'])->name('api_destroy_music');
});
///////////////////////calendar group
Route::prefix('calendar')->middleware('auth:api')->group(function () {
    Route::get('calendar/{id}/{date?}', [ApiCalendarController::class, 'calanderdata'])->name('api_get_session_with_id_date');
});

Route::get('calanderdatashow/{classid?}/{musicid?}/{coachid?}/{weekid?}/{direcion?}', [ApiCalendarController::class, 'calanderdatashow'])->name('api_calander_data_show');
Route::prefix('calendar')->middleware(['auth:api', 'admin_api'])->group(function () {
    Route::get('backcalanderdatashow/{classid?}/{musicid?}/{coachid?}/{weekid?}', [ApiCalendarController::class, 'backcalanderdatashow'])->name('api_back_calander_data_show');
});
/////////////report group
Route::prefix('report')->middleware(['auth:api', 'admin_api'])->group(function () {
    Route::get('ordersinfo', [ApiReportController::class, 'getordersinfo'])->name('api_get_orders_info');
    Route::get('listservicerates', [ApiReportController::class, 'listservicerates'])->name('api_list_service_rates');
    Route::delete('servicerate/{id}', [ApiReportController::class, 'destroyrate'])->name('api_delete_service_rate');
    Route::get('usersreports', [ApiReportController::class, 'usersdatatable'])->name('api_view_users_info');
    Route::get('ordersfiltered/{package?}/{user?}/{date?}/{type?}', [ApiReportController::class, 'getordersinfofiltered'])->name('api_orders_filtered');
});

Route::middleware('auth:api')->group(function () {
    Route::post('api.payWithCcav', [ApiPaymentController::class, 'handler'])->name('api_payWithCcav');
    Route::post('api.freezehandler', [ApiPaymentController::class, 'freezehandler'])->name('api_fpayWithCcav');
    Route::post('api.feehandler', [ApiPaymentController::class, 'feeshandler'])->name('api_feepayWithCcav');
});

// Route::middleware('auth')->group(function () {
//     Route::post('api.payWithCcav/response', [ApiPaymentResponseController::class, 'response'])->name('api_payWithCcav.response');// });

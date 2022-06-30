<?php

use App\Http\Controllers\Api\ConsultationController;
use App\Http\Controllers\Api\MrdController;
use App\Http\Controllers\Api\PhotoCategoryController;
use App\Http\Controllers\Api\UserApiController;
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

 // Admin Interface Routes
Route::controller(UserApiController::class)->group(function () {
     Route::post('check-login','checkLogin');
     Route::post('save-user','saveUser');
});

Route::group(['middleware' => ['cors', 'json.response', 'api.key','apiauth:sanctum']], function () {

    Route::controller(MrdController::class)->group(function () {
        Route::post('add-mrdphoto', 'store');
        Route::get('ipd-registrations/{id}', 'ipdRegistrations');
        Route::get('opd-registrations/{id}', 'opdRegistrations');
        Route::get('dc-registrations/{id}', 'dcRegistrations');
        Route::get('searchMRD', 'searchMRD');
        Route::get('searchPatientName', 'searchPatientName');
        Route::get('searchMobileNo', 'searchMobileNo');
        Route::post('editMRD', 'editMRD');
    });

    // PhotoCategory USED ROUTES
    Route::controller(PhotoCategoryController::class)->group(function () {
        Route::post('save-category', 'store');
        Route::get('get-category', 'getCategory');
        Route::get('get-category/{id}', 'getCategoryById');
        Route::post('update-category', 'update');
        Route::get('category-by-department/{id}', 'categoryByDepartment');
    });

    // DOCTOR CONSULTATION
    Route::controller(ConsultationController::class)->group(function () {
        Route::get('search-consultation', 'searchConsultation');
        Route::get('patient-summary/{id}', 'patientSummary');
        Route::get('past-registrations/{id}', 'pastRegistrations');
        Route::get('get-investigations/{id}', 'getInvestigations');
        Route::get('get-investigations-report/{id}', 'getInvestigationsReport');
        Route::post('save-prescription', 'savePrescription');
        Route::post('update-remark', 'updateRemark');
        Route::post('update-discount', 'updateDiscount');
    });

});

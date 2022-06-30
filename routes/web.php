<?php

use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\MrdController;
use App\Http\Controllers\PhotoCategoryController;
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

Route::get('/', function () {
    return view('index');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');

    // MRD CONTROLLER USED ROUTES
    Route::controller(MrdController::class)->group(function () {
        Route::get('photoupload', 'photoMediaUpload');
        Route::get('mrdrecords', 'mrdRecords');
        Route::post('add-mrdphoto', 'store');
        Route::get('ipd-registrations/{id}', 'ipdRegistrations');
        Route::get('opd-registrations/{id}', 'opdRegistrations');
        Route::get('dc-registrations/{id}', 'dcRegistrations');
        Route::get('searchMRD', 'searchMRD');
        Route::get('searchPatientName', 'searchPatientName');
        Route::get('searchMobileNo', 'searchMobileNo');
        Route::get('view-mrd-details/{id}', 'viewMRDDetails');
        Route::post('editMRD', 'editMRD');
    });

    // PhotoCategory USED ROUTES
    Route::controller(PhotoCategoryController::class)->group(function () {
        Route::get('add-category', 'addCategory');
        Route::post('save-category', 'store');
        Route::get('get-category', 'getCategory');
        Route::get('get-category/{id}', 'getCategoryById');
        Route::post('update-category', 'update');
        Route::get('category-by-department/{id}', 'categoryByDepartment');
    });

    // DOCTOR CONSULTATION
    Route::controller(ConsultationController::class)->group(function () {
        Route::get('doctor-consultation', 'index');
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

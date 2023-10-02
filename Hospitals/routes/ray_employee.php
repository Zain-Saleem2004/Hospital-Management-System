<?php

use App\Http\Controllers\Dashboard_doctor\DiagnosticController;
use App\Http\Controllers\Dashboard_doctor\LaboratorieController;
use App\Http\Controllers\Dashboard_doctor\PatientDetailsController;
use App\Http\Controllers\Dashboard_doctor\RayController;
use App\Http\Controllers\Dashboard_ray_employee\InvoiceController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization as LaravelLocalization;
// use Mcamara\LaravelLocalization\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {


        //================RayEmployee dashboard==================

        Route::get('/dashboard/ray_employee', function () {
            return view('Dashboard.dashboard_RayEmployee.dashboard');
        })->middleware(['auth:ray_employee'])->name('dashboard.ray_employee');

        Route::middleware('auth:ray_employee')->group(function () {
            
        Route::resource('ray_invoices',InvoiceController::class);
        Route::get('completedInvoices',[InvoiceController::class,'completed_invoices'])->name('completedInvoices');
        Route::get('view_rays/{id}',[InvoiceController::class,'viewRays'])->name('view_rays');

        


        });

        require __DIR__ . '/auth.php';
    }
);

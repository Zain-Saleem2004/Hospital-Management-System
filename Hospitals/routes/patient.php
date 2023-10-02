<?php

use App\Http\Controllers\Dashboard_doctor\DiagnosticController;
use App\Http\Controllers\Dashboard_doctor\LaboratorieController;
use App\Http\Controllers\Dashboard_doctor\PatientDetailsController;
use App\Http\Controllers\Dashboard_doctor\RayController;
use App\Http\Controllers\Dashboard_patient\PatientController;
use App\Http\Controllers\Dashboard_ray_employee\InvoiceController;
use App\Http\Livewire\Chat\Createchat;
use App\Http\Livewire\Chat\Main;
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


        //================Patient dashboard==================

        Route::get('/dashboard/patient', function () {
            return view('Dashboard.dashboard_patient.dashboard');
        })->middleware(['auth:patient'])->name('dashboard.patient');

        Route::middleware('auth:patient')->group(function () {
            Route::get('invoices',[PatientController::class,'invoices'])->name('invoices.patient');
            Route::get('laboratorie',[PatientController::class,'laboratories'])->name('laboratories.patient');
            Route::get('laboratorie/{id}',[PatientController::class,'viewLaboratories'])->name('laboratories.view');
            Route::get('rays',[PatientController::class,'rays'])->name('rays.patient');
            Route::get('rays/{id}',[PatientController::class,'viewRays'])->name('rays.view');
            Route::get('payments',[PatientController::class,'payments'])->name('payments.patient');

        // =======================================Chat Route==============================================

            Route::get('list/doctor',Createchat::class)->name('list.doctor');
            Route::get('chat/doctor',Main::class)->name('chat.doctor');


        // =======================================End Chat Route==============================================

            
        
        });

        require __DIR__ . '/auth.php';
    }
);

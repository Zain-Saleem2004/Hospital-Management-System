<?php

use App\Http\Controllers\Dashboard_doctor\DiagnosticController;
use App\Http\Controllers\Dashboard_doctor\LaboratorieController;
use App\Http\Controllers\Dashboard_doctor\PatientDetailsController;
use App\Http\Controllers\Dashboard_doctor\RayController;
use App\Http\Controllers\doctor\InvoiceController;
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


        //================Doctor dashboard==================

        Route::get('/dashboard/doctor', function () {
            return view('Dashboard.Doctor.dashboard');
        })->middleware(['auth:doctor'])->name('dashboard.doctor');




        Route::middleware('auth:doctor')->group(function () {
        Route::prefix('doctor')->group(function(){

             //invoices route

             Route::get('reviewInvoices',[InvoiceController::class,'reviewInvoices'])->name('reviewInvoices');
             Route::get('completed_Invoices',[InvoiceController::class,'completedInvoices'])->name('completed_Invoices');

             Route::resource('invoices',InvoiceController::class);


             
             Route::post('add_review', [DiagnosticController::class,'addReview'])->name('add_review');

             //Diagnostic route
             Route::resource('Diagnostics',DiagnosticController::class);

             //Rays route
             Route::resource('Rays',RayController::class);

             Route::get('patient_details/{id}',[PatientDetailsController::class,'index'])->name('patient_details');

             Route::resource('Laboratories',LaboratorieController::class); 
             Route::get('show_laboratorie/{id}',[InvoiceController::class,'showLaboratorie'])->name('show_laboratorie'); 


             // =======================================Chat Route==============================================

            Route::get('list/patients',Createchat::class)->name('list.patients');
            Route::get('chat/patients',Main::class)->name('chat.patients');


        // =======================================End Chat Route==============================================

            
                   
           
        });
            
           

        });


        require __DIR__ . '/auth.php';
    }
);

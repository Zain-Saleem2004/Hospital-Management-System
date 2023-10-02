<?php

use App\Events\MyEvent;
use App\Http\Controllers\Dashboard\AmbulanceController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\DoctorController;
use App\Http\Controllers\Dashboard\InsuranceController;
use App\Http\Controllers\Dashboard\LaboratorieEmployeeController;
use App\Http\Controllers\Dashboard\PatientController;
use App\Http\Controllers\Dashboard\PaymentAccountController;
use App\Http\Controllers\Dashboard\RayEmployeeController;
use App\Http\Controllers\Dashboard\ReceiptAccountController;
use App\Http\Controllers\Dashboard\SectionController;
use App\Http\Controllers\Dashboard\SingleServiceController;
use App\Http\Controllers\ProfileController;
use App\Models\Ambulance;
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

Route::get("/Dashboard_Admin", [DashboardController::class, 'index']);


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {

        //================User dashboard==================
        Route::get('/dashboard/user', function () {
         
            return view('Dashboard.User.dashboard');
        })->middleware(['auth'])->name('dashboard.user');


        //================Admin dashboard==================

        Route::get('/dashboard/admin', function () {
            
            return view('Dashboard.Admin.dashboard');
        })->middleware(['auth:admin'])->name('dashboard.admin');







        Route::middleware('auth:admin')->group(function () {

            // =============================  Section route  =========================================================
            Route::resource('Sections', SectionController::class);



            // =============================  Doctor route  =========================================================
            Route::resource('Doctors', DoctorController::class);
            Route::post('update_password', [DoctorController::class, 'update_password'])->name('update_password');
            Route::post('update_status', [DoctorController::class, 'update_status'])->name('update_status');


            // =============================  Service route  =========================================================
            Route::resource('Service', SingleServiceController::class);


            // =============================  GroubService route  =========================================================
            Route::view('Add_GroubServices', 'livewire.GroubService.include_create')->name('Add_GroubServices');


            // =============================  Insurance route  =========================================================
            Route::resource('Insurance', InsuranceController::class);

            // =============================  Ambulance route  =========================================================
            Route::resource('Ambulance', AmbulanceController::class);

            // =============================  Ambulance route  =========================================================
            Route::resource('Patients', PatientController::class);

            // =============================  singleInvoices route  =========================================================
            Route::view('single_invoices', 'livewire.single_invoices.index')->name('single_invoices');
            Route::view('Print_single_invoices', 'livewire.single_invoices.print')->name('Print_single_invoices');

            // =============================  Receipts route  =========================================================
            Route::resource('Receipt',ReceiptAccountController::class);
            
            // =============================  Receipts route  =========================================================
            Route::resource('Payment',PaymentAccountController::class);
           
            // =============================  Ray_Employee route  =========================================================
            Route::resource('ray_employee',RayEmployeeController::class);

            // =============================  Laboratorie_Employee route  =========================================================
            Route::resource('laboratorie_employee',LaboratorieEmployeeController::class);



             // =============================  GroubInvoices route  =========================================================
             Route::view('group_invoices', 'livewire.Group_invoices.index')->name('group_invoices');
             Route::view('group_Print_single_invoices', 'livewire.Group_invoices.print')->name('group_Print_single_invoices');
 
        });


        require __DIR__ . '/auth.php';
    }
);

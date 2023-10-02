<?php

use App\Http\Controllers\Dashboard_doctor\DiagnosticController;
use App\Http\Controllers\Dashboard_doctor\LaboratorieController;
use App\Http\Controllers\Dashboard_doctor\PatientDetailsController;
use App\Http\Controllers\Dashboard_doctor\RayController;
use App\Http\Controllers\Dashboard_laboratorie_employee\LaboratorieEmployeeController;
use App\Http\Controllers\Dashboard_ray_employee\InvoiceController;
use App\Repository\Dashboard_Laboratorie_Employee\InvoicesRepository;
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

        Route::get('/dashboard/laboratorie_employee', function () {
            return view('Dashboard.dashboard_LaboratorieEmployee.dashboard');
        })->middleware(['auth:laboratorie_employee'])->name('dashboard.laboratorie_employee');

        Route::middleware('auth:laboratorie_employee')->group(function () {
            

        //############################# invoices route ##########################################
        Route::resource('invoices_laboratorie_employee', LaboratorieEmployeeController::class);
        Route::get('completed_invoices', [LaboratorieEmployeeController::class,'completed_invoices'])->name('completed_invoices');
        Route::get('view_laboratories/{id}', [LaboratorieEmployeeController::class,'view_laboratories'])->name('view_laboratories');
        //############################# end invoices route ######################################


        


        });

        require __DIR__ . '/auth.php';
    }
);

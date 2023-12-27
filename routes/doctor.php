<?php

use App\Http\Livewire\Chat\Main;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Chat\Createchat;
use App\Http\Controllers\doctor\InvoiceController;
use App\Http\Controllers\Dashboard_Doctor\RayController;
use App\Http\Controllers\Dashboard_Doctor\DiagnosticController;
use App\Http\Controllers\Dashboard_Doctor\LaboratorieController;
use App\Http\Controllers\Dashboard_Doctor\PatientDetailsController;

/*
|--------------------------------------------------------------------------
| Doctor Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {


        //################################ dashboard doctor ########################################

        Route::get('/dashboard/doctor', function () {
            return view('Dashboard.doctor.dashboard');
        })->middleware(['auth:doctor'])->name('dashboard.doctor');

        //################################ end dashboard doctor #####################################

        //---------------------------------------------------------------------------------------------------------------


        Route::middleware(['auth:doctor'])->group(function () {
            Route::view('404', 'Dashboard.404')->name('404');

            // Route::prefix('doctor')->group(function () {
            //     Route::resource('invoices', InvoiceController::class);
            // });

            Route::middleware(['auth:doctor'])->prefix('doctor')->group(function () {
                //############################# completed_invoices route ##########################################
                Route::get('completed_invoices', [InvoiceController::class, 'completedInvoices'])->name('completedInvoices');
                //############################# end invoices route ################################################

                //############################# review_invoices route ##########################################
                Route::get('review_invoices', [InvoiceController::class, 'reviewInvoices'])->name('reviewInvoices');
                //############################# end invoices route #############################################

                //############################# invoices route ##########################################
                Route::resource('invoices', InvoiceController::class);
                //############################# end invoices route #############################################

                //############################# add_review route ##########################################
                Route::post('add_review', [DiagnosticController::class, 'addReview'])->name('add_review');
                //############################# end add_review route #############################################

                //############################# Diagnostics route ##########################################
                Route::resource('Diagnostics', DiagnosticController::class);
                //############################# Diagnostics route ##########################################

                //############################# ray route ##########################################
                Route::resource('ray', RayController::class);
                //############################# ray route ##########################################

                //############################# ray route ##########################################
                Route::get('patient_details/{id}', [PatientDetailsController::class, 'index'])->name('patient_details');
                //############################# ray route ##########################################

                //  Route::get('/invoice_get/{id}', [InvoiceController::class, 'invoiceGet'])->name('invoice_get');

                //############################# laboratories route ##########################################
                Route::resource('laboratories', LaboratorieController::class);
                //############################# end laboratories route ##########################################

                Route::get('show_notification/{id}', [PatientDetailsController::class, 'showNotification'])->name('show_notification');


            //############################# Chat route ##########################################
            Route::get('list/patients',Createchat::class)->name('list.patients');
            Route::get('chat/patients',Main::class)->name('chat.patients');
            //############################# end Chat route ######################################

            });
        });




        require __DIR__ . '/auth.php';
    }
);

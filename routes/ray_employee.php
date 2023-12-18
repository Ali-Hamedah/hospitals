<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard_RayEmployee\InvoiceController;


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

        Route::get('/dashboard/ray_employee', function () {
            return view('Dashboard.dashboard_RayEmployee.dashboard');
        })->middleware(['auth:ray_employee'])->name('dashboard.ray_employee');

        //################################ end dashboard doctor #####################################

        //---------------------------------------------------------------------------------------------------------------


        // Route::middleware(['auth:ray_employee'])->group(function () {

            // Route::prefix('doctor')->group(function () {
            //     Route::resource('invoices', InvoiceController::class);
            // });

            Route::middleware(['auth:ray_employee'])->group(function () {
                Route::view('404','Dashboard.404')->name('404');

    //############################# invoices route ##########################################
     Route::resource('invoices_ray_employee', InvoiceController::class);

     Route::get('completed_invoices', [InvoiceController::class, 'completed_invoices'])->name('completed_invoices');
    //############################# end invoices route ######################################

    });




        require __DIR__ . '/auth.php';
    }
);

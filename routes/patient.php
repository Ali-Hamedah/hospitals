<?php

use Illuminate\Support\Facades\Route;






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

        Route::get('/dashboard/patient', function () {
            return view('Dashboard.Dashboard_Patient.dashboard');
        })->middleware(['auth:patient'])->name('dashboard.patient');

        //################################ end dashboard doctor #####################################

        //---------------------------------------------------------------------------------------------------------------



    // //############################# end invoices route ######################################






        require __DIR__ . '/auth.php';
    }
);

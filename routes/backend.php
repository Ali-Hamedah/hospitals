<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\SectionController;



/*
|--------------------------------------------------------------------------
| backend Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/Dashboard_Admin', [DashboardController::class, 'index']);




Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){
         //################################ dashboard user ##########################################
    Route::get('/dashboard/user', function () {
        return view('Dashboard.User.dashboard');
    })->middleware(['auth'])->name('dashboard.user');
    //################################ end dashboard user #####################################



    //################################ dashboard admin ########################################
    Route::get('/dashboard/admin', function () {
        return view('Dashboard.Admin.dashboard');
    })->middleware(['auth:admin'])->name('dashboard.admin');

    //################################ end dashboard admin #####################################


    //---------------------------------------------------------------------------------------------------------------


    Route::middleware(['auth:admin'])->group(function () {

        //############################# sections route ##########################################

            Route::resource('Sections', SectionController::class);

        //############################# end sections route ######################################
    });

require __DIR__.'/auth.php';

    });


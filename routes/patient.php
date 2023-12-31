<?php

use App\Http\Livewire\Chat\Main;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Chat\Createchat;
use App\Http\Controllers\Dashboard_Patient\PatientController;






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

        Route::middleware(['auth:patient'])->group(function () {
            Route::view('404','Dashboard.404')->name('404');

            Route::get('invoices_patient', [PatientController::class, 'invoices'])->name('invoices.patient');

            Route::get('laboratories_patient', [PatientController::class, 'laboratories'])->name('laboratories.patient');

            Route::get('view_laboratories/{id}', [PatientController::class, 'viewLaboratories'])->name('view_laboratories');

            Route::get('rays_patient', [PatientController::class, 'raysPatient'])->name('rays.patient');

            Route::get('view_rays/{id}', [PatientController::class, 'viewRays'])->name('view_rays');

            Route::get('Payments_patient', [PatientController::class, 'Payments'])->name('Payments.patient');

             //############################# Chat route ##########################################
         Route::get('list/doctors',Createchat::class)->name('list.doctors');
         Route::get('chat/doctors',Main::class)->name('chat.doctors');
         //############################# end Chat route ######################################


    });









        require __DIR__ . '/auth.php';
    }
);

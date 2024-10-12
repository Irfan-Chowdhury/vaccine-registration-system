<?php

use App\Http\Controllers\VaccineRegistrationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/registration', [VaccineRegistrationController::class, 'create'])->name('registration');
Route::post('/registration', [VaccineRegistrationController::class, 'store'])->name('store');



// Route::group(['prefix' => 'vaccine-registration'], function () {
//     Route::get('/', [VaccineRegistrationController::class, 'userIdentificationPage'])->name('vaccine-registration.userIdentificationPage');
//     Route::post('/user-identification-proess', [VaccineRegistrationController::class, 'userIdentificationProcess'])->name('vaccine-registration.userIdentificationProcess');
//     Route::post('/user-information', [VaccineRegistrationController::class, 'userInformationPage'])->name('vaccine-registration.userInformationPage');
//     Route::post('/confirmation', [VaccineRegistrationController::class, 'confirmationPage'])->name('vaccine-registration.confirmationPage');
//     Route::post('/confirmation-process', [VaccineRegistrationController::class, 'confirmationProcess'])->name('vaccine-registration.confirmationProcess');
// });

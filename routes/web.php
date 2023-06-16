<?php

use App\Http\Controllers\FormRegistrationController;
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

/**
 * Home Page
 */

Route::get('/', function () {
   return view('home');
});

/**
 *  Registration Page
 */

 Route::get('/registration', [FormRegistrationController::class, 'showForm'])->name('registration');

 Route::post('/registration', [FormRegistrationController::class, 'register'])->name('registration.submit');






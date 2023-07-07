<?php

use App\Http\Controllers\AuthLoginController;
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
    return view('pages.index');
 })->middleware('auth', 'verified')->name('index');



// test JSON reponse
Route::post('/liveusernamechecking',
    [FormRegistrationController::class,
    'checkUsernameAvailability'
])->name('checkUsername.submit');

// test JSON reponse
Route::get('/liveusernamechecking',
    [FormRegistrationController::class,
    'showFormUser'
])->name('checkUsername');




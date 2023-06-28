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
   return view('home');
})->name('index');

/**
 * Home Page
 */

 Route::get('/', [FormRegistrationController::class,
 'getListName'
])->name('show');


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


/**
 *  Registration Page
 */

Route::get('/registration',
    [FormRegistrationController::class,
    'showForm'
])->name('registration');

Route::post('/registration',
    [FormRegistrationController::class,
    'register'
])->name('registration.submit');

/**
 * Login Successful
*/

// login after registration
Route::get('/loginhome', function() {
    return view('loginhome');
})->name('loginhome');

// login

Route::post('/', [AuthLoginController::class,
    'login'
])->name('login.submit');

// logout
Route::post('logout' ,[AuthLoginController::class,
    'logout'
])->name('logout.submit');

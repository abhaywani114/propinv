<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserManagementController;

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

//User Management Routes
Route::get('usermanagement/login', [UserManagementController::class, "login"])->
	name('usermanagement.login')->middleware('guest');

Route::get('usermanagement/signup', [UserManagementController::class, "signup"])->
	name('usermanagement.signup')->middleware('guest');;

Route::get('usermanagement/verify-email/{hash}', [UserManagementController::class, "verifyEmail"])->
	name('usermanagement.verify.email')->middleware('guest');;

Route::post('usermanagement/signup-handle', [UserManagementController::class, "signupHanlde"])->
	name('usermanagement.signup.handle')->middleware('guest');;

Route::post('usermanagement/login-handle', [UserManagementController::class, "loginHandle"])->
	name('usermanagement.login.handle');

Route::post('usermanagement/reset', [UserManagementController::class, "reset"])->
	name('usermanagement.reset');

Route::get('usermanagement/logout', [UserManagementController::class, "logout"])->
	name('usermanagement.logout');

Route::get('usermanagement/change-password', [UserManagementController::class, "changePassword"])->
  name('usermanagement.change_password');

Route::post('usermanagement/change-password-handle', [UserManagementController::class, "changePasswordHandle"])->
  name('usermanagement.change_password.handle');


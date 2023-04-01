<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\HandleRequestsController;

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
})->middleware('auth');

Route::get('/contact-us', function () {
    return view('contact_us');
})->name('contact_us');



//User Management Routes
Route::get('usermanagement/login', [UserManagementController::class, "login"])->
	name('usermanagement.login')->middleware('guest');

Route::get('usermanagement/signup', [UserManagementController::class, "signup"])->
	name('usermanagement.signup')->middleware('guest');;

Route::get('usermanagement/verify-email/{hash}', [UserManagementController::class, "verifyEmail"])->
	name('usermanagement.verify.email');

Route::post('usermanagement/signup-handle', [UserManagementController::class, "signupHanlde"])->
	name('usermanagement.signup.handle')->middleware('guest');;

Route::post('usermanagement/login-handle', [UserManagementController::class, "loginHandle"])->
	name('usermanagement.login.handle')->middleware('guest');

Route::post('usermanagement/reset', [UserManagementController::class, "reset"])->
	name('usermanagement.reset')->middleware('guest');

Route::get('usermanagement/logout', [UserManagementController::class, "logout"])->
	name('usermanagement.logout')->middleware('auth');

Route::get('usermanagement/change-password', [UserManagementController::class, "changePassword"])->
  name('usermanagement.change_password')->middleware('auth');

Route::post('usermanagement/change-password-handle', [UserManagementController::class, "changePasswordHandle"])->
  name('usermanagement.change_password.handle')->middleware('auth');

//##########################

Route::post('usermanagement/datatable', [UserManagementController::class, "userDatatable"])->
  name('usermanagement.datatable_main')->middleware('auth');

Route::post('usermanagement/ban-user', [UserManagementController::class, "banUser"])->
  name('usermanagement.user.ban')->middleware('auth');

//######################### Handle user requests

Route::post('request/form_1', [HandleRequestsController::class, "form1"])->
  name('request.form1')->middleware('auth');

Route::post('request/contact_form', [HandleRequestsController::class, "contactForm"])->
  name('request.contact_form');


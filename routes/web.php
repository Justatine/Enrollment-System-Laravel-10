<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
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

Route::resource('users', UserController::class)->only('store');
  Route::get('/', [Controller::class, 'index'])->name('index');

Route::group(['middleware' => ['guest']], function () {
  Route::get('/register', [Controller::class, 'register'])->name('register');
  Route::post('/authenticate', [Controller::class, 'authenticate'])->name('authenticate');
});

Route::group(['middleware' => ['auth']], function () {
  Route::get('/logout', [Controller::class, 'logout'])->name('logout');
  Route::resource('users', UserController::class)->only('show');

  Route::group(['prefix' => 'users/', 'as' => 'users.'], function () {
    Route::put('updatePersonalInfo/{user}', [UserController::class, 'updatePersonalInfo'])->name('updatePersonalInfo');
    Route::put('updatePassword/{user}', [UserController::class, 'updatePassword'])->name('updatePassword');
  });

  Route::group(['middleware' => ['administrators']], function () {
    Route::resource('enrollments', EnrollmentController::class)->only('index', 'update');
    Route::resource('users', UserController::class)->only('update', 'destroy', 'index');
    Route::resource('subjects', SubjectController::class)->only('index', 'store', 'update', 'destroy');
  });
});

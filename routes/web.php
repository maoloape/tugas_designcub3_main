<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\FindController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EmailController;
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


Route::get('/', [HomeController::class, 'home']);
//Dashboard
Route::get('/dashboard', [HomeController::class, 'home'])->name('dashboard');;

//Lokasi
Route::get('/find_location', [FindController::class, 'index'])->name('find_location');
Route::get('/data-lokasi', [FindController::class, 'getDataLokasi'])->name('data-lokasi');
Route::get('/get-cities', [FindController::class, 'getCities']);
Route::get('/get-districts', [FindController::class, 'getDistricts']);
Route::get('/get-villages', [FindController::class, 'getVillages']);

//email
Route::get('/email', [EmailController::class, 'index'])->name('email');
Route::get('/email/data', [EmailController::class, 'getEmails'])->name('email.data');
Route::delete('/email/{id}', [EmailController::class, 'destroy'])->name('email.destroy');
Route::post('/email', [EmailController::class, 'store'])->name('email.store');
Route::put('/email/{id}', [EmailController::class, 'update'])->name('email.update');

<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ScanController;
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



Route::get('/customers', [CustomerController::class, 'index']);

Route::get('/scans', [ScanController::class, 'index']);

Route::get('/error', function () {
    $message = session('message') ?: 'Oops! Something went wrong. Please try again later.';
    return view('error.error')->with('message', $message);
})->name('error');

Route::get('/', function () {
    return view('welcome');
});

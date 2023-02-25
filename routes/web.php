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

Route::group(['prefix' => 'scans'], function () {
    Route::get('/', [ScanController::class, 'index']);
    Route::get('/{id}', [ScanController::class, 'show']);
});


Route::get('/error', function () {
    return view('error.error');
})->name('error');

Route::get('/', function () {
    return view('welcome');
});

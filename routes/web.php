<?php

use App\Http\Controllers\FirebaseController;
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

Route::group(['prefix' => 'admin'], function () {
    Route::get('/dashboard/{dataType}', [FirebaseController::class, 'showDashboard']);
    Route::get('/history', function () {
        return view('history.history');
    });
    // Route::get('/history/{dataType}', [FirebaseController::class, 'showHistory']);
    Route::get('/history/{dataType}', [FirebaseController::class, 'showHistory']);
    
});

Route::get('/auth/login', function () {
    return view('auth.login');
});
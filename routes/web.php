<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FirebaseController;

Route::get('/test-firebase-connection', [FirebaseController::class, 'testFirebaseConnection']);
Route::get('/firebase-data', [FirebaseController::class, 'getAllData']);
Route::get('/', function () {
    return view('welcome');
});

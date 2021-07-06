<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['api','auth:api'])->group(function () {
    // Get user info

    Route::get('/check-authenticate-user', function (){
        return response()->json(200);
    })->name('check-auth');


    Route::get('/edit-profile', function (){
        return view('edit.profile');
    })->name('edit-profile');
    // Logout user from application
//    Route::post('/logout', [LoginController::class .'logout']);
});

Route::middleware(['verify_api'])->group(function () {
    Route::get('/api-check', function (){
//        return view('edit_profile');
        return response()->json(200);
    });
});



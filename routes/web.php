<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');


Route::middleware(['web'])->group(function () {


    Route::middleware(['jwt_auth_check'])->group(function () {

        Route::get('/home', [HomeController::class, 'index'])->name('home');

        Route::get('/edit-profile', function (){

            return view('edit_profile');

        })->name('edit-profile');

        Route::post('/profile-update', function (Request $request){

            auth()->user()->update(['name'=> $request->name]);
            return view('edit_profile');

        })->name('profile-update');



        Route::get('/test', function () {
            echo 'ami asi eikhane';
        });
    });

    Route::get('/token', function (){
        session(['jwt_token' => null]);
    });


});





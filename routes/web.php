<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Identify;

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
    return view('auth.login');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get("/manpower_readonly",[App\Http\Controllers\ManPowerController::class,'index']);

Route::post("/manpower/{method}", [App\Http\Controllers\ManPowerController::class, 'response']);

Route::middleware([Identify::class])->group(function(){
    Route::get('/{viewname}',[App\Http\Controllers\Projects::class, 'index']);

    Route::post("/projects/{method}", [App\Http\Controllers\Projects::class, 'response']);

    
    
    
    Route::get('/download/{filename}',[App\Http\Controllers\Projects::class, 'index']);
});


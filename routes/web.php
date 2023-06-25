<?php

use App\Http\Controllers\StudentController;
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

Route::get('/display', function () {
     return view('display');
 });

// route in laravel 9
Route::controller(StudentController::class)->group(function(){

    Route::get('/','index');
    Route::post('post','store');
    Route::get('show/{first}/{last}','show');

});
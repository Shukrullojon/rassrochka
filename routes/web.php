<?php

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
Auth::routes();
Route::get('/', function (){
    return redirect('/home');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware'=>'auth'],function (){
    // Archive
    Route::get('/archive/index',[\App\Http\Controllers\ArchiveController::class,'index'])->name('archiveIndex');
    //Get
    Route::get('/get/index',[\App\Http\Controllers\GetController::class,'index'])->name('getIndex');
    Route::get('/get/create',[\App\Http\Controllers\GetController::class,'create'])->name('getCreate');
    Route::post('/get/store',[\App\Http\Controllers\GetController::class,'store'])->name('getStore');
    //Give
    Route::get('/give/index',[\App\Http\Controllers\GiveController::class,'index'])->name('giveIndex');
    //Statistics
    Route::get('/statistics/index',[\App\Http\Controllers\StatisticsController::class,'index'])->name('statisticsIndex');
});

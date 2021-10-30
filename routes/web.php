<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Blade\RoleController;
use App\Http\Controllers\Blade\PermissionController;
use App\Http\Controllers\Blade\ApiUserController;

Route::get('/cache', function() {
    $exitCode = \Illuminate\Support\Facades\Artisan::call('cache:clear');
    $exitCode = \Illuminate\Support\Facades\Artisan::call('config:cache');
    return 'DONE'; //Return anything
})->name('cache');


Auth::routes();

// Welcome page
Route::get('/', function (){
    return redirect()->route('home');
})->name('welcome');

Route::group(['middleware'=>'auth'],function (){
    // Home
    Route::get('/home', [\App\Http\Controllers\HomeController::class,'index'])->name('home');
    Route::post('/home/payment',[\App\Http\Controllers\HomeController::class,'payment'])->name('homePayment');

    // Archive
    Route::get('/archive/archievegetindex',[\App\Http\Controllers\ArchiveController::class,'archievegetindex'])->name('archieveGetIndex');
    Route::get('/archive/archievegiveindex',[\App\Http\Controllers\ArchiveController::class,'archievegiveindex'])->name('archieveGiveIndex');
    Route::get('/archive/archievegetview/{id}',[\App\Http\Controllers\ArchiveController::class,'archievegetview'])->name('archieveGetView');
    Route::get('/archive/archievegiveview/{id}',[\App\Http\Controllers\ArchiveController::class,'archievegiveview'])->name('archieveGiveView');
    Route::get('/archive/getdelete/{id}',[\App\Http\Controllers\ArchiveController::class,'getdelete'])->name('getdelete');
    Route::get('/archive/givedelete/{id}',[\App\Http\Controllers\ArchiveController::class,'givedelete'])->name('givedelete');
    //Get
    Route::get('/get/index',[\App\Http\Controllers\GetController::class,'index'])->name('getIndex');
    Route::get('/get/create',[\App\Http\Controllers\GetController::class,'create'])->name('getCreate');
    Route::get('/get/archieve/{id}',[\App\Http\Controllers\GetController::class,'archieve'])->name('getArchieve');
    Route::post('/get/store',[\App\Http\Controllers\GetController::class,'store'])->name('getStore');
    Route::post('/get/payment',[\App\Http\Controllers\GetController::class,'payment'])->name('getPayment');
    Route::post('/get/comment',[\App\Http\Controllers\GetController::class,'comment'])->name('getComment');
    Route::post('/get/changesms',[\App\Http\Controllers\GetController::class,'changesms'])->name('getChangeSms');
    Route::post('/get/getchangephone',[\App\Http\Controllers\GetController::class,'getchangephone'])->name('getChangePhone');
    Route::get('/get/getpaymentdelete/{id}',[\App\Http\Controllers\GetController::class,'getpaymentdelete'])->name('getPaymentDelete');
    //Give
    Route::get('/give/index',[\App\Http\Controllers\GiveController::class,'index'])->name('giveIndex');
    Route::get('/give/create',[\App\Http\Controllers\GiveController::class,'create'])->name('giveCreate');
    Route::get('/give/archieve/{id}',[\App\Http\Controllers\GiveController::class,'archieve'])->name('giveArchieve');
    Route::post('/give/store',[\App\Http\Controllers\GiveController::class,'store'])->name('giveStore');
    Route::post('/give/payment',[\App\Http\Controllers\GiveController::class,'payment'])->name('givePayment');
    Route::post('/give/comment',[\App\Http\Controllers\GiveController::class,'comment'])->name('giveComment');
    Route::post('/give/changesms',[\App\Http\Controllers\GiveController::class,'changesms'])->name('giveChangeSms');
    Route::post('/give/givechangephone',[\App\Http\Controllers\GiveController::class,'givechangephone'])->name('giveChangePhone');
    Route::get('/give/givepaymentdelete/{id}',[\App\Http\Controllers\GiveController::class,'givepaymentdelete'])->name('givePaymentDelete');
    //Statistics
    Route::get('/statistics/index',[\App\Http\Controllers\StatisticsController::class,'index'])->name('statisticsIndex');
    //Sms
    Route::get('/sms/get',[\App\Http\Controllers\SmsController::class,'get'])->name('smsGet');
    Route::get('/sms/give',[\App\Http\Controllers\SmsController::class,'give'])->name('smsGive');
    // user
    Route::get('/user/index',[\App\Http\Controllers\UserController::class,'index'])->name('userIndex');
    Route::get('/user/create',[\App\Http\Controllers\UserController::class,'create'])->name('userCreate');
    Route::post('/user/store',[\App\Http\Controllers\UserController::class,'store'])->name('userStore');
    Route::get('/user/edit/{id}',[\App\Http\Controllers\UserController::class,'edit'])->name('userEdit');
    Route::post('/user/update',[\App\Http\Controllers\UserController::class,'update'])->name('userUpdate');
    Route::get('/user/delete/{id}',[\App\Http\Controllers\UserController::class,'delete'])->name('userDelete');
});

// Web pages
Route::group(['middleware' => 'auth'],function (){
    // Users
    /*Route::get('/users',[UserController::class,'index'])->name('userIndex');
    Route::get('/user/add',[UserController::class,'add'])->name('userAdd');
    Route::post('/user/create',[UserController::class,'create'])->name('userCreate');
    Route::get('/user/{id}/edit',[UserController::class,'edit'])->name('userEdit');
    Route::post('/user/update/{id}',[UserController::class,'update'])->name('userUpdate');
    Route::delete('/user/delete/{id}',[UserController::class,'destroy'])->name('userDestroy');*/
    Route::get('/user/theme-set/{id}',[App\Http\Controllers\Blade\UserController::class,'setTheme'])->name('userSetTheme');
    // Permissions

});

// Change language session condition
Route::get('/language/{lang}',function ($lang){
    $lang = strtolower($lang);
    if ($lang == 'ru' || $lang == 'uz')
    {
        session([
            'locale' => $lang
        ]);
    }
    return redirect()->back();
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Blade\UserController;
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
    //Get
    Route::get('/get/index',[\App\Http\Controllers\GetController::class,'index'])->name('getIndex');
    Route::get('/get/create',[\App\Http\Controllers\GetController::class,'create'])->name('getCreate');
    Route::get('/get/archieve/{id}',[\App\Http\Controllers\GetController::class,'archieve'])->name('getArchieve');
    Route::post('/get/store',[\App\Http\Controllers\GetController::class,'store'])->name('getStore');
    Route::post('/get/payment',[\App\Http\Controllers\GetController::class,'payment'])->name('getPayment');
    Route::post('/get/comment',[\App\Http\Controllers\GetController::class,'comment'])->name('getComment');
    Route::post('/get/changesms',[\App\Http\Controllers\GetController::class,'changesms'])->name('getChangeSms');
    //Give
    Route::get('/give/index',[\App\Http\Controllers\GiveController::class,'index'])->name('giveIndex');
    Route::get('/give/create',[\App\Http\Controllers\GiveController::class,'create'])->name('giveCreate');
    Route::get('/give/archieve/{id}',[\App\Http\Controllers\GiveController::class,'archieve'])->name('giveArchieve');
    Route::post('/give/store',[\App\Http\Controllers\GiveController::class,'store'])->name('giveStore');
    Route::post('/give/payment',[\App\Http\Controllers\GiveController::class,'payment'])->name('givePayment');
    Route::post('/give/changesms',[\App\Http\Controllers\GiveController::class,'changesms'])->name('giveChangeSms');
    //Statistics
    Route::get('/statistics/index',[\App\Http\Controllers\StatisticsController::class,'index'])->name('statisticsIndex');
});

// Web pages
Route::group(['middleware' => 'auth'],function (){
    // Users
    Route::get('/users',[UserController::class,'index'])->name('userIndex');
    Route::get('/user/add',[UserController::class,'add'])->name('userAdd');
    Route::post('/user/create',[UserController::class,'create'])->name('userCreate');
    Route::get('/user/{id}/edit',[UserController::class,'edit'])->name('userEdit');
    Route::post('/user/update/{id}',[UserController::class,'update'])->name('userUpdate');
    Route::delete('/user/delete/{id}',[UserController::class,'destroy'])->name('userDestroy');
    Route::get('/user/theme-set/{id}',[UserController::class,'setTheme'])->name('userSetTheme');
    // Permissions
    Route::get('/permissions',[PermissionController::class,'index'])->name('permissionIndex');
    Route::get('/permission/add',[PermissionController::class,'add'])->name('permissionAdd');
    Route::post('/permission/create',[PermissionController::class,'create'])->name('permissionCreate');
    Route::get('/permission/{id}/edit',[PermissionController::class,'edit'])->name('permissionEdit');
    Route::post('/permission/update/{id}',[PermissionController::class,'update'])->name('permissionUpdate');
    Route::delete('/permission/delete/{id}',[PermissionController::class,'destroy'])->name('permissionDestroy');
    // Roles
    Route::get('/roles',[RoleController::class,'index'])->name('roleIndex');
    Route::get('/role/add',[RoleController::class,'add'])->name('roleAdd');
    Route::post('/role/create',[RoleController::class,'create'])->name('roleCreate');
    Route::get('/role/{role_id}/edit',[RoleController::class,'edit'])->name('roleEdit');
    Route::post('/role/update/{role_id}',[RoleController::class,'update'])->name('roleUpdate');
    Route::delete('/role/delete/{id}',[RoleController::class,'destroy'])->name('roleDestroy');
    // ApiUsers
    Route::get('/api-users',[ApiUserController::class,'index'])->name('api-userIndex');
    Route::get('/api-user/add',[ApiUserController::class,'add'])->name('api-userAdd');
    Route::post('/api-user/create',[ApiUserController::class,'create'])->name('api-userCreate');
    Route::get('/api-user/show/{id}',[ApiUserController::class,'show'])->name('api-userShow');
    Route::get('/api-user/{id}/edit',[ApiUserController::class,'edit'])->name('api-userEdit');
    Route::post('/api-user/update/{id}',[ApiUserController::class,'update'])->name('api-userUpdate');
    Route::delete('/api-user/delete/{id}',[ApiUserController::class,'destroy'])->name('api-userDestroy');
    Route::delete('/api-user-token/delete/{id}',[ApiUserController::class,'destroyToken'])->name('api-tokenDestroy');

    Route::get('/category', 'Blade\CategoryController@index');
    Route::get('/category/add', 'Blade\CategoryController@add');
    Route::post('/category/store', 'Blade\CategoryController@store');
    Route::get('/category/edit/{id}', 'Blade\CategoryController@edit');
    Route::post('/category/update/{id}', 'Blade\CategoryController@update');
    Route::get('/category/img/{resource}', 'Blade\CategoryController@img');
    Route::get('/category/view/{id}', 'Blade\CategoryController@view');


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

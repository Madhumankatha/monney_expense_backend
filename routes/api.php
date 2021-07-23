<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemoController;
use \App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use \App\Http\Controllers\TransactionController;
use \App\Http\Controllers\DashboardController;

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

Route::prefix('user')->group(function (){
    Route::post('/register',[AuthController::class,'register']);
    Route::post('/login',[AuthController::class,'login']);
    Route::post('/logout',[AuthController::class,'logout']);


    Route::get('email',function (){
        $details['email'] = 'madhumankatha@gmail.com';

        dispatch(new \App\Jobs\sendRegisterMailJob($details));

        dd('Send Email Successfully');
    });

    Route::get('send',[\App\Http\Controllers\MailController::class,'sendMail']);
    Route::middleware('auth:sanctum')->group(function (){

        Route::get('/profile',[AuthController::class,'profile']);

        Route::apiResource('/customer',CustomerController::class);
        Route::apiResource('/transaction',TransactionController::class);
        Route::get('/dashboard',[DashboardController::class,'dashboard']);

    });

});




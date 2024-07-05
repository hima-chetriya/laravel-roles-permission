<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

 // Register
 Route::post('register',[ApiController::class,'Register']);
 // Login
 Route::post('login',[ApiController::class,'Login']);


 Route::group([
    "middleware" => ['auth:sanctum']
 ], function(){
 // Login
 Route::post('profile',[ApiController::class,'Profile']);
 Route::post('logout',[ApiController::class,'Logout']);
 Route::post('forgot-password',[ApiController::class,'ForgotPassword']);
 Route::post('verify-otp',[ApiController::class,'verifyOTP']);
 Route::post('reset-password',[ApiController::class,'resetPassword']);
 Route::post('change-password',[ApiController::class,'changePassword']);
 });

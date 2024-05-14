<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SmsController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/sms',[SmsController::class, 'loadPage'])->name('sms');
Route::post('/sendSms',[SmsController::class, 'sendSms'])->name('sendSms');
Route::get('/sendSms', [SmsController::class, 'sendSms'])->name('sendSms');

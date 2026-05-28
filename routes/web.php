<?php

use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});

Route::post('/registrations', [RegistrationController::class, 'store'])
    ->name('registrations.store');

Route::get('/thank-you/{reference}', [RegistrationController::class, 'show'])
    ->name('registrations.thank-you');

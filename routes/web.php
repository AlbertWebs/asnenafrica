<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PaymentSettingController;
use App\Http\Controllers\Admin\RegistrationController as AdminRegistrationController;
use App\Http\Controllers\RegistrationController;
use App\Models\PaymentSetting;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing', [
        'paymentConfig' => [
            'options' => [
                'kcb' => PaymentSetting::get('option_kcb'),
                'paybill' => PaymentSetting::get('option_paybill'),
                'cheque' => PaymentSetting::get('option_cheque'),
            ],
            'kcb' => [
                'bank' => PaymentSetting::get('kcb_bank_name', 'KCB'),
                'name' => PaymentSetting::get('kcb_account_name'),
                'number' => PaymentSetting::get('kcb_account_number'),
            ],
            'paybill' => [
                'number' => PaymentSetting::get('paybill_number'),
                'account' => PaymentSetting::get('paybill_account_number'),
            ],
            'cheque' => [
                'payee' => PaymentSetting::get('cheque_payee'),
            ],
        ],
    ]);
});

Route::post('/registrations', [RegistrationController::class, 'store'])
    ->name('registrations.store');

Route::get('/thank-you/{reference}', [RegistrationController::class, 'show'])
    ->name('registrations.thank-you');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login']);
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('registrations', [AdminRegistrationController::class, 'index'])->name('registrations.index');
        Route::get('registrations/{registration}', [AdminRegistrationController::class, 'show'])->name('registrations.show');
        Route::patch('registrations/{registration}', [AdminRegistrationController::class, 'update'])->name('registrations.update');
        Route::get('payment-settings', [PaymentSettingController::class, 'edit'])->name('payment-settings.edit');
        Route::put('payment-settings', [PaymentSettingController::class, 'update'])->name('payment-settings.update');
    });
});

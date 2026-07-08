<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DevToolsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PaymentSettingController;
use App\Http\Controllers\Admin\RegistrationController as AdminRegistrationController;
use App\Http\Controllers\Admin\SentEmailController;
use App\Http\Controllers\Admin\TestDataController;
use App\Http\Controllers\RegistrationController;
use App\Models\PaymentSetting;
use Illuminate\Support\Facades\Route;

Route::get('/sitemap.xml', function () {
    $base = rtrim(config('app.url'), '/');
    $lastmod = now()->toAtomString();
    $xml = '<?xml version="1.0" encoding="UTF-8"?>'
        .'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'
        .'<url><loc>'.e($base.'/').'</loc><lastmod>'.$lastmod.'</lastmod><changefreq>weekly</changefreq><priority>1.0</priority></url>'
        .'</urlset>';

    return response($xml, 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
})->name('sitemap');

Route::get('/', function () {
    $chequeOption = PaymentSetting::get('option_cheque', 'Cheque (written in favour of ASNEN)');
    $chequePayee = PaymentSetting::get('cheque_payee', 'ASNEN');

    // Keep public wording ASNEN-only (strip any leftover " / Acorn").
    $chequeOption = preg_replace('/\s*\/\s*Acorn/i', '', (string) $chequeOption);
    $chequePayee = preg_replace('/\s*\/\s*Acorn/i', '', (string) $chequePayee);
    $chequePayee = trim($chequePayee) !== '' ? trim($chequePayee) : 'ASNEN';

    if (stripos($chequeOption, 'ASNEN') !== false && stripos($chequeOption, 'favour') === false && stripos($chequeOption, 'favor') === false) {
        $chequeOption = 'Cheque (written in favour of ASNEN)';
    }

    return view('landing', [
        'paymentConfig' => [
            'options' => [
                'kcb' => PaymentSetting::get('option_kcb'),
                'paybill' => PaymentSetting::get('option_paybill'),
                'cheque' => $chequeOption,
                'cash' => PaymentSetting::get('option_cash'),
            ],
            'bank' => [
                'name' => PaymentSetting::get('kcb_bank_name', 'Co-operative Bank'),
                'account_name' => PaymentSetting::get('kcb_account_name'),
                'account_number' => PaymentSetting::get('kcb_account_number', '01103095242001'),
            ],
            'paybill' => [
                'number' => PaymentSetting::get('paybill_number', '400200'),
                'account' => PaymentSetting::get('paybill_account_number', '01103095242001'),
            ],
            'cheque' => [
                'payee' => $chequePayee,
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
        Route::get('sent-emails', [SentEmailController::class, 'index'])->name('sent-emails.index');
        Route::get('payment-settings', [PaymentSettingController::class, 'edit'])->name('payment-settings.edit');
        Route::put('payment-settings', [PaymentSettingController::class, 'update'])->name('payment-settings.update');
        Route::delete('test-data', [TestDataController::class, 'destroy'])->name('test-data.purge');
        Route::delete('registrations/purge-all', [TestDataController::class, 'destroyAll'])->name('registrations.purge-all');
        Route::get('dev-tools', [DevToolsController::class, 'index'])->name('dev-tools.index');
        Route::post('dev-tools/run', [DevToolsController::class, 'run'])->name('dev-tools.run');
    });
});

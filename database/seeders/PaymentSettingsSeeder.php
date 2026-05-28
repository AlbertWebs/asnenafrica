<?php

namespace Database\Seeders;

use App\Models\PaymentSetting;
use Illuminate\Database\Seeder;

class PaymentSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'option_kcb', 'label' => 'KCB option label', 'group' => 'options', 'sort_order' => 1,
                'value' => 'KCB Bank Account — Africa Special Needs Education Network (1319601561)'],
            ['key' => 'option_paybill', 'label' => 'M-Pesa Paybill option label', 'group' => 'options', 'sort_order' => 2,
                'value' => 'M-Pesa Paybill (522533)'],
            ['key' => 'option_cheque', 'label' => 'Cheque option label', 'group' => 'options', 'sort_order' => 3,
                'value' => 'Cheque — Africa Special Needs Education Network'],
            ['key' => 'kcb_bank_name', 'label' => 'KCB bank name', 'group' => 'kcb', 'sort_order' => 10, 'value' => 'KCB'],
            ['key' => 'kcb_account_name', 'label' => 'KCB account name', 'group' => 'kcb', 'sort_order' => 11,
                'value' => 'Africa Special Needs Education Network'],
            ['key' => 'kcb_account_number', 'label' => 'KCB account number', 'group' => 'kcb', 'sort_order' => 12, 'value' => '1319601561'],
            ['key' => 'paybill_number', 'label' => 'M-Pesa Paybill number', 'group' => 'paybill', 'sort_order' => 20, 'value' => '522533'],
            ['key' => 'paybill_account_number', 'label' => 'M-Pesa account number', 'group' => 'paybill', 'sort_order' => 21, 'value' => '1319601561'],
            ['key' => 'cheque_payee', 'label' => 'Cheque payee', 'group' => 'cheque', 'sort_order' => 30,
                'value' => 'Africa Special Needs Education Network'],
        ];

        foreach ($settings as $setting) {
            PaymentSetting::query()->updateOrCreate(
                ['key' => $setting['key']],
                $setting,
            );
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\PaymentSetting;
use Illuminate\Database\Seeder;

class PaymentSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'option_kcb', 'label' => 'Bank transfer option label', 'group' => 'options', 'sort_order' => 1,
                'value' => 'Bank Transfer'],
            ['key' => 'option_paybill', 'label' => 'M-Pesa Paybill option label', 'group' => 'options', 'sort_order' => 2,
                'value' => 'M-Pesa Paybill'],
            ['key' => 'option_cheque', 'label' => 'Cheque option label', 'group' => 'options', 'sort_order' => 3,
                'value' => 'Cheque (written in favour of ASNEN)'],
            ['key' => 'option_cash', 'label' => 'Cash option label', 'group' => 'options', 'sort_order' => 4,
                'value' => 'Cash on the first day (by prior arrangement)'],
            ['key' => 'kcb_bank_name', 'label' => 'Bank name', 'group' => 'kcb', 'sort_order' => 10, 'value' => 'Co-operative Bank'],
            ['key' => 'kcb_account_name', 'label' => 'Bank account name', 'group' => 'kcb', 'sort_order' => 11,
                'value' => 'Africa Special Needs Education Network'],
            ['key' => 'kcb_account_number', 'label' => 'Bank account number', 'group' => 'kcb', 'sort_order' => 12, 'value' => '01103095242001'],
            ['key' => 'paybill_number', 'label' => 'M-Pesa Paybill number', 'group' => 'paybill', 'sort_order' => 20, 'value' => '400200'],
            ['key' => 'paybill_account_number', 'label' => 'M-Pesa account number', 'group' => 'paybill', 'sort_order' => 21, 'value' => '01103095242001'],
            ['key' => 'cheque_payee', 'label' => 'Cheque payee', 'group' => 'cheque', 'sort_order' => 30,
                'value' => 'ASNEN'],
        ];

        foreach ($settings as $setting) {
            PaymentSetting::query()->updateOrCreate(
                ['key' => $setting['key']],
                $setting,
            );
        }
    }
}

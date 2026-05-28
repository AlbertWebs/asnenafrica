<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => env('ADMIN_EMAIL', 'admin@asnenafrica.org')],
            [
                'name' => 'ASNEN Administrator',
                'password' => env('ADMIN_PASSWORD', 'AsnenMasterclass2026!'),
                'is_admin' => true,
            ],
        );
    }
}

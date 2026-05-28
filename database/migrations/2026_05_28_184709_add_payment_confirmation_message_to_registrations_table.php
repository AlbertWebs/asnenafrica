<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->text('payment_confirmation_message')->nullable()->after('admin_notes');
            $table->timestamp('payment_confirmed_at')->nullable()->after('payment_confirmation_message');
        });
    }

    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropColumn(['payment_confirmation_message', 'payment_confirmed_at']);
        });
    }
};

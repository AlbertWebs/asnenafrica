<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->string('status')->default('pending')->after('consent_comms');
            $table->text('admin_notes')->nullable()->after('status');
            $table->timestamp('followed_up_at')->nullable()->after('admin_notes');
        });
    }

    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropColumn(['status', 'admin_notes', 'followed_up_at']);
        });
    }
};

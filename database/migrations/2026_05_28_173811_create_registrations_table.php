<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->string('school_name');
            $table->string('school_type');
            $table->string('county');
            $table->string('address')->nullable();
            $table->string('school_phone');
            $table->string('school_email');
            $table->string('lead_name');
            $table->string('lead_role');
            $table->string('lead_phone');
            $table->string('lead_email');
            $table->string('tier');
            $table->unsignedInteger('participant_count');
            $table->unsignedInteger('rate_per_participant');
            $table->unsignedInteger('total_amount');
            $table->text('accessibility')->nullable();
            $table->text('dietary')->nullable();
            $table->string('payment_mode');
            $table->boolean('confirm_authority');
            $table->boolean('confirm_attendance');
            $table->boolean('consent_comms')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};

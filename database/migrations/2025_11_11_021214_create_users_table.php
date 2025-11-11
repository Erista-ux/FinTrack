<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('username', 100)->unique();
            $table->string('password');
            $table->enum('type', ['standard', 'advance', 'admin'])->default('standard');
            $table->string('phone', 20)->nullable();
            $table->text('address')->nullable();
            $table->string('profile_image')->nullable();

            // Data keuangan
            $table->decimal('monthly_income', 15, 2)->default(0);
            $table->decimal('monthly_expense', 15, 2)->default(0);
            $table->decimal('total_balance', 15, 2)->default(0);
            $table->decimal('savings_target', 15, 2)->default(10000000);

            // Data bisnis (khusus advance)
            $table->string('business_name')->nullable();
            $table->string('business_type', 100)->nullable();
            $table->text('business_address')->nullable();
            $table->string('tax_id', 50)->nullable();

            // Status & timestamps
            $table->boolean('is_active')->default(true);
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

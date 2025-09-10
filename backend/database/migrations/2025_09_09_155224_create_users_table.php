<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            // Primary key
            $table->id();

            // Authentication
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

            // Phân quyền
            $table->enum('role', ['admin', 'manager', 'staff', 'customer'])->default('customer');
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active');

            // Thông tin cá nhân
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('avatar')->nullable();

            // Timestamps
            $table->timestamps();
            $table->softDeletes(); // Xóa mềm
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('suppliers', function (Blueprint $table) {
            // Primary key
            $table->id();

            // Thông tin nhà cung cấp
            $table->string('name');
            $table->string('code')->unique()->comment('Mã nhà cung cấp');
            $table->string('contact_person')->nullable()->comment('Người liên hệ');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('tax_code')->nullable()->comment('Mã số thuế');

            // Thông tin thanh toán
            $table->string('bank_name')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('bank_account_name')->nullable();

            // Trạng thái
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->text('notes')->nullable()->comment('Ghi chú');

            // Timestamps
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};

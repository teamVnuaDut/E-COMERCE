<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            // Primary key
            $table->id();

            // Khóa ngoại
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Thông tin thanh toán
            $table->string('payment_number')->unique()->comment('Mã thanh toán');
            $table->enum('payment_method', ['cod', 'bank_transfer', 'momo', 'vnpay', 'credit_card'])->default('cod');
            $table->enum('payment_status', ['pending', 'processing', 'completed', 'failed', 'refunded'])->default('pending');
            $table->decimal('amount', 12, 2)->default(0)->comment('Số tiền thanh toán');
            $table->decimal('amount_refunded', 12, 2)->default(0)->comment('Số tiền đã hoàn trả');

            // Thông tin giao dịch
            $table->string('transaction_id')->nullable()->comment('Mã giao dịch từ cổng thanh toán');
            $table->string('transaction_code')->nullable()->comment('Mã giao dịch nội bộ');
            $table->text('transaction_data')->nullable()->comment('Dữ liệu giao dịch (JSON)');

            // Thông tin ngân hàng (nếu có)
            $table->string('bank_name')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('bank_account_name')->nullable();
            $table->string('bank_transfer_content')->nullable()->comment('Nội dung chuyển khoản');

            // Thông tin thẻ (nếu có)
            $table->string('card_number')->nullable()->comment('Số thẻ (lưu hash)');
            $table->string('card_holder_name')->nullable();
            $table->string('card_expiry_date')->nullable();
            $table->string('card_cvv')->nullable()->comment('Mã CVV (lưu hash)');

            // Thời gian thanh toán
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('refunded_at')->nullable();
            $table->timestamp('failed_at')->nullable();

            // Ghi chú
            $table->text('payment_notes')->nullable()->comment('Ghi chú thanh toán');
            $table->text('admin_notes')->nullable()->comment('Ghi chú quản trị viên');

            // Timestamps
            $table->timestamps();

            // Indexes
            $table->index('payment_number');
            $table->index('order_id');
            $table->index('user_id');
            $table->index('payment_status');
            $table->index('transaction_id');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

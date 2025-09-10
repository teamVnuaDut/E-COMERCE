<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            // Primary key
            $table->id();

            // Khóa ngoại
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Thông tin giỏ hàng
            $table->string('session_id')->nullable()->comment('ID session cho khách vãng lai');
            $table->decimal('total_amount', 12, 2)->default(0)->comment('Tổng tiền');
            $table->decimal('discount_amount', 12, 2)->default(0)->comment('Tổng giảm giá');
            $table->decimal('tax_amount', 12, 2)->default(0)->comment('Tổng thuế');
            $table->decimal('shipping_amount', 12, 2)->default(0)->comment('Phí vận chuyển');
            $table->decimal('grand_total', 12, 2)->default(0)->comment('Tổng cộng');

            // Thông tin coupon
            $table->foreignId('coupon_id')->nullable()->constrained()->onDelete('set null');
            $table->string('coupon_code')->nullable();
            $table->decimal('coupon_discount', 12, 2)->default(0)->comment('Giảm giá từ coupon');

            // Trạng thái
            $table->boolean('is_active')->default(true);
            $table->boolean('is_guest')->default(false)->comment('Giỏ hàng của khách vãng lai');

            // Timestamps
            $table->timestamps();
            $table->timestamp('abandoned_at')->nullable()->comment('Thời điểm bỏ giỏ hàng');

            // Indexes
            $table->index('user_id');
            $table->index('session_id');
            $table->index('is_active');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};

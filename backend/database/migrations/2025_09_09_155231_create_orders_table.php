<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            // Primary key
            $table->id();

            // Khóa ngoại
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('cart_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('coupon_id')->nullable()->constrained()->onDelete('set null');

            // Thông tin đơn hàng
            $table->string('order_number')->unique()->comment('Mã đơn hàng');
            $table->enum('status', [
                'pending',
                'confirmed',
                'processing',
                'shipped',
                'delivered',
                'cancelled',
                'refunded'
            ])->default('pending');

            // Thông tin giá cả
            $table->decimal('subtotal', 12, 2)->default(0)->comment('Tổng tiền hàng');
            $table->decimal('discount_amount', 12, 2)->default(0)->comment('Giảm giá sản phẩm');
            $table->decimal('coupon_discount', 12, 2)->default(0)->comment('Giảm giá từ coupon');
            $table->decimal('tax_amount', 12, 2)->default(0)->comment('Thuế');
            $table->decimal('shipping_amount', 12, 2)->default(0)->comment('Phí vận chuyển');
            $table->decimal('grand_total', 12, 2)->default(0)->comment('Tổng thanh toán');

            // Thông tin coupon
            $table->string('coupon_code')->nullable();

            // Thông tin khách hàng
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->string('customer_name');

            // Thông tin giao hàng
            $table->string('shipping_name')->nullable();
            $table->string('shipping_phone')->nullable();
            $table->text('shipping_address')->nullable();
            $table->string('shipping_city')->nullable();
            $table->string('shipping_district')->nullable();
            $table->string('shipping_ward')->nullable();

            // Thông tin thanh toán
            $table->enum('payment_method', ['cod', 'bank_transfer', 'momo', 'vnpay'])->default('cod');
            $table->enum('payment_status', ['pending', 'paid', 'failed', 'refunded'])->default('pending');
            $table->timestamp('paid_at')->nullable();

            // Thông tin giao hàng
            $table->timestamp('shipped_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();

            // Ghi chú
            $table->text('customer_notes')->nullable();
            $table->text('admin_notes')->nullable();

            // Timestamps
            $table->timestamps();

            // Indexes
            $table->index('order_number');
            $table->index('user_id');
            $table->index('status');
            $table->index('payment_status');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            // Primary key
            $table->id();

            // Khóa ngoại
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('restrict');

            // Thông tin sản phẩm tại thời điểm đặt hàng
            $table->string('product_name');
            $table->string('product_sku');
            $table->decimal('price', 12, 2)->default(0)->comment('Giá tại thời điểm đặt hàng');
            $table->decimal('original_price', 12, 2)->default(0)->comment('Giá gốc');
            $table->decimal('discount_amount', 12, 2)->default(0)->comment('Giảm giá trên mỗi sản phẩm');

            // Số lượng
            $table->integer('quantity')->default(1);

            // Thuộc tính sản phẩm
            $table->json('attributes')->nullable()->comment('Thuộc tính sản phẩm được chọn');

            // Tổng tiền
            $table->decimal('subtotal', 12, 2)->default(0)->comment('Tổng tiền = price * quantity');
            $table->decimal('total', 12, 2)->default(0)->comment('Tổng sau giảm giá = subtotal - (discount_amount * quantity)');

            // Thông tin bổ sung
            $table->string('image')->nullable()->comment('Ảnh sản phẩm tại thời điểm đặt hàng');
            $table->text('notes')->nullable()->comment('Ghi chú cho sản phẩm');

            // Trạng thái
            $table->enum('status', ['pending', 'shipped', 'delivered', 'cancelled', 'returned'])->default('pending');

            // Timestamps
            $table->timestamps();

            // Indexes
            $table->index('order_id');
            $table->index('product_id');
            $table->index('product_sku');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};

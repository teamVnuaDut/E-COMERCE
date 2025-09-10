<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            // Primary key
            $table->id();

            // Khóa ngoại
            $table->foreignId('cart_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');

            // Thông tin sản phẩm
            $table->string('product_name');
            $table->string('product_sku');
            $table->decimal('price', 12, 2)->default(0);
            $table->decimal('original_price', 12, 2)->default(0)->comment('Giá gốc trước khi giảm');
            $table->decimal('discount_amount', 12, 2)->default(0)->comment('Số tiền giảm giá');
            $table->decimal('tax_amount', 12, 2)->default(0)->comment('Thuế');

            // Số lượng
            $table->integer('quantity')->default(1);
            $table->integer('max_quantity')->nullable()->comment('Số lượng tối đa có thể mua');

            // Thuộc tính sản phẩm (nếu có)
            $table->json('attributes')->nullable()->comment('Thuộc tính sản phẩm được chọn');

            // Tổng tiền
            $table->decimal('subtotal', 12, 2)->default(0)->comment('Tổng tiền = price * quantity');
            $table->decimal('total', 12, 2)->default(0)->comment('Tổng sau giảm giá = subtotal - discount_amount');

            // Thông tin bổ sung
            $table->string('image')->nullable()->comment('Ảnh sản phẩm');
            $table->text('notes')->nullable()->comment('Ghi chú cho sản phẩm');

            // Timestamps
            $table->timestamps();

            // Indexes
            $table->index('cart_id');
            $table->index('product_id');
            $table->index('product_sku');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};

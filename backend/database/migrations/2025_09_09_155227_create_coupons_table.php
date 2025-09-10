<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('coupons', function (Blueprint $table) {
            // Primary key
            $table->id();

            // Thông tin mã giảm giá
            $table->string('code')->unique();
            $table->string('name');
            $table->text('description')->nullable();

            // Loại giảm giá
            $table->enum('type', ['percentage', 'fixed_amount'])->default('percentage');
            $table->decimal('discount_value', 10, 2);
            $table->decimal('min_order_amount', 10, 2)->nullable()->comment('Đơn hàng tối thiểu');
            $table->decimal('max_discount_amount', 10, 2)->nullable()->comment('Giảm tối đa');

            // Số lần sử dụng
            $table->integer('usage_limit')->nullable()->comment('Số lần sử dụng tối đa');
            $table->integer('usage_count')->default(0)->comment('Số lần đã sử dụng');
            $table->integer('usage_per_user')->default(1)->comment('Số lần sử dụng mỗi user');

            // Thời gian hiệu lực
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ends_at')->nullable();

            // Điều kiện áp dụng
            $table->boolean('is_active')->default(true);
            $table->boolean('is_public')->default(true)->comment('Hiển thị công khai');

            // Phạm vi áp dụng
            $table->json('applicable_categories')->nullable()->comment('Danh mục áp dụng');
            $table->json('applicable_products')->nullable()->comment('Sản phẩm áp dụng');
            $table->json('excluded_products')->nullable()->comment('Sản phẩm loại trừ');

            // Timestamps
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};

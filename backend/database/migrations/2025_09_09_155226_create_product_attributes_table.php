<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            // Primary key
            $table->id();

            // Thông tin cơ bản
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sku')->unique()->comment('Mã sản phẩm');
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();

            // Khóa ngoại
            $table->foreignId('category_id')->constrained()->onDelete('restrict');
            $table->foreignId('brand_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('supplier_id')->nullable()->constrained()->onDelete('set null');

            // Giá cả
            $table->decimal('price', 12, 2)->default(0);
            $table->decimal('cost_price', 12, 2)->nullable()->comment('Giá nhập');
            $table->decimal('sale_price', 12, 2)->nullable()->comment('Giá khuyến mãi');
            $table->timestamp('sale_start')->nullable();
            $table->timestamp('sale_end')->nullable();

            // Tồn kho
            $table->integer('stock_quantity')->default(0);
            $table->integer('low_stock_threshold')->default(5)->comment('Ngưỡng cảnh báo tồn kho thấp');
            $table->boolean('manage_stock')->default(true)->comment('Theo dõi tồn kho');
            $table->boolean('in_stock')->default(true)->comment('Còn hàng');

            // Vận chuyển
            $table->decimal('weight', 8, 2)->nullable()->comment('Trọng lượng (gram)');
            $table->decimal('length', 8, 2)->nullable()->comment('Chiều dài (cm)');
            $table->decimal('width', 8, 2)->nullable()->comment('Chiều rộng (cm)');
            $table->decimal('height', 8, 2)->nullable()->comment('Chiều cao (cm)');

            // SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();

            // Trạng thái
            $table->enum('status', ['draft', 'pending', 'published', 'archived'])->default('draft');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_virtual')->default(false)->comment('Sản phẩm ảo (không cần vận chuyển)');
            $table->boolean('is_active')->default(true);

            // Thống kê
            $table->integer('view_count')->default(0);
            $table->integer('sold_count')->default(0);
            $table->integer('rating_count')->default(0);
            $table->decimal('average_rating', 3, 2)->default(0);

            // Timestamps
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('category_id');
            $table->index('brand_id');
            $table->index('sku');
            $table->index('price');
            $table->index('status');
            $table->index('is_featured');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attributes', function (Blueprint $table) {
            // Primary key
            $table->id();

            // Thông tin thuộc tính
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('type')->default('select')->comment('select, text, number, color, etc.');
            $table->text('description')->nullable();

            // Thiết lập hiển thị
            $table->boolean('is_filterable')->default(false)->comment('Có thể lọc sản phẩm theo thuộc tính này');
            $table->boolean('is_visible')->default(true)->comment('Hiển thị trên trang chi tiết sản phẩm');
            $table->boolean('is_required')->default(false)->comment('Bắt buộc nhập khi thêm sản phẩm');

            // Thứ tự hiển thị
            $table->integer('sort_order')->default(0);

            // Timestamps
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attributes');
    }
};

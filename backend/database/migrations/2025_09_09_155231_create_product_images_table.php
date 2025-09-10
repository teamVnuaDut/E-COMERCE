<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_images', function (Blueprint $table) {
            // Primary key
            $table->id();

            // Khóa ngoại
            $table->foreignId('product_id')->constrained()->onDelete('cascade');

            // Thông tin ảnh
            $table->string('image_path');
            $table->string('alt_text')->nullable()->comment('Alt text cho SEO');
            $table->string('title')->nullable()->comment('Title của ảnh');

            // Thứ tự hiển thị
            $table->integer('sort_order')->default(0);

            // Loại ảnh
            $table->enum('type', ['main', 'gallery', 'thumbnail'])->default('gallery');

            // Kích thước ảnh
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->integer('size')->nullable()->comment('Kích thước file (bytes)');

            // Timestamps
            $table->timestamps();

            // Indexes
            $table->index('product_id');
            $table->index('sort_order');
            $table->index('type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_images');
    }
};

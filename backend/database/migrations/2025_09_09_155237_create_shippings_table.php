<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shippings', function (Blueprint $table) {
            // Primary key
            $table->id();

            // Khóa ngoại
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Thông tin vận chuyển
            $table->string('shipping_number')->unique()->comment('Mã vận chuyển');
            $table->enum('shipping_method', ['standard', 'express', 'fast', 'pickup'])->default('standard');
            $table->enum('shipping_status', ['pending', 'processing', 'shipped', 'delivered', 'cancelled', 'returned'])->default('pending');
            $table->decimal('shipping_cost', 12, 2)->default(0)->comment('Phí vận chuyển');
            $table->decimal('shipping_weight', 8, 2)->nullable()->comment('Trọng lượng (kg)');

            // Thông tin đơn vị vận chuyển
            $table->string('carrier_name')->nullable()->comment('Tên đơn vị vận chuyển');
            $table->string('carrier_code')->nullable()->comment('Mã đơn vị vận chuyển');
            $table->string('tracking_number')->nullable()->comment('Mã theo dõi vận chuyển');
            $table->text('tracking_url')->nullable()->comment('URL theo dõi vận chuyển');

            // Thông tin giao hàng
            $table->string('receiver_name');
            $table->string('receiver_phone');
            $table->text('receiver_address');
            $table->string('receiver_city');
            $table->string('receiver_district');
            $table->string('receiver_ward');
            $table->string('receiver_postal_code')->nullable()->comment('Mã bưu điện');

            // Thời gian giao hàng
            $table->timestamp('estimated_delivery_date')->nullable()->comment('Ngày dự kiến giao');
            $table->timestamp('shipped_at')->nullable()->comment('Thời điểm giao cho DVVC');
            $table->timestamp('delivered_at')->nullable()->comment('Thời điểm giao thành công');
            $table->timestamp('cancelled_at')->nullable()->comment('Thời điểm hủy vận chuyển');

            // Ghi chú
            $table->text('delivery_notes')->nullable()->comment('Ghi chú giao hàng');
            $table->text('carrier_notes')->nullable()->comment('Ghi chú từ đơn vị vận chuyển');
            $table->text('admin_notes')->nullable()->comment('Ghi chú quản trị viên');

            // Timestamps
            $table->timestamps();

            // Indexes
            $table->index('shipping_number');
            $table->index('order_id');
            $table->index('user_id');
            $table->index('tracking_number');
            $table->index('shipping_status');
            $table->index('carrier_code');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shippings');
    }
};

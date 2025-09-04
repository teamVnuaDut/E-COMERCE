<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('user_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('theme')->default('light');
            $table->string('language')->default('vi');
            $table->integer('items_per_page')->default(15);
            $table->boolean('notifications_email')->default(true);
            $table->boolean('notifications_sms')->default(false);
            $table->boolean('notifications_push')->default(true);
            $table->json('dashboard_widgets')->nullable();
            $table->json('preferences')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unique('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('user_settings');
    }
};

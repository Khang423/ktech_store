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
        // Bước 1: Xóa ràng buộc và cột cũ
        Schema::table('product_images', function (Blueprint $table) {
            $table->dropForeign('product_images_product_id_foreign'); // đúng tên ràng buộc
            $table->dropColumn('product_id');
        });

        // Bước 2: Thêm lại cột với ràng buộc mới
        Schema::table('product_images', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_images', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropColumn('product_id');
        });

        Schema::table('product_images', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }
};

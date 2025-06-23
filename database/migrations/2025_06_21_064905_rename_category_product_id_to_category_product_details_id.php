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
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_product_id']);
            $table->dropColumn('category_product_id');
            $table->foreignId('category_product_details_id')->constrained('category_product_details')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Bước 1: Xoá foreign key mới
            $table->dropForeign(['category_product_details_id']);

            // Bước 2: Xoá cột mới
            $table->dropColumn('category_product_details_id');

            // Bước 3: Thêm lại cột cũ
            $table->foreignId('category_product_id')->constrained('category_products')->cascadeOnDelete();
        });
    }
};

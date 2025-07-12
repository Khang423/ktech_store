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
        Schema::create('product_versions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->string('name');
            $table->string('slug');
            $table->string('config_name');
            $table->smallInteger('profit_rate')->default(0)->comment('Tỷ lệ lợi nhuận');
            $table->double('final_price')->default(0)->comment('Giá bán');
            $table->double('price')->nullable();
            $table->text('thumbnail')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_versions', function (Blueprint $table) {
            $table->dropForeign(['product_id']); // 👉 xoá khóa ngoại trước khi xoá bảng
        });

        Schema::dropIfExists('product_versions');
    }
};

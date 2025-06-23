<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('category_product_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('catogory_product_id')->constrained('category_products')->cascadeOnDelete();
            $table->string('name');
            $table->string('slug');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('category_product_details');
    }
};

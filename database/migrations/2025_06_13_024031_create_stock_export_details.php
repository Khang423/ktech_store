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
        Schema::create('stock_export_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stock_export_id')->constrained('stock_exports')->cascadeOnDelete();
            $table->foreignId('product_version_id')->constrained('product_versions')->cascadeOnDelete();
            $table->smallInteger('quantity')->default(0);
            $table->double('unit_price')->default(0);
            $table->double('total_price')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_export');
    }
};

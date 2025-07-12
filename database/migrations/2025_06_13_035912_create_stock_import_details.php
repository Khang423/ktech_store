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
        Schema::create('stock_import_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stock_import_id')->constrained('stock_imports')->cascadeOnDelete();
            $table->foreignId('product_version_id')->constrained('product_versions')->cascadeOnDelete();
            $table->integer('quantity')->default(0);
            $table->double('price')->default(0);
            $table->double('total_price')->default(0);
            $table->smallInteger('vat_rate')->default(0)->comment('Thuế VAT');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('stock_import_details', function (Blueprint $table) {
            $table->dropForeign(['stock_import_id']);
            $table->dropForeign(['product_version_id']);
        });

        Schema::dropIfExists('stock_import_details');
    }
};

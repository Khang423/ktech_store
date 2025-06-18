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
        Schema::table('product_versions', function (Blueprint $table) {
            $table->smallInteger('profit_rate')->default(0)->after('price')->comment('Tỷ lệ lợi nhuận');
            $table->double('final_price')->default(0)->after('profit_rate')->comment('Giá bán');
        });
    }

    public function down(): void
    {
        Schema::table('product_versions', function (Blueprint $table) {
            $table->dropColumn('profit_rate');
            $table->dropColumn('final_price');
        });
    }
};

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
        Schema::table('stock_import_details', function (Blueprint $table) {
            $table->smallInteger('profit_rate')->after('final_price')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stock_import_details', function (Blueprint $table) {
            $table->dropColumn('profit_rate');
        });
    }
};

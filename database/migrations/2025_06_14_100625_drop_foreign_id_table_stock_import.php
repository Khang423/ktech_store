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
        Schema::table('stock_imports', function (Blueprint $table) {
            $table->dropForeign(['inventory_id']);
            $table->dropColumn('inventory_id');
        });
        Schema::table('stock_exports', function (Blueprint $table) {
            $table->dropForeign(['inventory_id']);
            $table->dropColumn('inventory_id');
        });
    }

    public function down(): void
    {
        Schema::table('stock_imports', function (Blueprint $table) {
            $table->foreignId('inventory_id')
                ->constrained('inventories')
                ->cascadeOnDelete();
        });
         Schema::table('stock_exports', function (Blueprint $table) {
            $table->foreignId('inventory_id')
                ->constrained('inventories')
                ->cascadeOnDelete();
        });
        Schema::table('inventories', function (Blueprint $table) {
            $table->dropColumn('stock_code');
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('usage_type_id')->after('id')->constrained('usage_types')->cascadeOnDelete();
            $table->foreignId('model_series_id')->after('usage_type_id')->constrained('model_series')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['usage_type_id']);
            $table->dropForeign(['model_series_id']);
            $table->dropColumn(['usage_type_id', 'model_series_id']);
        });
    }
};

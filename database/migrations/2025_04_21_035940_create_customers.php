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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('tel');
            $table->string('password', 60);
            $table->string('address')->nullable();
            $table->string('birthday')->nullable();
            $table->foreignId('city_id')->nullable()->constrained('cities')->cascadeOnDelete(); 
            $table->foreignId('district_id')->nullable()->constrained('districts')->cascadeOnDelete(); 
            $table->foreignId('ward_id')->nullable()->constrained('wards')->cascadeOnDelete(); 
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropForeign(['city_id']);
            $table->dropForeign(['district_id']);
            $table->dropForeign(['ward_id']);
        });
        Schema::dropIfExists('customers');
    }
};

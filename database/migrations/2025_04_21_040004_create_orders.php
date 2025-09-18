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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();
            $table->smallInteger('status')->default(0);
            $table->double('total_price')->default(0);
            $table->string('receiver_name')->nullable();
            $table->string('receiver_tel')->nullable();
            $table->string('receiver_email')->nullable();
            $table->string('note')->nullable();
            $table->string('ship')->nullable();
            $table->foreignId('city_id')->nullable()->constrained('cities')->cascadeOnDelete(); 
            $table->foreignId('district_id')->nullable()->constrained('districts')->cascadeOnDelete(); 
            $table->foreignId('ward_id')->nullable()->constrained('wards')->cascadeOnDelete(); 
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['city_id']);
            $table->dropForeign(['district_id']);
            $table->dropForeign(['ward_id']);
            $table->dropForeign(['customer_id']);
        });

        Schema::dropIfExists('orders');
    }
};

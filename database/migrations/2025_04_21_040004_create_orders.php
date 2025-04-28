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
            $table->foreignId('cusomter_id')->constrained('customers')->cascadeOnDelete();
            $table->smallInteger('status')->default(0);
            $table->double('total_price')->default(0);
            $table->string('order_date');
            $table->string('note')->nullable();
            $table->string('shipping_address')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

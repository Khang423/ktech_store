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
        Schema::create('laptop_specs', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained('product_versions')->cascadeOnDelete();
            $table->string('gpu')->nullable();
            $table->string('cpu')->nullable();
            $table->string('ram_size')->nullable();
            $table->string('ram_type')->nullable();
            $table->string('ram_slot')->nullable();
            $table->string('storage_type')->nullable();
            $table->string('storage_size')->nullable();
            $table->string('display_size')->nullable();
            $table->string('display_resolution')->nullable();
            $table->string('display_technology')->nullable();
            $table->string('display_panel')->nullable();
            $table->string('refresh_rate')->nullable();
            $table->string('audio_technology')->nullable();
            $table->string('memory_card_slot')->nullable();
            $table->string('wifi')->nullable();
            $table->string('bluetooth_version')->nullable();
            $table->string('usb_ports')->nullable();
            $table->string('dimension')->nullable();
            $table->string('weight')->nullable();
            $table->string('material')->nullable();
            $table->string('operating_system')->nullable();
            $table->string('webcam')->nullable();
            $table->string('battery')->nullable();
            $table->string('keyboard_type')->nullable();
            $table->string('other_feature')->nullable();
            $table->string('security')->nullable();
            $table->string('release_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laptop_specs', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
        });

        Schema::dropIfExists('laptop_specs');
    }
};

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
        Schema::create('phone_specs', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained('product_versions')->cascadeOnDelete();
            $table->string('display_size')->nullable();
            $table->string('display_type')->nullable();
            $table->string('display_resolution')->nullable();
            $table->string('display_refresh_rate')->nullable();
            $table->string('display_features')->nullable();
            $table->string('rear_camera')->nullable();
            $table->string('front_camera')->nullable();
            $table->string('camera_features')->nullable();
            $table->string('chipset')->nullable();
            $table->string('gpu')->nullable();
            $table->string('nfc_support')->nullable();
            $table->string('sim_type')->nullable();
            $table->string('network_support')->nullable();
            $table->string('gps_support')->nullable();
            $table->string('ram_size')->nullable();
            $table->string('storage_size')->nullable();
            $table->string('battery_capacity')->nullable();
            $table->string('charging_technology')->nullable();
            $table->string('charging_port')->nullable();
            $table->string('operating_system')->nullable();
            $table->string('weight')->nullable();
            $table->string('dimension')->nullable();
            $table->string('frame_material')->nullable();
            $table->string('water_dust_resistance')->nullable();
            $table->string('audio_technology')->nullable();
            $table->string('fingerprint_sensor')->nullable();
            $table->string('other_sensors')->nullable();
            $table->string('wifi_technology')->nullable();
            $table->string('bluetooth_technology')->nullable();
            $table->string('release_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('phone_specs', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
        });

        Schema::dropIfExists('phone_specs');
    }
};

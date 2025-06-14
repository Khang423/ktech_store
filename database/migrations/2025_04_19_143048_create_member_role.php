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
        Schema::create('member_role', function (Blueprint $table) {
            $table->bigInteger('role_id')->unsigned();
            $table->bigInteger('member_id')->unsigned();
            $table->timestamps();
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('member_role', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropForeign(['member_id']);
        });

        Schema::dropIfExists('member_role');
    }
};

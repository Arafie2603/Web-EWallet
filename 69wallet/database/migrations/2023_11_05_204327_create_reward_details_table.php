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
        Schema::create('reward_details', function (Blueprint $table) {
            $table->id('id_reward_detail');
            $table->unsignedBigInteger('reward_id');
            $table->foreign('reward_id')->references('id_reward')->on('rewards')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('akun_id');
            $table->foreign('akun_id')->references('id_akun')->on('akuns')->onDelete('cascade')->onUpdate('cascade');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reward_details');
    }
};

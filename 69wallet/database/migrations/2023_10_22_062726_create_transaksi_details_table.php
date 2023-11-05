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
        Schema::create('transaksi_details', function (Blueprint $table) {
            $table->id('id_transaksi_detail');
            $table->unsignedBigInteger('transaksi_id');
            $table->foreign('transaksi_id')->references('id_transaksi')->on('transaksis')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('produk_id');
            $table->foreign('produk_id')->references('id_produk')->on('produks')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('harga_satuan');
            $table->integer('reward_poin')->default(0);
            $table->integer('jumlah')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_details');
    }
};

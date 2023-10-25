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
        Schema::create('produks', function (Blueprint $table) {
            $table->id('id_produk')->autoIncrement();
            $table->unsignedBigInteger('kategori_id');
            $table->foreign('kategori_id')->references('id_kategori')->on('kategoris')->onDelete('cascade')->onUpdate('cascade');
            $table->string('kode_produk')->unique();
            $table->string('nama_produk');
            $table->string('foto_produk');
            $table->integer('poin');
            $table->integer('harga');
            $table->string('status')->default('tersedia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};

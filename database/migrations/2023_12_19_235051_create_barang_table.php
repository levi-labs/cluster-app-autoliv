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
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->string('kode-barang', 32);
            $table->string('nama', 120);
            $table->bigInteger('kategori_id')->unsigned();
            $table->string('stock',32);
            $table->string('satuan',25);
            $table->string('foto_barang',65);
            $table->foreign('kategori_id')->references('id')->on('kategori')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};

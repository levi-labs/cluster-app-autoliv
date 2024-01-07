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
        Schema::create('barang_keluar', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('barang_id')->unsigned();
            $table->string('kode_barang_keluar', 20);
            $table->string('qty_keluar', 30);
            $table->string('harga_jual', 32);
            $table->date('tanggal_keluar');

            $table->foreign('barang_id')->references('id')->on('barang')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_keluar');
    }
};

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
        Schema::create('barang_masuk', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('barang_id')->unsigned();
            $table->string('kode_barang_masuk', 12);
            $table->string('qty_masuk', 30);
            $table->string('harga_beli', 30);
            $table->date('tanggal_masuk');

            $table->foreign('barang_id')->references('id')->on('barang')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_masuk');
    }
};

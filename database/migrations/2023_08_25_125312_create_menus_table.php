<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->string('kd_barang', 10)->primary();
            $table->string('kategori_id', 10);
            $table->string('barcode', 12)->nullable();
            $table->string('nama_barang', 50);
            $table->float('harga_beli', 8, 2);
            $table->float('harga_jual', 8, 2);
            $table->integer('stock');
            $table->longText('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('kategori_id')->references('kd_kategori')->on('kategoris');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
};

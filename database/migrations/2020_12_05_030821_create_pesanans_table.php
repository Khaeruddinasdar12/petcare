<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('alamat');
            $table->string('nohp');
            $table->integer('jumlah');
            $table->integer('harga');
            $table->integer('total');
            $table->integer('barang_id');
            $table->string('service')->nullable();
            $table->string('kurir');
            $table->integer('kabupaten_id');
            $table->integer('user_id');
            $table->enum('status', ['0', '1', '2']); // 0 belum, 1 sudah, 2 batal
            $table->string('keterangan')->nullable();
            $table->string('bukti')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesanans');
    }
}

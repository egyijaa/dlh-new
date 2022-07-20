<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengujianOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengujian_order', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('id_tipe_pelanggan')->references('id')->on('tipe_pelanggan')->onDelete('cascade');
            $table->text('keterangan')->nullable();
            $table->string('nomor_pre');
            $table->string('nama_pemesan');
            $table->string('no_hp');
            $table->string('email');
            $table->date('tanggal_isi');
            $table->string('nomor_surat')->nullable();
            $table->text('file_surat')->nullable();
            $table->text('alamat');
            $table->string('nomor_after')->nullable();
            $table->string('total_harga')->nullable();
            $table->dateTime('tanggal_bayar')->nullable();
            $table->text('bukti_bayar')->nullable();
            $table->date('tanggal_penyelia')->nullable();
            $table->date('tanggal_analis')->nullable();
            $table->string('id_status_pengujian');
            $table->string('nik');
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
        Schema::dropIfExists('pengujian_order');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengambilanSampelOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengambilan_sampel_order', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('id_tipe_pelanggan')->references('id')->on('tipe_pelanggan')->onDelete('cascade');
            $table->foreignId('id_volume_sampel')->references('id')->on('volume_sampel')->onDelete('cascade');
            $table->foreignId('id_sampel_uji')->references('id')->on('sampel_uji')->onDelete('cascade');
            $table->text('keterangan')->nullable();
            $table->string('nomor_pre');
            $table->string('nama_pemesan');
            $table->string('no_hp');
            $table->string('email');
            $table->date('tanggal_isi');
            $table->string('nomor_surat')->nullable();
            $table->text('file_surat')->nullable();
            $table->text('alamat');
            $table->enum('jasa_pelayanan', ['Dalam Kota Pontianak', 'Luar Kota Pontianak']);
            $table->date('tanggal_sampling');
            $table->text('alamat_sampling');
            $table->string('jumlah_lokasi_sampling');
            $table->string('jumlah_titik_sampling');
            $table->text('persyaratan_pelanggan')->nullable();
            $table->string('pendamping_sampling');
            $table->string('total_harga')->nullable();
            $table->dateTime('tanggal_bayar')->nullable();
            $table->text('bukti_bayar')->nullable();
            $table->string('id_status_pengambilan_sampel');
            $table->string('nik');
            $table->string('no_ba');
            $table->text('foto_ba1')->nullable();
            $table->text('foto_ba2')->nullable();
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
        Schema::dropIfExists('pengambilan_sampel_order');
    }
}

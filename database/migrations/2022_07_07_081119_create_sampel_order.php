<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSampelOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sampel_order', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('id_pengujian_order')->references('id')->on('pengujian_order')->onDelete('cascade');
            $table->foreignId('id_sampel_uji')->references('id')->on('sampel_uji')->onDelete('cascade');
            $table->string('kode_sampel');
            $table->text('catatan_pelanggan')->nullable();
            $table->tinyInteger('asal_sampel');
            $table->string('nomor_uji')->nullable()->unique();
            $table->string('harga')->nullable();
            $table->string('nomor_sertifikat')->nullable();
            $table->text('foto_shu1')->nullable();
            $table->text('foto_shu2')->nullable();
            $table->string('diambil_dari')->nullable();
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
        Schema::dropIfExists('sampel_order');
    }
}

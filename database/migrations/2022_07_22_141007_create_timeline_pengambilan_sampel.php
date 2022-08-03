<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimelinePengambilanSampel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timeline_pengambilan_sampel', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('id_status_pengambilan_sampel')->references('id')->on('status_pengambilan_sampel')->onDelete('cascade');
            $table->foreignId('id_pengambilan_sampel_order')->references('id')->on('pengambilan_sampel_order')->onDelete('cascade');
            $table->string('keterangan')->nullable();
            $table->integer('id_user');
            $table->dateTime('tanggal');
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
        Schema::dropIfExists('timeline_pengambilan_sampel');
    }
}

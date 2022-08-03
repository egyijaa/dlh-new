<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimelinePengujianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timeline_pengujian', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('id_status_pengujian')->references('id')->on('status_pengujian')->onDelete('cascade');
            $table->foreignId('id_pengujian_order')->references('id')->on('pengujian_order')->onDelete('cascade');
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
        Schema::dropIfExists('timeline_pengujian');
    }
}

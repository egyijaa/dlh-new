<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParameterSampelOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parameter_sampel_order', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('id_sampel_order')->references('id')->on('sampel_order')->onDelete('cascade');
            $table->foreignId('id_parameter_sampel')->references('id')->on('parameter_sampel')->onDelete('cascade');
            $table->string('metode_uji')->nullable();
            $table->string('satuan')->nullable();
            $table->string('hasil_pengujian')->nullable();
            $table->string('baku_mutu')->nullable();
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
        Schema::dropIfExists('parameter_sampel_order');
    }
}

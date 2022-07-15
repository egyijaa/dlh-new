<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSampelUjiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sampel_uji', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sampel');
            $table->string('harga');
            $table->tinyInteger('status'); //0 utk tidak tersedia, 1 utk tersedia
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
        Schema::dropIfExists('sampel_uji');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skr', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('id_pengujian_order')->references('id')->on('pengujian_order')->onDelete('cascade');
            $table->text('file_skr')->nullable();
            $table->string('no_skr');
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
        Schema::dropIfExists('skr');
    }
}

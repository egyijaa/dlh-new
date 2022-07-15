<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbp', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('id_pengujian_order')->references('id')->on('pengujian_order')->onDelete('cascade');
            $table->text('file_tbp')->nullable();
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
        Schema::dropIfExists('tbp');
    }
}

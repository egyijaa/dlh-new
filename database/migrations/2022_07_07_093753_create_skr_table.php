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
            $table->string('id_pengujian_order');            
            $table->string('id_pengambilan_sampel_order');
            $table->text('file_skr')->nullable();
            $table->string('no_skr');
            $table->string('id_skr');
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

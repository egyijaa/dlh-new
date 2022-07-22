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
            $table->string('id_pengujian_order');            
            $table->string('id_pengambilan_sampel_order');
            $table->text('file_tbp')->nullable();
            $table->string('no_tbp');
            $table->string('id_tbp');
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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeritaAcaraSampelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('berita_acara_sampel', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('id_pengambilan_sampel_order')->references('id')->on('pengambilan_sampel_order')->onDelete('cascade');
            $table->string('lu');
            $table->string('ls');
            $table->string('kode_sampel');
            $table->string('suhu');
            $table->enum('cuaca', ['cerah', 'mendung', 'hujan']);
            $table->text('foto1');
            $table->text('foto2');
            $table->text('foto3');
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
        Schema::dropIfExists('berita_acara_sampel');
    }
}

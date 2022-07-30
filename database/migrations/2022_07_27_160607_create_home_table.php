<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home', function (Blueprint $table) {
            $table->id();
            $table->string('wa');
            $table->string('ig');
            $table->string('fb');
            $table->text('visi');
            $table->text('misi');
            $table->text('motto');
            $table->text('maklumat_pelayanan');
            $table->string('judul1');
            $table->string('judul2');
            $table->string('judul3');
            $table->text('isi1');
            $table->text('isi2');
            $table->text('isi3');
            $table->string('pertanyaan1');
            $table->text('jawaban1');
            $table->string('pertanyaan2');
            $table->text('jawaban2');
            $table->string('pertanyaan3');
            $table->text('jawaban3');
            $table->string('pertanyaan4');
            $table->text('jawaban4');
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
        Schema::dropIfExists('home');
    }
}

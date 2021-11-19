<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMPertanyaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_pertanyaans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ujian_id')->unsigned();

            $table->text('judul_soal');
            
            $table->text('opsi1');
            $table->text('opsi2');
            $table->text('opsi3');
            $table->text('opsi4');
            $table->text('opsi5')->nullable();

            
            $table->double('nilai_derajat_kesukaran', 5, 3)->nullable();
            $table->double('nilai_dayabeda', 5, 3)->nullable();
            $table->integer('fungsi_pengecoh')->nullable();
            $table->double('nilai_validitas', 5, 5)->nullable();



            $table->integer('jawaban');


            $table->timestamps();

            $table->foreign('ujian_id')->references('id')->on('m_ujians')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_pertanyaans');
    }
}

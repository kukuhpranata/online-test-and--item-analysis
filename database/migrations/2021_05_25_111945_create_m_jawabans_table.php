<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMJawabansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_jawabans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('pertanyaan_id')->unsigned();
            $table->integer('ujian_id')->unsigned();

            $table->integer('jawaban_user')->nullable();
            $table->float('poin')->nullable();

            $table->timestamps();



            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('ujian_id')->references('id')->on('m_ujians')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('pertanyaan_id')->references('id')->on('m_pertanyaans')
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
        Schema::dropIfExists('m_jawabans');
    }
}

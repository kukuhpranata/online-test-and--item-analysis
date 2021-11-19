<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMOpsisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_opsis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pertanyaan_id')->unsigned();

            $table->integer('nomor_opsi');

            $table->text('judul_opsi');


            $table->timestamps();

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
        Schema::dropIfExists('m_opsis');
    }
}

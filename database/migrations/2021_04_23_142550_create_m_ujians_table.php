<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMUjiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_ujians', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();

            $table->string('judul', 30);
            $table->dateTime('tgl_ujian');
            $table->dateTime('tgl_ujian_end')->nullable();
            $table->string('durasi');
            $table->integer('jumlah_soal');
            
            $table->integer('status')->nullable();
           // $table->float('nilai_dayabeda')->nullable();
            $table->double('nilai_keandalan_kr20', 5, 5)->nullable();
            $table->double('nilai_keandalan_kr21', 5, 5)->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
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
        Schema::dropIfExists('m_ujians');
    }
}

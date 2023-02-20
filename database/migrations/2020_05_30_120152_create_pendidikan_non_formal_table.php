<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePendidikanNonFormalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendidikan_non_formal', function (Blueprint $table) {
            //$table->bigIncrements('id');
            $table->uuid('id')->primary();
            $table->uuid('mahasiswa_id');
            $table->enum('jenis', ['PELATIHAN', 'KURSUS', 'WORKSHOP', 'SEMINAR']);
            $table->string('nama');
            $table->string('penyelenggara');
            $table->date('tanggal')->nullable();
            $table->string('lama');
            $table->enum('satuan', ['HARI', 'MINGGU', 'BULAN', 'TAHUN']);
            $table->string('file')->nullable();
            $table->timestamps();

            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswa')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pendidikan_non_formal');
    }
}

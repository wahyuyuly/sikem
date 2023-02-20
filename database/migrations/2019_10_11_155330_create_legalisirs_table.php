<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLegalisirsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legalisir', function (Blueprint $table) {
            //$table->bigIncrements('id');
            $table->uuid('id')->primary();
            $table->uuid('mahasiswa_id');
            $table->string('nomor')->unique();
            $table->enum('jenis', ['IJAZAH', 'SERTIFIKAT', 'LAINNYA']);
            $table->text('keterangan')->nullable();
            $table->string('file');
            $table->enum('status', ['PENDING', 'DI TOLAK', 'PROSES', 'OK', 'SELESAI']);
            $table->string('alasan_tolak')->nullable();
            $table->string('dokumen')->nullable();
            $table->date('tanggal_ambil')->nullable();
            $table->string('bukti_ambil')->nullable();
            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('legalisir');
    }
}

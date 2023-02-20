<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrangTuasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orang_tua', function (Blueprint $table) {
            //$table->bigIncrements('id');
            $table->uuid('id')->primary();
            $table->uuid('mahasiswa_id');
            $table->enum('jenis', ['IBU', 'BAPAK', 'WALI'])->nullable();
            $table->string('nama');
            $table->string('nik')->nullable()->nullable();
            $table->uuid('pendidikan_id')->nullable();
            $table->enum('pekerjaan', ['TIDAK BEKERJA', 'SWASTA', 'WIRASWASTA', 'BURUH', 'PETANI', 'PNS', 'POLRI', 'TNI', 'PENSIUNAN PNS/POLRI/TNI', 'SUDAH MENINGGAL', 'LAINNYA'])->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('telp')->nullable();
            $table->timestamps();

            $table->foreign('pendidikan_id')->references('id')->on('tingkat_pendidikan')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('orang_tua');
    }
}

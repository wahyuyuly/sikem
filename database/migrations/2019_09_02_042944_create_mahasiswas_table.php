<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMahasiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            //$table->bigIncrements('id');
            $table->uuid('id')->primary();
            $table->string('npm')->unique();
            $table->string('nama');
            $table->string('nik')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->enum('golongan_darah', ['A', 'B', 'AB', 'O'])->nullable();
            $table->enum('jenis_kelamin', ['LAKI-LAKI', 'PEREMPUAN'])->nullable();
            $table->enum('agama', ['ISLAM', 'KRISTEN', 'KATOLIK', 'HINDU', 'BUDHA', 'KONGCHU', 'LAINYA'])->nullable();
            $table->string('alamat')->nullable();
            $table->char('kelurahan_id', 10)->nullable();
            $table->string('telp')->nullable();
            $table->uuid('prodi_id')->nullable();
            $table->string('tahun_masuk')->nullable();
            $table->enum('status', ['AKTIF', 'MENGUNDURKAN DIRI', 'DO', 'LULUS'])->nullable();
            $table->date('tanggal_yudisium')->nullable();
            $table->uuid('account_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('kelurahan_id')->references('id')->on('kelurahan')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('prodi_id')->references('id')->on('prodi')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('account_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mahasiswa');
    }
}

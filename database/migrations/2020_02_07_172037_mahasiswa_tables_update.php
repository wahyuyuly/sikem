<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MahasiswaTablesUpdate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->integer('tinggi_badan')->nullable()->after('agama');
            $table->integer('berat_badan')->nullable()->after('tinggi_badan');
            $table->string('nama_sekolah')->nullable()->after('tanggal_yudisium');
            $table->string('jenis_sekolah')->nullable()->after('nama_sekolah');
            $table->string('jurusan_sekolah')->nullable()->after('jenis_sekolah');
            $table->string('status_sekolah')->nullable()->after('jurusan_sekolah');
            $table->string('sekolah_lulus')->nullable()->after('status_sekolah');
            $table->text('alamat_sekolah')->nullable()->after('jenis_sekolah');
            $table->text('riwayat_kesehatan')->nullable()->after('alamat_sekolah');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

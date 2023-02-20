<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateMahasiswaTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->enum('jalur_penerimaan', ['PMDP','Jalur SIMAMA/Uji Tulis Gelombang 1','Jalur Mandiri/Uji Tulis Gelombang 2','Alih Jenjang','Profesi','RPL'])->nullable()->after('tahun_masuk');
            $table->text('alamat_tinggal')->nullable()->after('kelurahan_id');
            $table->char('kelurahan_tinggal', 10)->nullable()->after('alamat_tinggal');
            $table->enum('status_tinggal', ['Rumah Orang Tua', 'Asrama', 'Kost', 'Tempat Famili'])->nullabe()->after('kelurahan_id');
            $table->string('nama_panggilan')->nullable()->after('nama');
            $table->string('suku_bangsa')->nullable()->after('agama');
            $table->enum('rhesus', ['positif', 'negatif'])->nullable()->after('golongan_darah');
            $table->string('anak_ke')->nullable()->after('riwayat_kesehatan');
            $table->string('jumlah_saudara')->nullable()->after('anak_ke');

            $table->foreign('kelurahan_tinggal')->references('id')->on('kelurahan')->onUpdate('cascade')->onDelete('cascade');
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

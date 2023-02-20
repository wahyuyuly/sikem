<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOrangTuaTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orang_tua', function (Blueprint $table) {
            $table->string('tempat_lahir')->nullable()->after('pekerjaan');
            $table->text('alamat')->nullable()->after('penghasilan');
            $table->char('kelurahan_id', 10)->nullable()->after('alamat');

            $table->foreign('kelurahan_id')->references('id')->on('kelurahan')->onUpdate('cascade')->onDelete('cascade');
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

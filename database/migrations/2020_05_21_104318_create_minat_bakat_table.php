<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMinatBakatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void 
     */
    public function up()
    {
        Schema::create('minat_bakat', function (Blueprint $table) {
            //$table->bigIncrements('id');
            $table->uuid('id')->primary();
            $table->uuid('mahasiswa_id');
            $table->text('minat_ukm')->nullable();
            $table->enum('exchange', ['Berminat', 'Tidak Berminat'])->nullable();
            $table->string('overseas')->nullable();
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
        Schema::dropIfExists('minat_bakat');
    }
}

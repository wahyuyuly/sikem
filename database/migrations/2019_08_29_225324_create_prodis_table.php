<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prodi', function (Blueprint $table) {
            //$table->bigIncrements('id');
            $table->uuid('id')->primary();
            $table->uuid('jurusan_id');
            $table->uuid('tingkat_id');
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $table->timestamps();

            $table->foreign('jurusan_id')->references('id')->on('jurusan')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('tingkat_id')->references('id')->on('tingkat_pendidikan')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prodi');
    }
}

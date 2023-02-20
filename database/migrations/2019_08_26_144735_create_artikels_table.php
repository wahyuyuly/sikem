<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtikelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            //$table->bigIncrements('id');
            $table->uuid('id')->primary();
            $table->uuid('category_id')->nullable();
            $table->string('title');
            $table->text('content')->nullable();
            $table->string('image')->nullable();
            $table->string('slug')->nullable();
            $table->enum('status', ['publish', 'draft', 'unpublish']);
            $table->enum('comment_status', ['open', 'closed'])->default('open');
            $table->integer('hit')->default(0);
            $table->uuid('user_id');
            $table->timestamps();            
            $table->softDeletes();

            $table->foreign('category_id')->references('id')->on('post_category')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}

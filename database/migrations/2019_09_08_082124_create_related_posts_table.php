<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelatedPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('related_posts', function (Blueprint $table) {

            $table->unsignedInteger('post_id');
            $table->unsignedInteger('related_id');

            $table->foreign('post_id')->references('id')->on('posts');
            $table->foreign('related_id')->references('id')->on('posts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('related_posts');
    }
}

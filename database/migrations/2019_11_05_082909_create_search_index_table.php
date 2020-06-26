<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSearchIndexTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('search_index', function (Blueprint $table) {
            $table->string('index')->index();
            $table->integer('id')->index();
            $table->longText('content');
            $table->string('title');
            $table->string('link')->nullable();
            $table->string('language', 10)->default('mn')->index();
            $table->timestamps();

            $table->primary(['index','id']);
        });

        DB::statement('ALTER TABLE search_index ADD FULLTEXT search(title, content)');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('search_index');
    }
}

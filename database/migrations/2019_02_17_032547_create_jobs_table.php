<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('position');
            $table->text('description');
            $table->string('type', 50)->nullable();
            $table->smallInteger('count')->default(1);
            $table->datetime('starts_at')->nullable();
            $table->datetime('expires_at')->nullable();
            $table->string('status', 10);
            $table->json('props')->nullable();

            $table->unsignedInteger('user_id');

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}

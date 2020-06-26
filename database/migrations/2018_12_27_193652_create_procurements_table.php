<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcurementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procurements', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->text('description');
            $table->string('form')->nullable();
            $table->string('attachment')->nullable();
            $table->string('status', 10);
            $table->json('props')->nullable();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('owner_id')->nullable();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('owner_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('procurements');
    }
}

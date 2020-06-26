<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedInteger('job_id');
            $table->string('regnum', 12)->index();
            $table->string('firstname')->index();
            $table->string('lastname')->index();
            $table->string('phone')->index();
            $table->string('email')->nullable()->index();
            $table->string('photo')->nullable();
            $table->json('attributes');
            $table->text('request_data')->nullable();
            $table->string('ip')->index()->nullable();
            $table->string('status', 10)->nullable()->default(\App\JobApplicationStatus::PENDING);

            $table->foreign('job_id')->references('id')->on('jobs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_applications');
    }
}

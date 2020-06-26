<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterActionEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('action_events', function($table) {
            $table->string('actionable_id', 10)->change();
            $table->string('target_id', 10)->change();
            $table->string('model_id', 10)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('action_events', function($table) {
            $table->unsignedInteger('actionable_id')->change();
            $table->unsignedInteger('target_id')->change();
            $table->unsignedInteger('model_id')->change();
        });
    }
}

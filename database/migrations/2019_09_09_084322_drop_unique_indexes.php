<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropUniqueIndexes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages', function($table) {
            $table->dropUnique('pages_slug_unique');
            $table->index('slug');
        });

        Schema::table('companies', function($table) {
            $table->dropUnique('companies_contact_email_unique');
            $table->index('contact_email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pages', function($table) {
            $table->dropIndex(['slug']);
            $table->unique('slug');
        });

        Schema::table('companies', function($table) {
            $table->dropIndex(['contact_email']);
            $table->unique('contact_email');
        });
    }
}

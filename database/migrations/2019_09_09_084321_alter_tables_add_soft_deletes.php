<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablesAddSoftDeletes extends Migration
{
    private $tables = [
        'categories',
        'comments',
        'posts',
        'media',
        'menus',
        'menu_items',
        'pages',
        'companies',
        'company_reviews',
        'procurements',
        'procurement_results',
        'legal_documents',
        'legal_document_categories',
        'roles',
        'users',
        'jobs'
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach($this->tables as $table){
            Schema::table($table, function($table) {
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach ($this->tables as $table) {
            Schema::table($table, function ($table) {
                $table->dropSoftDeletes();
            });
        }
    }


}

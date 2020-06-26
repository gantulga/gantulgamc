<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLegalDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legal_document_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->string('slug');
            $table->unsignedInteger('parent_id')->nullable();
            $table->string('path', 256)->nullable();
            $table->foreign('parent_id')->references('id')->on('legal_document_categories');
            $table->index('slug');
            $table->index('path');
        });

        Schema::create('legal_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->text('description');
            $table->string('file');
            $table->string('file_name');
            $table->string('status', 10);
            $table->unsignedInteger('user_id');

            $table->foreign('user_id')->references('id')->on('users');
            $table->index('name');
        });

        Schema::create('legal_document_category_pivot', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('document_id');

            $table->foreign('category_id')->references('id')->on('legal_document_categories')->onDelete('cascade');
            $table->foreign('document_id')->references('id')->on('legal_documents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('legal_document_category_pivot');
        Schema::dropIfExists('legal_document_categories');
        Schema::dropIfExists('legal_documents');
    }
}

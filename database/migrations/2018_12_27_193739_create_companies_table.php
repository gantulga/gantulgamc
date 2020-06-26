<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->string('name_eng');
            $table->text('about');
            $table->text('activities');
            $table->string('country');
            $table->string('reg_num');
            $table->string('tax_num');
            $table->string('vat_num')->nullable();
            $table->text('address');
            $table->integer('est_year');
            $table->string('activity_category');
            $table->string('ownership_form');
            $table->integer('employee_count')->nullable();
            $table->text('customers')->nullable();
            $table->string('dir_name');
            $table->string('dir_pos')->nullable();
            $table->string('dir_mobile');
            $table->string('dir_fax')->nullable();
            $table->string('dir_email');
            $table->string('contact_name');
            $table->string('contact_pos')->nullable();
            $table->string('contact_mobile');
            $table->string('contact_fax')->nullable();
            $table->string('contact_email')->unique();
            $table->string('contact_password')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('remember_token')->nullable();
            $table->json('props')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}

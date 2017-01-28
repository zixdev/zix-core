<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_fields', function (Blueprint $table) {
            $table->increments('id');

            $table->string('model');
            $table->string('type');

            $table->string('label');
            $table->string('name');

            $table->string('placeholder');


            $table->boolean('status')->default(true);

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('field_to_form', function (Blueprint $table) {
            $table->integer('order');

            $table->integer('form_id')->unsigned()->index();
            $table->foreign('form_id')->references('id')->on('forms')->onDelete('cascade');

            $table->integer('form_field_id')->unsigned()->index();
            $table->foreign('form_field_id')->references('id')->on('form_fields')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('field_to_form');
        Schema::dropIfExists('form_fields');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormResponseFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_response_fields', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('form_response_id')->unsigned()->index();
            $table->foreign('form_response_id')->references('id')->on('form_responses')->onDelete('cascade');

            $table->integer('form_field_id')->unsigned()->index();
            $table->foreign('form_field_id')->references('id')->on('form_fields')->onDelete('cascade');

            $table->text('value');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_response_fields');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormFieldRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_field_rules', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('value')->nullable();

            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('form_field_to_rule_field', function (Blueprint $table) {
            $table->integer('form_field_rule_id')->unsigned()->index();
            $table->foreign('form_field_rule_id')->references('id')->on('form_field_rules')->onDelete('cascade');

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
        Schema::dropIfExists('form_field_to_rule_field');
        Schema::dropIfExists('form_field_rules');
    }
}

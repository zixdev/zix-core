<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug');

            $table->string('submit_text');


            $table->boolean('notify')->default(false);
            $table->string('notify_email')->nullable();

            $table->boolean('captcha')->default(false);
            $table->boolean('status')->default(true);

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('form_site', function (Blueprint $table) {
            $table->integer('site_id')->unsigned()->index();
            $table->foreign('site_id')->references('id')->on('sites')->onDelete('cascade');

            $table->integer('form_id')->unsigned()->index();
            $table->foreign('form_id')->references('id')->on('forms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_site');
        Schema::dropIfExists('forms');
    }
}

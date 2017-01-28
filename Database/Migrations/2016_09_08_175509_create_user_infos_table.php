<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_infos', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();

            $table->string('avatar_url')->nullable();
            $table->string('bio')->nullable();
            $table->string('website')->nullable();
            $table->string('company')->nullable();

            $table->string('phone_number')->nullable();
            $table->string('mobile_number')->nullable();

            $table->string('address_line_1')->nullable();
            $table->string('address_line_2')->nullable();

            $table->string('subrub')->nullable();
            $table->string('post_code')->nullable();
            $table->string('state')->nullable();
            $table->string('location')->nullable();
            $table->string('country')->nullable(); // expect this to link into country table

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
        Schema::dropIfExists('user_infos');
    }
}

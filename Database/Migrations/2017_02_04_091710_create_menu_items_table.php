<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('menu_id')->unsigned()->index()->nullable()->default(null);
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');

            $table->integer('parent_id')->unsigned()->index()->nullable()->default(null);
            $table->foreign('parent_id')->references('id')->on('menu_items')->onDelete('cascade');

            $table->string('name');
            $table->string('url')->nullable();
            $table->string('permission')->nullable();
            $table->string('icon')->nullable();
            $table->string('img')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_items');
    }
}

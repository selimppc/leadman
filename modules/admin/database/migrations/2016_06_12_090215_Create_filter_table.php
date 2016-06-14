<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filter', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',64)->nullable();
            $table->string('filtercol',45)->nullable();
            $table->unsignedInteger('created_by',false)->nullable();
            $table->unsignedInteger('updated_by',false)->nullable();
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
        Schema::drop('filter');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCentralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('central_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',64)->nullable();
            $table->string('status',45)->nullable();
            $table->enum('user_type',['admin','user']);
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
        Schema::drop('central_settings');
    }
}

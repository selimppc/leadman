<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmtpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smtp', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',64)->nullable();
            $table->string('server_username',64)->nullable();
            $table->string('server_password',128)->nullable();
            $table->string('host',128)->nullable();
            $table->string('smtp',128)->nullable();
            $table->string('port',128)->nullable();
            $table->unsignedInteger('c_port',false)->nullable();
            $table->unsignedInteger('updated_by',false)->nullable();
            $table->unsignedInteger('created_by',false)->nullable();
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
        Schema::drop('smtp');
    }
}

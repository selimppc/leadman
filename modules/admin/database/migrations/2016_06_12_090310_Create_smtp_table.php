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
            $table->string('server_username',64);
            $table->string('server_password',128);
            $table->string('host',128);
            $table->string('smtp',128);
            $table->string('port',128);
            $table->unsignedInteger('c_port',false);
            $table->unsignedInteger('updated_by',false);
            $table->unsignedInteger('created_by',false);
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

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoppingEmailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('popping_email', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email',256);
            $table->string('password',64);
            $table->unsignedInteger('smtp_id',false);
            $table->foreign('smtp_id')->references('id')->on('smtp');
            $table->unsignedInteger('imap_id',false);
            $table->foreign('imap_id')->references('id')->on('imap');
            $table->unsignedInteger('country_origin',false);
            $table->foreign('country_origin')->references('id')->on('imap');
            $table->float('price',2);
            $table->unsignedInteger('schedule_id',false);
            $table->foreign('schedule_id')->references('id')->on('schedule');
            $table->timestamp('execution_time');
            $table->text('token');
            $table->string('code',128);
            $table->string('auth_id',64);
            $table->enum('auth_type',['google','yahoo','outlook']);
            $table->enum('status',['new','active','inactive','cancel']);
            $table->unsignedInteger('user_id',false);
            $table->unsignedInteger('created_by',false);
            $table->unsignedInteger('updated_by',false);
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
        Schema::drop('popping_email');
    }
}

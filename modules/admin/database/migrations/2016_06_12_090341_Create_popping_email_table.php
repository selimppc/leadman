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
            $table->string('email',128);
            $table->string('password',64)->nullable();

            $table->unsignedInteger('smtp_id',false);
            $table->foreign('smtp_id')->references('id')->on('smtp');

            $table->unsignedInteger('imap_id',false);
            $table->foreign('imap_id')->references('id')->on('imap');

            $table->unsignedInteger('country_origin',false)->nullable();
            $table->foreign('country_origin')->references('id')->on('country');

            $table->float('price')->nullable();
            $table->string('keyword',64)->nullable();

            $table->unsignedInteger('schedule_id',false)->nullable();
            $table->foreign('schedule_id')->references('id')->on('schedule');

            $table->timestamp('execution_time')->nullable();

            $table->unsignedInteger('user_id',false)->nullable();
            $table->foreign('user_id')->references('id')->on('user');

            $table->text('token')->nullable();
            $table->string('code',128)->nullable();
            $table->string('auth_id',64)->nullable();
            $table->enum('auth_type',['google','yahoo','outlook', 'mail'])->nullable();
            $table->enum('status',['new','active','inactive','cancel'])->nullable();

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
        Schema::drop('popping_email');
    }
}

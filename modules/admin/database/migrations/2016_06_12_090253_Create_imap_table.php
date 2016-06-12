<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imap', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',64);
            $table->string('host',128);
            $table->unsignedInteger('port',false);
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
        Schema::drop('imap');
    }
}

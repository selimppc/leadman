<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email',256)->unique();
            $table->unsignedInteger('popping_email_id',false)->nullable();
            $table->foreign('popping_email_id')->references('id')->on('popping_email');
            $table->enum('status',['open', 'close', 'invoiced','filtered'])->nullable();
            $table->unsignedInteger('count',false)->nullable();
            $table->unsignedInteger('created_by',false)->nullable();
            $table->unsignedInteger('updated_by',false)->nullable();
            $table->timestamps()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('lead');
    }
}

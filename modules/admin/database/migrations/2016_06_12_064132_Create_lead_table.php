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
            $table->string('email',256);
            $table->unsignedInteger('popping_email_id',false);
            $table->foreign('popping_email_id')->referrences('id')->on('popping_email');
            $table->string('status',45);
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
        Schema::drop('lead');
    }
}

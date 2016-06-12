<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceHeadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_head', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('popping_email_id',false);
            $table->foreign('popping_email_id')->referrences('id')->on('popping_email');
            $table->float('total_cost');
            $table->enum('status',['open','approved','paid','cancel']);
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
        Schema::drop('invoice_head');
    }
}

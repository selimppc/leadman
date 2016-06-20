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
            $table->unsignedInteger('popping_email_id',false)->nullable();
            $table->string('invoice_number', 64)->nullable();
            $table->foreign('popping_email_id')->references('id')->on('popping_email');
            $table->float('total_cost')->nullable();
            $table->enum('status',['open','approved','paid','cancel'])->nullable();
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
        Schema::drop('invoice_head');
    }
}

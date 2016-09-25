<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('invoice_head_id',false)->nullable();
            #$table->foreign('invoice_head_id')->references('id')->on('invoice_head');
            $table->unsignedInteger('lead_id',false)->nullable();
            #$table->foreign('lead_id')->references('id')->on('lead');
            $table->unsignedInteger('popping_email_id',false)->nullable();

            $table->float('unit_price')->nullable();
            $table->date('inv_date')->nullable();
            $table->unsignedInteger('created_by',false)->nullable();
            $table->unsignedInteger('updated_by',false)->nullable();
            $table->timestamps();
        });
        Schema::table('invoice_detail', function($table) {
            //if 'popping_email' table  exists
            if(Schema::hasTable('popping_email'))
            {
                $table->foreign('popping_email_id')->references('id')->on('popping_email');
            }
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('invoice_detail');
    }
}

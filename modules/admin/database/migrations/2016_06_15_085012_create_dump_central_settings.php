<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDumpCentralSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared(file_get_contents("modules/admin/database/sql_dump/central_settings.sql"));
        DB::unprepared(file_get_contents("modules/admin/database/sql_dump/imap.sql"));
        DB::unprepared(file_get_contents("modules/admin/database/sql_dump/smtp.sql"));
        DB::unprepared(file_get_contents("modules/admin/database/sql_dump/schedule.sql"));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

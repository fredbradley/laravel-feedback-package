<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $connection = config('feedback.databaseConnection');
        if (!Schema::connection($connection)->hasTable('sites')) {
            Schema::connection($connection)->create('sites', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->longText('url');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}

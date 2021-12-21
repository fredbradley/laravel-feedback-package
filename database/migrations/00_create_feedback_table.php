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
        if (!Schema::connection($connection)->hasTable('feedback')) {
            Schema::connection($connection)->create('feedback', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedBigInteger('site_id');
                $table->json('feedback');
                $table->longText('other_comments')->nullable();
                $table->json('client_meta');
                $table->timestamps();

                $table->foreign('site_id')->references('id')->on('sites');

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

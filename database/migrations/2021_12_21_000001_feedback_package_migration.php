<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FeedbackPackageMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $connection = config('feedback.databaseConnection');
        if (!Schema::connection($connection)->hasTable('feedback_sites')) {
            Schema::connection($connection)->create('feedback_sites', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->longText('url');
                $table->timestamps();
            });
        }

        if (!Schema::connection($connection)->hasTable('feedback_records')) {
            Schema::connection($connection)->create('feedback_records', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('site_id');
                $table->json('feedback');
                $table->longText('other_comments')->nullable();
                $table->json('client_meta');
                $table->timestamps();

                $table->foreign('site_id')->references('id')->on('feedback_sites');
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
        /**
         * Purposely empty, because this package can be added on multiple
         * applications each pointing to the same database
         */
    }
}

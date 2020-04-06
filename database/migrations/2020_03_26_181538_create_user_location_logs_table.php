<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserLocationLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_location_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_diagnosis_log_id');
            $table->timestamp('reportedDateTime')->useCurrent();
            $table->string('latitude', 20);
            $table->string('longitude', 20);
            $table->timestamps();
        });

        /**
         * Foreign Key Constraint
         */
        Schema::table('user_location_logs', function (Blueprint $table) {
            $table->foreign('user_diagnosis_log_id')->references('id')->on('user_diagnosis_logs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_location_logs');
    }
}
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->index();
            $table->string('userCode', 10)->index();
            $table->string('phone', 20);
            $table->boolean('isDoctor')->default(0);
            $table->unsignedBigInteger('country_id')->nullable();
            $table->text('androidDeviceId')->nullable();
            $table->text('androidPushToken')->nullable();
            $table->text('iosDeviceId')->nullable();
            $table->text('iosPushToken')->nullable();
            $table->boolean('isVerified')->default(0);
            $table->integer('verificationNonce')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        /**
         * Foreign Key Constraint
         */
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

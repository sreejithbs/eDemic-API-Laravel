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
            $table->string('userCode', 50)->index();
            $table->string('phone', 50);
            $table->boolean('isDoctor')->default(0);
            $table->text('androidDeviceId')->nullable();
            $table->text('androidPushToken')->nullable();
            $table->text('iosDeviceId')->nullable();
            $table->text('iosPushToken')->nullable();
            $table->boolean('isVerified')->default(0);
            $table->integer('verificationNonce')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
}

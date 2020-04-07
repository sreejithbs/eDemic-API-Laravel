<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->index();
            $table->string('title');
            $table->text('content');
            $table->unsignedBigInteger('health_institution_id');
            $table->boolean('isPosted')->default(0);
            $table->timestamps();
        });

        /**
         * Foreign Key Constraint
         */
        Schema::table('messages', function (Blueprint $table) {
            $table->foreign('health_institution_id')->references('id')->on('health_institutions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}

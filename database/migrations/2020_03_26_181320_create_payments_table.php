<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->index();
            $table->unsignedBigInteger('health_institution_id');
            $table->decimal('amount', 12, 2);
            $table->text('remarks');
            $table->timestamps();
        });

        /**
         * Foreign Key Constraint
         */
        Schema::table('payments', function (Blueprint $table) {
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
        Schema::dropIfExists('payments');
    }
}
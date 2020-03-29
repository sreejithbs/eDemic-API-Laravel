<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLicenseSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('license_subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('health_institution_id');
            $table->decimal('feeAmount', 12, 2);
            $table->date('startDate');
            $table->date('endDate');
            $table->boolean('status')->default(0);
            $table->timestamps();
        });

        /**
         * Foreign Key Constraint
         */
        Schema::table('license_subscriptions', function (Blueprint $table) {
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
        Schema::dropIfExists('license_subscriptions');
    }
}
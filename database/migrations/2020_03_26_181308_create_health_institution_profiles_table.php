<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHealthInstitutionProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('health_institution_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('health_institution_id');
            $table->string('phone', 50);
            $table->text('address');
            $table->unsignedBigInteger('country_id');
            $table->integer('year');
            $table->integer('purchasedDoctorConnects');
            $table->integer('remainingDoctorConnects');
            $table->timestamps();
        });

        /**
         * Foreign Key Constraint
         */
        Schema::table('health_institution_profiles', function (Blueprint $table) {
            $table->foreign('health_institution_id')->references('id')->on('health_institutions')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('health_institution_profiles');
    }
}
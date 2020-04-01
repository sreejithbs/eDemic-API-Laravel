<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiseasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diseases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->index();
            $table->string('name');
            $table->string('diseaseCode', 50)->index();
            $table->string('infectionQrCode')->nullable();
            $table->string('recoveredQrCode')->nullable();
            $table->string('deadQrCode')->nullable();
            $table->string('selfQuarantineQrCode')->nullable();
            $table->tinyInteger('riskLevel');
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
        Schema::dropIfExists('diseases');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlignassistPointTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('alignassist_point');
        Schema::create('alignassist_point', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('alignassist_id');
            $table->unsignedInteger('point_id');
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
        Schema::dropIfExists('alignassist_point');
    }
}

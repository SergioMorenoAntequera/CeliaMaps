<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */ 
    public function up()
    {
        Schema::dropIfExists('maps');
        Schema::create('maps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title',75)->unique(); 
            $table->string('description', 150)->nullable(); 
            $table->string('city',75)->nullable(); 
            $table->integer('date')->nullable();
            $table->string('image',75);
            $table->string('miniature',200)->nullable();
            $table->integer('level')->unique();
            $table->float('tlCornerLatitude', 18, 16)->nullable();
            $table->float('tlCornerLongitude', 18, 16)->nullable();
            $table->float('trCornerLatitude', 18, 16)->nullable();
            $table->float('trCornerLongitude', 18, 16)->nullable();
            $table->float('blCornerLatitude', 18, 16)->nullable();
            $table->float('blCornerLongitude', 18, 16)->nullable();
            $table->float('brCornerLatitude', 18, 16)->nullable();
            $table->float('brCornerLongitude', 18, 16)->nullable();
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
        Schema::dropIfExists('maps');
    }
}

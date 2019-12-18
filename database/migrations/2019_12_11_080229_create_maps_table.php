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
            $table->string('description', 150); 
            $table->string('city',75); 
            $table->integer('date');
            $table->string('image',75);
            $table->string('miniature',75);
            $table->integer('level');
            $table->integer('width');
            $table->integer('height');
            // Aquí falta la fecha de subida pero eso lo hace la función final
            $table->float('deviation_x', 10, 2);
            $table->float('deviation_y', 10, 2);
            // Esto no sabiamos lo que era
            // $table->integer('principal');
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

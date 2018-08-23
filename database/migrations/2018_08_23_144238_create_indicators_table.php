<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndicatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('r_indicators', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('query');
            $table->string('color')->nullable('aqua');
            $table->text('description')->nullable();
            $table->string('link')->nullable();
            $table->integer('size')->default(2);
            $table->string('glyphicon')->default('glyphicon glyphicon-signal');

            $table->integer('r_auth');
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
        Schema::dropIfExists('r_indicators');
    }
}

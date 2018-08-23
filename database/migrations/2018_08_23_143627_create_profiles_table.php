<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('r_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->boolean('moderator')->default(0);
            $table->boolean('administrator')->default(0);
            $table->boolean('default')->default(0);

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
        Schema::dropIfExists('r_profiles');
    }
}

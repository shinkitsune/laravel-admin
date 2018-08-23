<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('r_permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('profile_id')->nullable();
            $table->integer('matriz_id')->nullable();
            $table->string('role');

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
        Schema::dropIfExists('r_permissions');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsersHasUsers extends Migration
{
	/**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_user', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned();
			$table->bigInteger('user_id1')->unsigned();
			$table->boolean('status');

			$table->primary(['user_id', 'user_id1']);

			$table->foreign('user_id')->references('id')->on('users')
				->onUpdate('restrict')
				->onDelete('cascade');
			$table->foreign('user_id1')->references('id')->on('users')
				->onUpdate('restrict')
				->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_user');
    }
}

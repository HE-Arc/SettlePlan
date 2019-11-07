<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTaskHasFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_has_file', function (Blueprint $table) {
          $table->bigInteger('task_id');
          $table->bigInteger('file_id');
          $table->primary(['task_id', 'file_id']);
          $table->foreign('task_id')->references('id')->on('tasks');
          $table->foreign('file_id')->references('id')->on('files');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_has_file');
    }
}

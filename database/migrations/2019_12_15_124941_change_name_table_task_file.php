<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeNameTableTaskFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('tasks_has_files');

        Schema::create('file_task', function (Blueprint $table) {
    			$table->bigInteger('task_id')->unsigned();
    			$table->bigInteger('file_id')->unsigned();
          $table->primary(['task_id', 'file_id']);
          $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade')->onUpdate('restrict');
          $table->foreign('file_id')->references('id')->on('files')->onDelete('cascade')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file_task');
    }
}

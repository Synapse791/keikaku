<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTasksTable extends Migration
{
    public function up()
    {
        Schema::create('user_tasks', function (Blueprint $table) {
            $table->uuid('user_id');
            $table->uuid('task_id');

            $table->primary(['user_id', 'task_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_tasks');
    }
}

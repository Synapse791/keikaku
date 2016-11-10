<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProjectsTable extends Migration
{
    public function up()
    {
        Schema::create('user_projects', function (Blueprint $table) {
            $table->uuid('user_id');
            $table->uuid('project_id');

            $table->primary(['user_id', 'project_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_projects');
    }
}

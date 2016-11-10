<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskTable extends Migration
{
    public function up()
    {
        Schema::create('task', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('project_id');
            $table->uuid('category_id');
            $table->string('title');
            $table->text('description');
            $table->integer('estimated_cost')->nullable();
            $table->integer('actual_cost')->nullable();
            $table->timestamp('due_date')->nullable();
            $table->timestamps();

            $table->primary('id');
            $table->index('due_date');
        });
    }

    public function down()
    {
        Schema::dropIfExists('task');
    }
}

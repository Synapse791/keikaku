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
            $table->text('description')->nullable();
            $table->float('estimated_cost', 12, 2)->nullable();
            $table->float('actual_cost', 12, 2)->nullable();
            $table->timestamp('due_date')->nullable();
            $table->boolean('completed')->default(false);
            $table->boolean('archived')->default(false);
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

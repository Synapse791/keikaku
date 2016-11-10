<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectTable extends Migration
{
    public function up()
    {
        Schema::create('project', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('currency_id');
            $table->string('title');
            $table->integer('budget');
            $table->timestamps();

            $table->primary('id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('project');
    }
}

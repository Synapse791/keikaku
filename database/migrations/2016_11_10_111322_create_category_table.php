<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTable extends Migration
{
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name')->unique();

            $table->primary('id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('category');
    }
}

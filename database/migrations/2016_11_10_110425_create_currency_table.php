<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrencyTable extends Migration
{
    public function up()
    {
        Schema::create('currency', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name')->unique();
            $table->char('symbol', 1)->unique();

            $table->primary('id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('currency');
    }
}

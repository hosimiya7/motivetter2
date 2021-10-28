<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvoluteFoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evolute_foods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('character_template_id');
            $table->unsignedBigInteger('food_id');
            $table->integer('require_quantity');
            $table->integer('to_evolute_id');
            $table->integer('priority');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evolute_foods');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiveMoneyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('give_money', function (Blueprint $table) {
            $table->id();
            $table->integer('give_id');
            $table->double('price',15,2)->comment("Qilgan to'lovi");
            $table->timestamp('give_date')->comment('Pul olgan vaqti');
            $table->tinyInteger('money_type')->length(1)->comment('Pul turi');
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
        Schema::dropIfExists('give_money');
    }
}

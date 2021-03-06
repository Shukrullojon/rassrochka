<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiveCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('give_comment', function (Blueprint $table) {
            $table->id();
            $table->integer('give_id');
            $table->string('comment');
            $table->timestamp("send_date")->nullable();
            $table->tinyInteger('sms')->nullable();
            $table->double('price',15,2)->nullable();
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
        Schema::dropIfExists('give_comment');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGetCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('get_comment', function (Blueprint $table) {
            $table->id();
            $table->integer('get_id')->nullable();
            $table->string('comment')->nullable();
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
        Schema::dropIfExists('get_comment');
    }
}

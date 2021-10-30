<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gets', function (Blueprint $table) {
            $table->id();
            $table->string('get_name',70)->nullable()->comment('Sotib olganlar ismi');
            $table->timestamp('get_time')->nullable()->comment('Olgan vaqti');
            $table->string('phone',20)->nullable()->comment('Client telefon nomeri');
            $table->string('product_name',70)->nullable()->comment('Sotilgan mulk');
            $table->tinyInteger('lifetime_type')->nullable()->comment("Oylik yoki haftalik to'lov qiladi");
            $table->tinyInteger('product_lifetime',)->nullable()->comment('Nechi oyga, yoki nechi haftada');
            $table->tinyInteger('day')->nullable()->comment('Qaysi kunga berishi');
            $table->tinyInteger('money_type')->nullable()->comment('Pul turi dollir yoki sum');
            $table->double('price',15,2)->nullable()->comment('Tannarxi');
            $table->double('total_price',15,2)->nullable()->comment('Umumiy narxi');
            $table->double('overpayment',15,2)->nullable()->comment('Oldindan bergan narx');
            $table->double('month_pay',15,2)->nullable()->comment("Oyiga qanchadan to'lashi");
            $table->tinyInteger('status')->nullable()->comment('Status');
            $table->tinyInteger('notification')->nullable()->comment('Sms xabarnoma yuborish, yubormaslik');
            $table->string('comment',250)->nullable()->comment('Xabarnoma qoldirish');
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
        Schema::dropIfExists('gets');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('color');
            $table->bigIncrements('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::create('payments', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('payment_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payment_categories', function(Blueprint $table) {
            $table->dropForeign('payment_category_user_user_id_foreign');
            $table->dropForeign('payment_category_payment_category_id_foreign');
        });
        Schema::dropIfExists('payment_categories');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedInteger('amount');
            $table->bigIncrements('category_id');
            $table->bigIncrements('group_id');
            $table->bigIncrements('user_id');
            $table->timestamps();

            $table->foreign('group_id')->references('id')->on('groups');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payments', function(Blueprint $table) {
            $table->dropForeign('payment_user_user_id_foreign');
            $table->dropForeign('group_payment_group_id_foreign');
        });
        Schema::dropIfExists('payments');
    }
}

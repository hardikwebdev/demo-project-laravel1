<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommissionWalletHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commission_wallet_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->double('amount',8,2);
            $table->text('description');
            $table->enum('type', ['0','1'])->default('0');
            $table->double('final_amount',8,2);
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
        Schema::dropIfExists('commission_wallet_histories');
    }
}

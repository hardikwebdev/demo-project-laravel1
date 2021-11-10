<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsdtAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usdt_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('value');
            $table->string('image')->nullable();
            $table->tinyInteger('status')->default(1)->comment('0 = Inactive , 1 = Active');
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
        Schema::dropIfExists('usdt_addresses');
    }
}

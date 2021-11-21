<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnToNftPurchaseHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nft_purchase_histories', function (Blueprint $table) {
            //
            $table->double('counter_offer_amount', 8, 2)->after('sale_amount')->default(0.00);
            $table->text('remark')->after('counter_offer_amount')->nullable();
            $table->tinyInteger('counter_offer_status')->after('status')->default(0);
            $table->timestamp('approve_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nft_purchase_histories', function (Blueprint $table) {
            //
        });
    }
}

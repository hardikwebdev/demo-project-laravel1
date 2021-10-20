<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ranks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('short_name')->nullable();
            $table->string('icon')->nullable();
            $table->float('req_direct_sale');
            $table->integer('own_package');
            $table->integer('direct_downline');
            $table->integer('direct_downline_packages');
            $table->integer('total_downline_packages');
            $table->string('downline_criteria')->nullable();
            $table->float('pips_rebate_commission');
            $table->float('overriding_of_package');
            $table->float('leaders_bonus');
            $table->float('profit_sharing');
            $table->integer('rank_total_downline');
            $table->string('rank_name')->nullable();
            $table->integer('rank_level')->default(1);
            $table->softDeletes();
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
        Schema::dropIfExists('ranks');
    }
}

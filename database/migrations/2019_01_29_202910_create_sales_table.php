<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('identifier')->unique();
            $table->integer('user_id')->unsigned()->index()->nullable();
            $table->integer('file_id')->unsigned()->index()->nullable();
            $table->string('buyer_email');
            $table->decimal('sale_price', 6, 2);
            $table->decimal('sale_commission', 6, 2);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('file_id')->references('id')->on('files')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}

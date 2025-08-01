<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUkToBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->string('uk')->nullable();
        });

        Schema::table('imports', function (Blueprint $table) {
            $table->string('uk')->nullable();
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->longText('comment')->nullable();
            $table->longText('extra1')->nullable();
            $table->longText('extra2')->nullable();
            $table->longText('extra3')->nullable();
            $table->longText('extra4')->nullable();
        });
        
        Schema::table('order_details', function (Blueprint $table) {
            $table->longText('comment')->nullable();
            $table->longText('extra1')->nullable();
            $table->longText('extra2')->nullable();
            $table->longText('extra3')->nullable();
            $table->longText('extra4')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
            //
        });
    }
}

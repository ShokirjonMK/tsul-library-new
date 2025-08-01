<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->foreign('organization_id')
                ->references('id')->on('organizations')
                ->onDelete('set null');
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->foreign('branch_id')
                ->references('id')->on('branches')
                ->onDelete('set null');
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->date('order_date');
            $table->string('order_number');
            $table->string('type')->nullable();
            $table->integer('status')->default(1); //1 kitobni olgan, 2 kitobni qaytargan, 0, o'chirilgan
            $table->unsignedBigInteger('reader_id')->nullable();
            $table->foreign('reader_id')
                ->references('id')->on('users')
                ->onDelete('set null');
            $table->timestamps();
        });


        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->integer('status')->default(1); //1 kitobni olgan, 2 kitobni qaytargan, 0, o'chirilgan
            $table->unsignedBigInteger('order_id')->nullable();
            $table->foreign('order_id')
                ->references('id')->on('orders')
                ->onDelete('cascade');

            $table->unsignedBigInteger('book_id')->nullable();
            $table->foreign('book_id')
                ->references('id')->on('books')
                ->onDelete('set null');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')
                ->references('id')->on('users')
                ->onDelete('set null');
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
        Schema::dropIfExists('orders');
    }
}

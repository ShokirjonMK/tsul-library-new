<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDebtorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('debtors', function (Blueprint $table) {
            $table->id();

            $table->integer('status')->default(1); //1 kitobni olgan, 2 kitobni qaytargan, 0, o'chirilgan
            $table->date('taken_time');
            $table->date('return_time')->nullable(); //qaytarish vaqti kitobni topshirish kk bo'lgan sana
            $table->date('returned_time')->nullable(); //kitobni kutubxonaga topshirgan sana

            $table->integer('count_prolong')->default(1); //muddatni nechchi marta chuzdirish
            $table->integer('how_many_days')->default(10);
            $table->unsignedBigInteger('reader_id')->nullable();
            $table->foreign('reader_id')
                ->references('id')->on('users')
                ->onDelete('set null');
            $table->unsignedBigInteger('book_id')->nullable();
            $table->foreign('book_id')
                ->references('id')->on('books')
                ->onDelete('set null');
            $table->unsignedBigInteger('book_information_id')->nullable();
            $table->foreign('book_information_id')
                ->references('id')->on('book_informations')
                ->onDelete('set null');
            $table->unsignedBigInteger('book_inventar_id')->nullable();
            $table->foreign('book_inventar_id')
                ->references('id')->on('book_inventars')
                ->onDelete('set null');
    
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->foreign('branch_id')
                ->references('id')->on('branches')
                ->onDelete('set null');
            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreign('department_id')
                ->references('id')->on('departments')
                ->onDelete('set null');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')
                ->references('id')->on('users')
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
        Schema::dropIfExists('debtors');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookInventarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_inventars', function (Blueprint $table) {
            $table->id();
            $table->integer('isActive')->nullable()->default(1);
            $table->string('comment')->nullable();
            $table->string('inventar_number');


            $table->unsignedBigInteger('book_id')->nullable();
            $table->foreign('book_id')
                ->references('id')->on('books')
                ->onDelete('set null');
            
            $table->unsignedBigInteger('book_information_id')->nullable();
            $table->foreign('book_information_id')
                ->references('id')->on('book_informations')
                ->onDelete('set null');
            
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->foreign('branch_id')
                ->references('id')->on('branches')
                ->onDelete('set null');
            $table->unsignedBigInteger('deportmetn_id')->nullable();
            $table->foreign('deportmetn_id')
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
        Schema::dropIfExists('book_inventars');
    }
}

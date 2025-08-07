<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BookTakenWithoutPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_taken_without_permissions', function (Blueprint $table) {
            $table->id();
            $table->integer('status')->default(1);
            $table->string('bar_code')->nullable();
            $table->string('rfid_tag_id')->nullable();
            $table->string('comment')->nullable();
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

            $table->unsignedBigInteger('organization_id')->nullable();
            $table->foreign('organization_id')
                ->references('id')->on('organizations')
                ->onDelete('set null');

            $table->unsignedBigInteger('branch_id')->nullable();
            $table->foreign('branch_id')
                ->references('id')->on('branches')
                ->onDelete('set null');

            $table->unsignedBigInteger('deportmetn_id')->nullable();
            $table->foreign('deportmetn_id')
                ->references('id')->on('departments')
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
        //
    }
}

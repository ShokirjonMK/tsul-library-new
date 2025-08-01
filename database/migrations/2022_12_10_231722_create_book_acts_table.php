<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookActsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_acts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('where_id')->nullable();
            $table->foreign('where_id')
                ->references('id')->on('wheres')
                ->onDelete('set null');

            $table->string('price')->nullable();
            $table->string('summarka_raqam')->nullable();
            $table->date('arrived_date')->nullable();
            $table->string('arrived_year')->nullable();
            $table->string('arrived_month')->nullable();
            $table->string('arrived_day')->nullable();
            $table->longText('comment')->nullable();
            $table->longText('extra1')->nullable();
            $table->string('full_text_path')->nullable();

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
            $table->unsignedBigInteger('book_id')->nullable();
            $table->foreign('book_id')
                ->references('id')->on('books')
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
        Schema::dropIfExists('book_acts');
    }
}

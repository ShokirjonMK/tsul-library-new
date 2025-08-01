<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUdcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('udcs', function (Blueprint $table) {
            $table->id();
            $table->string('udc_number');
            $table->string('slug');
            $table->text('description');
            $table->string('number_of_codes')->nullable();
            $table->text('notes')->nullable();
            $table->unsignedInteger('parent_id')->nullable();
            $table->unsignedBigInteger('udc_id')->nullable();

            $table->foreign('udc_id')->references('id')->on('udcs');
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
        Schema::dropIfExists('udcs');
    }
}

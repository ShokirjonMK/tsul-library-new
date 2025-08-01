<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLanguageIdAndBookTextIdToResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('resources', function (Blueprint $table) {
            $table->string('res_type')->nullable();
            $table->string('taken_into_account')->nullable();

            $table->unsignedBigInteger('book_language_id')->nullable();
            $table->foreign('book_language_id')
                ->references('id')->on('book_languages')
                ->onDelete('set null');
            
            $table->unsignedBigInteger('book_text_id')->nullable();
            $table->foreign('book_text_id')
                ->references('id')->on('book_texts')
                ->onDelete('set null');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('resources', function (Blueprint $table) {
            //
        });
    }
}

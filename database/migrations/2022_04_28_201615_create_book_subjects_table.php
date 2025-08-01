<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         
        Schema::create('book_subjects', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->integer('isActive')->nullable()->default(1);
            $table->string('image_path')->nullable();
            $table->string('icon_path')->nullable();
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

        Schema::create('book_subject_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('locale')->index();
            // Foreign key to the main model
            $table->unsignedBigInteger('book_subject_id');
            $table->foreign('book_subject_id')
                ->references('id')->on('book_subjects')
                ->onDelete('cascade');
            $table->string('title');
            $table->string('slug'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_subjects');
    }
}

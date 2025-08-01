<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAuthorsMarkToBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->string('authors_mark')->nullable();
        });
        
        Schema::create('journal_types', function (Blueprint $table) {
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

        Schema::create('journal_type_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('locale')->index();
            // Foreign key to the main model
            $table->unsignedBigInteger('journal_type_id')->nullable();
            $table->foreign('journal_type_id')
                ->references('id')->on('journal_types')
                ->onDelete('cascade');
            $table->string('title');
            $table->string('slug');
        });



        Schema::table('journals', function (Blueprint $table) {
            $table->unsignedBigInteger('journal_type_id')->nullable();
            $table->foreign('journal_type_id')
                ->references('id')->on('journal_types')
                ->onDelete('cascade');
        });


        Schema::table('magazine_issues', function (Blueprint $table) {
            $table->unsignedBigInteger('book_access_type_id')->nullable();
            $table->foreign('book_access_type_id')
                ->references('id')->on('book_access_types')
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
        Schema::table('books', function (Blueprint $table) {
            //
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJournalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journals', function (Blueprint $table) {
            $table->id();
            $table->string('ISSN')->nullable();
			$table->longText('phone_number')->nullable();
			$table->longText('subjects')->nullable(); //sohalari
			// $table->longText('languages')->nullable(); //nashr tillari
			$table->longText('fax')->nullable();
			$table->longText('email')->nullable();
			$table->string('website')->nullable();
			$table->longText('editor_in_chiefs')->nullable();
			$table->longText('editorial_members')->nullable();
            $table->string('code')->nullable();
            $table->integer('isActive')->nullable()->default(1);
            $table->string('image_path')->nullable();
            $table->string('icon_path')->nullable();
			$table->unsignedBigInteger('organization_id');
            $table->foreign('organization_id')
                ->references('id')->on('organizations')
                ->onDelete('cascade');
            $table->unsignedBigInteger('books_type_id')->nullable();
            $table->foreign('books_type_id')
                ->references('id')->on('books_types')
                ->onDelete('set null');

            $table->unsignedBigInteger('book_text_id')->nullable();
            $table->foreign('book_text_id')
                ->references('id')->on('book_texts')
                ->onDelete('set null');

            $table->unsignedBigInteger('book_text_type_id')->nullable();
            $table->foreign('book_text_type_id')
                ->references('id')->on('book_text_types')
                ->onDelete('set null');

            $table->unsignedBigInteger('book_access_type_id')->nullable();
            $table->foreign('book_access_type_id')
                ->references('id')->on('book_access_types')
                ->onDelete('set null');

            $table->unsignedBigInteger('book_file_type_id')->nullable();
            $table->foreign('book_file_type_id')
                ->references('id')->on('book_file_types')
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

        Schema::create('journal_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('locale')->index();
            // Foreign key to the main model
            $table->unsignedBigInteger('journal_id');
            $table->foreign('journal_id')
                ->references('id')->on('journals')
                ->onDelete('cascade');
            $table->string('title');
            $table->string('slug');
            $table->longText('body')->nullable();
            $table->longText('address')->nullable();
            $table->longText('description')->nullable();
            $table->longText('short_description')->nullable();
            // $table->longText('main_purpose_magazine')->nullable(); //maqsad vazifalari
            // $table->longText('goals_objectives')->nullable(); //maqsad vazifalari
            $table->longText('editor_in_chief')->nullable();
            $table->longText('submission_article')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('journals');
    }
}

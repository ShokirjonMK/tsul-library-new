<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMagazineIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('magazine_issues', function (Blueprint $table) {
            $table->id();
            $table->string('published_year');
            $table->string('fourth_number');
			$table->longText('subjects')->nullable(); //sohalari
            $table->integer('isActive')->nullable()->default(1);
            $table->string('image_path')->nullable();
            $table->string('ISSN')->nullable();

            $table->string('full_text_path')->nullable();
            $table->string('file_format')->nullable();
            $table->string('file_format_type')->nullable();
            $table->string('file_size')->nullable();
            $table->integer('betlar_soni')->default(0);
            $table->string('price')->default(0);
            $table->unsignedBigInteger('journal_id')->nullable();
            $table->foreign('journal_id')
                ->references('id')->on('journals')
                ->onDelete('set null');
            $table->longText('editor_in_chiefs')->nullable();
			$table->longText('editorial_members')->nullable();
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

        Schema::create('magazine_issue_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('locale')->index();
            // Foreign key to the main model
            $table->unsignedBigInteger('magazine_issue_id');
            $table->foreign('magazine_issue_id')
                ->references('id')->on('magazine_issues')
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
        Schema::dropIfExists('magazine_issues');
    }
}

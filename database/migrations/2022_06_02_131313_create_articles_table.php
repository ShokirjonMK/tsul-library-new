<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->integer('steps')->nullable()->default(1);
            $table->string('udk')->nullable();
            $table->string('file_path')->nullable();

            $table->unsignedBigInteger('journal_id')->nullable();
            $table->foreign('journal_id')
                ->references('id')->on('journals')
                ->onDelete('set null');
            $table->unsignedBigInteger('magazine_issue_id')->nullable();
            $table->foreign('magazine_issue_id')
                    ->references('id')->on('magazine_issues')
                    ->onDelete('set null');

            $table->integer('sort_id')->nullable()->default(1); 
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

        Schema::create('article_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('locale')->index();
            // Foreign key to the main model
            $table->unsignedBigInteger('article_id');
            $table->foreign('article_id')
                ->references('id')->on('articles')
                ->onDelete('cascade');
            $table->string('title');
            $table->string('slug');
            $table->string('sub_title')->nullable();
            $table->longText('description')->nullable();
            $table->longText('inst_name_address')->nullable();
            $table->longText('key_word')->nullable();
            $table->longText('content')->nullable();
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}

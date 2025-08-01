<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScientificPublicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('scientific_publications', function (Blueprint $table) {
            $table->id();
            $table->integer('steps')->nullable()->default(1);
            $table->integer('copies')->nullable()->default(1);
            $table->string('key')->nullable();
            $table->string('code')->nullable();
            $table->string('publication_year')->nullable();
            $table->string('page_number')->nullable();
            $table->string('permission')->nullable();
            $table->string('barcode_key')->nullable();
            $table->string('barcode')->nullable();
            $table->string('inventar_number')->nullable();
            $table->integer('isActive')->nullable()->default(1);
            $table->string('image_path')->nullable();
            $table->string('file_path')->nullable();
            $table->unsignedBigInteger('journal_id')->nullable();
            $table->foreign('journal_id')
                ->references('id')->on('journals')
                ->onDelete('set null');
            $table->unsignedBigInteger('magazine_issue_id')->nullable();
            $table->foreign('magazine_issue_id')
                ->references('id')->on('magazine_issues')
                ->onDelete('set null');
            $table->unsignedBigInteger('res_lang_id')->nullable();
            $table->foreign('res_lang_id')
                ->references('id')->on('resource_types')
                ->onDelete('set null');
            $table->unsignedBigInteger('res_type_id')->nullable();
            $table->foreign('res_type_id')
                ->references('id')->on('resource_types')
                ->onDelete('set null');
            $table->unsignedBigInteger('res_field_id')->nullable();
            $table->foreign('res_field_id')
                ->references('id')->on('resource_types')
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

        Schema::create('scientific_publication_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('locale')->index();
            // Foreign key to the main model
            $table->unsignedBigInteger('scientific_publication_id');
            $table->foreign('scientific_publication_id','sci_pub_id_foreign')
                ->references('id')->on('scientific_publications')
                ->onDelete('cascade');
            
            $table->string('title');
            $table->string('slug');
            $table->string('sub_title')->nullable();
            $table->string('country')->nullable();
            $table->text('inst_nome_address')->nullable();
            $table->text('authors')->nullable();
            $table->text('keywords')->nullable();
            $table->text('place_protection')->nullable();
            $table->longText('content')->nullable();
            $table->longText('description')->nullable();

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scientific_publications');
    }
}

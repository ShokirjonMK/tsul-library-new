<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();

            $table->string('dc_title');
            $table->longText('dc_subjects')->nullable();
            $table->longText('dc_creators')->nullable();
            $table->longText('dc_authors')->nullable();

            $table->string('dc_UDK')->nullable(); //UDK raqami
            $table->string('dc_BBK')->nullable(); //BBK raqami
            $table->string('dc_source')->nullable();
            $table->string('dc_rights')->nullable();
            $table->string('dc_relation')->nullable();
            $table->string('dc_publisher')->nullable();
            $table->string('dc_identifier')->nullable(); //ISBN
            $table->string('dc_published_city')->nullable(); //ISBN
            $table->string('ISBN')->nullable(); //

            $table->text('dc_description')->nullable();
            $table->string('dc_date')->nullable();
            $table->string('dc_coverage')->nullable();
            $table->string('dc_contributor')->nullable();
            $table->string('image_path')->nullable();
            $table->string('full_text_path')->nullable();
            $table->string('file_format')->nullable();
            $table->string('file_format_type')->nullable();
            $table->string('file_size')->nullable();

            $table->string('betlar_soni')->default(0);
            $table->string('price')->default(0);
            $table->integer('status')->default(1);

            $table->string('published_year')->nullable();

            $table->longText('extra1')->nullable();
            $table->longText('extra2')->nullable();
            $table->longText('extra3')->nullable();
            $table->longText('extra4')->nullable();

            $table->unsignedBigInteger('books_type_id')->nullable();
            $table->foreign('books_type_id')
                ->references('id')->on('books_types')
                ->onDelete('set null');

            $table->unsignedBigInteger('book_language_id')->nullable();
            $table->foreign('book_language_id')
                ->references('id')->on('book_languages')
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
//  subjectlarni bitta columnga yoziladi

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
        Schema::dropIfExists('books');
    }
}

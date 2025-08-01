<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imports', function (Blueprint $table) {
            $table->id();
            $table->longText('title')->nullable();
            $table->longText('authors')->nullable();

            $table->string('UDK')->nullable(); //UDK raqami
            $table->string('BBK')->nullable(); //BBK raqami

            $table->string('publisher')->nullable();
            $table->string('published_city')->nullable(); //ISBN
            $table->string('published_year')->nullable();

            $table->string('ISBN')->nullable(); //

            $table->text('description')->nullable();
            $table->string('published_date')->nullable();
            $table->string('authors_mark')->nullable();
            $table->string('from_what_system')->nullable();

            $table->string('betlar_soni')->default(0);
            $table->string('price')->default(0);
            $table->integer('status')->default(1);

            $table->longText('extra1')->nullable();
            $table->longText('extra2')->nullable();
            $table->longText('extra3')->nullable();
            $table->longText('extra4')->nullable();
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
        Schema::dropIfExists('imports');
    }
}

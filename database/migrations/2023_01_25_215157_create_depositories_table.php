<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depositories', function (Blueprint $table) {
            $table->id();
            $table->integer('isActive')->nullable()->default(1);
            $table->longText('comment')->nullable();
            $table->string('inventar_number')->nullable();
            $table->string('bar_code')->nullable();
            
            $table->unsignedBigInteger('book_id')->nullable();
            $table->foreign('book_id')
                ->references('id')->on('books')
                ->onDelete('set null');
                
            $table->unsignedBigInteger('book_information_id')->nullable();
            $table->foreign('book_information_id')
                ->references('id')->on('book_informations')
                ->onDelete('set null');
            
            $table->unsignedBigInteger('book_inventar_id')->nullable();
            $table->foreign('book_inventar_id')
                ->references('id')->on('book_inventars')
                ->onDelete('set null');
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->foreign('organization_id')
                ->references('id')->on('organizations')
                ->onDelete('set null');
                
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->foreign('branch_id')
                ->references('id')->on('branches')
                ->onDelete('set null');

            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreign('department_id')
                ->references('id')->on('departments')
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('depositories');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResourcesDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resources_documents', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('resource_id')->nullable();
            $table->foreign('resource_id')
                ->references('id')->on('resources')
                ->onDelete('set null');

            $table->unsignedBigInteger('document_id')->nullable();
            $table->foreign('document_id')
                ->references('id')->on('documents')
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
        Schema::dropIfExists('resources_documents');
    }
}

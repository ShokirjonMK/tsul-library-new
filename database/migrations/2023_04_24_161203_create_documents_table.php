<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(); 
            $table->string('number')->nullable(); 
            $table->date('arrived_date')->nullable();
            $table->string('arrived_year')->nullable();
            $table->string('arrived_month')->nullable();
            $table->string('arrived_day')->nullable();
            $table->string('file')->nullable(); 
            $table->string('consignment_note')->nullable();     //  накладная
            $table->string('act_number')->nullable();     //  akt
            $table->string('ksu')->nullable();     //  ksu
            
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->foreign('organization_id')
                ->references('id')->on('organizations')
                ->onDelete('set null');
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->foreign('branch_id')
                ->references('id')->on('branches')
                ->onDelete('set null');
            $table->unsignedBigInteger('deportmetn_id')->nullable();
            $table->foreign('deportmetn_id')
                ->references('id')->on('departments')
                ->onDelete('set null');
                
            $table->longText('comment')->nullable();
            $table->longText('comment1')->nullable();
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
        Schema::dropIfExists('documents');
    }
}

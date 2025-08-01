<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('resources', function (Blueprint $table) {
            $table->id();

            $table->string('title')->nullable();
            $table->longText('authors')->nullable();
            $table->unsignedBigInteger('type_id')->nullable();
            $table->foreign('type_id')
                ->references('id')->on('gen_types')
                ->onDelete('set null');
            $table->unsignedBigInteger('publisher_id')->nullable();
            $table->foreign('publisher_id')
                ->references('id')->on('publishers')
                ->onDelete('set null');
            $table->string('published_year')->nullable();
            $table->string('published_city')->nullable(); 

            $table->string('copies')->default(0);
            $table->string('price')->default(0);
            $table->integer('status')->default(1);
            $table->string('consignment_note')->nullable();     //  накладная
            $table->string('act_number')->nullable();     //  akt
            $table->string('ksu')->nullable();     //  ksu

            $table->unsignedBigInteger('who_id')->nullable();
            $table->foreign('who_id')
                ->references('id')->on('whos')
                ->onDelete('set null');
            $table->unsignedBigInteger('basic_id')->nullable();
            $table->foreign('basic_id')
                ->references('id')->on('basics')
                ->onDelete('set null');

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
        Schema::dropIfExists('resources');
    }
}

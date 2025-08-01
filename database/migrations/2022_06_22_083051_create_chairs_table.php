<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {  
        Schema::create('chairs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->foreign('organization_id')
                ->references('id')->on('organizations')
                ->onDelete('set null');
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->foreign('branch_id')
                ->references('id')->on('branches')
                ->onDelete('set null');
            $table->unsignedBigInteger('faculty_id')->nullable();
            $table->foreign('faculty_id')
                ->references('id')->on('faculties')
                ->onDelete('set null');
                    
            $table->string('code')->nullable();
            $table->integer('isActive')->nullable()->default(1);
            $table->string('logo')->nullable();
            $table->string('image_path')->nullable();
            $table->string('icon_path')->nullable();
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

        Schema::create('chair_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('locale')->index();
            // Foreign key to the main model
            
            $table->unsignedBigInteger('chair_id');
            $table->foreign('chair_id')
                ->references('id')->on('chairs')
                ->onDelete('cascade');

            $table->string('title');
            $table->string('slug');
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
        Schema::dropIfExists('chairs');
    }
}

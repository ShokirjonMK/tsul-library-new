<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBasicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basics', function (Blueprint $table) {
            $table->id();
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

        Schema::create('basic_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('locale')->index();            
            $table->unsignedBigInteger('basic_id');
            $table->foreign('basic_id')
                ->references('id')->on('basics')
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
        Schema::dropIfExists('basics');
    }
}

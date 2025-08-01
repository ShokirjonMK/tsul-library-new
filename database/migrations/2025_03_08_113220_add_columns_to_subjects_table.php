<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subjects', function (Blueprint $table) {
            $table->unsignedBigInteger('subject_group_id')->nullable();
            $table->foreign('subject_group_id')
                ->references('id')->on('subject_groups')
                ->onDelete('set null');
            $table->unsignedBigInteger('education_type_id')->nullable();
            $table->foreign('education_type_id')
                ->references('id')->on('education_types')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subjects', function (Blueprint $table) {
            //
        });
    }
}

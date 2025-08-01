<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFacultetChairToUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_profiles', function (Blueprint $table) {

            $table->unsignedBigInteger('faculty_id')->nullable();
            $table->foreign('faculty_id')
                ->references('id')->on('faculties')
                ->onDelete('set null');
            
            $table->unsignedBigInteger('chair_id')->nullable();
            $table->foreign('chair_id')
                ->references('id')->on('chairs')
                ->onDelete('set null');

            $table->unsignedBigInteger('group_id')->nullable();
            $table->foreign('group_id')
                ->references('id')->on('groups')
                ->onDelete('set null');
            $table->longText('address')->nullable();
            $table->longText('extra')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            //
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            
            $table->string('phone_number');
            $table->string('pnf_code')->nullable();
            $table->string('passport_seria_number')->nullable();
            $table->string('passport_copy')->nullable();
            $table->string('image')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('kursi')->nullable();

            $table->unsignedBigInteger('gender_id')->nullable();
            $table->foreign('gender_id')
                ->references('id')->on('reference_genders')
                ->onDelete('set null');
            
            $table->unsignedBigInteger('user_type_id')->nullable();
            $table->foreign('user_type_id')
                ->references('id')->on('user_types')
                ->onDelete('set null');

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                ->references('id')->on('users')
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
        Schema::dropIfExists('user_profiles');
    }
}

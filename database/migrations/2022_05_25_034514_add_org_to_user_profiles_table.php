<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrgToUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->foreign('organization_id')
                ->references('id')->on('organizations')
                ->onDelete('set null');
        });

        Schema::table('branches', function (Blueprint $table) {
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->foreign('organization_id')
                ->references('id')->on('organizations')
                ->onDelete('set null');
        });
        Schema::table('departments', function (Blueprint $table) {
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->foreign('organization_id')
                ->references('id')->on('organizations')
                ->onDelete('set null');
        });
        Schema::table('book_informations', function (Blueprint $table) {
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->foreign('organization_id')
                ->references('id')->on('organizations')
                ->onDelete('set null');
        });
        Schema::table('book_inventars', function (Blueprint $table) {
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->foreign('organization_id')
                ->references('id')->on('organizations')
                ->onDelete('set null');
        });
        Schema::table('debtors', function (Blueprint $table) {
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->foreign('organization_id')
                ->references('id')->on('organizations')
                ->onDelete('set null');
        });
        Schema::table('books', function (Blueprint $table) {
            $table->integer('put_it_online')->nullable()->default(1);
        });

        Schema::table('books_types', function (Blueprint $table) {
            $table->integer('sort_id')->nullable()->default(1); 
        });

        Schema::table('book_subjects', function (Blueprint $table) {
            $table->integer('sort_id')->nullable()->default(1); 
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

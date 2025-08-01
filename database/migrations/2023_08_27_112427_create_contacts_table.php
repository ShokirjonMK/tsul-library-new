<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->integer('isActive')->nullable()->default(1);
            $table->string('logo')->nullable();
            $table->string('image_path')->nullable();
            $table->string('email')->nullable();
            $table->string('email2')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone2')->nullable();
            $table->string('phone3')->nullable();
            $table->string('fax')->nullable();
            $table->string('fax2')->nullable();
            $table->string('fax3')->nullable();
            $table->longText('map')->nullable();
            $table->string('icon_path')->nullable();
            $table->string('bg_image')->nullable();

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

        Schema::create('contact_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('locale')->index();
            // Foreign key to the main model
            $table->unsignedBigInteger('contact_id');
            $table->foreign('contact_id')
                ->references('id')->on('contacts')
                ->onDelete('cascade');
            $table->string('title');
            $table->string('slug');
            $table->string('site_name')->nullable();
            $table->string('site_name2')->nullable();
            $table->longText('footer_menu')->nullable();
            $table->longText('footer_info')->nullable();
            $table->longText('contacts_info')->nullable();
            $table->longText('home_description')->nullable();
            $table->longText('footer_description')->nullable();
            $table->longText('address_locality')->nullable();
            $table->longText('street_address')->nullable();
            $table->longText('street_address2')->nullable();
            $table->longText('description')->nullable();
            $table->longText('body')->nullable();
            $table->longText('extra1')->nullable();
            $table->longText('extra2')->nullable();

        });
         
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}

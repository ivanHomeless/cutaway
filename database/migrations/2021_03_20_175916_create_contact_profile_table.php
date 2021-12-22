<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_profile', function (Blueprint $table) {
            $table->bigInteger('contact_id')->unsigned();
            $table->bigInteger('profile_id')->unsigned();
            $table->string('link')->nullable();
            $table->string('text')->nullable();
            $table->string('slug')->nullable();
            $table->integer('order_button')->unsigned();
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
        Schema::dropIfExists('contact_profile');
    }
}

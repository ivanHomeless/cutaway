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
//id - 1
//img - лого
//title(задается в админке) - телеграм
//type - ссылка
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('main_link')->nullable();
            $table->string('main_text')->nullable();
            $table->string('example')->nullable();
            $table->string('logo');
            $table->string('background_color')->default('#000000');
            $table->string('color')->default('#FFFFFF');
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
        Schema::dropIfExists('contacts');
    }
}

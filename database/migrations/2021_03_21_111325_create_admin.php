<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('users')->insert([
            'id' => 1,
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'hash' => 'admin',
            'password' => Hash::make('admin'),
            'role' => 1,
            'status' => 1,
        ]);

        DB::table('profiles')->insert([
            'id' => 1,
            'user_id' => 1,
            'name' => 'Admin',
            'description' => 'Admin',
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}

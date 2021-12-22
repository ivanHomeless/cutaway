<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profiles = [];

        for ($i = 2; $i < 17; $i++) {
            $profiles[] = [
                'user_id'     => $i,
                'name'      => 'Name',
                'description' => 'description'
            ];
        }

        DB::table('profiles')->insert($profiles);
    }
}

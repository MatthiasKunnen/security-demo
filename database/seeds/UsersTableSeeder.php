<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    public function run()
    {
        \DB::table('users')->delete();

        \DB::table('users')->insert([
            [
                'id' => 1,
                'username' => 'collateral',
                'email' => 'email@example.com',
                'password' => bcrypt('collateral'),
                'created_at' => Carbon::create(2016, 10, 28)->toDateTimeString(),
            ],
            [
                'id' => 2,
                'username' => 'Cookie_Monster',
                'email' => 'cookies@example.com',
                'password' => bcrypt('cookie'),
                'created_at' => Carbon::create(2016, 11, 1)->toDateTimeString(),
            ],
            [
                'id' => 3,
                'username' => 'morpheus',
                'email' => 'morpheus@gmail.com',
                'password' => bcrypt('morpheus'),
                'created_at' => Carbon::create(2016, 11, 6)->toDateTimeString(),
            ],
            [
                'id' => 4,
                'username' => 'john_wick',
                'email' => 'john_wick@example.com',
                'password' => bcrypt('john_wick'),
                'created_at' => Carbon::create(2016, 11, 20)->toDateTimeString(),
            ],
        ]);
    }
}

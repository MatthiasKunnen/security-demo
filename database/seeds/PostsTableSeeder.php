<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{

    public function run()
    {
        \DB::table('posts')->delete();

        \DB::table('posts')->insert([
            [
                'id' => 1,
                'title' => 'XSS',
                'content' => 'XSS is a thing that developers should care about.',
                'user_id' => 1,
                'created_at' => Carbon::parse('2016-11-10 15:38:12')->toDateTimeString(),
            ],
            [
                'id' => 2,
                'title' => 'SQL injection',
                'content' => 'It\'s super easy!',
                'user_id' => 1,
                'created_at' => Carbon::parse('2016-11-10 15:48:12')->toDateTimeString(),
            ],
            [
                'id' => 3,
                'title' => 'HEYO',
                'content' => 'Test',
                'user_id' => 2,
                'created_at' => Carbon::parse('2016-11-20 18:22:48')->toDateTimeString(),
            ],
        ]);
    }
}

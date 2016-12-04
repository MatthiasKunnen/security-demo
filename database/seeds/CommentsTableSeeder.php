<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{

    public function run()
    {
        \DB::table('comments')->delete();

        \DB::table('comments')->insert([
            [
                'id' => 1,
                'content' => 'Nice post!',
                'created_at' => Carbon::parse('2016-11-25 16:47:05')->toDateTimeString(),
                'user_id' => 4,
                'post_id' => 1,
            ],
            [
                'id' => 2,
                'content' => 'Please... not this again.',
                'created_at' => Carbon::parse('2016-11-25 17:13:18')->toDateTimeString(),
                'user_id' => 2,
                'post_id' => 1,
            ],
            [
                'id' => 3,
                'content' => 'Finally someone said it.',
                'created_at' => Carbon::parse('2016-11-26 09:34:18')->toDateTimeString(),
                'user_id' => 3,
                'post_id' => 1,
            ],
            [
                'id' => 4,
                'content' => 'FIRST!!!',
                'created_at' => Carbon::parse('2016-11-30 11:49:55')->toDateTimeString(),
                'user_id' => 2,
                'post_id' => 2,
            ],
        ]);
    }
}

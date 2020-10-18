<?php

use Illuminate\Database\Seeder;
use App\Models\Tweet;

class TweetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //200個のダミーデータを作る
        factory(Tweet::class,200)->create();
    }
}

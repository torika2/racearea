<?php

use Illuminate\Database\Seeder;
use App\Channel;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $channel = new Channel;
        $channel->twitchname = 'torika14';
        $channel->userId = 1;
        $channel->choosen_game = 'CS:GO';
        $channel->about_stream = 'test1';
        $channel->coins = 0;
        $channel->save();

        $channel = new Channel;
        $channel->twitchname = 'shadowssssssssssssssss';
        $channel->userId = 2;
        $channel->choosen_game = 'Fortnite';
        $channel->about_stream = 'test2';
        $channel->coins = 0;
        $channel->save();
    }
}

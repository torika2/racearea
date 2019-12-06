<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = 'Saba Torikashvili';
        $user->email = 'torikabot@gmail.com';
        $user->coin = 15000;
        $user->streamer = 0;
        $user->admin = 1;
        $user->password = bcrypt('0rzf2v5pw312');
        $user->save();

        $user = new User;
        $user->name = 'Filip Baravi';
        $user->email = 'f.baravi@gmail.com';
        $user->coin = 15000;
        $user->streamer = 0;
        $user->admin = 1;
        $user->password = bcrypt('11223344');
        $user->save();
    }
}

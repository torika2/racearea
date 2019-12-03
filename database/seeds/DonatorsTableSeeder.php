<?php

use Illuminate\Database\Seeder;
use App\Donator;

class DonatorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$donator = new Donator;
    	$donator->userId = 1;
    	$donator->chanId = 1;
    	$donator->amount = 100;
    	$donator->save();

    	$donator = new Donator;
    	$donator->userId = 1;
    	$donator->chanId = 2;
    	$donator->amount = 100;
    	$donator->save();

    	$donator = new Donator;
    	$donator->userId = 2;
    	$donator->chanId = 1;
    	$donator->amount = 100;
    	$donator->save();

    	$donator = new Donator;
    	$donator->userId = 2;
    	$donator->chanId = 2;
    	$donator->amount = 100;
    	$donator->save();
    }
}

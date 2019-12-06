<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Channel;
use App\Chat;
use App\Donator;

class AdminController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
		
	}
    public function page()
    {
    		$users = User::where('admin',0); 

    	return view('adminHome',compact('users'));
    }
}

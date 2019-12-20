<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Channel;
use App\Chat;
use Auth,Input,Redirect;
use App\Donator;
use App\bannedUsers;

class AdminController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
		$this->middleware('admin');
	}
    public function page()
    {
    		$users = User::where('admin',0)->get(); 

    	return view('adminHome',compact('users'));
    }
    public function adminContr()
    {
    	$adminUser = User::where('admin',1)->get();
    	return view('adminController',compact('adminUser'));
    }
    public function userEdit(Request $request)
    {
        $this->validate($request,[
            'userId' => 'required|integer'
        ]);
        if ($request->input('userId')) {
            $userInfo = User::where('users.id',$request->input('userId'))->get();
            $banInfo = bannedUsers::where('userId',$request->input('userId'))->get();

            return view('adminUserEdit',compact('userInfo','banInfo'));   
        }else{
            return Redirect::to('/home');
        }
    }
}

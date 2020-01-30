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
    public function searchAdmin(Request $request)
    {
        $this->validate($request,[
            'search' => 'required'
        ]);
        $adminUser = User::where('name','like','%'.$request->input('search').'%')->get();

        return view('adminControllerForeach',compact('adminUser'));
    }
    public function userEdit(Request $request)
    {
        $this->validate($request,[
            'userId' => 'required|integer'
        ]);
        if ($request->input('userId')) {
            $userInfo = User::where('users.id',$request->input('userId'))->get();
            $banInfo = bannedUsers::where('userId',$request->input('userId'))->get();
            $channel = Channel::all();

            return view('adminUserEdit',compact('userInfo','banInfo','channel'));   
        }else{
            return Redirect::to('/home');
        }
    }
    public function letSearch(Request $request)
    {
        $this->validate($request,[
            'search' => 'required'
        ]);

        $users = User::join('banned_users','banned_users.userId','=','users.id')->where('users.name',$request->input('search'))->where('admin',0)->get();

        if ($users->count() == 0) {
            $users =  User::join('banned_users','banned_users.userId','=','users.id')->where('users.name','like','%'.$request->input('search').'%')->where('admin',0)->get();
        }
        
        return view('adminSearchControl',compact('users'));
    }
    public function adminBan(Request $request)
    {
                $this->validate($request,[
                    'userId' => 'required|integer',
                    'chanId' => 'required|integer'
                ]);
                // if($request->input('banChat') != 1 || $request->input('banChat') != 0 || $request->input('unBanChat') != 0 || $request->input('unBanChat') != 1 || $request->input('unBanChannel') != 1 || $request->input('banChannel') != 0 || $request->input('unBanChannel') != 0 || $request->input('banChannel') != 1){
                //     dd("Dont Try That!");
                //     return Redirect::to('/admin');
                // }
            if ($request->input('unBanChat') != null) {
                $this->validate($request,[
                    'unBanChat' => 'required|integer'
                ]);
                $ban = bannedUsers::where('chanId',$request->input('chanId'))->where('userId',$request->input('userId'))->update(['chatBan'=> 0]);
            }
            if ($request->input('banChat') != null) {
                $this->validate($request,[
                    'banChat' => 'required|integer'
                ]);
                $ban = bannedUsers::where('chanId',$request->input('chanId'))->where('userId',$request->input('userId'))->update(['chatBan'=> 1]);
            }
            if ($request->input('banChannel') != null) {
                $this->validate($request,[
                    'banChannel' => 'required|integer'
                ]);
                $ban = bannedUsers::where('chanId',$request->input('chanId'))->where('userId',$request->input('userId'))->update(['channelBan'=> 1]);
            }
            if ($request->input('unBanChannel') != null) {
                $this->validate($request,[
                    'unBanChannel' => 'required|integer'
                ]);
                $ban = bannedUsers::where('chanId',$request->input('chanId'))->where('userId',$request->input('userId'))->update(['channelBan'=> 0]);
            }

            return Redirect::to('/admin');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input,redirect,Auth;
use Socialite;
use App\User;
use App\Channel;
use App\Subscriber;
use App\Chat;
use App\Image;
use App\Donator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profilePicDelete(Request $request)
    {
        $this->validate($request,[
            'image_id' => 'required|integer',
            'image_path' => 'required'
        ]);

        $checkIfExist = Image::where('id',$request->input('image_id'))->count();
        $checkIfProfileSet = Image::where('id',$request->input('image_id'))->where('my_picture',1)->count();
        if ($checkIfProfileSet > 0) {
            if ($checkIfExist > 0) {
               if(\File::exists($request->input('image_path'))) \File::delete($request->input('image_path'));
               Image::where('id',$request->input('image_id'))->delete();
            }
            $countImages = Image::where('user_id',Auth::user()->id)->count();
            $checkIfIchoosedPicture = ImagE::where('user_id',Auth::user()->id)->where('my_picture',1)->count();
            if ($checkIfIchoosedPicture == 0) {
                Image::where('profile_image','Images/man.png')->update(['my_picture' => 1]);
            }
            if ($countImages == 1) {
                Image::where('user_id',Auth::user()->id)->update(['my_picture' => 1]);
            }
        }
        return redirect('/myStream');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profilePic(Request $request)
    {
        $this->validate($request,[
            'image_id' => 'required|integer'
        ]);
        $ok = Image::where('user_id',Auth::user()->id)->update(['my_picture' => 0]);
        if ($ok) {
            Image::where('id',$request->input('image_id'))->update(['my_picture' => 1]);
        }
        return redirect('/myStream');
    }
    public function index()
    {
            $chan = Channel::join('users','channels.userId','=','users.id')->get();
            $channel = Channel::join('users','channels.userId','=','users.id')->orderBy('channels.coins','desc','channels.view','desc')->first();
            $topStreams = Channel::join('users','channels.userId','=','users.id')->orderBy('coins','desc','view','desc')->take(4)->get();
                if ($channel != NULL && $topStreams != NULL) {
                    return view('home',compact('chan','channel','topStreams'));
                }else{
                    return view('home',compact('chan'));
                }      
    }
    public function Mystream(Request $request)
    {  
        $chan = Channel::where('userId',Auth::user()->id)->get();
        $chat = Chat::select('chats.chanId','chats.id AS cId','chats.userId','users.id as uId','users.name','chats.content')->join('users','users.id','=','chats.userId')->get();
        $image = Image::where('user_id',Auth::user()->id)->get();
        return view('myStream',compact('chan','chat','image'));
    }
    public function buy()
    {
      return view('coinPage');
    }
}

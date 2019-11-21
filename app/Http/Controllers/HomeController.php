<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Input;
use App\User;
use App\Channel;
use App\Subscriber;
use App\Chat;

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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $chan = Channel::join('users','channels.userId','=','users.id')->get();
        $channel = Channel::join('users','channels.userId','=','users.id')->orderBy('channels.view','desc')->first();
        $topStreams = Channel::join('users','channels.userId','=','users.id')->orderBy('channels.view','desc')->take(4)->get();

        return view('home',compact('chan','channel','topStreams'));
    }
    public function Mystream(Request $request)
    {  
        $chan = Channel::all();
        $chat = Chat::join('users','users.id','=','chats.userId')->get();

        return view('myStream',compact('chan','chat'));
    }
    public function buy()
    {

        return view('coinPage');
    }
}

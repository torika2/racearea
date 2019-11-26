<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input,Auth;
use App\User;
use App\Channel;
use App\Donator;
use App\Chat;

class StreamController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
    public function create(Request $request)
    {
    	$this->validate($request,[
    		'twitchName' => 'required',
    		'gameName' => 'required',
    		'desc' => 'required'
    	]);

    	$ch = new Channel;
    	$ch->userId = Auth::user()->id;
    	$ch->choosen_game = $request->input('gameName');
    	$ch->twitchname = $request->input('twitchName');
    	$ch->about_stream = $request->input('desc');
    	$ch->save();
        
    	$id = Auth::user()->id;
		User::where('id',$id)->update(['streamer' => 1]);

    	return \Redirect::to('/myStream');
    }
    public function view(Request $request)
    {
        if ($request->input('userId')) {
            $this->validate($request, [
                'userId' => 'required'
            ]);
            $userId = $request->input('userId');
                                $chat = Chat::join('users','users.id','=','chats.userId')
                    ->join('channels','users.id','=','channels.userId')
                    ->get();
            $chan = Channel::select('channels.view','users.coin','channels.twitchname','channels.id AS chanId','users.id AS uId')->join('users','channels.userId','=','users.id')->where('users.id',$userId)->get();
            $chanId = $request->input('chanId');
            $donator = Donator::select('amount')->where('chanId',$chanId)->sum('amount');
             $topDonator = Donator::select('donators.userId','donators.chanId','amount','name')->join('users','users.id','=','donators.userId')->where('chanId',$chanId)->groupBy('users.name')->orderBy('amount','DESC')->get();
        }else{
            $this->validate($request, [
                'chanId' => 'required'
            ]);
            $userId = $request->input('chanId');
                                $chat = Chat::join('users','users.id','=','chats.userId')
                    ->join('channels','users.id','=','channels.userId')
                    ->get();
            $chan = Channel::select('channels.view','users.coin','channels.twitchname','channels.id AS chanId','users.id AS uId')->join('users','channels.userId','=','users.id')->where('channels.id',$userId)->get();
            $chanId = $request->input('chanId');
            $donator = Donator::select('amount')->where('chanId',$chanId)->sum('amount');
             $topDonator = Donator::select('donators.userId','donators.chanId','amount','name')->join('users','users.id','=','donators.userId')->where('chanId',$chanId)->groupBy('users.name')->orderBy('amount','DESC')->get();
        }
        return view('anotherStream',compact('chan','chat','donator','topDonator'));
    }
}

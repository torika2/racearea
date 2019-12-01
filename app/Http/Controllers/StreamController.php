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

            $this->validate($request, [
                'userId' => 'required|integer'
            ]);
            $userId = $request->input('userId');
                                $chat = Chat::select('channels.twitchname','chanId','chats.id AS cId','chats.content')->join('users','users.id','=','chats.userId')
                    ->join('channels','users.id','=','channels.userId')
                    ->get();
              
            $chan = Channel::select('channels.view','users.coin','channels.twitchname','channels.id AS chanId','users.id AS uId')->join('users','channels.userId','=','users.id')->where('users.id',$userId)->get();
            $chanId = $request->input('chanId');
            $donator = Donator::select('amount')->where('chanId',$chanId)->sum('amount');
             $topDonator = User::distinct()->select('name','chanId')->selectRaw('sum(amount) as total')->join('donators','donators.userId','=','users.id')->where('chanId',$chanId)->groupBy('users.id')->orderBy('total','DESC')->get();
        return view('anotherStream',compact('chan','chat','donator','topDonator'));
    }
    public function anotherDonator(Request $request)
    {
        $this->validate($request,[
            'chanId'=>'required|integer'
        ]);

        // $topDonator = Donator::selectRaw('distinct(channels.twitchname)','sum(amount) AS total')->where('chanId',$request->input('chanId'))->join('channels','channels.id','=','donators.chanId')->groupBy('chanId')->orderBy('userId','DESC')->get();
        $topDonator = User::distinct()->select('users.name','users.id as userId','chanId')->selectRaw('sum(amount) as total')->join('donators','donators.userId','=','users.id')->where('chanId',$request->input('chanId'))->groupBy('users.id')->orderBy('total','DESC')->get();

       return view('anotherTopDonator',compact('topDonator'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth,Input,Redirect;
use App\Channel;
use App\Chat;
use App\Donator;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function another(Request $request)
    {
            $this->validate($request,[
                'chanId' => 'required|integer'
                // 'dataId' => 'required|integer'
            ]);
            $chat = Chat::select('chanId','chats.id as id','chats.userId','content','twitchname')->join('channels','channels.userId','=','chats.userId')->where('chats.chanId',$request->chanId)->orderBy('chats.id','desc')->get(); 

            $chan = Channel::all();
// return $chat;
           return view('another',compact('chat','chan'));
    }
    public function recieve(Request $request)
    {
        $this->validate($request,[
            'chanId' => 'required|numeric',
            'lastMsg' => 'required|numeric'
        ]);

        $chat = Chat::select('chats.chanId','chats.id AS cId','chats.userId','users.id as uId','users.name','chats.content')->join('users','users.id','=','chats.userId')->where('chats.id','>',$request->input('lastMsg'))->get();
        $chan = Channel::all();

        return view('calke',compact('chat','chan'));

    }
    public function create(Request $request)
    {
    	$this->validate($request,[
    		'content' => 'required',
    		'chanId' => 'required'
    	]);
    	$chat = new Chat;
    	$chat->chanId = $request->input('chanId');
    	$chat->content = $request->input('content');
    	$chat->userId = Auth::user()->id;
    	$chat->save();
            
            return Redirect::to('myStream');
    }
    public function anotherCreate(Request $request)
    {
        $this->validate($request,[
            'content' => 'required',
            'chanId' => 'required',
        ]);

        $chats = new Chat;
        $chats->chanId = $request->input('chanId');
        $chats->content = $request->input('content');
        $chats->userId = Auth::user()->id;
        $chats->save();

        if ($request->input('aUserId') && $request->input('chanId')) {
                    $userId = $request->input('aUserId');
                    $chanId = $request->input('chanId');
                    $chat = Chat::select('channels.twitchname','channels.id AS chanId','chats.id AS cId','chats.content')->join('users','users.id','=','chats.userId')
                    ->join('channels','users.id','=','channels.userId')
                    ->get();


                    $chan = Channel::select('channels.view','users.coin','channels.twitchname','channels.id AS chanId','users.id AS uId')
                    ->join('users','channels.userId','=','users.id')
                    ->where('users.id',$userId)->where('channels.id',$chanId)->get();

                                $donator = Donator::select('amount')->where('chanId',$chanId)->sum('amount');
                                $topDonator = Donator::select('donators.userId','donators.chanId','amount','name')->join('users','users.id','=','donators.userId')->where('chanId',$chanId)->groupBy('users.name')->orderBy('amount','DESC')->get();
                                // print_r($topDonator);
                                // exit();

        }
        // return response()->json([
        //     'chat' => 'Success',
        //     'donator' => 'Success Donator',
        //     'topDonator' => 'Success TopDonator'
        // ]);

            return view('anotherStream',compact('chat','chan','donator','topDonator'));

    }
}
// $chan = Channel::select('chats.content','channels.view','users.coin','channels.twitchname','channels.id AS chanId','users.id AS uId')->join('users','channels.userId','=','users.id')->join('chats','channels.id','=','chats.chanId')->get();
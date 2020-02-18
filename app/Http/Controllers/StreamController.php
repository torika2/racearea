<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input,Auth;
use App\User;
use App\Channel;
use App\Donator;
use App\Image;
use App\Chat;
use App\bannedUsers;

class StreamController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
    public function create(Request $request)
    {
            	$this->validate($request,[
            		'twitchName' => 'required|unique:channels',
            		'gameName' => 'required',
            		'desc' => 'required'
            	]);

            	$ch = new Channel;
            	$ch->userId = Auth::user()->id;
            	$ch->choosen_game = $request->input('gameName');
            	$ch->twitchname = $request->input('twitchName');
            	$ch->about_stream = $request->input('desc');
            	$ch->save();

                $im = new Image;
                $im->user_id = Auth::user()->id;
                $im->my_picture = 1;
                $im->profile_image = 'Images/man.png';
                $im->save();

        		User::where('id',Auth::user()->id)->update(['streamer' => 1]);
                return \Redirect::to('/myStream');

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
            $userInfo = bannedUsers::select('users.id as userId','chatBan','channelBan','name')->join('users','users.id','=','banned_users.userId')->where('chanId',$request->input('chanId'))->get();

                $userCheck = bannedUsers::select('userId')->where('chanId',$chanId)->where('userId',Auth::user()->id)->count();
                if ($userCheck == 0) {
                    $bannCheck = new bannedUsers;
                    $bannCheck->chanId = $request->input('chanId');
                    $bannCheck->userId = Auth::user()->id;
                    $bannCheck->chatBan = 0;
                    $bannCheck->channelBan = 0;
                    $bannCheck->save();
                }    
        return view('anotherStream',compact('chan','chat','donator','topDonator','userInfo'));
    }
    public function anotherDonator(Request $request)
    {
        $this->validate($request,[
            'chanId'=>'required|integer'
        ]);

        // $topDonator = Donator::selectRaw('distinct(channels.twitchname)','sum(amount) AS total')->where('chanId',$request->input('chanId'))->join('channels','channels.id','=','donators.chanId')->groupBy('chanId')->orderBy('userId','DESC')->get();
        $topDonator = User::distinct()->select('twitchname','users.name','users.id as userId','chanId')->selectRaw('sum(amount) as total')->join('channels','channels.userId','=','users.id')->join('donators','donators.userId','=','users.id')->where('chanId',$request->input('chanId'))->groupBy('users.id')->orderBy('total','DESC')->get();

       return view('anotherTopDonator',compact('topDonator'));
    }
    public function bannedUsers(Request $request)
    {
        $this->validate($request,[
            '' => 'required'
        ]);
    }
    public function banStreamUser(Request $request)
    {
        $this->validate($request,[
            'streamerUserId' => 'required|integer',
            'selectedBan' => 'required|string',
            'chanId' => 'required|integer'
        ]);

        if ($request->input('selectedBan') == 'chat') {
            bannedUsers::where('chanId',$request->input('chanId'))->where('userId',$request->input('streamerUserId'))->update(['chatBan' => 1]);
        }
        if ($request->input('selectedBan') == 'channel') {
            bannedUsers::where('chanId',$request->input('chanId'))->where('userId',$request->input('streamerUserId'))->update(['channelBan' => 1]);
        }

        return \Redirect::to('/home');
    }
    public function uploadPhoto(Request $request)
    {

        $this->validate($request,[
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $image = time().'.'.$request->file('image')->getClientOriginalExtension();
            $filePath = $request->image->move('public\uploadedImage',$image);

            $checkImageName = Image::where('profile_image',$filePath)->count();
            if ($checkImageName == 0) {
                $makeProfile = Image::where('user_id',Auth::useR()->id)->where('my_picture',1)->update(['my_picture' => 0]);
                if ($makeProfile) {
                    $image = new Image;
                    $image->user_id = Auth::user()->id;
                    $image->my_picture = 1;
                    $image->profile_image = $filePath;
                    $image->save();
                }
            }
        }
        return redirect('myStream');
    }
}

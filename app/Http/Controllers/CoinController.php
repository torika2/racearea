<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use Auth,Input;
use App\User;
use App\Donator;

class CoinController extends Controller
{
   public function __construct()
   {
        $this->middleware('auth');
   }

   public function layoutCoin(Request $request)
   {
      $coin = User::select('coin')->where('id',Auth::user()->id)->get();

      return view('myCoinView',compact('coin'));
   }

   public function buy(Request $request)
   {  
         $this->validate($request,[
            'price' =>'required|integer|min:100|max:5000'
         ]);
         $myId = Auth::user()->id;
         $coin = User::select('coin')->where('id',$myId)->get();
         $user = User::find($myId);
         $user->coin +=  $request->input('price')+$request->input('price')/9;
         $user->save();

            return route('coinBuy');
   }

   public function donate(Request $request)
   {
      if (Auth::user()->coin >= $request->input('amount')) {
         $this->validate($request,[
            'amount'  => 'required|integer',
            'chanId' => 'required|integer'
         ]);

         $donator = new Donator;
         $donator->userId = Auth::user()->id;
         $donator->chanId = $request->input('chanId');
         $donator->amount = $request->input('amount');
         $donator->save();

         $userId =Auth::user()->id;
         $coin = Auth::user()->coin - $request->input('amount');

            if ($donator && $userId && $userId && $coin) {
               User::where('id',$userId)->update(['coin'=>$coin]);
            }
         return route('home');
      }else{
        return route('coinBuy');
      }
   }

   public function anotherCoinPage(Request $request)
   {
      $this->validate($request,[
         'chanId' => 'required|integer'
      ]);

      $channelDonatedCoins = Donator::selectRaw('sum(amount) AS total')->where('chanId',$request->input('chanId'))->groupBy('chanId')->get();

      return view('coinAnotherPage',compact('channelDonatedCoins'));
   }

}

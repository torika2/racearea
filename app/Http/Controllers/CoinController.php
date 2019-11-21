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
   public function buy(Request $request)
   {  
   		$this->validate($request,[
   			'price' =>'required'
   		]);
   		$myId = Auth::user()->id;
   		$coin = User::select('coin')->where('id',$myId)->get();
   		$user = User::find($myId);
   		$user->coin +=  $request->input('price')+$request->input('price')/9;
   		$user->save();

         return view('coinPage');
   }
   public function donate(Request $request)
   {
      if (Auth::user()->coin >= $request->input('price')) {
         $this->validate($request,[
            'amount'  => 'required',
            'chanId' => 'required'
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
      }
      return Redirect::to('/home');
   }
}

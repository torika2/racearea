<?php

namespace App\Http\Controllers;
use Auth,redirect;
use Socialite;
use App\User;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
     
    public function callback($provider)
    {
               
        $getInfo = Socialite::driver($provider)->user();
         
        $user = $this->createUser($getInfo,$provider);
     
        Auth()->login($user);
     
        return redirect()->to('/home');
     
    }
    function createUser($getInfo,$provider){
     
     $user = User::where('email', $getInfo->email)->first();
     
     if (!$user) {
         $user = User::create([
            'name'     => $getInfo->name,
            'email'    => $getInfo->email,
            'provider' => $provider,
            'provider_id' => $getInfo->id
        ]);
      }
      return $user;
    }
}

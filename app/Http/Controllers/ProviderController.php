<?php

namespace App\Http\Controllers;

use App\Models\User;
// use League\OAuth1\Client\Server\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class ProviderController extends Controller
{
    // redirect Socialite
    public function redirect($provider){
        return Socialite::driver($provider)->redirect();
    }

    // callback Socialite
    public function callback($provider){
        $socialiteUser = Socialite::driver($provider)->user();

        // if providerName and ID are not the same it will create data. Otherwise, it will update.
        $user = User::updateOrCreate([
            'providerName' => $provider,
            'providerId' => $socialiteUser -> id,
        ],
        [
            'name' => $socialiteUser->name ,
            'nickname' => $socialiteUser ->nickname,
            'email' => $socialiteUser -> email,
            'providerToken' => $socialiteUser -> token,
        ]);

        Auth::login($user);

        // dd(Auth::user()->role);

        if(Auth::user()->role == 'admin'){
            return to_route('adminDashboard');
        }

        if(Auth::user()->role == 'user'){
            return to_route('customerDashboard');
        }

    }
}

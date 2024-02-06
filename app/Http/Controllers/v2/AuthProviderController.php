<?php

namespace App\Http\Controllers\v2;

use App\Http\Controllers\Controller;
use App\SocialProvider;
use App\User;
use Laravel\Socialite\Facades\Socialite;

class AuthProviderController extends Controller
{
    public function redirectToProvider($provider)
    {
        if (!in_array($provider, ['google'])) {

            return abort(403, 'Provider not registered.');
        }

        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $socialUser = Socialite::driver($provider)->stateless()->user();

        $socialProvider = SocialProvider::query()
            ->where('provider_id', $socialUser->getId())
            ->first();

        if ($socialProvider) {

            $user = $socialProvider->user();

            $accessToken = $user->createToken($user->email)->plainTextToken;

            return redirect('/portal/v2/application-form?accessToken='.$accessToken.'&provider='.$provider);
        }

        $user = User::create([
            'name' => str_replace(' ', '', $socialUser->getName()),
            'email' => $socialUser->getEmail(),
            'password' => '',
            'verified' => true,
            'vToken' => '',
            'isOnline' => false,
            'isFilled' => false
        ]);

        $accessToken = $user->createToken($user->email)->plainTextToken;

        $user->attachRole('student');

        SocialProvider::create([
            'user_id'       =>  $user->id,
            'provider_id'   =>  $socialUser->getId(),
            'provider'      =>  $provider
        ]);

        return redirect('/portal/v2/application-form?accessToken='.$accessToken.'&provider='.$provider);
    }
}

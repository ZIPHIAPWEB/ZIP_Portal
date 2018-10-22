<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\SocialProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use Mockery\Exception;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/portal';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
    {
        try {
            $social_user = Socialite::driver('google')->stateless()->user();

        } catch (Exception $e) {
            return redirect('/portal');
        }

        $socialProvider = SocialProvider::where('provider_id', $social_user->getId())->first();
        if (!$socialProvider) {
            $user = User::firstOrCreate([
                'name'      =>  $social_user->getName(),
                'email'     =>  $social_user->getEmail(),
                'password'  =>  '',
                'verified'  =>  true,
                'vToken'    =>  '',
                'isOnline'  =>  false,
                'isFilled'  =>  false
            ]);

            $user->attachRole('student');

            SocialProvider::create([
                'user_id'       =>  $user->id,
                'provider_id'   =>  $social_user->getId(),
                'provider'      =>  'google'
            ]);
        } else {
            $user = User::find($socialProvider->user_id);

            $user->update([
                'isOnline'  =>  true
            ]);

            auth()->login($user, false);

            return redirect(url('/portal'));
        }
    }
}

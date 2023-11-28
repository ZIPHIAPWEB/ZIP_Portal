<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\SocialProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use Mockery\Exception;
use Illuminate\Http\Request;

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
            $socialProvider = SocialProvider::where('provider_id', $social_user->getId())->first();

            if (!$socialProvider) {
                $user = User::firstOrCreate([
                    'name'      =>  str_replace(' ', '', $social_user->getName()),
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

                auth()->login($user, false);

                return redirect('portal');
            } else {
                $user = User::find($socialProvider->user_id);

                if ($user) {
                    $user->update([
                        'isOnline'  =>  true
                    ]);

                    auth()->login($user, false);

                    return redirect('portal');
                } else {
                    $user = User::create([
                        'name'      =>  str_replace(' ', '', $social_user->getName()),
                        'email'     =>  $social_user->getEmail(),
                        'password'  =>  '',
                        'verified'  =>  true,
                        'vToken'    =>  '',
                        'isOnline'  =>  false,
                        'isFilled'  =>  false
                    ]);

                    $user->attachRole('student');

                    SocialProvider::where('provider_id', $social_user->getId())->update([
                        'user_id'       =>  $user->id,
                        'provider_id'   =>  $social_user->getId(),
                        'provider'      =>  'google'
                    ]);

                    auth()->login($user, false);

                    return redirect('portal');
                }
            }
        } catch (Exception $e) {
            return redirect('portal');
        }
    }

    protected function authenticated(Request $request, User $user)
    {
        $user->update([
            'isOnline'  =>  true
        ]);
    }

    public function logout(Request $request)
    {
        $user = \App\User::find($request->user()->id);

        $user->update([
            'isOnline' => false
        ]);

        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect()->route('welcome');
    }

    public function username()
    {
        return 'name';
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Mail\verifyEmail;
use App\User;
use App\Coordinator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255|unique:users',
            
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    protected function coorValidator(array $data)
    {
        return Validator::make($data, [
            'name'              => 'required|string|max:255|unique:users',
            'email'             => 'required|string|email|max:255|unique:users',
            'password'          => 'required|string|min:6|confirmed',
            'first-name'        => 'required',
            'middle-name'       => 'required',
            'last-name'         => 'required',
            'program'           => 'required',
            'contact-1'         => 'required'
        ]);
    }

    protected function sponsorValidator(array $data)
    {
        return Validator::make($data, [

        ]);
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name'      => $data['name'],
            'email'     => $data['email'],
            'password'  => bcrypt($data['password']),
            'vToken'    => str_random(40),
            'verified'  => false,
            'isOnline'  => false,
            'isFilled'  => false
        ]);

        $user->attachRole('student');

        $thisUser = User::findOrFail($user->id);
        $this->sendMail($thisUser);
    }

    protected function coorCreate(array $data)
    {
        $user = User::create([
            'name'      => $data['name'],
            'email'     => $data['email'],
            'password'  => bcrypt( $data['password']),
            'vToken'    => '',
            'verified'  => false,
            'isOnline'  => false,
            'isFilled'  => false
        ]);

        $user->attachRole('coordinator');

        Coordinator::create([
            'user_id'       => $user->id,
            'firstName'     => $data['first-name'],
            'middleName'    => $data['middle-name'],
            'lastName'      => $data['last-name'],
            'program'       => $data['program'],
            'position'      => $data['position'],
            'contact'       => $data['contact-1']
        ]);

    }

    protected function sponsorCreate(array $data)
    {

    }

    public function sendMail($thisUser)
    {
        Mail::to($thisUser->email)->send(new verifyEmail($thisUser));
    }

    public function verified($email, $token)
    {
        $user = User::where(['email' => $email, 'vToken' => $token])->update(['verified' => 1, 'vToken' => '']);

        return redirect()->route('login')->with('Info', '<b>Activated!</b>'.$email.' verified!');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function showCoorRegistrationForm()
    {
        return view('auth.coordinator-register');
    }

    public function showSponsorRegistrationForm()
    {
        return view('auth.sponsor-register');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        return redirect()->route('login')->with('Info', '<b>Registered Successfully!</b> Please verify your email to activate your account!');

        //$this->guard()->login($user);
        //return $this->registered($request, $user) ?: redirect($this->redirectPath());
    }

    public function coorRegister(Request $request)
    {
        $this->coorValidator($request->all())->validate();

        $user = $this->coorCreate($request->all());

        return redirect()->route('login')->with('Info', '<b>Registered Successfully!</b> Please wait for the Superadmin to activate your account');
    }

    public function sponsorRegister(Request $request)
    {
        $this->sponsorValidator($request->all())->validate();

        $user = $this->sponsorCreate($request->all());

        return redirect()->route('login')->with('Info', '<b>Registered Successfully!</b> Please verify your email to activate your account!');
    }

}

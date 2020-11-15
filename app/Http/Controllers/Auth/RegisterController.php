<?php

namespace App\Http\Controllers\Auth;

use App\Services\SendTextMessage;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/home';

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
            'name' => ['required', 'string', 'max:255'],
            'profession' => ['required', 'string', 'max:255'],
            'reason' => ['required', 'string'],
            'dob' => ['required', 'date'],
            'phone' => ['required', 'numeric'],
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
        $sendMsg = new SendTextMessage(env("SMS_USERNAME"), env("SMS_PASSWORD"));

        $code = $otp = strtoupper(substr(str_shuffle(str_replace('.', '', uniqid('', true))), 17, 5));

       $user = User::create([
            'name' => $data['name'],
            'dob' => $data['dob'],
            'profession' => $data['profession'],
            'code' => $code,
            'phone' => '233'. substr($data['phone'], -9),
            'reason' => nl2br($data['reason'])
        ]);

       $msg = "Hello {{$user->name}}, your registration with Mo-Africa was successful. Kindly use {{$code}} as your ID";

        $sendMsg->sendSms($user->name, $user->phone, $msg);
    }


    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        return $this->registered($request, $user)
            ?: redirect()->back()->with('success', 'Your Details have been saved successfully');
    }
}

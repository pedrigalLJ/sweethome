<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use App\Models\AgentVerification;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = '/login';

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
            'given_name'        => ['required', 'string','regex:/^[a-zA-Z\s]+$/u', 'max:50'],
            'last_name'         => ['required', 'string','regex:/^[a-zA-Z\s]+$/u', 'max:50'],
            'phone_no'          => ['required', 'string', 'regex:/^(09|\+639)\d{9}$/'],
            'city'              => ['required', 'string', 'regex:/^[a-zA-Z\s]+$/u', 'max:100'],
            'province'          => ['required', 'string', 'regex:/^[a-zA-Z\s]+$/u', 'max:100'],
            'email'             => ['required', 'string', 'email', 'unique:users,email'],
            'username'          => ['required', 'string', 'regex:/^\S*$/','min:4','unique:users,username'],
            'password'          => ['required', 'string', 'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).{8,30}$/','min:8', 'max:30', 'confirmed'],
            //regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/|

            'id_picture'    => ['mimes:jpg,png,jpeg', 'max:5048']
        ],[
            'password.regex' => 'Password must have at least one of each type among lowercase, uppercase, and numbers between 8 and 30 characters.'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $r_id = isset($data['agent']) ? 1 : 2;
        $user = User::create([
            'role_id'       => $r_id,
            'given_name'    => $data['given_name'],
            'last_name'     => $data['last_name'],
            'phone_no'      => $data['phone_no'],
            'city'          => $data['city'],
            'province'      => $data['province'],
            'email'         => $data['email'],
            'username'      => $data['username'],
            'password'      => Hash::make($data['password']),
            'trial_until' => now()->addDays(config('app.free_trial_days'))
        ]);
        
        if($r_id === 1)
        {
            $filename = time().'-'. $data['license_no'].'.'.$data['id_picture']->extension();
            $data['id_picture']->move(public_path('storage/agent-id-pictures'), $filename);

            AgentVerification::create([
                'agent_id'    => $user->id,
                'birthdate'   => $data['birthdate'],
                'license_no'  => $data['license_no'],
                'id_picture'  => $filename,
            ]);
            
        }

        return $user;
    }
}

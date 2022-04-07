<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
        protected function redirectTo()
        {
            if( Auth()->user()->role_id == 1){
                return route('agent.dashboard');
            }
            elseif( Auth()->user()->role_id == 2){
                return route('seeker.dashboard');
            }
        }
    
    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function rules()
    {

        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).{8,30}$/|max:30',
        ];
        
    }

    protected function validationErrorMessages()
    {
        return [
          'password.regex' => 'Password must have at least one of each type among lowercase, uppercase, and numbers between 8 and 30 characters.'
        ];
    }
}

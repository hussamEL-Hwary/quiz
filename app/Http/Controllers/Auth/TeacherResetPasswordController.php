<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Password;
use Auth;
class TeacherResetPasswordController extends Controller
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
    protected $redirectTo = '/teacher';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:teacher');
    }

    /**
    *specifiy the guard that we will change the password for
    *@return guard
    */
    protected function guard()
    {
     return Auth::guard('teacher');
    }

    /**
    *specifiy the password broker that we will use
    *@return broker
    */
    protected function broker()
    {
       return Password::broker('teachers');
    }

    /**
    *reset form niew
    *@return view
    */
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset-teacher')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

}

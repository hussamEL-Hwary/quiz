<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use auth;
class StudentLoginController extends Controller
{


    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest:student')->except('logout');
    }

    /*
    *this function returns teacher login form
    */
    public function showLoginForm()
    {
      return view('auth.studentLogin');
    }

    /*
    *this function logs teacher in
    */
    public function login(Request $request)
    {
      //validate form data
      $this->validate($request,[
        'email'=>'required|email',
        'password'=>'required'
      ]);
      //try to login
      if(Auth::guard('student')->attempt(['email'=>$request->email,'password'=>$request->password],$request->remember))
      {
         //if success redirect to teacher homepage
         return redirect()->intended(route('student.dashboard'));
      }
      //if not sucess redirect back with form data excep password
      $errors = ['email' => trans('auth.failed')];
      return redirect()->back()->withInput($request->only('email','remember'))->withErrors($errors);
    }

    /*
    *this function logs teacher out
    */
    public function logout()
    {
        $this->guard('student')->logout();

        session()->invalidate();

        return redirect('/');
    }
}

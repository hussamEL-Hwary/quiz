<?php

namespace App\Http\Controllers\Auth;

use App\Teacher;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class TeacherRegisterController extends Controller
{



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
    *this function validate teacher sign up form data
    *
    *@return validator
    */
    public function validateTeacherData(array $data)
    {
       return Validator::make($data, [
        'first_name'            => 'required|string|min:2|max:30',
        'last_name'             =>'required|string|min:2|max:30',
        'email'                 => 'required|email|unique:teachers',
        'password'              => 'required|string|min:6|confirmed',
        'date'                   => 'required|date',
        'gender'                => 'required',
        'type'                  => 'required',
        'g-recaptcha-response'  => 'required|captcha',
    ]);


    }

    /**
    *this function create new teacher instance
    *@return Teacher
    */
    public function createTeacher(array $data)
    {
      return Teacher::create([
        'first_name'    =>   $data['first_name'],
        'last_name'     =>   $data['last_name'],
        'email'         =>   $data['email'],
        'password'      =>   bcrypt($data['password']),
        'token'         =>   str_random(64),
        'birthday'      =>   $data['date'],
        'activated'     =>   false,
      ]);
    }

    /**
    *login teacher
    */
    public function teacherLogin(Teacher $teacher)
    {
       Auth::guard('teacher')->login($teacher,false);
    }



}

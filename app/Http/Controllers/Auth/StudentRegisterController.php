<?php

namespace App\Http\Controllers\Auth;

use App\Student;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
class StudentRegisterController extends Controller
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
    *validate Student data
    *@return Validator
    */
    public function validateStudentData(array $data)
    {
      return Validator::make($data,[
        'first_name'            => 'required|string|min:2|max:30',
        'last_name'             =>'required|string|min:2|max:30',
        'email'                 => 'required|email|unique:students',
        'password'              => 'required|string|min:6|confirmed',
        'day'                   => 'required|integer|between:1,31',
        'month'                 => 'required|integer|between:1,12',
        'year'                  => 'required|integer|min:1900|max:'.date('Y'),
        'gender'                => 'required',
        'type'                  => 'required',
        'g-recaptcha-response'  => 'required|captcha',
      ]);

    }
    /**
    *create new instance of student
    *@return Student
    */

    public function createStudent(array $data)
    {
      return Student::create([
        'first_name'  => $data['first_name'],
        'last_name'   => $data['last_name'],
        'email'       => $data['email'],
        'password'    => bcrypt($data['password']),
        'token'       =>str_random(64),
        'birthday'    => $data['year'].'-'.$data['month'].'-'.$data['day'],
        'activated'   =>false,
      ]);

    }

    /**
    *login student
    */
    public function studentLogin(Student $student)
    {
      Auth::guard('student')->login($student,false);
    }


}

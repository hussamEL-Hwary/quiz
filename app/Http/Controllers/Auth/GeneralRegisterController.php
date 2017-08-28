<?php

namespace App\Http\Controllers\Auth;

use App\Teacher;
use App\Student;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Mail\WelcomeTeacher;
use App\Mail\WelcomeStudent;
class GeneralRegisterController extends Controller
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


    public function showRegiterForm()
    {
      return view('auth.register');
    }

    public function call(Request $request)
    {
      $teacherRegister=new TeacherRegisterController;
      $studentRegister=new StudentRegisterController;

      if($request->type=='teacher')
      {

        $validResult=$teacherRegister->validateTeacherData($request->all());
        if($validResult->fails())
        {
          return redirect()
            ->back()
            ->withErrors($validResult)
            ->withInput($request
            ->only('first_name','last_name','email','day','month','year','gender','type'));
        }

        $teacher=$teacherRegister->createTeacher($request->all());
        $teacherRegister->teacherLogin($teacher);
        \Mail::to($teacher)->send(new WelcomeTeacher($teacher));
        session()->flash('message','Thanks for Registeration');
        return redirect()->intended(route('teacher.dashboard'));


      }
      else if($request->type=='student')
      {
        $validResult=$studentRegister->validateStudentData($request->all());
        if($validResult->fails())
        {
          return redirect()
          ->back()
          ->withErrors($validResult)
          ->withInput($request
          ->only('first_name','last_name','email','day','month','year','gender','type'));
        }
        $student=$studentRegister->createStudent($request->all());
        $studentRegister->studentLogin($student);
        \Mail::to($student)->send(new WelcomeStudent($student));
        session()->flash('message','Thanks for Registeration');
        return redirect(route('student.dashboard'));

      }
      else {
        return redirect()
        ->back()
        ->withInput($request
        ->only('first_name','last_name','email','day','month','year','gender','type'));

      }

    }



}

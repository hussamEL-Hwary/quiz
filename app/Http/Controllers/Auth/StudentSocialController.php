<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Student;
use App\StudentSocial;
use Illuminate\Support\Facades\Auth;
use Socialite;
use Session;
class StudentSocialController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Redirect the user to the provider authentication page.
     *
     * @return Response
     */

     public function __construct()
     {
         $this->middleware('guest:student');
     }



    /**
     * Obtain the user information from provider.
     *
     * @return Response
     */
    public function handleData($socialObject ,$provider)
    {
    //return dd($socialObject);


        $socialStudent=null;
        $studentEmail=$socialObject->email;
        //check if user exist
        $checkStudent=Student::where('email','=',$studentEmail)->first();

        if(!$socialObject->email)
        {
          $studentEmail='missing'.str_random(10);
        }
        if(empty($checkStudent))
        {

          $socialId=StudentSocial::where('social_id','=',$socialObject->id)
          ->where('provider','=',$provider)
          ->first();
          if(empty($socialId))
          {  //create new account for Student
            $StudentSocialData=new StudentSocial;
            $fullname=explode(' ',$socialObject->name);
            if(empty($socialObject->name))
            {
              $fullname= array('student','student');
            }
            if(count($fullname)==1)
            $fullname[1]='student';

            $newStudent=Student::create([
              'first_name'     =>$fullname[0],
              'last_name'      =>$fullname[1],
              'email'          =>$studentEmail,
              'password'       =>bcrypt(str_random(40)),
              'token'          =>str_random(64),
              'birthday'       =>'2014-6-5',
              'activated'      =>true,
            ]);

            $newStudent->activated=true;
            $StudentSocialData->social_id=$socialObject->id;
            $StudentSocialData->provider=$provider;
            $newStudent->social()->save($StudentSocialData);
            //$StudentSocialData->Student()->save();
            $newStudent->save();
              $socialStudent=$newStudent;
          }
          else { //get Student
            $socialStudent=$socialId->student;

          }
          /*
          *login social Student here
          */

         Auth::guard('student')->login($socialStudent,false);
          //return redirect()->intended(route('Student.dashboard'));
        }
        else {
          //if we found Student in Student table
          /*
          *log in Student here
          */
          $socialStudent=$checkStudent;

          Auth::guard('student')->login($socialStudent,false);
          //return redirect()->intended(route('Student.dashboard'));
        }


    }
}

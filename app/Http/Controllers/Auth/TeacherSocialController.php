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
use App\Teacher;
use App\TeacherSocial;
use Illuminate\Support\Facades\Auth;
use Socialite;
class TeacherSocialController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Redirect the user to the provider authentication page.
     *
     * @return Response
     */

     public function __construct()
     {
         $this->middleware('guest:teacher');
     }

    public function redirectToProvider($provider)
    {
      $providerKey = Config::get('services.' . $provider);
       if (empty($providerKey)) {
           //return view('pages.status')
            //   ->with('error','No such provider');
            return 'No such provider';
       }
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from provider.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {

      if (Input::get('denied') != '') {
        return 'uh oh';
        //  return redirect()->to('login')
          //    ->with('status', 'danger')
            //  ->with('message', 'You did not share your profile data with our social app.');
      }
        $socialObject = Socialite::driver($provider)->user();
        //return dd($socialObject);
        $socialTeacher=null;
        $teacherEmail=$socialObject->email;
        //check if user exist
        $checkTeacher=Teacher::where('email','=',$teacherEmail)->first();

        if(!$socialObject->email)
        {
          $teacherEmail='missing'.str_random(10);
        }
        if(empty($checkTeacher))
        {

          $socialId=TeacherSocial::where('social_id','=',$socialObject->id)
          ->where('provider','=',$provider)
          ->first();
          if(empty($socialId))
          {  //create new account for teacher
            $teacherSocialData=new TeacherSocial;
            $fullname=explode(' ',$socialObject->name);
            if(empty($socialObject->name))
            {
              $fullname= array('teacher','teacher');
            }
            if(count($fullname)==1)
            $fullname[1]='teacher';

            $newTeacher=Teacher::create([
              'first_name'     =>$fullname[0],
              'last_name'      =>$fullname[1],
              'email'          =>$teacherEmail,
              'password'       =>bcrypt(str_random(40)),
              'token'          =>str_random(64),
              'birthday'       =>null,
              'activated'      =>true,
            ]);

            $newTeacher->activated=true;
            $teacherSocialData->social_id=$socialObject->id;
            $teacherSocialData->provider=$provider;
            $newTeacher->social()->save($teacherSocialData);
            //$teacherSocialData->teacher()->save();
            $newTeacher->save();
              $socialTeacher=$newTeacher;
          }
          else { //get teacher
            $socialTeacher=$socialId->teacher;

          }
          /*
          *login social teacher here
          */

         Auth::guard('teacher')->login($socialTeacher,false);
          return redirect()->intended(route('teacher.dashboard'));
        }
        else {
          //if we found teacher in teacher table
          /*
          *log in teacher here
          */
          $socialTeacher=$checkTeacher;

          Auth::guard('teacher')->login($socialTeacher,false);
          return redirect()->intended(route('teacher.dashboard'));
        }


    }
}

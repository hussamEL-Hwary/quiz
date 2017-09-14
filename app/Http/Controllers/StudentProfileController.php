<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Student;
use App\StudentProfile;
use Helper;
use Validator;
use Image;
use File;

class StudentProfileController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth:student')->except('show');
    }

    public function getStudentById($id)
    {
      return Student::with('profile')->whereid($id)->firstOrFail();
    }

    public function showEdit()
    {
      try {
        $studentId=Auth::guard('student')->user()->id;
        $user=$this->getStudentById($studentId);
      } catch (Exception $e) {
        abort(404);
      }
      return view('pages.student.editprofile',compact('user'));
    }

    public function profileValidator(array $data)
    {
      return Validator::make($data,[
        'student_image'  => 'sometimes|image|max:6000',
        'address'        => 'max:100',
        'bio'            => 'max:400',
        'education'      => 'max:200',
        'job'            => 'max:100',
      ]);
    }

    public function show($id)
    {
      try {
        $user=$this->getStudentById($id);

      } catch (Exception $e) {
        abort(404);
      }
      return view('pages.student.studentprofile',compact('user'));
    }

    public function updateProfile(Request $request)
    {
      //get loged in teacher
      try {
        $studentId=Auth::guard('student')->user()->id;
        $user=$this->getStudentById($studentId);
      } catch (Exception $e) {
        abort(404);
      }

      //validate data
      $profileValidator=$this->profileValidator($request->all());

      //if data invalid
      if($profileValidator->fails())
      {
        $this->throwValidationException(
          $reques,$profileValidator
        );
        return redirect()->back()->withErrors($profileValidator)->withInput();
      }

      //if it has image
      if($request->hasFile('student_image'))
      {
        $image=$request->file('student_image');
        $fileName='avatar.'.$image->getClientOriginalExtension();
        $publicPath='/images/student/profile/'.$studentId.'/avatar/'.$fileName;
        $savePath=public_path().'/images/student/profile/'.$studentId.'/avatar/';
        File::makeDirectory($savePath,$mode = 0755, $recursive = true, $force = true);
        Image::make($image)->resize(300,300)->save($savePath.$fileName);
        $user->profile->avatar=$publicPath;

      }
      //save user profile data
      $user->profile->address=$request->address;
      $user->profile->education=$request->education;
      $user->profile->job=$request->job;
      $user->profile->bio=$request->bio;
      $user->profile->save();

      //redirect to user profile
      return redirect('student/profile/'.$studentId);
    }

    public function updateAccount(Request $request)
    {
      try {
        $studentId=Auth::guard('student')->user()->id;
        $user=$this->getStudentById($studentId);
      } catch (Exception $e) {
        abort(404);
      }
      $emailCheck=($request->email!='')&&($request->email!=$user->email);
      $validator=Validator::make($request->all(),[
        'firstName'  => 'required|max:20',
        'secondName' => 'required|max:20',
      ]);
      $user->first_name=$request->firstName;
      $user->last_name =$request->secondName;

      if($emailCheck)
      {
        $validator=Validator::make($request->all(),[
          'email' => 'email|max:255|unique:teachers',
        ]);
        $user->email=$request->email;
      }

      if($request->paaword!=''||$request->password_confirmation)
      {
        $validator=Validator::make($request->all(),[
          'password' => 'required|min:6|max:20|confirmed',
          'password_confirmation' => 'required|same:password',
        ]);
        if($request->password!=null)
        $user->password= bcrypt($request->password);
      }
      if($validator->fails())
      {
        $this->throwValidationException(
          $request,$validator
        );

      }
      $user->save();
      return redirect('student/setting');

    }

}

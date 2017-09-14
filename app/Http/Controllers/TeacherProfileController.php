<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Teacher;
use App\TeacherProfile;
use Helper;
use Validator;
use Image;
use File;
class TeacherProfileController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth:teacher')->except('show');
  }

 /**
  *get teacher by id
  *@param $id
  *@return Teacher
  */
  public function getTeacherById($id)
  {
    return Teacher::with('profile')->whereid($id)->firstOrFail();
  }

  /**
  *get data for teacher profile
  *@param TeacherId
  *@return profile page or 404 error
  */
  public function show($id)
  {

    try {

    $user=$this->getTeacherById($id);

    } catch (Exception $e) {
      abort(404);
    }

    return view('pages.teacher.teacherprofile',compact('user'));
  }

  public function showEdit()
  {
    //get teacher
    try {
      $teacherId=Auth::guard('teacher')->user()->id;
      $user=$this->getTeacherById($teacherId);
    } catch (Exception $e) {
      abort(404);
    }

    //return view with data
    return view('pages.teacher.editprofile',compact('user'));
  }

  public function profileValidator(array $data)
  {
    return Validator::make($data,[
      'teacher_image'  => 'sometimes|image|max:6000',
      'address'        => 'max:100',
      'bio'            => 'max:400',
      'education'      => 'max:200',
      'job'            => 'max:100',
    ]);
  }


  public function updateProfile(Request $request)
  {
    //get loged in teacher
    try {
      $teacherId=Auth::guard('teacher')->user()->id;
      $user=$this->getTeacherById($teacherId);
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
    if($request->hasFile('teacher_image'))
    {
      $image=$request->file('teacher_image');
      $fileName='avatar.'.$image->getClientOriginalExtension();
      $publicPath='/images/teacher/profile/'.$teacherId.'/avatar/'.$fileName;
      $savePath=public_path().'/images/teacher/profile/'.$teacherId.'/avatar/';
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
    return redirect('teacher/profile/'.$teacherId);
  }

  public function updateAccount(Request $request)
  {
    try {
      $teacherId=Auth::guard('teacher')->user()->id;
      $user=$this->getTeacherById($teacherId);
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
    return redirect('teacher/setting');

  }

}

@extends('layouts.master')

@section('content')
<form   method="post" action="/student/setting" enctype="multipart/form-data">
  {{csrf_field()}}
  <label>Profile Info</label>
  <br>
  <img src="{{$user->profile->avatar}}" alt="profilePic"/><br>
  change Photo
  <input type="file" name="student_image" value="">
<br>
  Address: <input type="text" id="address" name="address" value="{{$user->profile->address}}">
  <br>
  Bio:<br><textarea name="bio" id="bio" rows="8" cols="80">{{$user->profile->bio}}</textarea> <br>
  Education:<input type="text" id="education" name="education" value="{{$user->profile->education}}"><br>
  Job:<input type="text" id="job" name="job" value="{{$user->profile->job}}"><br>
  <input type="submit" name="updateprofile" value="Update Profile "><br>
</form>

<form class="" action="/student/account" method="post" enctype="multipart/form-data">
  {{csrf_field()}}
<br><br><label>Account Info </label><br>
First Name: <input type="text" name="firstName" value="{{$user->first_name}}"><br>
Second Name: <input type="text" name="secondName" value="{{$user->last_name}}"><br>
Email: <input type="email" name="email" value="{{$user->email}}"><br>
Password:<input type="password" name="password" value=""><br>
Confirm Password <input type="password" name="password_confirmation" value=""><br>
<input type="submit" name="updateaccount" value="Update Account"><br>


</form>

@endsection

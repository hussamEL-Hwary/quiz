@extends('layouts.master')

@section('content')

<h2>Hi, {{Auth::user()->first_name}}</h2>
<br>
<h2>you are logged in as Teacher</h2>
<input type="submit" name="createcat" value="Create category">
<input type="submit" name="createquiz" value="Create quiz">

<br>
<br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br>
@endsection

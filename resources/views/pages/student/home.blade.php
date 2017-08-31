@extends('layouts.master')

@section('content')

<h2>Hi, {{Auth::guard('student')->user()->first_name}}</h2>
<br>
<h2>you are logged in shatra ya Dopa :) </h2>

<br>
<br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br>
@endsection

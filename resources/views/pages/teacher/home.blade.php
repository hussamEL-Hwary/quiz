@extends('layouts.master')

@section('content')

<h2>Hi, {{Auth::user()->first_name}}</h2>
<br>
<h2>you are logged in as Teacher</h2>
<form method="get">
{{ csrf_field() }}

<input type="submit" name="createcat" value="Create category" formaction="{{route('create.category')}}">
<input type="submit" name="createquiz" value="Create quiz">
</form>
<br>
<br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br>
@endsection

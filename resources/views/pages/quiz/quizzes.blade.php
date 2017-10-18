@extends('layouts.master')

@section('content')



<h1 class="text-center cont-head" >Quizzes</h1>
<div class="container">
<div class="row">

@foreach($quizzes as $quiz)
 <div class="col-md-4">
  <a class='cont-link' href="/quiz/{{$quiz->id}}">
  <div class='cont'>
      <h3 class="text-uppercase text-center" >{{$quiz->name}}</h3>
      <span>By {{$quiz->teacher->first_name}}</span>
</div>

  </a>
</div>


  @endforeach
  </div>

</div>



@endsection

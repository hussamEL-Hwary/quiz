@extends('layouts.master')

@section('content')

<section class='profile'>
  <div class='container-fluid'>
    <div class='row'>
      <div class='col-md-3'>
        <div class='information text-center'>
          <img src="{{$user->profile->avatar}}" >
          <ul class='info list-unstyled'>
            <li> {{$user->first_name }}</li>
            <li>{{$user->profile->job}}</li>
            <li>{{$user->profile->education}}</li>
            <li>{{$user->profile->bio}}</li>
            <li></li>
          </ul>
        </div>
      </div>

      <div class='col-md-9'>
        <div class='content'>
          <h2>Hussam's Quizess</h2>
          @foreach($user->quiz as $quiz)
          <div class='col-md-6'>
            <a href='/quiz/{{$quiz->id}}'>
            <div class='box'>
              <ul class='list-unstyled'>
                <li>{{$quiz->name}}</li>
                <li>{{$quiz->category->name}}</li>
                <li class='last'>{{$quiz->qcount}}</li>
              </ul>
            </div>
            </a>
          </div>
          @endforeach

        </div>
      </div>
    </div>
  </div>
</section>


@endsection

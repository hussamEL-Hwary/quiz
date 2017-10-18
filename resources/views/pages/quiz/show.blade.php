@extends('layouts.master')

@section('content')
<div class="container">

  <div class="row">
    <div class="col-4">
      <h1>{{$quiz->name}}</h1>
      <h2>created at {{$quiz->created_at}}</h2>
      <h2>created at  {{$quiz->category->name}}</h2>
      <h2>created by {{$quiz->teacher->first_name}}</h2>
      <h2>there are  {{$quiz->qcount}} questions</h2>
      <form class="" action="#" method="post">
        <button class="btn btn-success" type="button" name="button">take Quiz</button>
      </form>
    </div>
  </div>
</div>
@endsection


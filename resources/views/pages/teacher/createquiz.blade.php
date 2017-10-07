@extends('layouts.master')

@section('content')
<form class="create-quiz" action="/teacher/quiz" method="post">
  <h2>First Step</h2>

  {{csrf_field()}}
  <input class='form-control' type="text" name="name" placeholder="Quiz Name" id="name" required><br>
  @if($errors->has('name'))
  <span class="">
    <strong class='btn btn-danger btn-block'>{{ $errors->first('name') }}</strong>
  </span>
  @endif
  <input class='form-control' type="number" name="count"  placeholder="Number of questions between 1 and 20" required><br>
  @if($errors->has('count'))
  <span class="">
    <strong class='btn btn-danger btn-block'>{{ $errors->first('count') }}</strong>
  </span>
  @endif
  <select class="form-control" name="categoryName">
    @foreach($categories as $category)
    <option value="{{$category->name}}" class="text-uppercase">{{$category->name}}</option>
    @endforeach
  </select>
  @if($errors->has('categoryName'))
  <span class="">
    <strong class='btn btn-danger btn-block'>{{ $errors->first('categoryName') }}</strong>
  </span>
  @endif
  <input type="submit" class='btn btn-primary btn-block' name="quiz" value="Submit and add Questions">
</form>
@endsection

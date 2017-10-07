@extends('layouts.master')

@section('content')

<h1>{{$data['name']}}</h1><br>
<h2>{{$data['categoryName']}}</h2>
<form class="" action="{{route('teacher.save.quiz')}}" method="post">
  {{csrf_field()}}

  @for($i=1;$i<=$data['count'];$i++)
  <br>
<label>Question{{' '.$i}}</label><br> <input type="text" name="question{{$i}}" value="{{ old('question'.$i) }}" /><br><br>
 @if($errors->has('question'.$i))
   <span class="has-error">
     <strong>{{$errors->first('question'.$i)}}</strong>
   </span>
 @endif
<label for="">Select Answer type</label>
<select class="" name="type{{$i}}">
  <option value="tf">True or False</option>
  <option value="multi">multi chose</option>
</select>
@if($errors->has('type'.$i))
  <span class="has-error">
    <strong>{{$errors->first('type'.$i)}}</strong>
  </span>
@endif
<br>
<hr>
<h4>True False Section</h4>
<label for="">the correct answer of question</label>
  <label for="">True</label><input type="radio" name="tf{{$i}}" value="1">
  <label for="">False</label><input type="radio" name="tf{{$i}}" value="0">
<br>
@if($errors->has('tf'.$i))
  <span class="has-error">
    <strong>{{$errors->first('tf'.$i)}}</strong>
  </span>
@endif
<hr>
<h4>Multi Chose Section</h4>
<label for="">Chose 1</label><input type="text" name="answer1{{$i}}" value="{{old('answer1'.$i)}}"><br>
@if($errors->has('answer1'.$i))
  <span class="has-error">
    <strong>{{$errors->first('ans1wer'.$i)}}</strong>
  </span>
@endif
<label for="">Chose 2</label><input type="text" name="answer2{{$i}}" value="{{old('answer2'.$i)}}"><br>
@if($errors->has('answer2'.$i))
  <span class="has-error">
    <strong>{{$errors->first('answer2'.$i)}}</strong>
  </span>
@endif
<label for="">Chose 3</label><input type="text" name="answer3{{$i}}" value="{{old('answer3'.$i)}}"><br>
@if($errors->has('answer3'.$i))
  <span class="has-error">
    <strong>{{$errors->first('answer3'.$i)}}</strong>
  </span>
@endif
<label for="">Chose 4</label><input type="text" name="answer4{{$i}}" value="{{old('answer1'.$i)}}"><br>
@if($errors->has('answer4'.$i))
  <span class="has-error">
    <strong>{{$errors->first('answer4'.$i)}}</strong>
  </span>
@endif
<label for="">Correct one</label><input type="number" name="correctNum{{$i}}" value="{{old('correctNum'.$i)}}" placeholder="between 1 to 4" >
<br><br>
@if($errors->has('correctNum'.$i))
  <span class="has-error">
    <strong>{{$errors->first('correctNum'.$i)}}</strong>
  </span>
@endif
@endfor
  <input type="submit" name="Save" value="save">
</form>
@endsection

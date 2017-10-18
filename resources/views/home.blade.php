@extends('layouts.master')

@section('content')


<section class='teacher-home'>
  <div class='container'>
    <h2 class='text-center'>Categories</h2>


    <div class='row'>

      @foreach($categories as $category)
      <div class='col-sm-6 col-md-4'>
        <a class='link' href= '/category/{{$category['id']}}'>
          <div class='box'>
            <h3 class="text-uppercase" >{{$category['name']}}</h3>
            <p>{{$category['description']}}<p>
          </div>
      </a>
      </div>

      @endforeach


    </div>


  </div>
</section>


@endsection

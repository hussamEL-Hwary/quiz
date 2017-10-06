@extends('layouts.master')

@section('content')


<form class='create-cat'  action="{{route('category.submit')}}" method="post">
  <h2 class='text-center'>Create New Category</h2>

{{ csrf_field() }}
<input type="text" id="categoryname" class='form-control' name="categoryname" placeholder='Category Name'  required>
    @if($errors->has('categoryname'))
        <span class="has-error">
        <strong>{{ $errors->first('categoryname') }}</strong>
        </span>
    @endif
<textarea id="description" class='form-control' name="description" rows="8" cols="80" placeholder="write description to your category"></textarea>
@if($errors->has('description'))
    <span class="has-error">
    <strong>{{ $errors->first('description') }}</strong>
    </span>
@endif

<input class='btn btn-primary btn-block' type="submit" id="createcategory" name="Create" value="Submit">

</form>


@endsection

@extends('layouts.master')

@section('content')

<form  action="{{route('category.submit')}}" method="post">
{{ csrf_field() }}
<label>Category name </label>
<input type="text" id="categoryname" name="categoryname"  required>
<br>
<label>description (optional)</label>
<br>
<textarea id="description" name="description" rows="8" cols="80" placeholder="write description to your category"></textarea>
<br>
<input type="submit" id="createcategory" name="create" value="Submit">

</form>

<br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br>
@endsection

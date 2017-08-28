@extends('layouts.master')


@section('content')
<div class="container0">
	<section id="content">
		<form method="post" action="{{ route('teacher.login.submit') }}">
			{{ csrf_field() }}
			<h1>Teacher Login</h1>
				<div>
				<input type="text" placeholder="Email" required="" id="email" type="email" name="email" value="{{ old('email') }}"/>
			</div>

			<div>
				<input type="password" placeholder="Password" required="" id="password" type="password" name="password" />
			</div>
			<div>
				<input type="submit" value="Log in" /> <br/>
				<label for="rememberme">
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}/> Remember me.
                </label>
				<a href="{{ route('password.request') }}">Lost your password?</a>
				<a href="#">Register</a>

			</div>
		</form><!-- form -->
		<div class="button">
			<h6>Or sign up using the following services :</h6><br/> <br/>
			<a class="twitter" href="#" onclick="myFunction()"></a>
            <a class="facebook" href="{{route('social.login',['provider' => 'facebook','type'=>'teacher'])}}"onclick="myFunction()"></a>
            <a class="google" href="{{route('social.login',['provider' => 'google','type'=>'teacher'])}}" onclick="myFunction()"></a>
            <a class="github" href="{{route('social.login',['provider' => 'github','type'=>'teacher'])}}" onclick="myFunction()"></a>
            <a class="instagram" href="#" onclick="myFunction()"></a>



		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
    <script>
function myFunction() {
    alert(" You should make account !");
}
</script>
    <script src="/js/index.js"></script>
<div>
	<br/>
	<br/>
  <br/>
	<br/>
  <br/>
	<br/>
</div>

@endsection

@extends('layouts.master')

@section('content')
<div class="container0">
	<section id="content">
		<form method="post" action="{{route('student.login.submit')}}">
			{{ csrf_field() }}
			<h1>Student Login</h1>
			<div>
				<input type="text" name="email" placeholder="Email" required="" id="email" />
			</div>
			<div>
				<input type="password" placeholder="Password" name="password" required="" id="password" />
			</div>
			<div>
				<input type="submit" value="Log in" /> <br/>
				<label for="rememberme">
                <input type="checkbox" /> Remember me.
                </label>
				<a href="#">Lost your password?</a>
				<a href="{{ route('register') }}">Register</a>

			</div>
		</form><!-- form -->

		<div class="button">
			<h6>Or sign up using the following services :</h6><br/> <br/>
			<a class="twitter" href="#" onclick="myFunction()"></a>
            <a class="facebook" href="{{route('social.login',['provider' => 'facebook','type'=>'student'])}}" ></a>
            <a class="google" href="{{route('social.login',['provider' => 'google','type'=>'student'])}}" ></a>
            <a class="github" href="{{route('social.login',['provider' => 'github','type'=>'student'])}}" ></a>
            <a class="instagram" href="#" ></a>
		</div><!-- button -->

	</section><!-- content -->
</div><!-- container -->

<div>
	<br/>
	<br/>
  <br/>
	<br/>
  <br/>
	<br/>
</div>

@endsection

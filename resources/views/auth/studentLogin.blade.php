@extends('layouts.master')

@section('content')

<div class="container">

		<form method="post" class="form-group login"  action="{{route('student.login.submit')}}">
			{{ csrf_field() }}
			<h3 class="text-center" >Student Login</h3>

				<input type="email" class="form-control" placeholder="Email" required="" id="email" type="email" name="email" value="{{ old('email') }}"/>
				@if ($errors->has('email'))
        <span class="has-error">
          <strong>{{ $errors->first('email') }}</strong>
        </span>
    		@endif

				<input type="password" class="form-control"  placeholder="Password" required="" id="password" type="password" name="password" />
					@if ($errors->has('password'))
        		<span class="has-error">
        		<strong>{{ $errors->first('password') }}</strong>
        		</span>
      		@endif

				<input type="submit" class="btn btn-primary btn-block" value="Log in" />
				<div class="checkbox">
				<label for="rememberme">
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}/> Remember me.
        </label>
					</div>

				<a href="{{ route('student.password.request') }}">Lost your password?</a>
				<label for="">or</label>
				<a href="{{ route('register') }}">Register</a>


		</form><!-- form -->

			<hr>
			<h5 class='text-center'>Or sign up using the following services :</h5><br/>
			<div class="icons text-center">

            <a  class="btn btn-primary x" href="{{route('social.login',['provider' => 'facebook','type'=>'student'])}}"><i class='fa fa-facebook fa-lg'></i></a>
            <a class="btn btn-primary"    href="{{route('social.login',['provider' => 'google','type'=>'student'])}}" ><i class='fa fa-google-plus fa-lg'></i></a>
            <a class="btn btn-primary z"  href="{{route('social.login',['provider' => 'github','type'=>'student'])}}"><i class='fa fa-github fa-lg'></i></a>

			</div>
</div><!-- container -->





@endsection

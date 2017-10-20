@extends('layouts.master')

@section('content')
<div class="container register">


<form class='registiration' method='POST' action="{{route('register.submit')}}">
  {{ csrf_field() }}
  <h2 class='text-center'>Create New Account</h2>
  <div class='form-group'>
    <input class='form-control' type='text' id="first_name" name='first_name' placeholder='First Name' required title="2 characters minimum" pattern=".{2,}" value="{{ old('first_name') }}" autocomplete="off">
  </div>
  <div class='form-group'>
    <input class='form-control' type='text' id="last_name" name='last_name' placeholder='Last Name' pattern=".{2,}" value="{{ old('last_name') }}" required title="2 characters minimum" autocomplete="off">
  </div>
  <div class='form-group'>
    <input class='form-control' type='email'  id="email" name='email' placeholder='Email' value="{{ old('email') }}" required autocomplete="off">
  </div>
  @if ($errors->has('email'))
    <span class="error">
        <strong>{{ $errors->first('email') }}</strong>
    </span>
 @endif
  <div class='form-group'>
    <input class='form-control' type='password' id="password" name='password' placeholder='Password' required autocomplete="off">
  </div>
  <div class='form-group'>
    <input class='form-control' type='password' id="password-confirm" name="password_confirmation" placeholder="Confirm Password" required autocomplete="off">
  </div>

  @if ($errors->has('password'))
    <span class="error">
        <strong>{{ $errors->first('password') }}</strong>
    </span>
 @endif

  <div class='form-group'>
    <input class='form-control' type='date' name='date' placeholder='Date' value="{{old('date')}}" required autocomplete="off">
  </div>
  <div class="form-group text-center">
    <label class='head'>Gender: </label>
    <input type="radio"  name="gender" value="male" id="gender-male"/>
    <label for="gender-male">Male</label>
    <input type="radio" name="gender" value="female" id="gender-female"/>
    <label for="gender-female">Female</label>
  </div>

  @if ($errors->has('gender'))
    <span class="error">
        <strong>{{ $errors->first('gender') }}</strong>
    </span>
 @endif

  <div class="form-group text-center">
    <label class='head'>Sign Up As: </label>
    <input type="radio" name="type" value="teacher" id="teacher" unchecked/>
    <label for="teacher">Teacher</label>
    <input type="radio" name="type" value="student" id="student" unchecked/>
    <label for="student">Student</label>
 </div>

 <div>

     {!! app('captcha')->display() !!}

 </div>

<input class='btn btn-success btn-block' type="submit" value="Sign Up " id="sign-up" onclick="check()"/>
</form>


  <!--
  <form method="post" action="{{route('register.submit')}}">
    {{ csrf_field() }}

    <div class="row">
      <h4>Create new account</h4>
      <div class="input-group input-group-icon">
        <input type="text" id="first_name" name="first_name" placeholder="First Name"   pattern=".{2,}" value="{{ old('first_name') }}"  required title="2 characters minimum"  />
        <div class="input-icon"><i class="fa fa-user"></i></div>
      </div>
      <div class="input-group input-group-icon">
        <input type="text" id="last_name" name="last_name" placeholder="Last Name"   pattern=".{2,}" value="{{ old('last_name') }}"  required title="2 characters minimum"/>
        <div class="input-icon"><i class="fa fa-user"></i></div>
      </div>
      <div class="input-group input-group-icon">
        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Email Adress" required/>
        <div class="input-icon"><i class="fa fa-envelope"></i></div>
      </div>
      @if ($errors->has('email'))
        <span class="">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
     @endif
      <div class="input-group input-group-icon">
        <input type="password" id="password"  name="password"  placeholder="Password" required/>
        <div class="input-icon"><i class="fa fa-key"></i></div>
      </div>
      <div class="input-group input-group-icon">
        <input type="password" id="password-confirm" name="password_confirmation" placeholder="Confirm Password" required/>
        <div class="input-icon"><i class="fa fa-key"></i></div>
      </div>
    </div>
    <div class="row">
      <div class="col-half">
        <h4>Date of Birth</h4>
        <div class="input-group">
          <div class="col-third">
            <input type="text" id="day" name="day" value="{{ old('day') }}" placeholder="DD" required/>
          </div>
          <div class="col-third">
            <input type="text" id="month" name="month" value="{{ old('month') }}" placeholder="MM" required/>
          </div>
          <div class="col-third">
            <input type="text" id="year" name="year" value="{{ old('year') }}" placeholder="YYYY" required/>
          </div>
        </div>
        @if ($errors->has('day'))
          <span class="">
              <strong>{{ $errors->first('day') }}</strong>
          </span>
       @endif
       @if ($errors->has('month'))
         <span class="help-block">
             <strong>{{ $errors->first('month') }}</strong>
         </span>
      @endif
      @if ($errors->has('year'))
        <span class="">
            <strong>{{ $errors->first('year') }}</strong>
        </span>
     @endif
        <div>
         <h4> Nickname</h4>
       <input type="text" id="nickname" name="nickname" placeholder="Nickname" >
        </div>


      </div>
      <div class="col-half">
        <h4>Gender</h4>
        <div class="input-group">
          <input type="radio"  name="gender" value="male" id="gender-male"/>
          <label for="gender-male">Male</label>
          <input type="radio" name="gender" value="female" id="gender-female"/>
          <label for="gender-female">Female</label>
        </div>
        @if ($errors->has('gender'))
          <span class="">
              <strong>{{ $errors->first('gender') }}</strong>
          </span>
       @endif
        <h4>Sign Up As </h4>
        <div class="input-group">
          <input type="radio" name="type" value="teacher" id="teacher" unchecked/>
          <label for="teacher">Teacher</label>
          <input type="radio" name="type" value="student" id="student" unchecked/>
          <label for="student">Student</label>
       </div>
      </div>
      <div>

        <div>

            {!! app('captcha')->display() !!}

        </div>

      <input type="submit" value="Sign Up " id="sign-up" onclick="check()"/>
           </div>
           <p id="demo"></p>

        <script>
function check() {

    var x = document.getElementById("teacher").checked;
    var y = document.getElementById("student").checked;

    if(!x && !y)
    alert("You Should select how you want to Sign up As !! ");

    }
</script>



      </div>

    </div>

    </form>
  -->
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

   <script src="/js/index.js"></script>
 <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
</div>
<div> <br/> <br/><br/><br/><br/></div>


@endsection

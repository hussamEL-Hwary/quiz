@extends('layouts.master')

@section('content')
<div class="container">
<section id="content">
<form action="">
 <h1>Login Form</h1>
 <div>
   <input type="text" placeholder="Username" required="" id="username" />
 </div>
 <div>
   <input type="password" placeholder="Password" required="" id="password" />
 </div>
 <div>
   <input type="submit" value="Log in" /> <br/>
   <label for="rememberme">
           <input type="checkbox" /> Remember me.
           </label>
   <a href="#">Lost your password?</a>
   <a href="#">Register</a>

 </div>
</form><!-- form -->
<div class="button">
 <h6>Or sign up using the following services :</h6><br/> <br/>
 <a class="twitter" href="#"></a>
       <a class="facebook" href="#"></a>
       <a class="google" href="#"></a>
       <a class="github" href="#"></a>
       <a class="instagram" href="#"></a>



</div><!-- button -->
</section><!-- content -->
</div><!-- container -->
@endsection

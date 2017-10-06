		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
			    <span class="icon-bar"></span>
			    <span class="icon-bar"></span>
			    <span class="icon-bar"></span>
			  </button>

			</div>

			@if (Auth::guard('student')->guest() and Auth::guard('teacher')->guest() )
			<a class="navbar-header navbar-brand" href="/">Quiz App</a>
			<div class="collapse navbar-collapse" id="myNavbar">
			  <ul class="nav navbar-nav navbar-right">
			    <li><a class='reg' href="#">Register</a></li>
					<li class='dropdown'>
						<a href='#' class='dropdown-toggle element log' data-toggle='dropdown' role='button' aria-haspopup="true"
						aria-expanded='false'>Login As <span class='caret'></span></a>
						<ul class='dropdown-menu'>
							<li><a class='student' href='#'> Student </a></li>
							<li><a class='teacher' href='#'> Teacher </a></li>
						</ul>
					</li>
			  </ul>
			</div>

			<!-- student nav bar-->
			@elseif (Auth::guard('student')->user())
			<a class="navbar-header navbar-brand" href="/">Quiz App</a>
			<div class="collapse navbar-collapse" id="myNavbar">
			  <ul class="nav navbar-nav navbar-right">
					<li class='dropdown'>
						<a href='#' class='dropdown-toggle element' data-toggle='dropdown' role='button' aria-haspopup="true"
						aria-expanded='false'><img src='{{Auth::guard('student')->User()->profile->avatar}}' alt='profile-img'> Ahmed <span class='caret'></span></a>
						<ul class='dropdown-menu'>
							<li><a href='#'> Profile </a></li>
							<li><a href='#'> Settings </a></li>
							<li><a href='#'> Teacher </a></li>
							<li><a href='#'> Logout </a></li>
						</ul>
					</li>
			  </ul>
			</div>

       <!-- teacher nav bar-->

			@elseif (Auth::guard('teacher')->user())
			<a class="navbar-header navbar-brand" href="/teacher">Quiz App</a>
			<div class="collapse navbar-collapse" id="myNavbar">
			  <ul class="nav navbar-nav navbar-right">
					<li><a href='{{route('create.category')}}'>Create Category</a></li>
					<li><a href='/teacher/quiz'>Create Quiz</a></li>
					<li class='dropdown'>
						<a href='#' class='dropdown-toggle element' data-toggle='dropdown' role='button' aria-haspopup="true"
						aria-expanded='false'><img src='{{Auth::guard('teacher')->User()->profile->avatar}}' alt='profile-img'> {{Auth::guard('teacher')->User()->first_name}}<span class='caret'></span></a>
						<ul class='dropdown-menu'>
							<li><a href='/teacher/profile/{{Auth::guard('teacher')->user()->id}}'>
								<span class="icon"><i class="fa fa-fw fa-user-circle-o"></i></span>
								 Profile </a></li>
							<li><a href='/teacher/setting'>
								<span class="icon"><i class="fa fa-fw fa-cog"></i></span>
								 Settings </a></li>

							<li><a href='/student'>
								<span class="icon"><i class="fa fa-fw fa-arrow-circle-o-up"></i></span>
								 Student </a></li>
								 <li><hr></li>
								 <li><a href='/teacher/logout'>
	 								<span class="icon"><i class="fa fa-fw fa-sign-out"></i></span>
	 								 Logout </a></li>

						</ul>
					</li>
			  </ul>
			</div>

			@endif

		  </div>
		</nav>

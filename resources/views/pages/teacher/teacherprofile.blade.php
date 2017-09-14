@extends('layouts.master')

@section('content')

<div class="header">
            <div class="container">
                <div class="name">
                    <h1>
                    </h1>
                    <p>{{ $user['job']}}</p>
                </div>
                <div class="links">
                    <a href="https://facebook.com">
                        <img src="/images/1.ico">
                    </a>
                    <a href="https://twitter.com">
                        <img src="/images/2.ico">
                    </a>
                    <a href="https://google.com">
                        <img src="/images/3.ico">
                    </a>
                    <a href="https://linkedin.com">
                        <img src="/images/4.ico">
                    </a>
                </div>
            </div>
        </div>

        <!-- Start Prifile -->

        <div class="container">
            <div class="profile">
                <img src="{{$user->profile->avatar}}">
                <div class="name1">
                    <h3></h3>
                </div>
                <div class="about">
                    <hr>
                    <br>
                    <div>
                        <span>Birthday</span>
                        <label></label>
                    </div>
                    <div>
                        <span>Address</span>
                        <label>{{ $user['address'] }}</label>
                    </div>
                    <div>
                        <span>EMail</span>
                        <label></label>
                    </div>
                    <div>
                        <span>Phone</span>
                        <label>{{$user->profile->job}}</label>
                    </div>
                    <div>
                        <span>Website</span>
                        <label><a href="https://www.facebook.com/ahmedelgendyfci">ِAhmed M. Elgendy</a></label>
                    </div>
                </div>
                <div class="footer">

                    <a class="ll" href="https://facebook.com">
                        <img src="/images/1.ico">
                    </a>
                    <a href="https://twitter.com">
                        <img src="/images/2.ico">
                    </a>
                    <a href="https://google.com">
                        <img src="/images/3.ico">
                    </a>

                    <a href="https://linkedin.com">
                        <img src="/images/4.ico">
                    </a>

                </div>
                <button>Edite Your Profile</button>
            </div>
        </div>

        <!-- End Profile -->
        <!-- Start Bio -->
        <div class="container">
            <div class="bio">
                <h4>Bio</h4>
                <p>{{ $user['bio'] }}</p>
            </div>
        </div>
        <!-- End Bio -->
        <!-- Start Education -->

        <div class="container">
            <div class="edu">
                <h4>Education</h4>
                <p>{{$user['education']}}</p>
            </div>
         </div>
         <!-- End Education -->

         <div class="container">
            <div class="quiz">
                <h4>Quizzes</h4>

                <div class="first">
                    <h3>
                        <a href="#">C++ Algorithms</a>
                    </h3>
                    <p>I Studied At Faculty Of Computer And Information, Cairo University</p>
                </div>
                <div class="second">
                        <h3>
                            <a href="#">C++ Algorithms</a>
                        </h3>
                        <p>I Studied At Faculty Of Computer And Information, Cairo University</p>
                </div>

            </div>
        </div>
        <!---------------------------------------------->


@endsection

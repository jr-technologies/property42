@extends('registration.auth')

@section('content')
<div class="container">
    <div class="login-registarHolder">
        <ul class="tabset">
            <li class="active"><a href="{{url('/login')}}">login</a></li>
            <li><a href="{{url('/register')}}">become a free member</a></li>
        </ul>
        <div class="tab-content">
            <div id="tab1">
                <form class="login-form" action="{{route('login')}}" method="post">
                    <div class="input-holder error">
                        <label class="icon-envelope" for="email"></label>
                        <input type="email" placeholder="Enter Your Email Address" id="email" required>
                        <span class="border"></span>
                        <span class="error-text">This is error</span>
                    </div>
                    <div class="input-holder error">
                        <label class="icon-key" for="pass"></label>
                        <input type="password" placeholder="Enter Your Password" id="pass" required>
                        <span class="border"></span>
                        <span class="error-text">This is error</span>
                        <a href="#" class="forgot-pass"><span class="icon-notification"></span> Forgot Password</a>
                    </div>
                    <button type="submit">Login <span class="icon-login"></span></button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
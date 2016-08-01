@extends('frontend.v2.frontend')
@section('content')
    <nav id="nav">
        <div class="nav-holder">
            <a href="#" class="navigation-toggler close"><span class="icon-cross"></span></a>
            <ul class="main-navigation text-upparcase">
                <li>
                    <a href="{{URL::to('/')}}"><span class="middle-align"><span class="icon-home"></span>HOME</span></a>
                </li>
                <li class="active">
                    <a href="{{URL::to('/')}}/search"><span class="middle-align"><span class="icon-d-building"></span>Properties</span></a>
                </li>
                <li>
                    <a href="{{URL::to('agents')}}"><span class="middle-align"><span
                                    class="icon-male-close-up-silhouette-with-tie"></span>AGENTS</span></a>
                </li>
                <li>
                    <a href="#"><span class="middle-align"><span class="icon-street-map"></span>MAPS</span></a>
                </li>
                <li>
                    <a href="#"><span class="middle-align"><span class="icon-light-bulb"></span>ABOUT</span></a>
                </li>
                <li>
                    <a href="#"><span class="middle-align"><span class="icon-close-envelope"></span>CONTACT</span></a>
                </li>
            </ul>
            <div class="mobile-content text-center hidden">
                <ul class="social-icons">
                    <li><a href="https://www.facebook.com/property42pk-1562646287317094/"><span
                                    class="icon-facebook"></span></a></li>
                    {{--<li><a href="#"><span class="icon-google-plus-symbol"></span></a></li>--}}
                    {{--<li><a href="#"><span class="icon-linkedin"></span></a></li>--}}
                    <li><a href="https://twitter.com/Property42_pk"><span class="icon-twitter"></span></a></li>
                </ul>
                <span class="copyright">Copyright, <a href="#">Property42.pk</a></span>
            </div>
        </div>
    </nav>
    </div>
    <?php
    if(\Session::has('validationErrors')){
        $validationErrors = \Session::get('validationErrors');
    }
    ?>
   <main id="main" role="main">
        <div class="page-holder">
            <div class="login-page container">
                @if(\Session::has('success'))<span class="global-success">{{ \Session::get('success') }}</span>@endif
                    @if(\Session::has('errors'))
                        <span class="global-error"> @foreach(\Session::get('errors') as $error) {{$error}}<br> @endforeach
                    </span>
                    @endif
                <form class="login-form" action="{{route('login')}}" method="post">
                    <h1>Log<span>in</span></h1>
                    <div class="layout">
                        <label for="login-email">E-mail ID</label>
                        <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('email')) error @endif">
                            <input name="email" type="email" value="{{old('email')}}" placeholder="Enter Your Email Address" id="email" required>
                            <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('email')) {{$validationErrors->first('email')}} @endif</span>
                        </div>
                    </div>
                    <div class="layout">
                        <label for="login-pass">Password</label>
                        <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('password')) error @endif">
                            <input name="password" type="password" value="{{old('password')}}" placeholder="Enter Your Password" id="pass" required>
                            <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('password')) {{$validationErrors->first('password')}} @endif</span>
                            <a href="#forgot-pass" class="forgot-pass lightbox">Forgot Password ?</a>
                        </div>
                    </div>
                    <ul class="buttons-holder text-upparcase">
                        <li>
                            <a href="{{url('/register')}}">REGISTER NOW</a>
                        </li>
                        <li>
                            <button type="submit">LOGIN<span class="icon-login"></span></button>
                        </li>
                    </ul>
                </form>
                <div class="popup-holder">
                    <div class="popup lightbox generic-lightbox" id="forgot-pass">
                        {{ Form::open(array('url' => 'get-new-password','method' => 'POST' ,'class'=>'forgot-form')) }}

                            <h1>Forgot <span>Password</span></h1>
                            <p>Enter your email address below and we will send you a new password.</p>
                            <div class="layout">
                                <label for="forgot-email">E-mail ID</label>
                                <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('email')) error @endif">
                                    <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('email')) {{$validationErrors->first('email')}} @endif</span>
                                    <input type="email" name="email" placeholder="Enter Your Email Address" id="email">

                                </div>
                            </div>
                            <ul class="buttons-holder text-upparcase text-center">
                                <li>
                                    <button type="submit">SEND</button>
                                </li>
                            </ul>
                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@extends('frontend.v2.frontend')
@section('content')
<div class="login-page container">
    <span class="global-success">You are SUCCESSFULLY Registered</span>
    <span class="global-error">this is error</span>
    <form class="login-form">
        <h1>Log<span>in</span></h1>
        <div class="layout">
            <label for="login-email">E-mail ID</label>
            <div class="input-holder"><input type="email" id="login-email" placeholder="Enter the email"></div>
        </div>
        <div class="layout">
            <label for="login-pass">Password</label>
            <div class="input-holder">
                <input type="email" id="login-pass" placeholder="Enter the password">
                <a href="#forgot-pass" class="forgot-pass lightbox">Forgot Password</a>
            </div>
        </div>
        <ul class="buttons-holder text-upparcase">
            <li>
                <a href="#">REGISTER NOW</a>
            </li>
            <li>
                <button type="submit">LOGIN<span class="icon-login"></span></button>
            </li>
        </ul>
    </form>
    <div class="popup-holder">
        <div class="popup lightbox generic-lightbox" id="forgot-pass">
            <form class="forgot-form">
                <h1>Forgot <span>Password</span></h1>
                <p>Enter your email address below and we will send you a new password.</p>
                <div class="layout">
                    <label for="forgot-email">E-mail ID</label>
                    <div class="input-holder"><input type="email" id="forgot-email" placeholder="Enter the email"></div>
                </div>
                <ul class="buttons-holder text-upparcase text-center">
                    <li>
                        <button type="submit">SEND</button>
                    </li>
                </ul>
            </form>
        </div>
    </div>
</div>
@endsection
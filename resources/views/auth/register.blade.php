@extends('auth.auth')

@section('content')
<div class="container">
    <div class="login-registarHolder">
        <?php
        if(\Session::has('validationErrors')){
            $validationErrors = \Session::get('validationErrors');
        }
        ?>
        <ul class="tabset">
            <li class=""><a href="{{url('/login')}}">login</a></li>
            <li class="active"><a href="{{url('/register')}}">become a free member</a></li>
        </ul>
        <div class="tab-content">
            <div id="tab2">
                @if(\Session::has('success'))
                    {{\Session::get('success')}}
                @endif
                @if(\Session::has('errors'))
                        <span style="color:red;">{{\Session::get('errors')}}</span>
                @endif
                <form class="registration-form" method="post" action="{{route('register')}}" enctype="multipart/form-data">
                    <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('fName')) error @endif">
                        <label class="icon-user" for="fName"></label>
                        <input type="text" placeholder="Enter Your First Name" name="fName" id="fName" >
                        <span class="border"></span>
                        <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('fName')) {{$validationErrors->first('fName')}} @endif</span>
                    </div>
                    <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('lName')) error @endif">
                        <label class="icon-user" for="lName"></label>
                        <input type="text" placeholder="Enter Your Last Name" name="lName" id="lName" >
                        <span class="border"></span>
                        <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('lName')) {{$validationErrors->first('lName')}} @endif</span>
                    </div>
                    <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('password')) error @endif">
                        <label class="icon-key" for="pass1"></label>
                        <input type="password" placeholder="Enter Your Password" id="pass1" name="password" >
                        <span class="border"></span>
                        <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('password')) {{$validationErrors->first('password')}} @endif</span>
                    </div>
                    <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('passwordAgain')) error @endif">
                        <label class="icon-key" for="cpass"></label>
                        <input type="password"  placeholder="Confirm Password" name="passwordAgain" id="cpass" >
                        <span class="border"></span>
                        <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('passwordAgain')) {{$validationErrors->first('passwordAgain')}} @endif</span>
                    </div>
                    <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('email')) error @endif">
                        <label class="icon-envelope" for="email1"></label>
                        <input type="email" placeholder="Enter Your Email Address" id="email1" name="email" >
                        <span class="border"></span>
                        <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('email')) {{$validationErrors->first('email')}} @endif</span>
                    </div>
                    <h1>Contact Information</h1>
                    <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('phone')) error @endif">
                        <label class="icon-phone" for="phone"></label>
                        <input type="tel" placeholder="Enter Your Phone Number" name="phone" id="phone" >
                        <span class="border"></span>
                        <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('phone')) {{$validationErrors->first('phone')}} @endif</span>
                    </div>
                    <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('mobile')) error @endif">
                        <label class="icon-phone_iphone" for="cell"></label>
                        <input type="tel" placeholder="Enter Your Cell / Mobile Number" name="mobile" id="cell" >
                        <span class="border"></span>
                        <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('mobile')) {{$validationErrors->first('mobile')}} @endif</span>
                    </div>
                    <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('fax')) error @endif">
                        <label class="icon-fax" for="fax"></label>
                        <input type="tel" placeholder="Enter Fax Details" name="fax" id="fax" >
                        <span class="border"></span>
                        <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('fax')) {{$validationErrors->first('fax')}} @endif</span>
                    </div>
                    <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('address')) error @endif">
                        <label class="icon-directions" for="address"></label>
                        <input type="text" placeholder="Enter Your Address" name="address" id="address" >
                        <span class="border"></span>
                        <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('address')) {{$validationErrors->first('address')}} @endif</span>
                    </div>
                    <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('zipCode')) error @endif">
                        <label class="icon-file-zip" for="zip"></label>
                        <input type="text" placeholder="Enter Zip Code" name="zipCode" id="zip">
                        <span class="border"></span>
                        <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('zipCode')) {{$validationErrors->first('zipCode')}} @endif</span>
                    </div>
                    <div class="input-holder">
                        <label for="agent" class="agent-check">
                            <input type="checkbox" class="hidden-checkfield agent-brokerCheckbox" id="agent">
										<span class="fake-checkbox">
											<span class="fake-button"></span>
										</span>
                            <span class="fake-label">Are you an Agent</span>
                        </label>
                    </div>
                    <div class="input-holder full-width @if(isset($validationErrors) && $validationErrors->has('userRoles')) error @endif">
                        <div class="roles">
                            <a class="role-opener">Other Roles:</a>
                            <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('userRoles')) {{$validationErrors->first('userRoles')}} @endif</span>
                            <ul class="role-listing">
                                @foreach($response['roles'] as $role)
                                    <li>
                                        <input type="checkbox" id="role_{{$role->id}}" class="userRole-checkbox @if($role->id == 3) agent-brokerCheckbox @endif;" name="userRoles[]" value="{{$role->id}}">
                                        <label for="role_{{$role->id}}">{{$role->name}}</label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="agent-information">
                        <h1>Agency Information</h1>
                        <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('agencyName')) error @endif">
                            <label for="agency-name" class="icon-agency"></label>
                            <input type="text" placeholder="Enter An Agency Name" id="agency-name" name="agencyName" >
                            <span class="border"></span>
                            <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('agencyName')) {{$validationErrors->first('agencyName')}} @endif</span>
                        </div>
                        <div class="input-holder onTop-mobile">
                            <div class="company-logo">
                                <input type="file" name="companyLogo" onchange="companyLogoUploader(this , '.company-profileP')">
                                <div class="picture-holder"><img src="" class="company-profileP" alt="Company logo"></div>
                                <a class="delete"><span class="icon-bin"></span></a>
                                <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('companyLogo')) {{$validationErrors->first('companyLogo')}} @endif</span>
                            </div>
                        </div>
                        <div class="input-holder full-width @if(isset($validationErrors) && $validationErrors->has('agencyDescription')) error @endif">
                            <label for="D-services" class="icon-technical-support"></label>
                            <textarea id="D-services" name="agencyDescription" placeholder="Description of Services"></textarea>
                            <span class="border"></span>
                            <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('agencyDescription')) {{$validationErrors->first('agencyDescription')}} @endif</span>
                        </div>
                        <h1> Agency Contact Details</h1>
                        <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('companyPhone')) error @endif">
                            <label for="compny-phone" class="icon-phone"></label>
                            <input type="tel" placeholder="Enter Company Phone Number" name="companyPhone" id="compny-phone" >
                            <span class="border"></span>
                            <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('companyPhone')) {{$validationErrors->first('companyPhone')}} @endif</span>
                        </div>
                        <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('companyMobile')) error @endif">
                            <label for="compny-mobile" class="icon-phone_iphone"></label>
                            <input type="tel" placeholder="Enter Company Mobile Number" name="companyMobile" id="compny-mobile" >
                            <span class="border"></span>
                            <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('companyMobile')) {{$validationErrors->first('companyMobile')}} @endif</span>
                        </div>
                        <div class="input-holder full-width @if(isset($validationErrors) && $validationErrors->has('companyAddress')) error @endif">
                            <label for="compny-address" class="icon-directions"></label>
                            <input type="text" placeholder="Enter Company Address" name="companyAddress" id="compny-address" >
                            <span class="border"></span>
                            <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('companyAddress')) {{$validationErrors->first('companyAddress')}} @endif</span>
                        </div>
                        <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('companyEmail')) error @endif">
                            <label for="compny-email" class="icon-envelope"></label>
                            <input type="email" placeholder="Enter Company Email" name="companyEmail" id="compny-email" >
                            <span class="border"></span>
                            <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('companyEmail')) {{$validationErrors->first('companyEmail')}} @endif</span>
                        </div>
                    </div>
                    <div class="input-holder full-width @if(isset($validationErrors) && $validationErrors->has('termsConditions')) error @endif">
                        <ul class="terms-listing">
                            <li>
                                <input type="checkbox" id="terms-Cond" name="termsConditions" value="1">
                                <label for="terms-Cond">I have read and agree to Property42.pk <a href="#">Terms and Conditions</a> <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('termsConditions')) {{$validationErrors->first('termsConditions')}} @endif</span></label>
                            </li>
                            <li>
                                <input type="checkbox" id="newslatter" name="wantNotifications">
                                <label for="newslatter">I  want to receive notifications for promotions, newsletters and website updates.</label>
                            </li>
                        </ul>
                    </div>
                    <div class="input-holder full-width">
                        <button type="submit">Sign me up !!</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
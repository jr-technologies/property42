@extends('frontend.v2.frontend')
@section('content')
    <div class="registerNow container">
        <?php
            if(\Session::has('validationErrors')){
                $validationErrors = \Session::get('validationErrors');
            }
        ?>
        <form class="registration-form" method="post" action="{{route('register')}}" enctype="multipart/form-data">
            <h1>Register <span>Now</span></h1>
            <div class="layout">
                <div class="layout-holder">
                    <label for="f-name">First Name</label>
                    <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('fName')) error @endif">
                        <input type="text" placeholder="Enter Your First Name" name="fName" id="fName" value="{{old('fName')}}" required>
                        <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('fName')) {{$validationErrors->first('fName')}} @endif</span>
                    </div>
                </div>
                <div class="layout-holder">
                    <label for="l-name">Last Name</label>
                    <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('lName')) error @endif">
                        <input type="text" id="l-name" placeholder="Last Name">
                        <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('lName')) {{$validationErrors->first('lName')}} @endif</span>
                    </div>
                </div>
                <div class="layout-holder">
                    <label for="email">Email</label>
                    <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('email')) error @endif">
                        <input type="email" id="email" placeholder="Email">
                        <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('email')) {{$validationErrors->first('email')}} @endif</span>
                    </div>
                </div>
            </div>
            <div class="layout">
                <div class="layout-holder">
                    <label for="pass">Password</label>
                    <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('password')) error @endif">
                        <input type="password" id="pass" placeholder="Password">
                        <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('password')) {{$validationErrors->first('password')}} @endif</span>
                    </div>
                </div>
                <div class="layout-holder">
                    <label for="re-pass">Re-Enter Password</label>
                    <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('passwordAgain')) error @endif">
                        <input type="password" id="re-pass" placeholder="Re-Enter Password">
                        <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('passwordAgain')) {{$validationErrors->first('passwordAgain')}} @endif</span>
                    </div>
                </div>
            </div>
            <strong class="registerNow-heading"><span>Contact Information</span></strong>
            <div class="layout two">
                <div class="layout-holder">
                    <label for="address">Address</label>
                    <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('address')) error @endif">
                        <input type="text" id="address" placeholder="Address">
                        <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('address')) {{$validationErrors->first('address')}} @endif</span>
                    </div>
                </div>
                <div class="layout-holder">
                    <label for="m-number">Mobile Number</label>
                    <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('mobile')) error @endif">
                        <input type="tel" id="m-number" placeholder="Mobile Number">
                        <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('mobile')) {{$validationErrors->first('mobile')}} @endif</span>
                    </div>
                </div>
            </div>
            <div class="layout two">
                <div class="layout-holder">
                    <label for="address">Other Roles</label>
                    <div class="input-holder">
                        <a class="role-opener">0 Selected</a>
                        <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('userRoles')) {{$validationErrors->first('userRoles')}} @endif</span>
                    </div>
                </div>
                <div class="layout-holder">
                    <label for="p-number">Phone Number</label>
                    <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('phone')) error @endif">
                        <input type="tel" id="p-number" placeholder="Phone Number">
                        <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('phone')) {{$validationErrors->first('phone')}} @endif</span>
                    </div>
                </div>
            </div>
            <ul class="role-listing">
                @foreach($response['roles'] as $role)
                    <li>
                        <label for="role_{{$role->id}}" class="customCheckbox">
                            <input type="checkbox" id="role_{{$role->id}}" class="userRole-checkbox @if($role->id == 3) agent-brokerCheckbox @endif;" name="userRoles[]" value="{{$role->id}}" @if(in_array($role->id,(old('userRoles') !=null)?old('userRoles'):[])) checked @endif>
                            <span class="fake-checkbox"></span>
                            <span class="fake-label">{{$role->name}}</span>
                        </label>
                    </li>
                @endforeach
            </ul>
            <strong class="registerNow-heading smaller">
            <span>
                Are you an Agent ? <b>Yes</b>
                <label for="agent" class="agent-check">
                    <input type="checkbox" class="hidden-checkfield agent-brokerCheckbox" id="agent">
                    <span class="fake-checkbox">
                        <span class="fake-button"></span>
                    </span>
                </label>
                <b>No</b>
            </span>
            </strong>
            <div class="agent-information">
                <strong class="registerNow-heading">Agent Information</strong>
                <div class="layout two first-small">
                    <div class="layout-holder">
                        <div class="company-logo">
                            <input type="file" id="c-logo" name="companyLogo" onchange="companyLogoUploader(this , '.company-profileP')">
                            <span class="name-tag">Add Company Logo</span>
                            <div class="logo-holder">
                                <label for="c-logo"><span class="icon-plus-square"></span></label>
                                <div class="picture-holder">
                                    <img src="" class="company-profileP" alt="Company logo">
                                    <a class="company-logo-delete"><span class="icon-cross"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="layout-holder">
                        <div class="full-width">
                            <label for="agencyName">Agency Name</label>
                            <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('agencyName')) error @endif">
                                <input type="text" id="agencyName" name="agencyName"  placeholder="Agency Name">
                                <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('agencyName')) {{$validationErrors->first('agencyName')}} @endif</span>
                            </div>
                        </div>
                        <div class="full-width">
                            <label for="D-services">Agency Description</label>
                            <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('agencyDescription')) error @endif">
                                <textarea id="D-services" name="agencyDescription" placeholder="Description of Services"></textarea>
                                <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('agencyDescription')) {{$validationErrors->first('agencyDescription')}} @endif</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="layout two first-small">
                    <div class="layout-holder">
                        <label for="selectSociety">Filter Socities You Deal In</label>
                        <div class="input-holder  @if(isset($validationErrors) && $validationErrors->has('societies')) error @endif">
                            <input type="text" placeholder="Select Societies You Deal In" id="search-society" name="SelectDealSociety" required>
                            <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('societies')) {{$validationErrors->first('societies')}} @endif</span>
                        </div>
                    </div>
                    <div class="layout-holder">
                        <ul class="packetData-list">

                        </ul>
                    </div>
                </div>
                <div class="input-holder full-width">
                    <ul class="societiesBlock-listing">
                        @foreach($response['societies'] as $society)
                            <li>
                                <label for="society{{$society->id}}" class="customCheckbox">
                                    <input type="checkbox" id="society{{$society->id}}" class="selectSociety-checkbox" name="societies[]" value="{{$society->id}}"
                                           @if(in_array($society->id,(old('societies') !=null)?old('societies'):[])) checked @endif>
                                    <span class="fake-checkbox"></span>
                                    <span class="fake-label">{{$society->name}}</span>
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <strong class="registerNow-heading">Agency Contact Details</strong>
                <div class="layout">
                    <div class="layout-holder">
                        <label for="compny-phone">Phone Number</label>
                        <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('companyPhone')) error @endif">
                            <input type="tel" placeholder="Enter Company Phone Number" name="companyPhone" id="compny-phone" required>
                            <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('companyPhone')) {{$validationErrors->first('companyPhone')}} @endif</span>
                        </div>
                    </div>
                    <div class="layout-holder">
                        <label for="compny-mobile">Mobile Number</label>
                        <div class="input-holder @if(isset($validationErrors) && $validationErrors->has('companyMobile')) error @endif">
                            <input type="tel" placeholder="Enter Company Mobile Number" name="companyMobile" id="compny-mobile" required>
                            <span class="error-text">@if(isset($validationErrors) && $validationErrors->has('companyMobile')) {{$validationErrors->first('companyMobile')}} @endif</span>
                        </div>
                    </div>
                    <div class="layout-holder">
                        <label for="compny-email">Company E-mail</label>
                        <div class="input-holder">
                            <input type="email" placeholder="Enter Company Email" name="companyEmail" id="compny-email" required>
                        </div>
                    </div>
                </div>
                <div class="layout two">
                    <div class="layout-holder">
                        <label for="compny-address">Company Address</label>
                        <div class="input-holder">
                            <input type="text" placeholder="Enter Company Address" name="companyAddress" id="compny-address" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="layout two">
                <div class="layout-holder">
                    <ul class="agree-with-terms">
                        <li>
                            <label for="terms-condition" class="customCheckbox">
                                <input type="checkbox" id="terms-condition">
                                <span class="fake-checkbox"></span>
                                <span class="fake-label">I have read and agree to Property42.pk Terms and Conditions</span>
                            </label>
                        </li>
                        <li>
                            <label for="want-noti" class="customCheckbox">
                                <input type="checkbox" id="want-noti">
                                <span class="fake-checkbox"></span>
                                <span class="fake-label">I want to receive notifications for promotions, newsletters and website updates.</span>
                            </label>
                        </li>
                    </ul>
                </div>
                <div class="layout-holder">
                    <input type="submit" value="SIGN ME UP">
                </div>
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function(){
            $( ".hidden-checkfield" ).trigger( "change" );
        });
    </script>
@endsection
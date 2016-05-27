@extends('registration.auth')

@section('content')
<div class="container">
    <div class="login-registarHolder">
        <ul class="tabset">
            <li class=""><a href="{{url('/login')}}">login</a></li>
            <li class="active"><a href="{{url('/register')}}">become a free member</a></li>
        </ul>
        <div class="tab-content">
            <div id="tab2">
                <form class="registration-form" method="post" action="{{route('register')}}">
                    <div class="input-holder error">
                        <label class="icon-envelope" for="email1"></label>
                        <input type="email" placeholder="Enter Your Email Address" id="email1" name="email" required>
                        <span class="border"></span>
                        <span class="error-text">This is error</span>
                    </div>
                    <div class="input-holder error">
                        <label class="icon-key" for="pass1"></label>
                        <input type="password" placeholder="Enter Your Password" id="pass1" name="password" required>
                        <span class="border"></span>
                        <span class="error-text">This is error</span>
                    </div>
                    <div class="input-holder error">
                        <label class="icon-key" for="cpass"></label>
                        <input type="password"  placeholder="Confirm Password" name="passwordAgain" id="cpass" required>
                        <span class="border"></span>
                        <span class="error-text">This is error</span>
                    </div>
                    <div class="input-holder error">
                        <label class="icon-user" for="name"></label>
                        <input type="text" placeholder="Enter Your Name" name="fullName" id="name" required>
                        <span class="border"></span>
                        <span class="error-text">This is error</span>
                    </div>
                    <h1>Contact Information</h1>
                    <div class="input-holder error">
                        <label class="icon-phone" for="phone"></label>
                        <input type="tel" placeholder="Enter Your Phone Number" name="phone" id="phone" required>
                        <span class="border"></span>
                        <span class="error-text">This is error</span>
                    </div>
                    <div class="input-holder error">
                        <label class="icon-phone_iphone" for="cell"></label>
                        <input type="tel" placeholder="Enter Your Cell / Mobile Number" name="mobile" id="cell" required>
                        <span class="border"></span>
                        <span class="error-text">This is error</span>
                    </div>
                    <div class="input-holder error">
                        <label class="icon-fax" for="fax"></label>
                        <input type="tel" placeholder="Enter Fax Details" name="fax" id="fax" required>
                        <span class="border"></span>
                        <span class="error-text">This is error</span>
                    </div>
                    <div class="input-holder error">
                        <label class="icon-directions" for="address"></label>
                        <input type="text" placeholder="Enter Your Address" name="address" id="address" required>
                        <span class="border"></span>
                        <span class="error-text">This is error</span>
                    </div>
                    <div class="input-holder error">
                        <label class="icon-file-zip" for="zip"></label>
                        <input type="text" placeholder="Enter Zip Code" name="zipCode" id="zip" required>
                        <span class="border"></span>
                        <span class="error-text">This is error</span>
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
                    <div class="input-holder full-width error">
                        <div class="roles">
                            <a class="role-opener">Other Roles:</a>
                            <span class="error-text">This is error</span>
                            <ul class="role-listing">
                                <li>
                                    <input type="checkbox" id="owner-investor" class="userRole-checkbox" name="owner-investor">
                                    <label for="owner-investor">Owner / Investor</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="tenant" class="userRole-checkbox" name="tenant">
                                    <label for="tenant">Tenant</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="agent-2" class="userRole-checkbox agent-brokerCheckbox" name="agent-broker">
                                    <label for="agent-2">Agent/Broker</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="Apprraiser" class="userRole-checkbox" name="apprraiser">
                                    <label for="Apprraiser">Apprraiser</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="Architect" class="userRole-checkbox" name="architect">
                                    <label for="Architect">Architect</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="Builder" class="userRole-checkbox" name="builder">
                                    <label for="Builder">Builder</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="Corporate-Investor" class="userRole-checkbox" name="corporate-investor">
                                    <label for="Corporate-Investor">Corporate Investor</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="Developer" class="userRole-checkbox" name="developer">
                                    <label for="Developer">Developer</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="Listing-Administrator" class="userRole-checkbox" name="listing-admin">
                                    <label for="Listing-Administrator">Listing Administrator</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="Mortgage-Broker" class="userRole-checkbox" name="mortgage-broker">
                                    <label for="Mortgage-Broker">Mortgage Broker</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="Property/Asset Manger" class="userRole-checkbox" name="property-manager">
                                    <label for="Property/Asset Manger">Property/Asset Manger</label>
                                </li>
                                <li>
                                    <input type="checkbox" id="Researcher" class="userRole-checkbox" name="researcher">
                                    <label for="Researcher">Researcher</label>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="agent-information">
                        <h1>Agency Information</h1>
                        <div class="input-holder error">
                            <label for="agency-name" class="icon-agency"></label>
                            <input type="text" placeholder="Enter An Agency Name" id="agency-name" name="agencyName" required>
                            <span class="border"></span>
                            <span class="error-text">This is error</span>
                        </div>
                        <div class="input-holder onTop-mobile">
                            <div class="company-logo">
                                <input type="file" name="companyLogo" onchange="companyLogoUploader(this , '.company-profileP')">
                                <div class="picture-holder"><img src="" class="company-profileP" alt="Company logo"></div>
                                <a class="delete"><span class="icon-bin"></span></a>
                                <span class="name-tag">Add Company Logo</span>
                            </div>
                        </div>
                        <div class="input-holder full-width error">
                            <label for="D-services" class="icon-technical-support"></label>
                            <textarea id="D-services" name="agencyDescription" placeholder="Description of Services"></textarea>
                            <span class="border"></span>
                            <span class="error-text">This is error</span>
                        </div>
                        <h1> Agency Contact Details</h1>
                        <div class="input-holder error">
                            <label for="compny-phone" class="icon-phone"></label>
                            <input type="tel" placeholder="Enter Company Phone Number" name="companyPhone" id="compny-phone" required>
                            <span class="border"></span>
                            <span class="error-text">This is error</span>
                        </div>
                        <div class="input-holder error">
                            <label for="compny-mobile" class="icon-phone_iphone"></label>
                            <input type="tel" placeholder="Enter Company Mobile Number" name="companyMobile" id="compny-mobile" required>
                            <span class="border"></span>
                            <span class="error-text">This is error</span>
                        </div>
                        <div class="input-holder full-width error">
                            <label for="compny-address" class="icon-directions"></label>
                            <input type="text" placeholder="Enter Company Address" name="companyAddress" id="compny-address" required>
                            <span class="border"></span>
                            <span class="error-text">This is error</span>
                        </div>
                        <div class="input-holder error">
                            <label for="compny-email" class="icon-envelope"></label>
                            <input type="email" placeholder="Enter Company Email" name="companyEmail" id="compny-email" required>
                            <span class="border"></span>
                            <span class="error-text">This is error</span>
                        </div>
                    </div>
                    <div class="input-holder full-width error">
                        <ul class="terms-listing">
                            <li>
                                <input type="checkbox" id="terms-Cond" name="termsConditions">
                                <label for="terms-Cond">I have read and agree to Property42.pk <a href="#">Terms and Conditions</a> <span class="error-text">( This is error )</span></label>
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
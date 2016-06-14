@extends('frontend.frontend')
@section('content')
    <div id="content">
        <div class="left-content">
            <div class="company-logos-sliders">
                <div class="mask">
                    <div class="slideset">
                        <div class="slide">
                            <ul class="company-logo">
                                <li><a href="#"><img src="{{url('/')}}/web-apps/frontend/assets/images/agent1.png"
                                                     alt="image description"></a></li>
                                <li><a href="#"><img src="{{url('/')}}/web-apps/frontend/assets/images/agent2.jpg"
                                                     alt="image description"></a></li>
                                <li><a href="#"><img src="{{url('/')}}/web-apps/frontend/assets/images/agent3.jpg"
                                                     alt="image description"></a></li>
                                <li><a href="#"><img src="{{url('/')}}/web-apps/frontend/assets/images/agent4.jpg"
                                                     alt="image description"></a></li>
                                <li><a href="#"><img src="{{url('/')}}/web-apps/frontend/assets/images/agent5.png"
                                                     alt="image description"></a></li>
                            </ul>
                        </div>
                        <div class="slide">
                            <ul class="company-logo">
                                <li><a href="#"><img src="{{url('/')}}/web-apps/frontend/assets/images/agent6.png"
                                                     alt="image description"></a></li>
                                <li><a href="#"><img src="{{url('/')}}/web-apps/frontend/assets/images/agent7.png"
                                                     alt="image description"></a></li>
                                <li><a href="#"><img src="{{url('/')}}/web-apps/frontend/assets/images/agent8.png"
                                                     alt="image description"></a></li>
                                <li><a href="#"><img src="{{url('/')}}/web-apps/frontend/assets/images/agent9.png"
                                                     alt="image description"></a></li>
                                <li><a href="#"><img src="{{url('/')}}/web-apps/frontend/assets/images/agent10.png"
                                                     alt="image description"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="center-content">
            <div class="page-holder">
                <div class="agentProfile-page">
                    <div class="layout">
                        <div class="main-infoHolder">
                            <div class="img-holder"><img src="{{url('/').'/temp/'.$response['data']['agent']->agencies[0]->logo}}" width="300" height="300" alt="image description"></div>
                            <div class="cap-name">
                                <strong class="name">{{$response['data']['agent']->agencies[0]->name}}</strong>
                                <p>{{$response['data']['agent']->agencies[0]->description}}</p>
                            </div>
                        </div>
                        <ul class="contact-links">
                            <li><a href="mailto:&#108;&#111;&#108;&#064;&#108;&#111;&#108;&#115;&#105;&#097;&#110;&#046;&#099;&#111;&#109;"><span class="icon-envelope"></span>{{$response['data']['agent']->agencies[0]->email}}</a></li>
                            <li><a href="tel:{{$response['data']['agent']->agencies[0]->mobile}}"><span class="icon-phone_iphone"></span><span class="hidden-xs">{{$response['data']['agent']->agencies[0]->mobile}}</span><span class="show-xs">Call Now</span></a></li>
                        </ul>
                    </div>
                    <div class="cols-holder">
                        <div class="col">
                            <header>Agent Information</header>
                            <div class="caption">

                                <strong class="name">{{$response['data']['agent']->fName.' '.$response['data']['agent']->lName}}</strong>
                                <p>{{$response['data']['agent']->agencies[0]->description}}.</p>
                            </div>
                        </div>
                        <div class="col">
                            <header>Contact Details</header>
                            <div class="caption">
                                <strong class="name">{{$response['data']['agent']->fName.' '.$response['data']['agent']->lName}}</strong>
                                <span class="agency-name">{{$response['data']['agent']->agencies[0]->name}}</span>
                                <span class="contact-num"><a href="tel:92515400336-39"><span class="icon-phone"></span>{{$response['data']['agent']->phone}}</a></span>
                                <span class="contact-num"><a href="tel:923018501111"><span class="icon-phone_iphone"></span>{{$response['data']['agent']->mobile}}</a></span>
                                <address>{{$response['data']['agent']->agencies[0]->address}}</address>
                            </div>
                        </div>
                        <div class="col">
                            <header>Enquiry through email</header>
                            <div class="caption">
                                <form class="enquiry-form">
                                    <ul>
                                        <li>
                                            <label for="subject">Subject</label>
                                            <div class="input-holder error">
                                                <input type="text" id="subject" placeholder="Please Enter Your Subject">
                                                <span class="error-text">This is error</span>
                                            </div>
                                        </li>
                                        <li>
                                            <label for="name">Name</label>
                                            <div class="input-holder">
                                                <input type="text" id="name" placeholder="Please enter your Name">
                                                <span class="error-text">This is error</span>
                                            </div>
                                        </li>
                                        <li>
                                            <label for="email">Email</label>
                                            <div class="input-holder">
                                                <input type="text" id="email" placeholder="Please enter your Email">
                                                <span class="error-text">This is error</span>
                                            </div>
                                        </li>
                                        <li>
                                            <label for="phone">Phone</label>
                                            <div class="input-holder error">
                                                <input type="text" id="phone" placeholder="Please enter your Phone">
                                                <span class="error-text">This is error</span>
                                            </div>
                                        </li>
                                        <li>
                                            <label for="cell">Cell</label>
                                            <div class="input-holder">
                                                <input type="tel" id="cell" placeholder="Please enter your Cell">
                                                <span class="error-text">This is error</span>
                                            </div>
                                        </li>
                                        <li>
                                            <label for="msg">Message</label>
                                            <div class="input-holder">
                                                <textarea id="msg" placeholder="Please enter your Message"></textarea>
                                                <span class="error-text">This is error</span>
                                            </div>
                                        </li>
                                        <li>
                                            <label for="captcha">Security code</label>
                                            <div class="input-holder add error">
                                                <input type="text" id="captcha">
                                                <span class="error-text">This is error</span>
                                                <img src="{{url('/')}}/web-apps/frontend/assets/images/agent1.png" width="130" height="40" alt="captcha" class="captcha">
                                            </div>
                                        </li>
                                        <li><span>Before submiting this form i agree the <a href="#">Terms and condition</a></span></li>
                                    </ul>
                                    <button type="submit"><span class="icon-envelope"></span>Send email</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="right-content">
            <ul class="posters">
                <li><a href="#"><img src="{{url('/')}}/web-apps/frontend/assets/images/poster1.jpg" width="523"
                                     height="737" alt="image description"></a></li>
                <li><a href="#"><img src="{{url('/')}}/web-apps/frontend/assets/images/poster2.jpg" width="198"
                                     height="255" alt="image description"></a></li>
                <li><a href="#"><img src="{{url('/')}}/web-apps/frontend/assets/images/poster3.jpg" width="194"
                                     height="259" alt="image description"></a></li>
                <li><a href="#"><img src="{{url('/')}}/web-apps/frontend/assets/images/poster1.jpg" width="523"
                                     height="737" alt="image description"></a></li>
            </ul>
        </div>
    </div>
@endsection

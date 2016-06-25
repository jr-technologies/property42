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
                            <div class="img-holder">
                                <?php
                                $image = url('/')."/assets/imgs/no.png";
                                if($response['data']['agent']->agencies[0]->logo !="")
                                {
                                    $image = url('/').'/temp/'.$response['data']['agent']->agencies[0]->logo;
                                }
                                ?>
                                <img
                                        src="{{$image}}"
                                        width="300" height="300" alt="image description"></div>
                            <div class="cap-name">
                                <strong class="name">{{$response['data']['agent']->agencies[0]->name}}</strong>

                                <p>{{$response['data']['agent']->agencies[0]->description}}</p>
                            </div>
                        </div>
                        <ul class="contact-links">
                            <li class="popup-holder">
                                <a class="popup-opener"><span
                                            class="icon-envelope"></span>{{$response['data']['agent']->agencies[0]->email}}
                                </a>
                            </li>
                            <li><a href="tel:{{$response['data']['agent']->agencies[0]->mobile}}"><span
                                            class="icon-phone_iphone"></span><span
                                            class="hidden-xs">{{$response['data']['agent']->agencies[0]->mobile}}</span><span
                                            class="show-xs">Call Now</span></a></li>
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
                                <span class="contact-num"><a href="tel:92515400336-39"><span
                                                class="icon-phone"></span>{{$response['data']['agent']->phone}}
                                    </a></span>
                                <span class="contact-num"><a href="tel:923018501111"><span
                                                class="icon-phone_iphone"></span>{{$response['data']['agent']->mobile}}
                                    </a></span>
                                <address>{{$response['data']['agent']->agencies[0]->address}}</address>
                            </div>
                        </div>
                        @if(\Session::has('validationErrors'))
                            <?php $errors = \Session::get('validationErrors');?>
                        @endif

                        <div class="col">
                            <header>Enquiry through email</header>
                            <div class="caption">
                                {{ Form::open(array('url' => 'agent/mail','method' => 'GET', 'class'=>'enquiry-form')) }}
                                    <ul>
                                     <input type="hidden" id="name" name="to" value="{{$response['data']['agent']->email}}" >
                                    <li>
                                        <label for="name">Name</label>

                                        <div class="input-holder @if($errors->has('name')) error @endif">
                                            <input type="text" id="name" name="name" required
                                                   placeholder="Please enter your Name" value="{{old('name')}}">
                                            <span class="error-text">@if($errors->has('name')) {{$errors->first('name')}} @endif</span>
                                        </div>
                                    </li>
                                    <li>
                                        <label for="email">Email</label>

                                        <div class="input-holder @if($errors->has('email')) error @endif">
                                            <input type="text" id="email" name="email" required
                                                   placeholder="Please enter your Email" value="{{old('email')}}">
                                            <span class="error-text">@if($errors->has('email')) {{$errors->first('email')}} @endif</span>
                                        </div>
                                    </li>

                                    <li>
                                        <label for="cell">Cell</label>

                                        <div class="input-holder @if($errors->has('cell')) error @endif">
                                            <input type="tel" id="cell" name="cell" required
                                                   placeholder="Please enter your Cell" value="{{old('cell')}}">
                                            <span class="error-text">@if($errors->has('cell')) {{$errors->first('cell')}} @endif</span>
                                        </div>
                                    </li>
                                    <li>
                                        <label for="msg">Message</label>

                                        <div class="input-holder @if($errors->has('message')) error @endif">
                                            <textarea id="msg" name="message" required
                                                      placeholder="Please enter your Message">{{old('message')}}</textarea>
                                            <span class="error-text">@if($errors->has('message')) {{$errors->first('message')}} @endif</span>
                                        </div>
                                    </li>

                                    <li><span>Before submiting this form i agree the <a href="#">Terms and condition</a></span>
                                    </li>
                                </ul>
                                <button type="submit"><span class="icon-envelope"></span>Send email</button>
                                {{Form::close()}}
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

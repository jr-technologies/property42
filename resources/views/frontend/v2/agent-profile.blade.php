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
    <main id="main" role="main">
        <div class="page-holder">
            <div class="agent-detail-page">
                <div class="container">
                    <div class="detail-holder">
                        <div class="frame">
                            <div class="agent-detail-holder">
                                <?php
                                $image = url('/') . "/assets/imgs/no.png";
                                if ($response['data']['agent']->agencies[0]->logo != "") {
                                    $image = url('/') . '/temp/' . $response['data']['agent']->agencies[0]->logo;
                                }
                                ?>
                                <div class="agent-picture">
                                    <img src="{{$image}}" alt="image description">
                                    {{--<a class="add-to-favorite added" href="#"></a>--}}
                                    {{--<span class="premiumProperty text-upparcase">Premium</span>--}}
                                </div>
                                <div class="agent-description">
                                    <div class="layout">
                                        <div class="left-side">
                                            <h1><span>{{$response['data']['agent']->agencies[0]->name}}</span></h1>
                                            <span class="location">Lahore</span>
                                        </div>
                                        <div class="right-side">
                                            <span class="rate-us text-center">RATE US</span>
                                            <ul class="star-rating">
                                                <li><a href="#" class="one-star"></a></li>
                                                <li><a href="#" class="two-stars"></a></li>
                                                <li><a href="#" class="three-stars"></a></li>
                                                <li><a href="#" class="four-stars"></a></li>
                                                <li><a href="#" class="five-stars"></a></li>
                                            </ul>
                                            @if($response['data']['agent']->trustedAgent)
                                            <span class="trusted-agent"><span class="icon-trusted"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span></span>Trusted</span>
                                            @endif
                                        </div>
                                    </div>
                                    @if(sizeof($response['data']['agent']->agencies) > 0 )
                                        @if(sizeof($response['data']['agent']->agencies[0]->societies) > 0)
                                    <div class="agent-societies">
                                        <span class="small-heading">Society we deal in</span>
                                        <div class="agent-mask ">
                                            <div class="agent-slideset">
                                                @foreach($response['data']['agent']->agencies[0]->societies as $society )
                                                    @if($society != null)
                                                <div class="agent-slide"><a href="#">
                                                        @if( isset($society->path) && $society->path !=null)
                                                        <img src="{{url('/').'/' .$society->path}}" alt="image description">
                                                        @else
                                                        <span class="image-description">{{$society->name}}</span></a></div>
                                                        @endif
                                                    @endif
                                                        @endforeach
                                            </div>
                                            <a href="#" class="btn-prev"><span class="icon-left-arrow"></span></a>
                                            <a href="#" class="btn-next"><span class="icon-rights-arrow"></span></a>
                                        </div>
                                    </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div class="info-blockAgent">
                                <span class="heading text-upparcase">Contact Details</span>
                                <ul class="agentDetail-list">
                                    <li>
                                        <span class="icon-user"></span>
                                        <span class="text-tag">{{$response['data']['agent']->fName.' '.$response['data']['agent']->lName}}</span>
                                    </li>
                                    <li>
                                        <span class="icon-location"></span>
                                        <address>{{$response['data']['agent']->address}}</address>
                                    </li>
                                    <li>
                                        <span class="icon-mobile"></span>
                                        <span class="text-tag"><a href="tel:{{$response['data']['agent']->mobile}}"></a>{{$response['data']['agent']->mobile}}</span>
                                    </li>
                                    <li>
                                        <span class="icon-old-phone"></span>
                                        <span class="text-tag"><a href="tel:{{$response['data']['agent']->phone}}">{{$response['data']['agent']->phone}}</a></span>
                                    </li>
                                    <li>
                                        <span class="icon-domain"></span>
                                        <span class="text-tag"><a href="#">{{$response['data']['agent']->email}}</a></span>
                                    </li>
                                </ul>
                                {{Form::open(array('url'=>'mail-to-agent','method'=>'POST','class'=>'inquiry-email-form'))}}
                                <span class="small-heading">Send email</span>
                                <div class="field-holder">
                                    <label for="name">Name</label>

                                    <div class="input-holder"><input type="text" id="name" name="name"></div>
                                </div>
                                <div class="field-holder">
                                    <label for="email">Email</label>

                                    <div class="input-holder"><input type="email" id="email" name="email" required></div>
                                </div>
                                <div class="field-holder">
                                    <label for="phone">phone</label>

                                    <div class="input-holder"><input type="tel" id="phone" name="phone" required></div>
                                </div>
                                <div class="field-holder">
                                    <label for="subject">subject</label>

                                    <div class="input-holder"><input type="text" id="subject" name="subject"></div>
                                </div>
                                <div class="field-holder">
                                    <label for="message">message</label>

                                    <div class="input-holder"><textarea id="message" name="message" required></textarea>
                                        <p>By submitting this form I agree to <a href="#">Terms of Use</a></p>
                                    </div>
                                </div>
                                <button type="submit">SEND</button>
                                {{Form::close()}}
                            </div>
                        </div>
                        <div class="overview-section">
                            <span class="small-heading full-width">Agent Overview</span>
                            <p>{{$response['data']['agent']->agencies[0]->description}}</p>
                        </div>
                        <div class="extra-feature-section">
                            <span class="small-heading">Properties LISTING</span>
                            <div class="layout">
                                @foreach($response['data']['userPropertiesState'] as $key=>$propertySubTypes)
                                <div class="col">
                                    <span class="small-heading">{{$key}}</span>
                                    <ul class="list">
                                        @foreach($propertySubTypes as $propertySubType)
                                        <li><span><span class="icon-folder"></span>{{$propertySubType->subType}}</span><span>{{$propertySubType->totalProperties}}</span></li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
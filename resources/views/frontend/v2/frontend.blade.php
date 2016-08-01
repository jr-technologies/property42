<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property42</title>
    <link media="all" rel="stylesheet" href="{{url('/')}}/web-apps/frontend/v2/css/main.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,100,300,500,600,700,800,400italic' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</head>
<body>
<div id="wrapper">
    <div class="main-bg-holder {{(Route::getCurrentRoute()->getPath() !='/')?'byDefault-fixed':''}}">
        <header id="header">
            <div class="top-bar">
                <ul class="social-icons">
                    <li><a href="https://www.facebook.com/property42pk-1562646287317094/"><span class="icon-facebook"></span></a></li>
                    {{--<li><a href="#"><span class="icon-google-plus-symbol"></span></a></li>--}}
                    {{--<li><a href="#"><span class="icon-linkedin"></span></a></li>--}}
                    <li><a href="https://twitter.com/Property42_pk"><span class="icon-twitter"></span></a></li>
                    {{--<li><a href="#"><span class="icon-instagram"></span></a></li>--}}
                </ul>
                <a href="#" class="navigation-toggler nav-opener"><span></span></a>
                <div class="right-sideTop text-right">
                    <a class="mail" href="mailto:&#105;&#110;&#102;&#111;&#064;&#112;&#114;&#111;&#112;&#101;&#114;&#116;&#121;&#052;&#050;&#046;&#099;&#111;&#109;">&#105;&#110;&#102;&#111;&#064;&#112;&#114;&#111;&#112;&#101;&#114;&#116;&#121;&#052;&#050;&#046;&#099;&#111;&#109;</a>
                    <ul class="loginRegister text-upparcase text-left">
                        <li><a href="{{ URL::to('/login') }}"><span class="icon-avatar hidden"></span><span class="hidden-xs">Login / Register</span></a></li>
                        <li><a href="{{ URL::to('add-property') }}"><span class="hidden-xs">List your property</span><span class="icon-plus-square"></span></a></li>
                    </ul>
                </div>
            </div>
            <div class="logo"><a href="{{URL::to('/')}}"><img src="{{url('/')}}/web-apps/frontend/v2/images/logo.png" width="477" height="150" alt="Property42"></a></div>
        </header>
        @if(Route::getCurrentRoute()->getPath() =='/')
            <div class="main-visualSection">
                <div class="container">
                    <strong class="main-heading text-upparcase"><span class="blue">LIST</span> <span class="black">yOUR</span> PROPERTY</strong>
                    <p>Are you thinking of buying your first property, downsizing, or looking to upgrade to bigger and better? Where do you want to live? Let us help you find that ideal home!</p>
                    <ul class="number-of-properties text-upparcase">
                        @foreach($response['data']['saleAndRentCount'] as $saleRent)
                            <li>
                                <strong class="numberOfProperty">{{$saleRent->totalProperties}}</strong>
                                <span class="tag">{{$saleRent->displayName}}</span>
                            </li>
                        @endforeach
                    </ul>
                    {{ Form::open(array('url' => 'search','method' => 'GET','class'=>'mainSearch-form' )) }}

                    <ul class="typeOfBuying text-upparcase">
                        <li>
                            <label for="buy1">
                                <input type="radio" name="purpose_id" value="1" id="buy1" checked >
                                <span class="fake-label">Buy</span>
                            </label>
                        </li>
                        <li>
                            <label for="rent1">
                                <input type="radio" name="purpose_id" id="rent1" value="2">
                                <span class="fake-label">Rent</span>
                            </label>
                        </li>
                    </ul>
                    <div class="form-holder">
                        <ul class="subTypes">
                            <li>
                                <label for="all-type" class="customRadio">
                                    <input type="radio" name="property_type_id" id="all-type" value="">
                                    <span class="fake-radio"></span>
                                    <span class="fake-label">All types</span>
                                </label>
                            </li>
                            @foreach($response['data']['propertyTypes'] as $propertyType)
                                <li>
                                    <label for="{{$propertyType->name."_".$propertyType->id}}" class="customRadio">
                                        <input type="radio" id="{{$propertyType->name."_".$propertyType->id}}"
                                               name="property_type_id" class="property_type" value="{{$propertyType->id}}">
                                        <span class="fake-radio"></span>
                                        <span class="fake-label">{{$propertyType->name}}</span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                        <div class="layout">
                            <ul class="inputsHolder">
                                <li>
                                    <span class="label">Location / Society</span>
                                    <div class="input-holder">
                                        <select name="society_id" id="society" class="js-example-basic-single">
                                            <option value="">All Societies</option>
                                            @foreach($response['data']['societies'] as $society)
                                                <option value="{{$society->id}}">{{$society->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </li>
                                <li>
                                    <button type="submit"><span class="icon-search"></span>search</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        @endif
        <nav id="nav">
            <form class="searchByID">
                <input type="search" placeholder="Search by ID">
                <button type="submit"><span class="icon-search"></span></button>
            </form>
            <div class="nav-holder">
                <a href="#" class="navigation-toggler close"><span class="icon-cross"></span></a>
                <ul class="main-navigation text-upparcase">
                    <li class="active">
                        <a href="{{URL::to('/')}}"><span class="middle-align"><span class="icon-home"></span>HOME</span></a>
                    </li>
                    <li>
                        <a href="{{URL::to('/')}}/search"><span class="middle-align"><span class="icon-d-building"></span>Properties</span></a>
                    </li>
                    <li>
                        <a href="{{URL::to('agents')}}"><span class="middle-align"><span class="icon-male-close-up-silhouette-with-tie"></span>AGENTS</span></a>
                    </li>
                    <li>
                        <a href="{{URL::to('societies/maps')}}"><span class="middle-align"><span class="icon-street-map"></span>MAPS</span></a>
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
                        <li><a href="https://www.facebook.com/property42pk-1562646287317094/"><span class="icon-facebook"></span></a></li>
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
        @yield('content')
    </main>
    <footer id="footer">
        <span class="copyright">Copyright,<a href="{{url('/')}}">Property42.pk</a></span>
    </footer>
<script type="text/javascript" src="{{url('/')}}/assets/js/helper.js"></script>
<script type="text/javascript" src="{{url('/')}}/assets/js/env.js"></script>
    <script src="{{url('/')}}/web-apps/frontend/v2/js/fixed-block.js" type="text/javascript" defer></script>
    <script src="{{url('/')}}/web-apps/frontend/v2/js/smooth-scroll.js" type="text/javascript" defer></script>
    <script src="{{url('/')}}/web-apps/frontend/v2/js/jquery.accordion.js" type="text/javascript" defer></script>
    <script src="{{url('/')}}/web-apps/frontend/v2/js/property-filter.js" type="text/javascript" defer></script>
<script src="{{url('/')}}/web-apps/frontend/v2/js/select2-min.js" type="text/javascript" defer></script>
<script src="{{url('/')}}/web-apps/frontend/v2/js/jquery.carousel.js" type="text/javascript" defer></script>
<script src="{{url('/')}}/web-apps/frontend/v2/js/jquery.slideshow.js" type="text/javascript" defer></script>
<script src="{{url('/')}}/web-apps/frontend/v2/js/placeholder.js" type="text/javascript" defer></script>
    <script src="{{url('/')}}/web-apps/frontend/v2/js/lightBox.js" type="text/javascript" defer></script>
    <script src="{{url('/')}}/web-apps/frontend/v2/js/jquery-main.js" type="text/javascript" defer></script>
    <script src="{{url('/')}}/web-apps/frontend/v2/js/registration.js" type="text/javascript" defer></script>
<script src="{{url('/')}}/web-apps/frontend/v2/js/star-rating.js" type="text/javascript" defer></script>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property42</title>
    <link media="all" rel="stylesheet" href="{{url('/')}}/web-apps/frontend/v2/css/main.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,100,300,500,600,700,800,400italic' rel='stylesheet' type='text/css'>
</head>
<body>
<div id="wrapper">
    <div class="{{(Route::getCurrentRoute()->getPath() !='/')?'main-bg-holder byDefault-fixed':'main-bg-holder'}}">
        <header id="header" class="fixed-scroll-block">
            <div class="top-bar">
                <ul class="social-icons">
                    <li><a href="https://www.facebook.com/property42pk-1562646287317094/"><span class="icon-facebook"></span></a></li>
                    {{--<li><a href="#"><span class="icon-google-plus-symbol"></span></a></li>--}}
                    {{--<li><a href="#"><span class="icon-linkedin"></span></a></li>--}}
                    <li><a href="https://twitter.com/Property42_pk"><span class="icon-twitter"></span></a></li>
                    {{--<li><a href="#"><span class="icon-instagram"></span></a></li>--}}
                </ul>
                <div class="right-sideTop text-right">
                    <a class="mail" href="mailto:&#105;&#110;&#102;&#111;&#064;&#112;&#114;&#111;&#112;&#101;&#114;&#116;&#121;&#052;&#050;&#046;&#099;&#111;&#109;">&#105;&#110;&#102;&#111;&#064;&#112;&#114;&#111;&#112;&#101;&#114;&#116;&#121;&#052;&#050;&#046;&#099;&#111;&#109;</a>
                    <ul class="loginRegister text-upparcase text-left">
                        <li><a href="{{ URL::to('/login') }}">Login / Register</a></li>
                        <li><a href="{{ URL::to('add-property') }}">List your property<span class="icon-arrow-with-circle-right"></span></a></li>
                    </ul>
                </div>
            </div>
            <div class="logo"><a href="{{URL::to('/')}}"><img src="{{url('/')}}/web-apps/frontend/v2/images/logo.png" width="477" height="150" alt="Property42"></a></div>
        </header>
        @yield('content')
    <footer id="footer">
        <span class="copyright">Copyright,<a href="#">Property42.pk</a></span>
    </footer>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js" defer></script>
<script type="text/javascript">window.jQuery || document.write('<script src="{{url('/')}}/web-apps/frontend/v2/js/jquery-1.11.2.min.js" defer><\/script>')</script>
<script type="text/javascript" src="{{url('/')}}/assets/js/helper.js"></script>
<script type="text/javascript" src="{{url('/')}}/assets/js/env.js"></script>
<script src="{{url('/')}}/web-apps/frontend/v2/js/property-filter.js" type="text/javascript" defer></script>
<script src="{{url('/')}}/web-apps/frontend/v2/js/select2-min.js" type="text/javascript" defer></script>
<script src="{{url('/')}}/web-apps/frontend/v2/js/jquery.carousel.js" type="text/javascript" defer></script>
<script src="{{url('/')}}/web-apps/frontend/v2/js/jquery.slideshow.js" type="text/javascript" defer></script>
<script src="{{url('/')}}/web-apps/frontend/v2/js/placeholder.js" type="text/javascript" defer></script>
<script src="{{url('/')}}/web-apps/frontend/v2/js/jquery-main.js" type="text/javascript" defer></script>
</body>
</html>

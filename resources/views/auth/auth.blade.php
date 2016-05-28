<!DOCTYPE html>
<html>
<head>
    <!-- set the encoding of your site -->
    <meta charset="utf-8">
    <!-- set the viewport width and initial-scale on mobile devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property42</title>
    <!-- include the site stylesheet -->
    <link media="all" rel="stylesheet" href="{{url('/web-apps/registration/assets/')}}/css/auth-main.css">
    <!-- google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>
</head>
<body>
<!-- main container of all the page elements -->
<div id="wrapper">
    <header id="header">
        <div class="container">
            <div class="layout">
                <div class="logo"><a href="#"><img src="{{url('/web-apps/registration/assets/')}}/images/logo.png" width="695" height="301" alt="Property42"></a></div>
                <a href="{{route('loginPage')}}" class="login-register">Login / Register</a>
            </div>
        </div>
    </header>
    <main id="main" role="main">
        @yield('content');
    </main>
</div>
<!-- include jQuery library -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js" defer></script>
<script type="text/javascript">window.jQuery || document.write('<script src="{{url('/web-apps/registration/assets/')}}/js/jquery-1.11.2.min.js" defer><\/script>')</script>
<!-- include custom JavaScript -->
<script type="text/javascript" src="{{url('/web-apps/registration/assets/')}}/js/helper.js" defer></script>
<script type="text/javascript" src="{{url('/web-apps/registration/assets/')}}/js/placeholder.js" defer></script>
<script type="text/javascript" src="{{url('/web-apps/registration/assets/')}}/js/jquery.main.js" defer></script>
</body>
</html>
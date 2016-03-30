<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>
    </head>
    <body>
        <div class="background-image">
        </div>
        <div class="container">
            <div class="content">
                @if(\Session::has('errors'))
                    @foreach(\Session::get('errors') as $error)
                        {{$error}}
                    @endforeach
                @endif
                <form method="post" action="{{route('login')}}">
                    <input type="text" name="email">
                    <input type="text" name="password">
                    <input type="submit" name="submit">
                </form>
            </div>
        </div>
    </body>
</html>

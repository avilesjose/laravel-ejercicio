<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @yield("titles")
        <link rel="stylesheet" href="{{asset('css/app.css?v=1')}}">
        <link rel="shortcut icon" href="{{asset('kemok-ico.png')}}">
        @yield("links")
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            @yield("content")
        </div>
        <script type="text/javascript" src="{{asset('js/app.js?v=1')}}"></script>
        <script>
            $(document).ready(function() {
                $("body").tooltip({ selector: "[data-toggle=tooltip]" });
            });
        </script>
        @yield("scripts")
    </body>
</html>
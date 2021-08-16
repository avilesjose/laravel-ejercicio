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
    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
        <div class="wrapper">
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu"><i class="fas fa-bars"></i></a>
                    </li>
                </ul>
            </nav>
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <a href="{{route('feed')}}" class="brand-link">
                    <img src="{{asset('kemok.png')}}" alt="Kemok" class="brand-image rounded">
                    <span class="brand-text font-weight-light">Kemok</span>
                </a>
                <div class="sidebar">
                    @include("includes.menu")
                </div>
            </aside>
            <div class="content-wrapper mb-5">
                @yield("content")
            </div>
            <footer class="main-footer">
                <strong>Copyright &copy; 2021 <a class="color-master" href="{{route('feed')}}">Kemok</a>.</strong>
                Todos los derechos reservados.
            </footer>
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
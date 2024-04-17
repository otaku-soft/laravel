
<!doctype html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>{{ env('APP_NAME') }} @isset($title) - {{ $title }} @endisset </title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/cover/">



    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <meta name="theme-color" content="#7952b3">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script
        src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous">
    </script>
    <script src = "https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" ></script>
    <script src = "{{ url("js/bootbox.min.js") }}"></script>
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
        /*
 * Globals
 */


        /* Custom default button */
        .btn-secondary,
        .btn-secondary:hover,
        .btn-secondary:focus {
            color: #333;
            text-shadow: none; /* Prevent inheritance from `body` */
        }


        /*
         * Base structure
         */

        body {
            background-color:black !important;
            background-image:url("https://laravel.com/assets/img/welcome/background.svg");
            background-repeat: no-repeat;

        }

        .cover-container {
            max-width: 80em;

        }


        /*
         * Header
         */

        .nav-masthead .nav-link {
            padding: .25rem 0;
            font-weight: 700;
            color: rgba(255, 255, 255, .5);
            background-color: transparent;
            border-bottom: .25rem solid transparent;
        }

        .nav-masthead .nav-link:hover,
        .nav-masthead .nav-link:focus {
            border-bottom-color: rgba(255, 255, 255, .25);
        }

        .nav-masthead .nav-link + .nav-link {
            margin-left: 1rem;
        }

        .nav-masthead .active {
            color: #fff;
            border-bottom-color: #fff;
        }

        td {
            padding-top:2% !important;
            padding-bottom:2% !important
        }
        .text-muted{
            color:white !important
        }
        .btn-primary,.btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary.active, .open>.dropdown-toggle.btn-primary {
            background-color:orangered;
            border-color: orangered
        }
        .active >  .page-link
        {
            border-color:orangered !important;
            background-color: orangered !important;
        }
        .pagination > li > a:focus,
        .pagination > li > a:hover,
        .pagination > li > span:focus,
        .pagination > li > span:hover {
            background-color: orangered !important;
            border-color:orangered !important;
            color:white !important;
        }
        .modal-title {
            color: black !important;
        }
        .bootbox-body {
            color:#6c757d !important;
        }
        .bootbox-cancel {
            color:white !important
        }
    </style>


    <!-- Custom styles for this template -->
</head>
<body class="d-flex h-100 text-center text-white">

<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <header class="mb-auto" style="padding-bottom:0 !important;margin-bottom:20px !important">
        <div>
            <nav class="nav nav-masthead justify-content-center float-md-end">
                <a class="nav-link" href="{{ url('/') }}">Home</a>
                <a class="nav-link" href="{{ url('/forum') }}">Forum</a>
                @auth
                    <form method="POST" action="{{ route('logout') }}" >
                        @csrf
                        <a :href="route('logout')" style="cursor:pointer;padding-left:10px"
                           class="nav-link"
                           onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </a>
                    </form>
                @else
                    <a class="nav-link" href="{{ route('login') }}">Log in</a>
                    <a href="{{ route('register') }}" class="nav-link">Register</a>
                @endauth
            </nav>
        </div>
        <br/><br/>
        <img src ="{{ asset(env('APP_BANNER')) }}" style="width:100%;" />

    </header>

    <main class="px-3" style="background-color:#18181b;">
        <div style="margin-left:2%;margin-top:2%;margin-right:2%;margin-bottom:2%;text-align:left">
            @yield('content')
        </div>
    </main>

    <footer class="mt-auto text-white-50" style="margin-top:20px !important;padding-bottom:20px !important">
        {{ env('APP_NAME') }}
    </footer>
</div>



</body>
</html>

<html>
    <head>
        <title> @yield('title')</title>
        <meta name="viewport" content="width=device-width, user-scalable=no">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://d3js.org/d3.v5.min.js"></script>


        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
        <!-- Bootstrap core CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
        <!-- Material Design Bootstrap -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.9/css/mdb.min.css" rel="stylesheet">
        <!--W3 css -->
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

        <!--link rel="stylesheet" href="/css/app.css"-->


        <!-- Bootstrap tooltips -->
        <script type="text/javascript"
                src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
        <!-- Bootstrap core JavaScript -->
        <script type="text/javascript"
                src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <!-- MDB core JavaScript -->
        <script type="text/javascript"
                src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.9/js/mdb.min.js"></script>

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- todo: mudar isso -->
        <style>
            .w3-container {
                padding: 0 0 0 0;
            }

            .w3-display-topright {
                z-index: 100;
            }

            .Site{
                display: flex;
                min-height: 100vh;
                flex-direction: column;
            }

            .Site-content{
                flex: 1;
            }

            body {
                background-image: url("/img/banner_bg.png"),
                url("/img/banner_img.png");
                background-repeat: no-repeat, no-repeat;
                background-position: left top, right bottom;
            }

            li.list-group-item .active {
                background-color: #0d47a1;
            }

            header li.list-group-item {
                background-color: rgba(0, 0, 0, 0);
                border: none;
            }
        </style>

    </head>
    <body class="Site Site-content">
        <header>
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        Home
                    </a>
                    <a href="@yield('return', '/')" class="navbar-brand">Voltar</a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent"
                            aria-controls="navbarSupportedContent" aria-expanded="false"
                            aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Se registrar') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();">
                                            {{ __('Sair') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                              style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
            @php
                $level = 0;
            @endphp
            @yield('add_button')
        </header>
        <div class="container" style="margin-top: 10px;">
            @yield('head-content')
            @yield('content')
        </div>
        <script src="/js/jquery.csv.js"></script>
        <script src ="/js/test.script.js"></script>
        <script src ="/js/schoolmember.script.js"></script>
        <script src="/js/ans_test.script.js"></script>
    </body>
</html>

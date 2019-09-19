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

    <link rel="stylesheet" href="/css/app.css">


    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.9/js/mdb.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- todo: mudar isso -->
    <style>
        .w3-container {
            padding: 0 0 0 0;
        }
        .w3-display-topright {
            z-index: 100;
        }
        body {
            background-image: url("https://raw.githubusercontent.com/samuel0072/belem/46d0d2c940d84bacd91ede44e4afda6b331bb71d/site/resources/views/template/ecobit/img/banner_bg.png?token=AHJYCDA33L3HUV2L7LRHBIK5RN5UE"),
                                url("https://raw.githubusercontent.com/samuel0072/belem/46d0d2c940d84bacd91ede44e4afda6b331bb71d/site/resources/views/template/ecobit/img/banner_img.png?token=AHJYCDCQSMOZNCP3GUSV7FC5RN5LE");
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
<body>
    <header>
        <ul class="list-group">
            <li class="list-group-item">
                <div class="btn-group btn-group-toggle">
                    @yield('logo')
                    <a href = "/" class = "btn blue darken-4 text-white" >Home</a>
                    <button class = "btn btn-white">Contacts</button>
                    <a href="@yield('return', '/')" class = "btn btn-white" >Voltar</a>
                </div>
                @yield('add_button')
            </li>
        </ul>

    </header>
    <div class="container">
        @yield('head-content')
        @yield('content')
    </div>
</body>
</html>

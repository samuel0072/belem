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


    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.9/js/mdb.min.js"></script>

</head>
<body>
    <header>
        <ul class="list-group">
            <li class="list-group-item grey">
                <div class="btn-group btn-group-toggle">
                    @yield('logo')
                    <a href = "/" class = "btn btn-primary ">Home</a>
                    <button class = "btn btn-white">Contacts</button>
                    <button class = "btn btn-white" onclick="back()">Voltar(BETA)</button>
                </div>
            </li>
        </ul>
    </header>
    <div class="container">
        @yield('head-content')
        @yield('content')
    </div>
    <script>
        function back() {
            window.history.back();
        }
    </script>
</body>
</html>

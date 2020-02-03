<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Simple Sidebar - Start Bootstrap Template</title>

  <!-- Bootstrap core CSS -->
<!--   <link href="sidenav/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->

  <!-- Custom styles for this template -->
<!--   <link href="sidenav/css/simple-sidebar.css" rel="stylesheet"> -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
{{--     <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading"><img src="{{ asset('img/paasculogo.png') }}"> Paascu Accouting System</div>
      <div class="list-group list-group-flush">
        <a href="#" class="list-group-item list-group-item-action bg-light"><img src="{{ asset('img/home.svg') }}"> Dashboard</a>
        <a href="#usedrop" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle list-group-item list-group-item-action bg-light">User Managment</a>
        <ul class="collapse list-group-item list-group-item-action bg-light" id="usedrop">
            <a href="#" class="list-group-item list-group-item-action bg-light">Register Users</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">Manage Users</a>
        </ul>
        <a href="#memdrop" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle list-group-item list-group-item-action bg-light">Manage Members</a>
        <ul class="collapse list-group-item list-group-item-action bg-light" id="memdrop">
            <a href="#" class="list-group-item list-group-item-action bg-light">module 1</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">module 2</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">module 3</a>
        </ul>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->
{{-- <img src="{{ asset('img/paasculogo.png') }}">   Paascu Accounting System --}}
    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <a class="" id="menu-toggle"><img id="arrowRotate"src="{{ asset('img/bak.svg') }}" data-swap="{{ asset('img/for.svg') }}"></a>
        <button class="navbar-toggler container" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse container" id="navbarSupportedContent">

          
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
                        @else

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                            @can('admin-user')

                                    <a class=" dropdown-item" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    <a class=" dropdown-item" href="{{ route('admin.users.index') }}">{{ __('User Management') }}</a>
                                    @endcan
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
        </div>
      </nav>

        <main class="py-4">
            <div class="container">
            @include('partials.alerts')
            @yield('content')
            </div>
        </main>
    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Bootstrap core JavaScript -->
<!--   <script src="sidenav/vendor/jquery/jquery.min.js"></script> -->
<!--   <script src="sidenav/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->

  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });

    $("#arrowRotate").click(function() { 
       var _this = $(this);
       var current = _this.attr("src");
       var swap = _this.attr("data-swap");     
     _this.attr('src', swap).attr("data-swap",current);   
});  
  </script>

</body>

</html>

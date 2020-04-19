<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>PAASCUAS</title>

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
      <div class="sidebar-heading"><img src="{{ asset('img/paasculogo.png') }}"> Paascu Accounting System</div>
      <div class="list-group list-group-flush">
        <a href="{{ route('home') }}" class="list-group-item list-group-item-action bg-light"><img src="{{ asset('img/home.png') }}">  Dashboard</a>
@can('admin')
        <a href="{{ route('users.index') }}" class="list-group-item list-group-item-action bg-light"><img src="{{ asset('img/account.png') }}">  User Accounts</a>
@endcan
@can('admin')
        <a href="{{ route('members.index') }}" class="list-group-item list-group-item-action bg-light"><img src="{{ asset('img/member.png') }}">  Manage Members</a>
@endcan
@can('admin')
        <a href="{{ route('programs.index') }}" class="list-group-item list-group-item-action bg-light"><img src="{{ asset('img/program.png') }}">  Manage Programs</a>
@endcan
@can('admin')
        <a href="{{ route('schedulemembership.index') }}" class="list-group-item list-group-item-action bg-light"><img src="{{ asset('img/table.png') }}">  Manage Schedule Membership</a>
@endcan
        <a href="#pageSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown list-group-item list-group-item-action bg-light"><img src="{{ asset('img/enroll.png') }}">  Enroll Membership Fee <img src="{{ asset('img/arrowdown.png') }}" class="float-right"></a>
                <ul class="collapse list-unstyled" id="pageSubmenu2">
                    <li>
                                <a href="{{ route('gsenrollment.index') }}" class="list-group-item list-group-item-action bg-light">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="{{ asset('img/enroll.png') }}">  Grade School</a>
                    </li>

                    <li>
                                <a href="{{ route('hsenrollment.index') }}" class="list-group-item list-group-item-action bg-light">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="{{ asset('img/enroll.png') }}">  High School</a>
                    </li>

                    <li>
                                <a href="{{ route('bedenrollment.index') }}" class="list-group-item list-group-item-action bg-light">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="{{ asset('img/enroll.png') }}">  Basic Education</a>
                    </li>

                    <li>
                                <a href="{{ route('colenrollment.index') }}" class="list-group-item list-group-item-action bg-light">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="{{ asset('img/enroll.png') }}">  College</a>
                    </li>
                    <li>
                                <a href="{{ route('gedenrollment.index') }}" class="list-group-item list-group-item-action bg-light">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="{{ asset('img/enroll.png') }}">  Graduate Education</a>
                    </li>
{{--                     <li>
                                <a href="{{ route('hsmembership.index') }}" class="list-group-item list-group-item-action bg-light">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="{{ asset('img/program.png') }}">  HS Membership Fee</a>
                    </li>
                    <li>
                                <a href="{{ route('bedmembership.index') }}" class="list-group-item list-group-item-action bg-light">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="{{ asset('img/program.png') }}">  BED Membership Fee</a>
                    </li>
                    <li>
                                <a href="#" class="list-group-item list-group-item-action bg-light">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="{{ asset('img/program.png') }}">  College Membership Fee</a>
                    </li>
                    <li>
                                <a href="#" class="list-group-item list-group-item-action bg-light">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="{{ asset('img/program.png') }}">  GED Membership Fee</a>
                    </li> --}}
                </ul>





        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown list-group-item list-group-item-action bg-light"><img src="{{ asset('img/money.png') }}">  Manage Membership Fee <img src="{{ asset('img/arrowdown.png') }}" class="float-right"></a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li>
                                <a href="{{ route('gsmembership.index') }}" class="list-group-item list-group-item-action bg-light">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="{{ asset('img/program.png') }}">  Grade School</a>
                    </li>
                    <li>
                                <a href="{{ route('hsmembership.index') }}" class="list-group-item list-group-item-action bg-light">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="{{ asset('img/program.png') }}">  High School</a>
                    </li>
                    <li>
                                <a href="{{ route('bedmembership.index') }}" class="list-group-item list-group-item-action bg-light">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="{{ asset('img/program.png') }}">  Basic Education</a>
                    </li>
                    <li>
                                <a href="{{ route('colsemmembership.index') }}" class="list-group-item list-group-item-action bg-light">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="{{ asset('img/program.png') }}">  College Semester</a>
                    </li>
                    <li>
                                <a href="{{ route('coltrimembership.index') }}" class="list-group-item list-group-item-action bg-light">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="{{ asset('img/program.png') }}">  College Trimester</a>
                    </li>
                    <li>
                                <a href="{{ route('gedsemmembership.index') }}" class="list-group-item list-group-item-action bg-light">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="{{ asset('img/program.png') }}">  Graduate Education Semester</a>
                    </li>
                    <li>
                                <a href="{{ route('gedtrimembership.index') }}" class="list-group-item list-group-item-action bg-light">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="{{ asset('img/program.png') }}">  Graduate Education Trimester</a>
                    </li>
                    
{{--                     <li>
                                <a href="{{ route('hsmembership.index') }}" class="list-group-item list-group-item-action bg-light">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="{{ asset('img/program.png') }}">  HS Membership Fee</a>
                    </li>
                    <li>
                                <a href="{{ route('bedmembership.index') }}" class="list-group-item list-group-item-action bg-light">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="{{ asset('img/program.png') }}">  BED Membership Fee</a>
                    </li>
                    <li>
                                <a href="#" class="list-group-item list-group-item-action bg-light">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="{{ asset('img/program.png') }}">  College Membership Fee</a>
                    </li>
                    <li>
                                <a href="#" class="list-group-item list-group-item-action bg-light">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="{{ asset('img/program.png') }}">  GED Membership Fee</a>
                    </li> --}}
                </ul>
@can('admin')
        <a href="{{ route('membershipformula.index') }}" class="list-group-item list-group-item-action bg-light"><img src="{{ asset('img/formula.png') }}">  Manage Membership Formulas</a>
@endcan
        <a href="{{ route('billing.index') }}" class="list-group-item list-group-item-action bg-light"><img src="{{ asset('img/billing.png') }}">  Manage Membership Billing</a>

        <a href="{{ route('receipts.index') }}" class="list-group-item list-group-item-action bg-light"><img src="{{ asset('img/or.png') }}">  Manage Original Receipts</a>


{{--         <a href="#pageSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown list-group-item list-group-item-action bg-light"><img src="{{ asset('img/formula.png') }}">  Manage Membership Formula <img src="{{ asset('img/arrowdown.png') }}" class="float-right"></a>
                <ul class="collapse list-unstyled" id="pageSubmenu2">
                    <li>
                                <a href="{{ route('admin.membershipformula.gshsformula') }}" class="list-group-item list-group-item-action bg-light">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="{{ asset('img/program.png') }}">  GS & HS Membership Formula</a>
                    </li> --}}
{{--                     <li>
                                <a href="#" class="list-group-item list-group-item-action bg-light">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="{{ asset('img/program.png') }}">  BED Membership Formula</a>
                    </li>
                    <li>
                                <a href="#" class="list-group-item list-group-item-action bg-light">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="{{ asset('img/program.png') }}">  College Membership Formula</a>
                    </li>
                    <li>
                                <a href="#" class="list-group-item list-group-item-action bg-light">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="{{ asset('img/program.png') }}">  GED Membership Formula</a>
                    </li> --}}
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

{{--                             @can('admin-user')

                                    <a class=" dropdown-item" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    <a class=" dropdown-item" href="{{ route('admin.users.index') }}">{{ __('User Management') }}</a>
                                    @endcan --}}
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

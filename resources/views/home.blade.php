@extends('layouts.test')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card border-light mb-3 shadow">
                <h4 class="card-header bg-white">Dashboard</h4>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

  <div class="container">
    <h1 class="display-5">Welcome, {{Auth::user()->name}} </h1>
{{--     <p class="lead">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum..</p> --}}

{{--         <div id="chart_div" style="width: 100%; height: 500px;"></div> --}}
  </div>

                </div>
            </div>
        </div>
    </div>
{{--     <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Month', 'Usage'],
          ['January', 400],
          ['February', 460],
          ['March', 1120],
          ['April', 2120],
          ['May', 2520],
          ['June', 1120],
          ['July', 2120],
          ['August', 3120],
          ['September', 2120],
          ['October', 2820],
          ['November', 3120],
          ['December', 4160],
        ]);

        var options = {
          backgroundColor: '#ffffff',
          title: 'User Activity ',
          hAxis: {title: '2020',  titleTextStyle: {color: '#000'}},
          vAxis: {minValue: 0},
                     animation: {
          duration: 1000,
          easing: 'out',
          startup: true,
      },
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
        
        $(window).resize(function(){
  drawChart();

});
      }
    </script> --}}
@endsection

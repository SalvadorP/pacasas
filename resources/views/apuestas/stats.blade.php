@extends('app')

@section('content')
  <div class = "row">
    <div class = "col-sm-12">
      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title">Estadisticas</h3>
        </div>
        <div class="panel-body">
          <div id="stats1"></div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="https://www.google.com/jsapi"></script>
  <script>    
    // Load the Visualization API and the piechart package.
    google.load('visualization', '1.0', {'packages':['corechart']});

    // Set a callback to run when the Google Visualization API is loaded.
    google.setOnLoadCallback(drawChart);

    // Callback that creates and populates a data table,
    // instantiates the pie chart, passes in the data and
    // draws it.
    function drawChart() {
      // Create the data table.
      var data = google.visualization.arrayToDataTable([
      ['Users', 'Data', { role: 'style'}],
      <?php 
      foreach( $apuestas as $pos => $apuesta ) {
        $color = 'blue';
        if ($pos == 0) {
          $color = 'green';
        }
        if ($pos == (count($apuestas)-1)) {
          $color = 'red';
        }
        
        echo "['".$apuesta->name."', ".$apuesta->total.", '".$color."']";
        if ($pos < (count($apuestas)-1)) {
          echo ",";
        }        
      } ?>
      ]);
      // Set chart options
      var options = {'title':'Ganancias totales por usuario',
      'width':640,
      'height':480};

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.PieChart(document.getElementById('stats1'));
      chart.draw(data, options);
    }     
  </script>
@endsection

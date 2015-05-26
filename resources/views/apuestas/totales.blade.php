@extends('app')

@section('content')
  <div class = "row">
    <div class = "col-sm-12">
      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title" id = "title-total"></h3>
        </div>
        <div class="panel-body">
          @if ( !count($apuestas) )
            <p class = "lead text-danger">No hay apuestas</p>
          @else
          <?php $total = $redondeo = 0; ?>
            <table class = "table table-hover table-striped">
                <thead>
                  <tr>
                    <td>Usuario</td>
                    <td>Total</td>
                    <td>Redondeo</td>
                  </tr>
                </thead>
                <body>
                  @foreach( $apuestas as $nombre => $datos )
                  <tr>
                      <td>                        
                          {{ $nombre }}
                        </a>
                      </td>
                      <td>
                        {{ $datos['total'] }} € <?php $total += $datos['total']; ?>
                      </td>
                      <td>
                        {{ $datos['redondeo'] }} € <?php $redondeo += $datos['redondeo']; ?>
                      </td>                      
                    </tr>
                  @endforeach
                  <tfoot>
                    <tr class = "info">
                      <td><strong>TOTAL</strong></td>
                      <td><strong>{{ $total }} €</strong></td>
                      <td><strong>{{ $redondeo }} €</strong></td>
                    </tr>
                  </tfoot>
                </body>
            </table>
          @endif
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      $('#title-total').html('Apuestas {{$total}} €')
    });
  </script>
@endsection

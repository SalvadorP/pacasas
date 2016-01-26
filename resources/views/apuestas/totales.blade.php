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
                  @foreach( $apuestas as $pos => $datos )
                    <tr>
                      <?php 
                        $label = '';
                        if ($pos == 0) {
                          $label = 'text-success';
                        }
                        if ($pos == 6) {
                          $label = 'text-danger';
                        }
                      ?> 
                      <td class = "{{$label}}"> 
                        @if($pos == 0) <span class="glyphicon glyphicon-king" aria-hidden="true"></span> @endif
                        @if($pos == (count($apuestas)-1)) <span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span> @endif
                        {{ $datos->name }}
                      </td>
                      <td class = "{{$label}}">                        
                        {{ $datos->total }} € <?php $total += $datos->total; ?>
                      </td>
                      <td class = "{{$label}}">                        
                        {{ $datos->redondeo }} € <?php $redondeo += $datos->redondeo; ?>
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

@extends('app')

@section('content')
  <div class = "row">
    <div class = "col-sm-12">
      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title" id = "title-total"></h3>
        </div>
        <div class="panel-body">
          @if ( !$apuestas->count() )
            <p class = "lead text-danger">No hay apuestas</p>
          @else
          <?php $total = $redondeo = 0; ?>
            <table class = "table table-hover table-striped">
                <thead>
                  <tr>
                    <td>Usuario</td>
                    <td>Total</td>
                    <td>Redondeo</td>
                    <td>Fecha</td>
                    <td>Opciones</td>
                  </tr>
                </thead>
                <body>
                  @foreach( $apuestas as $apuesta )
                  <tr>
                      <td>
                        <a href="{{ route('apuestas.show', $apuesta->slug) }}">
                          {{ $apuesta->user->name }}
                        </a>
                      </td>
                      <td>
                        {{ $apuesta->total }} €<?php $total += $apuesta->total; ?>
                      </td>
                      <td>
                        {{ $apuesta->redondeo }} €<?php $redondeo += $apuesta->redondeo; ?>
                      </td>
                      <td>
                        {{ current(explode(' ', $apuesta->updated_at)) }}
                      </td>
                      <td>
                          {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE',
                            'route' => array('apuestas.destroy', $apuesta->slug))) !!}
                              <a class="btn btn-warning" href="/apuestas/{{$apuesta->id}}/edit">
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                              </a>
                              <button type = "submit" class = "btn btn-danger">
                                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                              </button>
                          {!! Form::close() !!}
                      </td>
                    </tr>
                  @endforeach
                  <tfoot>
                    <tr class = "info">
                      <td><strong>TOTAL</strong></td>
                      <td><strong>{{ $total }} €</strong></td>
                      <td><strong>{{ $redondeo }} €</strong></td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
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

@extends('app')

@section('content')
    <div class = "row">
      <div class = "col-sm-12">
        <h2>Apuestas</h2>
      </div>
    </div>
    <div class = "row">
    @if ( !$apuestas->count() )
        <div class = "col-sm-12">
          <p class = "lead text-danger">No hay apuestas</p>
        </div>
    @else
      <div class = "col-sm-12">
        <table class = "table table-hover table-striped">
            <head>
              <tr>
                <td>Usuario</td>
                <td>Total</td>
                <td>Redondeo</td>
                <td>Fecha</td>
                <td>Opciones</td>
              </tr>
            </head>
            <body>
              @foreach( $apuestas as $apuesta )
              <tr>
                  <td>
                    <a href="{{ route('apuestas.show', $apuesta->slug) }}">
                      {{ $apuesta->user->name }}
                    </a>
                  </td>
                  <td>
                    {{ $apuesta->total }}
                  </td>
                  <td>
                    {{ $apuesta->redondeo }}
                  </td>
                  <td>
                    {{ $apuesta->updated_at }}
                  </td>
                  <td>
                      {{ Form::open(array('class' => 'form-inline', 'method' => 'DELETE',
                        'route' => array('apuestas.destroy', $apuesta->slug))) }}
                          {{ link_to_route('apuestas.edit',
                              'Edit', array($apuesta->slug), array('class' => 'btn btn-info')) }}
                          {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                      {{ Form::close() }}
                  </td>
                </tr>
              @endforeach
            </body>
        </table>
      </div>
    @endif
  </div>
@endsection

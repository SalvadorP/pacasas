@extends('app')

@section('content')
    <div clas = "row">
      <div class = "col-sm-12">
        <div class="panel panel-info">
          <div class="panel-heading">
            <h3 class="panel-title">Editar Apuesta</h3>
          </div>
          <div class="panel-body">
            {!! Form::model($apuesta, ['method' => 'PATCH', 'route' => ['apuestas.update', $apuesta->slug], 'class' => 'form-horizontal']) !!}
                @include('apuestas/partials/_form', ['submit_text' => 'Editar Apuesta'])
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
@endsection

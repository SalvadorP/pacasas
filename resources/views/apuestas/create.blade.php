@extends('app')

@section('content')
  <div clas = "row">
    <div class = "col-sm-12">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">Crear Apuesta</h3>
        </div>
        <div class="panel-body">
          {!! Form::model(new App\Models\Apuestas, ['route' => ['apuestas.store'], 'class' => 'form-horizontal']) !!}
              @include('apuestas/partials/_form', ['submit_text' => 'Crear Apuesta'])
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@endsection

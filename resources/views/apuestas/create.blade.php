@extends('app')

@section('content')
  <div class = "row">
    <div class = "col-sm-12">
      <div class = "well"><h2>Crear Apuesta</h2></div>
    </div>
  </div>
  <div class = "row">
    <div class = "col-sm-12">
      <div class = "well bs-component">
        {{ Form::model(new App\Models\Apuestas, ['route' => ['apuestas.store'], 'class' => 'form-horizontal']) }}
            @include('apuestas/partials/_form', ['submit_text' => 'Crear Apuesta'])
        {{ Form::close() }}
      </div>
    </div>
  </div>
@endsection

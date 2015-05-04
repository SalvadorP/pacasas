@extends('app')

@section('content')
    <h2>Editar Apuesta</h2>
    {{ Form::model($apuesta, ['method' => 'PATCH', 'route' => ['apuestas.update', $apuesta->slug]]) }}
        @include('apuestas/partials/_form', ['submit_text' => 'Edit Apuesta'])
    {{ Form::close() }}
@endsection

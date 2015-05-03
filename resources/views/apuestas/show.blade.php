@extends('app')

@section('content')
    <h2>{{ $apuesta->total }}</h2>

    <p>
        {!! link_to_route('apuestas.index', 'volver a las Apuestas') !!} |
        {!! link_to_route('apuestas.create', 'Crear Apuesta', $apuesta->slug) !!}
    </p>
@endsection

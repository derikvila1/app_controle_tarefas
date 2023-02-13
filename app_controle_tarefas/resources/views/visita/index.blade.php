@extends('layouts.app')
@section('content')
    <?php
    $user = json_decode(AUTH::user()->roles);
    $type = $user->type;
    $spaces = $user->spaces;
    ?>

    <div>
        <a href="visita/create">
            Agendar visita
        </a>
        <a href="visita/show">
            Acessar visitas cadastradas
        </a>

        <p>
            {{ $type }}
        </p>
    </div>
@endsection

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

    <div class="card-body">
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Local da visita</th>
                                <th scope="col">Data da visita</th>
                                <th scope="col"> Horário</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($visitas as $key => $v)
                                <tr>
                                    <th scope="row">{{ $v['id'] }}</th>
                                    <td>{{ $v['spaceName'] }}</td>
                                    <td>{{ date('d/m/Y', strtotime($v['day'])) }}</td>
                                    <td>{{ $v['hour'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <nav>
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="{{ $visitas->previousPageUrl() }}">Voltar</a></li>

                            @for($i = 1; $i <= $visitas->lastPage(); $i++)
                                <li class="page-item {{ $visitas->currentPage() == $i ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $visitas->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor
                            
                            <li class="page-item"><a class="page-link" href="{{ $visitas->nextPageUrl() }}">Avançar</a></li>
                        </ul>
                    </nav>
                </div>

@endsection

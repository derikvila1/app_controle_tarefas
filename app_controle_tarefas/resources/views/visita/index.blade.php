@extends('layouts.app')
@section('content')
    <?php
    $user = json_decode(AUTH::user()->roles);
    $type = $user->type;
    $spaces = $user->spaces;
    ?>

    <div class="pl-5">
        <a href="visita/create" class="btn btn-outline-primary " role="button">Cadastrar Visita</a>

    </div>

    <div class="card-body">

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Local da visita</th>
                    <th scope="col">Data da visita</th>
                    <th scope="col"> Horário</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($visitas as $key => $v)
                    <tr>
                        <th scope="row">{{ $v['id'] }}</th>
                        <td>{{ $v['spaceName'] }}</td>
                        <td>{{ date('d/m/Y', strtotime($v['day'])) }}</td>
                        <td>{{ $v['hour'] }}</td>
                        <td>
                            @if ($v['status'] == 'pending')
                                <button type="button" class="btn btn-warning">Pendente</button>
                            @elseif($v['status'] == 'reviewed')
                                <button type="button" class="btn btn-info">Revisado</button>
                            @elseif($v['status'] == 'confirmed')
                                <button type="button" class="btn btn-success">Confirmado</button>
                            @else
                                <button type="button" class="btn btn-danger">Cancelado</button>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('visita.show', $v['id']) }}">Consultar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <nav>
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="{{ $visitas->previousPageUrl() }}">Voltar</a></li>

                @for ($i = 1; $i <= $visitas->lastPage(); $i++)
                    <li class="page-item {{ $visitas->currentPage() == $i ? 'active' : '' }}">
                        <a class="page-link" href="{{ $visitas->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor

                <li class="page-item"><a class="page-link" href="{{ $visitas->nextPageUrl() }}">Avançar</a></li>
            </ul>
        </nav>
    </div>
@endsection

@extends('layouts.app')
@section('content')
    <?php
    $user = json_decode(AUTH::user()->roles);
    $userId = json_decode(AUTH::user()->id);
    $type = $user->type;
    $spaces = $user->spaces;
    ?>
    <style>
        input[type='number'] {
            -moz-appearance: textfield;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
        }
    </style>
    <script>
        const userId = '<?php echo $userId; ?>';
        const userType = '<?php echo $type; ?>';
        const userSpaces = <?php echo json_encode($spaces); ?>;

        const buttonProps = {
            pending: {
                class: 'btn btn-warning',
                text: 'Pendente'
            },
            reviewed: {
                class: 'btn btn-info',
                text: 'Revisado'
            },
            confirmed: {
                class: 'btn btn-success',
                text: 'Confirmado'
            },
            canceled: {
                class: 'btn btn-danger',
                text: 'Cancelado'
            },
        }

        function validateId(value) {
            if (value < 0) {
                document.getElementById('id').value = value * (-1);
            }
        }

        function validateDatesBetween() {
            const dateStart = document.getElementById('datePickerStart');
            const dateEnd = document.getElementById('datePickerEnd');
            if ((dateStart.value > dateEnd.value) && dateEnd.value) {
                [dateStart.value, dateEnd.value] = [dateEnd.value, dateStart.value];
                return;
            }
            if (!dateStart.value && dateEnd.value) {
                [dateStart.value, dateEnd.value] = [dateEnd.value, dateStart.value];
                return;
            }
        }

        async function handleFilter() {
            validateDatesBetween();
            let form_data = new FormData(document.getElementById("formFilter"));
            let fieldsToRemove = [];
            for (let field of form_data.entries()) {
                if (field[1] === '' || field[1] === '-1') {
                    fieldsToRemove.push(field[0]);
                }
            }
            for (let field of fieldsToRemove) {
                form_data.delete(field);
            }

            for (let field of form_data.entries()) {
                console.log(field[0] + ' : ' + field[1]);
            }

            try {
                const response = await fetch('<?php echo route('filterVisit'); ?>', {
                    method: 'POST',
                    body: form_data,
                });
                const obj = await response.json();

                console.log(obj);

                updateTable(validateResponse(obj));

            } catch (err) {
                console.log(err)
            }

        }

        function validateResponse(obj) {
            if (obj.length > 0) {
                if (userType === 'user') {
                    return obj.filter(item => item.user_id == userId);
                }
                if (userType === 'admin') {
                    return obj.filter(item => userSpaces.includes(item.space_id) || item.user_id == userId);
                }
            }
            return obj;
        }

        function updateTable(visits) {
            const tblBody = document.getElementById("tableBody");
            while (tblBody.lastElementChild) {
                tblBody.removeChild(tblBody.lastElementChild);
            }
            if (visits.length > 0) {

                for (const visit of visits) {
                    const row = document.createElement("tr");
                    const fieldsToAdd = ['id', 'spaceName', 'day', 'hour', 'status']
                    for (const key of fieldsToAdd) {

                        if (key === 'status') {
                            const cell = document.createElement("td");
                            const button = document.createElement("button");
                            button.className = buttonProps[visit[key]].class;
                            button.innerHTML = buttonProps[visit[key]].text;
                            cell.appendChild(button);
                            row.appendChild(cell);
                            continue;
                        }

                        if (key === 'day') {
                            const cell = document.createElement("td");
                            const cellText = document.createTextNode(visit[key].split('-').reverse().join('/'));
                            cell.appendChild(cellText);
                            row.appendChild(cell);
                            continue;
                        }

                        const cell = document.createElement("td");
                        const cellText = document.createTextNode(visit[key]);
                        cell.appendChild(cellText);
                        row.appendChild(cell);


                    }
                    const cell = document.createElement("td");
                    const link = document.createElement("a");
                    link.href = `<?php echo route('visita.show', ''); ?>/${visit.id}`;
                    link.innerHTML = 'Consultar';
                    cell.appendChild(link);
                    row.appendChild(cell);

                    tblBody.appendChild(row);
                }
            }
        }
    </script>

    <div class="card-body">
        <a href="visita/create" class="btn btn-outline-primary " role="button">Cadastrar Visita</a>
        <form method="POST" id="formFilter" onsubmit="event.preventDefault(); handleFilter()"
            action="{{ route('filterVisit') }}" enctype="multipart/form-data">
            @csrf

            <h5>Filtros:</h5>
            <div class="mb-4">
                <p>Número do Registro:</p>
                <input id="id" type='number' class="form-control w-25" name="id"
                    onchange="validateId(this.value);">
            </div>

            <div class="mb-4">
                <p>Data:</p>

                <div class="d-flex flex-wrap mb-4">
                    <div class="border p-2 mr-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <label for="datePickerStart" class="form-label mr-2">Data início: </label>
                            <input id="datePickerStart" type="date" class="form-control w-auto" name="dayStart"
                                onchange="">
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <label for="datePickerEnd" class="form-label mr-2">Data fim: </label>
                            <input id="datePickerEnd" type="date" class="form-control w-auto" name="dayEnd"
                                onchange="">
                        </div>
                    </div>
                    <div class="border p-2 fit-content">
                        <div class="d-flex align-items-center justify-content-between">
                            <label for="dateMonth" class="form-label mr-2">Mês: </label>
                            <select id='stadateMonthtus' class="form-control" name="dateMonth">
                                <option value='-1'></option>
                                @for ($i = 1; $i < 13; $i++)
                                    <option value='{{ $i }}'>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <label for="dateYear" class="form-label mr-2">Ano: </label>
                            <select id='dateYear' class="form-control" name="dateYear">
                                <option value='-1'></option>
                                @for ($i = date('Y'); $i < date('Y') + 5; $i++)
                                    <option value='{{ $i }}'>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>
            </div>



            <div class="mb-4">
                <p>Status:</p>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id='pending' name="status[]" value='pending'>
                    {{-- <input class="form-check-input" type="checkbox" name='pending' id="pending" value=true> --}}
                    <label class="form-check-label" for="pending">PENDENTE</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id='reviewed' name="status[]" value='reviewed'>
                    {{-- <input class="form-check-input" type="checkbox" name='reviewed' id="reviewed" value=true> --}}
                    <label class="form-check-label" for="reviewed">REVISADO</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id='confirmed' name="status[]" value='confirmed'>
                    {{-- <input class="form-check-input" type="checkbox" name='confirmed' id="confirmed" value=true> --}}
                    <label class="form-check-label" for="confirmed">CONFIRMADO</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id='canceled' name="status[]" value='canceled'>
                    {{-- <input class="form-check-input" type="checkbox" name='canceled' id="canceled" value=true> --}}
                    <label class="form-check-label" for="canceled">CANCELADO</label>
                </div>

            </div>
            <button type='submit' class="btn btn-info hide-print">Filtrar</button>

        </form>
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

            <tbody id='tableBody'>
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

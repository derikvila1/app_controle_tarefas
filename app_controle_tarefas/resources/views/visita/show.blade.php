@extends('layouts.app')

@section('content')
    <style>
        @media print {
            .hide-print {
                display: none;
            }
        }
    </style>
    <?php
    $user = json_decode(AUTH::user()->roles);
    $userId = json_decode(AUTH::user()->id);
    $userType = $user->type;
   
    ?>
    <script>
        const spaces = <?php echo $spaces; ?>;
        const visita = <?php echo $visita; ?>;
        const userType = '<?php echo $userType; ?>';

        let spaceSelected;
        let hourSelection;
        let daySelected;

        window.addEventListener('DOMContentLoaded', async (event) => {
            if (visita) {
                console.log(visita);
                console.log(userType);
                if (!['canceled', 'pending'].includes(visita?.status) && userType === 'user') {
                    let opt = document.createElement('option');
                    opt.value = visita?.status;
                    opt.innerHTML = visita?.status === 'reviewed' ? "REVISADO" : "CONFIRMADO";
                    document.getElementById('status').appendChild(opt);
                }

                document.getElementById('status').value = visita?.status;
                document.getElementById('obs').value = visita?.obs || '';
                document.getElementById('space').value = visita?.space_id;
                document.getElementById('datePicker').value = visita?.day;
                spaceSelected = visita?.space_id;
                hourSelection = visita?.hour;
                await validateDatePicker(visita?.day, true);
                document.getElementById('hourInput').value = hourSelection;
                document.getElementById('peopleNumber').value = visita?.peopleNumber;
                document.getElementById('name').value = visita?.name;
                document.getElementById('grade').value = visita?.grade;
                document.getElementById('ageInput').value = visita?.age;
                document.getElementById('pcdCheckBox').checked = visita?.pcd;
                document.getElementById('pcdType').value = visita?.pcdType;
                document.getElementById('datePicker').disabled = false;

                if (userType === 'user') {
                    document.getElementById('status').disabled = true;
                    document.getElementById('obs').disabled = true;
                    document.getElementById('space').disabled = true;
                    document.getElementById('datePicker').disabled = true;
                    document.getElementById('hourInput').disabled = true;
                    document.getElementById('peopleNumber').disabled = true;
                    document.getElementById('name').disabled = true;
                    document.getElementById('grade').disabled = true;
                    document.getElementById('ageInput').disabled = true;
                    document.getElementById('pcdCheckBox').disabled = true;
                    document.getElementById('pcdType').disabled = true;
                }
            }

        });

        function handleSubmit() {
            let form = document.getElementById('formVisita');
            form.submit();
        }

        function validateDatePicker(date, avoidValidation = false) {
            let errorSpan = document.getElementById('dateError')
            let hourInput = document.getElementById('hourInput')

            while (hourInput.lastElementChild) {
                hourInput.removeChild(hourInput.lastElementChild);
            }
            let opt = document.createElement('option');
            opt.value = -1;
            hourInput.appendChild(opt);

            const spaceSchedules = JSON.parse(spaces[spaceSelected].schedules);
            const dayOfWeek = new Date(date).getDay();
            const hoursAvailable = spaceSchedules.find(value => value.day === dayOfWeek);

            if (!avoidValidation && (!hoursAvailable || (new Date(date) - Date.now() <= 0))) {
                errorSpan.classList.remove("d-none");
                hourInput.disabled = true;
                hourSelection = undefined;
                return;
            }

            errorSpan.classList.add("d-none");
            hourInput.disabled = false

            for (let i = hoursAvailable.firstHour; i <= hoursAvailable.lastHour; i++) {
                opt = document.createElement('option');
                opt.value = `${i}:00`;
                opt.innerHTML = `${i}:00`;
                hourInput.appendChild(opt);
            }
        }

        function spaceSelection(spaceId) {

            let datePicker = document.getElementById('datePicker');
            let hourInput = document.getElementById('hourInput');

            spaceSelected = spaceId;
            if (spaceSelected !== '-1') {
                datePicker.disabled = false;
                validateDatePicker(datePicker.value);
                return;
            }
            datePicker.disabled = true;
            datePicker.value = '';
            hourInput.disabled = true;
            hourInput.value = '-1';
        }

        function validateNumber(value, inputId) {
            let inputNumber = document.getElementById(inputId);
            if (value < 1) {
                inputNumber.value = 1
            }
        }

        function validateSubmit() {
            if (!hourSelection) {
                alert('Preencha todos os campos para continuar!');
                return;
            }
            document.getElementById("formVisita").submit();
        }

        function printPage() {
            print(document);
        }

        function cancelRequest() {
            window.location.href = '<?php echo route('cancelById', $visita->id); ?>';
        }
    </script>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Acompanhar Solicitação de Visita</div>

                    <form method="POST" id="formVisita" action="{{ route('visita.update', $visita->id) }}"
                        onsubmit="event.preventDefault(); validateSubmit();" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="card-body">

                            <div class="mb-3">
                                <label class="form-label">Código de Registro: </label>
                                <h5>{{ $visita->id }} </h5>
                            </div>

                            <div class="mb-3">
                                <label for="status">Status da solicitação:</label>
                                <select id='status' class="form-control" name="status">
                                    <option value='pending'>PENDENTE</option>
                                    @if ($userType === 'reviewer')
                                        <option value='reviewed'>REVISADO</option>
                                        <option value='canceled'>CONCELADO</option>
                                    @endif
                                    @if ($userType === 'admin')
                                        <option value='confirmed'>CONFIRMADO</option>
                                        <option value='canceled'>CONCELADO</option>
                                    @endif

                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="obs">Observação:</label>
                                <textarea class="form-control" id="obs" name="obs"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="space">Espaços Culturais:</label>
                                <select id='space' class="form-control" name="space"
                                    onchange='spaceSelection(this.value)' required>
                                    <option value='-1'></option>

                                    @foreach ($spaces as $space)
                                        <option value={{ $space->id }}>{{ $space->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Data da Visita: </label>
                                <span class="d-none text-danger" id="dateError">Não haverá funcionamento na data
                                    selecionada!</span>
                                <input id="datePicker" disabled type="date" class="form-control" name="day" required
                                    onchange="validateDatePicker(this.value)">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Horário da Visita:</label>
                                <select id='hourInput' disabled class="form-control" name="hour" required
                                    onchange="hourSelection=this.value">
                                    <option value="-1"></option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Quantidade de pessoas:</label>
                                <input id="peopleNumber" type="number" class="form-control" name="peopleNumber"
                                    onchange="validateNumber(this.value,'peopleNumber')" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nome do Responsável: </label>
                                <input id='name' type="text" class="form-control" name="name" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Série : </label>
                                <input id='grade' type="text" class="form-control" name="grade" required>
                            </div>


                            <div class="mb-3">
                                <label class="form-label">Idade :</label>
                                <input id="ageInput" type="number" class="form-control" name="age" required
                                    onchange="validateNumber(this.value,'ageInput')">
                            </div>

                            <div class="mb-3">
                                <label for="formFile" class="form-label">Declaração do diretor: </label>
                                <a href="{{route('showFile',$visita->id)}}" class="list-group-item list-group-item-action">Declaração</a>

                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="pcdCheckBox">
                                    Pessoa com deficienciência:
                                </label>
                                <br>
                                <input type="checkbox" class="form-check-input ml-1 " id="pcdCheckBox" name='pcd'>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Especifique a necessidade : </label>
                                <input id="pcdType" type="text" class="form-control" name="pcdType">
                            </div>


                        </div>

                    </form>
                    <div class="card-footer d-flex w-100 justify-content-around">
                        @if ($userType === 'user')
                            <button onclick="cancelRequest()" class="btn btn-danger hide-print"> Solicitar cancelamento
                            </button>
                        @else
                            <button onclick="handleSubmit()" class="btn btn-info hide-print">Editar</button>
                        @endif

                        <input class="btn btn-primary hide-print" type="button" value="Imprimir" name="print"
                            onclick="printPage()" />
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection

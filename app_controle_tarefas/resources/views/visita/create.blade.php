@extends('layouts.app')

@section('content')
    <script>
        const spaces = <?php echo $spaces; ?>;
        let spaceSelected;
        let hourSelection;

        function validateDatePicker(date) {
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

            if (!hoursAvailable || (new Date(date) - Date.now() <= 0)) {
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
    </script>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Agendar Visita</div>

                    <div class="card-body">
                        <form method="post" id="formVisita" action="{{ route('visita.store') }}"
                            onsubmit="event.preventDefault(); validateSubmit();" enctype="multipart/form-data">
                            @csrf
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
                                <script></script>
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
                                <input type="text" class="form-control" name="name" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Série : </label>
                                <input type="text" class="form-control" name="grade" required>
                            </div>


                            <div class="mb-3">
                                <label class="form-label">Idade :</label>
                                <input id="ageInput" type="number" class="form-control" name="age" required
                                    onchange="validateNumber(this.value,'ageInput')">
                            </div>

                            <div class="mb-3">
                                <label for="formFile" class="form-label">Declaração do diretor: </label>
                                <input name='file' class="form-control" type="file" id="formFile" accept=".pdf"
                                    required>
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
                                <input type="text" class="form-control" name="pcdType">
                            </div>

                            <button type="submit" class="btn btn-primary">Cadastrar</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

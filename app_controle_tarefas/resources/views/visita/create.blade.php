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

            const spaceSchedules = JSON.parse(spaces.find(item => item.id == spaceSelected)?.schedules);
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
                                <label for="space">Espa??os Culturais:</label>
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
                                <span class="d-none text-danger" id="dateError">N??o haver?? funcionamento na data
                                    selecionada!</span>
                                <input id="datePicker" disabled type="date" class="form-control" name="day" required
                                    onchange="validateDatePicker(this.value)">
                                <script></script>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Hor??rio da Visita:</label>
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
                                <label class="form-label">Nome do Respons??vel: </label>
                                <input type="text" class="form-control" name="name" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">S??rie : </label>
                                <input type="text" class="form-control" name="grade" required>
                            </div>


                            <div class="mb-3">
                                <label class="form-label">Idade :</label>
                                <!-- <input id="ageInput" type="number" class="form-control" name="age" required
                                    onchange="validateNumber(this.value,'ageInput')"> -->
                                <select id='ageInput' class="form-control" name="age" required>
                                    <option value="4 a 6 anos">4 a 6 anos</option>
                                    <option value="7 a 10 anos">7 a 10 anos</option>
                                    <option value="11 a 15 anos">11 a 15 anos</option>
                                    <option value="a partir de 16 anos">a partir de 16 anos</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="formFile" class="form-label">Deseja solicitar que junto ?? visita seja realizado um dos projetos educativos?  </label>
                                <h6>(Obs.: Os projetos educativos abaixo s??o desenvolvidos nos espa??os: Pal??cio Rio Negro e Centro Cultural dos Povos da Amaz??nia)</h6>
                                <select id='ageInput' class="form-control" name="age" required>
                                    <option value="?? hora de Brincar">?? hora de Brincar</option>
                                    <option value="Piquenique no jardim">Piquenique no jardim</option>
                                    <option value="Somente visita educativa">Somente visita educativa</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="formFile" class="form-label">Anexar of??cio da institui????o solicitando a visita: </label>
                                <h6>Endere??ar ao Sr. Marcos Apolo Muniz - Secret??rio de Cultura e Economia Criativa</h6>
                                <input name='file' class="form-control" type="file" id="formFile" accept=".pdf"
                                    required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="pcdCheckBox">
                                    O grupo possui visitante com defici??ncia? Qual?:
                                </label>
                                <div class="col-md-5">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Defici??ncia Visual
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                <label class="form-check-label" for="flexCheckChecked">
                                Defici??ncia Motora
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                <label class="form-check-label" for="flexCheckChecked">
                                Defici??ncia Auditiva
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                <label class="form-check-label" for="flexCheckChecked">
                                Defici??ncia Cerebral
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                <label class="form-check-label" for="flexCheckChecked">
                                Defici??ncia M??ltipla	
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                <label class="form-check-label" for="flexCheckChecked">
                                Outros
                                </label>
                            </div>
                        </div>
                          
                            </div>


                            <div class="mb-3">
                                <label class="form-label">Algum pedido em especial? Exemplo: visita educativa em outro idioma, visita t??cnica para conhecer a parte arquitet??nica do
                                espa??o, conhecer a reserva t??cnica/acervo, visita educativa e assistir o ensaio da Orquestra, espa??o para a turma lanchar ou
                                outros. </label>
                                <input type="text" class="form-control" name="name" required>
                            </div>

            
                            <button type="submit" class="btn btn-primary">Cadastrar</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

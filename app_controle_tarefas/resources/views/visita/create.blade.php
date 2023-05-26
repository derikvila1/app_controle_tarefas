@extends('layouts.app')

@section('content')
    <script>
        const spaces = <?php echo $spaces; ?>;
        const visitas = <?php echo $visitas; ?>;
        let spaceSelected;
        let hourSelection;

        console.log(visitas);

        function validateDatePicker(date) {
            let errorSpan = document.getElementById('dateError')
            let hourInput = document.getElementById('hourInput')
            let spaceSelection = document.getElementById('space').value;
           if(date){

               
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


            console.log(spaceSelection);
            console.log(date);


            displayHour(spaceSelection,date);


            // for (let i = hoursAvailable.firstHour; i <= hoursAvailable.lastHour; i++) {
            //     opt = document.createElement('option');
            //     opt.value = `${i}:00`;
            //     opt.innerHTML = `${i}:00`;
            //     if(opt.value == '12:00' ){
                    
            //     }
              
            //     else{
            //         hourInput.appendChild(opt);
            //     }
            // }
        }
        
        }

        function displayHour(spaceSelection,date){
          console.log(visitas[0].day);
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
            if (value > 40 && inputId === 'peopleNumber') {
                inputNumber.value = 40
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
                                    onchange="validateDatePicker(this.value)"
                                   >
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
                                <label class="form-label">{{ __('Telefone para contato :') }}</label>
                                <input type="text" class="form-control" name="cellphone" required>

                               
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Série / Ano : </label>
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
                                <label for="formFile" class="form-label">Deseja solicitar que junto à visita seja realizado
                                    um dos projetos educativos? </label>
                                <h6>(Obs.: Os projetos educativos abaixo são desenvolvidos nos espaços: Palácio Rio Negro e
                                    Centro Cultural dos Povos da Amazônia)</h6>
                                <select id='project' class="form-control" name="project" required>
                                    <option value="Somente visita educativa">Somente visita educativa</option>
                                    <option value="É hora de Brincar">É hora de Brincar</option>
                                    <option value="Piquenique no jardim">Piquenique no jardim</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="formFile" class="form-label">Anexar ofício da instituição solicitando a visita:
                                </label>
                                <h6>Endereçar ao Sr. Marcos Apolo Muniz - Secretário de Cultura e Economia Criativa</h6>
                                <input name='file' class="form-control" type="file" id="formFile" accept=".pdf"
                                    required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="pcdCheckBox">
                                    O grupo possui visitante com deficiência? Qual?:
                                </label>
                                <div class="col-md-5">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="visual" id="visual"
                                            name="pcdType[]">
                                        <label class="form-check-label" for="visual">
                                            Deficiência Visual
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="motora" id="motora"
                                            name="pcdType[]">
                                        <label class="form-check-label" for="motora">
                                            Deficiência Motora
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="auditiva" id="auditiva"
                                            name="pcdType[]">
                                        <label class="form-check-label" for="auditiva">
                                            Deficiência Auditiva
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="cerebral" id="cerebral"
                                            name="pcdType[]">
                                        <label class="form-check-label" for="cerebral">
                                            Deficiência Cerebral
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="multipla" id="multipla"
                                            name="pcdType[]">
                                        <label class="form-check-label" for="multipla">
                                            Deficiência Múltipla
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="outros" id="outros"
                                            name="pcdType[]">
                                        <label class="form-check-label" for="outros">
                                            Outros
                                        </label>
                                    </div>
                                </div>

                            </div>


                            <div class="mb-3">
                                <label class="form-label">Algum pedido em especial? Exemplo: visita educativa em outro
                                    idioma, visita técnica para conhecer a parte arquitetônica do
                                    espaço, conhecer a reserva técnica/acervo, visita educativa e assistir o ensaio da
                                    Orquestra, espaço para a turma lanchar ou
                                    outros. </label>
                                <input type="text" class="form-control" name="obs" required>
                            </div>


                            <button type="submit" class="btn btn-primary">Cadastrar</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

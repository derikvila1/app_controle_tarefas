@extends('layouts.app')

@section('content')
    <script>
        function validateDatePicker(e) {
            let errorSpan = document.getElementById('dateError')
            if (new Date(e.value).getDay() === 0) {
                errorSpan.classList.remove("d-none");
            } else {
                errorSpan.classList.add("d-none");
            }
        }
    </script>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Agendar Visita</div>

                    <div class="card-body">
                        <form method="post" action="{{ route('visita.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="spaceName">Espaços Culturais:</label>
                                <select class="form-control" name="spaceName">
                                    <option value="Centro Cultural dos Povos da Amazônia">Centro Cultural dos Povos da
                                        Amazônia </option>
                                    <option value="Palacete Provincial">Palacete Provincial</option>
                                    <option value="Centro Cultural Palácio Rio Negro">Centro Cultural Palácio Rio Negro
                                    </option>
                                    <option value="Galeria do Largo">Galeria do Largo</option>
                                    <option value="Casa das Artes">Casa das Artes</option>
                                    <option value="Centro Cultural Palácio da Justiça">Centro Cultural Palácio da Justiça
                                    </option>
                                    <option value="Teatro Amazonas">Teatro Amazonas</option>
                                    <option value="Museu Seringal Vila Paraiso">Museu Seringal Vila Paraiso</option>
                                    <option value="Parques Culturais - Rio Negro ou Jefferson Peres">Parques Culturais - Rio
                                        Negro ou Jefferson Peres</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Data da Visita: </label>
                                <span class="d-none text-danger" id="dateError">Eventos não disponíveis às
                                    segundas-feiras</span>
                                <input id="datePicker" type="date" class="form-control" name="day" required
                                    onchange="validateDatePicker(this)">
                                <script></script>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Horário da Visita:</label>
                                <select class="form-control" name="hour" required>
                                    <option value="8:00">8:00</option>
                                    <option value="9:00">9:00</option>
                                    <option value="10:00">10:00</option>
                                    <option value="11:00">11:00</option>
                                    <option value="12:00">12:00</option>
                                    <option value="13:00">13:00</option>
                                    <option value="14:00">14:00</option>
                                    <option value="15:00">15:00</option>
                                    <option value="16:00">16:00</option>
                                    <option value="17:00">17:00</option>
                                    <option value="18:00">18:00</option>
                                    <option value="19:00">19:00</option>
                                    <option value="20:00">20:00</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Quantidade de pessoas:</label>
                                <input type="number" class="form-control" name="peopleNumber" required>
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
                                <input type="number" class="form-control" name="age" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="pcdCheckBox">
                                    Pessoa com deficienciência:
                                </label>
                                <br>
                                <input type="checkbox" class="form-check-input ml-1 " value="" id="pcdCheckBox">
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

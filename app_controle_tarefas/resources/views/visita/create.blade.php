@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Agendar Visita</div>

                <div class="card-body">
                    <form method="post" action="{{ route('visita.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="address" >Espaços Culturais</label>
                            <select class="form-control" name="address" >
                                <option value="Centro Cultural dos Povos da Amazônia">Centro Cultural dos Povos da Amazônia </option>
                                <option value="Palacete Provincial">Palacete Provincial</option>
                                <option value="Centro Cultural Palácio Rio Negro">Centro Cultural Palácio Rio Negro</option>
                                <option value="Galeria do Largo">Galeria do Largo</option>
                                <option value="Casa das Artes">Casa das Artes</option>
                                <option value="Centro Cultural Palácio da Justiça">Centro Cultural Palácio da Justiça</option>
                                <option value="Teatro Amazonas">Teatro Amazonas</option>
                                <option value="Museu Seringal Vila Paraiso">Museu Seringal Vila Paraiso</option>
                                <option value="Parques Culturais - Rio Negro ou Jefferson Peres">Parques Culturais - Rio Negro ou Jefferson Peres</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Data da Visita</label>
                            <input type="date" class="form-control" name="day" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Horário da Visita</label>
                            <select class="form-control" name="horario" required>
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
                            <input type="number" class="form-control" name="participantes"  required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nome do Responsável: </label>
                            <input type="text" class="form-control" name="name" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Série : </label>
                            <input type="text" class="form-control" name="série" required>
                        </div>


                        <div class="mb-3">
                            <label class="form-label">Idade :</label>
                            <input type="number" class="form-control" name="idade"  required>
                        </div>





                        <button type="submit" class="btn btn-primary">Cadastrar</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

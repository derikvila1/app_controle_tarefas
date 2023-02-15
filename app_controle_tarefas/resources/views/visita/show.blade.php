@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-body">
                  
                            <div class="mb-3">
                                <label for="space">Espaço Solicitado:</label>
                                <h1>{{$visita->spaceName}}</h1>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Data da Visita: </label>
                                <h1>{{$visita->day}}</h1>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Horário da Visita:</label>
                                <h1>{{$visita->hour}}</h1>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Quantidade de pessoas:</label>
                                <h1>{{$visita->peopleNumber}}</h1>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nome do Responsável: </label>
                                <h1>{{$visita->name}}</h1>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Série : </label>
                                <h1>{{$visita->grade}}</h1>
                            </div>


                            <div class="mb-3">
                                <label class="form-label">Idade :</label>
                                <h1>{{$visita->age}}</h1>
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="pcdCheckBox">
                                    Pessoa com deficienciência:
                                </label>
                                @if ($visita->pcd)
                                    <h1>Sim</h1>
                                @else
                                    <h1>Não</h1>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Especifique a necessidade : </label>
                                <h1>{{$visita->pcdType}}</h1>
                            </div>
                            <script language = "javascript">
                                function imprime (text){
                                    text=document
                                    print(text)
                                }

                            </script>

                            <form action="">
                                <input type="button" value="imprimir" name="imprimir" onclick="imprime()"/>
                            </form>

                  
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

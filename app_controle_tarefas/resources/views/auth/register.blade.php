@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Nome da Instituição') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="gestorName"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Nome do Gestor') }}</label>

                                <div class="col-md-6">
                                    <input id="gestorName" type="text"
                                        class="form-control @error('gestorName') is-invalid @enderror" name="gestorName"
                                        value="{{ old('gestorName') }}" required autocomplete="gestorName" autofocus>

                                    @error('gestorName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- endereço -->
                            <div class="form-group row">
                                <label for="address"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Endereço') }}</label>

                                <div class="col-md-6">
                                    <input id="address" type="address"
                                        class="form-control @error('address') is-invalid @enderror" name="address"
                                        value="{{ old('address') }}" required autocomplete="address">

                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- end endereço -->

                            <!-- zona -->
                            <div class="form-group row">
                                <label for="zone"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Zona') }}</label>
                                <div class="col-md-6">
                                    <select id="zone" name="zone" class="form-control"
                                        aria-label="Default select example">
                                        <option selected>Selecione uma zona</option>
                                        <option value="Norte">Norte</option>
                                        <option value="Leste">Leste</option>
                                        <option value="Oeste">Oeste</option>
                                        <option value="Sul">Sul</option>
                                        <option value="Centro-Sul">Centro-Sul</option>
                                        <option value="Centro-Oeste">Centro-Oeste</option>
                                    </select>
                                </div>

                            </div>

                            <!-- end zona -->


                            <!-- tipo de instituição -->
                            <div class="form-group row">
                                <label for="institutionType" class="col-md-4 col-form-label text-md-right">
                                    {{ __('Tipo de Instituição') }}</label>
                                <div class="col-md-6">
                                    <select id="institutionType" name="institutionType" class="form-control"
                                        aria-label="Default select example">
                                        <option selected>Selecione um tipo de instituição</option>
                                        <option value="Escola Pública">Escola Pública</option>
                                        <option value="Escola Privada">Escola Privada</option>
                                    </select>
                                </div>
                            </div>
                            <!-- end tipo de instituição -->
                            <!-- Publico atendido -->
                            <div class="form-group row">
                                <label for="publicType" class="col-md-4 col-form-label text-md-right">
                                    {{ __('Público Atendido') }}</label>
                                <div class="col-md-2">
                                    <div class="form-check">
                                        <input class="form-check-input" value=1 type="checkbox" id="publicTypeKids"
                                            name="publicTypeKids" checked>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Crianças
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" value=1 type="checkbox" id="publicTypeYoungs"
                                            name="publicTypeYoungs">
                                        <label class="form-check-label" for="flexCheckChecked">
                                            Jovens
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" value=1 type="checkbox" id="publicTypeAdults"
                                            name="publicTypeAdults">
                                        <label class="form-check-label" for="flexCheckChecked">
                                            Adultos
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" value=1 type="checkbox" id="publicTypeOlds"
                                            name="publicTypeOlds">
                                        <label class="form-check-label" for="flexCheckChecked">
                                            Idosos
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- end publico atendido -->

                            <div class="form-group row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="cellphone"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Telefone') }}</label>

                                <div class="col-md-6">
                                    <input id="cellphone" type="tel"
                                        class="form-control @error('cellphone') is-invalid @enderror" name="cellphone"
                                        value="{{ old('cellphone') }}" required autocomplete="cellphone">

                                    @error('cellphone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Senha') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Confirme a Senha') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Cadastrar novo usuário') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

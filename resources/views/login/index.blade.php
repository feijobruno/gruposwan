@extends('layouts.login')

@section('content')
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">

            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <div class="mx-auto mt-3 mb-3" style="width: 70%;">
                                        <img src="{{ asset('img/logo.png') }}" class="img-fluid" alt="...">
                                        {{-- <h4 class="text-center font-weight-light my-4">Área Restrita</h4> --}}
                                    </div>   
                                </div>   
                                <div class="card-body">
                                    <x-alert />
                                    <form action="{{ route('login.process') }}" method="POST">
                                        @csrf
                                        @method('POST')                                        

                                        <div class="form-floating mb-3">
                                            <input type="email" name="email" class="form-control" id="email" placeholder="Digite o e-mail de usuário" value="{{ old('email') }}">                                            <label for="email">E-mail</label>
                                            <label for="email">E-mail</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="password" name="password" class="form-control" id="password" placeholder="Digite a senha">
                                            <label for="password">Senha</label>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a href="{{ route('forgot-password.show') }}" class="small text-decoration-none">¿Olvidaste tu contraseña?</a>
                                            <button type="submit" class="btn btn-primary">Acceder</button>
                                        </div>

                                    </form>
                                </div>

                                <div class="card-footer text-center py-3">
                                    <div class="small">
                                        ¿Necesitas acceso? <a href="{{ route('login.create-user') }}" class="text-decoration-none">¡Inscribirse!</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection

@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 space-between-elements">
            <ol class="breadcrumb mb-3 mt-3">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('user.index') }}">Usuarios</a></li>
                <li class="breadcrumb-item active">Añadir</li>
            </ol>
        </div>

        <div class="card mb-4">
            <div class="card-header space-between-elements">
                <span>Nuevo usuario</span>
                {{-- <span class="d-flex">

                    @can('index-user')
                        <a href="{{ route('user.index') }}" class="btn btn-info btn-sm me-1"><i class="fa-solid fa-list"></i>
                            Listado</a>
                    @endcan

                </span> --}}
            </div>
            <div class="card-body">

                <x-alert />

                <form action="{{ route('user.store') }}" method="POST" class="row g-3">
                    @csrf
                    @method('POST')

                    <div class="col-12">
                        <label for="name" class="form-label">Nome: </label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Nome completo"
                            value="{{ old('name') }}">
                    </div>

                    <div class="col-12">
                        <label for="email" class="form-label">E-mail: </label>
                        <input type="email" name="email" id="email" class="form-control"
                            placeholder="Melhor e-mail do usuário" value="{{ old('email') }}">
                    </div>

                    <div class="col-12">
                        <label for="password" class="form-label">Senha: </label>
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="Senha com no mínimo 6 caracteres" value="{{ old('password') }}">
                    </div>

                    <div class="col-12">
                        <label for="roles" class="form-label">Papel: </label>
                        <select name="roles" class="form-select select2" id="roles">
                            <option value="">Selecione</option>
                            @forelse ($roles as $role)
                                @if ($role != "Super Admin")
                                    <option value="{{ $role }}" {{ old('roles') == $role ? 'selected' : ''}}>{{ $role }} </option>
                                @else
                                    @if (Auth::user()->hasRole('Super Admin'))
                                        <option value="{{ $role }}" {{ old('roles') == $role ? 'selected' : ''}}>{{ $role }} </option>
                                    @endif
                                @endif
                            @empty
                                
                            @endforelse
                        </select>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary bt-sm"><i class="fa-solid fa-plus"></i> Añadir</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection

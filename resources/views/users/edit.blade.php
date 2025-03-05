@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 space-between-elements">
            <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('user.index') }}">Usuários</a></li>
                <li class="breadcrumb-item active">{{ $user->name }}</li>
            </ol>
        </div>

        <div class="card mb-4">
            <div class="card-header space-between-elements">
                   <span class="d-flex">

                    @can('index-user')
                        <a href="{{ route('user.index') }}" class="btn btn-secondary btn-sm me-1"><i class="fa-solid fa-list"></i>
                            Listado</a>
                    @endcan

                    @can('show-user')
                        <a href="{{ route('user.show', ['user' => $user->id]) }}" class="btn btn-secondary btn-sm me-1"><i
                                class="fa-regular fa-eye"></i> Vista
                        </a>
                    @endcan

                    @can('destroy-user')
                        <form id="formDelete{{ $user->id }}" method="POST" action="{{ route('user.destroy', ['user' => $user->id]) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-secondary btn-sm me-1 btnDelete" data-delete-id="{{ $user->id }}"><i
                                    class="fa-regular fa-trash-can"></i> Apagar</button>
                        </form>
                    @endcan

                </span>
            </div>
            <div class="card-body">

                <x-alert />

                <form action="{{ route('user.update', ['user' => $user->id]) }}" method="POST" class="row g-3">
                    @csrf
                    @method('PUT')

                    <div class="col-12">
                        <label for="name" class="form-label">Nombre: </label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Nome completo"
                            value="{{ old('name', $user->name) }}">
                    </div>

                    <div class="col-12">
                        <label for="email" class="form-label">E-mail: </label>
                        <input type="email" name="email" id="email" class="form-control"
                            placeholder="Melhor e-mail do usuário" value="{{ old('email', $user->email) }}">
                    </div>

                    <div class="col-12">
                        <label for="roles" class="form-label">Papel: </label>
                        <select name="roles" class="form-select select2" id="roles">
                            <option value="">Selecione</option>
                            @forelse ($roles as $role)
                                @if ($role != "Super Admin")
                                    <option value="{{ $role }}" {{ old('roles') == $role || $role == $userRoles ? 'selected' : ''}}>{{ $role }} </option>
                                @else
                                    @if (Auth::user()->hasRole('Super Admin'))
                                        <option value="{{ $role }}" {{ old('roles') == $role || $role == $userRoles ? 'selected' : ''}}>{{ $role }} </option>
                                    @endif
                                @endif
                            @empty
                                
                            @endforelse
                        </select>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary bt-sm"><i class="fa-regular fa-floppy-disk"></i> Guardar</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection

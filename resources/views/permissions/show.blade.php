@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 space-between-elements">

            <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('permission.index') }}" class="text-decoration-none">Permisos</a></li>
                <li class="breadcrumb-item active">{{ $permission->title }}</li>
            </ol>
        </div>

        <div class="card mb-4">

            <div class="card-header hstack gap-2">
                <span>Visualizar</span>

                <span class="ms-auto d-sm-flex flex-row">

                    @can('index-permission')
                        <a href="{{ route('permission.index') }}" class="btn btn-secondary btn-sm me-1 mb-1 mb-sm-0"><i
                                class="fa-solid fa-list"></i> Listado</a>
                    @endcan

                    @can('edit-permission')
                        <a href="{{ route('permission.edit', ['permission' => $permission->id]) }}"
                            class="btn btn-secondary btn-sm me-1 mb-1 mb-sm-0"><i class="fa-regular fa-pen-to-square"></i>
                            Editar</a>
                    @endcan

                    @can('destroy-permission')
                        <form action="{{ route('permission.destroy', ['permission' => $permission->id]) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-secondary btn-sm"
                                onclick="return confirm('Tem certeza que deseja apagar este registro?')"><i
                                    class="fa-regular fa-trash-can"></i> Apagar</button>
                        </form>
                    @endcan

                </span>
            </div>

            <div class="card-body">

                <x-alert />

                <dl class="row">

                    <dt class="col-sm-3">ID: </dt>
                    <dd class="col-sm-9">{{ $permission->id }}</dd>

                    <dt class="col-sm-3">Título: </dt>
                    <dd class="col-sm-9">{{ $permission->title }}</dd>

                    <dt class="col-sm-3">Nome: </dt>
                    <dd class="col-sm-9">{{ $permission->name }}</dd>

                    <dt class="col-sm-3">Cadastrado: </dt>
                    <dd class="col-sm-9">
                        {{ \Carbon\Carbon::parse($permission->created_at)->tz('America/Sao_Paulo')->format('d/m/Y H:i:s') }}
                    </dd>

                    <dt class="col-sm-3">Editado: </dt>
                    <dd class="col-sm-9">
                        {{ \Carbon\Carbon::parse($permission->updated_at)->tz('America/Sao_Paulo')->format('d/m/Y H:i:s') }}
                    </dd>

                </dl>

            </div>
        </div>

    </div>
@endsection

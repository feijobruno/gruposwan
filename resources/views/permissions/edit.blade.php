@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 space-between-elements">

            <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('permission.index') }}" class="text-decoration-none">Perfil</a></li>
                <li class="breadcrumb-item active">Permiso</li>
            </ol>
        </div>


        <div class="card mb-4">

            <div class="card-header hstack gap-2">
                <span>Editar</span>

                <span class="ms-auto d-sm-flex flex-row">

                    @can('index-permission')
                        <a href="{{ route('permission.index') }}" class="btn btn-secondary btn-sm me-1 mb-1 mb-sm-0"><i
                                class="fa-solid fa-list"></i> Listado</a>
                    @endcan

                    @can('show-permission')
                        <a href="{{ route('permission.show', ['permission' => $permission->id]) }}"
                            class="btn btn-secondary btn-sm me-1 mb-1 mb-sm-0"><i class="fa-regular fa-eye"></i> Vista</a>
                    @endcan

                </span>
            </div>

            <div class="card-body">

                <x-alert />

                <form action="{{ route('permission.update', ['permission' => $permission->id]) }}" method="POST" class="row g-3">
                    @csrf
                    @method('PUT')

                    <div class="col-12">
                        <label for="title" class="form-label">Título: </label>
                        <input type="text" name="title" id="title" class="form-control" placeholder="Título da página"
                            value="{{ old('title', $permission->title) }}">
                    </div>

                    <div class="col-12">
                        <label for="name" class="form-label">Nome: </label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Nome da página"
                            value="{{ old('name', $permission->name) }}">
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Guardar</button>
                    </div>

                </form>

            </div>
        </div>

    </div>
@endsection

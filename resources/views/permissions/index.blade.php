@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">

        <div class="mb-1 space-between-elements">

            <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard.index') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Permisos</li>
            </ol>
        </div>

        <div class="d-flex flex-row-reverse">
            @can('create-permission')
                <a href="{{ route('permission.create') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus"></i>
                    Añadir</a>
            @endcan
        </div>



        <x-alert />

        <table class="dataTable table table-sm table-striped table-hover table-bordered nowrap">
            <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Permisos</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>

            <tbody>

                {{-- Imprimir os registros --}}
                @forelse ($permissions as $permission)
                    <tr>
                        <th class="text-center">{{ $permission->id }}</th>
                        <td class="d-none d-md-table-cell">{{ $permission->title }}</td>
                        <td class="text-center">{{ $permission->name }}</td>
                        <td class="d-md-flex flex-row justify-content-center">

                            @can('show-permission')
                                <a href="{{ route('permission.show', ['permission' => $permission->id]) }}"
                                    class="btn btn-link btn-sm"><i class="fa-regular fa-eye me-1 text-secondary"></i>
                                </a>
                            @endcan

                            @can('edit-permission')
                                <a href="{{ route('permission.edit', ['permission' => $permission->id]) }}"
                                    class="btn btn-link btn-sm"><i
                                        class="fa-regular fa-pen-to-square me-1 text-secondary"></i></a>
                            @endcan

                            @can('destroy-permission')
                                <form action="{{ route('permission.destroy', ['permission' => $permission->id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-link btn-sm"
                                        onclick="return confirm('¿Está seguro de que desea eliminar este registro?')"><i
                                            class="fa-regular fa-trash-can text-secondary me-1"></i></button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <div class="alert alert-danger" role="alert">
                        Nenhuma permissão encontrada!
                    </div>
                @endforelse

            </tbody>
        </table>

        {{-- Imprimir a paginação --}}
        {{-- {{ $permissions->links() }} --}}

    </div>
@endsection

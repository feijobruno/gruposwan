@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">

        <div class="mb-1 space-between-elements">

            <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard.index') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('role.index') }}" class="text-decoration-none">Perfil</a></li>
                <li class="breadcrumb-item active">{{ $role->name }}</li>
            </ol>
        </div>

        {{-- <div class="d-flex flex-row-reverse">
            @can('index-role')
                <a href="{{ route('role.index') }}" class="btn btn-secondary btn-sm me-1"><i class="fa-solid fa-list"></i>
                    Listado</a>
            @endcan
        </div> --}}

        <x-alert />

        <table id ="table" class="dataTable table table-striped table-bordered nowrap" style="width:100%">
            <thead>
                <tr>
                    <th class="d-none d-sm-table-cell text-center">ID</th>
                    <th class="d-none d-sm-table-cell text-center">Permiso</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>

            <tbody>

                {{-- Imprimir os registros --}}
                @forelse ($permissions as $permission)
                    <tr>
                        <td class="d-none d-sm-table-cell text-center">{{ $permission->id }}</td>
                        <td>{{ $permission->title }}</td>
                        <td class="d-none d-sm-table-cell text-center">{{ $permission->name }}</td>
                        <td class="text-center">
                            @if (in_array($permission->id, $rolePermissions ?? []))
                                @can('update-role-permission')
                                    <a
                                        href="{{ route('role-permission.update', ['role' => $role->id, 'permission' => $permission->id]) }}">
                                        <span class="badge text-bg-success">Liberado</span>
                                    </a>
                                @else
                                    <span class="badge text-bg-success">Liberado</span>
                                @endcan
                            @else
                                @can('update-role-permission')
                                    <a
                                        href="{{ route('role-permission.update', ['role' => $role->id, 'permission' => $permission->id]) }}">
                                        <span class="badge text-bg-danger">Bloqueado</span>
                                    </a>
                                @else
                                    <span class="badge text-bg-danger">Bloqueado</span>
                                @endcan
                            @endif

                        </td>
                    </tr>
                @empty
                    <div class="alert alert-danger" role="alert">
                        ¡No se encontraron permisos para el perfil!
                    </div>
                @endforelse

            </tbody>
        </table>
    </div>
@endsection

@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">

        <div class="mb-1 space-between-elements">

            <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard.index') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Perfiles</li>
            </ol>
        </div>

        <div class="d-flex flex-row-reverse">
            @can('create-role')
                <a href="{{ route('role.create') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus"></i> Añadir</a>
            @endcan
        </div>

        <x-alert />

        <table id ="table" class="dataTable table table-striped table-sm table-bordered nowrap" style="width:100%">
            <thead>
                <tr>
                    <th class="d-none d-sm-table-cell text-center">ID</th>
                    <th class="text-center">Nome</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>

            <tbody>

                {{-- Imprimir os registros --}}
                @forelse ($roles as $role)
                    <tr>
                        <th class="d-none d-sm-table-cell text-center">{{ $role->id }}</th>
                        <td>{{ $role->name }}</td>
                        <td class="d-md-flex flex-row justify-content-center">

                            @can('index-role-permission')
                                <a href="{{ route('role-permission.index', ['role' => $role->id]) }}"
                                    class="btn btn-link btn-sm me-1 mb-1"><i class="fa-solid fa-list text-secondary me-2"></i>
                                </a>
                            @endcan

                            @can('edit-role')
                                <a href="{{ route('role.edit', ['role' => $role->id]) }}"
                                    class="btn btn-link btn-sm me-1 mb-1"><i
                                        class="fa-regular fa-eye text-secondary me-2"></i></a>
                            @endcan

                            @can('destroy-role')
                                <form method="POST" action="{{ route('role.destroy', ['role' => $role->id]) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-link btn-sm me-1 mb-1"
                                        onclick="return confirm('Tem certeza que deseja apagar este registro?')"><i
                                            class="fa-regular fa-trash-can text-secondary me-2"></i>
                                    </button>
                                </form>
                            @endcan

                        </td>
                    </tr>
                @empty
                    <div class="alert alert-danger" role="alert">
                        Nenhum papel encontrado!
                    </div>
                @endforelse

            </tbody>
        </table>

        {{-- Imprimir a paginação --}}
        {{ $roles->links() }}

    </div>
@endsection

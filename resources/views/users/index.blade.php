@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 space-between-elements">
            {{-- <h2 class="ms-2 mt-3 me-3">Usuario</h2> --}}
            <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard.index') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Usuarios</li>
            </ol>
        </div>

        {{-- <div class="card mb-4">
            <div class="card-header space-between-elements">
                <span>Pesquisar</span>
            </div>

            <div class="card-body">
                <form action="{{ route('user.index') }}">
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="name" name="name"  value="{{ $name }}" placeholder="">
                                <label for="customer">name</label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="email" name="email"  value="{{ $email }}" placeholder="">
                                <label for="email">E-mail</label>
                            </div>
                        </div>

                        {{-- <div class="col-md-4 col-sm-4">
                            <label class="form-label" for="email">E-mail</label>
                            <input type="text" name="email" id="email" class="form-control"
                                value="{{ $email }}" placeholder="E-mail do usuário">
                        </div> 

                        <div class="col-md-4 col-sm-4">
                            <button type="submit" class="btn btn-secondary btn-sm mt-2"><i class="fa-solid fa-magnifying-glass"></i>
                                Pesquisar</button>
                            <a href="{{ route('user.index') }}" class="btn btn-secondary btn-sm mt-2"><i
                                    class="fa-solid fa-trash"></i> Limpar</a>
                        </div>

                    </div>

                    {{-- <div class="row mb-3"> --}}

        {{-- <div class="col-md-4 col-sm-12">
                            <label class="form-label" for="data_cadastro_inicio">Data Cadastro Início</label>
                            <input type="datetime-local" name="data_cadastro_inicio" id="data_cadastro_inicio"
                                class="form-control" value="{{ $data_cadastro_inicio }}">
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <label class="form-label" for="data_cadastro_fim">Data Cadastro Fim</label>
                            <input type="datetime-local" name="data_cadastro_fim" id="data_cadastro_fim"
                                class="form-control" value="{{ $data_cadastro_fim }}">
                        </div> --}}

        {{-- <div class="col-md-4 col-sm-12 mt-4 pt-3">
                            <button type="submit" class="btn btn-info btn-sm"><i class="fa-solid fa-magnifying-glass"></i>
                                Pesquisa</button>
                            <a href="{{ route('user.index') }}" class="btn btn-warning btn-sm"><i
                                    class="fa-solid fa-trash"></i> Limpar</a>
                        </div> --}}
        {{-- 
                     </div>
                </form>
            </div> 
        </div> --}}


        {{-- 
             <div class="card-header space-between-elements">
                <span>Listado</span>
                <span>
                    @can('create-user')
                        <a href="{{ route('user.create') }}" class="btn btn-success btn-sm"><i
                                class="fa-regular fa-square-plus"></i> Añadir</a>
                    @endcan

                    @can('generate-pdf-user')
                        <a href="{{ route('user.generate-pdf') }}" class="btn btn-warning btn-sm"><i class="fa-regular fa-file-pdf"></i> Gerar PDF</a> 

                        <a href="{{ url('generate-pdf-user?' . request()->getQueryString()) }}"
                            class="btn btn-secondary btn-sm"><i class="fa-regular fa-file-pdf"></i> Gerar PDF</a>
                    @endcan


                </span>
            </div> --}}


        <div class="d-flex flex-row-reverse space-between-elements">
            @can('create-user')
                <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm mx-2"><i class="fa-solid fa-plus"></i>
                    Añadir
                </a>
                @endcan        
                @can('generate-pdf-user')
                    {{-- <a href="{{ route('user.generate-pdf') }}" class="btn btn-warning btn-sm"><i class="fa-regular fa-file-pdf"></i> Gerar PDF</a> --}}

                    <a href="{{ url('generate-pdf-user?' . request()->getQueryString()) }}" class="btn btn-secondary btn-sm"><i
                            class="fa-regular fa-file-pdf"></i> Gerar PDF</a>
                @endcan
        </div>




        <x-alert />

        <table class="dataTable table table-striped table-bordered nowrap">
            <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">E-mail</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>

                @forelse ($users as $user)
                    <tr>
                        <td scope="row" class="text-center">{{ $user->id }}</td>
                        <td class="text-center">{{ $user->name }}</td>
                        <td class="d-none d-md-table-cell text-center">{{ $user->email }}</td>
                        <td class="d-md-flex justify-content-center">

                            @can('show-user')
                                <a href="{{ route('user.show', ['user' => $user->id]) }}" class="btn btn-link btn-sm me-1 mb-1">
                                    <i class="fa-regular fa-eye text-secondary"></i>
                                </a>
                            @endcan

                            @can('edit-user')
                                <a href="{{ route('user.edit', ['user' => $user->id]) }}" class="btn btn-link btn-sm me-1 mb-1">
                                    <i class="fa-solid fa-pen-to-square text-secondary"></i>
                                </a>
                            @endcan

                            @can('destroy-user')
                                <form method="POST" action="{{ route('user.destroy', ['user' => $user->id]) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-link btn-sm me-1 mb-1"
                                        onclick="return confirm('Tem certeza que deseja apagar este registro?')"><i
                                            class="fa-regular fa-trash-can text-secondary"></i></button>
                                </form>
                            @endcan

                        </td>
                    </tr>
                @empty
                    <div class="alert alert-danger" role="alert">Nenhum usuário encontrado!</div>
                @endforelse

            </tbody>
        </table>

        {{-- {{ $users->onEachSide(0)->links() }} --}}
        {{-- {{ $users->appends(request()->all())->onEachSide(0)->links() }} --}}

    </div>
@endsection

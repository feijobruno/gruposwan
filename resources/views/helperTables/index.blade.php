@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">

        <div class="mb-1 space-between-elements">

            <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Tablas auxiliares</li>
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
                    <th class="d-none d-sm-table-cell text-center">Flag</th>
                    <th class="d-none d-sm-table-cell text-center">Iso-3</th>
                    <th class="d-none d-sm-table-cell text-center">Country</th>
                    <th class="text-center">Iso-2</th>
                    <th class="text-center">Status</th>
                </tr>
            </thead>

            <tbody>

                {{-- Imprimir os registros --}}
                @forelse ($data as $row)
                    <tr>
                        <td class="d-none d-sm-table-cell text-center"><img src="/img/country_flag/{{ strtolower($row->code).'.png' }}"></td>
                        <td class="d-none d-sm-table-cell text-center">{{ $row->country_code }}</td>
                        <td>{{ $row->country }}</td>
                        <td class="d-none d-sm-table-cell text-center">{{ $row->code }}</td>
                        <td class="text-center">
         
                                    <a
                                        href="{{ route('helperTables.update', ['country' => $row->country]) }}">
                                        @if ( $row->status == 1)
                                        <span class="badge text-bg-success">Liberado</span>
                                        @else
                                        <span class="badge text-bg-danger">Bloqueado</span>
                                        @endif 
                                    </a>
                              

                        </td>
                    </tr>
                @empty
                    <div class="alert alert-danger" role="alert">
                        ¡No se encontraron banderas para la tabla!
                    </div>
                @endforelse

            </tbody>
        </table>
    </div>
@endsection

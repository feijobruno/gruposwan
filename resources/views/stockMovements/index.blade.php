@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">

        <div class="mb-1 space-between-elements">

            <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Stock</li>
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
                    <th class="d-none d-sm-table-cell text-center">Id</th>
                    <th class="d-none d-sm-table-cell text-center">Producto</th>
                    <th class="d-none d-sm-table-cell text-center">Tipo</th>
                    <th class="text-center">Qty</th>
                    <th class="text-center">Fecha</th>
                    <th class="text-center">Pedido</th>
                    <th class="text-center">Proveedor</th>
                </tr>
            </thead>

            <tbody>

                {{-- Imprimir os registros --}}
                @forelse ($data as $row)
                    <tr>
                        <td class="d-none d-sm-table-cell text-center">{{ $row->id }}</td>
                        <td class="d-none d-sm-table-cell text-center">{{ $row->product }}</td>
                        <td class="text-center"> 
                                @if ( $row->movement_type == 'in')
                                <span class="badge text-bg-success">In</span>
                                @else
                                <span class="badge text-bg-danger">Out</span>
                                @endif 
                        </td>
                        <td class="d-none d-sm-table-cell text-center">{{ $row->quantity }}</td>
                        <td class="text-center">{{ $row->movement_date? date('d/m/Y', strtotime($row->movement_date)) :  null }}</td>
                        <td class="d-none d-sm-table-cell text-center">{{ $row->order }}</td>
                        <td class="d-none d-sm-table-cell text-center">{{ $row->supplier }}</td>
                    </tr>
                @empty
                    {{-- <div class="alert alert-danger" role="alert">
                        ¡No se encontraron banderas para la tabla!
                    </div> --}}
                @endforelse

            </tbody>
        </table>
    </div>
@endsection

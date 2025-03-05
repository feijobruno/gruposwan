@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">

        <div class="mb-1 space-between-elements">

            <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard.index') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('supplier.index') }}" class="text-decoration-none">Proveedores</a>
                </li>
                <li class="breadcrumb-item active">{{ Str::title($supplier->supplier) }}</li>
            </ol>
        </div>


        <div class="card mb-4">
            <ul class="nav nav-tabs pt-2 ps-2 bg-light">
                <li class="nav-item">
                    <a class="nav-link text-decoration-none text-secondary"
                        href="{{ route('supplier.order', ['supplier' => $supplier]) }}">Pedidos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active text-decoration-none text-secondary"
                        href="{{ route('supplier.contact', ['supplier' => $supplier]) }}">Contactos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-decoration-none text-secondary"
                        href="{{ route('supplier.metting', ['supplier' => $supplier]) }}">Reuniones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-decoration-none text-secondary"
                        href="{{ route('supplier.presentation', ['supplier' => $supplier]) }}">Presentaciones</a>
                </li>
            </ul>

            <div class="card-body">

                <x-alert />

                <div class="row">
                    <div class="hstack gap-2">

                        <span class="ms-auto">

                            <a href="{{ route('contact.supplier', ['supplier' => $supplier]) }}"
                                class="btn btn-primary btn-sm me-3"><i class="fa-solid fa-plus"></i> Añadir</a>

                        </span>
                    </div>
                    <div class="table-responsive px-4 mt-3" id="contact">
                        <table id ="table" class="dataTable table table-striped table-bordered nowrap"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">ID</th>
                                    <th scope="col" class="text-center">Nombre</th>
                                    <th scope="col" class="text-center">Teléfono</th>
                                    <th scope="col" class="text-center">Email</th>
                                    <th scope="col" class="text-center">Position</th>
                                    <th scope="col" class="text-center">Gestión</th>
                                    <th scope="col" class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>

                                {{-- Print the records --}}
                                @forelse ($contacts as $row)
                                    <tr>
                                        <td scope="row" class="text-center">{{ $row->id }}</td>
                                        <td class="text-center">{{ $row->name }}</td>
                                        <td class="text-center">{{ $row->phone }}</td>
                                        <td class="text-center">{{ $row->email }}</td>
                                        <td class="text-center">{{ $row->position }}</td>
                                        <td class="text-center">{{ $row->post }}</td>
                                        <td>
                                            <a href="#" class="text-decoration-none"><i class="fa-regular fa-eye text-secondary me-2 text-secondary"></i></a>
                                            <a href="{{ route('contact.edit', ['contact' => $row->id]) }}"
                                                class="text-decoration-none"><i
                                                    class="fa-regular fa-pen-to-square me-2 text-secondary"></i></a>
                                            <a href="{{ route('contact.destroy', ['contact' => $row->id, 'supplier' => $supplier ]) }}"
                                                onclick="
                                                                  event.preventDefault();
                                                                  if( confirm('¿Está seguro de que desea eliminar este registro?')){
                                                                      return document.getElementById('delete-form-{{ $row->id }}').submit();
                                                                  }"><i
                                                    class="fa-regular fa-trash-can text-secondary"></i></a>
                                        </td>

                                        <form id="delete-form-{{ $row->id }}"
                                            action="{{ route('contact.destroy', ['contact' => $row->id, 'supplier' => $supplier]) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endsection

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
              <a class="nav-link text-decoration-none text-secondary" href="{{ route('supplier.order', ['supplier' => $supplier]) }}">Pedidos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-decoration-none text-secondary" href="{{ route('supplier.contact', ['supplier' => $supplier]) }}">Contactos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-decoration-none text-secondary" href="{{ route('supplier.metting', ['supplier' => $supplier]) }}">Reuniones</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active text-decoration-none text-secondary" href="{{ route('supplier.presentation', ['supplier' => $supplier]) }}">Presentaciones</a>
            </li>
          </ul>

            <div class="card-body">

                <x-alert />


                <div class="row">
                    <div class="hstack gap-2">
                        <span class="ms-auto">
                            <a href="{{ route('presentation.create', ['entity' => 'supplier','id' => $supplier->id]) }}" class="btn btn-primary btn-sm me-3"><i class="fa-solid fa-plus"></i> Añadir</a>
                        </span>
                    </div>
                    <div class="table-responsive px-4 mt-3" id="presentation">
                        <table id ="table" class="dataTable table table-striped table-bordered nowrap"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">ID</th>
                                    <th scope="col" class="text-center">Presentation Name</th>
                                    <th scope="col" class="text-center">Presentation Date</th>
                                    <th scope="col" class="text-center">File</th>
                                    <th scope="col" class="text-center">Year</th>
                                    <th scope="col" class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>

                                {{-- Print the records --}}
                                @forelse ($presentations as $row)
                                    <tr>
                                        <td scope="row" class="text-center">{{ $row->id }}</td>
                                        <td class="text-center">{{ $row->presentation_name }}</td>
                                        <td class="text-center">{{ date('d/m/Y', strtotime($row->presentation_date)) }}</td>
                                        <td class="text-center">
                                            <a href="/files/presentation_supplier/{{ $row->file }}" class="text-decoration-none" download>
                                                @if ($row->file)
                                                    <i
                                                        class="fa-regular fa-file-powerpoint text-center link-secondary link-underline link-underline-opacity-0"></i>
                                                @endif
                                            </a>
                                        </td>
                                        <td class="text-center">{{ $row->year }}</td>
                                        <td>
                                            <a href="#" class="text-decoration-none"><i class="fa-regular fa-eye text-secondary me-2 text-secondary"></i></a>

                                            <a href="{{ route('presentation.edit', ['entity' => 'supplier', 'presentation' => $row->id]) }}" class="text-decoration-none"><i class="fa-regular fa-pen-to-square me-2 text-secondary"></i></a>
                                            
                                            <a href="{{ route('presentation.destroy', ['presentation' => $row->id ]) }}"
                                                onclick="
                                                                  event.preventDefault();
                                                                  if( confirm('¿Está seguro de que desea eliminar este registro?')){
                                                                      return document.getElementById('delete-form-{{ $row->id }}').submit();
                                                                  }"><i
                                                    class="fa-regular fa-trash-can text-secondary"></i></a>
                                        </td>

                                        <form id="delete-form-{{ $row->id }}"
                                            action="{{ route('presentation.destroy', ['presentation' => $row->id]) }}" method="POST"
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
    </div>
@endsection
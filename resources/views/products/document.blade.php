@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">

        <div class="mb-1 space-between-elements">

            <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('product.index', ['product' => $product]) }}" class="text-decoration-none">Productos</a></li>
                <li class="breadcrumb-item active">{{ $product->product }}</li>
            </ol>
        </div>


        <div class="card mb-4">

          <ul class="nav nav-tabs pt-2 ps-2 bg-light">
            <li class="nav-item"><a class="nav-link active text-decoration-none text-secondary" href="{{ route('product.document', ['product' => $product ]) }}">TDS - SDS</a></li>
            <li class="nav-item"><a class="nav-link text-decoration-none text-secondary" href="{{ route('product.technical', ['product' => $product]) }}">Technical</a></li>
            <li class="nav-item"><a class="nav-link text-decoration-none text-secondary" href="{{ route('product.metting', ['product' => $product]) }}">Reuniones</a></li>
            <li class="nav-item"><a class="nav-link text-decoration-none text-secondary" href="{{ route('product.presentation', ['product' => $product ]) }}">Presentaciones</a></li>
          </ul>

            <div class="card-body">
                {{-- {{ dd($product )}} --}}
                <x-alert />

                <div class="row">
                    <div class="d-flex flex-row-reverse">
                        @can('customer-create')
                            <a href="{{ route('productFile.create', ['product' => $product ]) }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus"></i> Añadir</a>
                        @endcan
                    </div>                    
            
                    <div class="table-responsive">
                        <table id ="table" class="dataTable table table-striped table-hover table-bordered nowrap"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">ID</th>
                                    <th scope="col" class="text-center">Producto</th>
                                    <th scope="col" class="text-center">Name</th>
                                    <th scope="col" class="text-center">Tipo</th>
                                    <th scope="col" class="text-center">File</th>
                                    <th scope="col" class="text-center">Fecha de Registro</th>
                                    <th></th>            
                                </tr>
                            </thead>
                            <tbody>
            
                                {{-- Imprimir os registros --}}
                                @forelse ($data as $row)
                                    <tr>
                                        <td scope="row" class="text-center"><a href="{{ route('product.document', ['product' => $row->id]) }}" class="link-secondary link-underline-opacity-0">{{ $row->id }}</a></td>
                                        <td><a href="{{ route('product.document', ['product' => $row->id]) }}" class="link-secondary link-underline link-underline-opacity-0">{{ $row->product }}</a></td>
                                        <td class="text-center"><a href="{{ route('product.document', ['product' => $row->id]) }}" class="link-secondary link-underline link-underline-opacity-0">{{ $row->name }}</a></td>
                                        <td class="text-center"><a href="{{ route('product.document', ['product' => $row->id]) }}" class="link-secondary link-underline link-underline-opacity-0">{{ $row->type }}</a></td>
                                        <td class="text-center"><a href="/files/product_file/{{ $row->file }}" class="text-decoration-none"
                                            download>
                                            @if ($row->file)
                                                <i class="fa-regular fa-file-pdf text-center link-secondary link-underline link-underline-opacity-0"></i>
                                            @endif
                                        </a></td>
                                      <td class="text-center">{{ date('d/m/Y', strtotime($row->created_at)) }}</td>                              
                                        <td>
                                            {{-- <a href="{{ route('product.document', ['product' => $row->id]) }}" class="text-decoration-none"><i class="fa-regular fa-eye text-secondary me-2"></i></a> --}}
                                            <a href="{{ route('productFile.edit', ['file' => $row->id]) }}" class="text-decoration-none"><i class="fa-regular fa-pen-to-square me-2 text-secondary"></i></a>
                                            <a href="{{ route('productFile.destroy', ['file' => $row->id]) }}"
                                                onclick="
                                                    event.preventDefault();
                                                    if( confirm('¿Está seguro de que desea eliminar este registro?')){
                                                        return document.getElementById('delete-form-{{ $row->id }}').submit();
                                                    }"><i class="fa-regular fa-trash-can text-secondary"></i>
                                            </a>
                                        </td>
                                        <form id="delete-form-{{ $row->id }}"
                                            action="{{ route('productFile.destroy', ['file' => $row->id]) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </tr>
                                @empty
                                    {{-- <div class="alert alert-danger" role="alert">
                                        ¡No existen documentos técnicos para el producto!
                                    </div> --}}
                                @endforelse
            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
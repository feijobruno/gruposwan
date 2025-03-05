@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            {{-- <h2 class="mt-3">Productos</h2> --}}

            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('product.index') }}" class="text-decoration-none">Productos</a>
                </li>
                <li class="breadcrumb-item active">Documentos del producto</li>
            </ol>
        </div>

        <div class="card mb-4">

            <div class="card-header hstack gap-2">
                <span>Documentos del producto</span>

                <span class="ms-auto">
                    @can('product-course')
                        <a href="{{ route('product.create') }}" class="btn btn-primary btn-sm"><i
                                class="fa-regular fa-square-plus"></i> Añadir</a>
                    @endcan
                </span>
            </div>

            <div class="card-body">

                {{-- <x-alert /> --}}

                <div class="table-responsive">
                    <table id ="table" class="table table-striped table-bordered nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center" style="width: 5%;">&#8203;</th>
                                {{-- <th scope="col" class="text-center">Acciones</th> --}}
                                <th scope="col" class="text-center">ID</th>
                                <th scope="col" class="text-center">Producto</th>
                                {{-- <th scope="col">Created_at</th>
                                <th scope="col">Updated_at</th> --}}
                                
                            </tr>
                        </thead>
                        <tbody>

                            {{-- Imprimir os registros --}}
                            @forelse ($data as $row)
                                <tr class="">
                                    <td>
                                        {{-- <div class='dropdown no-arrow'>
                                            <a class='dropdown-toggle' href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                <i class='fas fa-ellipsis-v fa-sm fa-fw text-gray-400'></i>
                                            </a>
                                            <div class='dropdown-menu dropdown-menu-right shadow animated--fade-in' aria-labelledby='dropdownMenuLink'>
                                                <button class='dropdown-item' data-bs-toggle='modal' data-bs-target='#modalEditProduct' onclick='editProduct($id)'>Para Editar</button>
                                                <button class='dropdown-item'>Ver documentos</button>
                                           </div>
                                        </div> --}}

                                        <div class="dropdown">
                                            <a class="btn btn-link dropdown-toggle btn-sm" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class='fas fa-ellipsis-v fa-sm fa-fw text-gray-400'></i>
                                            </a>
                                          
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                              <li><a class="dropdown-item" href="#">Ver documentos</a></li>
                                              <li><a class="dropdown-item" href="#">Editar</a></li>
                                              <li><a class="dropdown-item" href="#">Apagar</a></li>
                                            </ul>
                                          </div>

                                    </td>
                                    <td scope="row">{{ $row->id }}</td>
                                    <td>{{ $row->name }}</td>
                                    {{-- <td>{{ $row->created_at }}</td>
                                        <td>{{ $row->updated_at }}</td> --}}
                                   
                                </tr>
                            @empty
                                <div class="alert alert-danger" role="alert">
                                    ¡No se encontraron productos!
                                </div>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- @push('js')
    <script>
       
    </script>
@endpush --}}

@extends('layouts.admin')


@section('content')
    <div class="container-fluid px-4">

        <div class="mb-1 space-between-elements">

            <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard.index') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Productos</li>
            </ol>
        </div>

        <div class="d-flex flex-row-reverse">
            @can('customer-create')
                <a href="{{ route('product.create') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus"></i> Añadir</a>
            @endcan
        </div>

        <x-alert />

        <div class="table-responsive">
            <table id ="table" class="dataTable table table-striped table-hover table-bordered nowrap"
                style="width:100%">
                <thead>
                    <tr>
                        {{-- <th scope="col" class="text-center" style="width: 5%;">&#8203;</th> --}}
                        {{-- <th scope="col" class="text-center">Acciones</th> --}}
                        <th scope="col" class="text-center">ID</th>
                        <th scope="col" class="text-center">Producto</th>
                        <th scope="col" class="text-center">Proveedor</th>
                        <th scope="col" class="text-center">Packaging Type</th>
                        <th scope="col" class="text-center">KG</th>
                        <th scope="col" class="text-center">QTY. Pallet</th>
                        <th scope="col" class="text-center">KG Pallet</th>
                        <th scope="col" class="text-center">Material Peligroso</th>
                        <th scope="col" class="text-center">Acciones</th>

                    </tr>
                </thead>
                <tbody>

                    {{-- Imprimir os registros --}}
                    @forelse ($data as $row)
                        <tr>
                            <td scope="row" class="text-center"><a
                                    href="{{ route('product.document', ['product' => $row->id]) }}"
                                    class="link-secondary link-underline-opacity-0">{{ $row->id }}</a></td>
                            <td><a href="{{ route('product.document', ['product' => $row->id]) }}"
                                    class="link-secondary link-underline link-underline-opacity-0">{{ $row->product }}</a>
                            </td>
                            <td class="text-center"><a href="{{ route('product.document', ['product' => $row->id]) }}"
                                    class="link-secondary link-underline link-underline-opacity-0">
                                    @if ($row->supplier_id === 50)
                                        <span class="badge rounded-pill bg-warning text-dark">Ningún proveedor</span>
                                    @else
                                        {{ $row->supplier }}
                                    @endif
                                </a>
                            </td>
                            <td class="text-center"><a href="{{ route('product.document', ['product' => $row->id]) }}"
                                class="link-secondary link-underline-opacity-0">{{ $row->packaging_type }}</a></td>
                            <td class="text-center"><a href="{{ route('product.document', ['product' => $row->id]) }}"
                                    class="link-secondary link-underline-opacity-0">{{ number_format($row->kg, 0, ',', '.') }}</a></td>
                            <td class="text-center"><a href="{{ route('product.document', ['product' => $row->id]) }}"
                                    class="link-secondary link-underline-opacity-0">{{ $row->qty_pallet }}</a></td>
                            <td class="text-center"><a href="{{ route('product.document', ['product' => $row->id]) }}"
                                    class="link-secondary link-underline-opacity-0">{{ number_format($row->kg_pallet, 0, ',', '.') }}</a></td>
                            <td class="text-center"><a href="{{ route('product.document', ['product' => $row->id]) }}"
                                    class="link-secondary link-underline-opacity-0">{{ $row->dangerous_material }}</a></td>
                            <td>
                                <a href="{{ route('product.document', ['product' => $row->id]) }}"
                                    class="text-decoration-none"><i class="fa-regular fa-eye text-secondary me-2"></i></a>
                                <a href="{{ route('product.edit', ['product' => $row->id]) }}"
                                    class="text-decoration-none"><i
                                        class="fa-regular fa-pen-to-square me-2 text-secondary"></i></a>
                                <a href="{{ route('product.destroy', ['product' => $row->id]) }}"
                                    onclick="
                                                      event.preventDefault();
                                                      if( confirm('¿Está seguro de que desea eliminar este registro?')){
                                                          return document.getElementById('delete-form-{{ $row->id }}').submit();
                                                      }"><i
                                        class="fa-regular fa-trash-can text-secondary"></i></a>
                            </td>
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
@endsection

{{-- @push('js')
    <script>
       
    </script>
@endpush --}}

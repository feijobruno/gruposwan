@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">

        <div class="mb-1 space-between-elements">

            <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard.index') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('product.index') }}" class="text-decoration-none">Productos</a>
                </li>
                <li class="breadcrumb-item active">{{ $product->product }}</li>
            </ol>
        </div>

        <div class="card mb-4">

          <ul class="nav nav-tabs pt-2 ps-2 bg-light">
            <li class="nav-item">
              <a class="nav-link text-decoration-none text-secondary" href="{{ route('product.document', ['product' => $product]) }}">TDS - SDS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-decoration-none text-secondary" href="{{ route('product.technical', ['product' => $product]) }}">Technical</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active text-decoration-none text-secondary" href="{{ route('product.metting', ['product' => $product]) }}">Reuniones</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-decoration-none text-secondary" href="{{ route('product.presentation', ['product' => $product]) }}">Presentaciones</a>
            </li>
          </ul>

            <div class="card-body">

                <x-alert />


                <div class="row">
                    <div class="hstack gap-2">

                        <span class="ms-auto">

                            <a href="{{ route('metting.create', ['entity' => 'product','id' => $product->id]) }}" class="btn btn-primary btn-sm me-3">
                                <i class="fa-solid fa-plus"></i> Añadir
                            </a>

                        </span>
                    </div>
                    <div class="table-responsive px-4 mt-3" id="metting">
                        <table id ="table" class="dataTable table table-striped table-bordered nowrap"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">ID</th>
                                    <th scope="col" class="text-center">Metting Name</th>
                                    <th scope="col" class="text-center">Metting Date</th>
                                    <th scope="col" class="text-center">File</th>
                                    <th scope="col" class="text-center">Year</th>
                                    <th scope="col" class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Print the records --}}
                                @forelse ($mettings as $row)
                                    <tr>
                                        <td scope="row" class="text-center">{{ $row->id }}</td>
                                        <td class="text-center">{{ $row->metting_name }}</td>
                                        <td class="text-center">{{ date('d/m/Y', strtotime($row->metting_date)) }}</td>
                                        <td class="text-center">
                                            <a href="/files/metting_product/{{ $row->file }}" class="text-decoration-none" download>
                                                @if ($row->file)
                                                    <i
                                                        class="fa-regular fa-file-word text-center link-secondary link-underline link-underline-opacity-0"></i>
                                                @endif
                                            </a>
                                        </td>
                                        <td class="text-center">{{ $row->year }}</td>
                                        <td>
                                            <a href="#" class="text-decoration-none"><i class="fa-regular fa-eye text-secondary me-2 text-secondary"></i></a>
                                            
                                            <a href="{{ route('metting.edit', ['entity' => 'product','metting' => $row->id]) }}" class="text-decoration-none"><i class="fa-regular fa-pen-to-square me-2 text-secondary"></i></a>
                                            
                                            <a href="{{ route('metting.destroy', ['metting' => $row->id]) }}"
                                                onclick="
                                                                  event.preventDefault();
                                                                  if( confirm('¿Está seguro de que desea eliminar este registro?')){
                                                                      return document.getElementById('delete-form-{{ $row->id }}').submit();
                                                                  }"><i
                                                    class="fa-regular fa-trash-can text-secondary"></i></a>
                                        </td>
                                        <form id="delete-form-{{ $row->id }}"
                                            action="{{ route('metting.destroy', ['metting' => $row->id]) }}" method="POST"
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
@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">

        <div class="mb-1 space-between-elements">
            <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard.index') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Clientes</li>
            </ol>
        </div>

        <div class="d-flex flex-row-reverse">
            @can('customer-create')
                <a href="{{ route('customer.create') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus"></i> Añadir</a>
            @endcan
        </div>

                <x-alert />

                <div class="table-responsive">
                    <table id ="table" class="dataTable table table-striped table-bordered nowrap" style="width:100%">
                        <thead>
                            <tr>
                                {{-- <th scope="col" class="text-center" style="width: 5%;">&#8203;</th> --}}
                                {{-- <th scope="col" class="text-center">Acciones</th> --}}
                                <th scope="col" class="text-center">ID</th>
                                <th scope="col" class="text-center">Customer</th>
                                <th scope="col" class="text-center">Country</th>
                                <th scope="col" class="text-center">Provincia</th>
                                <th scope="col" class="text-center">Zip</th>
                                <th scope="col" class="text-center">City</th>
                                <th scope="col" class="text-center">Street</th>
                                <th scope="col" class="text-center">Street 2</th>
                                <th scope="col" class="text-center">Vat</th>
                                <th scope="col" class="text-center">Bank id</th>
                                <th scope="col" class="text-center">Bank Acc number</th>   
                                <th scope="col" class="text-center">Acciones</th>                             
                            </tr>
                        </thead>
                        <tbody>

                            {{-- Print the records --}}
                            @forelse ($data as $row)
                                <tr>
                                    <td scope="row" class="text-center"><a href="{{ route('customer.order', ['customer' => $row->id]) }}" class="link-secondary link-underline-opacity-0">{{ $row->id }}</a></td>
                                    <td><a href="{{ route('customer.order', ['customer' => $row->id]) }}" class="link-secondary link-underline link-underline-opacity-0">{{ $row->customer }}</a></td>
                                    <td><a href="{{ route('customer.order', ['customer' => $row->id]) }}" class="link-secondary link-underline link-underline-opacity-0">{{ $row->country }}</a></td>
                                    <td><a href="{{ route('customer.order', ['customer' => $row->id]) }}" class="link-secondary link-underline link-underline-opacity-0">{{ $row->province }}</a></td>
                                    <td><a href="{{ route('customer.order', ['customer' => $row->id]) }}" class="link-secondary link-underline link-underline-opacity-0">{{ $row->zip }}</a></td>
                                    <td><a href="{{ route('customer.order', ['customer' => $row->id]) }}" class="link-secondary link-underline link-underline-opacity-0">{{ $row->city }}</a></td>
                                    <td><a href="{{ route('customer.order', ['customer' => $row->id]) }}" class="link-secondary link-underline link-underline-opacity-0">{{ $row->street }}</a></td>
                                    <td><a href="{{ route('customer.order', ['customer' => $row->id]) }}" class="link-secondary link-underline link-underline-opacity-0">{{ $row->street2 }}</a></td>
                                    <td><a href="{{ route('customer.order', ['customer' => $row->id]) }}" class="link-secondary link-underline link-underline-opacity-0">{{ $row->vat }}</a></td>
                                    <td><a href="{{ route('customer.order', ['customer' => $row->id]) }}" class="link-secondary link-underline link-underline-opacity-0">{{ $row->bank_id }}</a></td>
                                    <td><a href="{{ route('customer.order', ['customer' => $row->id]) }}" class="link-secondary link-underline link-underline-opacity-0">{{ $row->bank_id_acc_number }}</a></td>                                 
                                    <td> 
                                        <a href="{{ route('customer.order', ['customer' => $row->id])}}" class="text-decoration-none"><i class="fa-regular fa-eye me-2 text-secondary"></i></a>
                                        <a href="{{ route('customer.edit', ['customer' => $row->id])}}" class="text-decoration-none"><i class="fa-regular fa-pen-to-square me-2 text-secondary"></i></a>
                                        <a href="{{ route('customer.destroy', ['customer' => $row->id]) }}"
                                                  onclick="
                                                      event.preventDefault();
                                                      if( confirm('¿Está seguro de que desea eliminar este registro?')){
                                                          return document.getElementById('delete-form-{{ $row->id }}').submit();
                                                      }"><i class="fa-regular fa-trash-can text-secondary"></i></a>
                                    </td>

                                    <form id="delete-form-{{ $row->id }}" action="{{ route('customer.destroy', ['customer' => $row->id]) }}"
                                        method="POST" style="display: none;">
                                       @csrf
                                       @method('delete')
                                   </form>
                                </tr>
                            @empty
                                <div class="alert alert-danger" role="alert">
                                    ¡No se encontraron clientes!
                                </div>
                            @endforelse

                        </tbody>
                    </table>
                </div>
    </div>
@endsection

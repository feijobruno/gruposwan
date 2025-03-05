@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">

        <div class="mb-1 space-between-elements">

            <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('customer.index') }}">Clientes</li></a>
                <li class="breadcrumb-item active">Pedidos</li>
            </ol>
        </div>
                <div class="row">
                    <div class="hstack gap-2">

                        {{-- <span class="ms-auto">

                            <a href="{{ route('customer-order.index', ['customer' => $customer]) }}"
                                class="btn btn-success btn-sm me-3"><i class="fa-solid fa-plus"></i> Añadir</a>

                        </span> --}}
                    </div>
                    <div class="table-responsive px-4 mt-3" id="orders">
                        <x-alert />
                        <table id ="table" class="dataTable table table-striped table-hover table-bordered nowrap"
                            style="width:100%">

                            <thead>
                                <tr>
                                    {{-- <th scope="col" class="text-center">Id</th> --}}
                                    <th scope="col" class="text-center">Pedido</th>
                                    <th scope="col" class="text-center">Cliente</th>
                                    <th scope="col" class="text-center">Fecha</th>
                                    <th scope="col" class="text-center">Plazo de entrega</th>
                                    <th scope="col" class="text-center">Value</th>
                                    <th scope="col" class="text-center">Qty</th>
                                    <th scope="col" class="text-center">Productos</th>
                                    <th scope="col" class="text-center">Status</th>
                                    <th scope="col" class="text-center">Archivo</th>
                                    <th scope="col" class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>

                                {{-- Print the records --}}
                                @forelse ($data as $row)
                                    <tr>
                                        {{-- <td scope="row">{{ $row->id }}</td> --}}
                                        <td scope="row" class="text-center">{{ $row->order }}</td>
                                        <td scope="row" class="text-center">{{ $row->customer }}</td>
                                        <td class="text-center">{{ date('d/m/Y', strtotime($row->order_date)) }}</td>
                                        <td class="text-center">{{ date('d/m/Y', strtotime($row->delivery_date)) }}</td>
                                        <td class="text-center">{{ number_format($row->total_amount, 0, ',', '.') }} €</td>
                                        <td class="text-center">{{ number_format($row->total_weight, 0, ',', '.') }}</td>
                                        <td scope="row" class="text-center">{{ $row->products }}</td>
                                        <td class="text-center">
                                            @if ($row->status === 1)
                                             <span class="badge rounded-pill bg-warning text-dark">Pendiente</span>
                                            @endif
                                        </td>
                                        <td class="text-center"><a href="/img/customer_orders/{{ $row->file }}" class="text-decoration-none"
                                                download>
                                                @if ($row->file)
                                                    <i class="fa-regular fa-file-pdf text-center link-secondary link-underline link-underline-opacity-0"></i>
                                                @endif
                                            </a></td>
                                        <td>
                                            <a href="#" class="text-decoration-none"><i class="fa-regular fa-eye text-secondary me-2 text-secondary"></i></a>
                                            <a href="{{ route('contact.edit', ['contact' => $row->id]) }}"
                                                class="text-decoration-none"><i
                                                    class="fa-regular fa-pen-to-square me-2 text-secondary"></i></a>
                                            <a href="{{ route('contact.destroy', ['contact' => $row->id]) }}"
                                                onclick="
                                                                          event.preventDefault();
                                                                          if( confirm('¿Está seguro de que desea eliminar este registro?')){
                                                                              return document.getElementById('delete-form-{{ $row->id }}').submit();
                                                                          }"><i
                                                    class="fa-regular fa-trash-can text-secondary"></i></a>
                                        </td>

                                        <form id="delete-form-{{ $row->id }}"
                                            action="{{ route('contact.destroy', ['contact' => $row->id]) }}" method="POST"
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
           
    
    @endsection

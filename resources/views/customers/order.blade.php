@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">

        <div class="mb-1 space-between-elements">

            <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard.index') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('customer.index') }}" class="text-decoration-none">Clientes</a></li>
                <li class="breadcrumb-item active">{{ Str::title($customer->customer) }}</li>
            </ol>
        </div>


        <div class="card mb-4">

            <ul class="nav nav-tabs pt-2 ps-2 bg-light">
                <li class="nav-item">
                    <a class="nav-link text-decoration-none text-secondary active"
                        href="{{ route('customer.order', ['customer' => $customer]) }}">Pedidos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-decoration-none text-secondary"
                        href="{{ route('customer.contact', ['customer' => $customer]) }}">Contactos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-decoration-none text-secondary"
                        href="{{ route('customer.metting', ['customer' => $customer]) }}">Reuniones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-decoration-none text-secondary"
                        href="{{ route('customer.presentation', ['customer' => $customer]) }}">Presentaciones</a>
                </li>
            </ul>


            <div class="card-body">

                <x-alert />

                <div class="row">
                    <div class="hstack gap-2">

                        <span class="ms-auto">

                            <a href="{{ route('ordersCustomer.create', ['customer' => $customer]) }}"
                                class="btn btn-primary btn-sm me-3"><i class="fa-solid fa-plus"></i> Añadir</a>

                        </span>
                    </div>
                    <div class="table-responsive px-4 mt-3" id="orders">
                        <table id ="table"
                            class="dataTable table table-striped table-hover table-bordered nowrap table-sm"
                            style="width:100%">

                            <thead>
                                <tr>
                                    {{-- <th scope="col" class="text-center">Id</th> --}}
                                    <th scope="col" class="text-center">Pedido</th>
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
                                        <td class="text-center">{{ date('d/m/Y', strtotime($row->order_date)) }}</td>
                                        <td class="text-center">{{ date('d/m/Y', strtotime($row->delivery_date)) }}</td>
                                        <td class="text-center">{{ number_format($row->total_amount, 0, ',', '.') }} €</td>
                                        <td class="text-center">{{ number_format($row->total_weight, 0, ',', '.') }} kg
                                        </td>
                                        <td class="text-center breakLine">{{ $row->products }}</td>
                                        <td class="text-center">
                                            @if ($row->status === 1)
                                                <span class="badge rounded-pill bg-warning text-dark">Pendiente</span>
                                            @endif
                                        </td>
                                        <td class="text-center"><a href="/img/customer_orders/{{ $row->file }}"
                                                class="text-decoration-none" download>
                                                @if ($row->file)
                                                    <i
                                                        class="fa-regular fa-file-pdf text-center link-secondary link-underline link-underline-opacity-0"></i>
                                                @endif
                                            </a></td>
                                        <td>
                                            <a href="{{ route('ordersCustomer.show', ['order' => $row->order]) }}" class="text-decoration-none"><i class="fa-regular fa-eye text-secondary me-2 text-secondary"></i></a>
                                            <a href="{{ route('ordersCustomer.edit', ['order' => $row->order]) }}" class="text-decoration-none"><i class="fa-regular fa-pen-to-square me-2 text-secondary"></i></a>
                                            <a href="{{ route('ordersCustomer.destroy', ['order' => $row->order]) }}"
                                                onclick="
                                                                          event.preventDefault();
                                                                          if( confirm('¿Está seguro de que desea eliminar este registro?')){
                                                                              return document.getElementById('delete-form-{{ $row->order }}').submit();
                                                                          }"><i
                                                    class="fa-regular fa-trash-can text-secondary"></i></a>
                                        </td>

                                        <form id="delete-form-{{ $row->order }}"
                                            action="{{ route('ordersCustomer.destroy', ['order' => $row->order]) }}" method="POST"
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
    @push('js')
        <script>
            $('.breakLine').each(function() {
                $(this).html($(this).html().replace(/,\\*/g, "<br>"));
            })
        </script>
    @endpush

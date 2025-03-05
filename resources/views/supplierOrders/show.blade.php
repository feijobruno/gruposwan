@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">

        <div class="mb-1 space-between-elements">

            <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('supplier.index') }}" class="text-decoration-none">Proveedores</a></li>
                <li class="breadcrumb-item"><a href="{{ route('supplier.order', [$supplier->id]) }}" class="text-decoration-none">{{ Str::title($supplier->supplier) }}</a></li>
                <li class="breadcrumb-item active">{{ $order->order }}<li>
            </ol>
        </div>
        <div class="card mb-4">
            <div class="card-header hstack gap-2">
                <span>{{ Str::title($supplier->supplier) }}</span>
            </div>
            <div class="card-body">

                <x-alert />

                <div class="row">
                    <input type="hidden" class="form-control" id="supplier_id" name="supplier_id"
                        value="{{ $supplier->id }}">
                    <input type="hidden" class="form-control" id="status" name="status" value="1">

                    <div class="col-6">
                        <div class="card border-light mb-2 shadow">
                            <div class="card-header">Pedido: {{ $order->order }}</div>
                            <div class="card-body">

                                <div class="row g-2">

                                    <div class="col-md-3">
                                        <div class="form-floating mb-3">
                                            <input type="buyer" class="form-control" id="buyer" name="buyer" value="{{ $order->buyer }}" disabled>
                                            <label for="buyer">Comprador</label>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="supplier" name="supplier"
                                                placeholder="" value="{{ Str::title($supplier->supplier) }}" disabled>
                                            <label for="supplier">Proveedor</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating mb-3">
                                            <input type="date" class="form-control" id="order_date" name="order_date" value="{{ $order->order_date }}" disabled>
                                            <label for="order_date">Fecha de compra</label>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-floating mb-3">
                                            <input type="incoterm" class="form-control" id="incoterm" name="incoterm" value="{{ $order->incoterm }}" disabled>
                                            <label for="incoterm">Incoterm</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-2">
                                    <div class="col-md-3">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="forwarder" name="forwarder" value="{{ $order->forwarder }}" disabled>
                                            <label for="forwarder">Forwarder</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="port" name="port" alue="{{ $order->port }}" disabled>
                                            <label for="port">Port</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating mb-3">
                                            <input type="date" class="form-control" id="etd" name="etd" value="{{ $order->etd }}" disabled>
                                            <label for="etd">ETD</label>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-floating mb-3">
                                            <input type="date" class="form-control" id="eta" name="eta" value="{{ $order->eta }}" disabled>
                                            <label for="eta">ETA</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-2">

                                    <div class="col-md-3">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="destination" value="{{ $order->destination }}" name="destination" disabled>
                                            <label for="destination">Destination</label>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-floating mb-3">
                                            <input type="date" class="form-control" id="last_update" value="{{ $order->last_update }}" name="last_update" disabled>
                                            <label for="last_update">Last Update</label>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-floating mb-3">
                                            <input type="date" class="form-control" id="due_date" name="due_date" value="{{ $order->due_date }}" disabled>
                                            <label for="due_date">Due Date</label>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-floating mb-3">
                                            <input type="payment_term" class="form-control" id="payment_term" name="payment_term" value="{{ $order->payment_term }}" disabled>
                                            <label for="payment_term">Payment Term</label>
                                        </div>
                                    </div>

                                </div>
                                 <div class="row g-2">
                                    <div class="col-md-12">
                                        <div class="form-floating mb-3">
                                            <textarea class="form-control" id="observation" name="observation" disabled style="height: 100px">{{ nl2br($order->observation) }}</textarea>     
                                            <label for="observation">Observaciones</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">

                        <div class="card border-light mb-2 shadow">
                            <div class="card-header">Dirección de entrega</div>
                            <div class="card-body">
                                <div class="row g-2">
                                    <div class="col-md-2">
                                        <div class="form-floating">
                                            <input type="country" class="form-control" id="country" name="country" value="{{ $order->country }}" disabled>
                                            <label for="country">Country</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="province" value="{{ $order->province }}" name="province" disabled>
                                            <label for="province">Provincia</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="city" value="{{ $order->city }}" name="city" disabled>
                                            <label for="city">City</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="zip" value="{{ $order->zip }}" name="zip" disabled>
                                            <label for="zip">Zip</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="row g-2">
                                    <div class="col-md">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="street" value="{{ $order->street }}"  name="street" disabled>
                                            <label for="street">Street</label>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="street2" value="{{ $order->street2 }}" name="street2" disabled>
                                            <label for="street2">Street 2</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card border-light mb-2 shadow">
                            <div class="card-header">Productos</div>
                            <div class="card-body">
                                <div class="row g-2">

                                    <table class="table table-bordered table-sm bg-light">
                                        <thead>
                                            <tr>
                                                <th style="width:40%">Product</th>
                                                <th style="width:15%">Pallet</th>
                                                <th style="width:22%">Price</th>
                                                <th style="width:18%">Qty</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @forelse ($products as $row)
                                    
                                        {{-- <td scope="row">{{ $row->id }}</td> --}}
                                        <td scope="row" class="text-center">{{ $row->product }}</td>
                                        <td class="text-center">{{ $row->pallet }}</td>
                                        <td class="text-center">
                                            @if ($row->currency === 'USD')
                                                {{ number_format($row->price, 0, ',', '.') }} $
                                            @elseif ($row->currency === 'EUR')
                                                {{ number_format($row->price, 0, ',', '.') }} €
                                            @else
                                                {{ number_format($row->price, 0, ',', '.') }}
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $row->net_weight }} kg</td>
                                        
                                    </tr>
                                    @empty
                                        <div class="alert alert-danger" role="alert">
                                            ¡No se encontraron proveedores!
                                        </div>
                                    @endforelse
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <span class="me-2"><a href="{{ route( 'supplier.order', [$supplier->id]) }}" class="btn btn-danger">Cancelar</a></span>
                        <span class="me-2"><a href="{{ route( 'ordersSupplier.edit', [$supplier->id]) }}" class="btn btn-warning btn-md m-2"><i class="fa-solid fa-pencil"></i> Editar</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

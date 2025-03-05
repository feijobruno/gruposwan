@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">

        <div class="mb-1 space-between-elements">

            <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard.index') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('supplier.index') }}"
                        class="text-decoration-none">{{ Str::title($supplier->supplier) }}</a></li>
                <li class="breadcrumb-item active">Edit Order
                <li>
            </ol>
        </div>


        <div class="card mb-4">

            <div class="card-header hstack gap-2">
                <span>{{ Str::title($supplier->supplier) }}</span>
            </div>
            <div class="card-body">

                <x-alert />

                <form class="row" action="{{ route('ordersSupplier.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <input type="hidden" class="form-control" id="supplier_id" name="supplier_id"
                        value="{{ $supplier->id }}">
                    <input type="hidden" class="form-control" id="status" name="status" value="1">

                    <div class="col-6">
                        <div class="card border-light mb-2 shadow">
                            <div class="card-header">Pedido de compra</div>
                            <div class="card-body">

                                <div class="row g-2">

                                    <div class="col-md-3">
                                        <div class="form-floating mb-3">
                                            <select name="buyer" class="form-select" id="buyer"
                                                aria-label="Floating label select example">
                                                <option value="" selected>Choose...</option>
                                                <option {{ $data->buyer === 'Polymer Solutions' ? 'selected' : '' }}
                                                    value="Polymer Solutions">Polymer Solutions</option>
                                                <option {{ $data->buyer === 'Polymer Additives' ? 'selected' : '' }}
                                                    value="Polymer Additives">Polymer Additives</option>
                                            </select>
                                            <label for="buyer">Comprador</label>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="supplier" name="supplier"
                                                placeholder="" value="{{ $supplier->supplier }}">
                                            <label for="supplier">Proveedor</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating mb-3">
                                            <input type="date" class="form-control" id="order_date" name="order_date"
                                                placeholder="" value="">
                                            <label for="order_date">Fecha de compra</label>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-floating mb-3">
                                            <select name="incoterm" class="form-select" id="incoterm"
                                                aria-label="Floating label select example">
                                                <option value="" selected>Choose...</option>
                                                @forelse ($incoterm as $value)
                                                    <option {{ $data->incoterm == $value->incoterm ? 'selected' : '' }} 
                                                        value="{{ $value->incoterm }}">{{ $value->incoterm }}</option>
                                                @empty
                                                @endforelse
                                                
                                            </select>
                                            <label for="incoterm">Incoterm</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-2">
                                    <div class="col-md-3">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="forwarder" name="forwarder"
                                                placeholder="" value="{{ $data->forwarder }}">
                                            <label for="forwarder">Forwarder</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="port" name="port"
                                                placeholder="" value="{{ $data->port }}">
                                            <label for="port">Port</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating mb-3">
                                            <input type="date" class="form-control" id="etd" name="etd"
                                                placeholder="" value="{{ $data->etd }}">
                                            <label for="etd">ETD</label>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-floating mb-3">
                                            <input type="date" class="form-control" id="eta" name="eta"
                                                placeholder="" value="{{ $data->eta }}">
                                            <label for="eta">ETA</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-2">
                                    <div class="col-md-3">
                                        <div class="form-floating mb-3">
                                            <input type="date" class="form-control" id="last_update"
                                                name="last_update" placeholder="" value="{{ $data->last_update }}">
                                            <label for="last_update">Last Update</label>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-floating mb-3">
                                            <input type="date" class="form-control" id="delivery_date"
                                                name="delivery_date" value="{{ $data->delivery_date }}">
                                            <label for="delivery_date">Delivery Date</label>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-floating mb-3">
                                            <input type="date" class="form-control" id="due_date" name="due_date"
                                                placeholder="" value="{{ $data->due_date }}">
                                            <label for="due_date">Due Date</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="destination"
                                                name="destination" placeholder="" value="{{ $data->destination }}">
                                            <label for="destination">Destination</label>
                                        </div>
                                    </div>
                                </div>
    
                                    <div class="row g-2">
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <select name="payment_term" class="form-select" id="payment_term"
                                                aria-label="Floating label select example">
                                                <option value="" selected>Choose...</option>
                                                <option {{ $data->payment_term == '30 days after invoice' ? 'selected' : '' }} value="30 days after invoice">30 days after invoice</option>
                                                <option {{ $data->payment_term == '45 days after invoice' ? 'selected' : '' }} value="45 days after invoice">45 days after invoice</option>
                                                <option {{ $data->payment_term == '60 days after invoice' ? 'selected' : '' }} value="60 days after invoice">60 days after invoice</option>
                                            </select>
                                            <label for="payment_term">Payment Term</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <select name="status" class="form-select" id="status"
                                                aria-label="Floating label select example">
                                                <option value="" selected>Choose...</option>
                                                <option value="30 days after invoice">30 days after invoice</option>
                                                <option value="45 days after invoice">45 days after invoice</option>
                                                <option value="60 days after invoice">60 days after invoice</option>
                                            </select>
                                            <label for="status">Status</label>
                                        </div>
                                    </div>
                                            <div class="col-md-4 p-2">
                                        <input class="form-control" type="file" id="file" name="file">
                                    </div>

                                </div>
                                <div class="row g-2">
                                    <div class="col-md-12">
                                        <div class="form-floating mb-3">
                                            <textarea type="text" class="form-control" id="observation"
                                                name="observation" placeholder="" style="height: 92px">{{ $data->observation }}</textarea>
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
                                            <select name="country" class="form-select" id="country"
                                                aria-label="Floating label select example">
                                                <option selected>Choose...</option>
                                                @forelse ($countries as $country)
                                                    <option {{ $data->country == $country->code ? 'selected' : '' }}
                                                        value="{{ $country->code }}">{{ $country->code }}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                            <label for="country">Country</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="province" value="{{ $data->province }}"
                                                name="province" placeholder="">
                                            <label for="province">Provincia</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="city" value="{{ $data->city }}"
                                                name="city" placeholder="">
                                            <label for="city">City</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="zip" value="{{ $data->zip }}"
                                                name="zip" placeholder="">
                                            <label for="zip">Zip</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="row g-2">
                                    <div class="col-md">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="street" value="{{ $data->street }}"
                                                name="street" placeholder="">
                                            <label for="street">Street</label>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="street2" value="{{ $data->street2 }}"
                                                name="street2" placeholder="">
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

                                    {{-- <form action="{{ route('order.store') }}" method="POST"> --}}
                                    @csrf
                                    @method('POST')
                                    <table class="table table-borderless table-sm">
                                        <thead>
                                            <tr>
                                                <th style="width:40%">Product</th>
                                                <th style="width:15%">Pallet</th>
                                                <th style="width:22%">Price</th>
                                                <th style="width:18%">Qty</th>
                                                <th style="width:5%"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    {{-- <select name="product[]" class="form-select" id="product"
                                                        aria-label="Floating label select example">
                                                        <option selected>Choose...</option>
                                                        @forelse ($products as $product)
                                                            <option {{ old('productos') == $product ? 'selected' : '' }}
                                                                value="{{ $product->product }}">{{ $product->product }}
                                                            </option>
                                                        @empty
                                                        @endforelse
                                                    </select> --}}
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" id="pallet"
                                                        name="pallet[]">
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <input type="number" name="price[]" class="form-control"
                                                            step=".01">
                                                        <div class="input-group-text">
                                                            <select name="currency[]" id="currency"
                                                                style="border: 1px solid transparent; background-color: #e9ecef;">
                                                                <option value="USD">$</option>
                                                                <option value="EUR">€</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <input type="number" name="net_weight[]" class="form-control"
                                                            aria-label="Kg">
                                                        <span class="input-group-text">Kg</span>
                                                    </div>
                                                </td>
                                                <td><button type="button" class="btn btn-primary btn-sm"
                                                        id="add-btn"><i class="fa-solid fa-plus"></i></button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    {{-- <button type="submit" class="btn-primary form-control" id="save"><i class="fa-regular fa-square-plus"></i>Save</button> --}}
                                    {{-- </form> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <span class="me-2"><a href="{{ route( 'supplier.order', [$supplier->id]) }}" class="btn btn-danger">Cancelar</a></span>
                        <button type="submit" class="btn btn-warning btn-md m-2"><i class="fa-regular fa-pen-to-square me-2"></i> Editar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('#add-btn').on('click', function() {
                var html = '';
                html += '<tr>';
                html += '<td>';

                html += '</td>';
                html += '<td><input type="number" class="form-control" id="pallet" name="pallet[]"></td>';
                html +=
                    '<td><div class="input-group"><input type="number" name="price[]" class="form-control" step=".01"><div class="input-group-text"><select name="currency[]" id="currency" style="border: 1px solid transparent; background-color: #e9ecef;"><option value="USD">$</option><option value="EUR">€</option></select></div></div></td>';
                html +=
                    '<td><div class="input-group"><input type="number" name="net_weight[]" class="form-control" aria-label="Euro"> <span class="input-group-text">Kg</span> </div></td>';
                html +=
                    '<td><button type="button" class="btn btn-danger btn-sm" id="remove-btn"><i class="fa-solid fa-minus"></i></button></td></td>';
                html += 'å</tr>'

                $('tbody').append(html);
            })
        });
        $(document).on('click', '#remove-btn', function() {
            $(this).closest('tr').remove();
        });
    </script>
@endpush

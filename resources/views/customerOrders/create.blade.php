
@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">

        <div class="mb-1 space-between-elements">

            <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('customer.index') }}" class="text-decoration-none">{{ $customer->customer }}</a></li>
                <li class="breadcrumb-item active">Purchasing Order<li>
            </ol>
        </div>


        <div class="card mb-4">

            <div class="card-header hstack gap-2">
                <span>{{ $customer->customer }}</span>
            </div> 
            <div class="card-body">

                    <x-alert />

                    <form class="row" action="{{ route('ordersCustomer.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <input type="hidden" class="form-control" id="customer_id" name="customer_id" value="{{ $customer->id }}">
                        <input type="hidden" class="form-control" id="status" name="status" value="1">

                        <div class="col-6">
                            <div class="card border-light mb-2 shadow">
                                <div class="card-header">Pedido de compra</div>
                                <div class="card-body">

                                    <div class="row g-2">
                                        <div class="col-md-2">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="order"
                                                    name="order" placeholder="">
                                                <label for="order">Número</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-floating mb-3">
                                                <input type="date" class="form-control" id="order_date" name="order_date"
                                                    placeholder="">
                                                <label for="order_date">Fecha</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-floating mb-3">
                                                <input type="date" class="form-control" id="delivery_date"
                                                    name="delivery_date" placeholder="">
                                                <label for="delivery_date">Plazo de entrega</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <select name="payment_method" class="form-select" id="payment_method"
                                                            aria-label="Floating label select example">
                                                            <option selected >Choose...</option>
                                      
                                                            <option value="Transf. 60 dias fecha factura">Transf. 60 dias fecha fact.</option>
                                                            <option value="Transf. 45 dias fecha factura">Transf. 45 dias fecha fact.</option>
                                                            <option value="Transf. 30 dias fecha factura">Transf. 30 dias fecha fact.</option>
                                                   
                                                        </select>
                                                <label for="payment_method">Forma de Pago</label>
                                            </div>

                                            
                                        </div>

                                    </div>

                                    <div class="row g-2">

                                        <div class="col-md-8">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="observation"
                                                    name="observation" placeholder="">
                                                <label for="observation">Observaciones</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <select name="status" class="form-select" id="status" aria-label="Floating label select example">
                                                <option selected >Choose...</option>
                                                @forelse ($status_order as $status)
                                                    <option value="{{ $status->id }}">{{ $status->status_desc }}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                            <label for="status">Status</label>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row g-2">
                                        <div class="col-md-6 p-2">
                                            <input class="form-control" type="file" id="file" name="file">
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
                                                    <th style="width:50%">Product</th>
                                                    <th style="width:21%">Price</th>
                                                    <th style="width:21%">Qty</th>
                                                    <th style="width:8%"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <select name="product[]" class="form-select" id="product"
                                                            aria-label="Floating label select example">
                                                            <option selected>Choose...</option>
                                                            @forelse ($products as $product)
                                                                <option {{ old('productos') == $product ? 'selected' : '' }}
                                                                    value="{{ $product->product }}">{{ $product->product }}
                                                                </option>
                                                            @empty
                                                            @endforelse
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <div class="input-group">
                                                            <input type="number" name="price[]" class="form-control" step=".01" aria-label="Euro">
                                                            <span class="input-group-text">€</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="input-group">
                                                            <input type="number" name="qty[]" class="form-control"
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

                        <div class="col-6">
                            <div class="card border-light mb-2 shadow">
                                <div class="card-header">Dirección de facturación </div>
                                <div class="card-body">
                                    <div class="row g-2">
                                        <div class="col-md-2">
                                            <div class="form-floating">
                                                <select name="country" class="form-select" id="country"
                                                    aria-label="Floating label select example">
                                                    <option selected>Choose...</option>
                                                    {{-- @forelse ($countries as $country)
                                                        <option {{ $addressMain?->country == $country ? 'selected' : '' }}
                                                            value="{{ $country }}">{{ $country }}</option>
                                                    @empty
                                                    @endforelse --}}
                                                </select>
                                                <label for="country">Country</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="province"
                                                    name="province"
                                                    {{-- value="{{ old('province', $addressMain?->province) }}" --}}
                                                    value=""
                                                    placeholder="">
                                                <label for="province">Provincia</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="city" name="city"
                                                    {{-- value="{{ old('city', $addressMain?->city) }}"  --}}
                                                    value=""
                                                    placeholder="">
                                                <label for="city">City</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="zip" name="zip"
                                                    {{-- value="{{ old('zip', $addressMain?->zip) }}"  --}}
                                                    value=""
                                                    placeholder="">
                                                <label for="zip">Zip</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-2">
                                        <div class="col-md">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="street" name="street"
                                                    {{-- value="{{ old('street', $addressMain?->street) }}"  --}}
                                                    value=""
                                                    placeholder="">
                                                <label for="street">Street</label>
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="street2" name="street2"
                                                    {{-- value="{{ old('street2', $addressMain?->street2) }}"  --}}
                                                    value=""
                                                    placeholder="">
                                                <label for="street2">Street 2</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card border-light mb-2 shadow">
                                <div class="card-header">Dirección de entrega</div>
                                <div class="card-body">
                                    <div class="row g-2">
                                        <div class="col-md-2">
                                            <div class="form-floating">
                                                <select name="delivery_country" class="form-select" id="delivery_country"
                                                    aria-label="Floating label select example">
                                                    <option selected>Choose...</option>
                                                    {{-- @forelse ($countries as $country)
                                                        <option
                                                            {{ $addressDelivery?->country == $country ? 'selected' : '' }}
                                                            value="{{ $country }}">{{ $country }}</option>
                                                    @empty
                                                    @endforelse --}}
                                                </select>
                                                <label for="delivery_country">Country</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="delivery_province"
                                                    {{-- value="{{ old('delivery_province', $addressDelivery?->province) }}" --}}
                                                    value=""
                                                    name="delivery_province" placeholder="">
                                                <label for="delivery_province">Provincia</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="delivery_city"
                                                    {{-- value="{{ old('delivery_city', $addressDelivery?->city) }}" --}}
                                                    value=""
                                                    name="delivery_city" placeholder="">
                                                <label for="delivery_city">City</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="delivery_zip"
                                                    {{-- value="{{ old('delivery_zip', $addressDelivery?->zip) }}" --}}
                                                    value=""
                                                    name="delivery_zip" placeholder="">
                                                <label for="delivery_zip">Zip</label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row g-2">
                                        <div class="col-md">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="delivery_street"
                                                    {{-- value="{{ old('delivery_street', $addressDelivery?->street) }}" --}}
                                                    value=""
                                                    name="delivery_street" placeholder="">
                                                <label for="delivery_street">Street</label>
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="delivery_street2"
                                                    {{-- value="{{ old('delivery_street2', $addressDelivery?->street2) }}" --}}
                                                    value=""
                                                    name="delivery_street2" placeholder="">
                                                <label for="delivery_street2">Street 2</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <div class="col-2">
                            <button type="submit" class="btn btn-primary btn-md m-2"><i class="fa-solid fa-plus"></i> Añadir</button>
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
                html += '<select name="product[]" class="form-select" id="product" aria-label="Floating label select example">';
                html += ' <option selected>Choose...</option>';
                html += ' @forelse ($products as $product) ';
                html += ' <option {{ old("productos") == $product ? "selected" : "" }} value="{{ $product->product }}">{{ $product->product }} </option>';
                html += ' @empty ';
                html += ' @endforelse';                                        
                html += ' </select>';                                      
                html += '</td>';
                html += '<td><div class="input-group"><input type="number" name="price[]" step=".01" class="form-control" aria-label="Euro"> <span class="input-group-text">€</span> </div> </td>';
                html += '<td><div class="input-group"><input type="number" name="qty[]" class="form-control" aria-label="Euro"> <span class="input-group-text">Kg</span> </div></td>';
                html += '<td><button type="button" class="btn btn-danger btn-sm" id="remove-btn"><i class="fa-solid fa-minus"></i></button></td></td>';
                html += 'å</tr>'

                $('tbody').append(html);
            })
        });
        $(document).on('click', '#remove-btn', function() {
            $(this).closest('tr').remove();
        });
    </script>
@endpush

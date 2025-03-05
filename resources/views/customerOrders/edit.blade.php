
@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">

        <div class="mb-1 space-between-elements">

            <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('customer.index') }}" class="text-decoration-none">Clientes</a></li>
                <li class="breadcrumb-item"><a href="{{ route('customer.order', [$customer->id]) }}" class="text-decoration-none">{{ Str::title($customer->customer) }}</a></li>
                <li class="breadcrumb-item active text-warning">Edit order<li>
            </ol>
        </div>

        <div class="card mb-4">

            <div class="card-header hstack gap-2">
                <span>{{ $customer->customer }} </span>
            </div> 
            
            <div class="card-body">

                    <x-alert />

                    <form class="row" action="{{ route('ordersCustomer.update', ['order' => $order->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" class="form-control" id="id" name="id" value="{{ $order->id }}">
                        <input type="hidden" class="form-control" id="customer_id" name="customer_id" value="{{$order->customer_id}}">

                        <div class="col-6">
                            <div class="card border-light mb-2 shadow">
                                <div class="card-header">Pedido</div>
                                <div class="card-body">

                                    <div class="row g-2">
                                        <div class="col-md-2">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="order" name="order" value="{{ $order->order }}" disabled>
                                                <label for="order">Número</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-floating mb-3">
                                                <input type="date" class="form-control" id="order_date" name="order_date" value="{{ old('order_date', $order->order_date) }}" >
                                                <label for="order_date">Fecha</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-floating mb-3">
                                                <input type="date" class="form-control" id="delivery_date" name="delivery_date" value="{{ old('delivery_date', $order->delivery_date) }}" >
                                                <label for="delivery_date">Plazo de entrega</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <select name="payment_method" class="form-select" id="payment_method" aria-label="Floating label select example" >
                                                    {{-- <option selected>{{ $order->payment_method }}</option> --}}
                                                    @forelse ($payment_method as $value)
                                                        <option {{ $order->payment_method == $value ? 'selected' : '' }}
                                                            value="{{ $value }}">{{ $value }}</option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                                <label for="payment_method">Forma de Pago</label>
                                            </div>

                                            
                                        </div>

                                    </div>

                                    <div class="row g-2">

                                        <div class="col-md-8">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="observation" name="observation" value="{{ old('observation', $order->observation) }}" >
                                                <label for="observation">Observaciones</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 p-2">
                                            <input class="form-control" type="file" id="file" name="file">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="card border-light mb-2 shadow">
                                <div class="card-header">Productos</div>
                                <div class="card-body">
                                    <div class="row g-2">

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
                                                @forelse ($productsData as $product_data)
                                                <tr>
                                                    <td>
                                                        <select name="product[]" class="form-select" id="product"
                                                            aria-label="Floating label select example">
                                                            {{-- <option selected>{{ $product->product }}</option> --}}
                                                            @forelse ($products as $product)
                                                                <option {{ $product->product == $product_data->product ? 'selected' : '' }}
                                                                    value="{{ $product->product }}">{{ $product->product }}
                                                                </option>
                                                            @empty
                                                            @endforelse
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <div class="input-group">
                                                            <input type="number" name="price[]" class="form-control" step=".01" aria-label="Euro" value="{{ $product_data->price }}" >
                                                            <span class="input-group-text">€</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="input-group">
                                                            <input type="number" name="qty[]" class="form-control" aria-label="Kg" value="{{ $product_data->qty }}" >
                                                            <span class="input-group-text">Kg</span>
                                                        </div>
                                                    </td>

                                                    @if ($loop->first)
                                                        <td>{{-- Para primeira linha Inserir o botão de ADICIONAR linhas --}}
                                                            <button type="button" class="btn btn-primary btn-sm" id="add-btn">
                                                                <i class="fa-solid fa-plus"></i>
                                                            </button>
                                                        </td>
                                                    @else
                                                        <td>{{-- Para segunda linha em diante Inserir o botão de REMOVER linhas --}}
                                                            <button type="button" class="btn btn-danger btn-sm" id="remove-btn">
                                                                <i class="fa-solid fa-minus"></i>
                                                            </button>
                                                        </td>
                                                    @endif
                                                    
                                                </tr>
                                                @empty
                                                @endforelse
                                            </tbody>
                                        </table>

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
                                                    {{-- <option selected>{{ $order->country }}</option> --}}
                                                    @forelse ($countries as $country)
                                                        <option {{ $addressMain['country'] == $country->code ? 'selected' : '' }}
                                                            value="{{ $country->code }}">{{ $country->code }}</option>
                                                    @empty
                                                    @endforelse
                                                    
                                                </select>
                                                <label for="country">Country</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="province" name="province" value="{{ $order->province }}" >
                                                <label for="province">Provincia</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="city" name="city" value="{{ $order->city }}" >
                                                <label for="city">City</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="zip" name="zip" value="{{ $order->zip }}" >
                                                <label for="zip">Zip</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-2">
                                        <div class="col-md">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="street" name="street" value="{{ $order->street }}" >
                                                <label for="street">Street</label>
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="street2" name="street2" value="{{ $order->street2 }}" >
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
                                                    {{-- <option selected>{{ $order->delivery_country }}</option> --}}
                                                    @forelse ($countries as $country)
                                                        <option {{ $addressDelivery['delivery_country'] == $country->code ? 'selected' : '' }}
                                                            value="{{ $country->code }}">{{ $country->code }}</option>
                                                    @empty
                                                    @endforelse
                                                    
                                                </select>
                                                <label for="delivery_country">Country</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="delivery_province" value="{{ $order->delivery_province }}" name="delivery_province" >
                                                <label for="delivery_province">Provincia</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="delivery_city" value="{{ $order->delivery_city }}" name="delivery_city" >
                                                <label for="delivery_city">City</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="delivery_zip" value="{{ $order->delivery_zip }}" name="delivery_zip" >
                                                <label for="delivery_zip">Zip</label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row g-2">
                                        <div class="col-md">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="delivery_street" value="{{ $order->delivery_street }}" name="delivery_street" >
                                                <label for="delivery_street">Street</label>
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="delivery_street2" value="{{ $order->delivery_street2 }}" name="delivery_street2" >
                                                <label for="delivery_street2">Street 2</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <div class="col-2">
                            <span class="me-2"><a href="{{ route('customer.order', [$customer->id]) }}" class="btn btn-danger">Cancelar</a></span>
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

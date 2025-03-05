@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 space-between-elements">

            <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard.index') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('supplier.index') }}"
                        class="text-decoration-none">Proveedores</a></li>
                <li class="breadcrumb-item"><a class="text-decoration-none"
                        href="{{ route('supplier.index') }}">{{ is_null($supplier_order?->supplier) ? 'Proveedores' : Str::title($supplier_order->supplier) }}</a>
                </li>
                <li class="breadcrumb-item active">Add batches
                <li>
            </ol>
        </div>
        <div class="card mb-4">

            <div class="card-header hstack gap-2">
                <span>{{ $supplier_order?->supplier }}</span>
            </div>

            <div class="card-body">
                <div class="row">
                <x-alert />
                <div class="col-6">
              
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
                                        @forelse ($supplier_order_items as $row)
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
     
                <div class="col-6">
                    <div class="row">
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
                                        <select name="product[]" class="form-select" id="product"
                                            aria-label="Floating label select example">
                                            <option selected>Choose...</option>
                                            {{-- @forelse ($products as $product)
                                                <option {{ old('productos') == $product ? 'selected' : '' }}
                                                    value="{{ $product->product }}">{{ $product->product }}
                                                </option>
                                            @empty
                                            @endforelse --}}
                                        </select>
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
                        
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection

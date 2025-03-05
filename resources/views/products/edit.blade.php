@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item">
                    <a href="#" class="text-decoration-none">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('product.index') }}" class="text-decoration-none">Producto</a>
                </li>
                <li class="breadcrumb-item active">Editar</li>
            </ol>
        </div>

        <div class="card mb-4">

            <div class="card-header hstack gap-2">
                <span>{{ $product->product }}</span>

                <span class="ms-auto d-sm-flex flex-row">

                    <a href="{{ route('product.index') }}" class="btn btn-secondary btn-sm me-1 mb-1 mb-sm-0"><i
                            class="fa-solid fa-list"></i> Listado</a>

                    <a href="{{ route('product.document', ['product' => $product->id]) }}"
                        class="btn btn-secondary btn-sm me-1 mb-1 mb-sm-0"><i class="fa-regular fa-eye"></i> Visualizar</a>

                </span>
            </div>

            <div class="card-body">

                <x-alert />

                <form class="row g-2" action="{{ route('product.update', ['product' => $product->id]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="col-md-2">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="product" name="product" value="{{ old('product', $product->product) }}" required>
                            <label for="product">Producto</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-floating">
                                <select name="supplier_id" class="form-select" id="supplier_id" aria-label="Floating label select example">
                                    <option value="">Seleccionar</option>
                                    @forelse ($suppliers as $supplier)
                                           <option {{ $supplier->id == $product->supplier_id ? 'selected' : '' }} value="{{ $supplier->id }}">{{ $supplier->supplier }}</option>
                                    @empty
                                    @endforelse
                                </select>
                                <label for="country">Supplier</label>   
                        </div>
                    </div>

                    {{-- <div class="col-md-2">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="packaging_type" name="packaging_type" value="{{ old('packaging_type', $product->packaging_type) }}" >
                            <label for="product">Packaging Type</label>
                        </div>
                    </div> --}}

                    <div class="col-md-2">
                        <div class="form-floating">
                            <select name="packaging_type" class="form-select" id="packaging_type"
                                aria-label="Floating label select example">
                                <option value="" selected>Choose...</option>
                                <option {{ $product->packaging_type == 'BIDON METALICO' ? 'selected' : '' }} value="{{ old('packaging_type', $product->packaging_type) }}" >BIDON METALICO</option>
                                <option {{ $product->packaging_type == 'BIG BAGS' ? 'selected' : '' }} value="{{ old('packaging_type', $product->packaging_type) }}" >BIG BAGS</option>
                                <option {{ $product->packaging_type == 'CAJA' ? 'selected' : '' }} value="{{ old('packaging_type', $product->packaging_type) }}" >CAJA</option>
                                <option {{ $product->packaging_type == 'IBC' ? 'selected' : '' }} value="{{ old('packaging_type', $product->packaging_type) }}" >IBC</option>
                                <option {{ $product->packaging_type == 'GARRAFAS' ? 'selected' : '' }} value="{{ old('packaging_type', $product->packaging_type) }}" >GARRAFAS</option>
                                <option {{ $product->packaging_type == 'SACO' ? 'selected' : '' }} value="{{ old('packaging_type', $product->packaging_type) }}" >SACO</option>
                            </select>
                            <label for="packaging_type">Packaging Type</label>
                        </div>
                    </div>

                    <div class="col-md-1">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="kg" name="kg" value="{{ old('kg', $product->kg) }}" >
                            <label for="weight">KG</label>
                        </div>
                    </div>

                    <div class="col-md-1">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="qty_pallet" name="qty_pallet" value="{{ old('qty_pallet', $product->qty_pallet) }}" >
                            <label for="qty_pallet">QTY Pallet</label>
                        </div>
                    </div>

                    <div class="col-md-1">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="kg_pallet" name="kg_pallet" value="{{ old('kg_pallet', $product->kg_pallet) }}" >
                            <label for="weight_pallet">KG Pallet</label>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="dangerous_material" name="dangerous_material" value="{{ old('dangerous_material', $product->dangerous_material) }}" >
                            <label for="dangerous_material">Material Peligroso</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <span class="me-2"><a href="{{ route('product.index') }}" class="btn btn-danger">Cancelar</a></span>
                        <button type="submit" class="btn btn-warning"><i class="fa-regular fa-pen-to-square me-2"></i> Editar</button>
                    </div>

                </form>

            </div>
        </div>

    </div>
@endsection

@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 space-between-elements">

            <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard.index') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('product.index') }}">Productos</a></li>
                <li class="breadcrumb-item active"> Agregar producto</li>
            </ol>
        </div>

        <x-alert />
        <div class="row mx-1 mb-4">
            <form class="row g-3" action="{{ route('product.store') }}" method="POST">
                @csrf
                @method('POST')
                <div class="row g-2">
                    <div class="col-md-2">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="product" name="product" placeholder="">
                            <label for="product">Producto</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-floating">
                            <select name="supplier_id" class="form-select" id="supplier_id"
                                aria-label="Floating label select example">
                                <option selected>Choose...</option>
                                @forelse ($suppliers as $supplier)
                                    <option {{ old('suppliers') == $supplier ? 'selected' : '' }}
                                        value="{{ $supplier->id }}">
                                        {{ $supplier->supplier }}</option>
                                @empty
                                @endforelse
                            </select>
                            <label for="supplier">Proveedor</label>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-floating">
                            <select name="packaging_type" class="form-select" id="packaging_type"
                                aria-label="Floating label select example">
                                <option value="" selected>Choose...</option>
                                <option value="BIDON METALICO" >BIDON METALICO</option>
                                <option value="BIG BAGS">BIG BAGS</option>
                                <option value="CAJA">CAJA</option>
                                <option value="GARRAFAS">GARRAFAS</option>
                                <option value="IBC" >IBC</option>
                                <option value="SACO">SACO</option>    
                            </select>
                            <label for="packaging_type">Packaging Type</label>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="weight" name="weight" placeholder="">
                            <label for="weight">KG</label>
                        </div>
                    </div>

                    <div class="col-md-1">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="qty_pallet" name="qty_pallet" placeholder="">
                            <label for="qty_pallet">QTY Pallet</label>
                        </div>
                    </div>

                    <div class="col-md-1">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="weight_pallet" name="weight_pallet"
                                placeholder="">
                            <label for="weight_pallet">KG Pallet</label>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="dangerous_material" name="dangerous_material"
                                placeholder="">
                            <label for="dangerous_material">Material Peligroso</label>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary ms-0 mt-2"><i class="fa-solid fa-plus"></i>
                            Añadir</button>
                    </div>
                </div>

                {{-- <div class="col-12">
                        <button type="submit" class="btn btn-success btn-sm">Añadir</button>
                    </div> --}}

            </form>
        </div>
    </div>
@endsection

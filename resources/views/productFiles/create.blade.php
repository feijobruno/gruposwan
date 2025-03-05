@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 space-between-elements">

            <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('product.index') }}">Productos</a></li>
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('product.document', ['product' => $product->id]) }}"> {{ $product->product }}</a></li>
                <li class="breadcrumb-item active"> Agregar documento</li>
            </ol>
        </div>

        <x-alert />
        <div class="row mx-1 mb-4">
            <form class="row g-3" action="{{ route('productFile.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <input type="hidden" class="form-control" id="product_id" name="product_id" value="{{ $product->id }}">
                <div class="row g-2">
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="name" name="name" placeholder="">
                            <label for="name">Nombre</label>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-floating">
                            <select name="type" id="type" class="form-select">
                                <option value="" selected>Choose...</option>
                                <option value="TDS">TDS</option>
                                <option value="SDS">SDS</option>
                                <option value="Technical">Technical</option>
                            </select>
                            <label for="type">Tipo</label>
                        </div>
                    </div>

                    <div class="col-md-4 p-2">
                        <input class="form-control" type="file" id="file" name="file">
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-2">
                        <span class="me-2"><a href="{{ route( 'product.document', ['product' => $product->id]) }}" class="btn btn-danger">Cancelar</a></span>
                        <button type="submit" class="btn btn-primary ms-0"><i class="fa-solid fa-plus"></i> Añadir</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

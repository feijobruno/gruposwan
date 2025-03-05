@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 space-between-elements">

            <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('product.index') }}">Productos</a></li>
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('product.document', ['product' => $product->id]) }}"> {{ $product->product }}</a></li>
                <li class="breadcrumb-item active">Editar documento</li>
            </ol>
        </div>

        <x-alert />
        <div class="row mx-1 mb-4">
            <form class="row g-3" action="{{ route('productFile.update', ['file'=> $product->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                {{-- <input type="hidden" class="form-control" id="product_id" name="product_id" value="{{ $product->product_id }}"> --}}
                <div class="row g-2">
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="name" name="name" placeholder="" value="{{ $product->name }}">
                            <label for="name">Nombre</label>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-floating">
                            <select name="type" id="type" class="form-select">
                                <option value="" selected>Choose...</option>
                                <option {{ $product->type == 'TDS' ? 'selected' : '' }} value="TDS">TDS</option>
                                <option {{ $product->type == 'SDS' ? 'selected' : '' }} value="SDS">SDS</option>
                                <option {{ $product->type == 'Technical' ? 'selected' : '' }} value="Technical">Technical</option>
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
                        <button type="submit" class="btn btn-warning ms-0"><i class="fa-regular fa-pen-to-square me-2"></i> </i> Editar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

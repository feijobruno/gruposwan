@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            {{-- <h2 class="mt-3">Proveedor</h2> --}}

            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item">
                    <a href="#" class="text-decoration-none">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('supplier.index') }}" class="text-decoration-none">Proveedores</a>
                </li>
                <li class="breadcrumb-item active">Editar</li>
            </ol>
        </div>

        <div class="card mb-4">

            <div class="card-header hstack gap-2">
                <span>{{ $data->supplier }}</span>
                <span class="ms-auto d-sm-flex flex-row">
                    <a href="{{ route('supplier.index') }}" class="btn btn-secondary btn-sm me-1 mb-1 mb-sm-0"><i
                            class="fa-solid fa-list"></i> Listado</a>
                </span>
            </div>

            <div class="card-body">

                <x-alert />

                <form class="row g-3" action="{{ route('supplier.update', ['supplier' => $data->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                        <div class="row g-2">
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="supplier" name="supplier" value="{{ old('supplier', $data->supplier) }}" required>
                                    <label for="supplier">Supplier</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-floating">
                                    <select name="country" class="form-select" id="country" aria-label="Floating label select example">
                                        <option value="" selected>Choose...</option>
                                        @forelse ($countries as $country)
                                               <option {{ $country->country == $data->country ? 'selected' : '' }} value="{{ $country->country }}">{{ $country->country }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    <label for="country">Country</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="province" name="province" value="{{ old('province', $data->province) }}">
                                    <label for="province">Provincia</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="zip" name="zip" value="{{ old('zip', $data->zip) }}">
                                    <label for="zip">Zip</label>
                                </div>
                            </div>
                        </div>

                        <div class="row g-2">
                            <div class="col-md-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="city" name="city" value="{{ old('city', $data->city) }}">
                                    <label for="city">City</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="street" name="street" value="{{ old('street', $data->street) }}"> 
                                    <label for="street">Street</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="street2" name="street2" value="{{ old('street2', $data->street2) }}">
                                    <label for="street2">Street 2</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <span class="me-2"><a href="{{ route('supplier.index') }}" class="btn btn-danger">Cancelar</a></span>
                            <button type="submit" class="btn btn-warning"><i class="fa-regular fa-pen-to-square me-2"></i> Editar</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection

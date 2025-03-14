@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">

        <div class="mb-1 space-between-elements">
            {{-- <h2 class="ms-2 mt-3 me-3">Usuario</h2> --}}
            <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item">
                    <a href="{{ route('supplier.index') }}" class="text-decoration-none">Proveedores</a>
                </li>
                <li class="breadcrumb-item active">Proveedor</li>
            </ol>
        </div>


        <div class="card mb-4">

            {{-- <div class="card-header hstack gap-2">
                <span></span>
                <span class="ms-auto d-sm-flex flex-row">
                    <a href="{{ route('supplier.index') }}" class="btn btn-secondary btn-sm me-1 mb-1 mb-sm-0"><i
                            class="fa-solid fa-list"></i> Listado</a>
                </span>
            </div> --}}

            <div class="card-body">

                <x-alert />

                <form class="row g-3" action="{{ route('supplier.store') }}" method="POST">
                    @csrf
                    @method('POST')
                        <div class="row g-2">
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="supplier" name="supplier" placeholder="">
                                    <label for="supplier">Supplier</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-floating">
                                    <select name="country" class="form-select" id="country" aria-label="Floating label select example">
                                        <option value="" selected>Choose...</option>
                                        @forelse ($countries as $row)
                                            <option {{ old('countries') == $row ? 'selected' : '' }} value="{{ $row->country }}">{{ $row->country  }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    <label for="country">Country</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="province" name="province" placeholder="">
                                    <label for="province">Provincia</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="zip" name="zip" placeholder="">
                                    <label for="zip">Zip</label>
                                </div>
                            </div>
                        </div>

                        <div class="row g-2">
                            <div class="col-md-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="city" name="city" placeholder="">
                                    <label for="city">City</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="street" name="street" placeholder="">
                                    <label for="street">Street</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="street2" name="street2" placeholder="">
                                    <label for="street2">Street 2</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <span class="me-2"><a href="{{ route( 'supplier.index') }}" class="btn btn-danger">Cancelar</a></span>
                            <button type="submit" class="btn btn-primary btn-md">Añadir</button>
                        </div>
                        
                </form>
            </div>
        </div>
    </div>
@endsection

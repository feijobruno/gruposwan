@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">

        <div class="mb-1 space-between-elements">

            <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
               <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('customer.index') }}" class="text-decoration-none">Clientes</a></li>
                <li class="breadcrumb-item active">Añadir<li>
            </ol>
        </div>


        <div class="card mb-4">

            <div class="card-body">

                <div class="row">
                    <x-alert />


                    <form class="row" action="{{ route('customer.store') }}" method="POST">
                        @csrf
                        @method('POST')

                        <div class="col-6">
                            <div class="card border-light mb-3">
                                <div class="card-header">Cliente</div>
                                <div class="card-body">


                                    <div class="row g-2">
                                        <div class="col-md-8">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="customer" name="customer"
                                                    placeholder="">
                                                <label for="customer">Cliente</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="vat" name="vat"
                                                    placeholder="">
                                                <label for="vat">Vat</label>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row g-2">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="email" name="email"
                                                    placeholder="">
                                                <label for="email">E-mail</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="phone" name="phone"
                                                    placeholder="">
                                                <label for="phone">Teléfono</label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="card border-light mb-3">
                                <div class="card-header">Datos bancarios</div>
                                <div class="card-body">
                                    <div class="row g-2">
                                        <div class="col-md-8">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="bank_id"
                                                    name="bank_id" placeholder="">
                                                <label for="bank_id">Bank</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="bank_id_acc_number"
                                                    name="bank_id_acc_number" placeholder="">
                                                <label for="bank_id_acc_number">Bank Acc Number</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row g-2">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="bank_swift" name="bank_swift"
                                                    placeholder="">
                                                <label for="bank_swift">Swift</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="bank_iban" name="bank_iban"
                                                    placeholder="">
                                                <label for="bank_iban">Iban</label>
                                            </div>
                                        </div>

                                    </div>


                                </div>
                            </div>
                        </div>


                        <div class="col-6">
                            <div class="card border-light mb-3">
                                <div class="card-header">Dirección de facturación </div>
                                <div class="card-body">
                                    <div class="row g-2">
                                        <div class="col-md-3">
                                            <div class="form-floating">
                                                <select name="country" class="form-select" id="country" aria-label="Floating label select example">
                                                    <option value="" selected>Choose...</option>
                                                    @forelse ($countries as $row)
                                                        <option value="{{ $row->country }}">{{ $row->country  }}</option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                                <label for="country">Country</label>
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="province" name="province"
                                                    placeholder="">
                                                <label for="province">Provincia</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-2">
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="zip" name="zip"
                                                    placeholder="">
                                                <label for="zip">Zip</label>
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="city" name="city"
                                                    placeholder="">
                                                <label for="city">City</label>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row g-2">
                                        <div class="col-md">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="street" name="street"
                                                    placeholder="">
                                                <label for="street">Street</label>
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="street2" name="street2"
                                                    placeholder="">
                                                <label for="street2">Street 2</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>

                        <div class="col-6">
                            <div class="card border-light mb-3">
                                <div class="card-header">Dirección de entrega</div>
                                <div class="card-body">
                                    <div class="row g-2">
                                        <div class="col-md-3">
                                            <div class="form-floating">
                                                <select name="delivery_country" class="form-select" id="delivery_country" aria-label="Floating label select example">
                                                    <option value="" selected>Choose...</option>
                                                    @forelse ($countries as $row)
                                                        <option {{ old('countries') == $row ? 'selected' : '' }} value="{{ $row->country }}">{{ $row->country  }}</option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                                <label for="delivery_country">Country</label>
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="delivery_province"
                                                    name="delivery_province" placeholder="">
                                                <label for="delivery_province">Provincia</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-2">
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="delivery_zip"
                                                    name="delivery_zip" placeholder="">
                                                <label for="delivery_zip">Zip</label>
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="delivery_city"
                                                    name="delivery_city" placeholder="">
                                                <label for="delivery_city">City</label>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row g-2">
                                        <div class="col-md">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="delivery_street"
                                                    name="delivery_street" placeholder="">
                                                <label for="delivery_street">Street</label>
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="delivery_street2"
                                                    name="delivery_street2" placeholder="">
                                                <label for="delivery_street2">Street 2</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>

                <button type="submit" class="btn btn-primary btn-md m-2">Añadir</button>

                </form>
            </div>
        </div>
    </div>
@endsection

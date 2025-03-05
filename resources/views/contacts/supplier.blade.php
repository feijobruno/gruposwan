@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            {{-- <h2 class="mt-3">Cliente</h2> --}}
            
            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item">
                    <a href="#" class="text-decoration-none">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('customer.index') }}" class="text-decoration-none">Clientes</a>
                </li>
                <li class="breadcrumb-item active">Contacto</li>
            </ol>
        </div>

        <div class="card mb-4">

            <div class="card-header hstack gap-2">
                <span>{{ $supplier->supplier }}</span>
                <span class="ms-auto d-sm-flex flex-row">
                    <a href="{{ route('supplier.index') }}" class="btn btn-secondary btn-sm me-1 mb-1 mb-sm-0"><i
                            class="fa-solid fa-list"></i> Listado</a>
                </span>
            </div>

            <div class="card-body">

                <x-alert />

                <form class="row g-3" action="{{ route('contactSupplier.store', ['supplier' => $supplier->id ]) }}" method="POST">
                    @csrf
                    @method('POST')
                        <div class="row g-2">
                            <div class="col-md-3">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="">
                                    <label for="name">Nombre</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-floating mb-3">
                                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="">
                                    <label for="phone">Phone</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="">
                                    <label for="email">Email</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="position" name="position" placeholder="">
                                    <label for="position">Position</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="post" name="post" placeholder="">
                                    <label for="post">Post</label>
                                </div>
                            </div> 
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-md">Añadir</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection

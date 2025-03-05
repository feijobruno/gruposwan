@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">

        <div class="mb-1 space-between-elements">

            <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('customer.index') }}" class="text-decoration-none">Clientes</a></li>
                <li class="breadcrumb-item active">Reuniones</li>
            </ol>
        </div>

        <div class="card mb-4">

            <div class="card-header hstack gap-2">
                <span>{{ $entity_name }}</span>
            </div>

            <div class="card-body">

                <x-alert />

                <form class="row g-3" action="{{ route('metting.store', ['entity' => $entity, 'id' => $entityData->id ]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                        <div class="row g-2">
                            <div class="col-md-3 p-2">
                                <div class="form-floating mb-3">
                                    <input class="form-control" type="text" id="metting_name" name="metting_name">
                                    <label for="metting_name">Metting Name</label>
                                </div>
                            </div>
                            <div class="col-md-3 p-2">
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control" id="metting_date" name="metting_date" placeholder="">
                                    <label for="name">Metting Date</label>
                                </div>
                            </div>
                            <div class="col-md-4 p-2">
                                <input class="form-control" type="file" id="file" name="file">
                            </div>
                        </div>
                        <div class="col-12">
                            <span class="me-2"><a href="{{ route( $entity.".index") }}" class="btn btn-danger">Cancelar</a></span>
                            <button type="submit" class="btn btn-primary btn-md">Añadir</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection

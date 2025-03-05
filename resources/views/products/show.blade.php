@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
       
        <div class="mb-1 space-between-elements">

            <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('customer.index') }}" class="text-decoration-none">Productos</a></li>
                <li class="breadcrumb-item active">{{ $data->product }}</li>
            </ol>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" id="order-tab" data-toggle="tab" href="#order" role="tab"
                            aria-controls="order" aria-selected="true">Pedidos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tds-sds-tab" data-toggle="tab" href="#tds-sds" role="tab"
                            aria-controls="order" aria-selected="false">TDS - SDS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="technical-tab" data-toggle="tab" href="#technical" role="tab"
                            aria-controls="technical" aria-selected="false">Technical</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="presentation-tab" data-toggle="tab" href="#presentation" role="tab"
                            aria-controls="presentation" aria-selected="false">Presentaciones</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                
                <x-alert />

                <div class="tab-content" id="myTabContent">

                    <div class="tab-pane fade show active" id="order" role="tabpanel" aria-labelledby="order-tab">
                        <div class="row">
                            Pedidos
                        </div>
                    </div>

                    <div class="tab-pane fade" id="tds-sds" role="tabpanel" aria-labelledby="tds-sds-tab">
                        <div class="row">
                            PDS - SDS
                        </div>
                    </div>

                    <div class="tab-pane fade" id="technical" role="tabpanel" aria-labelledby="technical-tab">
                        <div class="row">
                            Technical
                        </div>
                    </div>

                    <div class="tab-pane fade" id="presentation" role="tabpanel" aria-labelledby="presentation-tab">
                        <div class="row">
                            Presentaciones
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

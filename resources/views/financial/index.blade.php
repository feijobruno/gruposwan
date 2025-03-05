@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">

        <div class="mb-1 space-between-elements">

            <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Financiero</li>
            </ol>
        </div>

        <div class="card mb-4">

            <div class="card-header hstack gap-2">
                <span>Financiero</span>

                <span class="ms-auto">
                    {{-- @can('financial-create') --}}
                        <a href="#" class="btn btn-primary btn-sm"><i
                                class="fa-regular fa-square-plus"></i> Añadir</a>
                    {{-- @endcan --}}
                </span>
            </div>

            <div class="card-body">

                <x-alert />

            </div>
        </div>
    </div>
@endsection

@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 hstack gap-2">
            {{-- <h2 class="mt-3">Dashboard</h2> --}}

            <ol class="breadcrumb mb-3 mt-3 ms-auto">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard.index') }}" class="text-decoration-none">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Template</li>
            </ol>
        </div>

        <div class="card mb-4">

            <div class="card-header hstack gap-2">
                <span>Template</span>

                <span class="ms-auto d-sm-flex flex-row">

                </span>
            </div>

            <div class="card-body">

                <x-alert />

                <div class="row">

                    

                </div>

            </div>
        </div>

    </div>
@endsection

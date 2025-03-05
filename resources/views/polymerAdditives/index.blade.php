@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">

        <div class="mb-1 space-between-elements">

            <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item">Polymer Additives</li>
                <li class="breadcrumb-item active">Supplier Orders</li>
            </ol>
        </div>

        <div class="card mb-4">

            <div class="card-header hstack gap-2">
                <span>Polymer Additives</span>

                {{-- <span class="ms-auto">
                     @can('financial-create') 
                        <a href="#" class="btn btn-primary btn-sm"><i
                                class="fa-regular fa-square-plus"></i> Añadir</a>
                    @endcan
                </span> --}}
            </div>

             <div class="card-body">

                <x-alert />

                <div class="row">
                    <div class="hstack gap-2">

                        {{-- <span class="ms-auto">

                            <a href="{{ route('ordersSupplier.create', ['supplier' => $supplier ]) }}"
                                class="btn btn-primary btn-sm me-3"><i class="fa-solid fa-plus"></i> Añadir</a>
                        </span> --}}
                    </div>
                    <div class="table-responsive px-4 mt-3" id="orders">
                        <table id ="table" class="dataTable table table-striped table-hover table-bordered nowrap table-sm"
                        style="width:100%">

                        <thead>
                            <tr>
                                {{-- <th scope="col" class="text-center">Id</th> --}}
                                <th scope="col" class="text-center">Pedido</th>
                                <th scope="col" class="text-center">Proveedor</th>
                                <th scope="col" class="text-center">Comprador</th>
                                <th scope="col" class="text-center">Fecha Compra</th>
                                <th scope="col" class="text-center">Fecha Entrega</th>
                                <th scope="col" class="text-center">Last Update</th>
                                <th scope="col" class="text-center">Productos</th>
                                <th scope="col" class="text-center">Amount</th>
                                <th scope="col" class="text-center">Total Weight</th>
                                <th scope="col" class="text-center">Status</th>
                                <th scope="col" class="text-center">Archivos</th>
                                <th scope="col" class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>

                            {{-- Print the records --}}
                            @forelse ($data as $row)
                                <tr>
                                    {{-- <td scope="row">{{ $row->id }}</td> --}}
                                    <td scope="row" class="text-center">{{ $row->order }}</td>
                                    <td class="text-center">{{ $row->supplier }}</td>
                                    <td class="text-center">{{ $row->buyer }}</td>
                                    <td class="text-center">{{ $row->order_date ? date('d/m/Y', strtotime($row->order_date)) :  null }}</td>
                                    <td class="text-center">{{ $row->delivery_date ? date('d/m/Y', strtotime($row->delivery_date)) :  null }}</td>
                                    <td class="text-center"> {{ $row->last_update ? date('d/m/Y', strtotime($row->last_update)) :  null }}</td>
                                    <td class="text-center breakLine"> {{ $row->products }}</td>
                                    <td class="text-center"> 
                                        @if ($row->currency === 'USD')
                                        {{ number_format($row->amount, 0, ',', '.')}} $
                                        @elseif ($row->currency === 'EUR')
                                        {{ number_format($row->amount, 0, ',', '.')}} €

                                        @else
                                        {{ number_format($row->amount, 0, ',', '.')}} 
                                        @endif
                                    </td>
                                    <td class="text-center">{{ number_format($row->total_net_weight, 0, ',', '.')}} kg</td>
                                    <td class="text-center">
                                        @if ($row->status === 1)
                                         <span class="badge rounded-pill bg-warning text-dark">Pendiente</span>
                                        @endif
                                    </td>
                                    <td></td>
                                    {{-- <td class="text-center"><a href="/img/orders/{{ $row->file }}" class="text-decoration-none"
                                            download>
                                            @if ($row->file)
                                                <i
                                                    class="fa-regular fa-file-pdf text-center link-secondary link-underline link-underline-opacity-0"></i>
                                            @endif
                                        </a></td> --}}
                                    <td>
                                        <a href="#" class="text-decoration-none"><i class="fa-regular fa-eye text-secondary me-2 text-secondary"></i></a>
                                      
                                    </td>

                                </tr>
                                                                @empty
                            @endforelse 
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
<script>
$('.breakLine').each(function () { 
    $(this).html($(this).html().replace(",", "<br>")); 
})
</script>
 @endpush
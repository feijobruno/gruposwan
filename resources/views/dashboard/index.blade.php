@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 space-between-elements">

            <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">

                <li class="breadcrumb-item active">Dashboard - (Out/24)</li>
            </ol>
        </div>

  
                <x-alert />

                <div class="row">


{{-- <div class="bd-callout bd-callout-info">
<h5 id="conveying-meaning-to-assistive-technologies">Conveying meaning to assistive technologies</h5>
<p>Using color to add meaning only provides a visual indication, which will not be conveyed to users of assistive technologies – such as screen readers. Ensure that information denoted by the color is either obvious from the content itself (e.g. the visible text), or is included through alternative means, such as additional text hidden with the <code>.visually-hidden</code> class.
</div> --}}



                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-2 col-md-6 mb-4">
                            <div class="card py-2 bd-callout bd-callout-success shadow-sm p-3 mb-5 bg-body rounded">
                                <div class="card-body ">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Clientes (Out/24)</div>
                                            <div class="h5 mb-0 font-weight-bold text-secondary">€ 538,720</div>
                                        </div>
                                        {{-- <div class="col-auto">
                                            <i class="fa-solid fa-euro-sign fa-2x text-secondary"></i>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-6 mb-4">
                            <div class="card py-2 bd-callout bd-callout-success shadow-sm p-3 mb-5 bg-body rounded">
                                <div class="card-body ">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Clientes Qty(Out/24)</div>
                                            <div class="h5 mb-0 font-weight-bold text-secondary"> 215</div>
                                        </div>
                                        {{-- <div class="col-auto">
                                            <i class="fa-solid fa-euro-sign fa-2x text-secondary"></i>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-2 col-md-6 mb-4">
                            <div class="card py-2 bd-callout bd-callout-primary shadow-sm p-3 mb-5 bg-body rounded">
                                <div class="card-body ">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Proveedores</div>
                                            <div class="h5 mb-0 font-weight-bold text-secondary">€ 340,000</div>
                                        </div>
                                        {{-- <div class="col-auto">
                                            <i class="fa-solid fa-euro-sign fa-2x text-secondary"></i>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-6 mb-4">
                            <div class="card py-2 bd-callout bd-callout-primary shadow-sm p-3 mb-5 bg-body rounded">
                                <div class="card-body ">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Proveedores Qty</div>
                                            <div class="h5 mb-0 font-weight-bold text-secondary"> 120</div>
                                        </div>
                                        {{-- <div class="col-auto">
                                            <i class="fa-solid fa-euro-sign fa-2x text-secondary"></i>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-2 col-md-6 mb-4">
                            <div class="card py-2 bd-callout bd-callout-danger shadow-sm p-3 mb-5 bg-body rounded">
                                <div class="card-body ">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Low Stock</div>
                                            <div class="h5 mb-0 font-weight-bold text-secondary">15</div>
                                        </div>
                                        {{-- <div class="col-auto">
                                            <i class="fa-solid fa-euro-sign fa-2x text-secondary"></i>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
{{-- 
                        <div class="col-xl-2 col-md-6 mb-4">
                            <div class="card py-2 bd-callout bd-callout-danger shadow-sm p-3 mb-5 bg-body rounded">
                                <div class="card-body ">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Ventas (Ago/24)</div>
                                            <div class="h5 mb-0 font-weight-bold text-secondary">€ 340,000</div>
                                        </div>
                                        {{-- <div class="col-auto">
                                            <i class="fa-solid fa-euro-sign fa-2x text-secondary"></i>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div> --}}


                    {{-- <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body"> 234 - Pedidos realizados </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="#">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-success text-white mb-4">
                            <div class="card-body">Vendas - € 150,000.00</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="#">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-warning text-white mb-4">
                            <div class="card-body">Warning Card</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="#">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-danger text-white mb-4">
                            <div class="card-body">Danger Card</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="#">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div> --}}
                </div>

    
    </div>
@endsection

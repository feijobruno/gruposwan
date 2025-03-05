@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">

        <div class="mb-1 space-between-elements">

            <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('supplier.index') }}" class="text-decoration-none">Proveedores</a></li>
                <li class="breadcrumb-item">
                    {{-- <a class="text-decoration-none" href="{{ route('supplier.index') }}">
                            {{ is_null($supplier?->supplier) ? 'Proveedores' : Str::title($supplier->supplier) }} 
                    </a> --}}
                </li>
                {{-- <li class="breadcrumb-item active">Purchasing Order<li> --}}
            </ol>
        </div>


        <div class="card mb-4">

            {{-- <div class="card-header hstack gap-2">
                <span>{{ $supplier?->supplier }}</span>
            </div> --}}
            <div class="card-body">

                <x-alert />

              <form class="row" action="{{ route('ordersPa.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <input type="hidden" class="form-control" id="status" name="status" value="1">
                    <div class="col-6">
                        <div class="card border-light mb-2 shadow">
                            <div class="card-header">Pedido de compra</div>
                            <div class="card-body">

                                <div class="row g-2">

                                    <div class="col-md-3">
                                        <div class="form-floating mb-3">
                                            <select name="buyer" class="form-select" id="buyer"
                                                aria-label="Floating label select example">
                                                <option value="" selected>Choose...</option>
                                                <option value="Polymer Solutions">Polymer Solutions</option>
                                                <option value="Polymer Additives">Polymer Additives</option>
                                            </select>
                                            <label for="buyer">Comprador</label>
                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        <div class="form-floating mb-3">
                                            <input type="date" class="form-control" id="order_date" name="order_date"
                                                placeholder="">
                                            <label for="order_date">Fecha de compra</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating mb-3">
                                            <select name="incoterm" class="form-select" id="incoterm"
                                                aria-label="Floating label select example">
                                                <option value="" selected>Choose...</option>
                                                @forelse ($incoterm as $value)
                                                    <option value="{{ $value->id }}">{{ $value->incoterm }}</option>
                                                @empty
                                                @endforelse
                                                
                                            </select>
                                            <label for="incoterm">Incoterm</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating mb-3">
                                            <input type="date" class="form-control" id="delivery_date"
                                                name="delivery_date" placeholder="">
                                            <label for="delivery_date">Fecha de entrega</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-2">
                                    
                                    {{-- <div class="col-md-3">
                                        <div class="form-floating mb-3">
                                            <input type="date" class="form-control" id="last_update"
                                                name="last_update" placeholder="">
                                            <label for="last_update">Last Update</label>
                                        </div>
                                    </div> --}}

                                    {{-- <div class="col-md-3">
                                        <div class="form-floating mb-3">
                                            <input type="date" class="form-control" id="due_date" name="due_date"
                                                placeholder="">
                                            <label for="due_date">Due Date</label>
                                        </div>
                                    </div> --}}

                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <select name="payment_term" class="form-select" id="payment_term"
                                                aria-label="Floating label select example">
                                                <option value="" selected>Choose...</option>
                                                <option value="30 days after invoice">30 days after invoice</option>
                                                <option value="45 days after invoice">45 days after invoice</option>
                                                <option value="60 days after invoice">60 days after invoice</option>
                                            </select>
                                            <label for="payment_term">Payment Term</label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 p-2">
                                        <input class="form-control" type="file" id="file" name="file">
                                    </div>

                                </div>
                                <div class="row g-2">
                                </div>
                                <div class="row g-2">
                                    <div class="col-md-12">
                                        <div class="form-floating mb-3">
                                            <textarea type="text" class="form-control" id="observation"
                                                name="observation" placeholder="" style="height: 92px"></textarea>
                                            <label for="observation">Observaciones</label>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">

                        <div class="card border-light mb-2 shadow">
                            <div class="card-header">Productos</div>
                            <div class="card-body">
                                <div class="row g-2">

                                    {{-- <form action="{{ route('order.store') }}" method="POST"> --}}
                                    @csrf
                                    @method('POST')
                                    <table class="table table-borderless table-sm">
                                        <thead>
                                            <tr>
                                                <th style="width:40%">Product</th>
                                                <th style="width:15%">Pallet</th>
                                                <th style="width:22%">Price</th>
                                                <th style="width:18%">Qty</th>
                                                <th style="width:5%"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <select name="id_product[]" class="form-select" id="id_product"
                                                        aria-label="Floating label select example">
                                                        <option selected>Choose...</option>
                                                        @forelse ($products as $product)
                                                            <option {{ old('productos') == $product ? 'selected' : '' }}
                                                                value="{{ $product->id }}">{{ $product->product }}
                                                            </option>
                                                        @empty
                                                        @endforelse
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" id="pallet"
                                                        name="pallet[]">
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <input type="number" name="price[]" class="form-control"
                                                            step=".01">
                                                        <div class="input-group-text">
                                                            <select name="currency[]" id="currency"
                                                                style="border: 1px solid transparent; background-color: #e9ecef;">
                                                                <option value="USD">$</option>
                                                                <option value="EUR">€</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <input type="number" name="net_weight[]" class="form-control"
                                                            aria-label="Kg">
                                                        <span class="input-group-text">Kg</span>
                                                    </div>
                                                </td>
                                                <td><button type="button" class="btn btn-primary btn-sm"
                                                        id="add-btn"><i class="fa-solid fa-plus"></i></button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    {{-- <button type="submit" class="btn-primary form-control" id="save"><i class="fa-regular fa-square-plus"></i>Save</button> --}}
                                    {{-- </form> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col">
                        <span class="me-2"><a href="{{ route( 'supplier.order', [$supplier->id]) }}" class="btn btn-danger">Cancelar</a></span>
                        <button type="submit" class="btn btn-primary btn-md m-2"><i class="fa-solid fa-plus"></i>
                            Añadir</button> 
                    </div> --}}
                    <div>
                        <p id="testeP"></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#add-btn').on('click', function() {
                var html = '';
                html += '<tr>';
                html += '<td>';
                html +=
                    '<select name="id_product[]" class="form-select" id="id_product" aria-label="Floating label select example">';
                html += ' <option selected>Choose...</option>';
                html += ' @forelse ($products as $product) ';
                html +=
                    ' <option {{ old('products') == $product ? 'selected' : '' }} value="{{ $product->id }}">{{ $product->product }} </option>';
                html += ' @empty ';
                html += ' @endforelse';
                html += ' </select>';
                html += '</td>';
                html += '<td><input type="number" class="form-control" id="pallet" name="pallet[]"></td>';
                html +=
                    '<td><div class="input-group"><input type="number" name="price[]" class="form-control" step=".01"><div class="input-group-text"><select name="currency[]" id="currency" style="border: 1px solid transparent; background-color: #e9ecef;"><option value="USD">$</option><option value="EUR">€</option></select></div></div></td>';
                html +=
                    '<td><div class="input-group"><input type="number" name="net_weight[]" class="form-control" aria-label="Euro"> <span class="input-group-text">Kg</span> </div></td>';
                html +=
                    '<td><button type="button" class="btn btn-danger btn-sm" id="remove-btn"><i class="fa-solid fa-minus"></i></button></td></td>';
                html += 'å</tr>'

                $('tbody').append(html);
            })
        });
        $(document).on('click', '#remove-btn', function() {
            $(this).closest('tr').remove();
        });

        $("#customer_select").hide();
        $("#warehouse_select").hide();

        $("#destination").on('change', function(){
            this.value === "customer" && $("#customer_select").show() && $("#warehouse_select").hide();
            this.value === "warehouse" && $("#warehouse_select").show() && $("#customer_select").hide();
            this.value === "other" && $("#customer_select").hide() & $("#warehouse_select").hide();
            this.value === "" && $("#customer_select").hide() & $("#warehouse_select").hide();
        });

        // Ao selecionar o cliente, é realizada uma busca no banco pelos dados de endereço.
        $("#customer").change(function(){
            var selectedValue = $(this).val();
            
            $.ajax({
                url: '/find-data-customer', 
                data: {
                    id: selectedValue
                },
                success: function(data) { // Em caso de sucesso na busca retorna os dados do Customer
                    if(data){
                        
                        $("#country").val(data['country']);
                        $("#province").val(data['province']);
                        $("#city").val(data['city']);
                        $("#zip").val(data['zip']);
                        $("#street").val(data['street']);
                        $("#street2").val(data['street2']);

                    }else{

                        $("#country").val("");
                        $("#province").val("");
                        $("#city").val("");
                        $("#zip").val("");
                        $("#street").val("");
                        $("#street2").val("");

                    }                
                }
            });
        });

    </script>
@endpush
@extends('Layouts.Dashboard.master')
@php
    App::setLocale(Session::get("locale") != null ? Session::get("locale") : "en");
@endphp
@section('css')

@endsection

@section('js')

@endsection

@section('title')

@endsection

@section('title-side')

@endsection


@section('Headtitle')

@endsection



@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Add Product Form</h4>


                    <div class="alert alert-danger col-sm-6 print-error-msg" style="display:none" role="alert">

                        @foreach ($errors->all() as $error)
                            <ul> {{$error}}</ul>
                        @endforeach
                    </div>
                    <form action="{{ route('orders.store') }}" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                Products
                            </div>

                            <div class="card-body">
                                <table class="table" id="products_table">
                                    <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr id="product0">
                                        <td>
                                            <select name="products[]" class="form-control">
                                                <option value="">-- choose product  (price) --</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}">
                                                        {{ $product->name }} ({{ number_format($product->price, 2) }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" min="1" name="quantities[]" class="form-control" value="1" />
                                        </td>
                                    </tr>
                                    <tr id="product1"></tr>
                                    </tbody>
                                </table>

                                <div class="row">
                                    <div class="col-md-12">
                                        <button id="add_row" class="btn btn-default pull-left">+ Add Row</button>
                                        <button id='delete_row' class="pull-right btn btn-danger">- Delete Row</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <input class="btn btn-danger" type="submit" value="save">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

 <script>
     $(document).ready(function(){
         let row_number = 1;
         $("#add_row").click(function(e){
             e.preventDefault();
             let new_row_number = row_number - 1;
             $('#product' + row_number).html($('#product' + new_row_number).html()).find('td:first-child');
             $('#products_table').append('<tr id="product' + (row_number + 1) + '"></tr>');
             row_number++;
         });

         $("#delete_row").click(function(e){
             e.preventDefault();
             if(row_number > 1){
                 $("#product" + (row_number - 1)).html('');
                 row_number--;
             }
         });
     });
 </script>

@endsection

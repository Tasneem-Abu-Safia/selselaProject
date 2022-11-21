@extends('Layouts.Dashboard.master')
@php
    App::setLocale(Session::get("locale") != null ? Session::get("locale") : "en");
@endphp
@section('css')

@endsection

@section('js')
    <script src="{{asset('assets/extra-libs/validation.js')}}"></script>

@endsection

@section('title')
    {{__('dashboard.AddProduct')}}

@endsection

@section('title-side')
    {{__('dashboard.AddProduct')}}

@endsection


@section('Headtitle')
    {{__('dashboard.AddProduct')}}

@endsection



@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Add Product Attributes</h4>


                    <div class="alert alert-danger col-sm-6 print-error-msg" style="display:none" role="alert">

                        @foreach ($errors->all() as $error)
                            <ul> {{$error}}</ul>
                        @endforeach
                    </div>
                    <form class="m-t-40" method="Post" novalidate
                          action="{{route('add-productAttributes')}}" method="POST">
                        @csrf

                        <div class="form-group">
                            <h5>Products <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <select class="custom-select mr-sm-2" name="product_id" id="product_id">
                                    @foreach($products as  $product)
                                        <option value="{{$product->id}}"> {{ $product->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="form-group">
                            <h5>Colors <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <select class="custom-select mr-sm-2" name="color_id" id="color_id">
                                    @foreach($colors as  $c)
                                        <option value="{{$c->id}}"> {{ $c->color }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="form-group">
                            <h5>Sizes <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <select class="custom-select mr-sm-2" name="size_id" id="size_id">
                                    @foreach($sizes as  $s)
                                        <option value="{{$s->id}}"> {{ $s->size }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <h5>Quantity<span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="number" name="quantity" id="quantity" class="form-control" required min="0"
                                       data-validation-required-message="This field is required"></div>
                        </div>
                        <div class="text-xs-right">
                            <button type="submit" class="btn btn-info">Submit</button>
                            <button type="reset" class="btn btn-inverse">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

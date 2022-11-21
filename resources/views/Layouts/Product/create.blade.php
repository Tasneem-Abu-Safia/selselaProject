@extends('Layouts.Dashboard.master')
@php
    App::setLocale(Session::get("locale") != null ? Session::get("locale") : "en");
@endphp
@section('css')

@endsection

@section('js')
    <script src="{{asset('assets/extra-libs/validation.js')}}"></script>
    <script>
        !function (window, document, $) {
            "use strict";
            $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
        }(window, document, jQuery);

        var loadFile = function (event) {
            var image = document.getElementById('output');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
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
                    <h4 class="card-title">Add Product Form</h4>


                    <div class="alert alert-danger col-sm-6 print-error-msg" style="display:none" role="alert">

                        @foreach ($errors->all() as $error)
                            <ul> {{$error}}</ul>
                        @endforeach
                    </div>
                    <form class="m-t-40" method="Post" novalidate
                          action="{{route('products.store')}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="form-group">
                            <h5>Name (English) <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="name_en" class="form-control" required
                                       data-validation-required-message="This field is required"></div>
                        </div>
                        <div class="form-group">
                            <h5>Name (العربية) <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="name_ar" class="form-control" required
                                       data-validation-required-message="This field is required"></div>
                        </div>

                        <div class="form-group">
                            <h5>Description (English) <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="description_en" class="form-control" required
                                       data-validation-required-message="This field is required"></div>
                        </div>
                        <div class="form-group">
                            <h5>Description (العربية) <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="description_ar" class="form-control" required
                                       data-validation-required-message="This field is required"></div>
                        </div>

                        <div class="form-group">
                            <h5>Price<span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="number" name="price" class="form-control" required
                                       data-validation-required-message="This field is required"></div>
                        </div>
                        <div class="form-group">
                            <h5>Quantity<span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="number" name="quantity" class="form-control" required
                                       data-validation-required-message="This field is required"></div>
                        </div>
{{--                        <div class="form-group">--}}
{{--                            <h5>Active<span class="text-danger">*</span></h5>--}}
                        {{--                            <div class="controls">--}}
                        {{--                                <input type="number"  min="0" max="1" name="active" class="form-control" required--}}
{{--                                       data-validation-required-message="This field is required"></div>--}}
{{--                        </div>--}}

                        <div class="form-group">
                            <h5>Category <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <select class="custom-select mr-sm-2"  name="category_id" id="category_id">
                                    @foreach($category as  $c)
                                        <option value="{{$c->id}}"> {{ $c->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>


                        <div class="form-group">
                            <h5>Image Field <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="file" name="file[]" accept="image/*"
                                       id="file" onchange="loadFile(event)" required
                                       class="form-control" multiple>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="file">Uploaded Image</label>
                            <img id="output" width="200"/>
                        </div>


                        <div class="text-xs-right">
                            <button type="submit" class="btn btn-info">Submit</button>
                            <button type="reset" class="btn btn-inverse">Cancel</button>
                            <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $("body").on("click", ".upload-image", function (e) {
            $(this).parents("form").ajaxForm(options);
        });


        var options = {
            complete: function (response) {
                if ($.isEmptyObject(response.responseJSON.error)) {
                    $("input[name='name_en']").val('');
                    $("input[name='name_ar']").val('');
                    alert('Image Upload Successfully.');
                } else {
                    printErrorMsg(response.responseJSON.error);
                }
            }
        };


        function printErrorMsg(msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display', 'block');
            $.each(msg, function (key, value) {
                $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
            });
        }
    </script>
@endsection

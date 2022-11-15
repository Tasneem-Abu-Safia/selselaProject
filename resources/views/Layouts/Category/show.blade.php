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
    </script>
@endsection

@section('title')
    {{$category->title}}
@endsection

@section('title-side')
    {{__('dashboard.Categories')}}

@endsection


@section('Headtitle')
    {{__('dashboard.Categories')}}

@endsection



@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Show Category</h4>

                    <div class="form-group">
                        <h5>Name (English) <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="text" name="name_en" class="form-control" required
                                   value="{{$category->getTranslation('name','en')}}" disabled
                                   data-validation-required-message="This field is required"></div>
                    </div>

                    <div class="form-group">
                        <h5>Name (العربية) <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="text" name="name_ar" class="form-control" required
                                   value="{{$category->getTranslation('name','ar')}}" disabled
                                   data-validation-required-message="This field is required"></div>
                    </div>

                    <div class="form-group">
                        <label for="file">Uploaded Image</label><br>
                        <img id="output" width="400" src="{{URL::asset($category->icon)}}"/>
                    </div>

                    <div class="text-xs-right">
                        <a href="{{route('categories.edit' , $category)}}">
                            <button type="submit" class="btn btn-info">Edit</button>

                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

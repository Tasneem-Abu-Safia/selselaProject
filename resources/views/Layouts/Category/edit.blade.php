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
                    <h4 class="card-title">Edit Category</h4>
                    @if (count($errors) > 0)
                        <ul>
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger col-sm-6" role="alert">
                                    {{$error}}
                                </div>
                            @endforeach
                        </ul>

                    @endif
                    <form class="m-t-40" method="Post" enctype='multipart/form-data' novalidate
                          action="{{route('categories.update' , $category->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <h5>Name (English) <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="name_en" class="form-control" required
                                       value="{{$category->getTranslation('name','en')}}"
                                       data-validation-required-message="This field is required"></div>
                        </div>

                        <div class="form-group">
                            <h5>Name (العربية) <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="name_ar" class="form-control" required
                                       value="{{$category->getTranslation('name','ar')}}"
                                       data-validation-required-message="This field is required"></div>
                        </div>


                        <div class="form-group">
                            <h5>Icon Field <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="file" name="file" accept="image/*"
                                       id="file" onchange="loadFile(event)"
                                       class="form-control">
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="file">Uploaded Icon</label>
                            <img id="output" width="200" src="{{URL::asset($category->icon)}}"/>
                        </div>


                        <div class="text-xs-right">
                            <button type="submit" class="btn btn-info">Update</button>
                            <button type="reset" class="btn btn-inverse">Reset</button>
                            <a class="btn btn-primary" href="{{ route('categories.index') }}"> Back</a>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection

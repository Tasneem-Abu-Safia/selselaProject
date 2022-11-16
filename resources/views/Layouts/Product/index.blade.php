@extends('Layouts.Dashboard.master')
@php
    App::setLocale(Session::get("locale") != null ? Session::get("locale") : "en");
@endphp

@section('css')
    <link href="{{asset('assets/extra-libs/dataTables.bootstrap4.css')}}" rel="stylesheet">

@endsection

@section('Headtitle')
    {{__('dashboard.Products')}}
@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        var loadFile = function (event) {
            var image = document.getElementById('output');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
        $(function () {
            var table = $('.categories_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('products.index') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name.en', name: 'name'},
                    {data: 'name.ar', name: 'name'},
                    {data: 'description.en', name: 'description'},
                    {data: 'description.ar', name: 'description'},
                    // {data: 'image', name: 'image'},
                    {data: 'price', name: 'price'},
                    {data: 'quantity', name: 'quantity'},
                    {data: 'category_name', name: 'category_name'},
                    {
                        data: 'action', name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],

            }).on('click', '.main', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                $modal.modal('show');
                $("#product_id").val(id);

            });

            let $modal = $('#myModalSelectMain');


        });


    </script>
@endsection

@section('title')
@endsection

@section('title-side')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="col-6 pb-2">
            <a href="{{route('products.create')}}">
                <button type="button" class="btn btn-info">Add Product</button>
            </a>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered categories_datatable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name_En</th>
                                    <th>Name_Ar</th>
                                    <th>Description_En</th>
                                    <th>Description_Ar</th>
                                    {{--                                    <th>Image</th>--}}
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Category</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="modal fade" id="myModalSelectMain" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"> Main Product Image</h4>
                </div>

                <form action="{{route('productMainImage')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type='hidden' name='product_id' id="product_id"/>
                    <div class="modal-body">

                    <div class="form-group">
                        <h5>Image Field <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="file" name="file" accept="image/*"
                                   id="file" onchange="loadFile(event)"
                                   class="form-control" >
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="file">Uploaded Image</label>
                        <img id="output" width="200"/>
                    </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <input type="submit" class="btn btn-primary" value='Add'/>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection





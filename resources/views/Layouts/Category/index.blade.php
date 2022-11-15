@extends('Layouts.Dashboard.master')
@php
    App::setLocale(Session::get("locale") != null ? Session::get("locale") : "en");
@endphp

@section('css')
    <link href="{{asset('assets/extra-libs/dataTables.bootstrap4.css')}}" rel="stylesheet">

@endsection

@section('Headtitle')
    {{__('dashboard.Categories')}}
@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">

        $(function () {
            var table = $('.categories_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('categories.index') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name.en', name: 'name'},
                    {data: 'name.ar', name: 'name'},
                    {data: 'icon', name: 'icon'},
                    {
                        data: 'action', name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],

            });

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
            <a href="{{url('categories/create')}}">
                <button type="button" class="btn btn-info">Add Category</button>
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
                                    <th>Icon</th>
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
@endsection





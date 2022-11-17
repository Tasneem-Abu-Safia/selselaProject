@extends('Layouts.Dashboard.master')
@php
    App::setLocale(Session::get("locale") != null ? Session::get("locale") : "en");
@endphp

@section('css')
    <link href="{{asset('assets/extra-libs/dataTables.bootstrap4.css')}}" rel="stylesheet">
@endsection

@section('Headtitle')
    {{__('dashboard.user')}}

@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $(function () {
            var table = $('.user_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('users.index') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'role', name: 'role'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
@endsection

@section('title')
    {{__('dashboard.user')}}
@endsection

@section('title-side')
    {{__('dashboard.user')}}
@endsection

@section('content')
    @if ($message = Session::get('msg'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="container-fluid">
        <div class="col-6 pb-2">
            <a href="{{route('users.create')}}">
                <button type="button" class="btn btn-info">Add User</button>
            </a>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered user_datatable">

                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Actions</th>
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




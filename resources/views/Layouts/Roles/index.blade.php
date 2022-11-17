@extends('Layouts.Dashboard.master')
@php
    App::setLocale(Session::get("locale") != null ? Session::get("locale") : "en");
@endphp

@section('css')
    <link href="{{asset('assets/extra-libs/dataTables.bootstrap4.css')}}" rel="stylesheet">
@endsection

@section('Headtitle')
    {{__('dashboard.role')}}

@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
@endsection

@section('title')
    {{__('dashboard.role')}}
@endsection

@section('title-side')
    {{__('dashboard.role')}}
@endsection

@section('content')

    @if ($message = Session::get('msg'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="container-fluid">
        @can('role-create')
            <div class="col-6 pb-2">
                <a href="{{route('roles.create')}}">
                    <button type="button" class="btn btn-info">Add Role</button>
                </a>
            </div>
        @endcan
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered user_datatable">

                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th width="280px">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($roles as $key => $role)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                               <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Show</a>
{{--                                            @can('role-edit')--}}
                                                <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>
{{--                                            @endcan--}}
{{--                                            @can('role-delete')--}}
                                                <form style="display:inline"
                                                      action="{{route('roles.destroy', $role->id)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Are You Sure Want to Delete?')">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
{{--                                            @endcan--}}
                                        </td>
                                    </tr>
                                @endforeach
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




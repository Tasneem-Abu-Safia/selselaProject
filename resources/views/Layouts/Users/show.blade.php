@extends('Layouts.Dashboard.master')
@php
    App::setLocale(Session::get("locale") != null ? Session::get("locale") : "en");
@endphp
@section('css')

@endsection

@section('Headtitle')
    {{__('dashboard.user')}}

@endsection

@section('js')

@endsection

@section('title')
    {{__('dashboard.user')}}
@endsection

@section('title-side')
    {{__('dashboard.user')}}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Show User Details</h4>
                    <form class="m-t-40" method="get" novalidate
                          action="{{route('users.edit' , $user)}}">

                        <div class="form-group">
                            <h5>Name Field <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="name" value="{{$user->name}}" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <h5>Email Field <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="email" value="{{$user->email}}" name="email" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <h5>Roles <span class="text-danger">*</span></h5>
                            <div class="controls">
                                @if(!empty($user->getRoleNames()))
                                    @foreach($user->getRoleNames() as $v)
                                        <label class="badge badge-success  font-16 ">{{ $v }}</label>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <div class="text-xs-right">
                            <button type="submit" class="btn btn-info">Edit</button>
                            <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection



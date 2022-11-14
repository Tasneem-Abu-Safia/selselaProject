<!DOCTYPE html>
@php
    App::setLocale(Session::get("locale") != null ? Session::get("locale") : "en");
@endphp
<html dir="{{ ( Session::get("locale")== "ar" ? 'rtl' : 'ltr') }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/logo-icon.png')}}">
    <meta name="description" content="">
    <meta name="author" content="">
    @include('Layouts.Dashboard.css-links')

</head>

<body>

<div class="preloader">
    <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
    </div>
</div>
<div id="main-wrapper">

    @include('Layouts.Dashboard.main-headerbar')

    @include('Layouts.Dashboard.main-sidebar')

    <div class="page-wrapper">

        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-5 align-self-center">
                    <h4 class="page-title">@yield("title")</h4>
                    <div class="d-flex align-items-center">

                    </div>
                </div>
                <div class="col-7 align-self-center">
                    <div class="d-flex no-block justify-content-end align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{url('/')}}">{{ __('dashboard.Home') }}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page"> @yield("title-side") </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            @yield("content")
        </div>

        @include('Layouts.Dashboard.footer')
    </div>

</div>
@include('Layouts.Dashboard.script-links')


</body>

</html>

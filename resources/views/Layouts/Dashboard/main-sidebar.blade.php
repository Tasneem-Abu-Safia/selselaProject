<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <!-- User Profile-->
                <li>
                    <!-- User Profile-->
                    <div class="user-profile dropdown m-t-20">
                        <div class="user-pic">
                            <img src="{{asset('assets/images/1.jpg')}}" alt="users"
                                 class="rounded-circle img-fluid"/>
                        </div>
                        <div class="user-content hide-menu m-t-10">
                            {{--                            <h5 class="m-b-10 user-name font-medium">{{Auth::user()->name}}</h5>--}}
                            <a href="javascript:void(0)" class="btn btn-circle btn-sm m-r-5" id="Userdd"
                               role="button" data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false">
                                <i class="ti-settings"></i>
                            </a>

                            <a class="btn btn-circle btn-sm"
                               {{--                               href="{{ route('logout') }}"--}}
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="ti-power-off"></i>
                            </a>

                            <form id="logout-form"
                                  {{--                                  action="{{ route('logout') }}"--}}
                                  method="POST" class="d-none">
                                @csrf
                            </form>
                            <div class="dropdown-menu animated flipInY" aria-labelledby="Userdd">
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <i class="ti-user m-r-5 m-l-5"></i>{{__('dashboard.myProfile')}}</a>
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <i class="ti-wallet m-r-5 m-l-5"></i> {{__('dashboard.myBalance')}}</a>
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <i class="ti-email m-r-5 m-l-5"></i> {{__('dashboard.inbox')}}</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <i class="ti-settings m-r-5 m-l-5"></i> {{__('dashboard.accountSetting')}}</a>
                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item"
                                   {{--                                   href="{{ route('logout') }}"--}}
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fa fa-power-off m-r-5 m-l-5"></i>
                                    {{__('dashboard.logout')}}
                                </a>

                                <form id="logout-form"
                                      {{--                                      action="{{ route('logout') }}" --}}
                                      method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End User Profile-->
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                       aria-expanded="false">
                        <i class="icon-Car-Wheel"></i>
                        <span class="hide-menu">Category</span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item">
                            <a href="{{url('categories')}}" class="sidebar-link">
                                <i class="icon-Record"></i>
                                <span class="hide-menu"> All Category </span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="{{route('categories.create')}}" class="sidebar-link">
                                <i class="icon-Record"></i>
                                <span class="hide-menu"> Add Category </span>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                       aria-expanded="false">
                        <i class="icon-Car-Wheel"></i>
                        <span class="hide-menu">Products</span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item">
                            <a href="{{url('products')}}" class="sidebar-link">
                                <i class="icon-Record"></i>
                                <span class="hide-menu"> All Product </span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="{{route('products.create')}}" class="sidebar-link">
                                <i class="icon-Record"></i>
                                <span class="hide-menu"> Add Product </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{route('createProductAttributes')}}" class="sidebar-link">
                                <i class="icon-Record"></i>
                                <span class="hide-menu"> Add Product Attributes</span>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                       aria-expanded="false">
                        <i class="icon-Car-Wheel"></i>
                        <span class="hide-menu">Orders</span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item">
                            <a href="{{url('orders')}}" class="sidebar-link">
                                <i class="icon-Record"></i>
                                <span class="hide-menu"> All Orders </span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="{{route('orders.create')}}" class="sidebar-link">
                                <i class="icon-Record"></i>
                                <span class="hide-menu"> Add Order </span>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                       aria-expanded="false">
                        <i class="icon-Car-Wheel"></i>
                        <span class="hide-menu">Manage Roles</span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item">
                            <a href="{{route('roles.index')}}" class="sidebar-link">
                                <i class="icon-Record"></i>
                                <span class="hide-menu"> All Roles </span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="{{route('roles.create')}}" class="sidebar-link">
                                <i class="icon-Record"></i>
                                <span class="hide-menu"> Add Role </span>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                       aria-expanded="false">
                        <i class="icon-Car-Wheel"></i>
                        <span class="hide-menu">Manage Users</span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item">
                            <a href="{{route('users.index')}}" class="sidebar-link">
                                <i class="icon-Record"></i>
                                <span class="hide-menu"> All User </span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="{{route('users.create')}}" class="sidebar-link">
                                <i class="icon-Record"></i>
                                <span class="hide-menu"> Add User </span>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="sidebar-item">

                    <a class="sidebar-link waves-effect waves-dark sidebar-link" aria-expanded="false"
                       href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="mdi mdi-directions"></i>
                        <span class="hide-menu">{{__('dashboard.logout')}}</span>

                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>

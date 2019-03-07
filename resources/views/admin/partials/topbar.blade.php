@push('css')

@endpush
<header class="main-header">
    <!-- Logo -->
    <a href="{{route('adminhome')}}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"> <img src="{{asset('superadmin/dist/img/logo-transparent.png')}}" alt="logo" style="width:5rem;"> </span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Admin</b> Ayojok</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu" data-toggle="tooltip" data-placement="bottom" title="Contact Message">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-envelope-o"></i>
                        @php
                          $totalmess = App\Models\contactus::where('is_opened',0)->count();
                        @endphp
                        <span class="label label-success">{{$totalmess}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have {{$totalmess}} messages</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu" id="topbar-menu">
                              @php
                                $allmess = App\Models\contactus::where('is_opened',0)->get();
                              @endphp
                              @foreach ($allmess as $mess)
                                @php
                                  $slug = str_limit($mess->messbody, 25, '...');
                                  $dateslug = $mess->created_at->format('d-m-Y');
                                @endphp
                                <li><!-- start message -->
                                    <a href="{{route('mess-single',$mess->id)}}">
                                    <h4>
                                        {{$mess->name}}
                                        <small><i class="fa fa-clock-o"></i> {{$dateslug}}</small>
                                    </h4>
                                    <p>{{$slug}}</p>
                                </a>
                            </li>
                            <!-- end message -->
                              @endforeach
                        </ul>
                    </li>
                    <li class="footer"><a href="{{route('mess')}}">See All Messages</a></li>
                </ul>
            </li>
            <!-- Notifications: style can be found in dropdown.less -->
            <li class="dropdown notifications-menu" data-toggle="tooltip" data-placement="bottom" title="Order">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-shopping-cart"></i>
                    @php
                      $totalOrder = App\Models\order::all()->count();
                    @endphp
                    <span class="label label-warning">{{$totalOrder}}</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="header">You have {{$totalOrder}} new order</li>
                    <li>
                        <!-- inner menu: contains the actual data -->
                        <ul class="menu" id="topbar-menu2">
                            <li>
                                <a href="#">
                                    <i class="fa fa-shopping-cart text-green"></i> New Purchase Order (Invice id #0001)
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-shopping-cart text-green"></i> New Purchase Order (Invice id #0002)
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-shopping-cart text-green"></i> New Purchase Order (Invice id #0003)
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-shopping-cart text-green"></i> New Purchase Order (Invice id #0004)
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-shopping-cart text-green"></i> New Purchase Order (Invice id #0005)
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="footer"><a href="#">View all</a></li>
                </ul>
            </li>
            <!-- Tasks: style can be found in dropdown.less -->
            <li class="dropdown tasks-menu" data-toggle="tooltip" data-placement="bottom" title="Query">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-search"></i>
                    @php
                      $totalquery = App\Models\querycart::where('status',1)->count();
                    @endphp
                    <span class="label label-danger">{{$totalquery}}</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="header">You have {{$totalquery}} new query</li>
                    <li>
                        <!-- inner menu: contains the actual data -->
                        <ul class="menu" id="topbar-menu3">
                            <li><!-- Query item -->
                                <a href="#">
                                    <h3>
                                        <i class="fa fa-search"> </i>
                                        New Query
                                        <small class="pull-right">12-12-2018</small>
                                    </h3>
                                    <p>User Name - Number of query</p>
                                </a>
                            </li>
                            <!-- end Query item -->
                            <li><!-- Query item -->
                                <a href="#">
                                    <h3>
                                        <i class="fa fa-search"> </i>
                                        New Query
                                        <small class="pull-right">12-12-2018</small>
                                    </h3>
                                    <p>User Name - Number of query</p>
                                </a>
                            </li>
                            <!-- end Query item -->
                            <li><!-- Query item -->
                                <a href="#">
                                    <h3>
                                        <i class="fa fa-search"> </i>
                                        New Query
                                        <small class="pull-right">12-12-2018</small>
                                    </h3>
                                    <p>User Name - Number of query</p>
                                </a>
                            </li>
                            <!-- end Query item -->
                            <li><!-- Query item -->
                                <a href="#">
                                    <h3>
                                        <i class="fa fa-search"> </i>
                                        New Query
                                        <small class="pull-right">12-12-2018</small>
                                    </h3>
                                    <p>User Name - Number of query</p>
                                </a>
                            </li>
                            <!-- end Query item -->
                        </ul>
                    </li>
                    <li class="footer">
                        <a href="#">View all tasks</a>
                    </li>
                </ul>
            </li>
            <li data-toggle="tooltip" data-placement="bottom" title="Profile">
                <a href="#"><i class="fa fa-user"></i></a>
            </li>
            <li data-toggle="tooltip" data-placement="bottom" title="Logout">
                <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>
    </div>
</nav>
</header>
@push('scripts')

    <script type="text/javascript">
    // SLIMSCROLL FOR CHAT WIDGET
    $('#topbar-menu,#topbar-menu2,#topbar-menu3').slimScroll({
        height:'200px'
    });
    $('[data-toggle="tooltip"]').tooltip();
    </script>

@endpush

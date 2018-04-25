<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('images/vendor/admin-lte/dist/boxed-bg.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                @foreach(Auth::user()->roles as $role)
                <small>{{ $role->display_name }}</small>
                @endforeach

            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">General</li>
            @if(Auth::user()->hasRole('superadmin'))
                <li class="{{ Route::currentRouteNamed('dash.superadmin') ? 'active' : '' }}">
                    <a href="{{ route('dash.superadmin') }}">
                        <i class="fa fa-dashboard"></i> <span><small>Dashboard</small></span>
                    </a>
                </li>
            @elseif(Auth::user()->hasRole('admin'))
                <li>
                    <a href="#">
                        <i class="fa fa-dashboard"></i> <span><small>Dashboard</small></span>
                    </a>
                </li>
            @elseif(Auth::user()->hasRole('coordinator'))
                <li>
                    <a href="#">
                        <i class="fa fa-dashboard"></i> <span><small>Dashboard</small></span>
                    </a>
                </li>
            @elseif(Auth::user()->hasRole('student'))
                <li>
                    <a href="{{ route('dash.student') }}">
                        <i class="fa fa-user"></i> <span><small>My Profile</small></span>
                    </a>
                </li>
            @elseif(Auth::user()->hasRole('sponsor'))
                <li>
                    <a href="#">
                        <i class="fa fa-dashboard"></i> <span><small>Dashboard</small></span>
                    </a>
                </li>
            @endif

            @if(Auth::user()->hasRole('superadmin'))
                <li class="header">Administrative</li>
                <li class="treeview {{ Route::currentRouteNamed('um.students') ? 'active' : '' }}{{ Route::currentRouteNamed('um.coordinators') ? 'active' : '' }}{{ Route::currentRouteNamed('um.sponsors') ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-users"></i>
                        <span><small>User Management</small></span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ Route::currentRouteNamed('um.students') ? 'active' : '' }}"><a href="{{ route('um.students') }}"><i class="fa fa-circle-o"></i> <span><small>Students</small></span></a></li>
                        <li class="{{ Route::currentRouteNamed('um.coordinators') ? 'active' : '' }}"><a href="{{ route('um.coordinators') }}"><i class="fa fa-circle-o"></i> <span><small>Coordinators</small></span></a></li>
                        <li class="{{ Route::currentRouteNamed('um.sponsors') ? 'active' : '' }}"><a href="{{ route('um.sponsors') }}"><i class="fa fa-circle-o"></i> <span><small>Visa Sponsors</small></span></a></li>
                    </ul>
                </li>
                <li class="treeview {{ Route::currentRouteNamed('ac.role') ? 'active' : '' }}{{ Route::currentRouteNamed('ac.permission') ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-key"></i>
                        <span><small>Access Control Management</small></span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ Route::currentRouteNamed('ac.role') ? 'active' : '' }}"><a href="{{ route('ac.role') }}"><i class="fa fa-circle-o"></i> <small>Roles</small></a></li>
                        <li class="{{ Route::currentRouteNamed('ac.permission') ? 'active' : '' }}"><a href="{{ route('ac.permission') }}"><i class="fa fa-circle-o"></i> <small>Permissions</small></a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-desktop"></i> <span><small>Website Content Management</small></span>
                    </a>
                </li>
                <li class="header">Settings</li>
                <li class="treeview {{ Route::currentRouteNamed('s.host') ? 'active' : '' }}{{ Route::currentRouteNamed('s.programs') ? 'active' : '' }}{{ Route::currentRouteNamed('s.sponsors') ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-gear"></i> <span><small>General</small></span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ Route::currentRouteNamed('s.programs') ? 'active' : '' }}"><a href="{{ route('s.programs') }}"><i class="fa fa-circle-o"></i> <small>Program</small></a></li>
                        <li class="{{ Route::currentRouteNamed('s.sponsors') ? 'active' : '' }}"><a href="{{ route('s.sponsors') }}"><i class="fa fa-circle-o"></i> <small>Visa Sponsor</small></a></li>
                        <li class="{{ Route::currentRouteNamed('s.host') ? 'active' : '' }}"><a href="{{ route('s.host') }}"><i class="fa fa-circle-o"></i> <small>Host Company</small></a></li>
                    </ul>
                </li>
            @endif

            @if(Auth::user()->hasRole('admin'))

            @endif

            @if(Auth::user()->hasRole('coordinator'))
                <li class="header">Program</li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-key"></i>
                        <span><small>Students</small></span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="#"><i class="fa fa-circle-o"></i><small>Summer Work and Travel</small></a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i><small>Internship</small></a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i><small>Career Training</small></a></li>
                    </ul>
                </li>
            @endif

            @if(Auth::user()->hasRole('student'))
                <li class="header">My Requirements</li>
                <li>
                    <a href="#">
                        <i class="fa fa-book"></i>
                        <span><small>Basic Requirements</small></span>
                        <span class="pull-right-container">
                            <small class="label pull-right bg-red">0</small>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-plane"></i>
                        <span><small>Visa Requirements</small></span>
                        <span class="pull-right-container">
                            <small class="label pull-right bg-red">0</small>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-dollar"></i>
                        <span><small>Payment Requirements</small></span>
                        <span class="pull-right-container">
                            <small class="label pull-right bg-red">0</small>
                        </span>
                    </a>
                </li>
            @endif
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
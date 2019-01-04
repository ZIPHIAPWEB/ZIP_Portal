<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar" id="sidenav">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('logo.png') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                @foreach(Auth::user()->roles as $role)
                    @if($role->display_name !== 'Student')
                    <small>{{ $role->display_name }}</small>
                    @else
                    <small>{{ \App\Program::find(\App\Student::where('user_id', Auth::user()->id)->first()->program_id)->description }}</small>
                    @endif
                @endforeach
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            @if(Auth::user()->hasRole('superadmin'))
                <li class="{{ Route::currentRouteNamed('dash.superadmin') ? 'active' : '' }}">
                    <a href="{{ route('dash.superadmin') }}">
                        <i class="fa fa-dashboard"></i> <span><small>Dashboard</small></span>
                    </a>
                </li>
                <li class="header">Administrative</li>
                <li class="treeview {{ Route::currentRouteNamed('um.students') ? 'active' : '' }}{{ Route::currentRouteNamed('um.coordinators') ? 'active' : '' }}{{ Route::currentRouteNamed('um.sponsors') ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-users"></i>
                        <span class="text-sm">User Management</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ Route::currentRouteNamed('um.students') ? 'active' : '' }}"><a href="{{ route('um.students') }}"><i class="fa fa-circle-o"></i> <span><small>Students</small></span></a></li>
                        <li class="{{ Route::currentRouteNamed('um.coordinators') ? 'active' : '' }}"><a href="{{ route('um.coordinators') }}"><i class="fa fa-circle-o"></i> <span><small>Coordinators</small></span></a></li>
                    </ul>
                </li>
                <li class="treeview {{ Route::currentRouteNamed('ac.role') ? 'active' : '' }}{{ Route::currentRouteNamed('ac.permission') ? 'active' : '' }}">
                    <a href="#">
                        <i class="fa fa-key"></i>
                        <span class="text-sm">Access Control Management</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ Route::currentRouteNamed('ac.role') ? 'active' : '' }}"><a href="{{ route('ac.role') }}"><i class="fa fa-circle-o"></i> <small>Roles</small></a></li>
                    </ul>
                </li>
                <li class="{{ Route::currentRouteNamed('sa.events') ? 'active' : '' }}">
                    <a href="{{ route('sa.events') }}">
                        <i class="fa fa-calendar"></i> <span class="text-sm">Event Management</span>
                    </a>
                </li>
                <li class="{{ Route::currentRouteNamed('sa.cms') ? 'active' : '' }}">
                    <a href="{{ route('sa.cms') }}">
                        <i class="fa fa-desktop"></i>
                        <span class="text-sm">Website Content Management</span>
                    </a>
                </li>
                <li class="header">Settings</li>
                <li class="treeview {{ Route::currentRouteNamed('s.school') ? 'active' : '' }}{{ Route::currentRouteNamed('s.host') ? 'active' : '' }}{{ Route::currentRouteNamed('s.programs') ? 'active' : '' }}{{ Route::currentRouteNamed('s.sponsors') ? 'active' : '' }}">
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
                        <li class="{{ Route::currentRouteNamed('s.school') ? 'active' : '' }}"><a href="{{ route('s.school') }}"><i class="fa fa-circle-o"></i> <small>School</small></a></li>
                    </ul>
                </li>
            @endif
            @if(Auth::user()->hasRole('coordinator'))
                <li class="header">General</li>
                <li>
                    <a href="{{ route('dash.coordinator') }}">
                        <i class="fa fa-dashboard"></i> <span><small>Dashboard</small></span>
                    </a>
                </li>
                <li class="header">Program</li>
                <li class="treeview" id="coordinator">
                    <a href="#">
                        <i class="fa fa-key"></i>
                        <span><small>Student's Program(s)</small></span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu" >
                        <li v-for="program in programs">
                            <a v-if="auth === program.id" :href="url + program.id">
                                <i class="fa fa-circle-o"></i>
                                <small>@{{ program.name }}</small>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="header">Communication</li>
                <li>
                    <a href="{{ route('portal.chat') }}">
                        <i class="fa fa-envelope"></i> <span><small>Chat</small></span>
                    </a>
                </li>
            @endif
            @if(Auth::user()->hasRole('student'))
                <li class="header">General</li>
                <li class="active">
                    <a href="{{ route('dash.student') }}">
                        <i class="fa fa-user"></i> <span><small>My Profile</small></span>
                    </a>
                </li>
                <li class="header">My Requirements</li>
                <li>
                    <a href="{{ route('req.basic') }}">
                        <i class="fa fa-book"></i>
                        <span>
                            <small>Basic Requirements</small>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('req.payment') }}">
                        <i class="fa fa-dollar"></i>
                        <span>
                            <small>Payment Requirements</small>
                        </span>
                    </a>
                </li>
                @if (\App\Student::where('user_id', Auth::user()->id)->first()->visa_sponsor_id)
                    <li>
                        <a href="{{ route('req.visa') }}">
                            <i class="fa fa-plane"></i>
                            <span><small>Visa Requirements</small></span>
                        </a>
                    </li>
                @endif
                <li class="header">Communication</li>
                <li>
                    <a href="{{ route('portal.chat-student') }}">
                       <i class="fa fa-envelope"></i>
                        <span><small>Chat</small></span>
                    </a>
                </li>
            @endif
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
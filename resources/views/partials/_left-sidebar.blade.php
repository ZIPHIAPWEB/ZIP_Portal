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
            @yield('sidenav')
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
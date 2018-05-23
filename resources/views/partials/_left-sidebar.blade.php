<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar" id="sidenav">
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
            @yield('sidenav')
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
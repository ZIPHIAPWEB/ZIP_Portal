<header class="main-header">
    <!-- Logo -->
    <a href="{{ route('welcome') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>Z</b>IP</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>ZIP</b> PORTAL</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li>
                    <a href="{{ route('logout') }}"><span class="fa fa-sign-out"></span> Logout</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
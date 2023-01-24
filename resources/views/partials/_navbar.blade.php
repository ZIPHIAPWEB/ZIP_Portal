<nav class="navbar navbar-light navbar-expand-lg sticky-top" style="background-color: rgba(247,249,251,0.81);z-index: 9999;">
        <div class="container"><a class="navbar-brand" style="background-repeat: no-repeat;width: 88px;height: 40px;background-image: url(&quot;assets/img/Zip%20Logo%20High%20Reso-01.png&quot;);background-position: center;background-size: cover;" href="{{ url('/') }}"></a><button data-toggle="collapse" class="navbar-toggler"
                data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item" role="presentation"><a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">HOME</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link {{ request()->is('about-us') ? 'active' : '' }}" href="{{ url('/about-us') }}">ABOUT US</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link {{ request()->is('our-programs') ? 'active' : '' }}" href="{{ url('/our-programs') }}">OUR PROGRAMS</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link {{ request()->is('contact-us') ? 'active' : '' }}" href="{{ url('/contact-us') }}">CONTACT US</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle mr-2" href="#" id="navbardrop" data-toggle="dropdown">
                          LEARN MORE
                        </a>
                        <div class="dropdown-menu">
                          <!-- <a class="dropdown-item" href="{{ url('/blog') }}">BLOG</a> -->
                          <a class="dropdown-item" href="{{ url('/tax-services') }}">TAX SERVICES</a>
                          <a class="dropdown-item" href="{{ url('/j1-cares') }}">J1 CARES</a>
                          <a class="dropdown-item" href="{{ url('/social-stream') }}">SOCIAL STREAM</a>
                        </div>
                    </li>
                    <li class="nav-item" role="presentation"><a href="{{ url('/auth/login') }}" class="btn btn-primary" style="background-color: #002157;border-radius: 10px;">JOIN US</a></li>                
                </ul>
            </div>
        </div>
    </nav>
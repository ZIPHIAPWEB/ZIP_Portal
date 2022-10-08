<!DOCTYPE html>
<html>

<head>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-158714530-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-158714530-1');
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>ZIP Travel Philippines - {{ $blog->title }}</title>
    <meta name="robots" content="index, follow">
    <meta name="twitter:description" content="ZIP Travel is a career and education counseling/travel organization. We help students and young professionals attend cultural exchanges in the United States, Australia, and Canada.  As a global company, we have been in the business for over 27 years and have helped thousands of students worldwide obtain an opportunity to participate in the Cultural Exchange Program authorized by the U.S. Department of State. ">
    <meta name="twitter:image" content="{{ asset('assets/img/J1%20PROGRAMS-1.jpg') }}">
    <meta name="description" content="ZIP Travel is a career and education counseling/travel organization. We help students and young professionals attend cultural exchanges in the United States, Australia, and Canada.  As a global company, we have been in the business for over 27 years and have helped thousands of students worldwide obtain an opportunity to participate in the Cultural Exchange Program authorized by the U.S. Department of State. ">
    <meta property="og:url" content="{{ url('/blog/' . $blog->slug) }}" />
    <meta property="og:title" content="{{ 'ZIP Travel Philippines - ' . $blog->title }}" />
    <meta property="og:description" content="{{ $blog->initial_content }}">
    <meta property="og:type" content="article" />
    <meta property="og:image" content="{{ url($blog->image_path) }}" />
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="ZIP Travel Philippines">
    <link rel="icon" type="image/png" sizes="1944x1944" href="{{ asset('assets/img/LOGO_ZIP.png') }}">
    <link rel="icon" type="image/png" sizes="1944x1944" href="{{ asset('assets/img/LOGO_ZIP.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome5-overrides.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Barlow' rel='stylesheet'>

    <style>
        blockquote {
            background: #f9f9f9;
            border-left: 10px solid #ccc;
            margin: 1.5em 10px;
            padding: 0.5em 10px;
            quotes: "\201C""\201D""\2018""\2019";
        }

        blockquote:before {
            color: #ccc;
            content: open-quote;
            font-size: 4em;
            line-height: 0.1em;
            margin-right: 0.25em;
            vertical-align: -0.4em;
        }
     
        blockquote p {
            display: inline;
            font-style: italic;
        }
     
        .image-style-side {
            float: right;
        }

        .image-style-side img {
            width: 250px;
        }

        .media div {
            width: 100%;
        }

        p {
            text-align: justify;
            text-indent: 50px;
        }
    </style>
</head>
<body>
    <!-- Load Facebook SDK for JavaScript -->
    <div id="fb-root"></div>
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v6.0'
        });
      };

      (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

    <!-- Your customer chat code -->
    <div class="fb-customerchat"
      attribution=setup_tool
      page_id="156024204415228"
theme_color="#1b2754">
    </div>
    <div class="d-flex flex-row justify-content-xl-start align-items-xl-center top-bar-wrapper">
        <div class="container">
            <div class="row">
                <div class="col d-xl-flex">
                    <h6 class="text-white align-items-xl-center">YOUR JOURNEY STARTS HERE!</h6>
                </div>
                <div class="col d-inline-flex justify-content-center align-items-center justify-content-sm-end justify-content-md-end align-items-md-center justify-content-lg-end align-items-lg-center justify-content-xl-end align-items-xl-center"><a href="https://www.facebook.com/ZipTravelPhilippines/" style="margin: 0px 5px;" target="_blank"><i class="fab fa-facebook-square mr-1 text-white"></i></a><a href="https://www.instagram.com/ziptravelph/" style="margin: 0px 5px;" target="_blank"><i class="fab fa-instagram mr-1 text-white"></i></a>
                    <a
                        href="https://www.youtube.com/user/ablack2000" style="margin: 0 5px;" target="_blank"><i class="fab fa-youtube mr-1 text-white"></i></a>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-light navbar-expand-lg sticky-top" style="background-color: rgba(247,249,251,0.81);z-index: 9999;">
        <div class="container"><a class="navbar-brand" style="background-repeat: no-repeat;width: 88px;height: 40px;background-image: url(&quot;/assets/img/Zip%20Logo%20High%20Reso-01.png&quot;);background-position: center;background-size: cover;" href="{{ url('/') }}"></a><button data-toggle="collapse" class="navbar-toggler"
                data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item" role="presentation"><a class="nav-link" href="{{ url('/') }}">HOME</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="{{ url('/about-us') }}">ABOUT US</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="{{ url('/our-programs') }}">OUR PROGRAMS</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                          LEARN MORE
                        </a>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="{{ url('/blog') }}">BLOG</a>
                          <a class="dropdown-item" href="{{ url('/j1-cares') }}">J1 CARES</a>
                          <a class="dropdown-item" href="{{ url('/social-stream') }}">SOCIAL STREAM</a>
                        </div>
                    </li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="{{ url('/contact-us') }}">CONTACT US</a></li>
                    <li class="nav-item" role="presentation"><a href="{{ url('/auth/login') }}" class="btn btn-primary" style="background-color: #002157;border-radius: 10px;">JOIN US</a></li>                
                </ul>
            </div>
        </div>
    </nav>
    <section class="section">
        <div class="container-fluid">

            {!! $blog->content !!}

        </div>
    </section>
    @include('partials._main-footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>
    <script src="{{ asset('assets/js/script.min.js') }}"></script>
</body>

</html>
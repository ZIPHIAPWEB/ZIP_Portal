<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZIP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/css/swiper.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}">
</head>

<body style="font-family:Montserrat, sans-serif;font-weight:normal;">
<nav class="navbar navbar-light navbar-expand-lg fixed-top" style="padding:0;padding-top:16px;padding-bottom:16px;background-color:rgba(0,0,0,0.53);color:#000000;">
    <div class="container"><a class="navbar-brand text-white" href="#" style="margin-left:0;font-weight:bold;">ZIP Travel Philippines</a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div
                class="collapse navbar-collapse flex-row-reverse" id="navcol-1">
            <ul class="nav navbar-nav">
                <li class="nav-item" role="presentation"><a class="nav-link text-white active slide-section" href="#about" data-bs-hover-animate="pulse">ABOUT</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link text-white slide-section" href="#programs" data-bs-hover-animate="pulse">PROGRAMS</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link text-white slide-section" href="#contact" data-bs-hover-animate="pulse">CONTACT</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link text-white" href="#" data-bs-hover-animate="pulse">FAQS</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link text-white btn btn-primary" href="{{ route('login') }}">JOIN US</a></li>
            </ul>
        </div>
    </div>
</nav>
<header class="container v-header">
    <div class="fullscreen-video-wrap"><video width="560" height="315" autoplay="" preload="auto" muted="" loop="">
            <source src="https://player.vimeo.com/external/158148793.hd.mp4?s=8e8741dbee251d5c35a759718d4b0976fbf38b6f&amp;amp;profile_id=119&amp;amp;oauth2_token_id=57447761" type="video/mp4"></video>

        <div
                class="header-overlay" style="background-color:rgba(48,49,51,0.57);"></div>
    </div>
</header>
<section id="about">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6">
                <h2 class="text-center text-xl-left header-title" data-aos="fade-right" data-aos-duration="1000" data-aos-once="true" style="font-weight:bold;font-family:Montserrat, sans-serif;">ABOUT THE COMPANY</h2>
                <p class="text-justify text-wrap" style="padding:0;margin:0px;margin-left:40px;margin-right:40px;">Zip Travel Philippines is a career and education counseling/travel organization. We help students and young professionals attend cultural exchanges and travels in the United States and in Australia.&nbsp;<br><br>As a global company,
                    Zip Travel has been in the business for over twenty five (25) years and has helped thousands of students worldwide obtain the opportunity to participate in the Cultural Exchange Program authorized by the U.S. Department of State.&nbsp;We
                    have 4 offices in the Philippines with our main office located on Manila and branch offices in Cebu, Davao and Pampanga. We also have offices in Europe for European students and have offices in Tennessee, New York, California,
                    Florida, South Carolina and Texas through our visa sponsors.&nbsp;<br><a class="btn btn-primary" role="button" href="#" style="background-color:rgb(6,20,89);margin-top:13px;margin-bottom:13px;"><strong>READ MORE</strong></a></p>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6" style="padding:0;"><img src="{{ asset('assets/img/30547103_10209023119574526_1203608868_o.jpg') }}" data-bs-hover-animate="pulse" class="img-scale" style="background-size:cover;background-repeat:no-repeat;"></div>
        </div>
    </div>
</section>
<section>
    <div class="container-fluid" style="padding:0;background:linear-gradient(to right, #06124a, #071766);">
        <div class="row no-gutters">
            <div class="col">
                <h2 class="text-center text-xl-left text-white header-title" data-aos="fade-right" data-aos-duration="1000" data-aos-once="true" style="font-weight:bold;">INTERNATIONAL MEMBERSHIP</h2>
                <div class="row" style="background-color:#ffffff;margin:44px;">
                    <div class="col-xl-6">
                        <p class="text-justify" style="margin:6px;padding:28px;margin-top:30px;">Zip Travel Philippines is a career and education counseling/travel organization. We help students and young professionals attend cultural exchanges and travels in the United States and in Australia.&nbsp;<br><br>As a global
                            company, Zip Travel has been in the business for over twenty five (25) years and has helped thousands of students worldwide obtain the opportunity to participate in the Cultural Exchange Program authorized by the U.S. Department
                            of State.&nbsp;We have 4 offices in the Philippines with our main office located on Manila and branch offices in Cebu, Davao and Pampanga. We also have offices in Europe for European students and have offices in Tennessee,
                            New York, California, Florida, South Carolina and Texas through our visa sponsors.&nbsp;<br><br></p>
                    </div>
                    <div class="col">
                        <div class="row d-flex justify-content-center" style="padding:29px;">
                            <div class="col-lg-4 col-xl-4 d-flex justify-content-center align-items-center align-content-center" data-bs-hover-animate="pulse" style="padding:0;"><img src="assets/img/4.png" width="150px" height="150px" style="width:50%;height:100%;"></div>
                            <div class="col-lg-4 col-xl-4 d-flex justify-content-center align-items-center align-content-center" data-bs-hover-animate="pulse"
                                 style="padding:0;"><img src="{{ asset('assets/img/3.png') }}" width="150px" height="150px" style="width:50%;height:100%;"></div>
                            <div class="col-lg-4 col-xl-4 d-flex justify-content-center align-items-center align-content-center" data-bs-hover-animate="pulse"
                                 style="padding:0;"><img src="{{ asset('assets/img/1024_highup.png') }}" width="150px" height="150px" style="width:50%;height:100%;"></div>
                            <div class="col-lg-4 col-xl-4 d-flex justify-content-center align-items-center align-content-center" data-bs-hover-animate="pulse"
                                 style="padding:0;"><img src="{{ asset('assets/img/5.png') }}" width="150px" height="150px" style="width:85%;height:94%;padding:12px;"></div>
                            <div class="col-lg-4 col-xl-4 d-flex justify-content-center align-items-center align-content-center" data-bs-hover-animate="pulse"
                                 style="padding:0;"><img src="{{ asset('assets/img/7.png') }}" width="150px" height="150px" style="width:112%;height:72%;"></div>
                            <div class="col-lg-4 col-xl-4 d-flex justify-content-center align-items-center align-content-center" data-bs-hover-animate="pulse"
                                 style="padding:0;"><img src="{{ asset('assets/img/AAHHRM-logo-c.png') }}" width="150px" height="150px" style="width:50%;height:100%;"></div>
                            <div class="col-lg-4 col-xl-4 d-flex justify-content-center align-items-center align-content-center" data-bs-hover-animate="pulse"
                                 style="padding:0;"><img src="{{ asset('assets/img/ASTD.png') }}" width="150px" height="150px" style="width:75%;height:60%;"></div>
                            <div class="col-lg-4 col-xl-4 d-flex justify-content-center align-items-center align-content-center" data-bs-hover-animate="pulse"
                                 style="padding:0;"><img src="{{ asset('assets/img/iata.png') }}" width="150px" height="150px" style="width:100%;height:80%;"></div>
                            <div class="col-lg-4 col-xl-4 d-flex justify-content-center align-items-center align-content-center" data-bs-hover-animate="pulse"
                                 style="padding:0;"><img src="{{ asset('assets/img/8.png') }}" width="150px" height="150px" style="width:60%;height:105%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section style="width:100%;">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h2 class="text-center text-xl-left" data-aos="fade-right" data-aos-duration="1000" data-aos-once="true" style="margin:43px 0px 9px 40px;font-weight:bold;">WHAT WE DO</h2>
                <p class="text-justify" style="margin-left:40px;margin-right:40px;">Providing FIlipino students and those from other countries an inter-cultural opportunities to become familiar with company-specific and U.S technologies through U.S based training while obtaining a better understanding of one another
                    and the world around them.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 d-flex flex-column justify-content-center align-items-center" style="padding:0;color:#040c32;background-color:#000347;">
                <h2 class="text-uppercase text-center" style="color:rgb(250,250,252);padding:0;padding-top:40px;font-weight:bold;">25</h2>
                <p class="text-center text-white" style="margin:0;padding-bottom:30px;">Years of Service</p>
            </div>
            <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 d-flex flex-column justify-content-center align-items-center align-content-center" style="padding:0;color:rgb(253,254,255);background-color:#07134f;">
                <h2 class="text-uppercase text-center" style="padding:0;padding-top:40px;font-weight:bold;">50,000+</h2>
                <p class="text-center" style="padding-bottom:30px;">Students and Alumni</p>
            </div>
            <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 d-flex flex-column justify-content-center align-items-center align-content-center" style="padding:0;background-color:#0a1c79;">
                <h2 class="text-uppercase text-center" style="color:rgb(255,255,255);padding:0;padding-top:40px;font-weight:bold;">99.6%</h2>
                <p class="text-center text-white" style="background-color:transparent;padding-bottom:30px;">Visa Approval Rate</p>
            </div>
            <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 d-flex flex-column justify-content-center align-items-center align-content-center" style="padding:0;background-color:#0d228e;">
                <h2 class="text-uppercase text-center" style="color:rgb(255,255,255);padding:0;padding-top:40px;font-weight:bold;">38</h2>
                <p class="text-center text-white" style="padding-bottom:30px;">States</p>
            </div>
        </div>
    </div>
</section>
<section id="programs" style="background:linear-gradient(to right, #06124a, #071766);margin-top:20px;">
    <div class="container-fluid" style="padding:0;">
        <div class="row no-gutters">
            <div class="col">
                <h2 class="text-center text-xl-left text-white header-title" data-aos="fade-right" data-aos-duration="1000" data-aos-once="true">PROGRAMS</h2>
            </div>
        </div>
        <div class="row no-gutters d-flex" style="margin-top:23px;">
            <div class="col-12 d-flex flex-column justify-content-center align-self-baseline mx-auto">
                <div class="row no-gutters d-flex">
                    <div class="col-lg-6 col-xl-6 d-flex" data-aos="zoom-in-right" data-aos-once="true" style="padding:33px;">
                        <div class="media d-flex flex-column justify-content-center align-items-center align-content-center flex-sm-row justify-content-sm-start align-items-sm-start align-content-sm-start flex-md-row justify-content-md-start align-items-md-start align-content-md-start flex-lg-row justify-content-lg-start align-items-lg-start align-content-lg-start"><img class="rounded-circle mr-3" width="100px" height="100px" style="background-size:cover;background-image:url(&quot;assets/img/spring.jpg&quot;);background-position:center;background-repeat:no-repeat;">
                            <div class="media-body">
                                <h6 class="text-center text-sm-left text-md-left text-lg-left text-xl-left text-white"><strong>WORK TRAVEL PROGRAM - SPRING</strong></h6>
                                <h6 class="text-center text-sm-left text-md-left text-lg-left text-xl-left text-white" style="font-size:10px;"><em>3 months (March - June)</em></h6>
                                <p class="text-justify text-white">This program is for college and university students enrolled full time and pursuing studies at accredited academic institutions located outside the United States. They come to the United States to share their culture
                                    and ideas with other people of the U.S. through temporary work and travel opportunities.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-6 d-flex" data-aos="zoom-in-right" data-aos-once="true" style="padding:33px;">
                        <div class="media d-flex flex-column justify-content-center align-items-center align-content-center flex-sm-row justify-content-sm-start align-items-sm-start align-content-sm-start flex-md-row justify-content-md-start align-items-md-start align-content-md-start flex-lg-row justify-content-lg-start align-items-lg-start align-content-lg-start"><img class="rounded-circle mr-3" width="100px" height="100px" style="background-size:cover;background-image:url(&quot;assets/img/summer.jpg&quot;);background-position:center;background-repeat:no-repeat;">
                            <div class="media-body">
                                <h6 class="text-center text-sm-left text-md-left text-lg-left text-xl-left text-white"><strong>WORK TRAVEL PROGRAM - SUMMER</strong></h6>
                                <h6 class="text-center text-sm-left text-md-left text-lg-left text-xl-left text-white" style="font-size:10px;"><em>3 months (May - August)</em></h6>
                                <p class="text-justify text-white">This program is for college and university students enrolled full time and pursuing studies at accredited academic institutions located outside the United States. They come to the United States to share their culture
                                    and ideas with other people of the U.S. through temporary work and travel opportunities.<br><br></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-6 d-flex" data-aos="zoom-in-right" data-aos-once="true" style="padding:33px;">
                        <div class="media d-flex flex-column justify-content-center align-items-center align-content-center flex-sm-row justify-content-sm-start align-items-sm-start align-content-sm-start flex-md-row justify-content-md-start align-items-md-start align-content-md-start flex-lg-row justify-content-lg-start align-items-lg-start align-content-lg-start"><img class="rounded-circle mr-3" width="100px" height="100px" style="background-size:cover;background-image:url(&quot;assets/img/intern.jpg&quot;);background-position:center;background-repeat:no-repeat;">
                            <div class="media-body">
                                <h6 class="text-center text-sm-left text-md-left text-lg-left text-xl-left text-white"><strong>INTERNSHIP PROGRAM</strong></h6>
                                <h6 class="text-center text-sm-left text-md-left text-lg-left text-xl-left text-white" style="font-size:10px;"><em>6 to 12 months (Year Round)</em></h6>
                                <p class="text-justify text-white">These programs are designed to allow foreign college and university students or recent graduates to come to the United States to gain exposure to U.S. culture and to business practices in their chosen occupational field.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-6 d-flex" data-aos="zoom-in-right" data-aos-once="true" style="padding:33px;">
                        <div class="media d-flex flex-column justify-content-center align-items-center align-content-center flex-sm-row justify-content-sm-start align-items-sm-start align-content-sm-start flex-md-row justify-content-md-start align-items-md-start align-content-md-start flex-lg-row justify-content-lg-start align-items-lg-start align-content-lg-start"><img class="rounded-circle mr-3" width="100px" height="100px" style="background-size:cover;background-image:url(&quot;assets/img/career.jpg&quot;);background-position:center;background-repeat:no-repeat;">
                            <div class="media-body">
                                <h6 class="text-center text-sm-left text-md-left text-lg-left text-xl-left text-white"><strong>CAREER TRAINING PROGRAM</strong></h6>
                                <h6 class="text-center text-sm-left text-md-left text-lg-left text-xl-left text-white" style="font-size:10px;"><em>12 months (Year Round)</em></h6>
                                <p class="text-justify text-white">Training programs are designed to allow foreign professionals to come to the United States to gain exposure to U.S. culture and to receive training in U.S. business practices in their chosen.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="d-flex" style="min-height:324px;">
    <div class="container-fluid">
        <div class="row no-gutters">
            <div class="col">
                <h2 class="header-title">APPLICATION GUIDE</h2>
                <div class="row" style="margin-top:25px;">
                    <div class="col-12 col-sm-4 col-md-4 col-lg-2 col-xl-2 d-flex flex-column justify-content-between align-items-center align-content-center" data-aos="flip-right" data-aos-once="true">
                        <h6 style="font-weight:bold;">Step 1</h6><img class="rounded-circle" width="100px" height="100px" data-bs-hover-animate="pulse" style="padding:0px;background-image:url({{ asset('assets/img/register.jpg') }});background-size:cover;background-position:center;background-repeat:no-repeat;">
                        <p
                                class="text-center" style="font-size:13px;margin-top:15px;">Register online at www.ziptravel.com.ph</p>
                    </div>
                    <div class="col-12 col-sm-4 col-md-4 col-lg-2 col-xl-2 d-flex flex-column justify-content-between align-items-center align-content-center" data-aos="flip-right" data-aos-once="true">
                        <h6 style="font-weight:bold;">Step 2</h6><img class="rounded-circle" width="100px" height="100px" data-bs-hover-animate="pulse" style="padding:0px;background-image:url({{ asset('assets/img/orientation.jpeg') }});background-position:center;background-size:cover;background-repeat:no-repeat;">
                        <p
                                class="text-center" style="font-size:13px;margin-top:15px;">Program Orientation and Assessment</p>
                    </div>
                    <div class="col-12 col-sm-4 col-md-4 col-lg-2 col-xl-2 d-flex flex-column justify-content-between align-items-center align-content-center" data-aos="flip-right" data-aos-once="true">
                        <h6 style="font-weight:bold;">Step 3</h6><img class="rounded-circle" width="100px" height="100px" data-bs-hover-animate="pulse" style="padding:0px;background-image:url({{ asset('assets/img/host_company.jpg') }});background-position:center;background-size:cover;background-repeat:no-repeat;">
                        <p
                                class="text-center" style="font-size:13px;">U.S. Host Company Interview</p>
                    </div>
                    <div class="col-12 col-sm-4 col-md-4 col-lg-2 col-xl-2 d-flex flex-column justify-content-between align-items-center align-content-center" data-aos="flip-right" data-aos-once="true">
                        <h6 style="font-weight:bold;">Step 4</h6><img class="rounded-circle" width="100px" height="100px" data-bs-hover-animate="pulse" style="padding:0px;background-image:url({{ asset('assets/img/j1_visa.jpg') }});background-position:center;background-size:cover;background-repeat:no-repeat;">
                        <p
                                class="text-center" style="font-size:13px;margin-top:15px;">Processing of J1 Visa</p>
                    </div>
                    <div class="col-12 col-sm-4 col-md-4 col-lg-2 col-xl-2 d-flex flex-column justify-content-between align-items-center align-content-center" data-aos="flip-right" data-aos-once="true">
                        <h6 style="font-weight:bold;">Step 5</h6><img class="rounded-circle" width="100px" height="100px" data-bs-hover-animate="pulse" style="padding:0px;background-image:url({{ asset('assets/img/preparation.jpg') }});background-position:center;background-size:cover;background-repeat:no-repeat;">
                        <p
                                class="text-center" style="font-size:13px;margin-top:15px;">Preparation for Departure to U.S.A</p>
                    </div>
                    <div class="col-12 col-sm-4 col-md-4 col-lg-2 col-xl-2 d-flex flex-column justify-content-between align-items-center align-content-center" data-aos="flip-right" data-aos-once="true">
                        <h6 style="font-weight:bold;">Step 6</h6><img class="rounded-circle" width="100px" height="100px" data-bs-hover-animate="pulse" style="padding:0px;background-image:url({{ asset('assets/img/program_proper.jpg') }});background-position:center;background-size:cover;background-repeat:no-repeat;">
                        <p
                                class="text-center" style="font-size:13px;margin-top:15px;">Program Proper and Monitoring</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="carousel slide" data-ride="carousel" id="carousel-1" style="width:100%;height:auto;">
    <div class="carousel-inner" role="listbox" style="background-image:url({{ asset('assets/img/zipbg.jpg') }});width:100%;height:519px;min-height:519px;">
        <div class="carousel-item" style="padding:100px 100px;margin-bottom:50px;">
            <div class="media d-flex flex-column justify-content-center align-items-center align-content-center">
                <img class="rounded-circle mr-3" width="150px" height="150px" style="margin:0;margin-right:0px;margin-bottom:10px;background-position:center;background-size:cover;background-repeat:no-repeat;background-image:url({{ asset('assets/img/desk.jpg') }});">
                <div
                        class="media-body">
                    <h5 class="text-center text-white"><strong>Jan Marc T. Cerezo</strong><br></h5>
                    <h6 class="text-center text-white" style="font-size:12px;">University of Baguio<br></h6>
                    <p class="text-center text-white">"This program helps every individual to get out of their shell. It would also help them show their talent. I highly recommend this program to everyone. It maybe difficult at first but trust me, you'll learn a lot and grow a lot
                        and grow. Thanks ZIP Travel for the wonderful experience!"<br></p>
                </div>
            </div>
        </div>
        <div class="carousel-item active" style="padding:100px 100px;margin-bottom:50px;">
            <div class="media d-flex flex-column justify-content-center align-items-center align-content-center"><img class="rounded-circle mr-3" width="150px" height="150px" style="margin:0;margin-bottom:10px;margin-right:0px;background-position:center;background-size:cover;background-repeat:no-repeat;background-image:url({{ asset('assets/img/desk.jpg') }});">
                <div
                        class="media-body">
                    <h5 class="text-center text-white"><strong>Rockney Ritz J. Roasa</strong><br></h5>
                    <h6 class="text-center text-white" style="font-size:12px;">University of Santo Tomas<br></h6>
                    <p class="text-center text-white">"To all aspiring and future Summer Work Travel participants, or maybe interns, I assure you that this program is really worth it. The application and the bills are just the beginning of the never ending fun and excitement when you
                        get here in the United States. Most importantly, you shall never miss out the generosity of the United States of giving abundant life lessons. Take a huge leap of faith and reach your American dream!"<br></p>
                </div>
            </div>
        </div>
    </div>
    <div><a class="carousel-control-prev" href="#carousel-1" role="button" data-slide="prev"><span class="carousel-control-prev-icon"></span><span class="sr-only">Previous</span></a><a class="carousel-control-next" href="#carousel-1" role="button" data-slide="next"><span class="carousel-control-next-icon"></span><span class="sr-only">Next</span></a></div>
</div>
<div class="map-clean"><iframe allowfullscreen="" frameborder="0" width="100%" height="450" src="https://www.google.com/maps/embed/v1/search?key=AIzaSyDaEw6o8OhJvRQnTF3gI_tibMejtfasOlY&amp;q=Zip+Travel+Philippines+(Inner+Outer+Travel%2C+Inc)&amp;zoom=15"></iframe></div>
<div
        id="contact" class="footer-dark" style="background:linear-gradient(to right, #06124a, #071766);">
    <footer>
        <div class="container">
            <div class="row no-gutters">
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                    <h5 style="font-weight:bold;">CONTACT US</h5>
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <h5 class="text-warning" style="font-weight:bold;">MANILA OFFICE:</h5>
                            <p style="font-size:12px;">2F 1985 C.M. Recto Avenue Sampaloc, Manila</p>
                            <p style="font-size:12px;">(02)559-8213 | 0917-522-8213 | 0922-876-8213</p>
                        </div>
                        <div class="col-12 col-sm-6">
                            <h5 class="text-warning" style="font-weight:bold;">DAVAO OFFICE:</h5>
                            <p style="font-size:12px;">5F Metro Lifestyle Complex, F. Torres Street, Davao City</p>
                            <p style="font-size:12px;">(082) 296-5941 | 0917-800-8213</p>
                        </div>
                        <div class="col-12 col-sm-6">
                            <h5 class="text-warning" style="font-weight:bold;">CEBU OFFICE:</h5>
                            <p style="font-size:12px;">Unit 216, Raintree Mall, 528 General Maxilom Avenue, Cebu City</p>
                            <p style="font-size:12px;">(032)266-8840 | 0915-875-7618</p>
                        </div>
                        <div class="col-12 col-sm-6">
                            <h5 class="text-warning" style="font-weight:bold;">PAMPANGA OFFICE:</h5>
                            <p style="font-size:10px;">Unit 101-B Km 6 Green Fields Square Mac Arthur Highway Sindalan, San Fernando, Pampanga</p>
                            <p style="font-size:12px;">0906-371-5897</p>
                        </div>
                        <div class="col-12">
                            <div class="row no-gutters">
                                <div class="col-12 col-sm-6 col-md-3 d-flex flex-row justify-content-center align-items-center"><i class="fa fa-envelope-o" style="margin-right:6px;"></i>
                                    <h6 style="margin-bottom:0px;font-size:10px;">info@ziptravel.com.ph</h6>
                                </div>
                                <div class="col-12 col-sm-6 col-md-3 d-flex flex-row justify-content-center align-items-center"><i class="fa fa-facebook-square" style="margin-right:6px;"></i>
                                    <h6 style="margin-bottom:0px;font-size:10px;">ZIP Travel Philippines</h6>
                                </div>
                                <div class="col-12 col-sm-6 col-md-3 d-flex flex-row justify-content-center align-items-center"><i class="fa fa-instagram" style="margin-right:6px;"></i>
                                    <h6 style="margin-bottom:0px;font-size:10px;">ziptravelph</h6>
                                </div>
                                <div class="col-12 col-sm-6 col-md-3 d-flex flex-row justify-content-center align-items-center"><i class="fa fa-youtube-play" style="margin-right:6px;"></i>
                                    <h6 style="margin-bottom:0px;font-size:10px;">ZIP Travel Philippines</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6" style="padding-left:17px;padding-right:17px;">
                    <form>
                        <h5 style="font-weight:bold;">FOR INQUIRIES</h5>
                        <div class="form-group">
                            <input class="form-control form-control-sm" type="text" placeholder="Name" style="background-color:rgba(255,255,255,0);color:rgb(248,249,251);">
                        </div>
                        <div class="form-group">
                            <input class="form-control form-control-sm" type="text" placeholder="Email" style="background-color:rgba(255,255,255,0);color:rgb(248,248,248);">
                        </div>
                        <div class="form-group">
                            <input class="form-control form-control-sm" type="text" placeholder="Subject" style="background-color:rgba(255,255,255,0);color:rgb(246,248,249);">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" placeholder="Message" autocomplete="on" style="background-color:rgba(255,255,255,0);color:rgb(246,247,248);"></textarea>
                        </div>
                        <div class="form-group d-flex flex-row-reverse">
                            <button class="btn btn-primary btn-sm" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="col-12">
                    <div class="row no-gutters">
                        <div class="col d-flex justify-content-start align-items-center align-content-center" style="margin-top:25px;">
                            <h6 style="margin-bottom:0px;font-size:10px;">@ 2018 Zip Travel PH</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.jquery.min.js"></script>
<script src="{{ asset('assets/js/script.min.js') }}"></script>
</body>

</html>
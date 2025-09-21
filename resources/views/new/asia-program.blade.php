@extends('new.layouts.app')

@section('meta')
    <meta name="title" content="Asia Programs | ZIP Travel Philippines">
    <meta name="description" content="Join our International programs and explore the world’s wonders, unlock your potential, and seize opportunities for personal and professional growth.">

    <meta property="og:title" content="Asia Programs | ZIP Travel Philippines" />
    <meta property="og:description" content="Join our International programs and explore the world’s wonders, unlock your potential, and seize opportunities for personal and professional growth.">
    <meta property="og:type" content="article" />
    <meta property="og:url" content="https://ziptravel.com.ph/program-asia" />

    <meta name="twitter:title" content="Asia Programs | ZIP Travel Philippines">
    <meta name="twitter:description" content="Join our International programs and explore the world’s wonders, unlock your potential, and seize opportunities for personal and professional growth.">
@endsection

@section('title', 'Asia Programs | ZIP Travel Philippines')

@section('content')
    <div id="heading" class="heading">
        <video class="heading__video" muted autoplay loop>
            <source src="{{ asset('assets_v3/videos/ASIA_HEADER.mp4') }}" type="video/mp4">
        </video>
        <div class="heading__content container d-flex d-xxl-flex flex-column justify-content-center align-items-center justify-content-sm-center justify-content-md-end align-items-lg-start h-100">
            <div class="d-flex d-sm-flex d-md-flex d-xxl-flex flex-column justify-content-sm-center align-items-sm-center align-items-md-start justify-content-xxl-start" style="color: #FFFFFF;margin-bottom: 43px;">
                <h1 class="text-center heading__content-title">ASIA PROGRAM</h1>
                <p class="text-center text-sm-center text-md-start heading__content-description">
                    (Subject to CHED CMO)
                    <br>
                    Asia offers a rich cultural experience for students, with opportunities to explore unique customs and traditions. The hospitality industry in Asia is known for its exceptional service and customer satisfaction. The Asia Internship Program allows students to experience this firsthand.
                </p>
            </div>
        </div>
    </div><!-- Start: about-us -->
    <section style="padding: 75px 0;" class="px-2 px-md-0">
        <div class="container">
            <div>
                <p style="margin-bottom: 25px; font-family: 'Inter'; font-size: 18px;">The Asia Internship Program is tailored for hospitality students currently enrolled and seeking to gain their first work experience in the hospitality industry while also exploring the rich cultural heritage of Asia and entering the global workforce</p>
            </div>
            <div>
                <h5 class="content-body-title">WORK AND TRAVEL ASIA</h5>
                <p class="content-body" style="margin-bottom: 25px;">The program specifically targets students eager to travel and expand their horizons by participating in Asian cultural immersion activities for up to 5 months.</p>
            </div>
            <div>
                <h5 class="content-body-title">HOSPITALITY AND BUSINESS INTERNSHIP</h5>
                <p class="content-body" style="margin-bottom: 25px;">A 6-to-12-month hands-on internship program for enrolled students and recent graduates who wish to gain their first work experience in the hospitality industry and explore the rich cultural heritage of Asia.</p>
            </div>
            <div>
                <h5 class="content-body-title">MANAGEMENT TRAINING PROGRAM</h5>
                <p class="content-body" style="margin-bottom: 25px;">The program is designed to provide career development in 6, 12, and up to 18 months. Participants will undertake training tasks to enhance and refine supervisory skills for their future managerial roles.</p>
            </div>
            <div class="row">
                <div class="col-12">
                    <ul class="content-body">
                        <li>Immerse yourself in rich and diverse Asian cultures while gaining academic credits and international experience.</li>
                        <li>Experience travel, improve interpersonal skills, and build global networks within Asia's global market.</li>
                        <li>Receive allowances and living arrangements provided by host organizations.</li>
                    </ul>
                </div>
            </div><a href="{{ url('/portal/v2/login') }}" target="_blank" class="btn btn-primary apply-now-section__action" role="button" >APPLY NOW!</a>
        </div>
    </section><!-- End: about-us -->
@endsection
@extends('new.layouts.app')

@section('meta')
<meta name="title" content="Spain Program | ZIP Travel Philippines">
    <meta name="description" content="Join our International programs and explore the world’s wonders, unlock your potential, and seize opportunities for personal and professional growth.">

    <meta property="og:title" content="Spain Program | ZIP Travel Philippines" />
    <meta property="og:description" content="Join our International programs and explore the world’s wonders, unlock your potential, and seize opportunities for personal and professional growth.">
    <meta property="og:type" content="article" />
    <meta property="og:url" content="https://ziptravel.com.ph/program-spain" />

    <meta name="twitter:title" content="Spain Program | ZIP Travel Philippines">
    <meta name="twitter:description" content="Join our International programs and explore the world’s wonders, unlock your potential, and seize opportunities for personal and professional growth.">
@endsection

@section('title', 'Spain Program | ZIP Travel Philippines')

@section('content')
    <div id="heading" class="heading">
        <video class="heading__video" muted autoplay loop>
            <source src="{{ asset('assets_v3/videos/SPAIN_HEADER.mp4') }}" type="video/mp4">
        </video>
        <div class="heading__content container d-flex d-xxl-flex flex-column justify-content-center align-items-center justify-content-sm-center justify-content-md-end align-items-lg-start h-100">
            <div class="d-flex d-sm-flex d-md-flex d-xxl-flex flex-column justify-content-sm-center align-items-sm-center align-items-md-start justify-content-xxl-start" style="margin-bottom: 43px;">
                <h1 class="text-center heading__content-title">SPAIN PROGRAM</h1>
                <p class="text-center heading__content-description text-sm-center text-md-start">
                    The hospitality and culinary scene in Spain is an excellent opportunity for students to gain professional experience, learn new languages, explore diverse cultures, and visit stunning locations.
                </p>
            </div>
        </div>
    </div><!-- Start: about-us -->
    <section style="padding: 75px 0;" class="px-2 px-md-0">
        <div class="container">
            <div>
                <h5 style="font-family: 'Outfit'; font-size: 20px; font-weight: bolder !important;color:var(--section-title-text-color)">HOSPITALITY AND CULINARY INTERNSHIP IN SPAIN</h5>
                <p style="margin-bottom: 25px; font-family: 'Inter'; font-size: 18px;">Experience top-notch training at some of the most prestigious 3 to 5-star hotels and Michelin-starred restaurants in Barcelona, Madrid, Toledo, Valencia, and Ibiza. Get an opportunity to learn from the best in the industry, while immersing yourself in the people, the local culture, and the different customs.</p>
                <p style="margin-bottom: 25px; font-family: 'Inter'; font-size: 18px;">Currently enrolled hospitality college/university students can benefit from paid internships lasting 3 to 6 months. They can gain valuable hands-on experience in the hospitality and culinary fields through this program.</p>
            </div>
            <div class="row">
                <div class="col-12">
                    <ul style="font-family: 'Inter'; font-size: 18px;">
                        <li>Free housing, meals on duty, and a monthly stipend determined by the company</li>
                        <li>Basic knowledge of Spanish will be advantageous:</li>
                        <li style="margin-left: 55px;">A good command of English is sufficient for culinary and housekeeping positions&nbsp;</li>
                        <li style="margin-left: 55px;">Fluency in Spanish is necessary for front desk and food &amp; beverage roles</li>
                    </ul>
                </div>
            </div>
            <a href="{{ url('/portal/v2/login') }}" target="_blank" class="btn btn-primary apply-now-section__action" role="button">APPLY NOW!</a>
        </div>
    </section><!-- End: about-us -->
@endsection
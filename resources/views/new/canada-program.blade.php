@extends('new.layouts.app')

@section('meta')
    <meta name="title" content="Canada Program | ZIP Travel Philippines">
    <meta name="description" content="The Canada Program allows participants to have a deeper understanding of Canadian and North American cultures.">

    <meta property="og:title" content="Canada Program | ZIP Travel Philippines" />
    <meta property="og:description" content="The Canada Program allows participants to have a deeper understanding of Canadian and North American cultures.">
    <meta property="og:type" content="article" />
    <meta property="og:url" content="https://ziptravel.com.ph/program-canada" />

    <meta name="twitter:title" content="Canada Program | ZIP Travel Philippines">
    <meta name="twitter:description" content="The Canada Program allows participants to have a deeper understanding of Canadian and North American cultures.">
@endsection

@section('title', 'Canada Program | ZIP Travel Philippines')

@section('content')
    <div id="heading" class="heading">
        <video class="heading__video" muted autoplay loop>
            <source src="{{ asset('assets_v3/videos/CANADA_HEADER.mp4') }}" type="video/mp4">
        </video>
        <div class="heading__content container d-flex d-xxl-flex flex-column justify-content-center align-items-center justify-content-sm-center justify-content-md-end align-items-lg-start h-100">
            <div class="d-flex d-sm-flex d-md-flex d-xxl-flex flex-column justify-content-sm-center align-items-sm-center align-items-md-start justify-content-xxl-start" style="margin-bottom: 43px;">
                <h1 class="text-center heading__content-title">CANADA PROGRAM</h1>
                <p class="text-center heading__content-description text-sm-center text-md-start">
                    The Canada Program provides international students an excellent opportunity to obtain additional post-graduate degrees from recognized Canadian institutions, gain valuable work experience under Canadian companies, and potentially obtain permanent residency.    
                </p>
            </div>
        </div>
    </div><!-- Start: about-us -->
    <section style="padding: 75px 0;" class="px-2 px-md-0">
        <div class="container">
            <div style="font-size: 18px;font-family: 'Inter';color: #2A2A2A;">
                <p style="margin-bottom: 25px;">Known for having the most polite citizens, Canada ranks #3 in quality of life based on factors including health system, safety, job market, and economic stability. International students feel welcomed thanks to the country’s diversity and multiculturalism.</p>
            </div>
            <div class="row">
                <div class="col-12" style="font-size: 18px; font-family: 'Inter';">
                    <div>
                        <h5 style="font-family: 'Outfit';font-weight: bold; color: var(--section-title-text-color)">STUDY. WORK. LIVE.</h5>
                        <p>1 to 2 years</p>
                        <p style="margin-bottom: 25px;">Known for having the most polite citizens, Canada ranks #3 in quality of life based on factors including health system, safety, job market, and economic stability. International students feel welcomed thanks to the country’s diversity and multiculturalism.</p>
                    </div>
                    <ul>
                        <li>Over 90 colleges and universities to choose from</li>
                        <li>Get a qualification valued around the world</li>
                        <li>Enhance skills and knowledge in the chosen field of study</li>
                        <li>Work part-time during school semesters and full-time on official school breaks</li>
                        <li>Affordable education and quality of life</li>
                        <li>More affordable tuition fees for international students than in other countries without sacrificing the quality of education</li>
                        <li>Open to all courses: business, hospitality, culinary, engineering, health sciences, etc.</li>
                        <li>A pathway to permanent residence in Canada</li>
                    </ul>
                    <div>
                        <h5 style="font-family: 'Outfit';font-weight: bold; color: var(--section-title-text-color);">ELIGIBILITY</h5>
                        <ul>
                            <li>18 to 35 years old</li>
                            <li>Must be a high school or college graduate</li>
                            <li>Must be an effective communicator in an English-speaking environment</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End: about-us -->
    <!-- Start: application-guide -->
    <section class="d-flex justify-content-center align-items-center app-guide-section">
        <div class="container">
            <h1 class="app-guide-section__title">APPLICATION GUIDE</h1>
            <div class="row align-items-center">
                <div class="col-12 col-md-6 order-0 order-md-0">
                    <div class="d-flex flex-row align-items-center align-items-xl-center app-guide-sequence-item">
                        <div class="d-flex justify-content-center align-items-center app-guide-sequence-item__step">
                            <span>01</span>
                        </div>
                        <p class="app-guide-sequence-item__description">Program Orientation and Assessment</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 order-3 order-md-0">
                    <div class="d-flex d-xl-flex align-items-center align-items-xl-center" style="padding: 15px 0;">
                        <div class="d-flex justify-content-center align-items-center app-guide-sequence-item__step">
                            <span>04</span>
                        </div>
                        <p class="app-guide-sequence-item__description">Visa Processing and Filing</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 order-1 order-md-0">
                    <div class="d-flex d-xl-flex align-items-center align-items-xl-center" style="padding: 15px 0;">
                        <div class="d-flex justify-content-center align-items-center app-guide-sequence-item__step">
                            <span>02</span>
                        </div>
                        <p class="app-guide-sequence-item__description">Online Registration</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 order-4 order-md-0">
                    <div class="d-flex d-xl-flex align-items-center align-items-xl-center" style="padding: 15px 0;">
                        <div class="d-flex justify-content-center align-items-center app-guide-sequence-item__step">
                            <span>05</span>
                        </div>
                        <p class="app-guide-sequence-item__description">Departure and Program Proper</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 order-2 order-md-0">
                    <div class="d-flex d-xl-flex align-items-center align-items-xl-center" style="padding: 15px 0;">
                        <div class="d-flex justify-content-center align-items-center app-guide-sequence-item__step">
                            <span>03</span>
                        </div>
                        <p class="app-guide-sequence-item__description">Submission of Documents</p>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End: application-guide -->
    <!-- Start: apply-now -->
    <section class="d-flex align-items-center align-items-center apply-now-section">
        <div class="container text-start d-flex flex-column align-items-start">
            <p class="apply-now-section__description">ZIP Travel is here to help you make the most of your international journey. We are dedicated to delivering the highest quality international opportunities and committed to providing exceptional support and guidance to participants throughout the program.</p>
            <a href="https://ziptravel.com.ph/online-registration" target="_blank" class="btn btn-primary apply-now-section__action" role="button">APPLY NOW!</a>
        </div>
    </section><!-- End: apply-now -->
@endsection
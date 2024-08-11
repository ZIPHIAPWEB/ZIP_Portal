@extends('new.layouts.app')

@section('meta')
    <meta name="title" content="J-1 Visa BridgeUSA Program | ZIP Travel Philippines">
    <meta name="description" content="We offer J1 Visa BridgeUSA Programs for students and new graduates to gain work and cultural experience in the United States of America">

    <meta property="og:title" content="J-1 Visa BridgeUSA Program | ZIP Travel Philippines" />
    <meta property="og:description" content="We offer J1 Visa BridgeUSA Programs for students and new graduates to gain work and cultural experience in the United States of America">
    <meta property="og:type" content="article" />
    <meta property="og:url" content="https://ziptravel.com.ph/program-bridgeusa" />

    <meta name="twitter:title" content="J-1 Visa BridgeUSA Program | ZIP Travel Philippines">
    <meta name="twitter:description" content="We offer J1 Visa BridgeUSA Programs for students and new graduates to gain work and cultural experience in the United States of America">
@endsection

@section('title', 'J-1 Visa BridgeUSA Program | ZIP Travel Philippines')

@section('content')
    <div id="heading" class="heading">
        <video class="heading__video" muted autoplay loop>
            <source src="{{ asset('assets_v3/videos/BRIDGEUSA_HEADER.mp4') }}" type="video/mp4">
        </video>
        <div class="heading__content container d-flex d-xxl-flex flex-column justify-content-center align-items-center justify-content-sm-center justify-content-md-end align-items-lg-start h-100">
            <div class="d-flex d-sm-flex d-md-flex d-xxl-flex flex-column justify-content-sm-center align-items-sm-center align-items-md-start justify-content-xxl-start" style="margin-bottom: 43px;">
                <h1 class="text-center heading__content-title">BRIDGEUSA PROGRAMS</h1>
                <p class="text-center heading__content-description text-sm-center text-md-start">BridgeUSA is a chance for students to visit the United States of America, be exposed to the diverse American citizens and culture, undergo practical learning, and seek career advancement.</p>
            </div>
        </div>
    </div><!-- Start: about-us -->
    <section style="padding: 75px 0;" class="px-2 px-md-0">
        <div class="container">
            <div style="font-size: 18px;font-family: 'Inter';color: #2A2A2A;">
                <p style="margin-bottom: 25px;">The Mutual Educational and Cultural Exchange Act (also known as the Fulbright-Hays Act) was established in 1961 to enhance the mutual understanding between Americans and the rest of the world. It created the Exchange Visitor Program, now rebranded as BridgeUSA, where college and university students and fresh graduates worldwide can come to the United States under the J1 Visa.</p>
                <p style="margin-bottom: 25px;">Under the J1 Visa BridgeUSA program, the country welcomes around 300,000 participants from 200 countries annually. It allows foreign nationals to participate in work-and-study-based programs such as teaching, studying, or receiving on-the-job training for several weeks or years.</p>
                <p style="margin-bottom: 25px;">The BridgeUSA program is administered by the U.S. Department of State's Bureau of Educational and Cultural Affairs.</p>
            </div>
            <div class="row gap-3" style="font-size: 20px;font-family: 'Outfit';font-weight:600;margin-top: 5rem;">
                <div class="col d-flex justify-content-center align-items-center bridge-usa-program-card">
                    <a href="/program-swt">
                        <div class="bridge-usa-program-card__content">
                            <img class="bridge-usa-program-card__image" src="assets_v3/img/B_SWT.png">
                            <div class="d-flex justify-content-center align-items-center justify-content-xl-center bridge-usa-program-card__text-wrapper">
                                <span class="bridge-usa-program-card__text">Summer Work Travel</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col d-flex justify-content-center align-items-center bridge-usa-program-card">
                    <a href="/program-internship">
                        <div class="bridge-usa-program-card__content">
                            <img class="bridge-usa-program-card__image" src="assets_v3/img/B_INTERN.png">
                            <div class="d-flex justify-content-center align-items-center justify-content-xl-center bridge-usa-program-card__text-wrapper">
                                <span class="bridge-usa-program-card__text">Internship</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col d-flex justify-content-center align-items-center bridge-usa-program-card">
                    <a href="/program-career">
                        <div class="bridge-usa-program-card__content">
                            <img class="bridge-usa-program-card__image" src="assets_v3/img/B_TRAINEE.png">
                            <div class="d-flex justify-content-center align-items-center justify-content-xl-center bridge-usa-program-card__text-wrapper">
                                <span class="bridge-usa-program-card__text">Trainee</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col d-flex justify-content-center align-items-center bridge-usa-program-card">
                    <a href="/program-camp-counselor">
                        <div class="bridge-usa-program-card__content">
                            <img class="bridge-usa-program-card__image" src="assets_v3/img/B_CAMP.png">
                            <div class="d-flex justify-content-center align-items-center justify-content-xl-center bridge-usa-program-card__text-wrapper">
                                <span class="bridge-usa-program-card__text">Camp Counselor</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col d-flex justify-content-center align-items-center bridge-usa-program-card">
                    <a href="/program-teacher-program">
                        <div class="bridge-usa-program-card__content">
                            <img class="bridge-usa-program-card__image" src="assets_v3/img/B_TEACHERS.png">
                            <div class="d-flex justify-content-center align-items-center justify-content-xl-center bridge-usa-program-card__text-wrapper">
                                <span class="bridge-usa-program-card__text">Teachers Program</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section><!-- End: about-us -->
    <!-- Start: application-guide -->
    <section class="app-guide-section d-md-flex justify-content-md-center align-items-md-center">
        <div class="container">
            <h1 class="app-guide-section__title">APPLICATION GUIDE</h1>
            <div class="row align-items-center">
                <div class="col-12 col-md-6">
                    <div class="d-flex align-items-center app-guide-sequence-item">
                        <div class="app-guide-sequence-item__step d-flex justify-content-center align-items-center" >
                            <span>01</span>
                        </div>
                        <p class="app-guide-sequence-item__description">Program Orientation and Assessment</p>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="d-flex align-items-center app-guide-sequence-item">
                        <div class="app-guide-sequence-item__step d-flex d-xl-flex justify-content-center align-items-center justify-content-xl-center align-items-xl-center">
                            <span>04</span>
                        </div>
                        <p class="app-guide-sequence-item__description">Host Company Interview</p>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="d-flex align-items-center app-guide-sequence-item">
                        <div class="app-guide-sequence-item__step d-flex d-xl-flex justify-content-center align-items-center justify-content-xl-center align-items-xl-center">
                            <span>02</span>
                        </div>
                        <p class="app-guide-sequence-item__description">Online Registration</p>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="d-flex align-items-center app-guide-sequence-item">
                        <div class="app-guide-sequence-item__step d-flex d-xl-flex justify-content-center align-items-center justify-content-xl-center align-items-xl-center">
                            <span>05</span>
                        </div>
                        <p class="app-guide-sequence-item__description">J1 Visa Processing</p>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="d-flex align-items-center app-guide-sequence-item">
                        <div class="app-guide-sequence-item__step d-flex d-xl-flex justify-content-center align-items-center justify-content-xl-center align-items-xl-center">
                            <span>03</span>
                        </div>
                        <p class="app-guide-sequence-item__description">Submission of Documents</p>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="d-flex align-items-center app-guide-sequence-item">
                        <div class="app-guide-sequence-item__step d-flex d-xl-flex justify-content-center align-items-center justify-content-xl-center align-items-xl-center">
                            <span>06</span>
                        </div>
                        <p class="app-guide-sequence-item__description">Departure and Program Proper</p>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End: application-guide -->
    <!-- Start: apply-now -->
    <section class="d-flex align-items-center align-items-center apply-now-section">
        <div class="container d-xl-flex flex-column align-items-start">
            <p class="apply-now-section__description">ZIP Travel is here to help you make the most of your international journey. We are dedicated to delivering the highest quality international opportunities and committed to providing exceptional support and guidance to participants throughout the program.</p>
            <a href="https://ziptravel.com.ph/online-registration" target="_blank" class="btn btn-primary apply-now-section__action" role="button">APPLY NOW!</a>
        </div>
    </section><!-- End: apply-now -->
@endsection
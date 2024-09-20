@extends('new.layouts.app')

@section('meta')
    <meta name="title" content="BridgeUSA Camp Counselor Program | ZIP Travel Philippines">
    <meta name="description" content="The Camp Counselor Program provides a unique opportunity to develop valuable skills working at a summer camp in America.">

    <meta property="og:title" content="BridgeUSA Camp Counselor Program | ZIP Travel Philippines" />
    <meta property="og:description" content="The Camp Counselor Program provides a unique opportunity to develop valuable skills working at a summer camp in America.">
    <meta property="og:type" content="article" />
    <meta property="og:url" content="https://ziptravel.com.ph/program-camp-counselor" />

    <meta name="twitter:title" content="BridgeUSA Camp Counselor Program | ZIP Travel Philippines">
    <meta name="twitter:description" content="The Camp Counselor Program provides a unique opportunity to develop valuable skills working at a summer camp in America.">
@endsection

@section('title', 'BridgeUSA Camp Counselor Program | ZIP Travel Philippines')

@section('content')
    <div id="heading" class="heading">
        <video class="heading__video" muted autoplay loop>
            <source src="{{ asset('assets_v3/videos/CAMP_HEADER.mp4') }}" type="video/mp4">
        </video>
        <div class="heading__content container d-flex d-xxl-flex flex-column justify-content-center align-items-center justify-content-sm-center justify-content-md-end align-items-lg-start h-100">
            <div class="d-flex d-sm-flex d-md-flex d-xxl-flex flex-column justify-content-sm-center align-items-sm-center align-items-md-start justify-content-xxl-start" style="color: #FFFFFF;margin-bottom: 43px;">
                <h1 class="text-center heading__content-title">CAMP COUNSELOR PROGRAM</h1>
                <p class="text-center text-sm-center text-md-start heading__content-description">
                    Summer camp is an integral part of American culture. Every year, over 10 million children attend camps all across America. Over ten thousand summer camps exist across the country each with its history and traditions.
                </p>
            </div>
        </div>
    </div>
    <!-- Start: about-us -->
    <section style="padding: 75px 0;" class="px-2 px-md-0">
        <div class="container">
            <div style="font-size: 18px;font-family: 'Inter';color: #2A2A2A;">
                <p style="margin-bottom: 25px;">
                BridgeUSA's Camp Counselor Program enables college students, youth workers, and teachers to make a difference in the lives of young people while experiencing the unique American culture of summer camps.
                </p>
            </div>
            <div class="row">
                <div class="col-12" style="font-size: 18px; font-family: 'Inter';">
                    <ul>
                        <li>Open to everyone with a strong desire and enthusiasm to teach, coach, and work with children of various ages and cultural backgrounds</li>
                        <li>Participants supervise, organize, and lead various recreational activities</li>
                        <li>You may lead a group of campers and be responsible for creating a fun and safe environment</li>
                        <li>Improve your communication and English language skills</li>
                        <li>Be exposed to a diverse American culture and customs from other counselors as well as the young campers</li>
                        <li>Learn new skills such as archery, canoeing, horse riding, painting, or share your skills</li>
                        <li>Leave a lasting impact on the lives of the young campers</li>
                        <li>Boost your resume with experiences gained through the summer camp such as organization, leadership, and collaboration skills</li>
                        <li>Receive free camp accommodation, meals, and a stipend for up to $2,000</li>
                    </ul>
                </div>
            </div>
            <div class="row align-items-center" style="margin-top: 56px;">
                <div class="col-12">
                    <h5 style="font-family: 'Outfit';font-weight: bold;font-size: 20px; color: var(--section-title-text-color);">PROGRAM DURATION</h5>
                </div>
                <div class="col-12 d-flex align-items-lg-center" style="font-size: 18px; font-family: 'Inter';">
                    <p>The J1 Camp Counselor Program typically runs for 8-9 weeks from June to September, allowing student participants to have their camp adventure during the school summer vacation.</p>
                </div>
            </div>
            <div class="row align-items-center" style="margin-top: 56px;">
                <div class="col-12">
                    <h5 style="font-family: 'Outfit';font-weight: bold; color: var(--section-title-text-color);">ELIGIBILITY</h5>
                    <ul class="content-body">
                        <li>At least 18 years of age</li>
                        <li>Sufficiently proficient in the English language, able to interact in an English-speaking environment</li>
                        <li>Cheerful, energetic, friendly, hard-working, tolerant, flexible, conscientious, caring, reasonably gregarious, uncomplaining, and able to adapt to camp life, including the long hours, rules, and curfews</li>
                    </ul>
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
                    <div class="d-flex flex-row align-items-center align-items-xl-center app-guide-sequence-item">
                        <div class="d-flex justify-content-center align-items-center app-guide-sequence-item__step">
                            <span>04</span>
                        </div>
                        <p class="app-guide-sequence-item__description">Host Company Interview</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 order-1 order-md-0">
                    <div class="d-flex flex-row align-items-center align-items-xl-center app-guide-sequence-item">
                        <div class="d-flex justify-content-center align-items-center app-guide-sequence-item__step">
                            <span>02</span>
                        </div>
                        <p class="app-guide-sequence-item__description">Online Registration</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 order-4 order-md-0">
                    <div class="d-flex flex-row align-items-center align-items-xl-center app-guide-sequence-item">
                        <div class="d-flex justify-content-center align-items-center app-guide-sequence-item__step">
                            <span>05</span>
                        </div>
                        <p class="app-guide-sequence-item__description">J1 Visa Processing</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 order-2 order-md-0">
                    <div class="d-flex flex-row align-items-center align-items-xl-center app-guide-sequence-item">
                        <div class="d-flex justify-content-center align-items-center app-guide-sequence-item__step">
                            <span>03</span>
                        </div>
                        <p class="app-guide-sequence-item__description">Submission of Documents</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 order-5 order-md-0">
                    <div class="d-flex flex-row align-items-center align-items-xl-center app-guide-sequence-item">
                        <div class="d-flex justify-content-center align-items-center app-guide-sequence-item__step">
                            <span>06</span>
                        </div>
                        <p class="app-guide-sequence-item__description">Departure and Program Proper</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End: application-guide -->
    <!-- Start: apply-now -->
    <section class="d-flex align-items-center align-items-xl-center apply-now-section">
        <div class="container text-start d-flex flex-column align-items-start">
            <p class="apply-now-section__description">ZIP Travel is here to help you make the most of your international journey. We are dedicated to delivering the highest quality international opportunities and committed to providing exceptional support and guidance to participants throughout the program.</p>
            <a href="https://ziptravel.com.ph/online-registration" target="_blank" class="btn btn-primary apply-now-section__action" role="button">APPLY NOW!</a>
        </div>
    </section>
    <!-- End: apply-now -->
@endsection
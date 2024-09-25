@extends('new.layouts.app')

@section('meta')
    <meta name="title" content="Australia Programs | ZIP Travel Philippines">
    <meta name="description" content="Join our Australia programs and explore Australia's wonders, unlock your potential, and seize opportunities for personal and professional growth.">

    <meta property="og:title" content="Australia Programs | ZIP Travel Philippines" />
    <meta property="og:description" content="Join our Australia programs and explore Australia's wonders, unlock your potential, and seize opportunities for personal and professional growth.">
    <meta property="og:type" content="article" />
    <meta property="og:url" content="https://ziptravel.com.ph/program-australia" />

    <meta name="twitter:title" content="Australia Programs | ZIP Travel Philippines">
    <meta name="twitter:description" content="Join our Australia programs and explore Australia's wonders, unlock your potential, and seize opportunities for personal and professional growth.">
@endsection

@section('title', 'Australia Programs | ZIP Travel Philippines')

@section('content')
    <div id="heading" class="heading">
        <video class="heading__video" muted autoplay loop>
            <source src="{{ asset('assets_v3/videos/AUSTRALIA_HEADER.mp4') }}" type="video/mp4">
        </video>
        <div class="heading__content container d-flex d-xxl-flex flex-column justify-content-center align-items-center justify-content-sm-center justify-content-md-end align-items-lg-start h-100">
            <div class="d-flex d-sm-flex d-md-flex d-xxl-flex flex-column justify-content-sm-center align-items-sm-center align-items-md-start justify-content-xxl-start" style="color: #FFFFFF;margin-bottom: 43px;">
                <h1 class="text-center heading__content-title">AUSTRALIAN PROGRAM</h1>
                <p class="text-center text-sm-center text-md-start heading__content-description">
                    There is much more to Australia than the Outback, kangaroos, koalas, and Sydney Opera House. It is the third most popular destination among international students for its breathtaking scenery, friendly citizens, and high quality of education. The country also ranked the 22nd Most Peaceful Countries in the 2023 Global Peace Index. 
                </p>
            </div>
        </div>
    </div>
    <!-- Start: about-us -->
    <section style="padding: 75px 0;" class="px-2 px-md-0">
        <div class="container">
            <div style="font-size: 18px;font-family: 'Inter';color: #2A2A2A;">
                <p style="margin-bottom: 25px;">
                    For students, Australia is well known for being home to some of the best academic institutions in the world. Additionally, the country has made quite a name for itself in food and cuisine and has become a popular choice among international students and trainees. Australia is also known for its love for outdoor activities and sports.
                    <br>
                    <br>
                    ZIP Travel offers two programs in the Land Down Under:
                </p>
            </div>
            <div class="row gap-3 gap-md-0" style="margin-top: 60px;">
                <div class="col-12 col-md-6">
                    <div data-bs-toggle="modal" data-bs-target="#studyWorkModal" style="cursor: pointer; width: 100%;height: 434px;border-radius: 40px;box-shadow: 0px 6px 18px rgb(141,153,164);">
                        <img style="border-radius: 40px 40px 0 0; height: 352px;width: 100%;object-fit: cover;" src="assets_v3/img/Rectangle%2011%20(5).png">
                        <div class="d-flex justify-content-center align-items-center" style="height: 82px;width: 100%;">
                            <p style="font-family: 'Outfit';font-weight: bold;font-size: 20px; color: var(--section-title-text-color);">Study and Work</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div data-bs-toggle="modal" data-bs-target="#hospitalityTraineeModal" style="cursor: pointer; width: 100%;height: 434px;border-radius: 40px;box-shadow: 0px 6px 18px rgb(141,153,164);">
                        <img style="border-radius: 40px 40px 0 0; height: 352px;width: 100%;object-fit: cover;" src="assets_v3/img/Rectangle%2020.png">
                        <div class="d-flex justify-content-center align-items-center" style="height: 82px;width: 100%;">
                            <p style="font-family: 'Outfit';font-weight: bold;font-size: 20px;color: var(--section-title-text-color);">Hospitality Trainee</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End: about-us -->
    <!-- Start: application-guide -->
    <section class="d-xl-flex justify-content-xl-center align-items-xl-center app-guide-section">
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
                        <p class="app-guide-sequence-item__description">Submission of Document</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 order-1 order-md-0">
                    <div class="d-flex flex-row align-items-center align-items-xl-center app-guide-sequence-item">
                        <div class="d-flex justify-content-center align-items-center app-guide-sequence-item__step">
                            <span>02</span>
                        </div>
                        <p class="app-guide-sequence-item__description">Admission and Enrollment (for Study and Work)</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 order-4 order-md-0">
                    <div class="d-flex flex-row align-items-center align-items-xl-center app-guide-sequence-item">
                        <div class="d-flex justify-content-center align-items-center app-guide-sequence-item__step">
                            <span>05</span>
                        </div>
                        <p class="app-guide-sequence-item__description">Visa Processing and Lodging</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 order-2 order-md-0">
                    <div class="d-flex flex-row align-items-center align-items-xl-center app-guide-sequence-item">
                        <div class="d-flex justify-content-center align-items-center app-guide-sequence-item__step">
                            <span>03</span>
                        </div>
                        <p class="app-guide-sequence-item__description">Matching and Hiring (for Culinary Trainee)</p>
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
    </section><!-- End: application-guide -->
    <!-- Start: apply-now -->
    <section class="d-flex align-items-center apply-now-section">
        <div class="container text-start d-xl-flex flex-column align-items-start">
            <p class="apply-now-section__description">ZIP Travel is here to help you make the most of your international journey. We are dedicated to delivering the highest quality international opportunities and committed to providing exceptional support and guidance to participants throughout the program.</p>
            <a href="https://ziptravel.com.ph/online-registration" target="_blank" class="btn btn-primary apply-now-section__action" role="button">APPLY NOW!</a>
        </div>
    </section>
    <!-- End: apply-now -->

    <!-- Modal -->
    <div class="modal fade" id="studyWorkModal" tabindex="-1" aria-labelledby="studyWorkModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 2rem;">
                    <div>
                        <h3 style="font-family:'Outfit'; font-size: 20px;">STUDY AND WORK</h3>
                        <span style="font-family:'Inter'; font-size: 18px;">1 to 4 years (depending on the course and level of study)</span>
                        <p style="font-family: 'Inter'; font-size: 18px; margin-top: 1rem;">
                            Designed for international students who wish to pursue their education while gaining valuable work experience in Australia. The program is under the Subclass 500 Visa type, allowing a participant to stay up to 5 years as a full-time student.
                        </p>
                        <ul style="font-size: 18px; font-family: 'Inter'; margin-top: 0.8rem;">
                            <li>Open to K-12 graduates, college graduates, and professionals</li>
                            <li>Enhance your career prospect</li>
                            <li>Enroll in globally-ranked institutions such as The University of Notre Dame Australia, and Deakin University, among others</li>
                            <li>Work part-time while studying or full-time during official school breaks</li>
                            <li>Opportunity to apply for a Temporary Graduate Visa after graduation</li>
                        </ul>
                    </div>
                    <div>
                        <h3 style="font-family:'Outfit'; font-size: 20px;">ELIGIBILITY</h3>
                        <ul style="font-size: 18px; font-family: 'Inter'; margin-top: 0.8rem;">
                            <li>Must be at least a high school or college graduate</li>
                            <li>Certificates and diplomas take 1 to 2 years, while undergraduate and graduate degrees take 3 to 4 years</li>
                            <li>Sufficiently proficient in the English language, able to interact in an English-speaking environment</li>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="hospitalityTraineeModal" tabindex="-1" aria-labelledby="hospitality-trainee" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 2rem;">
                    <div>
                        <h3 style="font-family:'Outfit'; font-size: 20px;">HOSPITALITY TRAINEE</h3>
                        <span style="font-family:'Inter'; font-size: 18px;">12 to 18 months</span>
                        <p style="font-family: 'Inter'; font-size: 18px; margin-top: 1rem;">
                            Intended for candidates aspiring to work their way up the ranks and are committed to advancing their careers. They must at least demonstrate passion, dedication, and previous work experience.
                            <br><br>
                            Qualified candidates will be issued the 407 Training Visa, an initiative by the Australian Government and managed by the Department of Home Affairs and the approved sponsor. It is a temporary visa for participants undertaking workplace-based training to improve their skills.
                        </p>
                        <ul style="font-size: 18px; font-family: 'Inter'; margin-top: 0.8rem;">
                            <li>Hone your skills under the tutelage of some of the top cooks and chefs</li>
                            <li>Gain exposure to international culinary practices and Australian regional cuisine</li>
                            <li>Gateway to culinary culture and customs followed by world-renowned chefs</li>
                            <li>Make meaningful relationships with contacts</li>
                            <li>Earn a stipend to support your stay in the country</li>
                            <li>Work in cities and regional locations across Australia</li>
                            <li>With the possibility to extend stay for up to 2 years</li>
                        </ul>
                    </div>
                    <div>
                        <h3 style="font-family:'Outfit'; font-size: 20px;">ELIGIBILITY</h3>
                        <ul style="font-size: 18px; font-family: 'Inter'; margin-top: 0.8rem;">
                            <li>18 to 28 years old</li>
                            <li>A graduate of hospitality or culinary course for not more than 18 months</li>
                            <li>Must have a minimum of 12 months of ongoing work experience in a 4-star and above hotel/restaurant</li>
                            <li>Must be an effective communicator in an English-speaking environment</li>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
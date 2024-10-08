@extends('new.layouts.app')

@section('meta')
    <meta name="title" content="ZIP Travel Philippines | Home">
    <meta name="description" content="We offer J1 Visa BridgeUSA Programs for students and new graduates to gain work and cultural experience in the United States of America.">

    <meta property="og:title" content="ZIP Travel Philippines | Home" />
    <meta property="og:description" content="We offer J1 Visa BridgeUSA Programs for students and new graduates to gain work and cultural experience in the United States of America.">
    <meta property="og:type" content="article" />
    <meta property="og:url" content="https://ziptravel.com.ph/" />

    <meta name="twitter:title" content="ZIP Travel Philippines | Home">
    <meta name="twitter:description" content="We offer J1 Visa BridgeUSA Programs for students and new graduates to gain work and cultural experience in the United States of America.">
@endsection

@section('title', 'ZIP Travel Philippines | Home')

@section('content')
    <div id="heading" class="heading">
        <video style="position: absolute;z-index: 0;min-height: 100%;min-width: 100%;object-fit: fill;overflow: hidden;" muted autoplay loop>
            <source src="{{ asset('assets_v3/videos/HOMEPAGE_HEADERv2.mp4') }}" type="video/mp4">
        </video>
        <div class="container d-flex d-xxl-flex flex-column justify-content-center align-items-center justify-content-sm-center justify-content-md-end align-items-lg-start h-100" style="position: relative; z-index: 2;">
            <div class="d-flex d-sm-flex d-md-flex d-xxl-flex flex-column align-items-center justify-content-sm-center align-items-sm-center align-items-md-start justify-content-xxl-start" style="color: #FFFFFF;margin-bottom: 43px;">
                <h1 class="text-center" style="color: #FFC452; margin-bottom: 17px;font-family: 'Outfit';font-weight: 900;">INTERNATIONAL EXCHANGE PROGRAMS</h1>
                <p class="text-center text-sm-center text-md-start" style="margin-bottom: 25px;font-family: 'Inter';font-size: 18px;">Zip Travel Philippines believes that every Filipino deserves the opportunity to become a global leader. That's why we offer intercultural educational and cultural exchange programs that will equip you with the skills and knowledge you need to compete on a global scale.</p>
                <a class="hero-button" href="https://ziptravel.com.ph/online-registration" target="_blank">CLICK HERE TO START YOUR JOURNEY!</a>
            </div>
        </div>
    </div>
    <section id="company-background" style="background-color: #F1F1F1;">
        <!-- Start: 1 Row 2 Columns -->
        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-flex flex-column justify-content-center" style="font-family: 'Outfit';font-size: 18px;">
                    <p style="margin-bottom: 25px;" class="text-start"><strong style="color: #0C3E87;">ZIP Travel Philippines</strong> provides intercultural opportunities for Filipinos to become globally competitive and future leaders of society through international programs.</p>
                    <p style="margin-bottom: 25px;" class="text-start">ZIP Travel is a career and education counseling organization helping students and fresh graduates participate in cultural exchanges in the United States, Australia, Canada, Spain, and Asia. Since our founding 30 years ago, ZIP Travel has helped thousands of students worldwide partake in study-and-work programs, internships, and training in some of the acclaimed hotels and restaurants.</p>
                    <div class="d-flex justify-content-center justify-content-md-start">
                        <a href="/about-us" class="btn" type="button" style="border-color: none; color: #FFFFFF;background: #0C1C33;border-radius: 40px;width: 165px;height: 49px;font-size: 20px;font-family: 'Louis George Cafe';font-weight: bold; padding: 9px;">READ MORE</a>
                    </div>
                </div>
                <div class="d-none d-sm-flex col-lg-6 align-items-center justify-content-center py-5" style="display: flex;padding-right: 0px;">
                    <img src="assets_v3/img/hp_1_crop.jpg" style="width: 100%; height: 369px;filter: blur(0px);object-fit: cover;border-radius: 50px;">
                </div>
            </div>
        </div><!-- End: 1 Row 2 Columns -->
    </section>
    
    <!-- Start: international-programs -->
    <section class="py-5" style="height: 90vh;">
        <div class="container">
            <div class="col">
                <h2 class="text-center text-md-start" style="margin: 0;font-size: 28px;font-family: 'Outfit';font-weight: bolder;color:#0C3E87;">INTERNATIONAL PROGRAMS</h2>
            </div><!-- Start: Simple Slider -->
            <div class="simple-slider d-none d-xl-flex">
                <!-- Start: Slideshow -->
                <div class="swiper-container">
                    <!-- Start: Slide Wrapper -->
                    <div class="swiper-wrapper" style="padding: 35px 0;">
                        <!-- Start: Slide -->
                        <div class="d-flex justify-content-center align-items-center d-xl-flex justify-content-xl-center align-items-xl-center swiper-slide" style="/*background: url(&quot;https://cdn.bootstrapstudio.io/placeholders/1400x800.png&quot;) center center / cover no-repeat;*/">
                            <div class="row" style="height: 100%;">
                                <div class="col">
                                    <a href="/program-bridgeusa" style="text-decoration: none;">
                                        <div class="int-program-card-item">
                                            <img src="assets_v3/img/usa_hp2.png">
                                            <div class="int-program-card-item__content">
                                                <h5 class="text-center">BridgeUSA</h5>
                                                <ul>
                                                    <li>Summer Work Travel</li>
                                                    <li>Internship</li>
                                                    <li>Trainee</li>
                                                    <li>Camp Counselor</li>
                                                    <li>Teachers Program</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col">
                                    <a href="/program-canada" style="text-decoration: none;">
                                        <div class="int-program-card-item">
                                            <img src="assets_v3/img/canada_hp2.png">
                                            <div class="int-program-card-item__content">
                                                <h5 class="text-center">Canada</h5>
                                                <ul>
                                                    <li>Study and Work Program with Pathway to Permanent Residency</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col">
                                    <a href="/program-australia" style="text-decoration: none;">
                                        <div class="int-program-card-item">
                                            <img src="assets_v3/img/aus_hp2.png">
                                            <div class="int-program-card-item__content">
                                                <h5 class="text-center">Australia</h5>
                                                <ul>
                                                    <li>Study and Work</li>
                                                    <li>Hospitality Trainee</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div><!-- End: Slide -->
                        <!-- Start: Slide -->
                        <div class="d-xl-flex justify-content-xl-center align-items-xl-center swiper-slide" style="/*background: url(&quot;https://cdn.bootstrapstudio.io/placeholders/1400x800.png&quot;) center center / cover no-repeat;*/">
                            <div class="row" style="height: 100%;">
                                <div class="col">
                                    <a href="/program-asia" style="text-decoration: none;">
                                        <div class="int-program-card-item">
                                            <img src="assets_v3/img/asia_hp2.png">
                                            <div class="int-program-card-item__content">
                                                <h5>Asia</h5>
                                                <ul>
                                                    <li>Work and Travel Asia</li>
                                                    <li>Hospitality and Business Internship</li>
                                                    <li>Management Training Program</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col">
                                    <a href="/program-spain" style="text-decoration: none;">
                                        <div class="int-program-card-item">
                                            <img src="assets_v3/img/spain_hp2.png">
                                            <div class="int-program-card-item__content">
                                                <h5 class="text-center">Spain</h5>
                                                <ul>
                                                    <li>Hospitality and Culinary Internship</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col">
                                    <a href="/program-bridgeusa" style="text-decoration: none;">
                                        <div class="int-program-card-item">
                                            <img src="assets_v3/img/usa_hp2.png">
                                            <div class="int-program-card-item__content">
                                                <h5 class="text-center">BridgeUSA</h5>
                                                <ul>
                                                    <li>Summer Work Travel</li>
                                                    <li>Internship</li>
                                                    <li>Trainee</li>
                                                    <li>Camp Counselor</li>
                                                    <li>Teachers Program</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div><!-- End: Slide -->
                    </div><!-- End: Slide Wrapper -->

                    <!-- Start: Swiper pagination -->
                    <div class="swiper-pagination"></div>
                    <!-- End: Swiper pagination -->
                     
                    <!-- Start: Previous -->
                    <div class="swiper-button-prev" style="background: url(&quot;assets_v3/img/arrow-right%202.png&quot;);width: 65px;height: 65px;"></div><!-- End: Previous -->
                    <!-- Start: Next -->
                    <div class="swiper-button-next" style="background: url(&quot;assets_v3/img/arrow-right%201.png&quot;);height: 65px;width: 65px;"></div><!-- End: Next -->
                </div><!-- End: Slideshow -->
            </div><!-- End: Simple Slider -->
            <div class="simple-slider d-flex d-xl-none">
                <!-- Start: Slideshow -->
                <div class="swiper-container">
                    <!-- Start: Slide Wrapper -->
                    <div class="swiper-wrapper" style="padding: 35px 0;">
                        <!-- Start: Slide -->
                        <div class="d-flex justify-content-center align-items-center d-xl-flex justify-content-xl-center align-items-xl-center swiper-slide" style="/*background: url(&quot;https://cdn.bootstrapstudio.io/placeholders/1400x800.png&quot;) center center / cover no-repeat;*/">
                            <div class="row" style="height: 100%;">
                                <div class="col">
                                    <a href="/program-bridgeusa" style="text-decoration: none;">
                                        <div class="int-program-card-item">
                                            <img src="assets_v3/img/usa_hp2.png">
                                            <div class="int-program-card-item__content">
                                                <h5 class="text-center">BridgeUSA</h5>
                                                <ul>
                                                    <li>Summer Work Travel</li>
                                                    <li>Internship</li>
                                                    <li>Trainee</li>
                                                    <li>Camp Counselor</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center align-items-center d-xl-flex justify-content-xl-center align-items-xl-center swiper-slide" style="/*background: url(&quot;https://cdn.bootstrapstudio.io/placeholders/1400x800.png&quot;) center center / cover no-repeat;*/">
                            <div class="row" style="height: 100%;">
                                <div class="col">
                                    <a href="/program-canada" style="text-decoration: none;">
                                        <div class="int-program-card-item">
                                            <img src="assets_v3/img/canada_hp2.png">
                                            <div class="int-program-card-item__content">
                                                <h5 class="text-center">Canada</h5>
                                                <ul>
                                                    <li>Study and Work Program with Pathway to Permanent Residency</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center align-items-center d-xl-flex justify-content-xl-center align-items-xl-center swiper-slide" style="/*background: url(&quot;https://cdn.bootstrapstudio.io/placeholders/1400x800.png&quot;) center center / cover no-repeat;*/">
                            <div class="row" style="height: 100%;">
                                <div class="col">
                                    <a href="/program-australia" style="text-decoration: none;">
                                        <div class="int-program-card-item">
                                            <img src="assets_v3/img/aus_hp2.png">
                                            <div class="int-program-card-item__content">
                                                <h5 class="text-center">Australia</h5>
                                                <ul>
                                                    <li>Study and Work</li>
                                                    <li>Hospitality Trainee</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-center d-xl-flex justify-content-xl-center align-items-xl-center swiper-slide" style="/*background: url(&quot;https://cdn.bootstrapstudio.io/placeholders/1400x800.png&quot;) center center / cover no-repeat;*/">
                            <div class="row" style="height: 100%;">
                                <div class="col">
                                    <a href="/program-asia" style="text-decoration: none;">
                                        <div class="int-program-card-item">
                                            <img src="assets_v3/img/asia_hp2.png">
                                            <div class="int-program-card-item__content">
                                                <h5>Asia</h5>
                                                <ul>
                                                    <li>Work and Travel Asia</li>
                                                    <li>Hospitality and Business Internship</li>
                                                    <li>Management Training Program</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-center d-xl-flex justify-content-xl-center align-items-xl-center swiper-slide" style="/*background: url(&quot;https://cdn.bootstrapstudio.io/placeholders/1400x800.png&quot;) center center / cover no-repeat;*/">
                            <div class="row" style="height: 100%;">
                                <div class="col">
                                        <a href="/program-spain" style="text-decoration: none;">
                                            <div class="int-program-card-item">
                                                <img src="assets_v3/img/spain_hp2.png">
                                                <div class="int-program-card-item__content">
                                                    <h5 class="text-center">Spain</h5>
                                                    <ul>
                                                        <li>Hospitality and Culinary Internship</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                            </div>
                        </div><!-- End: Slide -->
                    </div><!-- End: Slide Wrapper -->

                    <!-- Start: Swiper pagination -->
                    <div class="swiper-pagination"></div>
                    <!-- End: Swiper pagination -->

                    <!-- Start: Previous -->
                    <div class="swiper-button-prev" style="background: url(&quot;assets_v3/img/arrow-right%202.png&quot;);width: 65px;height: 65px;"></div><!-- End: Previous -->
                    <!-- Start: Next -->
                    <div class="swiper-button-next" style="background: url(&quot;assets_v3/img/arrow-right%201.png&quot;);height: 65px;width: 65px;"></div><!-- End: Next -->
                </div><!-- End: Slideshow -->
            </div><!-- End: Simple Slider -->
        </div>
    </section>
    <!-- End: international-programs -->
    <section id="advantage" class="py-5" style="height: 100%; background-color: #F1F1F1;">
        <!-- Start: 2 Rows 1+2 Columns -->
        <div class="container p-5 p-md-0 ps-xl-0">
            <div class="row">
                <div class="col">
                    <h2 class="text-center text-md-start" style="color: #0C3E87; margin: 0;font-size: 28px;font-family: 'Outfit';font-weight: bolder;">OUR COMPETITIVE ADVANTAGE</h2>
                </div>
            </div>
            <div class="row advantages ms-xl-0 ps-xl-5 me-xl-0 pe-xl-5" style="margin-top: 29px;font-family: 'Outfit';font-size: 18px;">
                <div class="col-md-6 d-flex align-items-center gap-4 py-3" style="display: flex;"><img class="d-flex align-items-xxl-center" src="assets_v3/img/extensive_experience.png">
                    <p class="d-flex align-items-xxl-center">Three decades of extensive experience</p>
                </div>
                <div class="col-md-6 d-flex align-items-center gap-4 py-3" style="display: flex;"><img class="d-flex align-items-xxl-center" src="assets_v3/img/professional.png" width="56" height="56">
                    <p class="d-flex align-items-xxl-center">Professionalism, financial stability, and compliance</p>
                </div>
                <div class="col-md-6 d-flex align-items-center gap-4 py-3"><img class="d-flex align-items-xxl-center" src="assets_v3/img/culture.png">
                    <p class="d-flex align-items-xxl-center">Diverse and wide range of program offerings</p>
                </div>
                <div class="col-md-6 d-flex align-items-center gap-4 py-3" style="display: flex;"><img class="d-flex align-items-xxl-center" src="assets_v3/img/rate.png">
                    <p class="d-flex align-items-xxl-center">Strong customer testimonials and satisfaction</p>
                </div>
                <div class="col-md-6 d-flex align-items-center gap-4 py-3" style="display: flex;"><img class="d-flex align-content-center align-items-xxl-center" src="assets_v3/img/international_relations.png">
                    <p class="d-flex align-content-center align-items-xxl-center">International memberships and affiliations</p>
                </div>
                <div class="col-md-6 d-flex align-items-center gap-4 py-3" style="display: flex;"><img class="d-flex align-items-center" src="assets_v3/img/high.png">
                    <p class="d-flex align-items-center">High visa approval rate</p>
                </div>
                <div class="col-md-6 d-flex align-items-center gap-4 py-3" style="display: flex;"><img class="d-flex align-items-center" src="assets_v3/img/salary.png" width="56" height="56">
                    <p class="d-flex align-items-center">Competitive &amp; transparent fee structure</p>
                </div>
                <div class="col-md-6 d-flex align-items-center gap-4 py-3" style="display: flex;"><img class="d-flex align-items-center" src="assets_v3/img/shield.png">
                    <p class="d-flex align-items-center">Robust safety and security measures for participants</p>
                </div>
                <div class="col-md-6 d-flex align-items-center gap-4 py-3" style="display: flex;"><img class="d-flex align-items-center" src="assets_v3/img/rating.png">
                    <p class="d-flex align-items-center">Customer-Centric Approach</p>
                </div>
                <div class="col-md-6 d-flex align-items-center gap-4 py-3" style="display: flex;"><img src="assets_v3/img/assessment.png">
                    <p>Continuous program evaluation and improvement</p>
                </div>
            </div>
        </div><!-- End: 2 Rows 1+2 Columns -->
    </section>
    <!-- Start: Partners -->
    <section class="partners-section">
        <div class="container">
        <div class="simple-slider d-none d-md-none d-xl-flex">
                <!-- Start: Slideshow -->
                <div class="swiper-container carousel slide" data-bs-ride="carousel">
                    <!-- Start: Slide Wrapper -->
                    <div class="swiper-wrapper carousel-inner">
                        <!-- Start: Slide -->
                        <div class="carousel-item active">
                            <div class="d-flex justify-content-center align-items-center d-xl-flex justify-content-xl-center align-items-xl-center swiper-slide" style="/*background: url(&quot;https://cdn.bootstrapstudio.io/placeholders/1400x800.png&quot;) center center / cover no-repeat;*/">
                                <div class="row d-sm-flex align-items-center" style="gap: 3rem;">
                                    <div class="col-12 col-md text-center d-xxl-flex justify-content-xxl-center align-items-xxl-center"><img src="assets_v3/img/MHRLogoColor_PNG_MEDIUM%201.png" style="width: 150px;"></div>
                                    <div class="col-12 col-md text-center d-xxl-flex justify-content-xxl-center align-items-xxl-center"><img src="assets_v3/img/RitzCarlton%201.png" style="width: 150px;"></div>
                                    <div class="col-12 col-md text-center d-xxl-flex justify-content-xxl-center align-items-xxl-center"><img src="assets_v3/img/Fairmont_Logo%201.png" style="width: 150px;"></div>
                                    <div class="col-12 col-md text-center d-xxl-flex justify-content-xxl-center align-items-xxl-center"><img src="assets_v3/img/JW_Marriott_Hotel__and__Resorts%201.png" style="width: 150px;"></div>
                                </div>
                            </div>
                        </div>
                        <!-- End: Slide -->
                        <!-- Start: Slide -->
                        <div class="carousel-item">
                            <div class="d-flex justify-content-center align-items-center d-xl-flex justify-content-xl-center align-items-xl-center swiper-slide" style="/*background: url(&quot;https://cdn.bootstrapstudio.io/placeholders/1400x800.png&quot;) center center / cover no-repeat;*/">
                                <div class="row d-sm-flex align-items-center" style="gap: 3rem;">
                                    <div class="col-12 col-md text-center d-xxl-flex justify-content-xxl-center align-items-xxl-center"><img src="assets_v3/img/Four_Seasons_Hotels_and_Resorts%201.png" style="width: 150px;"></div>
                                    <div class="col-12 col-md text-center d-xxl-flex justify-content-xxl-center align-items-xxl-center"><img src="assets_v3/img/LOGO_SHERATON.png" style="width: 150px;"></div>
                                    <div class="col-12 col-md text-center d-xxl-flex justify-content-xxl-center align-items-xxl-center"><img src="assets_v3/img/LOGO_GAYLORD.png" style="width: 150px;"></div>
                                    <div class="col-12 col-md text-center d-xxl-flex justify-content-xxl-center align-items-xxl-center"><img src="assets_v3/img/LOGO_HILTON.png" style="width: 150px;"></div>
                                </div>
                            </div>
                        </div>
                        <!-- End: Slide -->
                        <div class="carousel-item">
                            <div class="d-flex justify-content-center align-items-center d-xl-flex justify-content-xl-center align-items-xl-center swiper-slide" style="/*background: url(&quot;https://cdn.bootstrapstudio.io/placeholders/1400x800.png&quot;) center center / cover no-repeat;*/">
                                <div class="row d-sm-flex align-items-center" style="gap: 3rem;">
                                    <div class="col-12 col-md text-center d-xxl-flex justify-content-xxl-center align-items-xxl-center"><img src="assets_v3/img/LOGO_HYATT.png" style="width: 150px;"></div>
                                    <div class="col-12 col-md text-center d-xxl-flex justify-content-xxl-center align-items-xxl-center"><img src="assets_v3/img/LOGO_OMNI.png" style="width: 150px;"></div>
                                    <div class="col-12 col-md text-center d-xxl-flex justify-content-xxl-center align-items-xxl-center"><img src="assets_v3/img/LOGO_PEABODY.png" style="width: 150px;"></div>
                                    <div class="col-12 col-md text-center d-xxl-flex justify-content-xxl-center align-items-xxl-center"><img src="assets_v3/img/LOGO_WESTIN.png" style="width: 150px;"></div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End: Slide Wrapper -->
                </div><!-- End: Slideshow -->
            </div>
            <div class="simple-slider d-none d-md-flex d-xl-none">
                <!-- Start: Slideshow -->
                <div class="swiper-container carousel slide" data-bs-ride="carousel">
                    <!-- Start: Slide Wrapper -->
                    <div class="swiper-wrapper carousel-inner">
                        <!-- Start: Slide -->
                        <div class="carousel-item active">
                            <div class="d-flex justify-content-center align-items-center d-xl-flex justify-content-xl-center align-items-xl-center swiper-slide" style="/*background: url(&quot;https://cdn.bootstrapstudio.io/placeholders/1400x800.png&quot;) center center / cover no-repeat;*/">
                                <div class="row d-sm-flex align-items-center" style="gap: 2rem;">
                                    <div class="col-12 col-md text-center d-xxl-flex justify-content-xxl-center align-items-xxl-center"><img src="assets_v3/img/MHRLogoColor_PNG_MEDIUM%201.png" style="width: 150px;"></div>
                                    <div class="col-12 col-md text-center d-xxl-flex justify-content-xxl-center align-items-xxl-center"><img src="assets_v3/img/RitzCarlton%201.png" style="width: 150px;"></div>
                                    <div class="col-12 col-md text-center d-xxl-flex justify-content-xxl-center align-items-xxl-center"><img src="assets_v3/img/Fairmont_Logo%201.png" style="width: 150px;"></div>
                                </div>
                            </div>
                        </div>
                        <!-- End: Slide -->
                        <!-- Start: Slide -->
                        <div class="carousel-item">
                            <div class="d-flex justify-content-center align-items-center d-xl-flex justify-content-xl-center align-items-xl-center swiper-slide" style="/*background: url(&quot;https://cdn.bootstrapstudio.io/placeholders/1400x800.png&quot;) center center / cover no-repeat;*/">
                                <div class="row d-sm-flex align-items-center" style="gap: 2rem;">
                                    <div class="col-12 col-md text-center d-xxl-flex justify-content-xxl-center align-items-xxl-center"><img src="assets_v3/img/JW_Marriott_Hotel__and__Resorts%201.png" style="width: 150px;"></div>
                                    <div class="col-12 col-md text-center d-xxl-flex justify-content-xxl-center align-items-xxl-center"><img src="assets_v3/img/Four_Seasons_Hotels_and_Resorts%201.png" style="width: 150px;"></div>
                                    <div class="col-12 col-md text-center d-xxl-flex justify-content-xxl-center align-items-xxl-center"><img src="assets_v3/img/LOGO_SHERATON.png" style="width: 150px;"></div>
                                </div>
                            </div>
                        </div>
                        <!-- End: Slide -->
                        <div class="carousel-item">
                            <div class="d-flex justify-content-center align-items-center d-xl-flex justify-content-xl-center align-items-xl-center swiper-slide" style="/*background: url(&quot;https://cdn.bootstrapstudio.io/placeholders/1400x800.png&quot;) center center / cover no-repeat;*/">
                                <div class="row d-sm-flex align-items-center" style="gap: 2rem;">
                                    <div class="col-12 col-md text-center d-xxl-flex justify-content-xxl-center align-items-xxl-center"><img src="assets_v3/img/LOGO_GAYLORD.png" style="width: 150px;"></div>
                                    <div class="col-12 col-md text-center d-xxl-flex justify-content-xxl-center align-items-xxl-center"><img src="assets_v3/img/LOGO_HILTON.png" style="width: 150px;"></div>
                                    <div class="col-12 col-md text-center d-xxl-flex justify-content-xxl-center align-items-xxl-center"><img src="assets_v3/img/LOGO_HYATT.png" style="width: 150px;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="d-flex justify-content-center align-items-center d-xl-flex justify-content-xl-center align-items-xl-center swiper-slide" style="/*background: url(&quot;https://cdn.bootstrapstudio.io/placeholders/1400x800.png&quot;) center center / cover no-repeat;*/">
                                <div class="row d-sm-flex align-items-center" style="gap: 2rem;">
                                    <div class="col-12 col-md text-center d-xxl-flex justify-content-xxl-center align-items-xxl-center"><img src="assets_v3/img/LOGO_OMNI.png" style="width: 150px;"></div>
                                    <div class="col-12 col-md text-center d-xxl-flex justify-content-xxl-center align-items-xxl-center"><img src="assets_v3/img/LOGO_PEABODY.png" style="width: 150px;"></div>
                                    <div class="col-12 col-md text-center d-xxl-flex justify-content-xxl-center align-items-xxl-center"><img src="assets_v3/img/LOGO_WESTIN.png" style="width: 150px;"></div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End: Slide Wrapper -->
                </div><!-- End: Slideshow -->
            </div><!-- End: Simple Slider -->
            <div class="simple-slider d-flex d-md-none p-5 p-md-0">
                <!-- Start: Slideshow -->
                <div class="swiper-container carousel slide" data-bs-ride="carousel">
                    <!-- Start: Slide Wrapper -->
                    <div class="swiper-wrapper carousel-inner">
                        <div class="carousel-item active">
                            <div class="d-xl-flex justify-content-xl-center align-items-xl-center swiper-slide" style="/*background: url(&quot;https://cdn.bootstrapstudio.io/placeholders/1400x800.png&quot;) center center / cover no-repeat;*/">
                                <div class="row d-sm-flex align-items-center">
                                    <div class="col-12 col-md text-center d-xxl-flex justify-content-xxl-center align-items-xxl-center"><img src="assets_v3/img/MHRLogoColor_PNG_MEDIUM%201.png" style="width: 150px;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="d-xl-flex justify-content-xl-center align-items-xl-center swiper-slide" style="/*background: url(&quot;https://cdn.bootstrapstudio.io/placeholders/1400x800.png&quot;) center center / cover no-repeat;*/">
                                <div class="row d-sm-flex align-items-center">
                                    <div class="col-12 col-md text-center d-xxl-flex justify-content-xxl-center align-items-xxl-center"><img src="assets_v3/img/RitzCarlton%201.png" style="width: 150px;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="d-xl-flex justify-content-xl-center align-items-xl-center swiper-slide" style="/*background: url(&quot;https://cdn.bootstrapstudio.io/placeholders/1400x800.png&quot;) center center / cover no-repeat;*/">
                                <div class="row d-sm-flex align-items-center">
                                    <div class="col-12 col-md text-center d-xxl-flex justify-content-xxl-center align-items-xxl-center"><img src="assets_v3/img/Fairmont_Logo%201.png" style="width: 150px;"></div> 
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="d-xl-flex justify-content-xl-center align-items-xl-center swiper-slide" style="/*background: url(&quot;https://cdn.bootstrapstudio.io/placeholders/1400x800.png&quot;) center center / cover no-repeat;*/">
                                <div class="row d-sm-flex align-items-center">
                                    <div class="col-12 col-md text-center d-xxl-flex justify-content-xxl-center align-items-xxl-center"><img src="assets_v3/img/JW_Marriott_Hotel__and__Resorts%201.png" style="width: 150px;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="d-xl-flex justify-content-xl-center align-items-xl-center swiper-slide" style="/*background: url(&quot;https://cdn.bootstrapstudio.io/placeholders/1400x800.png&quot;) center center / cover no-repeat;*/">
                                <div class="row d-sm-flex align-items-center">
                                    <div class="col-12 col-md text-center d-xxl-flex justify-content-xxl-center align-items-xxl-center"><img src="assets_v3/img/Four_Seasons_Hotels_and_Resorts%201.png" style="width: 150px;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="d-xl-flex justify-content-xl-center align-items-xl-center swiper-slide" style="/*background: url(&quot;https://cdn.bootstrapstudio.io/placeholders/1400x800.png&quot;) center center / cover no-repeat;*/">
                                <div class="row d-sm-flex align-items-center">
                                    <div class="col-12 col-md text-center d-xxl-flex justify-content-xxl-center align-items-xxl-center"><img src="assets_v3/img/LOGO_SHERATON.png" style="width: 150px;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="d-xl-flex justify-content-xl-center align-items-xl-center swiper-slide" style="/*background: url(&quot;https://cdn.bootstrapstudio.io/placeholders/1400x800.png&quot;) center center / cover no-repeat;*/">
                                <div class="col-12 col-md text-center d-xxl-flex justify-content-xxl-center align-items-xxl-center"><img src="assets_v3/img/LOGO_GAYLORD.png" style="width: 150px;"></div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="d-xl-flex justify-content-xl-center align-items-xl-center swiper-slide" style="/*background: url(&quot;https://cdn.bootstrapstudio.io/placeholders/1400x800.png&quot;) center center / cover no-repeat;*/">
                                <div class="row d-sm-flex align-items-center">
                                    <div class="col-12 col-md text-center d-xxl-flex justify-content-xxl-center align-items-xxl-center"><img src="assets_v3/img/LOGO_HILTON.png" style="width: 150px;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="d-xl-flex justify-content-xl-center align-items-xl-center swiper-slide" style="/*background: url(&quot;https://cdn.bootstrapstudio.io/placeholders/1400x800.png&quot;) center center / cover no-repeat;*/">
                                <div class="row d-sm-flex align-items-center">
                                    <div class="col-12 col-md text-center d-xxl-flex justify-content-xxl-center align-items-xxl-center"><img src="assets_v3/img/LOGO_HYATT.png" style="width: 150px;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="d-xl-flex justify-content-xl-center align-items-xl-center swiper-slide" style="/*background: url(&quot;https://cdn.bootstrapstudio.io/placeholders/1400x800.png&quot;) center center / cover no-repeat;*/">
                                <div class="row d-sm-flex align-items-center">
                                    <div class="col-12 col-md text-center d-xxl-flex justify-content-xxl-center align-items-xxl-center"><img src="assets_v3/img/LOGO_OMNI.png" style="width: 150px;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="d-xl-flex justify-content-xl-center align-items-xl-center swiper-slide" style="/*background: url(&quot;https://cdn.bootstrapstudio.io/placeholders/1400x800.png&quot;) center center / cover no-repeat;*/">
                                <div class="row d-sm-flex align-items-center">
                                    <div class="col-12 col-md text-center d-xxl-flex justify-content-xxl-center align-items-xxl-center"><img src="assets_v3/img/LOGO_PEABODY.png" style="width: 150px;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="d-xl-flex justify-content-xl-center align-items-xl-center swiper-slide" style="/*background: url(&quot;https://cdn.bootstrapstudio.io/placeholders/1400x800.png&quot;) center center / cover no-repeat;*/">
                                <div class="row d-sm-flex align-items-center">
                                    <div class="col-12 col-md text-center d-xxl-flex justify-content-xxl-center align-items-xxl-center"><img src="assets_v3/img/LOGO_WESTIN.png" style="width: 150px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End: Partners -->
    <!-- Start: Testimonials -->
    <section style="padding: 55px 0;background: url('assets_v3/img/zipbg_black.jpg'); border-bottom: #FFFFFF solid 5px;">
        <div class="container">
            <!-- Start: Simple Slider -->
            <div class="simple-slider">
                <!-- Start: Slideshow -->
                <div class="swiper-container carousel slide" data-bs-ride="carousel">
                    <!-- Start: Slide Wrapper -->
                    <div class="swiper-wrapper carousel-inner" style="font-family: Outfit, sans-serif; color: #FFFFFF;">
                        <!-- Start: Slide -->
                         <div class="carousel-item active">
                            <div class="d-flex d-xxl-flex flex-column justify-content-center align-items-center swiper-slide">
                                <img style="border: solid #FFFFFF 5px; width: 130px;height: 130px;border-radius: 100%;margin-bottom: 35px;" src="assets_v3/img/manganaey_testimonial.png">
                                <h6 style="margin: 0;font-weight: bold;font-size: 20px;color:#FFC452;">Rutherford Kenth Carlos Mangangey</h6>
                                <span style="font-size: 18px;">University of Baguio</span>
                                <p style="margin-top: 35px;text-align: center;font-size: 18px;">
                                If you're planning to take your Internship abroad, Zip Travel is the Agency for you. They are very Approachable and detailed and the Employees are very kind to you and you can ask them and they will answer your questions in a Minute! Thank you Zip travel for helping me to start my culinary journey for this internship program
                                </p>
                            </div>
                            <!-- End: Slide -->
                         </div>
                        <!-- Start: Slide -->
                        <div class="carousel-item">
                            <div class="d-flex d-xxl-flex flex-column justify-content-center align-items-center swiper-slide">
                                <img style="border: solid #FFFFFF 5px;width: 130px;height: 130px;border-radius: 100%;margin-bottom: 35px;" src="assets_v3/img/trazo_testimonial.png">
                                <h6 style="margin: 0;font-weight: bold;font-size: 20px;color:#FFC452;">Paul Christian Trazo</h6><span style="font-size: 18px;">University of Santo Tomas</span>
                                <p style="margin-top: 35px;text-align: center;font-size: 18px;">
                                ZIP Travel Philippines opened its door as they gave me the opportunity to experience the Internship in the USA. I wouldn't have achieved this journey without them. From the start, they gave me assurance and  guidance with this process. They always keep their contacts in line. I appreciate their effort. Thank you, ZIP TRAVEL!
                                </p>
                            </div>
                        </div>
                        <!-- End: Slide -->
                        <div class="carousel-item">
                            <!-- Start: Slide -->
                            <div class="d-flex d-xxl-flex flex-column justify-content-center align-items-center swiper-slide">
                                <img style="border: solid #FFFFFF 5px;width: 130px;height: 130px;border-radius: 100%;margin-bottom: 35px;" src="assets_v3/img/rillaroza_testimonial.png">
                                <h6 style="margin: 0;font-weight: bold;font-size: 20px;color:#FFC452;">Jewel Reign Rilloraza</h6><span style="font-size: 18px;">University of Baguio</span>
                                <p style="margin-top: 35px;text-align: center;font-size: 18px;">
                                ZIP Travel Philippines has a really nice program which is a big leap for students like me to develop our technical and soft skills while performing at par with international standards. With my experience, their staff were very responsive, they were very accommodating, the procedures were organized, and the program itself is really globally competitive. That inspires me to be at my best as an applicant of the program and recommend it to other students under my university
                                </p>
                            </div>
                            <!-- End: Slide -->
                        </div>
                    </div><!-- End: Slide Wrapper -->
                    <!-- Start: Previous -->
                    <div class="d-none swiper-button-prev" style="background: url(&quot;assets_v3/img/arrow-right%202.png&quot;);width: 65px;height: 65px;"></div><!-- End: Previous -->
                    <!-- Start: Next -->
                    <div class="d-none swiper-button-next" style="background: url(&quot;assets_v3/img/arrow-right%201.png&quot;);height: 65px;width: 65px;"></div><!-- End: Next -->
                </div><!-- End: Slideshow -->
            </div><!-- End: Simple Slider -->
        </div>
    </section><!-- End: Testimonials -->
@endsection
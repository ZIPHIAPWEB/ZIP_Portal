<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>zip-website</title>
    <link rel="stylesheet" href="assets_v3/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets_v3/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets_v3/css/styles.min.css">
</head>

<body>
@include('new.partials.navbar')
    <div id="heading" style="background: var(--bs-body-color); height: 885px; width: 100%; overflow: hidden; position: relative;">
        <video style="position: absolute;z-index: 0;min-height: 100%;min-width: 100%;object-fit: fill;overflow: hidden;" muted autoplay loop>
            <source src="{{ asset('assets_v3/videos/HOMEPAGE_HEADER.mp4') }}" type="video/mp4">
        </video>
        <div class="container d-flex d-xxl-flex flex-column justify-content-center align-items-center justify-content-sm-center justify-content-md-end align-items-lg-start h-100" style="position: relative; z-index: 2;">
            <div class="d-flex d-sm-flex d-md-flex d-xxl-flex flex-column justify-content-sm-center align-items-sm-center align-items-md-start justify-content-xxl-start" style="color: #FFFFFF;margin-bottom: 43px;">
                <h1 class="text-center" style="margin-bottom: 17px;font-family: 'Outfit';font-weight: 900;">INTERNATIONAL EXCHANGE PROGRAMS</h1>
                <p class="text-center text-sm-center text-md-start" style="margin-bottom: 25px;font-family: 'Inter';font-size: 18px;">Zip Travel Philippines believes that every Filipino deserves the opportunity to become a global leader. That's why we offer<br>intercultural educational and cultural exchange programs that will equip you with the skills and knowledge you need to<br>compete on a global scale.</p><a href="#" style="text-decoration: none;color: #FFFFFF;border-radius: 40px;border: solid #FFFFFF 1px;padding: 9px 28px;font-size: 20px;text-align: center;background-color: rgba(12, 28, 51, 0.6);width: 339px;height: 52px;font-family: 'Outfit';">YOU JOURNEY STARTS HERE!</a>
            </div>
        </div>
    </div>
    <section id="company-background">
        <!-- Start: 1 Row 2 Columns -->
        <div class="container">
            <div class="row">
                <div class="col-lg-6 align-items-center justify-content-center py-5" style="display: flex;padding-right: 0px;"><img src="assets_v3/img/Rectangle%203.png" style="width: 397px;height: 369px;filter: blur(0px);object-fit: contain;border-radius: 50px;"></div>
                <div class="col-lg-6 d-flex flex-column justify-content-center" style="font-family: 'Outfit';font-size: 18px;">
                    <p style="margin-bottom: 25px;"><strong>ZIP Travel Philippines</strong> provides intercultural opportunities for Filipinos to become globally competitive and future leaders of society through international programs.</p>
                    <p style="margin-bottom: 25px;">ZIP Travel is a career and education counseling organization helping students and fresh graduates participate in cultural exchanges in the United States, Australia, Canada, Spain, and Asia. Since our founding 30 years ago, ZIP Travel has helped thousands of students worldwide partake in study-and-work programs, internships, and training in some of the acclaimed hotels and restaurants.</p>
                    <div><button class="btn btn-primary" type="button" style="color: #FFFFFF;background: #0C1C33;border-radius: 40px;width: 165px;height: 49px;font-size: 20px;font-family: 'Louis George Cafe';font-weight: bold;">READ MORE</button></div>
                </div>
            </div>
        </div><!-- End: 1 Row 2 Columns -->
    </section>
    <section id="advantage" class="py-5" style="background-color: #F1F1F1;">
        <!-- Start: 2 Rows 1+2 Columns -->
        <div class="container ps-xl-0">
            <div class="row">
                <div class="col">
                    <h2 class="text-center text-md-start" style="margin: 0;font-size: 28px;font-family: 'Louis George Cafe';font-weight: bold;">OUR COMPETITIVE ADVANTAGE</h2>
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
                    <p class="d-flex align-items-xxl-center">Three decades of extensive experience</p>
                </div>
                <div class="col-md-6 d-flex align-items-center gap-4 py-3" style="display: flex;"><img class="d-flex align-content-center align-items-xxl-center" src="assets_v3/img/international_relations.png">
                    <p class="d-flex align-content-center align-items-xxl-center">International memberships and affiliations</p>
                </div>
                <div class="col-md-6 d-flex align-items-center gap-4 py-3" style="display: flex;"><img class="d-flex align-items-center" src="assets_v3/img/high.png">
                    <p class="d-flex align-items-center">Three decades of extensive experience</p>
                </div>
                <div class="col-md-6 d-flex align-items-center gap-4 py-3" style="display: flex;"><img class="d-flex align-items-center" src="assets_v3/img/salary.png" width="56" height="56">
                    <p class="d-flex align-items-center">Competitive &amp; transparent fee structure</p>
                </div>
                <div class="col-md-6 d-flex align-items-center gap-4 py-3" style="display: flex;"><img class="d-flex align-items-center" src="assets_v3/img/shield.png">
                    <p class="d-flex align-items-center">Three decades of extensive experience</p>
                </div>
                <div class="col-md-6 d-flex align-items-center gap-4 py-3" style="display: flex;"><img class="d-flex align-items-center" src="assets_v3/img/rating.png">
                    <p class="d-flex align-items-center">Customer-Centric Approach</p>
                </div>
                <div class="col-md-6 d-flex align-items-center gap-4 py-3" style="display: flex;"><img src="assets_v3/img/assessment.png">
                    <p>Three decades of extensive experience</p>
                </div>
            </div>
        </div><!-- End: 2 Rows 1+2 Columns -->
    </section><!-- Start: international-programs -->
    <section class="py-5">
        <div class="container">
            <div class="col">
                <h2 class="text-center text-md-start" style="margin: 0;font-size: 28px;font-family: 'Louis George Cafe';font-weight: bold;">INTERNATIONAL PROGRAMS</h2>
            </div><!-- Start: Simple Slider -->
            <div class="simple-slider">
                <!-- Start: Slideshow -->
                <div class="swiper-container">
                    <!-- Start: Slide Wrapper -->
                    <div class="swiper-wrapper" style="padding: 35px 0;">
                        <!-- Start: Slide -->
                        <div class="d-xl-flex justify-content-xl-center align-items-xl-center swiper-slide" style="/*background: url(&quot;https://cdn.bootstrapstudio.io/placeholders/1400x800.png&quot;) center center / cover no-repeat;*/">
                            <div class="row" style="height: 100%;">
                                <div class="col">
                                    <div style="height: 503px;border-radius: 50px;width: 346px;box-shadow: 6px 17px 15px 3px var(--bs-secondary-color);"><img style="width: 100%;height: 320px;border-top-right-radius: inherit;border-top-left-radius: inherit;" src="assets_v3/img/Rectangle%2011.png">
                                        <div style="height: 183px;width: 100%;display: flex;flex-direction: column;align-items: center;justify-content: start;padding-top: 25px;border-bottom-left-radius: inherit;border-bottom-right-radius: inherit;font-family: 'Outfit';font-size: 18px;">
                                            <h5 class="text-center" style="margin-bottom: 10px;font-weight: bold;">BridgeUSA</h5>
                                            <p class="text-center" style="font-size: 18px;">Summer Work Travel<br>Internship<br>Trainee<br>Camp Counselor</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div style="height: 503px;border-radius: 50px;box-shadow: 6px 17px 15px 3px var(--bs-secondary-color);width: 346px;"><img style="width: 100%;height: 320px;border-top-right-radius: inherit;border-top-left-radius: inherit;" src="assets_v3/img/Rectangle%2013.png">
                                        <div style="height: 183px;width: 100%;display: flex;flex-direction: column;align-items: center;justify-content: start;padding-top: 25px;border-bottom-left-radius: inherit;border-bottom-right-radius: inherit;font-family: 'Outfit';font-size: 18px;">
                                            <h5 class="text-center" style="margin-bottom: 10px;font-weight: bold;">Canada</h5>
                                            <p class="text-center" style="font-size: 18px;">Canadian Program with Pathway to Permanent Residency</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div style="height: 503px;border-radius: 50px;box-shadow: 6px 17px 15px 3px var(--bs-secondary-color);width: 346px;"><img style="width: 100%;height: 320px;border-top-right-radius: inherit;border-top-left-radius: inherit;" src="assets_v3/img/Rectangle%2015.png">
                                        <div style="height: 183px;width: 100%;display: flex;flex-direction: column;align-items: center;justify-content: start;padding-top: 25px;border-bottom-left-radius: inherit;border-bottom-right-radius: inherit;font-family: 'Outfit';font-size: 18px;">
                                            <h5 class="text-center" style="margin-bottom: 10px;font-weight: bold;">Australia</h5>
                                            <p class="text-center" style="font-size: 18px;">Study and Work<br>Hospitality Trainee</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End: Slide -->
                        <!-- Start: Slide -->
                        <div class="d-xl-flex justify-content-xl-center align-items-xl-center swiper-slide" style="/*background: url(&quot;https://cdn.bootstrapstudio.io/placeholders/1400x800.png&quot;) center center / cover no-repeat;*/">
                            <div class="row" style="height: 100%;">
                                <div class="col">
                                    <div style="height: 503px;border-radius: 50px;width: 346px;box-shadow: 6px 17px 15px 3px var(--bs-secondary-color);"><img style="width: 100%;height: 320px;border-top-right-radius: inherit;border-top-left-radius: inherit;" src="assets_v3/img/Rectangle%2011.png">
                                        <div style="height: 183px;width: 100%;display: flex;flex-direction: column;align-items: center;justify-content: start;padding-top: 25px;border-bottom-left-radius: inherit;border-bottom-right-radius: inherit;font-family: 'Outfit';font-size: 18px;">
                                            <h5 class="text-center" style="margin-bottom: 10px;font-weight: bold;">BridgeUSA</h5>
                                            <p class="text-center" style="font-size: 18px;">Summer Work Travel<br>Internship<br>Trainee<br>Camp Counselor</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div style="height: 503px;border-radius: 50px;box-shadow: 6px 17px 15px 3px var(--bs-secondary-color);width: 346px;"><img style="width: 100%;height: 320px;border-top-right-radius: inherit;border-top-left-radius: inherit;" src="assets_v3/img/Rectangle%2013.png">
                                        <div style="height: 183px;width: 100%;display: flex;flex-direction: column;align-items: center;justify-content: start;padding-top: 25px;border-bottom-left-radius: inherit;border-bottom-right-radius: inherit;font-family: 'Outfit';font-size: 18px;">
                                            <h5 class="text-center" style="margin-bottom: 10px;font-weight: bold;">Canada</h5>
                                            <p class="text-center" style="font-size: 18px;">Canadian Program with Pathway to Permanent Residency</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div style="height: 503px;border-radius: 50px;box-shadow: 6px 17px 15px 3px var(--bs-secondary-color);width: 346px;"><img style="width: 100%;height: 320px;border-top-right-radius: inherit;border-top-left-radius: inherit;" src="assets_v3/img/Rectangle%2015.png">
                                        <div style="height: 183px;width: 100%;display: flex;flex-direction: column;align-items: center;justify-content: start;padding-top: 25px;border-bottom-left-radius: inherit;border-bottom-right-radius: inherit;font-family: 'Outfit';font-size: 18px;">
                                            <h5 class="text-center" style="margin-bottom: 10px;font-weight: bold;">Australia</h5>
                                            <p class="text-center" style="font-size: 18px;">Study and Work<br>Hospitality Trainee</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End: Slide -->
                    </div><!-- End: Slide Wrapper -->
                    <!-- Start: Previous -->
                    <div class="swiper-button-prev" style="background: url(&quot;assets_v3/img/arrow-right%202.png&quot;);width: 65px;height: 65px;"></div><!-- End: Previous -->
                    <!-- Start: Next -->
                    <div class="swiper-button-next" style="background: url(&quot;assets_v3/img/arrow-right%201.png&quot;);height: 65px;width: 65px;"></div><!-- End: Next -->
                </div><!-- End: Slideshow -->
            </div><!-- End: Simple Slider -->
        </div>
    </section><!-- End: international-programs -->
    <!-- Start: Partners -->
    <section class="py-5 partners-section">
        <div class="container">
            <div class="row gy-4 d-sm-flex align-items-center">
                <div class="col-12 col-md text-center d-xxl-flex justify-content-xxl-center align-items-xxl-center"><img src="assets_v3/img/MHRLogoColor_PNG_MEDIUM%201.png" style="width: 150px;"></div>
                <div class="col-12 col-md text-center d-xxl-flex justify-content-xxl-center align-items-xxl-center"><img src="assets_v3/img/RitzCarlton%201.png" style="width: 150px;"></div>
                <div class="col-12 col-md text-center d-xxl-flex justify-content-xxl-center align-items-xxl-center"><img src="assets_v3/img/Fairmont_Logo%201.png" style="width: 150px;"></div>
                <div class="col-12 col-md text-center d-xxl-flex justify-content-xxl-center align-items-xxl-center"><img src="assets_v3/img/JW_Marriott_Hotel__and__Resorts%201.png" style="width: 150px;"></div>
                <div class="col-12 col-md text-center d-xxl-flex justify-content-xxl-center align-items-xxl-center"><img src="assets_v3/img/Four_Seasons_Hotels_and_Resorts%201.png" style="width: 150px;"></div>
            </div>
        </div>
    </section><!-- End: Partners -->
    <!-- Start: Testimonials -->
    <section style="padding: 55px 0;">
        <div class="container">
            <!-- Start: Simple Slider -->
            <div class="simple-slider">
                <!-- Start: Slideshow -->
                <div class="swiper-container">
                    <!-- Start: Slide Wrapper -->
                    <div class="swiper-wrapper" style="font-family: Outfit, sans-serif;">
                        <!-- Start: Slide -->
                        <div class="d-flex d-xxl-flex flex-column justify-content-center align-items-center swiper-slide"><img style="width: 130px;height: 130px;border-radius: 100%;margin-bottom: 35px;" src="assets_v3/img/Ellipse%201.png">
                            <h6 style="margin: 0;font-weight: bold;font-size: 20px;">Juan Dela Cruz</h6><span style="font-size: 18px;">University of Santo Tomas</span>
                            <p style="margin-top: 35px;text-align: center;font-size: 18px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sagittis finibus consequat. Quisque lobortis semper lectus non ornare. Nam porta dolor sem, et ultricies justo dictum quis. Fusce sodales bibendum ipsum ac bibendum. Praesent at massa elit. Sed ut posuere nibh, sed sagittis augue. Aliquam congue consequat imperdiet.</p>
                        </div><!-- End: Slide -->
                        <!-- Start: Slide -->
                        <div class="d-flex d-xxl-flex flex-column justify-content-center align-items-center swiper-slide"><img style="width: 130px;height: 130px;border-radius: 100%;margin-bottom: 35px;" src="assets_v3/img/Ellipse%201.png">
                            <h6 style="margin: 0;font-weight: bold;font-size: 20px;">Juan Dela Cruz</h6><span style="font-size: 18px;">University of Santo Tomas</span>
                            <p style="margin-top: 35px;text-align: center;font-size: 18px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sagittis finibus consequat. Quisque lobortis semper lectus non ornare. Nam porta dolor sem, et ultricies justo dictum quis. Fusce sodales bibendum ipsum ac bibendum. Praesent at massa elit. Sed ut posuere nibh, sed sagittis augue. Aliquam congue consequat imperdiet.</p>
                        </div><!-- End: Slide -->
                        <!-- Start: Slide -->
                        <div class="d-flex d-xxl-flex flex-column justify-content-center align-items-center swiper-slide"><img style="width: 130px;height: 130px;border-radius: 100%;margin-bottom: 35px;" src="assets_v3/img/Ellipse%201.png">
                            <h6 style="margin: 0;font-weight: bold;font-size: 20px;">Juan Dela Cruz</h6><span style="font-size: 18px;">University of Santo Tomas</span>
                            <p style="margin-top: 35px;text-align: center;font-size: 18px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sagittis finibus consequat. Quisque lobortis semper lectus non ornare. Nam porta dolor sem, et ultricies justo dictum quis. Fusce sodales bibendum ipsum ac bibendum. Praesent at massa elit. Sed ut posuere nibh, sed sagittis augue. Aliquam congue consequat imperdiet.</p>
                        </div><!-- End: Slide -->
                    </div><!-- End: Slide Wrapper -->
                </div><!-- End: Slideshow -->
            </div><!-- End: Simple Slider -->
        </div>
    </section><!-- End: Testimonials -->
    @include('new.partials.footer')
    <script src="assets_v3/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets_v3/js/script.min.js"></script>
</body>

</html>
@extends('new.layouts.app')

@section('meta')
<meta name="title" content="ZIP Travel Philippines | J1 Cares">
    <meta name="description" content="J1 Cares is a foundation with past participants as a way to share their blessings through charitable works.">

    <meta property="og:title" content="ZIP Travel Philippines | J1 Cares" />
    <meta property="og:description" content="J1 Cares is a foundation with past participants as a way to share their blessings through charitable works.">
    <meta property="og:type" content="article" />
    <meta property="og:url" content="https://ziptravel.com.ph/j1-cares" />

    <meta name="twitter:title" content="ZIP Travel Philippines | J1 Cares">
    <meta name="twitter:description" content="J1 Cares is a foundation with past participants as a way to share their blessings through charitable works.">
@endsection

@section('title', 'ZIP Travel Philippines | J1 Cares')

@section('content')
    <div id="heading" class="heading">
        <video class="heading__video" muted autoplay loop>
            <source src="{{ asset('assets_v3/videos/J1 CARES_HEADER.mp4') }}" type="video/mp4">
        </video>
        <div class="heading__content container d-flex d-xxl-flex flex-column justify-content-center align-items-center justify-content-sm-center justify-content-md-end align-items-lg-start h-100">
            <div class="d-flex d-sm-flex d-md-flex d-xxl-flex flex-column justify-content-sm-center align-items-sm-center align-items-md-start justify-content-xxl-start" style="color: #FFFFFF;margin-bottom: 43px;">
                <h1 class="text-center heading__content-title">J1 CARES</h1>
                <p class="text-center text-sm-center text-md-start heading__content-description">
                The J1 Alumni, in cooperation with ZIP Travel Philippines, formed a foundation in 2013 called “J1-Connecting Alumni through Reliable and Efficient Service to the Community Foundation," J1 CARES for short. The foundation aims to give back and share blessings through annual charity programs and activities.
                </p>
            </div>
        </div>
    </div>
    <!-- Start: j1-description -->
    <section id="company-background">
        <!-- Start: 1 Row 2 Columns -->
        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-flex flex-column justify-content-center" style="font-family: 'Outfit';font-size: 18px;">
                    <h5 style="font-weight: bold; margin-bottom: 2rem;color: var(--section-title-text-color);">A BAG OF HOPE</h5>
                    <p style="margin-bottom: 25px;font-family: 'Inter';">On June 29, 2018, J1 Cares cooperated with the Alliance of Cultural Exchange Providers in the Philippines to hold its annual outreach program, "A Bag of Hope Project.”<br><br>A Bag of Hope Project aims to provide school supplies to underprivileged students of the Aeta community of Sitio Haduan and Marcos VIllage in Mabalacat, Pampanga.<br><br>J1 Cares collected more than 300 sets of bags with notebooks, pens, pencils, crayons, and paper. The donations came from J1 Alumni, Visa Sponsors, and Host Organizations. On the day of the outreach program, J1 Alumni and ZIP Travel spent a day with the children and gave them sets of bags.<br><br>The children's smiling faces are more than enough to prove that "every act of kindness, no matter how small, can make a big difference in the world."</p>
                </div>
                <div class="col-lg-6 align-items-center justify-content-center py-5" style="display: flex;padding-right: 0px;"><img src="assets_v3/img/j1%20cares%20logo_bh%201.png" style="width: 397px;height: 369px;filter: blur(0px);object-fit: contain;border-radius: 50px;"></div>
            </div>
        </div><!-- End: 1 Row 2 Columns -->
    </section><!-- End: j1-description -->
    <!-- Start: outreach-programs -->
    <section class="d-flex justify-content-center align-items-center" style="height: 623px;background: #F1F1F1;">
        <div class="container">
            <!-- Start: Simple Slider -->
            <div class="simple-slider">
                <!-- Start: Slideshow -->
                <div class="swiper-container">
                    <!-- Start: Slide Wrapper -->
                    <div class="swiper-wrapper" style="padding: 35px 0;">
                        <!-- Start: Slide -->
                        <div class="d-xl-flex justify-content-xl-center align-items-xl-center swiper-slide" style="/*background: url(&quot;https://cdn.bootstrapstudio.io/placeholders/1400x800.png&quot;) center center / cover no-repeat;*/">
                            <div class="row" style="height: 100%;">
                                <div class="col">
                                    <div style="height: 503px;border-radius: 50px;box-shadow: 0px 6px 18px rgb(141,153,164);">
                                        <img style="width: 100%;height: 320px;border-top-right-radius: inherit;border-top-left-radius: inherit;" src="assets_v3/img/j1_1.png">
                                        <div style="height: 183px;width: 100%;display: flex;flex-direction: column;align-items: center;justify-content: start;padding-top: 25px;border-bottom-left-radius: inherit;border-bottom-right-radius: inherit;font-family: 'Outfit';font-size: 18px;">
                                            <h5 class="text-center" style="margin-bottom: 10px;font-weight: bold;">Giving is Caring</h5>
                                            <p class="text-center" style="font-size: 18px;">December 2024<br>St. Ezekiel Moreno Hall</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div style="height: 503px;border-radius: 50px;box-shadow: 0px 6px 18px rgb(141,153,164);">
                                        <img style="width: 100%;height: 320px;border-top-right-radius: inherit;border-top-left-radius: inherit;" src="assets_v3/img/j1_2.png">
                                        <div style="height: 183px;width: 100%;display: flex;flex-direction: column;align-items: center;justify-content: start;padding-top: 25px;border-bottom-left-radius: inherit;border-bottom-right-radius: inherit;font-family: 'Outfit';font-size: 18px;">
                                            <h5 class="text-center" style="margin-bottom: 10px;font-weight: bold;">Caring the J1 Way</h5>
                                            <p class="text-center" style="font-size: 18px;">December 2015<br>Hospicio De San Jose Elderly Home</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div style="height: 503px;border-radius: 50px;box-shadow: 0px 6px 18px rgb(141,153,164);">
                                        <img style="width: 100%;height: 320px;border-top-right-radius: inherit;border-top-left-radius: inherit;" src="assets_v3/img/j1_3.png">
                                        <div style="height: 183px;width: 100%;display: flex;flex-direction: column;align-items: center;justify-content: start;padding-top: 25px;border-bottom-left-radius: inherit;border-bottom-right-radius: inherit;font-family: 'Outfit';font-size: 18px;">
                                            <h5 class="text-center" style="margin-bottom: 10px;font-weight: bold;">Happy Child, Happy Life</h5>
                                            <p class="text-center" style="font-size: 18px;">August 2016<br>Virlanie Children’s Home</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End: Slide -->
                        <!-- Start: Slide -->
                        <div class="d-xl-flex justify-content-xl-center align-items-xl-center swiper-slide" style="/*background: url(&quot;https://cdn.bootstrapstudio.io/placeholders/1400x800.png&quot;) center center / cover no-repeat;*/">
                            <div class="row" style="height: 100%;">
                                <div class="col">
                                    <div style="height: 503px;border-radius: 50px;box-shadow: 0px 6px 18px rgb(141,153,164);">
                                        <img style="width: 100%;height: 320px;border-top-right-radius: inherit;border-top-left-radius: inherit;" src="assets_v3/img/j1_5.png">
                                        <div style="height: 183px;width: 100%;display: flex;flex-direction: column;align-items: center;justify-content: start;padding-top: 25px;border-bottom-left-radius: inherit;border-bottom-right-radius: inherit;font-family: 'Outfit';font-size: 18px;">
                                            <h5 class="text-center" style="margin-bottom: 10px;font-weight: bold;">Cares on the Road</h5>
                                            <p class="text-center" style="font-size: 18px;">December 2017<br>Streets of Manila</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div style="height: 503px;border-radius: 50px;box-shadow: 0px 6px 18px rgb(141,153,164);">
                                        <img style="width: 100%;height: 320px;border-top-right-radius: inherit;border-top-left-radius: inherit;" src="assets_v3/img/j1_6.png">
                                        <div style="height: 183px;width: 100%;display: flex;flex-direction: column;align-items: center;justify-content: start;padding-top: 25px;border-bottom-left-radius: inherit;border-bottom-right-radius: inherit;font-family: 'Outfit';font-size: 18px;">
                                            <h5 class="text-center" style="margin-bottom: 10px;font-weight: bold;">Groove to Care: Dance for a Cause</h5>
                                            <p class="text-center" style="font-size: 18px;">February 2018<br>Dapitan Sports Complex</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div style="height: 503px;border-radius: 50px;box-shadow: 0px 6px 18px rgb(141,153,164);">
                                        <img style="width: 100%;height: 320px;border-top-right-radius: inherit;border-top-left-radius: inherit;" src="assets_v3/img/j1_7.png">
                                        <div style="height: 183px;width: 100%;display: flex;flex-direction: column;align-items: center;justify-content: start;padding-top: 25px;border-bottom-left-radius: inherit;border-bottom-right-radius: inherit;font-family: 'Outfit';font-size: 18px;">
                                            <h5 class="text-center" style="margin-bottom: 10px;font-weight: bold;">A Bag of Hope 2018</h5>
                                            <p class="text-center" style="font-size: 18px;"> June 2018<br>Sitio Haduan & Marcos VIllage</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End: Slide -->
                        <!-- Start: Slide -->
                        <div class="d-xl-flex justify-content-xl-center align-items-xl-center swiper-slide" style="/*background: url(&quot;https://cdn.bootstrapstudio.io/placeholders/1400x800.png&quot;) center center / cover no-repeat;*/">
                            <div class="row" style="height: 100%;">
                                <div class="col">
                                    <div style="height: 503px;border-radius: 50px;box-shadow: 0px 6px 18px rgb(141,153,164);">
                                        <img style="width: 100%;height: 320px;border-top-right-radius: inherit;border-top-left-radius: inherit;" src="assets_v3/img/j1_5.png">
                                        <div style="height: 183px;width: 100%;display: flex;flex-direction: column;align-items: center;justify-content: start;padding-top: 25px;border-bottom-left-radius: inherit;border-bottom-right-radius: inherit;font-family: 'Outfit';font-size: 18px;">
                                            <h5 class="text-center" style="margin-bottom: 10px;font-weight: bold;">Groove to Care: Dance for a Cause</h5>
                                            <p class="text-center" style="font-size: 18px;">February 2018<br>Dapitan Sports Complex</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div style="height: 503px;border-radius: 50px;box-shadow: 0px 6px 18px rgb(141,153,164);">
                                        <img style="width: 100%;height: 320px;border-top-right-radius: inherit;border-top-left-radius: inherit;" src="assets_v3/img/j1_6.png">
                                        <div style="height: 183px;width: 100%;display: flex;flex-direction: column;align-items: center;justify-content: start;padding-top: 25px;border-bottom-left-radius: inherit;border-bottom-right-radius: inherit;font-family: 'Outfit';font-size: 18px;">
                                            <h5 class="text-center" style="margin-bottom: 10px;font-weight: bold;">A Bag of Hope 2018</h5>
                                            <p class="text-center" style="font-size: 18px;"> June 2018<br>Sitio Haduan & Marcos VIllage</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div style="height: 503px;border-radius: 50px;box-shadow: 0px 6px 18px rgb(141,153,164);">
                                        <img style="width: 100%;height: 320px;border-top-right-radius: inherit;border-top-left-radius: inherit;" src="assets_v3/img/j1_8.png">
                                        <div style="height: 183px;width: 100%;display: flex;flex-direction: column;align-items: center;justify-content: start;padding-top: 25px;border-bottom-left-radius: inherit;border-bottom-right-radius: inherit;font-family: 'Outfit';font-size: 18px;">
                                            <h5 class="text-center" style="margin-bottom: 10px;font-weight: bold;">A Bag of Hope 2023</h5>
                                            <p class="text-center" style="font-size: 18px;">September 2023<br>Pampanga</p>
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
    </section><!-- End: outreach-programs -->
    <!-- Start: apply-now -->
    <section class="d-xl-flex align-items-xl-center" style="height: 280px;width: 100%;">
        <div class="container d-xl-flex flex-column align-items-xl-start">
            <h5 style="font-weight: bold;font-family: 'Outfit';">SPONSOR A BAG OF HOPE</h5>
            <p style="font-family: 'Inter';font-size: 18px;font-weight: normal;">Are you a J1 Alumnus? We invite you to join us in helping underprivileged students embark on their journey. Get in touch with us on how to sponsor your own Bag of Hope for one learner. <strong>Email us at j1cares@ziptravel.com.ph</strong></p>
        </div>
    </section><!-- End: apply-now -->
@endsection


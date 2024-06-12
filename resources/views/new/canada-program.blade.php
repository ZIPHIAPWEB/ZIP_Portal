<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

@include('new.partials.head')

<body>
@include('new.partials.navbar')
    <div id="heading" style="background: var(--bs-body-color); height: 885px; width: 100%; overflow: hidden; position: relative;">
        <video style="position: absolute;z-index: 0;min-height: 100%;min-width: 100%;object-fit: fill;overflow: hidden;" muted autoplay loop>
            <source src="{{ asset('assets_v3/videos/CANADA_HEADER.mp4') }}" type="video/mp4">
        </video>
        <div class="container d-flex d-xxl-flex flex-column justify-content-center align-items-center justify-content-sm-center justify-content-md-end align-items-lg-start h-100" style="position: relative; z-index: 2;">
            <div class="d-flex d-sm-flex d-md-flex d-xxl-flex flex-column justify-content-sm-center align-items-sm-center align-items-md-start justify-content-xxl-start" style="color: #FFFFFF;margin-bottom: 43px;">
                <h1 class="text-center" style="margin-bottom: 17px;font-family: 'Outfit';font-weight: 900;">CANADA PROGRAM</h1>
                <p class="text-center text-sm-center text-md-start" style="margin-bottom: 25px;font-family: 'Inter';font-size: 18px;">The Canada Program provides international students an excellent opportunity to obtain additional post-graduate degrees from recognized Canadian institutions, gain valuable work experience under Canadian companies, and potentially obtain permanent residency.</p>
            </div>
        </div>
    </div><!-- Start: about-us -->
    <section style="padding: 75px 0;">
        <div class="container">
            <div style="font-size: 18px;font-family: 'Inter';color: #2A2A2A;">
                <p style="margin-bottom: 25px;">Known for having the most polite citizens, Canada ranks #3 in quality of life based on factors including health system, safety, job market, and economic stability. International students feel welcomed thanks to the country’s diversity and multiculturalism.</p>
            </div>
            <div class="row">
                <div class="col-12 col-lg-7">
                    <div>
                        <h5 style="font-family: 'Outfit';font-weight: bold;">STUDY. WORK. LIVE.</h5>
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
                </div>
                <div class="col d-lg-flex justify-content-lg-center align-items-lg-center" style="text-align: center;"><img style="height: 337px;width: 225px; border-radius: 40px; object-fit: cover;" src="assets_v3/img/CANADA.png"></div>
            </div>
            <div class="row align-items-center" style="margin-top: 15px;">
                <div class="col-12">
                    <h5 style="font-family: 'Outfit';font-weight: bold;">ELIGIBILITY</h5>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="d-flex d-xl-flex flex-row align-items-lg-center align-items-xl-center" style="padding: 15px 0;">
                        <div class="d-flex justify-content-center align-items-center" style="min-width: 52px;height: 52px;background: #0C1C33;color: #FFFFFF;font-family: 'Outfit';font-weight: bold;border-radius: 10px;margin-right: 20px;"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-check-lg" style="width: 34px;height: 52px;">
                                <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022"></path>
                            </svg></div>
                        <p style="font-family: 'Inter';font-style: normal;font-size: 18px;">18 to 35 years old</p>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="d-flex d-xl-flex flex-row align-items-lg-center align-items-xl-center" style="padding: 15px 0;">
                        <div class="d-flex justify-content-center align-items-center" style="min-width: 52px;height: 52px;background: #0C1C33;color: #FFFFFF;font-family: 'Outfit';font-weight: bold;border-radius: 10px;margin-right: 20px;"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-check-lg" style="width: 34px;height: 52px;">
                                <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022"></path>
                            </svg></div>
                        <p style="font-family: 'Inter';font-style: normal;font-size: 18px;">Must be a high school or college graduate</p>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="d-flex d-xl-flex flex-row align-items-lg-center align-items-xl-center" style="padding: 15px 0;">
                        <div class="d-flex justify-content-center align-items-center" style="min-width: 52px;height: 52px;background: #0C1C33;color: #FFFFFF;font-family: 'Outfit';font-weight: bold;border-radius: 10px;margin-right: 20px;"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-check-lg" style="width: 34px;height: 52px;">
                                <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022"></path>
                            </svg></div>
                        <p style="font-family: 'Inter';font-style: normal;font-size: 18px;">Must be an effective communicator in an English-speaking environment</p>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End: about-us -->
    <!-- Start: application-guide -->
    <section class="d-xl-flex justify-content-xl-center align-items-xl-center app-guide">
        <div class="container">
            <h1 style="font-family: 'Louis George Cafe';font-size: 28px;font-weight: bold;margin-bottom: 19px;">APPLICATION GUIDE</h1>
            <div class="row align-items-center">
                <div class="col-12 col-lg-6">
                    <div class="d-flex flex-row align-items-center align-items-xl-center" style="padding: 15px 0;">
                        <div class="d-flex justify-content-center align-items-center" style="width: 52px;height: 52px;background: #0C1C33;color: #FFFFFF;font-family: 'Outfit';font-weight: bold;border-radius: 10px;margin-right: 20px;"><span>01</span></div>
                        <p style="font-family: 'Inter';font-style: normal;font-size: 18px;">Program Orientation and Assessment</p>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="d-flex d-xl-flex align-items-center align-items-xl-center" style="padding: 15px 0;">
                        <div class="d-flex justify-content-center align-items-center" style="width: 52px;height: 52px;background: #0C1C33;color: #FFFFFF;font-family: 'Outfit';font-weight: bold;border-radius: 10px;margin-right: 20px;"><span>04</span></div>
                        <p style="font-family: 'Inter';font-style: normal;font-size: 18px;">Visa Processing and Filing</p>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="d-flex d-xl-flex align-items-center align-items-xl-center" style="padding: 15px 0;">
                        <div class="d-flex justify-content-center align-items-center" style="width: 52px;height: 52px;background: #0C1C33;color: #FFFFFF;font-family: 'Outfit';font-weight: bold;border-radius: 10px;margin-right: 20px;"><span>02</span></div>
                        <p style="font-family: 'Inter';font-style: normal;font-size: 18px;">Online Registration</p>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="d-flex d-xl-flex align-items-center align-items-xl-center" style="padding: 15px 0;">
                        <div class="d-flex justify-content-center align-items-center" style="width: 52px;height: 52px;background: #0C1C33;color: #FFFFFF;font-family: 'Outfit';font-weight: bold;border-radius: 10px;margin-right: 20px;"><span>05</span></div>
                        <p style="font-family: 'Inter';font-style: normal;font-size: 18px;">Departure and Program Proper</p>
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-flex d-xl-flex align-items-center align-items-xl-center" style="padding: 15px 0;">
                        <div class="d-flex justify-content-center align-items-center" style="width: 52px;height: 52px;background: #0C1C33;color: #FFFFFF;font-family: 'Outfit';font-weight: bold;border-radius: 10px;margin-right: 20px;"><span>03</span></div>
                        <p style="font-family: 'Inter';font-style: normal;font-size: 18px;">Submission of Documents</p>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End: application-guide -->
    <!-- Start: apply-now -->
    <section class="d-flex align-items-center align-items-xl-center apply-now">
        <div class="container text-center text-lg-start d-xl-flex flex-column align-items-xl-start">
            <p style="margin-bottom: 25px;font-family: 'Inter';font-size: 18px;font-weight: 400;">ZIP Travel is here to help you make the most of your international journey. We are dedicated to delivering the highest quality international opportunities and committed to providing exceptional support and guidance to participants throughout the program.</p>
            <a href="https://ziptravel.com.ph/portal/v2/login" target="_blank" class="btn btn-primary" role="button" style="width: 173px;height: 53px;vertical-align: text-bottom;text-align: center;background: #510A0A;padding: 10px;font-size: 20px;font-family: 'Outfit';margin-top: 12px;border-radius: 40px;border: 0;">APPLY NOW!</a>
        </div>
    </section><!-- End: apply-now -->
    @include('new.partials.footer')
    <script src="assets_v3/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets_v3/js/script.min.js"></script>
</body>

</html>
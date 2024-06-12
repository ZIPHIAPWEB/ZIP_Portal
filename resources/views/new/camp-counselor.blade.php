<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

@include('new.partials.head')

<body>
@include('new.partials.navbar')
    <div id="heading" style="background: var(--bs-body-color); height: 885px; width: 100%; overflow: hidden; position: relative;">
        <video style="position: absolute;z-index: 0;min-height: 100%;min-width: 100%;object-fit: fill;overflow: hidden;" muted autoplay loop>
            <source src="{{ asset('assets_v3/videos/CAMP_HEADER.mp4') }}" type="video/mp4">
        </video>
        <div class="container d-flex d-xxl-flex flex-column justify-content-center align-items-center justify-content-sm-center justify-content-md-end align-items-lg-start h-100" style="position: relative; z-index: 2;">
            <div class="d-flex d-sm-flex d-md-flex d-xxl-flex flex-column justify-content-sm-center align-items-sm-center align-items-md-start justify-content-xxl-start" style="color: #FFFFFF;margin-bottom: 43px;">
                <h1 class="text-center" style="margin-bottom: 17px;font-family: 'Outfit';font-weight: 900;">CAMP COUNSELOR PROGRAM</h1>
                <p class="text-center text-sm-center text-md-start" style="margin-bottom: 25px;font-family: 'Inter';font-size: 18px;">
                    Summer camp is an integral part of American culture. Every year, over 10 million children attend camps all across America. Over ten thousand summer camps exist across the country each with its history and traditions.    
                </p>
            </div>
        </div>
    </div><!-- Start: about-us -->
    <section style="padding: 75px 0;">
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
                    <h5 style="font-family: 'Outfit';font-weight: bold;font-size: 20px;">PROGRAM DURATION</h5>
                </div>
                <div class="col-12 d-flex align-items-lg-center" style="font-size: 18px; font-family: 'Inter';">
                    <p>The J1 Camp Counselor Program typically runs for 8-9 weeks from June to September, allowing student participants to have their camp adventure during the school summer vacation.</p>
                </div>
            </div>
            <div class="row align-items-center" style="margin-top: 56px;">
                <div class="col-12">
                    <h5 style="font-family: 'Outfit';font-weight: bold;">ELIGIBILITY</h5>
                </div>
                <div class="col-12">
                    <div class="d-flex d-xl-flex flex-row align-items-lg-center align-items-xl-center" style="padding: 15px 0;">
                        <div class="d-flex justify-content-center align-items-center" style="min-width: 52px;height: 52px;background: #0C1C33;color: #FFFFFF;font-family: 'Outfit';font-weight: bold;border-radius: 10px;margin-right: 20px;"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-check-lg" style="width: 34px;height: 52px;">
                                <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022"></path>
                            </svg></div>
                        <p style="font-family: 'Inter';font-style: normal;font-size: 18px;">At least 18 years of age</p>
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-flex d-xl-flex flex-row align-items-lg-center align-items-xl-center" style="padding: 15px 0;">
                        <div class="d-flex justify-content-center align-items-center" style="min-width: 52px;height: 52px;background: #0C1C33;color: #FFFFFF;font-family: 'Outfit';font-weight: bold;border-radius: 10px;margin-right: 20px;"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-check-lg" style="width: 34px;height: 52px;">
                                <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022"></path>
                            </svg></div>
                        <p style="font-family: 'Inter';font-style: normal;font-size: 18px;">Sufficiently proficient in the English language, able to interact in an English-speaking environment</p>
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-flex d-xl-flex flex-row align-items-lg-center align-items-xl-center" style="padding: 15px 0;">
                        <div class="d-flex justify-content-center align-items-center" style="min-width: 52px;height: 52px;background: #0C1C33;color: #FFFFFF;font-family: 'Outfit';font-weight: bold;border-radius: 10px;margin-right: 20px;"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-check-lg" style="width: 34px;height: 52px;">
                                <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022"></path>
                            </svg></div>
                        <p style="font-family: 'Inter';font-style: normal;font-size: 18px;">
                        Cheerful, energetic, friendly, hard-working, tolerant, flexible, conscientious, caring, reasonably gregarious, uncomplaining, and able to adapt to camp life, including the long hours, rules, and curfews
                        </p>
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
                        <p style="font-family: 'Inter';font-style: normal;font-size: 18px;">Admission and Enrollment (for Study and Work)</p>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="d-flex d-xl-flex align-items-center align-items-xl-center" style="padding: 15px 0;">
                        <div class="d-flex justify-content-center align-items-center" style="width: 52px;height: 52px;background: #0C1C33;color: #FFFFFF;font-family: 'Outfit';font-weight: bold;border-radius: 10px;margin-right: 20px;"><span>02</span></div>
                        <p style="font-family: 'Inter';font-style: normal;font-size: 18px;">Matching and Hiring (for Culinary Trainee)</p>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="d-flex d-xl-flex align-items-center align-items-xl-center" style="padding: 15px 0;">
                        <div class="d-flex justify-content-center align-items-center" style="width: 52px;height: 52px;background: #0C1C33;color: #FFFFFF;font-family: 'Outfit';font-weight: bold;border-radius: 10px;margin-right: 20px;"><span>05</span></div>
                        <p style="font-family: 'Inter';font-style: normal;font-size: 18px;">Submission of Document</p>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="d-flex d-xl-flex align-items-center align-items-xl-center" style="padding: 15px 0;">
                        <div class="d-flex justify-content-center align-items-center" style="width: 52px;height: 52px;background: #0C1C33;color: #FFFFFF;font-family: 'Outfit';font-weight: bold;border-radius: 10px;margin-right: 20px;"><span>03</span></div>
                        <p style="font-family: 'Inter';font-style: normal;font-size: 18px;">Visa Processing and Lodging</p>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="d-flex d-xl-flex align-items-center align-items-xl-center" style="padding: 15px 0;">
                        <div class="d-flex justify-content-center align-items-center" style="width: 52px;height: 52px;background: #0C1C33;color: #FFFFFF;font-family: 'Outfit';font-weight: bold;border-radius: 10px;margin-right: 20px;"><span>06</span></div>
                        <p style="font-family: 'Inter';font-style: normal;font-size: 18px;">Departure and Program Proper</p>
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
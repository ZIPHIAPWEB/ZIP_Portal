<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

@include('new.partials.head')

<body>
@include('new.partials.navbar')
    <div id="heading" style="background: var(--bs-body-color); height: 885px; width: 100%; overflow: hidden; position: relative;">
        <video style="position: absolute;z-index: 0;min-height: 100%;min-width: 100%;object-fit: fill;overflow: hidden;" muted autoplay loop>
            <source src="{{ asset('assets_v3/videos/TRAINEE_HEADER.mp4') }}" type="video/mp4">
        </video>
        <div class="container d-flex d-xxl-flex flex-column justify-content-center align-items-center justify-content-sm-center justify-content-md-end align-items-lg-start h-100" style="position: relative; z-index: 2;">
            <div class="d-flex d-sm-flex d-md-flex d-xxl-flex flex-column justify-content-sm-center align-items-sm-center align-items-md-start justify-content-xxl-start" style="color: #FFFFFF;margin-bottom: 43px;">
                <h1 class="text-center" style="margin-bottom: 17px;font-family: 'Outfit';font-weight: 900;">INTERNSHIP PROGRAM</h1>
                <p class="text-center text-sm-center text-md-start" style="margin-bottom: 25px;font-family: 'Inter';font-size: 18px;">
                The J1 Internship Program offers a unique opportunity for participants to gain practical skills, cultural insights, and professional experience in a diverse and dynamic environment. By immersing themselves in the American workplace, participants develop a global perspective and enhance their future career prospects.</p>
            </div>
        </div>
    </div><!-- Start: about-us -->
    <section style="padding: 75px 0;">
        <div class="container" style="font-family: 'Inter';">
            <div style="font-size: 18px;color: #2A2A2A;">
                <p style="margin-bottom: 25px;">Bridge the gap between formal education and work experience through a practical apprenticeship in the United States under BridgeUSA's Internship Program. Participants will be able to learn with industry leaders working in 4 and 5-star hotels and resorts.</p>
            </div>
            <div class="row">
                <div class="col-12" style="font-size: 18px;">
                    <ul>
                        <li>Open to graduating college and university students as well as recent graduates </li>
                        <li>Application for the J1 Internship is open year-round</li>
                        <li>Put your studies into practice and enhance skills related to your field of study</li>
                        <li>Opportunities include intern positions in culinary, food and beverage, front office, and more!</li>
                        <li>Gain experience to boost your CV and make you globally competitive</li>
                        <li>Countless chances to interact with people from different countries, make lifelong friendships</li>
                        <li>Enhance your English language competency by living and interacting in an English-speaking environment</li>
                        <li>Medical insurance coverage</li>
                    </ul>
                </div>
            </div>
            <div class="row align-items-center" style="margin-top: 56px;">
                <div class="col-12">
                    <h5 style="font-family: 'Outfit';font-weight: bold;font-size: 20px;">PROGRAM DURATION</h5>
                </div>
                <div class="col-12 d-flex align-items-lg-center" style="font-family: 'Inter'; font-size: 18px;">
                    <p>The BridgeUSA Internship Program could be taken in 12 months with a 30-day grace period after the work commitment to travel around the US for cultural exchange.</p>
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
                        <p style="font-family: 'Inter';font-style: normal;font-size: 18px;">Must be under 28 years of age</p>
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-flex d-xl-flex flex-row align-items-lg-center align-items-xl-center" style="padding: 15px 0;">
                        <div class="d-flex justify-content-center align-items-center" style="min-width: 52px;height: 52px;background: #0C1C33;color: #FFFFFF;font-family: 'Outfit';font-weight: bold;border-radius: 10px;margin-right: 20px;"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-check-lg" style="width: 34px;height: 52px;">
                                <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022"></path>
                            </svg></div>
                        <p style="font-family: 'Inter';font-style: normal;font-size: 18px;">Those who have completed their education and have some professional work experience (at least 12 months) in their respective field</p>
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
            </div>
            <!-- <div class="row align-items-center" style="margin-top: 56px;">
                <div class="col-12">
                    <h5 style="font-family: 'Outfit';font-weight: bold;font-size: 20px;">TESTIMONIALS</h5>
                </div>
                <div class="col-12 d-flex flex-column justify-content-center align-items-center flex-lg-row align-items-lg-center">
                    <div class="d-flex d-xl-flex flex-row align-items-lg-center align-items-xl-center" style="padding-right: 20px;"><img src="assets_v3/img/Ellipse%201.png" style="width: 130px;height: 130px;"></div>
                    <div class="text-center text-lg-start d-flex flex-column align-items-lg-start" style="padding: 15px 0;font-family: 'Outfit';">
                        <h6 style="font-family: 'Outfit';font-weight: bold;font-size: 20px;margin-bottom: 0;">Juan Dela Cruz</h6><small style="font-size: 18px;font-family: 'Outfit';margin-bottom: 15px;">University of Santo Tomas</small>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sagittis finibus consequat. Quisque lobortis semper lectus non ornare. Nam porta dolor sem, et ultricies justo dictum quis. Fusce sodales bibendum ipsum ac bibendum. Praesent at massa elit. Sed ut posuere nibh, sed sagittis augue. Aliquam congue consequat imperdiet.</p>
                    </div>
                </div>
            </div> -->
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
                        <p style="font-family: 'Inter';font-style: normal;font-size: 18px;">Host Company Interview</p>
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
                        <p style="font-family: 'Inter';font-style: normal;font-size: 18px;">J1 Visa Processing</p>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="d-flex d-xl-flex align-items-center align-items-xl-center" style="padding: 15px 0;">
                        <div class="d-flex justify-content-center align-items-center" style="width: 52px;height: 52px;background: #0C1C33;color: #FFFFFF;font-family: 'Outfit';font-weight: bold;border-radius: 10px;margin-right: 20px;"><span>03</span></div>
                        <p style="font-family: 'Inter';font-style: normal;font-size: 18px;">Submission of Documents</p>
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
    @include('new.partials.scripts')
</body>

</html>
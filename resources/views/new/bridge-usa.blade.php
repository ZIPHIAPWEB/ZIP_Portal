<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

@include('new.partials.head')

<body>
@include('new.partials.navbar')
    <div id="heading" style="background: var(--bs-body-color); height: 885px; width: 100%; overflow: hidden; position: relative;">
        <video style="position: absolute;z-index: 0;min-height: 100%;min-width: 100%;object-fit: fill;overflow: hidden;" muted autoplay loop>
            <source src="{{ asset('assets_v3/videos/BRIDGEUSA_HEADER.mp4') }}" type="video/mp4">
        </video>
        <div class="container d-flex d-xxl-flex flex-column justify-content-center align-items-center justify-content-sm-center justify-content-md-end align-items-lg-start h-100" style="position: relative; z-index: 2;">
            <div class="d-flex d-sm-flex d-md-flex d-xxl-flex flex-column justify-content-sm-center align-items-sm-center align-items-md-start justify-content-xxl-start" style="color: #FFFFFF;margin-bottom: 43px;">
                <h1 class="text-center" style="margin-bottom: 17px;font-family: 'Outfit';font-weight: 900;">BRIDGEUSA PROGRAMS</h1>
                <p class="text-center text-sm-center text-md-start" style="margin-bottom: 25px;font-family: 'Inter';font-size: 18px;">BridgeUSA is a chance for students to visit the United States of America, be exposed to the diverse American citizens and culture, undergo practical learning, and seek career advancement.</p>
            </div>
        </div>
    </div><!-- Start: about-us -->
    <section style="padding: 75px 0;">
        <div class="container">
            <div style="font-size: 18px;font-family: 'Inter';color: #2A2A2A;">
                <p style="margin-bottom: 25px;">The Mutual Educational and Cultural Exchange Act (also known as the Fulbright-Hays Act) was established in 1961 to enhance the mutual understanding between Americans and the rest of the world. It created the Exchange Visitor Program, now rebranded as BridgeUSA, where college and university students and fresh graduates worldwide can come to the United States under the J1 Visa.</p>
                <p style="margin-bottom: 25px;">Under the J1 Visa BridgeUSA program, the country welcomes around 300,000 participants from 200 countries annually. It allows foreign nationals to participate in work-and-study-based programs such as teaching, studying, or receiving on-the-job training for several weeks or years.</p>
                <p style="margin-bottom: 25px;">The BridgeUSA program is administered by the U.S. Department of State's Bureau of Educational and Cultural Affairs.</p>
            </div>
            <div class="row">
                <div class="col d-xl-flex justify-content-xl-center align-items-xl-center" style="padding: 0;">
                    <div style="height: 293px;border-radius: 40px;box-shadow: 0px 6px 18px rgb(141,153,164);"><img style="width: 100%;height: 211px;" src="assets_v3/img/Rectangle%2011%20(1).png">
                        <div class="d-flex justify-content-center align-items-center justify-content-xl-center" style="width: 100%;height: 82px;">
                            <span style="font-family: 'Outfit';font-size: 20px; font-weight: lighter;">Summer Work Travel</span>
                        </div>
                    </div>
                </div>
                <div class="col d-xl-flex justify-content-xl-center align-items-xl-center" style="padding: 0;">
                    <div style="height: 293px;border-radius: 40px;box-shadow: 0px 6px 18px rgb(141,153,164);"><img style="width: 100%;height: 211px;" src="assets_v3/img/Rectangle%2011%20(1).png">
                        <div class="d-flex justify-content-center align-items-center justify-content-xl-center" style="width: 100%;height: 82px;">
                            <span style="font-family: 'Outfit';font-size: 20px; font-weight: lighter;">Internship</span>
                        </div>
                    </div>
                </div>
                <div class="col d-xl-flex justify-content-xl-center align-items-xl-center" style="padding: 0;">
                    <div style="height: 293px;border-radius: 40px;box-shadow: 0px 6px 18px rgb(141,153,164);"><img style="width: 100%;height: 211px;" src="assets_v3/img/Rectangle%2011%20(1).png">
                        <div class="d-flex justify-content-center align-items-center justify-content-xl-center" style="width: 100%;height: 82px;">
                            <span style="font-family: 'Outfit';font-size: 20px; font-weight: lighter;">Trainee</span>
                        </div>
                    </div>
                </div>
                <div class="col d-xl-flex justify-content-xl-center align-items-xl-center" style="padding: 0;">
                    <div style="height: 293px;border-radius: 40px;box-shadow: 0px 6px 18px rgb(141,153,164);"><img style="width: 100%;height: 211px;" src="assets_v3/img/Rectangle%2011%20(1).png">
                        <div class="d-flex justify-content-center align-items-center justify-content-xl-center" style="width: 100%;height: 82px;">
                            <span style="font-family: 'Outfit';font-size: 20px; font-weight: lighter;">Camp Counselor</span>
                        </div>
                    </div>
                </div>
                <div class="col d-xl-flex justify-content-xl-center align-items-xl-center" style="padding: 0;">
                    <div style="height: 293px;border-radius: 40px;box-shadow: 0px 6px 18px rgb(141,153,164);"><img style="width: 100%;height: 211px;" src="assets_v3/img/Rectangle%2011%20(1).png">
                        <div class="d-flex justify-content-center align-items-center justify-content-xl-center" style="width: 100%;height: 82px;">
                            <span style="font-family: 'Outfit';font-size: 20px; font-weight: lighter;">Teachers Program</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End: about-us -->
    <!-- Start: application-guide -->
    <section class="d-xl-flex justify-content-xl-center align-items-xl-center" style="height: 378px;width: 100%;background: #F1F1F1;">
        <div class="container">
            <h1 style="font-family: 'Louis George Cafe';font-size: 28px;font-weight: bold;margin-bottom: 19px;">APPLICATION GUIDE</h1>
            <div class="row align-items-center">
                <div class="col-6">
                    <div class="d-xl-flex align-items-xl-center" style="padding: 15px 0;">
                        <div class="d-flex justify-content-center align-items-center" style="width: 52px;height: 52px;background: #0C1C33;color: #FFFFFF;font-family: 'Outfit';font-weight: bold;border-radius: 10px;margin-right: 20px;"><span>01</span></div>
                        <p style="font-family: 'Inter';font-style: normal;font-size: 18px;">Program Orientation and Assessment</p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-xl-flex align-items-xl-center" style="padding: 15px 0;">
                        <div class="d-flex d-xl-flex justify-content-center align-items-center justify-content-xl-center align-items-xl-center" style="width: 52px;height: 52px;background: #0C1C33;color: #FFFFFF;font-family: 'Outfit';font-weight: bold;border-radius: 10px;margin-right: 20px;"><span>04</span></div>
                        <p style="font-family: 'Inter';font-style: normal;font-size: 18px;">Host Company Interview</p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-xl-flex align-items-xl-center" style="padding: 15px 0;">
                        <div class="d-flex d-xl-flex justify-content-center align-items-center justify-content-xl-center align-items-xl-center" style="width: 52px;height: 52px;background: #0C1C33;color: #FFFFFF;font-family: 'Outfit';font-weight: bold;border-radius: 10px;margin-right: 20px;"><span>02</span></div>
                        <p style="font-family: 'Inter';font-style: normal;font-size: 18px;">Online Registration</p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-xl-flex align-items-xl-center" style="padding: 15px 0;">
                        <div class="d-flex d-xl-flex justify-content-center align-items-center justify-content-xl-center align-items-xl-center" style="width: 52px;height: 52px;background: #0C1C33;color: #FFFFFF;font-family: 'Outfit';font-weight: bold;border-radius: 10px;margin-right: 20px;"><span>05</span></div>
                        <p style="font-family: 'Inter';font-style: normal;font-size: 18px;">J1 Visa Processing</p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-xl-flex align-items-xl-center" style="padding: 15px 0;">
                        <div class="d-flex d-xl-flex justify-content-center align-items-center justify-content-xl-center align-items-xl-center" style="width: 52px;height: 52px;background: #0C1C33;color: #FFFFFF;font-family: 'Outfit';font-weight: bold;border-radius: 10px;margin-right: 20px;"><span>03</span></div>
                        <p style="font-family: 'Inter';font-style: normal;font-size: 18px;">Submission of Documents</p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-xl-flex align-items-xl-center" style="padding: 15px 0;">
                        <div class="d-flex d-xl-flex justify-content-center align-items-center justify-content-xl-center align-items-xl-center" style="width: 52px;height: 52px;background: #0C1C33;color: #FFFFFF;font-family: 'Outfit';font-weight: bold;border-radius: 10px;margin-right: 20px;"><span>06</span></div>
                        <p style="font-family: 'Inter';font-style: normal;font-size: 18px;">Departure and Program Proper</p>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End: application-guide -->
    <!-- Start: apply-now -->
    <section class="d-xl-flex align-items-xl-center" style="height: 280px;width: 100%;">
        <div class="container d-xl-flex flex-column align-items-xl-start">
            <p style="margin-bottom: 25px;font-family: 'Inter';font-size: 18px;font-weight: 400;">ZIP Travel is here to help you make the most of your international journey. We are dedicated to delivering the highest quality international opportunities and committed to providing exceptional support and guidance to participants throughout the program.</p><a class="btn btn-primary" role="button" style="width: 173px;height: 53px;vertical-align: text-bottom;text-align: center;background: #510A0A;padding: 10px;font-size: 20px;font-family: 'Outfit';margin-top: 12px;border-radius: 40px;border: 0;">APPLY NOW!</a>
        </div>
    </section><!-- End: apply-now -->
    @include('new.partials.footer')
    <script src="assets_v3/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets_v3/js/script.min.js"></script>
</body>

</html>
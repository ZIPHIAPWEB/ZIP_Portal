<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

@include('new.partials.head')

<body>
@include('new.partials.navbar')
    <div id="heading" style="background: var(--bs-body-color); height: 885px; width: 100%; overflow: hidden; position: relative;">
        <video style="position: absolute;z-index: 0;min-height: 100%;min-width: 100%;object-fit: fill;overflow: hidden;" muted autoplay loop>
            <source src="{{ asset('assets_v3/videos/SPAIN_HEADER.mp4') }}" type="video/mp4">
        </video>
        <div class="container d-flex d-xxl-flex flex-column justify-content-center align-items-center justify-content-sm-center justify-content-md-end align-items-lg-start h-100" style="position: relative; z-index: 2;">
            <div class="d-flex d-sm-flex d-md-flex d-xxl-flex flex-column justify-content-sm-center align-items-sm-center align-items-md-start justify-content-xxl-start" style="color: #FFFFFF;margin-bottom: 43px;">
                <h1 class="text-center" style="margin-bottom: 17px;font-family: 'Outfit';font-weight: 900;">SPAIN PROGRAM</h1>
                <p class="text-center text-sm-center text-md-start" style="margin-bottom: 25px;font-family: 'Inter';font-size: 18px;">The hospitality and culinary scene in Spain is an excellent opportunity for students to gain professional experience, learn new languages, explore diverse cultures, and visit stunning locations.</p>
            </div>
        </div>
    </div><!-- Start: about-us -->
    <section style="padding: 75px 0;">
        <div class="container">
            <div>
                <h5 style="font-family: 'Outfit'; font-size: 20px; font-weight: bold;">HOSPITALITY AND CULINARY INTERNSHIP IN SPAIN</h5>
                <p style="margin-bottom: 25px; font-family: 'Inter'; font-size: 18px;">Experience top-notch training at some of the most prestigious 3 to 5-star hotels and Michelin-starred restaurants in Barcelona, Madrid, Toledo, Valencia, and Ibiza. Get an opportunity to learn from the best in the industry, while immersing yourself in the people, the local culture, and the different customs.</p>
                <p style="margin-bottom: 25px; font-family: 'Inter'; font-size: 18px;">Currently enrolled hospitality college/university students can benefit from paid internships lasting 3 to 6 months. They can gain valuable hands-on experience in the hospitality and culinary fields through this program.</p>
            </div>
            <div class="row">
                <div class="col-12">
                    <ul style="font-family: 'Inter'; font-size: 18px;">
                        <li>Free housing, meals on duty, and a monthly stipend determined by the company</li>
                        <li>Basic knowledge of Spanish will be advantageous:</li>
                        <li style="margin-left: 55px;">A good command of English is sufficient for culinary and housekeeping positions&nbsp;</li>
                        <li style="margin-left: 55px;">Fluency in Spanish is necessary for front desk and food &amp; beverage roles</li>
                    </ul>
                </div>
            </div>
            <a href="https://ziptravel.com.ph/portal/v2/login" target="_blank" class="btn btn-primary" role="button" style="width: 173px;height: 53px;vertical-align: text-bottom;text-align: center;background: #510A0A;padding: 10px;font-size: 20px;font-family: 'Outfit';margin-top: 12px;border-radius: 40px;border: 0;">APPLY NOW!</a>
        </div>
    </section><!-- End: about-us -->
    @include('new.partials.footer')
    <script src="assets_v3/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets_v3/js/script.min.js"></script>
</body>

</html>
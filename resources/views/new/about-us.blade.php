<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

@include('new.partials.head')

<body>
    @include('new.partials.navbar')
    <div id="heading" style="background: var(--bs-body-color); height: 885px; width: 100%; overflow: hidden; position: relative;">
        <video style="position: absolute;z-index: 0;min-height: 100%;min-width: 100%;object-fit: fill;overflow: hidden;" muted autoplay loop>
            <source src="{{ asset('assets_v3/videos/ABOUT US_HEADER.mp4') }}" type="video/mp4">
        </video>
        <div class="container d-flex d-xxl-flex flex-column justify-content-center align-items-center justify-content-sm-center justify-content-md-end align-items-lg-start h-100" style="position: relative; z-index: 2;">
            <div class="d-flex d-sm-flex d-md-flex d-xxl-flex flex-column justify-content-sm-center align-items-sm-center align-items-md-start justify-content-xxl-start" style="color: #FFFFFF;margin-bottom: 43px;">
                <h1 class="text-center" style="margin-bottom: 17px;font-family: 'Outfit';font-weight: 900;">ABOUT US</h1>
                <p class="text-center text-sm-center text-md-start" style="margin-bottom: 25px;font-family: 'Inter';font-size: 18px;">ZIP Travel is an international company that has been at the forefront of providing educational and cultural exchange programs to students and young professionals since its establishment in Europe in 1993.</p>
            </div>
        </div>
    </div><!-- Start: about-us -->
    <section style="padding: 75px 0;">
        <div class="container">
            <div style="font-size: 18px;font-family: 'Inter';color: #2A2A2A;">
                <p style="margin-bottom: 25px;">In 2009, we expanded our operations to the Philippines, bringing our extensive experience and unwavering commitment to the country. Our mission is to offer exceptional opportunities for individuals to immerse themselves in different work environments and cultures across the globe. ZIP Travel is proud to facilitate programs in the United States, Canada, Australia, Spain, and various Asian countries.</p>
                <p style="margin-bottom: 25px;">With over 30 years of operation in Europe and the Philippines, we have successfully supported and guided more than 50,000 participants who have become valued members of our ever-growing program alumni.</p>
                <p style="margin-bottom: 25px;">ZIP Travel is here to help you make the most of your international journey. We are dedicated to delivering the highest quality international opportunities and committed to providing exceptional support and guidance to participants throughout the program.</p>
            </div>
            <div style="margin-top: 25px;">
                <ul class="nav nav-pills" role="tablist" style="display: flex;justify-content: center;gap: 29px;font-family: 'Outfit';font-size: 20px;font-weight: bold;margin-top: 75px;">
                    <li class="nav-item" role="presentation"><a class="nav-link active text-center d-flex d-xl-flex justify-content-center align-items-center justify-content-xl-center align-items-xl-center about-us-link" role="tab" data-bs-toggle="pill" href="#vision" style="background-color: #0C1C33;color: #FFFFFF;">VISION</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link text-center d-flex d-xl-flex justify-content-center align-items-center justify-content-xl-center align-items-xl-center about-us-link" role="tab" data-bs-toggle="pill" href="#mission" style="background-color: #0C1C33;color: #FFFFFF;">MISSION</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link text-center d-flex d-xl-flex justify-content-center align-items-center justify-content-xl-center align-items-xl-center about-us-link" role="tab" data-bs-toggle="pill" href="#corp-philosophy" style="background-color: #0C1C33;color: #FFFFFF;">CORPORATE PHILOSOPHY</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link text-center d-flex d-xl-flex justify-content-center align-items-center justify-content-xl-center align-items-xl-center about-us-link" role="tab" data-bs-toggle="pill" href="#international-creed" style="background-color: #0C1C33;color: #FFFFFF;">INTERNATIONAL CREED</a></li>
                </ul>
                <div class="tab-content" style="margin-top: 32px;color: #2A2A2A;font-family: 'Outfit';font-size: 18px;">
                    <div class="tab-pane" role="tabpanel" id="#vision">
                        <p style="border: 0;">
                        Reaching out to encourage a lifelong journey of global peace, respect, independence, and understanding.
                        </p>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="#mission">
                        <p style="border: 0;">Dedicated to helping Filipinos and those from other countries gain a better understanding of one another and the world around them.</p>
                    </div>
                    <div class="tab-pane " role="tabpanel" id="#corp-philosophy">
                        <p style="border: 0;">
                            ZIP Travel strives for excellence in all the areas in which it is involved, globally expanding its commitment for intercultural understanding and harmony, upholding a high degree of professionalism among its people through the strict observance of work ethics, hard work, and loyalty as pillars of success.
                            <br><br>
                            ZIP Travel has the passion to compete globally. It shall create synergy among its branches worldwide, develop cost-efficient and less bureaucratic processes, and optimize collective and individual skills, mindful of the differences among cultures without losing sight for unity, founded upon competency in work and dedication to the universal language of training.
                        </p>
                    </div>
                    <div class="tab-pane active" role="tabpanel" id="internation-creed">
                        <p style="border: 0;">
                            Because the client has a need, we have a job to do. <br>
                            Because the client has a choice, we must be the better choice. <br>
                            Because the client has sensibilities, we must be considerate. <br>
                            Because the client has urgency, we must be quick. <br>
                            Because the client is unique, we must be flexible. <br>
                            Because the client has high expectations, we must exceed their expectations. <br>
                            Because the client has influence, we have the hope of more clients. <br>
                            Because of the client, we exist.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End: about-us -->
    <!-- Start: international membership -->
    <section style="height: 266px;background-color: #F1F1F1;display: flex;align-items: center;">
        <div class="container">
            <div class="row">
                <h1 style="font-family: 'Louis George Cafe';font-weight: bold;font-size: 28px;margin-bottom: 20px;">INTERNATIONAL MEMBERSHIP</h1>
                <p style="font-family: 'Inter';font-size: 18px;">ZIP Travel is a member of the World Youth Student &amp; Educational (WYSE) Travel Confederation, the world’s largest youth and student travel services network. Zip Travel Philippines is a vetted member of the Alliance of Cultural Exchange Providers in the Philippines (ACEPP), a collective group of Philippine Corporations offering international programs for Filipino students, graduates, and young professionals.</p>
            </div>
        </div>
    </section><!-- End: international membership -->
    <!-- Start: partners -->
    <section style="height: 266px;display: flex;align-items: center;">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col"><img src="assets_v3/img/LOGO_HIAP%201.png" style="width: 156px;height: 156px;"></div>
                <div class="col"><img src="assets_v3/img/LOGO_ACEPP%201.png" style="width: 156px;height: 156px;"></div>
                <div class="col"><img src="assets_v3/img/LOGO_EMBASSY%201.png" style="width: 156px;height: 156px;"></div>
                <div class="col"><img src="assets_v3/img/LOGO_CFO%201.png" style="width: 156px;height: 156px;"></div>
                <div class="col"><img src="assets_v3/img/LOGO_AAHRMEI2%201.png" style="width: 156px;height: 156px;"></div>
                <div class="col"><img src="assets_v3/img/LOGO_WYSETRAVEL%201.png" style="width: 156px;height: 156px;"></div>
            </div>
        </div>
    </section><!-- End: partners -->
    @include('new.partials.footer')
    @include('new.partials.scripts')
</body>

</html>
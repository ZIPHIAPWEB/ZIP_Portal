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
            <source src="{{ asset('assets_v3/videos/ASIA_HEADER.mp4') }}" type="video/mp4">
        </video>
        <div class="container d-flex d-xxl-flex flex-column justify-content-center align-items-center justify-content-sm-center justify-content-md-end align-items-lg-start h-100" style="position: relative; z-index: 2;">
            <div class="d-flex d-sm-flex d-md-flex d-xxl-flex flex-column justify-content-sm-center align-items-sm-center align-items-md-start justify-content-xxl-start" style="color: #FFFFFF;margin-bottom: 43px;">
                <h1 class="text-center" style="margin-bottom: 17px;font-family: 'Outfit';font-weight: 900;">ASIA PROGRAM</h1>
                <p class="text-center text-sm-center text-md-start" style="margin-bottom: 25px;font-family: 'Inter';font-size: 18px;">Asia offers a rich cultural experience for students, with opportunities to explore unique customs and traditions. The hospitality industry in Asia is known for its exceptional service and customer satisfaction. The Asia Internship Program allows students to experience this firsthand.</p>
            </div>
        </div>
    </div><!-- Start: about-us -->
    <section style="padding: 75px 0;">
        <div class="container">
            <div>
                <h5 style="font-family: 'Outfit';font-weight: bold;">INTERNSHIP PROGRAM IN ASIA</h5>
                <p style="margin-bottom: 25px;">The Asia Internship Program is tailored for hospitality students currently enrolled and seeking to gain their first work experience in the hospitality industry while also exploring the rich cultural heritage of Asia and entering the global workforce</p>
                <p style="margin-bottom: 25px;">The program offers an excellent opportunity for students to expand their networks, enhance their skills, and lay the foundation for a successful career in the hospitality sector. As interns, students get to work at prestigious 3-star to 5-star hotels and resorts across Asia.</p>
            </div>
            <div class="row">
                <div class="col-12">
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
            </div><a class="btn btn-primary" role="button" style="width: 173px;height: 53px;vertical-align: text-bottom;text-align: center;background: #510A0A;padding: 10px;font-size: 20px;font-family: 'Outfit';margin-top: 12px;border-radius: 40px;border: 0;">APPLY NOW!</a>
        </div>
    </section><!-- End: about-us -->
    @include('new.partials.footer')
    <script src="assets_v3/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets_v3/js/script.min.js"></script>
</body>

</html>
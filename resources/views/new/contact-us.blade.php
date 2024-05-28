<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>zip-website</title>
    <link rel="stylesheet" href="assets_v3/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets_v3/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets_v3/css/styles.min.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
    @include('new.partials.navbar')
    <div id="heading" style="background: var(--bs-body-color); height: 885px; width: 100%; overflow: hidden; position: relative;">
        <video style="position: absolute;z-index: 0;min-height: 100%;min-width: 100%;object-fit: fill;overflow: hidden;" muted autoplay loop>
            <source src="{{ asset('assets_v3/videos/ABOUT US_HEADER.mp4') }}" type="video/mp4">
        </video>
        <div class="container d-flex d-xxl-flex flex-column justify-content-center align-items-center justify-content-sm-center justify-content-md-end align-items-lg-start h-100" style="position: relative; z-index: 2;">
            <div class="d-flex d-sm-flex d-md-flex d-xxl-flex flex-column justify-content-sm-center align-items-sm-center align-items-md-start justify-content-xxl-start" style="color: #FFFFFF;margin-bottom: 43px;">
                <h1 class="text-center" style="margin-bottom: 17px;font-family: 'Outfit';font-weight: 900;">CONTACT US</h1>
                <p class="text-center text-sm-center text-md-start" style="margin-bottom: 25px;font-family: 'Inter';font-size: 18px;">ZIP Travel is an international company that has been at the forefront of providing educational and cultural exchange programs to students and young professionals since its establishment in Europe in 1993.</p>
            </div>
        </div>
    </div>

    <section style="padding: 75px 0;">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="text-center" style="font-family: 'Outfit';">ZIP Travel Philippines Offices</h2>
                </div>
            </div>
            <div class="row" style="padding: 16px;">
                <div class="col-xl-6" style="padding: 15px;"><img alt="Image containing the map of ZIP Travel Philippines Manila Branch" src="assets/img/MANILA.jpg" style="width: 100%;"></div>
                <div class="col-xl-6 d-xl-flex align-items-xl-center" style="padding: 15px;">
                    <div>
                        <h3 style="font-weight: bold;">Manila Office</h3>
                        <ul class="list-unstyled">
                            <li>
                                <div class="branch-address"><i class="fas fa-house-damage"></i>
                                    <p>2F University Center Building, 1985 C.M. Recto Avenue, Manila, 1008</p>
                                </div>
                            </li>
                            <li>
                                <div class="branch-address"><i class="fas fa-phone"></i>
                                    <p>(02)559-8213 | 0917-522-8213</p>
                                </div>
                            </li>
                            <li></li>
                        </ul>
                    </div>
                </div>
                <!-- <div class="col-xl-6" style="padding: 15px;"><img alt="Image containing the map of ZIP Travel Philippines Pampanga Branch" src="assets/img/PAMPANGA.jpg" style="width: 100%;"></div>
                <div class="col-xl-6 d-xl-flex align-items-xl-center" style="padding: 15px;">
                    <div>
                        <h3 style="font-weight: bold;">Pampanga Office</h3>
                        <ul class="list-unstyled">
                            <li>
                                <div class="branch-address"><i class="fas fa-house-damage"></i>
                                    <p>Unit 101-B Km 6 Green Fields Square MacArthur Highway Sindalan, San Fernando, Pampanga</p>
                                </div>
                            </li>
                            <li>
                                <div class="branch-address"><i class="fas fa-phone"></i>
                                    <p>0906-371-5897 | 0922-876-8213</p>
                                </div>
                            </li>
                            <li></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-6" style="padding: 15px;"><img alt="Image containing the map of ZIP Travel Philippines CEBU Branch" src="assets/img/CEBU.jpg" style="width: 100%;"></div>
                <div class="col-xl-6 d-xl-flex align-items-xl-center" style="padding: 15px;">
                    <div>
                        <h3 style="font-weight: bold;">Cebu Office</h3>
                        <ul class="list-unstyled">
                            <li>
                                <div class="branch-address"><i class="fas fa-house-damage"></i>
                                    <p>Unit 216, Raintree Mall, 528 General Maxilom Avenue, Cebu City</p>
                                </div>
                            </li>
                            <li>
                                <div class="branch-address"><i class="fa fa-phone"></i>
                                    <p>(032)266-8840 | 0915-875-7618</p>
                                </div>
                            </li>
                            <li></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-6" style="padding: 15px;"><img alt="Image containing the map of ZIP Travel Philippines BACOLOD Branch" src="assets/img/BACOLOD.jpg" style="width: 100%;"></div>
                <div class="col-xl-6 d-xl-flex align-items-xl-center" style="padding: 15px;">
                    <div>
                        <h3 style="font-weight: bold;">Bacolod Office</h3>
                        <ul class="list-unstyled">
                            <li>
                                <div class="branch-address"><i class="fas fa-house-damage"></i>
                                    <p>Jaunts and Journeys Travel Centre - Rm. 103. VSB Bldg. 6th Lacson St. Bacolod City</p>
                                </div>
                            </li>
                            <li>
                                <div class="branch-address"><i class="fas fa-phone"></i>
                                    <p>0915-315-2838 | 0967-243-2499</p>
                                </div>
                            </li>
                            <li></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-6" style="padding: 15px;"><img alt="Image containing the map of ZIP Travel Philippines DAVAO Branch" src="assets/img/DAVAO.jpg" style="width: 100%;"></div>
                <div class="col-xl-6 d-xl-flex align-items-xl-center" style="padding: 15px;">
                    <div>
                        <h3 style="font-weight: bold;">Davao Office</h3>
                        <ul class="list-unstyled">
                            <li>
                                <div class="branch-address"><i class="fas fa-house-damage"></i>
                                    <p>5F Metro Lifestyle Complex F. Torres Street, Davao City</p>
                                </div>
                            </li>
                            <li>
                                <div class="branch-address"><i class="fas fa-phone"></i>
                                    <p>(082)296-5941 | 0917-800-8213</p>
                                </div>
                            </li>
                            <li></li>
                        </ul>
                    </div>
                </div> -->
            </div>
        </div>
    </section>

    <section id="contact-form" style="padding: 75px 0;">
        <div class="container" style="font-size: 18px; font-family: 'Outfit';">
            <form action="{{ URL::to('/submitInquiry') }}" method="POST">
                {{ csrf_field() }}
                <div class="row" style="margin-bottom: 16px;">
                    <div class="col text-center">
                        <h5 style="margin: 20px; font-family: 'Outfit';">We'd love to hear from you. We're here to help and answer your inquiries. Please fill out this form:<br></h5>
                    </div>
                </div>
                @if(session('message'))
                <div class="row">
                    <div class="alert alert-success alert-dismissible w-100">
                        <strong>Success!</strong> {{ session('message') }}
                    </div>
                </div>
                @endif
                @if ($errors->any())
                <div class="row">
                    <div class="alert alert-danger alert-dismissible w-100">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                <div class="form-row">
                    <div class="col-12 col-md-6 mb-3">
                        <div class="form-group "><label>FULLNAME (Required)</label><input name="name" class="form-control" type="text" placeholder="Enter your fullname here..."></div>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <div class="form-group"><label>E-MAIL (Required)</label><input name="email" class="form-control" type="text" placeholder="Enter your email here..."></div>
                    </div>
                    <div class="col-12">
                        <div class="form-group mb-3"><label>Message:</label><textarea name="message" class="form-control" rows="10" placeholder="Enter your message here..."></textarea></div>
                        @if(config('services.recaptcha.key'))
                            <div style="margin-bottom: 8px;" class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.key') }}"></div>
                        @endif
                        <div class="form-group"><button class="btn btn-primary border rounded-0" type="submit" style="background-color: rgb(0,33,87);">Send</button></div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    @include('new.partials.footer')
    <script src="assets_v3/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets_v3/js/script.min.js"></script>
</body>

</html>
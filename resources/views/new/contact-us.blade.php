<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

@include('new.partials.head')

<body>
    @include('new.partials.navbar')
    <div id="heading" class="heading">
        <video class="heading__video" muted autoplay loop>
            <source src="{{ asset('assets_v3/videos/CONTACT_HEADER.mp4') }}" type="video/mp4">
        </video>
        <div class="heading__content container d-flex d-xxl-flex flex-column justify-content-center align-items-center justify-content-sm-center justify-content-md-end align-items-lg-start h-100">
            <div class="d-flex d-sm-flex d-md-flex d-xxl-flex flex-column justify-content-sm-center align-items-sm-center align-items-md-start justify-content-xxl-start" style="color: #FFFFFF;margin-bottom: 43px;">
                <h1 class="text-center heading__content-title">CONTACT US</h1>
                <p class="text-center text-sm-center text-md-start heading__content-description">
                    Your Journey Starts Here! Contact Us and Discover New Horizons with Us
                </p>
            </div>
        </div>
    </div>
    <section style="padding: 75px 0;">
        <div class="container">
            <div class="row" style="padding: 16px;">
                <div class="col-xl-6" style="padding: 15px;">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3860.949494212746!2d120.98546407604097!3d14.60195298588453!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397ca0d7df32613%3A0x72b73e2761c0031d!2sZip%20Travel%20(Inner%20Outer%20Travel%2C%20Inc)!5e0!3m2!1sen!2sph!4v1722346295046!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="col-xl-6 d-xl-flex align-items-xl-center" style="padding: 15px;">
                    <div>
                        <h3 style="font-weight: bold; font-family: 'Louis George Cafe';">ZIP TRAVEL MANILA OFFICE</h3>
                        <ul class="list-unstyled" style="font-size: 18px; font-family: 'Outfit';">
                            <li>
                                <div class="branch-address"><i class="fas fa-house-damage"></i>
                                    <p>2F University Center Building, 1985 C.M. Recto Avenue, Manila, 1008</p>
                                </div>
                            </li>
                            <li>
                                <div class="branch-address"><i class="fas fa-phone"></i>
                                    <p>(02) 8559-8213 | 0917 522 8213 | 0922 876 8213</p>
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
                        <h5 style="margin: 20px; font-family: 'Louis George Cafe';">We'd love to hear from you. We're here to help and answer your inquiries. Please fill out this form:<br></h5>
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

                <div class="form-row" style="font-family: 'Louis George Cafe';">
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
                        <div class="form-group">
                        <button class="btn" type="submit" style="border-color: none; color: #FFFFFF;background: #0C1C33;border-radius: 40px;width: 165px;height: 49px;font-size: 20px;font-family: 'Louis George Cafe';font-weight: bold;">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    @include('new.partials.footer')
    @include('new.partials.scripts')
</body>

</html>
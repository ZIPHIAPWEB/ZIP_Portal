@extends('new.layouts.app')

@section('meta')
<meta name="title" content="ZIP Travel Philippines | Tax Services">
    <meta name="description" content="Once in the USA, participants are required to file a tax return.">

    <meta property="og:title" content="ZIP Travel Philippines | Tax Services" />
    <meta property="og:description" content="Once in the USA, participants are required to file a tax return.">
    <meta property="og:type" content="article" />
    <meta property="og:url" content="https://ziptravel.com.ph/tax-services" />

    <meta name="twitter:title" content="ZIP Travel Philippines | Tax Services">
    <meta name="twitter:description" content="Once in the USA, participants are required to file a tax return.">
@endsection

@section('title', 'ZIP Travel Philippines | Tax Services')

@section('content')
    <div id="heading" class="heading">
        <video class="heading__video" muted autoplay loop>
            <source src="{{ asset('assets_v3/videos/TAX_HEADER.mp4') }}" type="video/mp4">
        </video>
        <div class="heading__content container d-flex d-xxl-flex flex-column justify-content-center align-items-center justify-content-sm-center justify-content-md-end align-items-lg-start h-100">
            <div class="d-flex d-sm-flex d-md-flex d-xxl-flex flex-column justify-content-sm-center align-items-sm-center align-items-md-start justify-content-xxl-start" style="color: #FFFFFF;margin-bottom: 43px;">
                <h1 class="text-center heading__content-title">US TAX SERVICES</h1>
                <p class="text-center text-sm-center text-md-start heading__content-description">
                The BridgeUSA Program participants are issued the J-1 visa, identifying them as nonimmigrants engaging in exchange visitor programs in the United States. Once physically in America, all J-1 participants are obligated to pay federal, state, and local taxes.
                </p>
            </div>
        </div>
    </div>
    <!-- Start: about-us -->
    <section style="padding: 75px 0;" class="px-2 px-md-0">
        <div class="container">
            <div style="font-size: 18px;font-family: 'Inter';color: #2A2A2A;">
                <p>
                    J visa holders must file annual income tax reports with the Internal Revenue Service (IRS), the US Government agency responsible for collecting federal taxes.
                    <br>
                    <br>
                    If a non-resident J1 participant earns any US income, they should file a federal tax return with the IRS by law. Failure to file a Federal tax return will breach IRS regulations and may inhibit participants from returning to the US on any future visas. Depending on the circumstances, you may also need to file a state tax return(s).
                </p>
            </div>
        </div>
    </section><!-- End: about-us -->
    <!-- Start: application-guide -->
    <section class="d-flex justify-content-center align-items-center tax-guide-section">
        <div class="container">
            <h1 style="font-family: 'Louis George Cafe';font-size: 28px;font-weight: bold;margin-bottom: 19px;">HOW TO APPLY</h1>
            <p style="margin-bottom: 25px;font-family: 'Inter';font-size: 18px;">Non-residents can use an online resource that legally provides federal and state tax preparation. It can determine your tax status based on a series of questions about the time spent in the United States.<br><br>Once determined to be a non-resident alien, it will help complete and generate the forms needed to be submitted to the IRS.</p>
            <div class="row align-items-center">
                <div class="col-12 col-md-6 order-0 order-md-0">
                    <div class="d-flex align-items-center app-guide-sequence-item">
                        <div class="d-flex justify-content-center align-items-center app-guide-sequence-item__step"><span>01</span></div>
                        <p class="app-guide-sequence-item__description">Gather Documents</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 order-3 order-md-0">
                    <div class="d-flex align-items-center app-guide-sequence-item" style="padding: 15px 0;">
                        <div class="d-flex d-flex justify-content-center align-items-center app-guide-sequence-item__step" style="width: 52px;height: 52px;background: #0C1C33;color: #FFFFFF;font-family: 'Outfit';font-weight: bold;border-radius: 10px;margin-right: 20px;"><span>04</span></div>
                        <p style="font-family: 'Inter';font-style: normal;font-size: 18px;">Complete State Tax Return (if required)</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 order-1 order-md-0">
                    <div class="d-flex align-items-center app-guide-sequence-item" style="padding: 15px 0;">
                        <div class="d-flex d-flex justify-content-center align-items-center app-guide-sequence-item__step" style="width: 52px;height: 52px;background: #0C1C33;color: #FFFFFF;font-family: 'Outfit';font-weight: bold;border-radius: 10px;margin-right: 20px;"><span>02</span></div>
                        <p style="font-family: 'Inter';font-style: normal;font-size: 18px;">Create Accounts</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 order-4 order-md-0">
                    <div class="d-flex align-items-center app-guide-sequence-item" style="padding: 15px 0;">
                        <div class="d-flex d-flex justify-content-center align-items-center app-guide-sequence-item__step" style="width: 52px;height: 52px;background: #0C1C33;color: #FFFFFF;font-family: 'Outfit';font-weight: bold;border-radius: 10px;margin-right: 20px;"><span>05</span></div>
                        <p style="font-family: 'Inter';font-style: normal;font-size: 18px;">Mail Forms to the IRS</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 order-2 order-md-0">
                    <div class="d-flex align-items-center app-guide-sequence-item" style="padding: 15px 0;">
                        <div class="d-flex d-flex justify-content-center align-items-center app-guide-sequence-item__step" style="width: 52px;height: 52px;background: #0C1C33;color: #FFFFFF;font-family: 'Outfit';font-weight: bold;border-radius: 10px;margin-right: 20px;"><span>03</span></div>
                        <p style="font-family: 'Inter';font-style: normal;font-size: 18px;">Answer Questions &amp; Follow the instructions</p>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End: application-guide -->
    <!-- Start: apply-now -->
    <section class="d-flex align-items-center apply-now-section">
        <div class="container d-xl-flex flex-column align-items-xl-start">
            <p class="apply-now-section__description">DISCLAIMER: Our institution is NOT permitted to assist nonresidents with any IRS tax form preparation or tax-related questions. The information provided above is intended for your benefit. <a href="#" style="color: #2A2A2A;">For any questions or concerns, contact the IRS directly.</a></p>
            <a href="https://taxprep.sprintax.com/sprintax-zip-travel" target="_blank" class="btn btn-primary apply-now-section__action" role="button">APPLY NOW!</a>
        </div>
    </section><!-- End: apply-now -->
@endsection
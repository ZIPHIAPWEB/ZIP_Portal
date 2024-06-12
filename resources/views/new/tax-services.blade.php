<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

@include('new.partials.head')

<body>
@include('new.partials.navbar')
    <div id="heading" style="background: var(--bs-body-color); height: 885px; width: 100%; overflow: hidden; position: relative;">
        <video style="position: absolute;z-index: 0;min-height: 100%;min-width: 100%;object-fit: fill;overflow: hidden;" muted autoplay loop>
            <source src="{{ asset('assets_v3/videos/TAX_HEADER.mp4') }}" type="video/mp4">
        </video>
        <div class="container d-flex d-xxl-flex flex-column justify-content-center align-items-center justify-content-sm-center justify-content-md-end align-items-lg-start h-100" style="position: relative; z-index: 2;">
            <div class="d-flex d-sm-flex d-md-flex d-xxl-flex flex-column justify-content-sm-center align-items-sm-center align-items-md-start justify-content-xxl-start" style="color: #FFFFFF;margin-bottom: 43px;">
                <h1 class="text-center" style="margin-bottom: 17px;font-family: 'Outfit';font-weight: 900;">US TAX SERVICES</h1>
                <p class="text-center text-sm-center text-md-start" style="margin-bottom: 25px;font-family: 'Inter';font-size: 18px;">The BridgeUSA Program participants are issued the J-1 visa, identifying them as nonimmigrants engaging in exchange visitor programs in the United States. Once physically in America, all J-1 participants are obligated to pay federal, state, and local taxes.</p>
            </div>
        </div>
    </div><!-- Start: about-us -->
    <section style="padding: 75px 0;">
        <div class="container">
            <div style="font-size: 18px;font-family: 'Inter';color: #2A2A2A;">
                <p style="margin-bottom: 25px;">J visa holders must file annual income tax reports with the Internal Revenue Service (IRS), the US Government agency responsible for collecting federal taxes.<br><br>If a non-resident J1 participant earns any US income, they should file a federal tax return with the IRS by law. Failure to file a Federal tax return will breach IRS regulations and may inhibit participants from returning to the US on any future visas. Depending on the circumstances, you may also need to file a state tax return(s).</p>
            </div>
        </div>
    </section><!-- End: about-us -->
    <!-- Start: application-guide -->
    <section class="d-xl-flex justify-content-xl-center align-items-xl-center" style="height: 488px;width: 100%;background: #F1F1F1;">
        <div class="container">
            <h1 style="font-family: 'Louis George Cafe';font-size: 28px;font-weight: bold;margin-bottom: 19px;">HOW TO APPLY</h1>
            <p style="margin-bottom: 25px;font-family: 'Inter';font-size: 18px;">Non-residents can use an online resource that legally provides federal and state tax preparation. It can determine your tax status based on a series of questions about the time spent in the United States.<br><br>Once determined to be a non-resident alien, it will help complete and generate the forms needed to be submitted to the IRS.</p>
            <div class="row align-items-center">
                <div class="col-6">
                    <div class="d-xl-flex align-items-xl-center" style="padding: 15px 0;">
                        <div class="d-flex justify-content-center align-items-center" style="width: 52px;height: 52px;background: #0C1C33;color: #FFFFFF;font-family: 'Outfit';font-weight: bold;border-radius: 10px;margin-right: 20px;"><span>01</span></div>
                        <p style="font-family: 'Inter';font-style: normal;font-size: 18px;">Gather Documents</p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-xl-flex align-items-xl-center" style="padding: 15px 0;">
                        <div class="d-flex d-xl-flex justify-content-center align-items-center justify-content-xl-center align-items-xl-center" style="width: 52px;height: 52px;background: #0C1C33;color: #FFFFFF;font-family: 'Outfit';font-weight: bold;border-radius: 10px;margin-right: 20px;"><span>04</span></div>
                        <p style="font-family: 'Inter';font-style: normal;font-size: 18px;">Complete State Tax Return (if required)</p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-xl-flex align-items-xl-center" style="padding: 15px 0;">
                        <div class="d-flex d-xl-flex justify-content-center align-items-center justify-content-xl-center align-items-xl-center" style="width: 52px;height: 52px;background: #0C1C33;color: #FFFFFF;font-family: 'Outfit';font-weight: bold;border-radius: 10px;margin-right: 20px;"><span>02</span></div>
                        <p style="font-family: 'Inter';font-style: normal;font-size: 18px;">Create Accounts</p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-xl-flex align-items-xl-center" style="padding: 15px 0;">
                        <div class="d-flex d-xl-flex justify-content-center align-items-center justify-content-xl-center align-items-xl-center" style="width: 52px;height: 52px;background: #0C1C33;color: #FFFFFF;font-family: 'Outfit';font-weight: bold;border-radius: 10px;margin-right: 20px;"><span>05</span></div>
                        <p style="font-family: 'Inter';font-style: normal;font-size: 18px;">Mail Forms to the IRS</p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-xl-flex align-items-xl-center" style="padding: 15px 0;">
                        <div class="d-flex d-xl-flex justify-content-center align-items-center justify-content-xl-center align-items-xl-center" style="width: 52px;height: 52px;background: #0C1C33;color: #FFFFFF;font-family: 'Outfit';font-weight: bold;border-radius: 10px;margin-right: 20px;"><span>03</span></div>
                        <p style="font-family: 'Inter';font-style: normal;font-size: 18px;">Answer Questions &amp; Follow the instructions</p>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End: application-guide -->
    <!-- Start: apply-now -->
    <section class="d-xl-flex align-items-xl-center" style="height: 280px;width: 100%;">
        <div class="container d-xl-flex flex-column align-items-xl-start">
            <p style="margin-bottom: 25px;font-family: 'Inter';font-size: 18px;font-weight: 400;">DISCLAIMER: Our institution is NOT permitted to assist nonresidents with any IRS tax form preparation or tax-related questions. The information provided above is intended for your benefit. For any questions or concerns, contact the IRS directly.</p>
            <a href="https://taxprep.sprintax.com/sprintax-zip-travel" target="_blank" class="btn btn-primary" role="button" style="width: 173px;height: 53px;vertical-align: text-bottom;text-align: center;background: #510A0A;padding: 10px;font-size: 20px;font-family: 'Outfit';margin-top: 12px;border-radius: 40px;border: 0;">APPLY NOW!</a>
        </div>
    </section><!-- End: apply-now -->
    @include('new.partials.footer')
    @include('new.partials.scripts')
</body>

</html>
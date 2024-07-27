<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

@include('new.partials.head')

<body>
    @include('new.partials.navbar')
    <div id="heading" class="heading">
        <video class="heading__video" muted autoplay loop>
            <source src="{{ asset('assets_v3/videos/ABOUT US_HEADER.mp4') }}" type="video/mp4">
        </video>
        <div class="heading__content container d-flex d-xxl-flex flex-column justify-content-center align-items-center justify-content-sm-center justify-content-md-end align-items-lg-start h-100">
            <div class="d-flex d-sm-flex d-md-flex d-xxl-flex flex-column justify-content-sm-center align-items-sm-center align-items-md-start justify-content-xxl-start" style="color: #FFFFFF;margin-bottom: 43px;">
                <h1 class="text-center heading__content-title">SOCIAL STREAMS</h1>
                <p class="text-center text-sm-center text-md-start heading__content-description">
                ZIP Travel is an international company that has been at the forefront of providing educational and cultural exchange programs to students and young professionals since its establishment in Europe in 1993.
                </p>
            </div>
        </div>
    </div>

    <section style="padding: 75px 0;">
        <div class="container">
            <div id="curator-feed-default-layout"><a href="https://curator.io" target="_blank" class="crt-logo crt-tag">Powered by Curator.io</a></div>
        </div>
    </section>

    @include('new.partials.footer')
    @include('new.partials.scripts')
    <script type="text/javascript">
        /* curator-feed-default-layout */
        (function(){
        var i, e, d = document, s = "script";i = d.createElement("script");i.async = 1;
        i.src = "https://cdn.curator.io/published/c122f5a9-3205-4e94-ae94-737682e1158a.js";
        e = d.getElementsByTagName(s)[0];e.parentNode.insertBefore(i, e);
        })();
    </script>
</body>

</html>
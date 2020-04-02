
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ZIP Portal | @yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <link rel="shortcut icon" href="{{ asset('logo.png') }}" type="image/x-icon"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<style>
    .bg-new-application { background: #ecb021; }
    .bg-called { background: #ec8023; }
    .bg-assessed { background: #d25b27; }
    .bg-confirmed { background: #bd3d26; }
    .bg-hired { background: #bd3d26; }
    .bg-visa-interview { background: #174275 }
    .bg-cancelled { background: #b92025; }
    .bg-for-pdos-cfo { background: #15335c; }
    .bg-program-proper {background: #118542;}
</style>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

    @include('partials._header')

    <!-- =============================================== -->

    @include('partials._left-sidebar')

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>

            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                @yield('content')
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    @include('partials._footer')

</div>
<!-- ./wrapper -->
<script src="{{ asset('js/app.js') }}"></script>
@yield('script')
<script type="text/javascript">
    // To make Pace works on Ajax calls
    $(document).ajaxStart(function () {
        Pace.restart()
    });
    $('.ajax').click(function () {
        $.ajax({
            url: '#', success: function (result) {
                $('.ajax-content').html('<hr>Ajax Request Completed !')
            }
        })
    });
</script>
</body>
</html>

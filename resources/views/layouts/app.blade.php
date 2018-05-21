
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ZIP Portal | @yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
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
<!-- page script -->
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

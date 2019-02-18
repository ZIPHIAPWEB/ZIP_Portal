@extends('layouts.auth-app')

@section('title', 'Login')

@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ route('welcome') }}"><b>ZIP TRAVEL </b>Portal</a>
        </div>

        @if(Session::has('Info'))
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <p>{!! Session::get('Info') !!}</p>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h4>
                    <i class="icon fa fa-warning"></i>
                    Alert!
                </h4>
                @foreach ($errors->all() as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </div>
        @endif
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <form action="{{ route('post.login') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group has-feedback">
                    <input type="text" name="name" class="form-control" placeholder="Username" value="{{ old('name') }}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <!--
                   <div class="col-xs-8">
                       <div class="checkbox icheck">
                           <label>
                               <input type="checkbox"> Remember Me
                           </label>
                       </div>

                    </div>
                    -->
                    <!-- /.col -->
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <div class="social-auth-links text-center">
                <a href="{{ route('google.login') }}" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
                    Google+</a>
            </div>
            <!-- /.social-auth-links -->

            <a href="{{ route('forgot.password') }}">I forgot my password</a><br>
            <a href="{{ route('register') }}" class="text-center">Register a new membership</a><br>
            <a href="{{ route('coor.register') }}" class="text-center">Register as a coordinator</a>
        </div>
        <!-- /.login-box-body -->
    </div>
@endsection()

@section('script')
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
@endsection()
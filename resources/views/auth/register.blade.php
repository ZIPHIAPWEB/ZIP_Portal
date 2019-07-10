@extends('layouts.auth-app')

@section('title', 'Register')

@section('content')
    <div class="register-box">
        <div class="register-logo">
            <a href="{{ route('welcome') }}"><b>ZIP TRAVEL </b>Philippines</a>
        </div>

        @if($errors->any())
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h4>
                    <i class="icon fa fa-warning"></i>
                    Alert!
                </h4>
                <ul>
                    @foreach ($errors->all() as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="register-box-body">
            <p class="login-box-msg">New Participant's Registration</p>

            <form action="{{ route('post.register') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group has-feedback">
                    <input name="name" type="text" class="form-control" placeholder="Username" value="{{ old('name') }}">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input name="email" type="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input name="password" type="password" class="form-control" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input name="password_confirmation" type="password" class="form-control" placeholder="Retype password">
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                </div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat"><b>Register</b></button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <a href="{{ route('login') }}" class="text-center">I'm already a participant</a><br>
        </div>
        <!-- /.form-box -->
        <div class="alert alert-danger m-t-10 text-center" style="padding: 6px; color: white"><i>For the Best User Experience Please Use <b>Google Chrome.</b></i></div>
    </div>
    <!-- /.register-box -->
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
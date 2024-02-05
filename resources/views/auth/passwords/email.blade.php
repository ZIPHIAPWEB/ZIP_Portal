@extends('layouts.auth-app')

@section('title', 'Forgot Password')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 m-t-100 m-t-150">
                <div class="register-logo">
                    <a href="{{ route('welcome') }}"><b>ZIP Travel </b>Philipines</a>
                </div>

                @if(Session::has('status'))
                    <div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        <p>{!! Session::get('status') !!}</p>
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
                <div class="box box-default">
                    <div class="box-body">
                        <p class="login-box-msg">Enter your E-mail to reset your password</p>
                        <form action="{{ route('post.forgot.password') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group has-feedback">
                                <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-flat btn-success btn-block" value="Send Link">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
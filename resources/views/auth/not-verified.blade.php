@extends('layouts.auth-app')

@section('title', 'Verification Required!')

@section('content')
    <div class="container">
        <div class="row">
            <div class="box box-default m-t-75">
                <div class="box-header with-border">
                    <i class="fa fa-warning"></i>
                    <h3 class="box-title">Verification Required!</h3>
                </div>
                <div class="box-body">
                    Please verify your email to activate your account! <a href="{{ route('logout') }}">logout</a>
                </div>
            </div>
        </div>
    </div>
@endsection()
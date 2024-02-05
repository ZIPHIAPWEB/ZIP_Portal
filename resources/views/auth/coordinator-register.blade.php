@extends('layouts.auth-app')

@section('title', 'Register')

@section('content')
    <div class="container" id="coordinator-register">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 m-t-100 m-t-150">
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

                <div class="box box-default">
                    <div class="box-body">
                        <p class="login-box-msg">Register as a new coordinator</p>

                        <form action="{{ route('post.coor.register') }}" method="post">
                           {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group has-feedback">
                                        <input name="first-name" type="text" class="form-control" placeholder="First Name">
                                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group has-feedback">
                                        <input name="middle-name" type="text" class="form-control" placeholder="Middle Name">
                                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group has-feedback">
                                        <input name="last-name" type="text" class="form-control" placeholder="Last Name">
                                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group has-feedback">
                                        <select name="program" id="program" class="form-control">
                                            <option selected>Program</option>
                                            <option v-for="program in programs.data" :value="program.id">@{{ program.display_name }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group has-feedback">
                                        <input name="position" type="text" class="form-control" placeholder="Position">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group has-feedback">
                                        <input name="contact-1" type="text" class="form-control" placeholder="Contact #1" maxlength="11">
                                        <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group has-feedback">
                                        <input name="contact-2" type="text" class="form-control" placeholder="Contact #2" maxlength="11">
                                        <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group has-feedback">
                                        <input name="name" type="text" class="form-control" placeholder="Username">
                                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group has-feedback">
                                        <input name="email" type="email" class="form-control" placeholder="Email">
                                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group has-feedback">
                                        <input name="password" type="password" class="form-control" placeholder="Password">
                                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group has-feedback">
                                        <input name="password_confirmation" type="password" class="form-control" placeholder="Retype Password">
                                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                                </div>
                                <a href="{{ route('login') }}" class="login-box-msg">I'm already a Coordinator</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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

        const CoordinatorRegister = new Vue({
            el: '#coordinator-register',
            data: {
                programs: []
            },
            mounted: function () {
                this.GET_PROGRAMS();
            },
            methods: {
                GET_PROGRAMS: function () {
                    axios.get('/helper/program/view')
                        .then((response) => {
                            this.programs = response.data;
                        })
                }
            }
        })
    </script>
@endsection()
@extends('layouts.app')

@section('title', 'Students')

@section('sidenav')
    <li class="header">General</li>
    <li>
        <a href="{{ route('dash.student') }}">
            <i class="fa fa-user"></i> <span><small>My Profile</small></span>
        </a>
    </li>
    <li class="header">My Requirements</li>
    <li>
        <a href="{{ route('req.basic') }}">
            <i class="fa fa-book"></i>
            <span><small>Basic Requirements</small></span>
            <span class="pull-right-container">
                            <small class="label pull-right bg-red">0</small>
                        </span>
        </a>
    </li>
    <li>
        <a href="{{ route('req.payment') }}">
            <i class="fa fa-dollar"></i>
            <span><small>Payment Requirements</small></span>
            <span class="pull-right-container">
                            <small class="label pull-right bg-red">0</small>
                        </span>
        </a>
    </li>
    <li>
        <a href="{{ route('req.visa') }}">
            <i class="fa fa-plane"></i>
            <span><small>Visa Requirements</small></span>
            <span class="pull-right-container">
                            <small class="label pull-right bg-red">0</small>
                        </span>
        </a>
    </li>
@endsection

@section('content')
    <div id="app">
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="http://via.placeholder.com/350x350" alt="User profile picture"/>
                    <h3 class="profile-username text-center">Nina Mcintire</h3>
                    <p class="text-muted text-center">Software Engineer</p>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Followers</b>
                            <a class="pull-right">1,322</a>
                        </li>
                        <li class="list-group-item">
                            <b>Following</b>
                            <a class="pull-right">543</a>
                        </li>
                        <li class="list-group-item">
                            <b>Friends</b>
                            <a class="pull-right">13,287</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">About Me</h3>
                </div>
                <div class="box-body">
                    <strong>
                        <i class="fa fa-book"></i>
                        Education
                    </strong>
                    <p class="text-muted">B.S. in Computer Science from the University of Tennessee at Knoxville</p>
                    <hr>
                    <strong>
                        <i class="fa fa-book"></i>
                        Education
                    </strong>
                    <p class="text-muted">B.S. in Computer Science from the University of Tennessee at Knoxville</p>
                    <hr>
                    <strong>
                        <i class="fa fa-book"></i>
                        Education
                    </strong>
                    <p class="text-muted">B.S. in Computer Science from the University of Tennessee at Knoxville</p>
                    <hr>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#activity" data-toggle="tab" aria-expanded="true">Basic Requirementments</a>
                    </li>
                    <li class="">
                        <a href="#timeline" data-toggle="tab" aria-expanded="false">Payment Requirements</a>
                    </li>
                    <li class="">
                        <a href="#settings" data-toggle="tab" aria-expanded="false">Visa Requirements</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="activity"></div>
                    <div class="tab-pane" id="timeline"></div>
                    <div class="tab-pane" id="settings"></div>
                </div>
            </div>
        </div>

        <div class="modal" id="file-upload" tabindex="-1" role="dialog">
            <form>
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"></h4>
                        </div>
                        <div class="modal-body">

                        </div>
                        <div class="modal-footer clearfix">
                            <button class="btn btn-primary btn-flat btn-block">Upload File</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </form>
        </div><!-- /.modal -->
    </div>
@endsection

@section('script')
    <script>
        const app = new Vue({
            el: '#app',
            data: {
                student: [],
                basicRequirements: [],
                paymentRequirements: [],
                visaRequirements: [],
                user_id: '{{ Auth::user()->id }}',
            },
            created: function() {
                this.loadStudentDetails();
            },
            mounted: function() {
                setTimeout(() => {
                    this.loadBasicRequirements(this.student.program_id);
                    this.loadPaymentRequirements(this.student.program_id);
                    this.loadVisaRequirements(this.student.visa_sponsor_id);
                }, 1000);
            },
            methods: {
                loadStudentDetails() {
                    axios.get(`/stud/view/${this.user_id}`)
                        .then((response) => {
                            this.student = response.data.data;
                            this.program_id = response.data.data.program_id;
                        }).catch((error) => {
                            console.log(error);
                    })
                },
                loadBasicRequirements(programId) {
                    axios.get(`/stud/requirement/basic/${programId}`)
                        .then((response) => {
                            this.basicRequirements = response.data.data;
                            console.log(response.data.data);
                        }).catch((error) => {
                        console.log(error);
                    });
                },
                loadPaymentRequirements(programId) {
                    axios.get(`/stud/requirement/payment/${programId}`)
                        .then((response) => {
                            this.paymentRequirements = response.data.data;
                            console.log(response.data.data);
                        }).catch((error) => {
                            console.log(error);
                    });
                },
                loadVisaRequirements(sponsorId) {
                    axios.get(`/stud/requirement/visa/${sponsorId}`)
                        .then((response) => {
                            this.visaRequirements = response.data.data;
                            console.log(response.data.data);
                        }).catch((error) => {
                            console.log(error);
                    });
                }
            }
        });
    </script>
@endsection
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
        <div class="col-md-3" v-cloak>
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="http://via.placeholder.com/350x350" alt="User profile picture"/>
                    <h3 class="profile-username text-center">@{{ student.first_name }} &nbsp; @{{ student.middle_name.charAt(0) }} &nbsp; @{{ student.last_name }}</h3>
                    <p class="text-muted text-center">@{{ student.position }}</p>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Application Status</b>
                            <a class="pull-right text-green text-sm">@{{ student.application_status }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Visa Interview Status</b>
                            <a v-if="student.visa_interview_status" class="pull-right text-green text-sm">@{{ student.visa_interview_status }}</a>
                            <a v-else class="pull-right text-red">Your Coordinator Will Verify</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <label for="" class="control-label">About</label>
                </div>
                <div class="box-body">
                    <strong>
                        <i class="fa fa-address-card"></i>
                        Home Address
                    </strong>
                    <p class="text-muted">@{{ student.address }}</p>
                    <hr>
                    <strong>
                        <i class="fa fa-calendar"></i>
                        Date of Birth
                    </strong>
                    <p class="text-muted">@{{ student.birthdate }}</p>
                    <hr>
                    <strong>
                        <i class="fa fa-phone"></i>
                        Contacts
                    </strong>
                    <p class="text-muted">@{{ student.home_number }}/@{{ student.mobile_number }}</p>
                    <hr>
                    <strong>
                        <i class="fa fa-envelope"></i>
                        E-mail Address
                    </strong>
                    <p class="text-muted">@{{ student.fb_email }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <label for="" class="control-label">Host Company Details</label>
                </div>
                <div class="box-body">
                    <table class="table table-striped table-bordered table-condensed">
                        <tbody>
                            <tr>
                                <td style="width: 35%;">Host Company</td>
                                <td>@{{ student.company }}</td>
                            </tr>
                            <tr>
                                <td>Position</td>
                                <td>@{{ student.position }}</td>
                            </tr>
                            <tr>
                                <td>Location</td>
                                <td>@{{ student.location }}</td>
                            </tr>
                            <tr>
                                <td>Stipend</td>
                                <td>@{{ student.stipend }}</td>
                            </tr>
                            <tr>
                                <td>Visa Sponsor</td>
                                <td>@{{ student.sponsor }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#activity" data-toggle="tab" aria-expanded="true">
                            <label for="" class="control-label">Basic Requirementments</label>
                        </a>
                    </li>
                    <li class="">
                        <a href="#timeline" data-toggle="tab" aria-expanded="false">
                            <label for="" class="control-label">Payment Requirementments</label>
                        </a>
                    </li>
                    <li class="">
                        <a href="#settings" data-toggle="tab" aria-expanded="false">
                            <label for="" class="control-label">Visa Requirementments</label>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="activity">
                        <table class="table table-striped table-bordered table-condensed">
                            <thead>
                                <th style="width: 75%;">Requirements</th>
                                <th class="text-center">Status</th>
                            </thead>
                            <tbody>
                                <tr v-for="requirement in basicRequirements">
                                    <td>@{{ requirement.name }}</td>
                                    <td class="text-center">
                                        <span v-if="requirement.status" style="color: green;" class="fa fa-check"></span>
                                        <span v-else style="color: red;" class="fa fa-remove"></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="timeline">
                        <table class="table table-striped table-bordered table-condensed">
                            <thead>
                            <th style="width: 75%;">Requirements</th>
                            <th class="text-center">Status</th>
                            </thead>
                            <tbody>
                            <tr v-for="requirement in paymentRequirements">
                                <td>@{{ requirement.name }}</td>
                                <td class="text-center">
                                    <span v-if="requirement.status" style="color: green;" class="fa fa-check"></span>
                                    <span v-else style="color: red;" class="fa fa-remove"></span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="settings">
                        <table class="table table-striped table-bordered table-condensed">
                            <thead>
                            <th style="width: 75%;">Requirements</th>
                            <th class="text-center">Status</th>
                            </thead>
                            <tbody>
                            <tr v-for="requirement in visaRequirements">
                                <td>@{{ requirement.name }}</td>
                                <td class="text-center">
                                    <span v-if="requirement.status" style="color: green;" class="fa fa-check"></span>
                                    <span v-else style="color: red;" class="fa fa-remove"></span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
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
            mounted: function() {
                this.loadStudentDetails();
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
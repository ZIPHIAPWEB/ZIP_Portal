@extends('layouts.app')

@section('title', 'Dashboard')

@section('sidenav')
    <li class="{{ Route::currentRouteNamed('dash.superadmin') ? 'active' : '' }}">
        <a href="{{ route('dash.superadmin') }}">
            <i class="fa fa-dashboard"></i> <span><small>Dashboard</small></span>
        </a>
    </li>
    <li class="header">Administrative</li>
    <li class="treeview {{ Route::currentRouteNamed('um.students') ? 'active' : '' }}{{ Route::currentRouteNamed('um.coordinators') ? 'active' : '' }}{{ Route::currentRouteNamed('um.sponsors') ? 'active' : '' }}">
        <a href="#">
            <i class="fa fa-users"></i>
            <span class="text-sm">User Management</span>
            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{ Route::currentRouteNamed('um.students') ? 'active' : '' }}"><a href="{{ route('um.students') }}"><i class="fa fa-circle-o"></i> <span><small>Students</small></span></a></li>
            <li class="{{ Route::currentRouteNamed('um.coordinators') ? 'active' : '' }}"><a href="{{ route('um.coordinators') }}"><i class="fa fa-circle-o"></i> <span><small>Coordinators</small></span></a></li>
            <li class="{{ Route::currentRouteNamed('um.sponsors') ? 'active' : '' }}"><a href="{{ route('um.sponsors') }}"><i class="fa fa-circle-o"></i> <span><small>Visa Sponsors</small></span></a></li>
        </ul>
    </li>
    <li class="treeview {{ Route::currentRouteNamed('ac.role') ? 'active' : '' }}{{ Route::currentRouteNamed('ac.permission') ? 'active' : '' }}">
        <a href="#">
            <i class="fa fa-key"></i>
            <span class="text-sm">Access Control Management</span>
            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{ Route::currentRouteNamed('ac.role') ? 'active' : '' }}"><a href="{{ route('ac.role') }}"><i class="fa fa-circle-o"></i> <small>Roles</small></a></li>
            <li class="{{ Route::currentRouteNamed('ac.permission') ? 'active' : '' }}"><a href="{{ route('ac.permission') }}"><i class="fa fa-circle-o"></i> <small>Permissions</small></a></li>
        </ul>
    </li>
    <li class="{{ Route::currentRouteNamed('sa.events') ? 'active' : '' }}">
        <a href="{{ route('sa.events') }}">
            <i class="fa fa-calendar"></i> <span class="text-sm">Event Management</span>
        </a>
    </li>
    <li>
        <a href="#">
            <i class="fa fa-desktop"></i>
            <span class="text-sm">Website Content Management</span>
        </a>
    </li>
    <li class="header">Settings</li>
    <li class="treeview {{ Route::currentRouteNamed('s.school') ? 'active' : '' }}{{ Route::currentRouteNamed('s.host') ? 'active' : '' }}{{ Route::currentRouteNamed('s.programs') ? 'active' : '' }}{{ Route::currentRouteNamed('s.sponsors') ? 'active' : '' }}">
        <a href="#">
            <i class="fa fa-gear"></i> <span><small>General</small></span>
            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{ Route::currentRouteNamed('s.programs') ? 'active' : '' }}"><a href="{{ route('s.programs') }}"><i class="fa fa-circle-o"></i> <small>Program</small></a></li>
            <li class="{{ Route::currentRouteNamed('s.sponsors') ? 'active' : '' }}"><a href="{{ route('s.sponsors') }}"><i class="fa fa-circle-o"></i> <small>Visa Sponsor</small></a></li>
            <li class="{{ Route::currentRouteNamed('s.host') ? 'active' : '' }}"><a href="{{ route('s.host') }}"><i class="fa fa-circle-o"></i> <small>Host Company</small></a></li>
            <li class="{{ Route::currentRouteNamed('s.school') ? 'active' : '' }}"><a href="{{ route('s.school') }}"><i class="fa fa-circle-o"></i> <small>School</small></a></li>
        </ul>
    </li>
@endsection

@section('content')
    <div id="app" v-cloak>
        <div class="col-md-12">
            <div class="container">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><b>Program Statistics</b></h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="progress-group">
                                    <span class="progress-text">New Applicant</span>
                                    <span class="progress-number">@{{ summary.newApplicant }}/@{{ totalStudents }}</span>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-success" :style="{ width : summary.newApplicant / totalStudents * 100 + '%' }"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="progress-group">
                                    <span class="progress-text">Confirmed</span>
                                    <span class="progress-number">@{{ summary.confirmed }}/@{{ totalStudents }}</span>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-danger" :style="{ width : summary.confirmed / totalStudents * 100 + '%' }"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="progress-group">
                                    <span class="progress-text">Assessed</span>
                                    <span class="progress-number">@{{ summary.assessed }}/@{{ totalStudents }}</span>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-aqua" :style="{ width : summary.assessed / totalStudents * 100 + '%' }"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="progress-group">
                                    <span class="progress-text">Hired</span>
                                    <span class="progress-number">@{{ summary.hired }}/@{{ totalStudents }}</span>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-warning" :style="{ width : summary.hired / totalStudents * 100 + '%' }"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                <div class="progress-group">
                                    <span class="progress-text">For Visa Interview</span>
                                    <span class="progress-number">@{{ summary.forVisaInterview }}/@{{ totalStudents }}</span>
                                    <div class="progress active">
                                        <div class="progress-bar progress-bar-aqua progress-bar-striped" :style="{ width : summary.forVisaInterview / totalStudents * 100 + '%' }"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                <div class="progress-group">
                                    <span class="progress-text">Visa Approved</span>
                                    <span class="progress-number">@{{ summary.visaApproved }}/@{{ totalStudents }}</span>
                                    <div class="progress active">
                                        <div class="progress-bar progress-bar-yellow progress-bar-striped" :style="{ width : summary.visaApproved / totalStudents * 100 + '%' }"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                <div class="progress-group">
                                    <span class="progress-text">Visa Denied</span>
                                    <span class="progress-number">@{{ summary.visaDenied }}/@{{ totalStudents }}</span>
                                    <div class="progress active">
                                        <div class="progress-bar progress-bar-success progress-bar-striped" :style="{ width : summary.visaDenied / totalStudents * 100 + '%' }"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title"><b>Account Statistics</b></h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="progress-group">
                                    <span class="progress-text">Activated Account(s)</span>
                                    <span class="progress-number">@{{ accounts.activated }}/@{{ accounts.totalUsers }}</span>
                                    <div class="progress active">
                                        <div class="progress-bar progress-bar-success progress-bar-striped" :style="{ width :  accounts.activated / accounts.totalUsers * 100 + '%' }"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="progress-group">
                                    <span class="progress-text">Not Yet Activated Account(s)</span>
                                    <span class="progress-number">@{{ accounts.unactivated }}/@{{ accounts.totalUsers }}</span>
                                    <div class="progress active">
                                        <div class="progress-bar progress-bar-warning progress-bar-striped" :style="{ width :  accounts.unactivated / accounts.totalUsers * 100 + '%' }"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()

@section('script')
    <script>
        const app = new Vue({
            el: '#app',
            data: {
                totalStudents: 0,
                summary: {
                    newApplicant: 0,
                    assessed: 0,
                    confirmed: 0,
                    hired: 0,
                    forVisaInterview: 0,
                    visaApproved: 0,
                    visaDenied: 0
                },
                accounts: {
                    totalUsers: 0,
                    activated: 0,
                    unactivated: 0
                }
            },
            mounted: function () {
                this.TotalApplicants();
                this.CountApplicants('New Applicant');
                this.CountApplicants('Assessed');
                this.CountApplicants('Confirmed');
                this.CountApplicants('Hired');
                this.CountApplicants('For Visa Interview');
                this.CountApplicants('Approved');
                this.CountApplicants('Denied');

                this.CountUsers('All', 'student');
                this.CountUsers(1, 'student');
                this.CountUsers(0, 'student');
            },
            methods: {
                TotalApplicants () {
                    axios.get(`/helper/applicant/All`)
                        .then((response) => {
                            this.totalStudents = response.data;
                        })
                },
                CountApplicants (status) {
                    axios.get(`/helper/${status}/All`)
                        .then((response) => {
                            switch (status) {
                                case 'New Applicant':
                                    this.summary.newApplicant = response.data;
                                    break;
                                case 'Assessed':
                                    this.summary.assessed = response.data;
                                    break;
                                case 'Confirmed':
                                    this.summary.confirmed = response.data;
                                    break;
                                case 'Hired':
                                    this.summary.hired = response.data;
                                    break;
                                case 'For Visa Interview':
                                    this.summary.forVisaInterview = response.data;
                                    break;
                                case 'Approved':
                                    this.summary.visaApproved = response.data;
                                    break;
                                case 'Denied':
                                    this.summary.visaDenied = response.data;
                                    break;
                            }
                        })
                },
                CountUsers (status, role) {
                    axios.get(`/helper/accounts/${status}/${role}`)
                        .then((response) => {
                            switch (status) {
                                case 1:
                                    this.accounts.activated = response.data;
                                    break;

                                case 0:
                                    this.accounts.unactivated = response.data;
                                    break;
                                default:
                                    this.accounts.totalUsers = response.data;
                                    break;
                            }
                        })
                }
            }
        })
    </script>
@endsection()
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
        </ul>
    </li>
    <li class="{{ Route::currentRouteNamed('sa.events') ? 'active' : '' }}">
        <a href="{{ route('sa.events') }}">
            <i class="fa fa-calendar"></i> <span class="text-sm">Event Management</span>
        </a>
    </li>
    <li class="{{ Route::currentRouteNamed('sa.cms') ? 'active' : '' }}">
        <a href="{{ route('sa.cms') }}">
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
                                    <span class="progress-number">@{{ getNewApplications }}/@{{ getAllStudents }}</span>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-success" :style="{ width : getNewApplications / getAllStudents * 100 + '%' }"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="progress-group">
                                    <span class="progress-text">Called</span>
                                    <span class="progress-number">@{{ getCalled }}/@{{ getAllStudents }}</span>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-danger" :style="{ width : getCalled / getAllStudents * 100 + '%' }"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="progress-group">
                                    <span class="progress-text">Assessed</span>
                                    <span class="progress-number">@{{ getAssessed }}/@{{ getAllStudents }}</span>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-aqua" :style="{ width : getAssessed / getAllStudents * 100 + '%' }"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="progress-group">
                                    <span class="progress-text">Confirmed</span>
                                    <span class="progress-number">@{{ getConfirmed }}/@{{ getAllStudents }}</span>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-warning" :style="{ width : getConfirmed / getAllStudents * 100 + '%' }"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="progress-group">
                                    <span class="progress-text">Hired</span>
                                    <span class="progress-number">@{{ getHired }}/@{{ getAllStudents }}</span>
                                    <div class="progress active">
                                        <div class="progress-bar progress-bar-aqua progress-bar-striped" :style="{ width : getHired / getAllStudents * 100 + '%' }"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="progress-group">
                                    <span class="progress-text">For Visa Interview</span>
                                    <span class="progress-number">@{{ getForVisaInterview }}/@{{ getAllStudents }}</span>
                                    <div class="progress active">
                                        <div class="progress-bar progress-bar-aqua progress-bar-striped" :style="{ width : getForVisaInterview / getAllStudents * 100 + '%' }"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="progress-group">
                                    <span class="progress-text">For PDOS & CFO</span>
                                    <span class="progress-number">@{{ getForPdosCfo }}/@{{ getAllStudents }}</span>
                                    <div class="progress active">
                                        <div class="progress-bar progress-bar-aqua progress-bar-striped" :style="{ width : getForPdosCfo / getAllStudents * 100 + '%' }"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="progress-group">
                                    <span class="progress-text">Program Proper</span>
                                    <span class="progress-number">@{{ getProgramProper }}/@{{ getAllStudents }}</span>
                                    <div class="progress active">
                                        <div class="progress-bar progress-bar-aqua progress-bar-striped" :style="{ width : getProgramProper / getAllStudents * 100 + '%' }"></div>
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
                                    <span class="progress-number">@{{ getVerifiedAccounts }}/@{{ getAllAccounts }}</span>
                                    <div class="progress active">
                                        <div class="progress-bar progress-bar-success progress-bar-striped" :style="{ width :  getVerifiedAccounts / getAllAccounts * 100 + '%' }"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="progress-group">
                                    <span class="progress-text">Not Yet Activated Account(s)</span>
                                    <span class="progress-number">@{{ getUnverifiedAccounts }}/@{{ getAllAccounts }}</span>
                                    <div class="progress active">
                                        <div class="progress-bar progress-bar-warning progress-bar-striped" :style="{ width :  getUnverifiedAccounts / getAllAccounts * 100 + '%' }"></div>
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
                students: [],
                accountss: [],
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
                this.getAllStudentCount();
                this.getAllRegisteredAccounts();
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
            computed: {
                getAllStudents() {
                    return this.students.length;
                },
                getAllAccounts() {
                    return this.accountss.length;
                },
                getVerifiedAccounts() {
                    return this.accountss.filter(e => {
                        return e.verified == 1
                    }).length;
                },
                getUnverifiedAccounts() {
                    return this.accountss.filter(e => {
                        return e.verified == 0;
                    }).length;
                },
                getNewApplications() {
                    return this.students.filter(e => {
                        return e.application_status == 'New Applicant'
                    }).length;
                },
                getCalled() {
                    return this.students.filter(e => {
                        return e.application_status == 'Called'
                    }).length;
                },
                getAssessed() {
                    return this.students.filter(e => {
                        return e.application_status == 'Assessed'
                    }).length;
                },
                getConfirmed() {
                    return this.students.filter(e => {
                        return e.application_status == 'Confirmed'
                    }).length;
                },
                getHired() {
                    return this.students.filter(e => {
                        return e.application_status == 'Hired'
                    }).length;
                },
                getForVisaInterview() {
                    return this.students.filter(e => {
                        return e.application_status == 'For Visa Interview'
                    }).length;
                },
                getForPdosCfo() {
                    return this.students.filter(e => {
                        return e.application_status == 'For PDOS & CFO'
                    }).length;
                },
                getProgramProper() {
                    return this.students.filter(e => {
                        return e.application_status == 'Program Proper'
                    }).length;
                }
            },
            methods: {
                getAllStudentCount() {
                    axios.get(`/helper/getAllStudentCount`)
                        .then((response) => {
                            this.students = response.data;
                        })
                },
                getAllRegisteredAccounts() {
                    axios.get('/helper/getRegisteredAccounts')
                        .then((response) => {
                            this.accountss = response.data;
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
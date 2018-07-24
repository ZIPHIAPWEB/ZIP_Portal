@extends('layouts.app')

@section('title', 'Students')

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
            <i class="fa fa-calendar"></i>
            <span class="text-sm">Event Management</span>
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
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Students</h3>
                </div>
                <div class="box-body">
                    <div class="form-group pull-right">
                        <input v-model="search" type="text" class="form-control input-sm" placeholder="Search Name">
                    </div>
                    <table class="table table-bordered table-striped table-condensed">
                        <thead>
                            <th>Date of Application</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Application ID</th>
                            <th class="text-center">Fullname</th>
                            <th class="text-center">Program</th>
                            <th class="text-center">Course</th>
                            <th class="text-center">Contact</th>
                            <th class="text-center">School</th>
                            <th class="text-center">Activated</th>
                            <th class="text-center">Action</th>
                        </thead>
                        <tbody>
                            <tr v-for="student in students">
                                <td class="text-sm">@{{ student.created_at }}</td>
                                <td class="text-center text-sm"><label class="label label-warning">@{{ student.application_status }}</label></td>
                                <td class="text-center text-sm">@{{ student.application_id }}</td>
                                <td class="text-center text-sm">@{{ student.first_name }} @{{ student.middle_name[0] }}. @{{ student.last_name }}</td>
                                <td class="text-center text-sm">@{{ student.program }}</td>
                                <td class="text-center text-sm">@{{ student.course }}</td>
                                <td class="text-center text-sm">@{{ student.home_number }}/@{{ student.mobile_number }}</td>
                                <td class="text-center text-sm">@{{ student.college }}</td>
                                <td class="text-center">
                                    <span v-if="student.verified === 1" class="fa fa-check text-success"></span>
                                    <span v-else class="fa fa-remove text-danger"></span>
                                </td>
                                <td>
                                    <button @click="ViewStudent(student)" class="btn btn-default btn-flat btn-xs"><span class="glyphicon glyphicon-eye-open"></span></button>
                                    <button @click="DeleteStudent(student.user_id)" class="btn btn-danger btn-flat btn-xs"><span class="glyphicon glyphicon-remove"></span></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer clearfix">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        <li>
                            <a @click="PreviousPage()" href="#">«</a>
                        </li>
                        <li>
                            <a>@{{ meta.current_page }}</a>
                        </li>
                        <li>
                            <a>to</a>
                        </li>
                        <li>
                            <a>@{{ meta.last_page }}</a>
                        </li>
                        <li>
                            <a @click="NextPage()" href="#">»</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="modal fade" id="student-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab-profile" data-toggle="tab" aria-expanded="true">Profile</a>
                                </li>
                                <li>
                                    <a href="#tab-basic-req" data-toggle="tab" aria-expanded="true">Basic Requirements</a>
                                </li>
                                <li>
                                    <a href="#tab-payment-req" data-toggle="tab" aria-expanded="true">Payment Requirements</a>
                                </li>
                                <li>
                                    <a href="#tab-visa-req" data-toggle="tab" aria-expanded="true">Visa Requirements</a>
                                </li>
                                <li>
                                    <a href="#tab-coordinator-actions" data-toggle="tab" aria-expanded="true">Coordinator's Actions</a>
                                </li>
                                <li>
                                    <a href="#tab-recent-activities" data-toggle="tab" aria-expanded="true">Recent Activities</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active m-t-10" id="tab-profile">
                                    <section id="application-status">
                                        <table class="table table-striped table-bordered table-condensed">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 35%;">Application ID</td>
                                                    <td class="text-sm text-center text-bold text-green">@{{ student.application_id }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <label class="control-label">Application Details</label>
                                        <table class="table table-striped table-bordered table-condensed">
                                            <tbody>
                                            <tr>
                                                <td class="text-sm" style="width: 35%;">Application Status</td>
                                                <td class="text-bold text-sm">@{{ student.application_status }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">Visa Interview Status</td>
                                                <td class="text-bold text-sm">@{{ student.visa_interview_status }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </section>
                                    <section id="personal-details">
                                        <label class="control-label">Personal Details</label>
                                        <table class="table table-striped table-bordered table-condensed">
                                            <tbody>
                                                <tr>
                                                    <td class="text-sm" style="width: 35%">Fullname</td>
                                                    <td class="text-bold text-sm">@{{ student.first_name }} @{{ student.last_name }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-sm">Birthdate</td>
                                                    <td class="text-bold text-sm">@{{ student.birthdate }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-sm">Gender</td>
                                                    <td class="text-bold text-sm">@{{ student.gender }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-sm">Address</td>
                                                    <td class="text-bold text-sm">@{{ student.address }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-sm">Home Number</td>
                                                    <td class="text-bold text-sm">@{{ student.home_number }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-sm">Mobile Number</td>
                                                    <td class="text-bold text-sm">@{{ student.mobile_number }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-sm">Skype</td>
                                                    <td class="text-bold text-sm">@{{ student.skype_id }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-sm">Facebook Email</td>
                                                    <td class="text-bold text-sm">@{{ student.fb_email }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </section>
                                    <section id="school-details">
                                        <label class="control-label">School Details</label>
                                        <table class="table table-striped table-bordered table-condensed">
                                            <tbody>
                                                <tr>
                                                    <td class="text-sm" style="width: 35%">College</td>
                                                    <td class="text-bold text-sm">@{{ student.college }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-sm">Course</td>
                                                    <td class="text-bold text-sm">@{{ student.course }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-sm">Year Level</td>
                                                    <td class="text-bold text-sm">@{{ student.year }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </section>
                                    <section id="host-company">
                                        <label class="control-label">Host Company Details</label>
                                        <table class="table table-striped table-bordered table-condensed">
                                            <tbody>
                                                <tr>
                                                    <td class="text-sm" style="width: 35%">Host Company</td>
                                                    <td class="text-bold text-sm">@{{ student.company }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-sm">Position</td>
                                                    <td class="text-bold text-sm">@{{ student.position }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-sm">Start Date</td>
                                                    <td class="text-bold text-sm">@{{ student.program_start_date }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-sm">End Date</td>
                                                    <td class="text-bold text-sm">@{{ student.program_end_date }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-sm">Stipend</td>
                                                    <td class="text-bold text-sm">@{{ student.stipend }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-sm">Visa Sponsor</td>
                                                    <td class="text-bold text-sm">@{{ student.sponsor }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </section>
                                    <section id="visa-interview">
                                        <label class="control-label">Visa Interview Details</label>
                                        <table class="table table-striped table-bordered table-condensed">
                                            <tbody>
                                                <tr>
                                                    <td class="text-sm" style="width: 35%;">Program ID Number</td>
                                                    <td class="text-bold text-sm">@{{ student.program_id_no }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-sm">SEVIS ID</td>
                                                    <td class="text-bold text-sm">@{{ student.sevis_id }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-sm">Interview Schedule</td>
                                                    <td class="text-bold text-sm">@{{ student.visa_interview_schedule }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </section>
                                    <section id="flight-details">
                                        <label class="control-label">Flight Details</label>
                                        <table class="table table-striped table-bordered table-condensed">
                                            <tbody>
                                                <tr>
                                                    <td class="text-sm" style="width: 35%;">Departure Date</td>
                                                    <td class="text-bold text-sm">@{{ student.date_of_departure }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-sm">Arrival Date</td>
                                                    <td class="text-bold text-sm">@{{ student.date_of_arrival }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </section>
                                </div>
                                <div class="tab-pane m-t-10" id="tab-basic-req">
                                    <table class="table table-striped table-bordered table-condensed">
                                        <thead>
                                            <th style="width: 50%;">Requirements</th>
                                            <th class="text-center">Status</th>
                                        </thead>
                                        <tbody>
                                            <tr v-for="requirement in requirements.basic">
                                                <td class="text-sm">@{{ requirement.name }}</td>
                                                <td class="text-center">
                                                    <span v-if="requirement.status" class="fa fa-check text-green"></span>
                                                    <span v-else class="fa fa-remove text-red"></span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane m-t-10" id="tab-payment-req">
                                    <table class="table table-striped table-bordered table-condensed">
                                        <thead>
                                        <th style="width: 50%;">Requirements</th>
                                        <th class="text-center">Status</th>
                                        </thead>
                                        <tbody>
                                            <tr v-for="requirement in requirements.payment">
                                                <td class="text-sm">@{{ requirement.name }}</td>
                                                <td class="text-center">
                                                    <span v-if="requirement.status" class="fa fa-check text-green"></span>
                                                    <span v-else class="fa fa-remove text-red"></span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane m-t-10" id="tab-visa-req">
                                    <table class="table table-striped table-bordered table-condensed">
                                        <thead>
                                        <th style="width: 50%;">Requirements</th>
                                        <th class="text-center">Status</th>
                                        </thead>
                                        <tbody>
                                            <tr v-for="requirement in requirements.visa">
                                                <td class="text-sm">@{{ requirement.name }}</td>
                                                <td class="text-center">
                                                    <span v-if="requirement.status" class="fa fa-check text-green"></span>
                                                    <span v-else class="fa fa-remove text-red"></span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane m-t-10" id="tab-coordinator-actions">
                                    <table class="table table-striped table-bordered table-condensed">
                                        <thead>
                                            <th>Coordinator</th>
                                            <th class="text-center">Logs</th>
                                            <th class="text-center">Action</th>
                                        </thead>
                                        <tbody>
                                            <tr v-if="actions.length === 0">
                                                <td valign="top" colspan="15" class="text-center">No Records</td>
                                            </tr>
                                            <tr v-else v-for="item in actions">
                                                <td class="text-sm">@{{ item.firstName }} @{{ item.lastName }}</td>
                                                <td class="text-center text-sm">@{{ item.actions }}</td>
                                                <td class="text-center">
                                                    <button class="btn btn-default btn-flat btn-xs"><span class="glyphicon glyphicon-trash"></span></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane m-t-10" id="tab-recent-activities">
                                    <table class="table table-striped table-bordered table-condensed">
                                        <thead>
                                            <th style="width: 75%">Activity Logs</th>
                                            <th class="text-center">Action</th>
                                        </thead>
                                        <tbody>
                                            <tr v-if="logs.length === 0">
                                                <td valign="top" colspan="15" class="text-center">No Records</td>
                                            </tr>
                                            <tr v-else v-for="log in logs">
                                                <td class="text-sm">@{{ log.activity }}</td>
                                                <td class="text-center">
                                                    <button class="btn btn-default btn-flat btn-xs"><span class="glyphicon glyphicon-trash"></span></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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
                student: {},
                links: [],
                meta: [],
                requirements: {
                    basic: [],
                    payment: [],
                    visa: []
                },
                actions: [],
                logs: [],
                search: ''
            },
            watch: {
                search: function (value) {
                    if (value) {
                        this.FilterStudents(value);
                    } else {
                        this.LoadStudents();
                    }
                }
            },
            mounted () {
                this.LoadStudents();
            },
            methods: {
                PreviousPage: function () {
                    axios.get(this.links.prev)
                        .then((response) => {
                            this.students = response.data.data;
                            this.links = response.data.links;
                            this.meta = response.data.meta;
                        })
                },
                NextPage: function () {
                    axios.get(this.links.next)
                        .then((response) => {
                            this.students = response.data.data;
                            this.links = response.data.links;
                            this.meta = response.data.meta;
                        })
                },
                LoadStudents: function () {
                    axios.get(`/stud/show`)
                        .then((response) => {
                            this.students = response.data.data;
                            this.links = response.data.links;
                            this.meta = response.data.meta
                        })
                },
                FilterStudents: function (lastName) {
                    axios.get(`/filter/sa/student/${lastName}`)
                        .then((response) => {
                            this.students = response.data.data;
                            this.links = response.data.links;
                            this.meta = response.data.meta;
                        })
                },
                ViewStudent: function (student) {
                    this.student = student;
                    this.ViewBasicRequirements(student.program_id, student.user_id);
                    this.ViewPaymentRequirements(student.program_id, student.user_id);
                    this.ViewVisaRequirements(student.visa_sponsor_id, student.user_id);
                    this.ViewCoordinatorActions(student.user_id);
                    this.ViewActivityLogs(student.user_id);
                    $('#student-modal').modal('show');
                },
                ViewBasicRequirements: function (programId, userId) {
                    axios.get(`/coor/requirement/basic/${programId}/${userId}`)
                        .then((response) => {
                            this.requirements.basic = response.data.data;
                        })
                },
                ViewPaymentRequirements: function (programId, userId) {
                    axios.get(`/coor/requirement/payment/${programId}/${userId}`)
                        .then((response) => {
                            this.requirements.payment = response.data.data;
                        })
                },
                ViewVisaRequirements: function (sponsorId, userId) {
                    axios.get(`/coor/requirement/visa/${sponsorId}/${userId}`)
                        .then((response) => {
                            this.requirements.visa = response.data.data;
                        })
                },
                ViewCoordinatorActions: function (userId) {
                    axios.get(`/sa/coor/actions/view/student/${userId}`)
                        .then((response) => {
                            this.actions = response.data.data;
                        })
                },
                ViewActivityLogs: function (userId) {
                    axios.get(`/sa/activity/logs/${userId}`)
                        .then((response) => {
                            this.logs = response.data.data;
                        })
                },
                DeleteStudent: function (id) {
                    alert(id);
                }
            }
        })
    </script>
@endsection()
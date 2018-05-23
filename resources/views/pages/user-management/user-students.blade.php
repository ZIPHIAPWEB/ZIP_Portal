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
            <span><small>User Management</small></span>
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
            <span><small>Access Control Management</small></span>
            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{ Route::currentRouteNamed('ac.role') ? 'active' : '' }}"><a href="{{ route('ac.role') }}"><i class="fa fa-circle-o"></i> <small>Roles</small></a></li>
            <li class="{{ Route::currentRouteNamed('ac.permission') ? 'active' : '' }}"><a href="{{ route('ac.permission') }}"><i class="fa fa-circle-o"></i> <small>Permissions</small></a></li>
        </ul>
    </li>
    <li>
        <a href="#">
            <i class="fa fa-desktop"></i> <span><small>Website Content Management</small></span>
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
    <div id="app">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <b>Students</b>
                </div>
                <div class="box-body">
                    <table class="table table-condensed table-striped table-bordered">
                        <thead>
                            <th>#</th>
                            <th>Date of Application</th>
                            <th>Application Status</th>
                            <th>Application ID</th>
                            <th>Fullname</th>
                            <th>College</th>
                            <th>Course</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <tr v-for="student in students.data">
                                <td v-text="student.user_id"></td>
                                <td v-text="student.created_at"></td>
                                <td v-text="student.application_status"></td>
                                <td v-text="student.application_id"></td>
                                <td>
                                    <label v-text="student.first_name"></label>&nbsp;
                                    <label v-text="student.middle_name[0]"></label>&nbsp;
                                    <label v-text="student.last_name"></label>
                                </td>
                                <td v-text="student.school"></td>
                                <td v-text="student.home_number"></td>
                                <td v-text="student.home_number"></td>
                                <td v-text="student.email"></td>
                                <td v-text="student.verified === 1 ? 'Activated' : 'Not Yet Activated'" class="text-bold"></td>
                                <td>
                                    <button @click="viewStudent(student.user_id)" class="btn btn-default btn-flat btn-xs"><span class="glyphicon glyphicon-eye-open"></span>&nbsp; View</button>&nbsp;
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer clearfix">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        <li>
                            <a @click="previous()">«</a>
                        </li>
                        <li>
                            <a v-text="current_page"></a>
                        </li>
                        <li>
                            <a>of</a>
                        </li>
                        <li>
                            <a v-text="last_page"></a>
                        </li>
                        <li>
                            <a @click="next()">»</a>
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
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active m-t-10" id="tab-profile">
                                    <label class="control-label">Application Status</label>
                                    <table class="table table-condensed table-striped table-bordered">
                                        <tbody>
                                        <tr>
                                            <td style="width: 200px">
                                                Application Status
                                            </td>
                                            <td v-cloak class="text-bold text-center">
                                                @{{ student.application_status }}
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-primary btn-flat btn-xs">Assessed</button>
                                                <button class="btn btn-info btn-flat btn-xs">Confirmed</button>
                                                <button class="btn btn-success btn-flat btn-xs">Hired</button>
                                                <button class="btn btn-default btn-flat btn-xs">For Visa Interview</button>
                                                <button class="btn btn-warning btn-flat btn-xs">Cancel</button>
                                                <button class="btn btn-danger btn-flat btn-xs">Denied</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Visa Interview Status
                                            </td>
                                            <td v-cloak class="text-bold text-center">
                                                @{{ student.visa_interview_status }}
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-success btn-flat btn-xs">Approved</button>
                                                <button class="btn btn-danger btn-flat btn-xs">Denied</button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <label class="control-label">Personal Details</label>
                                    <table class="table table-condensed table-striped table-bordered">
                                        <tbody>
                                        <tr>
                                            <td style="width: 200px">
                                                Fullname
                                            </td>
                                            <td v-cloak class="text-bold">
                                                @{{ student.last_name }}, @{{ student.first_name }} @{{ student.middle_name }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Birth Date
                                            </td>
                                            <td v-cloak class="text-bold">
                                                @{{ student.birthdate }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Gender
                                            </td>
                                            <td v-cloak class="text-bold">
                                                @{{ student.gender }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Address
                                            </td>
                                            <td v-cloak class="text-bold">
                                                @{{ student.address }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Home Number
                                            </td>
                                            <td v-cloak class="text-bold">
                                                @{{ student.home_number }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Mobile Number
                                            </td>
                                            <td v-cloak class="text-bold">
                                                @{{ student.mobile_number }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Skype
                                            </td>
                                            <td v-cloak class="text-bold">
                                                @{{ student.skype_id }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Facebook Email
                                            </td>
                                            <td v-cloak class="text-bold">
                                                @{{ student.fb_email }}
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <label class="control-label">School Details</label>
                                    <table class="table table-striped table-bordered table-condensed">
                                        <tr>
                                            <td style="width: 200px">
                                                College
                                            </td>
                                            <td v-cloak class="text-bold">
                                                @{{ student.school }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Course
                                            </td>
                                            <td v-cloak class="text-bold">
                                                @{{ student.course }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Year Level
                                            </td>
                                            <td v-cloak class="text-bold">
                                                @{{ student.year }}
                                            </td>
                                        </tr>
                                    </table>
                                    <label class="control-label">Visa Interview Details</label>
                                    <table class="table table-striped table-bordered table-condensed">
                                        <tr>
                                            <td style="width: 200px">
                                                Program ID Number
                                            </td>
                                            <td v-cloak class="text-bold">
                                                @{{ student.program_id_no }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                SEVIS ID
                                            </td>
                                            <td v-cloak class="text-bold">
                                                @{{ student.sevis_id }}
                                            </td>
                                        </tr>
                                    </table>
                                    <label class="control-label">Host Company Details</label>
                                    <table class="table table-striped table-bordered table-condensed">
                                        <tr>
                                            <td style="width: 200px">
                                                Host Company
                                            </td>
                                            <td v-cloak class="text-bold">
                                                @{{ student.host_company_id }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Position
                                            </td>
                                            <td v-cloak class="text-bold">
                                                @{{ student.position }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Start Date</td>
                                            <td>@{{ student.program_start_date }}</td>
                                        </tr>
                                        <tr>
                                            <td>End Date</td>
                                            <td>@{{ student.program_end_date }}</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Stipend
                                            </td>
                                            <td v-cloak class="text-bold">
                                                @{{ student.stipend }}
                                            </td>
                                        </tr>
                                    </table>
                                    <label class="control-label">Flight Details</label>
                                    <table class="table table-striped table-bordered table-condensed">
                                        <tr>
                                            <td style="width: 200px">
                                                Departure Date
                                            </td>
                                            <td v-cloak class="text-bold">
                                                @{{ student.date_of_departure }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Arrival Date
                                            </td>
                                            <td v-cloak class="text-bold">
                                                @{{ student.date_of_arrival }}
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="tab-pane" id="tab-basic-req">
                                    <table class="table table-condensed table-striped table-bordered">
                                        <thead>
                                        <th>
                                            Requirement
                                        </th>
                                        <th class="text-center">
                                            Status
                                        </th>
                                        <th class="text-center">
                                            Action
                                        </th>
                                        </thead>
                                        <tbody>
                                        <tr v-for="requirement in basicRequirements">
                                            <td>@{{ requirement.name }}</td>
                                            <td class="text-center">
                                                <span v-if="requirement.status" class="fa fa-check text-green"></span>
                                                <span v-else class="fa fa-times text-red"></span>
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-default btn-flat btn-xs"><span class="fa fa-eye"></span> View</button>
                                                <button @click="downloadBasicRequirement(requirement.bReqId)" class="btn btn-primary btn-flat btn-xs"><span class="fa fa-download"></span> Download</button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane " id="tab-payment-req">
                                    <table class="table table-condensed table-striped table-bordered">
                                        <thead>
                                        <th>
                                            Requirement
                                        </th>
                                        <th class="text-center">
                                            Status
                                        </th>
                                        <th class="text-center">
                                            Action
                                        </th>
                                        </thead>
                                        <tbody>
                                        <tr v-for="requirement in paymentRequirements">
                                            <td>@{{ requirement.name }}</td>
                                            <td class="text-center">
                                                <span v-if="requirement.status" class="fa fa-check text-green"></span>
                                                <span v-else class="fa fa-times text-red"></span>
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-default btn-flat btn-xs"><span class="fa fa-eye"></span> View</button>
                                                <button @click="downloadPaymentRequirement(requirement.bReqId)" class="btn btn-primary btn-flat btn-xs"><span class="fa fa-download"></span> Download</button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane " id="tab-visa-req">
                                    <table class="table table-condensed table-striped table-bordered">
                                        <thead>
                                        <th>
                                            Requirement
                                        </th>
                                        <th class="text-center">
                                            Status
                                        </th>
                                        <th class="text-center">
                                            Action
                                        </th>
                                        </thead>
                                        <tbody>
                                        <tr v-for="requirement in visaRequirements">
                                            <td>@{{ requirement.name }}</td>
                                            <td class="text-center">
                                                <span v-if="requirement.status" class="fa fa-check text-green"></span>
                                                <span v-else class="fa fa-times text-red"></span>
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-default btn-flat btn-xs"><span class="fa fa-eye"></span> View</button>
                                                <button @click="downloadVisaRequirement(requirement.bReqId)" class="btn btn-primary btn-flat btn-xs"><span class="fa fa-download"></span> Download</button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
@endsection()

@section('script')
    <script>
        const app = new Vue({
            el: '#app',
            data: {
                student: [],
                students: [],
                links: [],
                current_page: '',
                last_page: ''
            },
            mounted: function() {
                this.loadStudents();
            },
            methods: {
                previous() {
                    axios(this.links.prev)
                        .then((response) => {
                            this.students = response.data;
                            this.links = response.data.links;
                            this.current_page = response.data.meta.current_page;
                            this.last_page = response.data.meta.last_page;
                        }).catch((error) => {
                            console.log(error);
                    });
                },
                next() {
                    axios(this.links.next)
                        .then((response) => {
                            this.students = response.data;
                            this.links = response.data.links;
                            this.current_page = response.data.meta.current_page;
                            this.last_page = response.data.meta.last_page;
                        }).catch((error) => {
                        console.log(error);
                    });
                },
                loadStudents() {
                    axios('/stud/show')
                        .then((response) => {
                            this.students = response.data;
                            this.links = response.data.links;
                            this.current_page = response.data.meta.current_page;
                            this.last_page = response.data.meta.last_page;
                        }).catch((error) => {
                            console.log(error);
                    });
                },
                viewStudent(id) {
                    axios(`/stud/view/${id}`)
                        .then((response) => {
                            this.student = response.data.data;
                        }).catch((error) => {
                            console.log(error);
                    });
                    $('#student-modal').modal('show');
                }
            }
        })
    </script>
@endsection()
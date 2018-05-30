@extends('layouts.app')

@section('title', \App\Program::find($program)->name . ' Program')

@section('sidenav')
    <li class="header">General</li>
    <li>
        <a href="{{ route('dash.coordinator') }}">
            <i class="fa fa-dashboard"></i> <span><small>Dashboard</small></span>
        </a>
    </li>
    <li class="header">Program</li>
    <li class="treeview" id="coordinator">
        <a href="#">
            <i class="fa fa-key"></i>
            <span><small>Student's Program(s)</small></span>
            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
        </a>
        <ul class="treeview-menu" >
            <li v-for="program in programs"><a :href="url + program.id"><i class="fa fa-circle-o"></i><small>@{{ program.name }}</small></a></li>
        </ul>
    </li>
@endsection

@section('content')
    <div id="app">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title text-center">{{ \App\Program::find($program)->name }} Students</h3>
                </div>
                <div class="box-body">
                    <form action="" class="form-inline pull-left m-b-10">
                        <div class="form-group-sm pull-left">
                            <label for="" class="control-label">Filter By</label>
                            <select v-model="filterStatus" class="form-control">
                                <option value="" selected>All</option>
                                <option value="New Applicant">New Applicant</option>
                                <option value="Assessed">Assessed</option>
                                <option value="Confirmed">Confirmed</option>
                                <option value="Hired">Hired</option>
                                <option value="For Visa Interview">For Visa Interview</option>
                            </select>
                        </div>
                    </form>
                    <div class="form-group-sm pull-right">
                        <input v-model="filterName" type="text" class="form-control" placeholder="Search By Name">
                    </div>
                    <table class="table table-bordered table-striped table-condensed">
                        <thead>
                            <td>Date of Application</td>
                            <td>Status</td>
                            <td>Application ID</td>
                            <td>Full Name</td>
                            <td>Program</td>
                            <td>Course</td>
                            <td>Contact</td>
                            <td>School</td>
                            <td>Recent Activity</td>
                            <td>Action</td>
                        </thead>
                        <tbody>
                            <tr v-for="student in students">
                                <td>@{{ student.created_at }}</td>
                                <td>@{{ student.application_status }}</td>
                                <td>@{{ student.application_id }}</td>
                                <td>@{{ student.first_name }}&nbsp;@{{ student.middle_name[0] }}.&nbsp; @{{ student.last_name }}</td>
                                <td>@{{ student.program }}</td>
                                <td>@{{ student.course }}</td>
                                <td>@{{ student.mobile_number }}/@{{ student.home_number }}</td>
                                <td>@{{ student.school }}</td>
                                <td></td>
                                <td>
                                    <button @click="viewStudent(student.user_id)" class="btn btn-default btn-flat btn-xs">View</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        <li>
                            <a @click="next()" href="#">«</a>
                        </li>
                        <li>
                            <a href="#">@{{ current_page }}</a>
                        </li>
                        <li>
                            <a href="#">to</a>
                        </li>
                        <li>
                            <a href="#">@{{ last_page }}</a>
                        </li>
                        <li>
                            <a @click="previous()" href="#">»</a>
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
                                    <table v-if="student.application_id" class="table table-condensed table-striped table-bordered">
                                        <tbody>
                                            <tr>
                                                <td style="width: 25%">
                                                    Application ID
                                                </td>
                                                <td class="text-center text-bold text-green">@{{ student.application_id }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <label class="control-label">Application Status</label>
                                    <table class="table table-condensed table-striped table-bordered">
                                        <tbody>
                                        <tr>
                                            <td style="width: 25%">
                                                Application Status
                                            </td>
                                            <td v-cloak class="text-bold text-center">
                                                <div class="form-group-sm">
                                                    <select @change="setApplicationStatus(appStatus)" v-model="appStatus" class="form-control">
                                                        <option value="">@{{ student.application_status }}</option>
                                                        <option value="Assessed">Assessed</option>
                                                        <option value="Confirmed">Confirmed</option>
                                                        <option value="Hired">Hired</option>
                                                        <option value="Denied">Denied</option>
                                                        <option value="Canceled">Cancel</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Visa Interview Status
                                            </td>
                                            <td v-cloak class="text-bold text-center">
                                                <div class="form-group-sm">
                                                    <select @change="setInterviewStatus(visaStatus)" v-model="visaStatus" class="form-control">
                                                        <option value="">@{{ student.visa_interview_status }}</option>
                                                        <option value="Approved">Approved</option>
                                                        <option value="Denied">Denied</option>
                                                    </select>
                                                </div>
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
                                            <td v-if="!program_no" v-cloak class="text-bold">
                                                @{{ student.program_id_no }}
                                                <a @click="program_no=true" href="#" class="pull-right"><span class="fa fa-edit"></span></a>
                                            </td>
                                            <td v-else>
                                                <div class="input-group">
                                                    <input :value="student.program_id_no" type="text" class="form-control input-sm">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-primary btn-flat btn-sm">Update</button>
                                                    </span>
                                                    <span class="input-group-btn">
                                                        <button @click="program_no=false" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                SEVIS ID
                                            </td>
                                            <td v-if="!sevis_id" v-cloak class="text-bold">
                                                @{{ student.sevis_id }}
                                                <a @click="sevis_id=true" href="#" class="pull-right"><span class="fa fa-edit"></span></a>
                                            </td>
                                            <td v-else>
                                                <div class="input-group">
                                                    <input :value="student.sevis_id" type="text" class="form-control input-sm">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-primary btn-flat btn-sm">Update</button>
                                                    </span>
                                                    <span class="input-group-btn">
                                                        <button @click="sevis_id=false" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                                    </span>
                                                </div>
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
@endsection

@section('script')
    <script>
        let programId = '{{ $program }}';

        const sidenav = new Vue({
            el: '#sidenav',
            data: {
                url: '/portal/c/program/',
                programs: []
            },
            mounted: function() {
                this.loadPrograms();
            },
            methods: {
                loadPrograms() {
                    axios.get('/helper/program/view')
                        .then((response) => {
                            this.programs = response.data.data;
                        })
                }
            }
        });

        const app = new Vue({
            el: '#app',
            data: {
                students: [],
                student: [],
                basicRequirements: [],
                paymentRequirements: [],
                visaRequirements: [],
                links: [],
                current_page: '',
                last_page: '',
                filterName: '',
                filterStatus: '',
                appStatus: '',
                visaStatus: '',

                program_no: false,
                sevis_id: false,
            },
            mounted: function() {
                this.loadStudents(programId);
            },
            watch: {
                filterName: function() {
                    if (this.filterName) {
                        axios.get(`/filter/student/${programId}/${this.filterName}`)
                            .then((response) => {
                                this.students = response.data.data;
                                this.links = response.data.links;
                                this.current_page = response.data.meta.current_page;
                                this.last_page = response.data.meta.last_page;
                            })
                    } else {
                        this.loadStudents(programId)
                    }
                },
                filterStatus: function() {
                    axios.get(`/filter/status/${programId}/${this.filterStatus}`)
                        .then((response) => {
                            this.students = response.data.data;
                            this.links = response.data.links;
                            this.current_page = response.data.meta.current_page;
                            this.last_page = response.data.meta.last_page;
                        })
                }
            },
            methods: {
                next() {
                    axios.get(this.links.next)
                        .then((response) => {
                            this.students = response.data.data;
                            this.links = response.data.links;
                            this.current_page = response.data.meta.current_page;
                            this.last_page = response.data.meta.last_page;
                        })
                },
                previous() {
                    axios.get(this.links.prev)
                        .then((response) => {
                            this.students = response.data.data;
                            this.links = response.data.links;
                            this.current_page = response.data.meta.current_page;
                            this.last_page = response.data.meta.last_page;
                        })
                },
                loadStudents(programId) {
                    axios.get(`/coor/program/${programId}`)
                        .then((response) => {
                            this.students = response.data.data;
                            this.links = response.data.links;
                            this.current_page = response.data.meta.current_page;
                            this.last_page = response.data.meta.last_page;
                        })
                },
                viewStudent(studentId) {
                    axios.get(`/stud/view/${studentId}`)
                        .then((response) => {
                            this.student = response.data.data;
                            this.loadBasicRequirements(programId, response.data.data.user_id);
                            this.loadPaymentRequirements(programId, response.data.data.user_id);
                            this.loadVisaRequirements(response.data.data.visa_sponsor_id, response.data.data.user_id);
                            $('#student-modal').modal('show');
                        })
                },
                loadBasicRequirements(programId, userId) {
                    axios.get(`/coor/requirement/basic/${programId}/${userId}`)
                        .then((response) => {
                            this.basicRequirements = response.data.data;
                        })
                },
                downloadBasicRequirement(id) {
                    axios.get(`/download/basic/requirement/${id}`)
                        .then((response) => {
                            const link = document.createElement('a');
                            link.href = response.data;
                            link.setAttribute('download', '');
                            document.body.appendChild(link);
                            link.click();
                        })
                },
                loadPaymentRequirements(programId, userId) {
                    axios.get(`/coor/requirement/payment/${programId}/${userId}`)
                        .then((response) => {
                            this.paymentRequirements = response.data.data;
                        })
                },
                downloadPaymentRequirement(id) {
                    axios.get(`/download/payment/requirement/${id}`)
                        .then((response) => {
                            const link = document.createElement('a');
                            link.href = response.data;
                            link.setAttribute('download', '');
                            document.body.appendChild(link);
                            link.click();
                        })
                },
                loadVisaRequirements(sponsorId, userId) {
                    axios.get(`/coor/requirement/visa/${sponsorId}/${userId}`)
                        .then((response) => {
                            this.visaRequirements = response.data.data;
                        })
                },
                downloadVisaRequirement(id) {
                    axios.get(`/download/visa/requirement/${id}`)
                        .then((response) => {
                            const link = document.createElement('a');
                            link.href = response.data;
                            link.setAttribute('download', '');
                            document.body.appendChild(link);
                            link.click();
                        })
                },
                setApplicationStatus(status) {
                    this.appStatus = '';
                    switch (status) {
                        case 'Assessed':
                            axios.post(`/coor/${this.student.user_id}/application/${status}`)
                                .then((response) => {
                                    this.loadStudents(programId);
                                    this.viewStudent(this.student.user_id);
                                    alert(response.data);
                                });
                            break;
                        case 'Confirmed':
                            axios.post(`/coor/${this.student.user_id}/application/${status}`)
                                .then((response) => {
                                    this.loadStudents(programId);
                                    this.viewStudent(this.student.user_id);
                                    alert(response.data);
                                });
                            break;
                        case 'Hired':
                            alert(status);
                            break;
                        case 'For Visa Interview':
                            alert(status);
                            break;
                        case 'Denied':
                            alert(status);
                            break;
                        case 'Canceled':
                            alert(status);
                            break;
                    }
                },
                setInterviewStatus(status) {
                    this.visaStatus = '';
                    switch (status) {
                        case 'Approved':
                            axios.post(`/coor/${this.student.user_id}/visa/${status}`)
                                .then((response) => {
                                    this.loadStudents(programId);
                                    this.viewStudent(this.student.user_id);
                                    alert(response.data);
                                });
                            break;
                        case 'Denied':
                            axios.post(`/coor/${this.student.user_id}/visa/${status}`)
                                .then((response) => {
                                    this.loadStudents(programId);
                                    this.viewStudent(this.student.user_id);
                                    alert(response.data);
                                });
                            break;
                    }
                }
            }
        })
    </script>
@endsection
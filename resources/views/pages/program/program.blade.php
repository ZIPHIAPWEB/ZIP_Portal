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
            <li v-for="program in programs">
                <a :href="url + program.id">
                    <i class="fa fa-circle-o"></i>
                    <small>@{{ program.name }}</small>
                </a>
            </li>
        </ul>
    </li>
@endsection

@section('content')
    <div id="app">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title text-center">{{ \App\Program::find($program)->name }} Students</h3>
                    <div class="pull-right">
                        <button @click="loadStudents()" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-refresh"></span> Refresh</button>
                    </div>
                </div>
                <div class="box-body">
                    <form @submit.prevent="filterStatus()" class="form-inline pull-left m-b-10">
                        <div class="form-group">
                            <label for="" class="control-label">From Date:</label>
                            <input v-model="filter.from" type="date" class="form-control input-sm">
                        </div>&nbsp;
                        <div class="form-group">
                            <label for="" class="control-label">To Date:</label>
                            <input v-model="filter.to" type="date" class="form-control input-sm">
                        </div>&nbsp;
                        <div class="form-group">
                            <label for="" class="control-label">Filter By</label>
                            <select v-model="filter.status" class="form-control input-sm">
                                <option value="" selected>All</option>
                                <option value="New Applicant">New Applicant</option>
                                <option value="Assessed">Assessed</option>
                                <option value="Confirmed">Confirmed</option>
                                <option value="Hired">Hired</option>
                                <option value="For Visa Interview">For Visa Interview</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-flat btn-sm"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                                <download-excel
                                    class="btn btn-success btn-flat btn-sm"
                                    :data="students"
                                    :fields="testField"
                                    name="generated-report-as-of-{{ date('Ymd') }}.xls"
                                    title="ZIP Generated Report">
                                <span class="glyphicon glyphicon-export"></span> Export
                            </download-excel>
                        </div>
                    </form>
                    <div class="form-group-sm pull-right">
                        <input v-model="filterName" type="text" class="form-control" placeholder="Search By Last Name">
                    </div>
                    <table class="table table-bordered table-striped table-condensed">
                        <thead>
                            <th class="text-center" style="width: 10%">Date of Application</th>
                            <th class="text-center" style="width: 10%">Status</th>
                            <th class="text-center" style="width: 10%">Application ID</th>
                            <th class="text-center" style="width: 10%">First Name</th>
                            <th class="text-center" style="width: 10%">Middle Name</th>
                            <th class="text-center" style="width: 10%">Last Name</th>
                            <th class="text-center" style="width: 10%">Contact</th>
                            <th class="text-center" style="width: 10%">School</th>
                            <th class="text-center" style="width: 10%">Program</th>
                            <th class="text-center" style="width: 10%">Recent Action</th>
                            <th class="text-center" style="width: 10%">Action</th>
                        </thead>
                        <tbody v-if="hasRecords">
                            <tr v-if="loading.table">
                                <td valign="top" colspan="15" class="text-center">
                                    <span class="fa fa-circle-o-notch fa-spin"></span>
                                </td>
                            </tr>
                            <tr v-else v-for="student in students">
                                <td class="text-sm text-center">@{{ student.created_at }}</td>
                                <td class="text-center"><span class="label label-warning label-sm">@{{ student.application_status }}</span></td>
                                <td class="text-sm text-center">@{{ student.application_id }}</td>
                                <td class="text-sm text-center">@{{ student.first_name }}</td>
                                <td class="text-sm text-center">@{{ student.middle_name }}</td>
                                <td class="text-sm text-center">@{{ student.last_name }}</td>
                                <td class="text-sm text-center">@{{ student.mobile_number }}/@{{ student.home_number }}</td>
                                <td class="text-sm text-center">@{{ student.tertiary.school_name }}</td>
                                <td class="text-sm text-center">@{{ student.program.display_name }}</td>
                                <td class="text-sm text-center">
                                    <div v-if="!student.log[0]">
                                        No Recent Actions
                                    </div>
                                    <div v-else>
                                        @{{ student.log[0].activity }}
                                    </div>
                                </td>
                                <td class="text-center">
                                    <button @click="viewStudent(student.user_id)" class="btn btn-default btn-flat btn-xs">View</button>
                                </td>
                            </tr>
                        </tbody>
                        <tbody v-else>
                            <tr>
                                <td valign="top" colspan="15" class="text-center">
                                    No Records
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
        <div class="modal fade" id="student-modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="overlay-wrapper">
                        <div class="overlay" :style="{ display: loading.modal ? 'block' : 'none' }">
                            <i class="fa fa-circle-o-notch fa-spin"></i>
                        </div>
                    </div>
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
                                    <a href="#tab-basic-req" data-toggle="tab" aria-expanded="true">Preliminary</a>
                                </li>
                                <li>
                                    <a href="#tab-payment-req" data-toggle="tab" aria-expanded="true">Payment</a>
                                </li>
                                <li>
                                    <a href="#tab-additional-req" data-toggle="tab" aria-expanded="true">Additional</a>
                                </li>
                                <li>
                                    <a href="#tab-visa-req" data-toggle="tab" aria-expanded="true">Visa</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active m-t-10" id="tab-profile">
                                    <section id="application-id">
                                        <table v-if="student.application_id" class="table table-condensed table-striped table-bordered">
                                            <tbody>
                                            <tr>
                                                <td class="text-sm" style="width: 25%">
                                                    Application ID
                                                </td>
                                                <td class="text-center text-bold text-green text-sm">@{{ student.application_id }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </section>
                                    <section id="application-status">
                                        <label class="control-label">Application Status</label>
                                        <table class="table table-condensed table-striped table-bordered">
                                            <tbody>
                                            <tr>
                                                <td class="text-sm" style="width: 25%">
                                                    Application Status
                                                </td>
                                                <td v-cloak class="text-bold text-center">
                                                    <div class="form-group-sm">
                                                        <select @change="setApplicationStatus(appStatus)" v-model="appStatus" class="form-control">
                                                            <option value="">@{{ student.application_status }}</option>
                                                            <option value="Assessed">Assessed</option>
                                                            <option value="Confirmed">Confirmed</option>
                                                            <option value="Hired">Hired</option>
                                                            <option value="For Visa Interview">For Visa Interview</option>
                                                            <option value="Canceled">Cancel</option>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr v-if="student.application_status === 'For Visa Interview'">
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
                                    </section>
                                    <transition name="slide-fade">
                                        <section v-if="show.assessed">
                                            <div class="box box-primary">
                                                <div class="box-header">
                                                    <div class="box-tools pull-right">
                                                        <button @click="show.assessed = false" class="btn btn-box-tool">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="box-body">
                                                    <div class="form-group col-xs-12">
                                                        <label for="" class="control-label">Assessment Status</label>
                                                        <select class="form-control input-sm">
                                                            <option value="">Select status</option>
                                                            <option value="Passed">Passed</option>
                                                            <option value="Failed">Failed</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-xs-12">
                                                        <label for="" class="control-label">Assessment Message</label>
                                                        <textarea cols="30" rows="10" class="form-control" placeholder="Message"></textarea>
                                                    </div>
                                                    <div class="form-group col-xs-12">
                                                        <button @click="submitAssessed()" class="btn btn-primary btn-block btn-flat btn-sm">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <section v-if="show.hired">
                                            <div class="box box-primary">
                                                <div class="box-header">
                                                    <div class="box-tools pull-right">
                                                        <button @click="show.hired = false" class="btn btn-box-tool">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="box-body">
                                                    <div class="form-group col-xs-6">
                                                        <label for="" class="control-label">Host Company</label>
                                                        <select v-model="host.name" class="form-control input-sm">
                                                            <option value="">Select Host Company</option>
                                                            <option v-for="host in hosts" :value="host.id">@{{ host.name }}</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-xs-6">
                                                        <label for="" class="control-label">Position</label>
                                                        <input v-model="host.position" type="text" class="form-control input-sm" placeholder="Position">
                                                    </div>
                                                    <div class="form-group col-xs-6">
                                                        <label class="control-label">Place of Assignment</label>
                                                        <select v-model="host.place" class="form-control input-sm">
                                                            <option value="">Select Place of Assignment</option>
                                                            <option v-for="state in states" :value="state.display_name">@{{ state.name }}</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-xs-6">
                                                        <label class="control-label">Housing Address</label>
                                                        <input v-model="host.housing" type="text" class="form-control input-sm" placeholder="Housing address">
                                                    </div>
                                                    <div class="form-group col-xs-6">
                                                        <label class="control-label">Start Date</label>
                                                        <input v-model="host.start" type="date" class="form-control input-sm">
                                                    </div>
                                                    <div class="form-group col-xs-6">
                                                        <label class="control-label">End Date</label>
                                                        <input v-model="host.end" type="date" class="form-control input-sm">
                                                    </div>
                                                    <div class="form-group col-xs-6">
                                                        <label class="control-label">Stipend</label>
                                                        <input v-model="host.stipend" type="text" class="form-control input-sm" placeholder="Stipend">
                                                    </div>
                                                    <div class="form-group col-xs-6">
                                                        <label class="control-label">Visa Sponsor</label>
                                                        <select v-model="host.sponsor" class="form-control input-sm">
                                                            <option value="" selected>Select Visa Sponsor</option>
                                                            <option v-for="sponsor in sponsors" :value="sponsor.id">@{{ sponsor.name }}</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-xs-12">
                                                        <button @click="submitHostCompany" class="btn btn-primary btn-sm btn-flat btn-block">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <section v-if="show.visa">
                                            <div class="box box-primary">
                                                <div class="box-header">
                                                    <div class="box-tools pull-right">
                                                        <button @click="show.visa = false" class="btn btn-box-tool">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="box-body">
                                                    <div class="form-group col-xs-6">
                                                        <label class="label-control">SEVIS ID</label>
                                                        <input v-model="visa.sevis" type="text" class="form-control input-sm" placeholder="Enter the SEVIS ID">
                                                    </div>
                                                    <div class="form-group col-xs-6">
                                                        <label class="control-label">Program ID</label>
                                                        <input v-model="visa.programId" type="text" class="form-control input-sm" placeholder="Enter the Program ID">
                                                    </div>
                                                    <div class="form-group col-xs-12">
                                                        <label class="control-label">Interview Schedule</label>
                                                        <input v-model="visa.schedule" type="date" class="form-control input-sm">
                                                    </div>
                                                    <div class="form-group-sm col-xs-12">
                                                        <button @click="submitForVisaInterview()" class="btn btn-primary btn-flat btn-block btn-sm">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </transition>
                                    <section id="personal-details">
                                        <label class="control-label">Personal Details</label>
                                        <table class="table table-condensed table-striped table-bordered">
                                            <tbody>
                                            <tr>
                                                <td class="text-sm" style="width: 200px">
                                                    Fullname
                                                </td>
                                                <td v-cloak class="text-sm text-bold">
                                                    @{{ student.last_name }}, @{{ student.first_name }} @{{ student.middle_name }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Birth Date
                                                </td>
                                                <td v-cloak class="text-sm text-bold">
                                                    @{{ student.birthdate | toFormattedDateString}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Gender
                                                </td>
                                                <td v-cloak class="text-sm text-bold">
                                                    @{{ student.gender }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Present Address
                                                </td>
                                                <td v-cloak class="text-sm text-bold">
                                                    @{{ student.permanent_address }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Permanent Address
                                                </td>
                                                <td v-cloak class="text-sm text-bold">
                                                    @{{ student.provincial_address }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Home Number
                                                </td>
                                                <td v-cloak class="text-sm text-bold">
                                                    @{{ student.home_number }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Mobile Number
                                                </td>
                                                <td v-cloak class="text-sm text-bold">
                                                    @{{ student.mobile_number }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Skype
                                                </td>
                                                <td v-cloak class="text-sm text-bold">
                                                    @{{ student.skype_id }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Facebook Email
                                                </td>
                                                <td v-cloak class="text-sm text-bold">
                                                    @{{ student.fb_email }}
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </section>
                                    <section id="family-details">
                                        <label class="control-label">Family Details</label>
                                        <table class="table table-striped table-bordered table-condensed">
                                            <tbody>
                                                <tr>
                                                    <td colspan="2" class="text-bold">Father</td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 200px">First Name</td>
                                                    <td v-cloak class="text-sm text-bold">
                                                        @{{ student.father.first_name }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Middle Name</td>
                                                    <td v-cloak class="text-sm text-bold">
                                                        @{{ student.father.middle_name }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Last Name</td>
                                                    <td v-cloak class="text-sm text-bold">
                                                        @{{ student.father.last_name }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Occupation</td>
                                                    <td v-cloak class="text-sm text-bold">
                                                        @{{ student.father.occupation }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Company</td>
                                                    <td v-cloak class="text-sm text-bold">
                                                        @{{ student.father.company }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Contact No.</td>
                                                    <td v-cloak class="text-sm text-bold">
                                                        @{{ student.father.contact_no }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="table table-striped table-bordered table-condensed">
                                            <tbody>
                                                <tr>
                                                    <td colspan="2" class="text-bold">Mother</td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 200px">First Name</td>
                                                    <td v-cloak class="text-sm text-bold">
                                                        @{{ student.mother.first_name }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Middle Name</td>
                                                    <td v-cloak class="text-sm text-bold">
                                                        @{{ student.mother.middle_name }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Last Name</td>
                                                    <td v-cloak class="text-sm text-bold">
                                                        @{{ student.mother.last_name }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Occupation/Company</td>
                                                    <td v-cloak class="text-sm text-bold">
                                                        @{{ student.mother.occupation }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Company</td>
                                                    <td v-cloak class="text-sm text-bold">
                                                        @{{ student.mother.company }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Contact No.</td>
                                                    <td v-cloak class="text-sm text-bold">
                                                        @{{ student.mother.contact_no }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </section>
                                    <section id="school-details">
                                        <label class="control-label">Educational Background</label>
                                        <table class="table table-striped table-bordered table-condensed">
                                            <tr>
                                                <td colspan="2" class="text-bold">
                                                    Primary
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm" style="width: 200px">
                                                    School
                                                </td>
                                                <td v-cloak class="text-sm text-bold">
                                                    @{{ student.primary.school_name }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Address
                                                </td>
                                                <td v-cloak class="text-sm text-bold">
                                                    @{{ student.primary.address }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Date Graduated
                                                </td>
                                                <td v-cloak class="text-sm text-bold">
                                                    @{{ student.primary.date_graduated }}
                                                </td>
                                            </tr>
                                        </table>
                                        <table class="table table-striped table-bordered table-condensed">
                                            <tr>
                                                <td colspan="2" class="text-bold">
                                                    Secondary
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm" style="width: 200px">
                                                    School
                                                </td>
                                                <td v-cloak class="text-sm text-bold">
                                                    @{{ student.secondary.school_name }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Address
                                                </td>
                                                <td v-cloak class="text-sm text-bold">
                                                    @{{ student.secondary.address }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Date Graduated
                                                </td>
                                                <td v-cloak class="text-sm text-bold">
                                                    @{{ student.secondary.date_graduated | toFormattedDateString }}
                                                </td>
                                            </tr>
                                        </table>
                                        <table class="table table-striped table-bordered table-condensed">
                                            <tr>
                                                <td colspan="2" class="text-bold">
                                                    Tertiary
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm" style="width: 200px">
                                                    School
                                                </td>
                                                <td v-cloak class="text-sm text-bold">
                                                    @{{ student.tertiary.school_name }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Address
                                                </td>
                                                <td v-cloak class="text-sm text-bold">
                                                    @{{ student.tertiary.address }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Degree
                                                </td>
                                                <td v-cloak class="text-sm text-bold">
                                                    @{{ student.tertiary.degree }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Date Graduated (expected)
                                                </td>
                                                <td v-cloak class="text-sm text-bold">
                                                    @{{ student.tertiary.date_graduated | toFormattedDateString }}
                                                </td>
                                            </tr>
                                        </table>
                                    </section>
                                    <section id="experience-details">
                                        <label class="control-label">Work Experience/On-the-Job Training</label>
                                        <table v-for="exp in student.experience" class="table table-striped table-bordered table-condensed">
                                            <tr>
                                                <td class="text-sm" style="width: 200px;">
                                                    Company
                                                </td>
                                                <td v-cloak class="text-sm text-bold">
                                                    @{{ exp.company }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Address
                                                </td>
                                                <td v-cloak class="text-sm text-bold">
                                                    @{{ exp.address }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Description
                                                </td>
                                                <td v-cloak class="text-sm text-bold">
                                                    @{{ exp.description }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Start Date
                                                </td>
                                                <td v-cloak class="text-sm text-bold">
                                                    @{{ exp.start_date | toFormattedDateString}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    End Date
                                                </td>
                                                <td v-cloak class="text-sm text-bold">
                                                    @{{ exp.end_date }}
                                                </td>
                                            </tr>
                                        </table>
                                    </section>
                                    <section v-if="student.application_status === 'Hired' || student.application_status === 'For Visa Interview'" id="host-company-details">
                                        <label class="control-label">Host Company Details</label>
                                        <table class="table table-striped table-bordered table-condensed">
                                            <tr>
                                                <td class="text-sm" style="width: 200px">
                                                    Visa Sponsor
                                                </td>
                                                <td v-if="!setting.host.sponsorIsEdit" v-cloak class="text-bold">
                                                    <label class="text-sm">@{{ student.sponsor.name }}</label>
                                                    <a @click="hideField('sponsor')" href="#" class="pull-right"><span class="fa fa-edit"></span></a>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group">
                                                        <select v-model="field" class="form-control input-sm">
                                                            <option value="">Select visa sponsor</option>
                                                            <option v-for="sponsor in sponsors" :value="sponsor.id">@{{ sponsor.name }}</option>
                                                        </select>
                                                        <span class="input-group-btn">
                                                            <button @click="updateField('visa_sponsor_id', field); setting.host.sponsorIsEdit = false; field = '';" class="btn btn-primary btn-flat btn-sm">Update</button>
                                                        </span>
                                                        <span class="input-group-btn">
                                                            <button @click="setting.host.sponsorIsEdit = false; field = '';" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Host Company
                                                </td>
                                                <td v-if="!setting.host.nameIsEdit" v-cloak class="text-bold">
                                                    <label class="text-sm">@{{ student.company.name }}</label>
                                                    <a @click="hideField('name')" href="#" class="pull-right"><span class="fa fa-edit"></span></a>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group">
                                                        <select v-model="field" class="form-control input-sm">
                                                            <option value="">Select host company</option>
                                                            <option v-for="host in hosts" :value="host.id">@{{ host.name }}</option>
                                                        </select>
                                                        <span class="input-group-btn">
                                                    <button @click="updateField('host_company_id', field); setting.host.nameIsEdit = false; field = '';" class="btn btn-primary btn-flat btn-sm">Update</button>
                                                </span>
                                                        <span class="input-group-btn">
                                                    <button @click="setting.host.nameIsEdit = false; field = '';" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                                </span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Location
                                                </td>
                                                <td v-if="!setting.host.locationIsEdit" v-cloak class="text-bold">
                                                    <label class="text-sm">@{{ student.location }}</label>
                                                    <a @click="hideField('location')" href="#" class="pull-right"><span class="fa fa-edit"></span></a>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group">
                                                        <select v-model="field" class="form-control input-sm">
                                                            <option value="">Select Location</option>
                                                            <option v-for="state in states" :value="state.display_name">@{{ state.name }}</option>
                                                        </select>
                                                        <span class="input-group-btn">
                                                            <button @click="updateField('location', field); setting.host.locationIsEdit = false; field = '';" class="btn btn-primary btn-flat btn-sm">Update</button>
                                                        </span>
                                                        <span class="input-group-btn">
                                                            <button @click="setting.host.locationIsEdit = false; field = '';" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Housing Address
                                                </td>
                                                <td v-if="!setting.host.housingIsEdit" v-cloak class="text-bold">
                                                    <label class="text-sm">@{{ student.housing_details }}</label>
                                                    <a @click="hideField('housing')" href="#" class="pull-right"><span class="fa fa-edit"></span></a>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group">
                                                        <input v-model="field" type="text" class="form-control input-sm">
                                                        <span class="input-group-btn">
                                                            <button @click="updateField('housing_details', field); setting.host.housingIsEdit = false; field = '';" class="btn btn-primary btn-flat btn-sm">Update</button>
                                                        </span>
                                                        <span class="input-group-btn">
                                                            <button @click="setting.host.housingIsEdit = false; field = '';" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Position
                                                </td>
                                                <td v-if="!setting.host.positionIsEdit" v-cloak class="text-bold">
                                                    <label class="text-sm">@{{ student.position }}</label>
                                                    <a @click="hideField('position')" href="#" class="pull-right"><span class="fa fa-edit"></span></a>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group">
                                                        <select v-model="field" class="form-control input-sm">
                                                            <option value="">Select Position</option>
                                                            <option v-for="position in positions" :value="position.display_name">@{{ position.name }}</option>
                                                        </select>
                                                        <span class="input-group-btn">
                                                    <button @click="updateField('position', field); setting.host.positionIsEdit = false; field = '';" class="btn btn-primary btn-flat btn-sm">Update</button>
                                                </span>
                                                        <span class="input-group-btn">
                                                    <button @click="setting.host.positionIsEdit = false; field = '';" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                                </span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Stipend
                                                </td>
                                                <td v-if="!setting.host.stipendIsEdit" v-cloak class="text-bold">
                                                    <label class="text-sm">@{{ student.stipend }}</label>
                                                    <a @click="hideField('stipend')" href="#" class="pull-right"><span class="fa fa-edit"></span></a>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group">
                                                        <input v-model="field" type="text" class="form-control input-sm" placeholder="Enter applicant stipend">
                                                        <span class="input-group-btn">
                                                    <button @click="updateField('stipend', field); setting.host.stipendIsEdit = false; field = '';" class="btn btn-primary btn-flat btn-sm">Update</button>
                                                </span>
                                                        <span class="input-group-btn">
                                                    <button @click="setting.host.stipendIsEdit = false; field = '';" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                                </span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">Start Date</td>
                                                <td v-if="!setting.host.startIsEdit">
                                                    <label class="text-sm">@{{ student.program_start_date | toFormattedDateString }}</label>
                                                    <a @click="hideField('start')" href="#" class="pull-right"><span class="fa fa-edit"></span></a>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group">
                                                        <input v-model="field" type="date" class="form-control input-sm">
                                                        <span class="input-group-btn">
                                                    <button @click="updateField('program_start_date', field); setting.host.startIsEdit = false; field = '';" class="btn btn-primary btn-flat btn-sm">Update</button>
                                                </span>
                                                        <span class="input-group-btn">
                                                    <button @click="setting.host.startIsEdit = false; field = '';" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                                </span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">End Date</td>
                                                <td v-if="!setting.host.endIsEdit">
                                                    <label class="text-sm">@{{ student.program_end_date | toFormattedDateString }}</label>
                                                    <a @click="hideField('end')" href="#" class="pull-right"><span class="fa fa-edit"></span></a>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group">
                                                        <input v-model="field" type="date" class="form-control input-sm">
                                                        <span class="input-group-btn">
                                                    <button @click="updateField('program_end_date', field); setting.host.endIsEdit = false; field = '';" class="btn btn-primary btn-flat btn-sm">Update</button>
                                                </span>
                                                        <span class="input-group-btn">
                                                    <button @click="setting.host.endIsEdit = false; field = '';" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                                </span>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </section>
                                    <section v-if="student.application_status == 'For Visa Interview'" id="visa-interview-details">
                                        <label class="control-label">Visa Interview Details</label>
                                        <table class="table table-striped table-bordered table-condensed">
                                            <tr>
                                                <td class="text-sm" style="width: 200px">
                                                    Program ID Number
                                                </td>
                                                <td v-if="!setting.visa.programIsEdit" v-cloak class="text-bold">
                                                    <label class="text-sm">@{{ student.program_id_no }}</label>
                                                    <a @click="hideField('program')" href="#" class="pull-right"><span class="fa fa-edit"></span></a>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group">
                                                        <input v-model="field" type="text" class="form-control input-sm">
                                                        <span class="input-group-btn">
                                                <button @click="updateField('program_id_no', field); setting.visa.programIsEdit = false; field = '';" class="btn btn-primary btn-flat btn-sm">Update</button>
                                            </span>
                                                        <span class="input-group-btn">
                                                <button @click="setting.visa.programIsEdit = false; field = '';" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                            </span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    SEVIS ID
                                                </td>
                                                <td v-if="!setting.visa.sevisIsEdit" v-cloak class="text-bold">
                                                    <label class="text-sm">@{{ student.sevis_id }}</label>
                                                    <a @click="hideField('sevis')" href="#" class="pull-right"><span class="fa fa-edit"></span></a>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group">
                                                        <input v-model="field" type="text" class="form-control input-sm">
                                                        <span class="input-group-btn">
                                                <button @click="updateField('sevis_id', field); setting.visa.sevisIsEdit = false; field = '';" class="btn btn-primary btn-flat btn-sm">Update</button>
                                            </span>
                                                        <span class="input-group-btn">
                                                <button @click="setting.visa.sevisIsEdit = false; field = '';" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                            </span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Interview Schedule
                                                </td>
                                                <td v-if="!setting.visa.scheduleIsEdit">
                                                    <label class="text-sm">@{{ student.visa_interview_schedule }}</label>
                                                    <a @click="hideField('schedule')" href="#" class="pull-right"><span class="fa fa-edit"></span></a>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group">
                                                        <input v-model="field" type="date" class="form-control input-sm">
                                                        <span class="input-group-btn">
                                                <button @click="updateField('visa_interview_schedule', field); setting.visa.scheduleIsEdit = false; field = '';" class="btn btn-primary btn-flat btn-sm">Update</button>
                                            </span>
                                                        <span class="input-group-btn">
                                                <button @click="setting.visa.scheduleIsEdit = false; field = '';" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                            </span>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </section>
                                    <section v-if="student.application_status == 'For Visa Interview'" id="flight-details">
                                        <label class="control-label">Flight Details</label>
                                        <table class="table table-striped table-bordered table-condensed">
                                            <tr>
                                                <td class="text-sm text-bold" colspan="2">
                                                    Departure from MANILA
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm" style="width: 200px">
                                                    Date
                                                </td>
                                                <td v-if="!setting.flightUS.departureIsEdit" v-cloak class="text-bold">
                                                    <label class="text-sm">@{{ student.us_departure_date }}</label>
                                                    <a @click="hideField('us_departure_date')" href="#" class="pull-right"><span class="fa fa-edit"></span></a>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group">
                                                        <input v-model="field" type="date" class="form-control input-sm">
                                                        <span class="input-group-btn">
                                                            <button @click="updateField('us_departure_date', field); setting.flightUS.departureIsEdit = false; field = '';" class="btn btn-primary btn-flat btn-sm">Update</button>
                                                        </span>
                                                        <span class="input-group-btn">
                                                            <button @click="setting.flightUS.departureIsEdit = false; field = '';" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Time
                                                </td>
                                                <td v-if="!setting.flightUS.departureTimeIsEdit" v-cloak class="text-bold">
                                                    <label for="" class="text-sm">@{{ student.us_departure_time }}</label>
                                                    <a @click="hideField('us_departure_time')" href="#" class="pull-right"><span class="fa fa-edit"></span></a>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group">
                                                        <input v-model="field" type="time" class="form-control input-sm">
                                                        <span class="input-group-btn">
                                                            <button @click="updateField('us_departure_time', field); setting.flightUS.departureTimeIsEdit = false; field = '';" class="btn btn-primary btn-flat btn-sm">Update</button>
                                                        </span>
                                                        <span class="input-group-btn">
                                                            <button @click="setting.flightUS.departureTimeIsEdit = false; field = '';" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Flight No.
                                                </td>
                                                <td v-if="!setting.flightUS.departureFlightIsEdit" v-cloak class="text-bold">
                                                    <label for="" class="text-sm">@{{ student.us_departure_flight_no }}</label>
                                                    <a @click="hideField('us_departure_flight')" href="#" class="pull-right"><span class="fa fa-edit"></span></a>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group">
                                                        <input v-model="field" type="text" class="form-control input-sm">
                                                        <span class="input-group-btn">
                                                            <button @click="updateField('us_departure_flight_no', field); setting.flightUS.departureFlightIsEdit = false; field = '';" class="btn btn-primary btn-flat btn-sm">Update</button>
                                                        </span>
                                                        <span class="input-group-btn">
                                                            <button @click="setting.flightUS.departureFlightIsEdit = false; field = '';" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Airlines
                                                </td>
                                                <td v-if="!setting.flightUS.departureAirlineIsEdit" v-cloak class="text-bold">
                                                    <label for="" class="text-sm">@{{ student.us_departure_airline }}</label>
                                                    <a @click="hideField('us_departure_airline')" href="#" class="pull-right"><span class="fa fa-edit"></span></a>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group">
                                                        <select v-model="field" name="" id="" class="form-control input-sm">
                                                            <option value="">Select Airlines</option>
                                                            <option value="PAL">Philippine Airlines</option>
                                                            <option value="AirAsia">Air Asia</option>
                                                        </select>
                                                        <span class="input-group-btn">
                                                            <button @click="updateField('us_departure_airline', field); setting.flightUS.departureAirlineIsEdit = false; field = '';" class="btn btn-primary btn-flat btn-sm">Update</button>
                                                        </span>
                                                        <span class="input-group-btn">
                                                            <button @click="setting.flightUS.departureAirlineIsEdit = false; field = '';" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>

                                        <table class="table table-striped table-bordered table-condensed">
                                            <tr>
                                                <td class="text-sm text-bold" colspan="2">
                                                    Arrival to US
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm" style="width: 200px;">
                                                    Date
                                                </td>
                                                <td v-if="!setting.flightUS.arrivalIsEdit" v-cloak class="text-bold">
                                                    <label class="text-sm">@{{ student.us_arrival_date }}</label>
                                                    <a @click="hideField('us_arrival_date')" href="#" class="pull-right"><span class="fa fa-edit"></span></a>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group">
                                                        <input v-model="field" type="date" class="form-control input-sm">
                                                        <span class="input-group-btn">
                                                            <button @click="updateField('us_arrival_date', field); setting.flightUS.arrivalIsEdit = false; field = '';" class="btn btn-primary btn-flat btn-sm">Update</button>
                                                        </span>
                                                        <span class="input-group-btn">
                                                            <button @click="setting.flightUS.arrivalIsEdit = false; field = '';" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Time
                                                </td>
                                                <td v-if="!setting.flightUS.arrivalTimeIsEdit" v-cloak class="text-bold">
                                                    <label for="" class="text-sm">@{{ student.us_arrival_time }}</label>
                                                    <a @click="hideField('us_arrival_time')" href="#" class="pull-right"><span class="fa fa-edit"></span></a>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group">
                                                        <input v-model="field" type="time" class="form-control input-sm">
                                                        <span class="input-group-btn">
                                                            <button @click="updateField('us_arrival_time', field); setting.flightUS.arrivalTimeIsEdit = false; field = '';" class="btn btn-primary btn-flat btn-sm">Update</button>
                                                        </span>
                                                        <span class="input-group-btn">
                                                            <button @click="setting.flightUS.arrivalTimeIsEdit = false; field = '';" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Flight No.
                                                </td>
                                                <td v-if="!setting.flightUS.arrivalFlightIsEdit" v-cloak class="text-bold">
                                                    <label for="" class="text-sm">@{{ student.us_arrival_flight_no }}</label>
                                                    <a @click="hideField('us_arrival_flight')" href="#" class="pull-right"><span class="fa fa-edit"></span></a>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group">
                                                        <input v-model="field" type="text" class="form-control input-sm">
                                                        <span class="input-group-btn">
                                                            <button @click="updateField('us_arrival_flight_no', field); setting.flightUs.arrivalFlightIsEdit = false; field = '';" class="btn btn-primary btn-flat btn-sm">Update</button>
                                                        </span>
                                                        <span class="input-group-btn">
                                                            <button @click="setting.flightUS.arrivalFlightIsEdit = false; field = '';" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Airlines
                                                </td>
                                                <td v-if="!setting.flightUS.arrivalAirlineIsEdit" v-cloak class="text-bold">
                                                    <label for="" class="text-sm">@{{ student.us_arrival_airline }}</label>
                                                    <a @click="hideField('us_arrival_airline')" href="#" class="pull-right"><span class="fa fa-edit"></span></a>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group">
                                                        <select v-model="field" name="" id="" class="form-control input-sm">
                                                            <option value="">Select Airlines</option>
                                                            <option value="PAL">Philippine Airlines</option>
                                                            <option value="AirAsia">Air Asia</option>
                                                        </select>
                                                        <span class="input-group-btn">
                                                            <button @click="updateField('us_arrival_airline', field); setting.flightUS.arrivalAirlineIsEdit = false; field = '';" class="btn btn-primary btn-flat btn-sm">Update</button>
                                                        </span>
                                                        <span class="input-group-btn">
                                                            <button @click="setting.flightUS.arrivalAirlineIsEdit = false; field = '';" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>

                                        <table class="table table-striped table-bordered table-condensed">
                                            <tr>
                                                <td class="text-sm text-bold" colspan="2">
                                                    Departure from US
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm" style="width: 200px">
                                                    Date
                                                </td>
                                                <td v-if="!setting.flightMNL.departureIsEdit" v-cloak class="text-bold">
                                                    <label class="text-sm">@{{ student.mnl_departure_date }}</label>
                                                    <a @click="hideField('mnl_departure_date')" href="#" class="pull-right"><span class="fa fa-edit"></span></a>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group">
                                                        <input v-model="field" type="date" class="form-control input-sm">
                                                        <span class="input-group-btn">
                                                            <button @click="updateField('mnl_departure_date', field); setting.flightMNL.departureIsEdit = false; field= '';" class="btn btn-primary btn-flat btn-sm">Update</button>
                                                        </span>
                                                        <span class="input-group-btn">
                                                            <button @click="setting.flightMNL.departureIsEdit = false; field = '';" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Time
                                                </td>
                                                <td v-if="!setting.flightMNL.departureTimeIsEdit" v-cloak class="text-bold">
                                                    <label for="" class="text-sm">@{{ student.mnl_departure_time }}</label>
                                                    <a @click="hideField('mnl_departure_time')" href="#" class="pull-right"><span class="fa fa-edit"></span></a>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group">
                                                        <input v-model="field" type="time" class="form-control input-sm">
                                                        <span class="input-group-btn">
                                                            <button @click="updateField('mnl_departure_time', field); setting.flightMNL.departureTimeIsEdit = false; field = '';" class="btn btn-primary btn-flat btn-sm">Update</button>
                                                        </span>
                                                        <span class="input-group-btn">
                                                            <button @click="setting.flightMNL.departureTimeIsEdit = false; field = '';" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Flight No.
                                                </td>
                                                <td v-if="!setting.flightMNL.departureFlightIsEdit" v-cloak class="text-bold">
                                                    <label for="" class="text-sm">@{{ student.mnl_departure_flight_no }}</label>
                                                    <a @click="hideField('mnl_departure_flight')" href="#" class="pull-right"><span class="fa fa-edit"></span></a>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group">
                                                        <input v-model="field" type="text" class="form-control input-sm">
                                                        <span class="input-group-btn">
                                                            <button @click="updateField('mnl_departure_flight_no', field); setting.flightMNL.departureFlightIsEdit = false; field = '';" class="btn btn-primary btn-flat btn-sm">Update</button>
                                                        </span>
                                                        <span class="input-group-btn">
                                                            <button @click="setting.flightMNL.departureFlightIsEdit = false; field = '';" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Airlines
                                                </td>
                                                <td v-if="!setting.flightMNL.departureAirlineIsEdit" v-cloak class="text-bold">
                                                    <label for="" class="text-sm">@{{ student.mnl_departure_airline }}</label>
                                                    <a @click="hideField('mnl_departure_airline')" href="#" class="pull-right"><span class="fa fa-edit"></span></a>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group">
                                                        <select v-model="field" name="" id="" class="form-control input-sm">
                                                            <option value="">Select Airlines</option>
                                                            <option value="PAL">Philippine Airlines</option>
                                                            <option value="AirAsia">Air Asia</option>
                                                        </select>
                                                        <span class="input-group-btn">
                                                            <button @click="updateField('mnl_departure_airline', field); setting.flightMNL.departureAirlineIsEdit = false; field = '';" class="btn btn-primary btn-flat btn-sm">Update</button>
                                                        </span>
                                                        <span class="input-group-btn">
                                                            <button @click="setting.flightMNL.departureAirlineIsEdit = false; field = '';" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>

                                        <table class="table table-striped table-bordered table-condensed">
                                            <tr>
                                                <td class="text-sm text-bold" colspan="2">
                                                    Arrival to MANILA
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm" style="width: 200px;">
                                                    Date
                                                </td>
                                                <td v-if="!setting.flightMNL.arrivalIsEdit" v-cloak class="text-bold">
                                                    <label class="text-sm">@{{ student.mnl_arrival_date }}</label>
                                                    <a @click="hideField('mnl_arrival_date')" href="#" class="pull-right"><span class="fa fa-edit"></span></a>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group">
                                                        <input v-model="field" type="date" class="form-control input-sm">
                                                        <span class="input-group-btn">
                                                            <button @click="updateField('mnl_arrival_date', field); setting.flightMNL.arrivalIsEdit = false; field = '';" class="btn btn-primary btn-flat btn-sm">Update</button>
                                                        </span>
                                                        <span class="input-group-btn">
                                                            <button @click="setting.flightMNL.arrivalIsEdit = false; field = '';" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Time
                                                </td>
                                                <td v-if="!setting.flightMNL.arrivalTimeIsEdit" v-cloak class="text-bold">
                                                    <label for="" class="text-sm">@{{ student.mnl_arrival_time }}</label>
                                                    <a @click="hideField('mnl_arrival_time')" href="#" class="pull-right"><span class="fa fa-edit"></span></a>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group">
                                                        <input v-model="field" type="time" class="form-control input-sm">
                                                        <span class="input-group-btn">
                                                            <button @click="updateField('mnl_arrival_time', field); setting.flightMNL.arrivalTimeIsEdit = false; field = '';" class="btn btn-primary btn-flat btn-sm">Update</button>
                                                        </span>
                                                        <span class="input-group-btn">
                                                            <button @click="setting.flightMNL.arrivalTimeIsEdit = false; field = '';" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Flight No.
                                                </td>
                                                <td v-if="!setting.flightMNL.arrivalFlightIsEdit" v-cloak class="text-bold">
                                                    <label for="" class="text-sm">@{{ student.mnl_arrival_flight_no }}</label>
                                                    <a @click="hideField('mnl_arrival_flight')" href="#" class="pull-right"><span class="fa fa-edit"></span></a>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group">
                                                        <input v-model="field" type="text" class="form-control input-sm">
                                                        <span class="input-group-btn">
                                                            <button @click="updateField('mnl_arrival_flight_no', field); setting.flightMNL.arrivalFlightIsEdit = false; field = '';" class="btn btn-primary btn-flat btn-sm">Update</button>
                                                        </span>
                                                        <span class="input-group-btn">
                                                            <button @click="setting.flightMNL.arrivalFlightIsEdit = false; field = '';" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Airlines
                                                </td>
                                                <td v-if="!setting.flightMNL.arrivalAirlineIsEdit" v-cloak class="text-bold">
                                                    <label for="" class="text-sm">@{{ student.mnl_arrival_airline }}</label>
                                                    <a @click="hideField('mnl_arrival_airline')" href="#" class="pull-right"><span class="fa fa-edit"></span></a>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group">
                                                        <select v-model="field" name="" id="" class="form-control input-sm">
                                                            <option value="">Select Airlines</option>
                                                            <option value="PAL">Philippine Airlines</option>
                                                            <option value="AirAsia">Air Asia</option>
                                                        </select>
                                                        <span class="input-group-btn">
                                                            <button @click="updateField('mnl_arrival_airline', field); setting.flightMNL.arrivalAirlineIsEdit = false; field = '';" class="btn btn-primary btn-flat btn-sm">Update</button>
                                                        </span>
                                                        <span class="input-group-btn">
                                                            <button @click="setting.flightMNL.arrivalAirlineIsEdit = false; field = '';" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </section>
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
                                            <td class="text-sm">@{{ requirement.name }}</td>
                                            <td class="text-center">
                                                <span v-if="requirement.student_preliminary.status" class="fa fa-check text-green"></span>
                                                <span v-else class="fa fa-times text-red"></span>
                                            </td>
                                            <td class="text-center">
                                                <button @click="openInNewTab(requirement.student_preliminary.id)" class="btn btn-warning btn-flat btn-xs"><span class="fa fa-download"></span> View</button>
                                                <button @click="downloadBasicRequirement(requirement.student_preliminary.id)" class="btn btn-primary btn-flat btn-xs"><span class="fa fa-download"></span> Download</button>
                                                <button @click="removePrelimFile(requirement)" class="btn btn-danger btn-flat btn-xs"><span class="fa fa-trash"></span> Delete</button>
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
                                            <td class="text-sm">@{{ requirement.name }}</td>
                                            <td class="text-center">
                                                <span v-if="requirement.student_payment.status" class="fa fa-check text-green"></span>
                                                <span v-else class="fa fa-times text-red"></span>
                                            </td>
                                            <td class="text-center">
                                                <button @click="downloadPaymentRequirement(requirement.student_payment.id)" class="btn btn-primary btn-flat btn-xs"><span class="fa fa-download"></span> Download</button>
                                                <button @click="removePaymentFile(requirement)" class="btn btn-danger btn-flat btn-xs"><span class="fa fa-trash"></span> Delete</button>
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
                                            <td class="text-sm">@{{ requirement.name }}</td>
                                            <td class="text-center">
                                                <span v-if="requirement.student_visa.status" class="fa fa-check text-green"></span>
                                                <span v-else class="fa fa-times text-red"></span>
                                            </td>
                                            <td class="text-center">
                                                <button @click="downloadVisaRequirement(requirement.student_visa.id)" class="btn btn-primary btn-flat btn-xs"><span class="fa fa-download"></span> Download</button>
                                                <button @click="removeVisaFile(requirement)" class="btn btn-danger btn-flat btn-xs"><span class="fa fa-trash"></span> Delete</button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane" id="tab-additional-req">
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
                                            <tr v-for="requirement in additionalRequirements">
                                                <td class="text-sm">@{{ requirement.name }}</td>
                                                <td class="text-center">
                                                    <span v-if="requirement.student_additional.status" class="fa fa-check text-green"></span>
                                                    <span v-else class="fa fa-times text-red"></span>
                                                </td>
                                                <td class="text-center">
                                                    <button @click="downloadAdditionalRequirement(requirement.student_additional.id)" class="btn btn-primary btn-flat btn-xs"><span class="fa fa-download"></span> Download</button>
                                                    <button @click="removeAdditionalFile(requirement)" class="btn btn-danger btn-flat btn-xs"><span class="fa fa-trash"></span> Delete</button>
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
    <style scope>
        .slide-fade-enter-active {
            transition: all .3s linear;
        }
        .slide-fade-leave-active {
            transition: all .3s linear;
        }
        .slide-fade-enter, .slide-fade-leave-to
            /* .slide-fade-leave-active below version 2.1.8 */ {
            transform: translateY(10px);
            opacity: 0;
        }
    </style>
    <script>
        let programId = '{{ $program }}';

        const sidenav = new Vue({
            el: '#sidenav',
            data: {
                auth: {{ \App\Coordinator::where('user_id', Auth::user()->id)->first()->program }},
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
                loading: {
                    modal: false,
                    table: false
                },
                hasRecords: true,
                hosts: [],
                states: [],
                positions: [],
                sponsors: [],
                students: [],
                student: {
                    father: [],
                    mother: [],
                    primary: [],
                    secondary: [],
                    tertiary: []
                },
                basicRequirements: [],
                paymentRequirements: [],
                visaRequirements: [],
                additionalRequirements: [],
                links: [],
                current_page: '',
                last_page: '',
                filterName: '',
                filter: {
                    from: '',
                    to: '',
                    status: ''
                },
                appStatus: '',
                visaStatus: '',
                testData: [],
                testField: {
                    "Application ID"                 : "application_id",
                    "Date of Application"            : "created_at",
                    "First Name"                     : "first_name",
                    "Middle Name"                    : "middle_name",
                    "Last Name"                      : "last_name",
                    "Gender"                         : "gender",
                    "Birthday"                       : "birthdate",
                    "Status"                         : "application_status",
                    "School"                         : "tertiary.school_name",
                    "Course"                         : "tertiary.degree",
                    "Contact"                        : "home_number",
                    "Program"                        : "program.display_name",
                    "E-mail Address"                 : "fb_email",
                    "Permanent Address"              : "permanent_address",
                    "Provincial Address"             : "provincial_address",
                    "Skype ID"                       : "skype_id",
                    "Passport Number"                : "",
                    "Host Company Assignment"        : "company.name",
                    "Place of Assignment"            : "location",
                    "Stipend"                        : "stipend",
                    "VISA Appoinment"                : "visa_interview_schedule",
                    "Departure Date (MNL-US)"        : "us_departure_date",
                    "Departure Time (MNL-US)"        : "us_departure_time",
                    "Departure Flight No. (MNL-US)"  : "us_departure_flight_no",
                    "Departure Airline (MNL-US)"     : "us_departure_airline",
                    "Arrival Date (MNL-US)"          : "us_arrival_date",
                    "Arrival Time (MNL-US)"          : "us_arrival_time",
                    "Arrival Flight No. (MNL-US)"    : "us_arrival_flight_no",
                    "Arrival Airline (MNL-US)"       : "us_arrival_airline",
                    "Departure Date (US-MNL)"        : "mnl_departure_date",
                    "Departure Time (US-MNL)"        : "mnl_departure_time",
                    "Departure Flight No. (US-MNL)"  : "mnl_departure_flight_no",
                    "Departure Airline (US-MNL)"     : "mnl_departure_airline",
                    "Arrival Date (US-MNL)"          : "mnl_arrival_date",
                    "Arrival Time (US-MNL)"          : "mnl_arrival_time",
                    "Arrival Flight No. (US-MNL)"    : "mnl_arrival_flight_no",
                    "Arrival Airline (US-MNL)"       : "mnl_arrival_airline",
                    "Program Start Date"             : "program_start_date",
                    "Program End Date"               : "program_end_date"
                },
                assessed: {
                    status: '',
                    message: ''
                },
                show: {
                    assessed: false,
                    hired: false,
                    visa: false
                },
                field: '',
                host: {
                    name: '',
                    position: '',
                    place: '',
                    stipend: '',
                    start: '',
                    end: '',
                    sponsor: ''
                },
                visa: {
                    sevis: '',
                    programId: '',
                    schedule: ''
                },
                setting: {
                    host: {
                        nameIsEdit: false,
                        positionIsEdit: false,
                        locationIsEdit: false,
                        housingIsEdit: false,
                        startIsEdit: false,
                        endIsEdit: false,
                        stipendIsEdit: false,
                        sponsorIsEdit: false
                    },
                    visa: {
                        programIsEdit: false,
                        sevisIsEdit: false,
                        scheduleIsEdit: false
                    },
                    flightUS: {
                        departureIsEdit: false,
                        departureTimeIsEdit : false,
                        departureFlightIsEdit: false,
                        departureAirlineIsEdit: false,
                        arrivalIsEdit: false,
                        arrivalTimeIsEdit: false,
                        arrivalFlightIsEdit: false,
                        arrivalAirlineIsEdit: false
                    },
                    flightMNL: {
                        departureIsEdit: false,
                        departureTimeIsEdit : false,
                        departureFlightIsEdit: false,
                        departureAirlineIsEdit: false,
                        arrivalIsEdit: false,
                        arrivalTimeIsEdit: false,
                        arrivalFlightIsEdit: false,
                        arrivalAirlineIsEdit: false
                    }
                },
            },
            mounted: function() {
                this.loadStudents();
                this.loadHostCompany();
                this.loadVisaSponsor();
                this.loadStates();
                this.loadPositions();
            },
            watch: {
                filterName: function() {
                    if (this.filterName) {
                        this.loading.table = true;
                        axios.get(`/filter/student`, {
                            params: {
                                program_id : programId,
                                last_name: this.filterName
                            }
                        })
                            .then((response) => {
                                this.loading.table = false;
                                if (response.data.data.length > 0) {
                                    this.hasRecords = true;
                                    this.students = response.data.data;
                                    this.testData = response.data.data;
                                    this.links = response.data.links;
                                    this.current_page = response.data.meta.current_page;
                                    this.last_page = response.data.meta.last_page;
                                } else {
                                    this.hasRecords = false;
                                }
                            }).catch((error) => {
                                this.loading.table = false;
                        })
                    } else {
                        this.loadStudents(programId)
                    }
                }
            },
            filters: {
                toFormattedDateString: function (value) {
                    let d = new Date(value);
                    let months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                    return `${months[d.getMonth()]} ${d.getDate()}, ${d.getFullYear()}`;
                }
            },
            methods: {
                filterStatus () {
                    let formData = new FormData();
                    formData.append('program_id', programId);
                    formData.append('status', this.filter.status);
                    formData.append('from', this.filter.from);
                    formData.append('to', this.filter.to);
                    this.loading.table = true;
                    axios.post(`/filter/status`, formData)
                        .then((response) => {
                            this.loading.table = false;
                            if  (response.data.data.length > 0) {
                                this.hasRecords = true;
                                this.students = response.data.data;
                                this.links = response.data.links;
                                this.current_page = response.data.meta.current_page;
                                this.last_page = response.data.meta.last_page;
                            } else {
                                this.hasRecords = false;
                            }
                        }).catch((error) => {
                            this.loading.table = false;
                    })
                },
                next () {
                    this.loading.table = true;
                    axios.get(this.links.next)
                        .then((response) => {
                            this.loading.table = false;
                            if  (response.data.data.length > 0) {
                                this.hasRecords = true;
                                this.students = response.data.data;
                                this.links = response.data.links;
                                this.current_page = response.data.meta.current_page;
                                this.last_page = response.data.meta.last_page;
                            } else {
                                this.hasRecords = false;
                            }
                        })
                },
                previous () {
                    this.loading.table = true;
                    axios.get(this.links.prev)
                        .then((response) => {
                            this.loading.table = false;
                            if  (response.data.data.length > 0) {
                                this.hasRecords = true;
                                this.students = response.data.data;
                                this.links = response.data.links;
                                this.current_page = response.data.meta.current_page;
                                this.last_page = response.data.meta.last_page;
                            } else {
                                this.hasRecords = false;
                            }
                        })
                },
                loadStudents () {
                    this.loading.table = true;
                    axios.get(`/coor/program/${programId}`)
                        .then((response) => {
                            this.loading.table = false;
                            if (response.data.data.length > 0) {
                                this.hasRecords = true;
                                this.students = response.data.data;
                                this.testData = response.data.data;
                                this.links = response.data.links;
                                this.current_page = response.data.meta.current_page;
                                this.last_page = response.data.meta.last_page;
                            } else {
                                this.hasRecords = false;
                            }
                        })
                },
                viewStudent (studentId) {
                    axios.get(`/stud/viewWithFullDetails?id=${studentId}`)
                        .then((response) => {
                            this.student = response.data.data;
                            this.loadBasicRequirements(programId, response.data.data.user_id);
                            this.loadPaymentRequirements(programId, response.data.data.user_id);
                            this.loadVisaRequirements(response.data.data.visa_sponsor_id, response.data.data.user_id);
                            this.loadAdditionalRequirement(programId, response.data.data.user_id);
                            console.log(response.data.data);
                            $('#student-modal').modal('show');
                        })
                },
                openInNewTab (id) {
                    axios.get(`/download/basic/requirement/${id}`)
                        .then((response) => {
                            let win = window.open(response.data);
                            win.focus();
                        })
                },
                loadBasicRequirements (programId, userId) {
                    axios.get(`/preliminary/viewUserRequirement?program_id=${programId}&id=${userId}`)
                        .then((response) => {
                            this.basicRequirements = response.data.data;
                        })
                },
                downloadBasicRequirement (id) {
                    axios.get(`/studPreliminary/download?requirement_id=${id}`)
                        .then((response) => {
                            const link = document.createElement('a');
                            link.href = response.data;
                            link.setAttribute('download', '');
                            document.body.appendChild(link);
                            link.click();
                        })
                },
                loadPaymentRequirements (programId, userId) {
                    axios.get(`/payment/viewUserRequirement?program_id=${programId}&id=${userId}`)
                        .then((response) => {
                            this.paymentRequirements = response.data.data;
                        })
                },
                downloadPaymentRequirement (id) {
                    axios.get(`/studPayment/download?requirement_id=${id}`)
                        .then((response) => {
                            const link = document.createElement('a');
                            link.href = response.data;
                            link.setAttribute('download', '');
                            document.body.appendChild(link);
                            link.click();
                        })
                },
                loadAdditionalRequirement (programId, userId) {
                    axios.get(`/additional/viewUserRequirement?program_id=${programId}&id=${userId}`)
                        .then((response) => {
                            this.additionalRequirements = response.data.data;
                        })
                },
                downloadAdditionalRequirement (id) {
                    axios.get(`/studAdditional/download?requirement_id=${id}`)
                        .then((response) => {
                            const link = document.createElement('a');
                            link.href = response.data;
                            link.setAttribute('download', '');
                            document.body.appendChild(link);
                            link.click();
                        })
                },
                loadVisaRequirements(sponsorId, userId) {
                    axios.get(`/visa/viewUserRequirement?sponsor_id=${sponsorId}&id=${userId}`)
                        .then((response) => {
                            this.visaRequirements = response.data.data;
                        })
                },
                loadStates() {
                    axios.get('/state/getAll')
                        .then((response) => {
                            this.states = response.data;
                        })
                },
                loadHostCompany() {
                    axios.get(`/helper/host/view`)
                        .then((response) => {
                            this.hosts = response.data.data;
                        })
                },
                loadVisaSponsor() {
                    axios.get(`/helper/sponsor/view`)
                        .then((response) => {
                            this.sponsors = response.data.data;
                        })
                },
                loadPositions() {
                    axios.get('/position/getAll')
                        .then((response) => {
                            this.positions = response.data;
                        })
                },
                downloadVisaRequirement(id) {
                    axios.get(`/studVisa/download?requirement_id=${id}`)
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
                            this.show.assessed = true;
                            this.show.hired = false;
                            this.show.visa = false;
                            break;
                        case 'Confirmed':
                            this.loading.modal = true;
                            axios.post(`/coor/${this.student.user_id}/application/${status}`)
                                .then((response) => {

                                    this.loadStudents(programId);
                                    this.viewStudent(this.student.user_id);
                                    this.loading.modal = false;
                                    swal({
                                        title: response.data,
                                        type: 'success',
                                        confirmButtonText: 'Continue'
                                    })
                                }).catch((error) => {
                                    swal({
                                        title: 'Something went wrong!',
                                        type: 'error',
                                        confirmButtonText: 'Go Back!'
                                    })
                            });
                            break;
                        case 'Hired':
                            this.show.assessed = false;
                            this.show.hired = true;
                            this.show.visa = false;
                            break;
                        case 'For Visa Interview':
                            this.show.assessed = false;
                            this.show.visa = true;
                            this.show.hired = false;
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
                },
                submitAssessed() {
                    this.loading.modal = true;
                    let formData = new FormData();
                        formData.append('status', this.assessed.status);
                        formData.append('message', this.assessed.message);
                    axios.post(`/coor/${this.student.user_id}/application/Assessed`, formData)
                        .then((response) => {
                            this.loadStudents(programId);
                            this.viewStudent(this.student.user_id);
                            this.loading.modal = false;
                            this.show.assessed = false;
                            swal({
                                title: response.data,
                                type: 'success',
                                confirmButtonText: 'Continue'
                            })
                        }).catch((error) => {
                        swal({
                            title: 'Something went wrong!',
                            type: 'error',
                            confirmButtonText: 'Go Back!'
                        })
                    });
                },
                submitHostCompany() {
                    this.loading.modal = true;
                    let formData = new FormData();
                        formData.append('name', this.host.name);
                        formData.append('position', this.host.position);
                        formData.append('place', this.host.place);
                        formData.append('housing', this.host.housing);
                        formData.append('stipend', this.host.stipend);
                        formData.append('start', this.host.start);
                        formData.append('end', this.host.end);
                        formData.append('sponsor', this.host.sponsor);
                    axios.post(`/coor/${this.student.user_id}/application/Hired`, formData)
                        .then((response) => {
                            this.loadStudents(programId);
                            this.viewStudent(this.student.user_id);
                            this.loading.modal = false;
                            this.show.hired = false;
                            swal({
                                title: response.data,
                                type: 'success',
                                confirmButtonText: 'Continue'
                            })
                        }).catch((error) => {
                            swal({
                                title: 'Something went wrong!',
                                type: 'error',
                                confirmButtonText: 'Go Back!'
                            })
                    })
                },
                submitForVisaInterview() {
                    this.loading.modal = true;
                    let formData = new FormData();
                        formData.append('sevis', this.visa.sevis);
                        formData.append('program', this.visa.programId);
                        formData.append('schedule', this.visa.schedule);
                    axios.post(`/coor/${this.student.user_id}/application/For Visa Interview`, formData)
                        .then((response) => {
                            this.loadStudents(programId);
                            this.viewStudent(this.student.user_id);
                            this.loading.modal = false;
                            this.show.visa = false;
                            swal({
                                title: response.data,
                                type: 'success',
                                confirmButtonText: 'Continue'
                            })
                        }).catch((error) => {
                            swal({
                                title: 'Something went wrong!',
                                type: 'error',
                                confirmButtonText: 'Go Back!'
                            })
                    })
                },
                removePrelimFile(requirement) {
                    swal({
                        title: 'Are you sure?',
                        text: 'This action is irreversable',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                        confirmButtonColor: 'red',
                        showLoaderOnConfirm: true,
                        preConfirm: (remove) => {
                            return axios.post(`/studPreliminary/remove?requirement_id=${requirement.student_preliminary.id}`)
                                .then((response) => {
                                    this.loadBasicRequirements(programId, requirement.student_preliminary.user_id);
                                    return response;
                                }).catch((error) => {
                                    swal({
                                        title: 'An Error has occur',
                                        type: 'error',
                                        confirmButtonText: 'Go Back!'
                                    })
                                })
                        }
                    }).then((result) => {
                        if (result.value) {
                            swal({
                                title: result.value.data.message,
                                type: 'success',
                                confirmButtonText: 'Continue'
                            })
                        }
                    })
                },
                removePaymentFile(requirement) {
                    swal({
                        title: 'Are you sure?',
                        text: 'This action is irreversable',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                        confirmButtonColor: 'red',
                        showLoaderOnConfirm: true,
                        preConfirm: (remove) => {
                            return axios.post(`/studPayment/remove?requirement_id=${requirement.student_payment.id}`)
                                .then((response) => {
                                    this.loadPaymentRequirements(programId, requirement.student_payment.user_id);
                                    return response;
                                }).catch((error) => {
                                    swal({
                                        title: 'An Error has occur',
                                        type: 'error',
                                        confirmButtonText: 'Go Back!'
                                    })
                                })
                        }
                    }).then((result) => {
                        if (result.value) {
                            swal({
                                title: result.value.data.message,
                                type: 'success',
                                confirmButtonText: 'Continue'
                            })
                        }
                    })
                },
                removeAdditionalFile(requirement) {
                    swal({
                        title: 'Are you sure?',
                        text: 'This action is irreversable',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                        confirmButtonColor: 'red',
                        showLoaderOnConfirm: true,
                        preConfirm: (remove) => {
                            return axios.post(`/studAdditional/remove?requirement_id=${requirement.student_additional.id}`)
                                .then((response) => {
                                    this.loadAdditionalRequirement(programId, requirement.student_additional.user_id);
                                    return response;
                                }).catch((error) => {
                                    swal({
                                        title: 'An Error has occur',
                                        type: 'error',
                                        confirmButtonText: 'Go Back!'
                                    })
                                })
                        }
                    }).then((result) => {
                        if (result.value) {
                            this.loadRequirements(this.program_id);
                            swal({
                                title: result.value.data.message,
                                type: 'success',
                                confirmButtonText: 'Continue'
                            })
                        }
                    })
                },
                removeVisaFile(requirement) {
                    swal({
                        title: 'Are you sure?',
                        text: 'This action is irreversable',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                        confirmButtonColor: 'red',
                        showLoaderOnConfirm: true,
                        preConfirm: () => {
                            return axios.post(`/studVisa/remove?requirement_id=${requirement.student_visa.id}`)
                                .then((response) => {
                                    this.loadVisaRequirements(requirement.sponsor_id, requirement.student_visa.user_id);
                                    return response;
                                }).catch((error) => {
                                    swal({
                                        title: 'An Error has occur',
                                        type: 'error',
                                        confirmButtonText: 'Go Back!'
                                    })
                                })
                        }
                    }).then((result) => {
                        if (result.value) {
                            this.loadRequirements(this.sponsor_id);
                            swal({
                                title: 'Success',
                                type: 'success',
                                confirmButtonText: 'Continue'
                            })
                        }
                    })
                },
                updateField(field, input) {
                    this.loading.modal = true;
                    let formData = new FormData();
                        formData.append('field', input);
                    axios.post(`/coor/update/${field}/${this.student.user_id}`, formData)
                        .then((response) => {
                            this.loading.modal = false;
                            this.loadStudents(programId);
                            this.viewStudent(this.student.user_id);
                            swal({
                                title: response.data,
                                type: 'success',
                                confirmButtonText: 'Continue'
                            })
                        }).catch((error) => {
                            this.loading.modal = false;
                            swal({
                                title: 'Something went wrong!',
                                type: 'error',
                                confirmButonText: 'Go Back!'
                            })
                    })
                },
                hideField(field) {
                    switch (field) {
                        case 'name' :
                            this.setting.host.nameIsEdit = true;
                            this.setting.host.positionIsEdit = false;
                            this.setting.host.locationIsEdit = false;
                            this.setting.host.housingIsEdit = false;
                            this.setting.host.startIsEdit = false;
                            this.setting.host.endIsEdit = false;
                            this.setting.host.stipendIsEdit = false;
                            this.setting.host.sponsorIsEdit = false;

                            this.setting.visa.programIsEdit = false;
                            this.setting.visa.sevisIsEdit = false;
                            this.setting.visa.schedule = false;

                            this.setting.flightUS.departureIsEdit = false;
                            this.setting.flightUS.departureTimeIsEdit = false;
                            this.setting.flightUS.departureFlightIsEdit = false;
                            this.setting.flightUS.departureAirlineIsEdit = false;
                            this.setting.flightUS.arrivalIsEdit = false;
                            this.setting.flightUS.arrivalTimeIsEdit = false;
                            this.setting.flightUS.arrivalFlightIsEdit = false;
                            this.setting.flightUS.arrivalAirlineIsEdit = true;

                            this.setting.flightMNL.departureIsEdit = false;
                            this.setting.flightMNL.departureTimeIsEdit = false;
                            this.setting.flightMNL.departureFlightIsEdit = false;
                            this.setting.flightMNL.departureAirlineIsEdit = false;
                            this.setting.flightMNL.arrivalIsEdit = false;
                            this.setting.flightMNL.arrivalTimeIsEdit = false;
                            this.setting.flightMNL.arrivalFlightIsEdit = false;
                            this.setting.flightMNL.arrivalAirlineIsEdit = false;
                            break;
                        case 'position' :
                            this.setting.host.nameIsEdit = false;
                            this.setting.host.positionIsEdit = true;
                            this.setting.host.locationIsEdit = false;
                            this.setting.host.housingIsEdit = false;
                            this.setting.host.startIsEdit = false;
                            this.setting.host.endIsEdit = false;
                            this.setting.host.stipendIsEdit = false;
                            this.setting.host.sponsorIsEdit = false;

                            this.setting.visa.programIsEdit = false;
                            this.setting.visa.sevisIsEdit = false;
                            this.setting.visa.schedule = false;

                            this.setting.flightUS.departureIsEdit = false;
                            this.setting.flightUS.departureTimeIsEdit = false;
                            this.setting.flightUS.departureFlightIsEdit = false;
                            this.setting.flightUS.departureAirlineIsEdit = false;
                            this.setting.flightUS.arrivalIsEdit = false;
                            this.setting.flightUS.arrivalTimeIsEdit = false;
                            this.setting.flightUS.arrivalFlightIsEdit = false;
                            this.setting.flightUS.arrivalAirlineIsEdit = true;

                            this.setting.flightMNL.departureIsEdit = false;
                            this.setting.flightMNL.departureTimeIsEdit = false;
                            this.setting.flightMNL.departureFlightIsEdit = false;
                            this.setting.flightMNL.departureAirlineIsEdit = false;
                            this.setting.flightMNL.arrivalIsEdit = false;
                            this.setting.flightMNL.arrivalTimeIsEdit = false;
                            this.setting.flightMNL.arrivalFlightIsEdit = false;
                            this.setting.flightMNL.arrivalAirlineIsEdit = false;
                            break;
                        case 'location' :
                            this.setting.host.nameIsEdit = false;
                            this.setting.host.positionIsEdit = false;
                            this.setting.host.locationIsEdit = true;
                            this.setting.host.housingIsEdit = false;
                            this.setting.host.startIsEdit = false;
                            this.setting.host.endIsEdit = false;
                            this.setting.host.stipendIsEdit = false;
                            this.setting.host.sponsorIsEdit = false;

                            this.setting.visa.programIsEdit = false;
                            this.setting.visa.sevisIsEdit = false;
                            this.setting.visa.schedule = false;

                            this.setting.flightUS.departureIsEdit = false;
                            this.setting.flightUS.departureTimeIsEdit = false;
                            this.setting.flightUS.departureFlightIsEdit = false;
                            this.setting.flightUS.departureAirlineIsEdit = false;
                            this.setting.flightUS.arrivalIsEdit = false;
                            this.setting.flightUS.arrivalTimeIsEdit = false;
                            this.setting.flightUS.arrivalFlightIsEdit = false;
                            this.setting.flightUS.arrivalAirlineIsEdit = true;

                            this.setting.flightMNL.departureIsEdit = false;
                            this.setting.flightMNL.departureTimeIsEdit = false;
                            this.setting.flightMNL.departureFlightIsEdit = false;
                            this.setting.flightMNL.departureAirlineIsEdit = false;
                            this.setting.flightMNL.arrivalIsEdit = false;
                            this.setting.flightMNL.arrivalTimeIsEdit = false;
                            this.setting.flightMNL.arrivalFlightIsEdit = false;
                            this.setting.flightMNL.arrivalAirlineIsEdit = false;
                            break;
                        case 'housing' :
                            this.setting.host.nameIsEdit = false;
                            this.setting.host.positionIsEdit = false;
                            this.setting.host.locationIsEdit = false;
                            this.setting.host.housingIsEdit = true;
                            this.setting.host.startIsEdit = false;
                            this.setting.host.endIsEdit = false;
                            this.setting.host.stipendIsEdit = false;
                            this.setting.host.sponsorIsEdit = false;

                            this.setting.visa.programIsEdit = false;
                            this.setting.visa.sevisIsEdit = false;
                            this.setting.visa.schedule = false;

                            this.setting.flightUS.departureIsEdit = false;
                            this.setting.flightUS.departureTimeIsEdit = false;
                            this.setting.flightUS.departureFlightIsEdit = false;
                            this.setting.flightUS.departureAirlineIsEdit = false;
                            this.setting.flightUS.arrivalIsEdit = false;
                            this.setting.flightUS.arrivalTimeIsEdit = false;
                            this.setting.flightUS.arrivalFlightIsEdit = false;
                            this.setting.flightUS.arrivalAirlineIsEdit = true;

                            this.setting.flightMNL.departureIsEdit = false;
                            this.setting.flightMNL.departureTimeIsEdit = false;
                            this.setting.flightMNL.departureFlightIsEdit = false;
                            this.setting.flightMNL.departureAirlineIsEdit = false;
                            this.setting.flightMNL.arrivalIsEdit = false;
                            this.setting.flightMNL.arrivalTimeIsEdit = false;
                            this.setting.flightMNL.arrivalFlightIsEdit = false;
                            this.setting.flightMNL.arrivalAirlineIsEdit = false;
                            break;
                        case 'start' :
                            this.setting.host.nameIsEdit = false;
                            this.setting.host.positionIsEdit = false;
                            this.setting.host.locationIsEdit = false;
                            this.setting.host.housingIsEdit = false;
                            this.setting.host.startIsEdit = true;
                            this.setting.host.endIsEdit = false;
                            this.setting.host.stipendIsEdit = false;
                            this.setting.host.sponsorIsEdit = false;

                            this.setting.visa.programIsEdit = false;
                            this.setting.visa.sevisIsEdit = false;
                            this.setting.visa.schedule = false;

                            this.setting.flightUS.departureIsEdit = false;
                            this.setting.flightUS.departureTimeIsEdit = false;
                            this.setting.flightUS.departureFlightIsEdit = false;
                            this.setting.flightUS.departureAirlineIsEdit = false;
                            this.setting.flightUS.arrivalIsEdit = false;
                            this.setting.flightUS.arrivalTimeIsEdit = false;
                            this.setting.flightUS.arrivalFlightIsEdit = false;
                            this.setting.flightUS.arrivalAirlineIsEdit = true;

                            this.setting.flightMNL.departureIsEdit = false;
                            this.setting.flightMNL.departureTimeIsEdit = false;
                            this.setting.flightMNL.departureFlightIsEdit = false;
                            this.setting.flightMNL.departureAirlineIsEdit = false;
                            this.setting.flightMNL.arrivalIsEdit = false;
                            this.setting.flightMNL.arrivalTimeIsEdit = false;
                            this.setting.flightMNL.arrivalFlightIsEdit = false;
                            this.setting.flightMNL.arrivalAirlineIsEdit = false;
                            break;
                        case 'end' :
                            this.setting.host.nameIsEdit = false;
                            this.setting.host.positionIsEdit = false;
                            this.setting.host.locationIsEdit = false;
                            this.setting.host.housingIsEdit = false;
                            this.setting.host.startIsEdit = false;
                            this.setting.host.endIsEdit = true;
                            this.setting.host.stipendIsEdit = false;
                            this.setting.host.sponsorIsEdit = false;

                            this.setting.visa.programIsEdit = false;
                            this.setting.visa.sevisIsEdit = false;
                            this.setting.visa.schedule = false;

                            this.setting.flightUS.departureIsEdit = false;
                            this.setting.flightUS.departureTimeIsEdit = false;
                            this.setting.flightUS.departureFlightIsEdit = false;
                            this.setting.flightUS.departureAirlineIsEdit = false;
                            this.setting.flightUS.arrivalIsEdit = false;
                            this.setting.flightUS.arrivalTimeIsEdit = false;
                            this.setting.flightUS.arrivalFlightIsEdit = false;
                            this.setting.flightUS.arrivalAirlineIsEdit = true;

                            this.setting.flightMNL.departureIsEdit = false;
                            this.setting.flightMNL.departureTimeIsEdit = false;
                            this.setting.flightMNL.departureFlightIsEdit = false;
                            this.setting.flightMNL.departureAirlineIsEdit = false;
                            this.setting.flightMNL.arrivalIsEdit = false;
                            this.setting.flightMNL.arrivalTimeIsEdit = false;
                            this.setting.flightMNL.arrivalFlightIsEdit = false;
                            this.setting.flightMNL.arrivalAirlineIsEdit = false;
                            break;
                        case 'stipend' :
                            this.setting.host.nameIsEdit = false;
                            this.setting.host.positionIsEdit = false;
                            this.setting.host.locationIsEdit = false;
                            this.setting.host.housingIsEdit = false;
                            this.setting.host.startIsEdit = false;
                            this.setting.host.endIsEdit = false;
                            this.setting.host.stipendIsEdit = true;
                            this.setting.host.sponsorIsEdit = false;

                            this.setting.visa.programIsEdit = false;
                            this.setting.visa.sevisIsEdit = false;
                            this.setting.visa.schedule = false;

                            this.setting.flightUS.departureIsEdit = false;
                            this.setting.flightUS.departureTimeIsEdit = false;
                            this.setting.flightUS.departureFlightIsEdit = false;
                            this.setting.flightUS.departureAirlineIsEdit = false;
                            this.setting.flightUS.arrivalIsEdit = false;
                            this.setting.flightUS.arrivalTimeIsEdit = false;
                            this.setting.flightUS.arrivalFlightIsEdit = false;
                            this.setting.flightUS.arrivalAirlineIsEdit = true;

                            this.setting.flightMNL.departureIsEdit = false;
                            this.setting.flightMNL.departureTimeIsEdit = false;
                            this.setting.flightMNL.departureFlightIsEdit = false;
                            this.setting.flightMNL.departureAirlineIsEdit = false;
                            this.setting.flightMNL.arrivalIsEdit = false;
                            this.setting.flightMNL.arrivalTimeIsEdit = false;
                            this.setting.flightMNL.arrivalFlightIsEdit = false;
                            this.setting.flightMNL.arrivalAirlineIsEdit = false;
                            break;
                        case 'sponsor' :
                            this.setting.host.nameIsEdit = false;
                            this.setting.host.positionIsEdit = false;
                            this.setting.host.locationIsEdit = false;
                            this.setting.host.housingIsEdit = false;
                            this.setting.host.startIsEdit = false;
                            this.setting.host.endIsEdit = false;
                            this.setting.host.stipendIsEdit = false;
                            this.setting.host.sponsorIsEdit = true;

                            this.setting.visa.programIsEdit = false;
                            this.setting.visa.sevisIsEdit = false;
                            this.setting.visa.schedule = false;

                            this.setting.flightUS.departureIsEdit = false;
                            this.setting.flightUS.departureTimeIsEdit = false;
                            this.setting.flightUS.departureFlightIsEdit = false;
                            this.setting.flightUS.departureAirlineIsEdit = false;
                            this.setting.flightUS.arrivalIsEdit = false;
                            this.setting.flightUS.arrivalTimeIsEdit = false;
                            this.setting.flightUS.arrivalFlightIsEdit = false;
                            this.setting.flightUS.arrivalAirlineIsEdit = true;

                            this.setting.flightMNL.departureIsEdit = false;
                            this.setting.flightMNL.departureTimeIsEdit = false;
                            this.setting.flightMNL.departureFlightIsEdit = false;
                            this.setting.flightMNL.departureAirlineIsEdit = false;
                            this.setting.flightMNL.arrivalIsEdit = false;
                            this.setting.flightMNL.arrivalTimeIsEdit = false;
                            this.setting.flightMNL.arrivalFlightIsEdit = false;
                            this.setting.flightMNL.arrivalAirlineIsEdit = false;
                            break;
                        case 'sevis' :
                            this.setting.host.nameIsEdit = false;
                            this.setting.host.positionIsEdit = false;
                            this.setting.host.locationIsEdit = false;
                            this.setting.host.housingIsEdit = false;
                            this.setting.host.startIsEdit = false;
                            this.setting.host.endIsEdit = false;
                            this.setting.host.stipendIsEdit = false;
                            this.setting.host.sponsorIsEdit = false;

                            this.setting.visa.programIsEdit = false;
                            this.setting.visa.sevisIsEdit = true;
                            this.setting.visa.schedule = false;

                            this.setting.flightUS.departureIsEdit = false;
                            this.setting.flightUS.departureTimeIsEdit = false;
                            this.setting.flightUS.departureFlightIsEdit = false;
                            this.setting.flightUS.departureAirlineIsEdit = false;
                            this.setting.flightUS.arrivalIsEdit = false;
                            this.setting.flightUS.arrivalTimeIsEdit = false;
                            this.setting.flightUS.arrivalFlightIsEdit = false;
                            this.setting.flightUS.arrivalAirlineIsEdit = true;

                            this.setting.flightMNL.departureIsEdit = false;
                            this.setting.flightMNL.departureTimeIsEdit = false;
                            this.setting.flightMNL.departureFlightIsEdit = false;
                            this.setting.flightMNL.departureAirlineIsEdit = false;
                            this.setting.flightMNL.arrivalIsEdit = false;
                            this.setting.flightMNL.arrivalTimeIsEdit = false;
                            this.setting.flightMNL.arrivalFlightIsEdit = false;
                            this.setting.flightMNL.arrivalAirlineIsEdit = false;
                            break;
                        case 'program' :
                            this.setting.host.nameIsEdit = false;
                            this.setting.host.positionIsEdit = false;
                            this.setting.host.locationIsEdit = false;
                            this.setting.host.housingIsEdit = false;
                            this.setting.host.startIsEdit = false;
                            this.setting.host.endIsEdit = false;
                            this.setting.host.stipendIsEdit = false;
                            this.setting.host.sponsorIsEdit = false;

                            this.setting.visa.programIsEdit = true;
                            this.setting.visa.sevisIsEdit = false;
                            this.setting.visa.schedule = false;

                            this.setting.flightUS.departureIsEdit = false;
                            this.setting.flightUS.departureTimeIsEdit = false;
                            this.setting.flightUS.departureFlightIsEdit = false;
                            this.setting.flightUS.departureAirlineIsEdit = false;
                            this.setting.flightUS.arrivalIsEdit = false;
                            this.setting.flightUS.arrivalTimeIsEdit = false;
                            this.setting.flightUS.arrivalFlightIsEdit = false;
                            this.setting.flightUS.arrivalAirlineIsEdit = true;

                            this.setting.flightMNL.departureIsEdit = false;
                            this.setting.flightMNL.departureTimeIsEdit = false;
                            this.setting.flightMNL.departureFlightIsEdit = false;
                            this.setting.flightMNL.departureAirlineIsEdit = false;
                            this.setting.flightMNL.arrivalIsEdit = false;
                            this.setting.flightMNL.arrivalTimeIsEdit = false;
                            this.setting.flightMNL.arrivalFlightIsEdit = false;
                            this.setting.flightMNL.arrivalAirlineIsEdit = false;
                            break;
                        case 'schedule' :
                            this.setting.host.nameIsEdit = false;
                            this.setting.host.positionIsEdit = false;
                            this.setting.host.locationIsEdit = false;
                            this.setting.host.housingIsEdit = false;
                            this.setting.host.startIsEdit = false;
                            this.setting.host.endIsEdit = false;
                            this.setting.host.stipendIsEdit = false;
                            this.setting.host.sponsorIsEdit = false;

                            this.setting.visa.programIsEdit = false;
                            this.setting.visa.sevisIsEdit = false;
                            this.setting.visa.scheduleIsEdit = true;

                            this.setting.flightUS.departureIsEdit = false;
                            this.setting.flightUS.departureTimeIsEdit = false;
                            this.setting.flightUS.departureFlightIsEdit = false;
                            this.setting.flightUS.departureAirlineIsEdit = false;
                            this.setting.flightUS.arrivalIsEdit = false;
                            this.setting.flightUS.arrivalTimeIsEdit = false;
                            this.setting.flightUS.arrivalFlightIsEdit = false;
                            this.setting.flightUS.arrivalAirlineIsEdit = true;

                            this.setting.flightMNL.departureIsEdit = false;
                            this.setting.flightMNL.departureTimeIsEdit = false;
                            this.setting.flightMNL.departureFlightIsEdit = false;
                            this.setting.flightMNL.departureAirlineIsEdit = false;
                            this.setting.flightMNL.arrivalIsEdit = false;
                            this.setting.flightMNL.arrivalTimeIsEdit = false;
                            this.setting.flightMNL.arrivalFlightIsEdit = false;
                            this.setting.flightMNL.arrivalAirlineIsEdit = false;
                            break;
                        case 'us_departure_date' :
                            this.setting.host.nameIsEdit = false;
                            this.setting.host.positionIsEdit = false;
                            this.setting.host.locationIsEdit = false;
                            this.setting.host.housingIsEdit = false;
                            this.setting.host.startIsEdit = false;
                            this.setting.host.endIsEdit = false;
                            this.setting.host.stipendIsEdit = false;
                            this.setting.host.sponsorIsEdit = false;

                            this.setting.visa.programIsEdit = false;
                            this.setting.visa.sevisIsEdit = false;
                            this.setting.visa.scheduleIsEdit = false;

                            this.setting.flightUS.departureIsEdit = true;
                            this.setting.flightUS.departureTimeIsEdit = false;
                            this.setting.flightUS.departureFlightIsEdit = false;
                            this.setting.flightUS.departureAirlineIsEdit = false;
                            this.setting.flightUS.arrivalIsEdit = false;
                            this.setting.flightUS.arrivalTimeIsEdit = false;
                            this.setting.flightUS.arrivalFlightIsEdit = false;
                            this.setting.flightUS.arrivalAirlineIsEdit = false;

                            this.setting.flightMNL.departureIsEdit = false;
                            this.setting.flightMNL.departureTimeIsEdit = false;
                            this.setting.flightMNL.departureFlightIsEdit = false;
                            this.setting.flightMNL.departureAirlineIsEdit = false;
                            this.setting.flightMNL.arrivalIsEdit = false;
                            this.setting.flightMNL.arrivalTimeIsEdit = false;
                            this.setting.flightMNL.arrivalFlightIsEdit = false;
                            this.setting.flightMNL.arrivalAirlineIsEdit = false;
                            break;
                        case 'us_departure_time' :
                            this.setting.host.nameIsEdit = false;
                            this.setting.host.positionIsEdit = false;
                            this.setting.host.locationIsEdit = false;
                            this.setting.host.housingIsEdit = false;
                            this.setting.host.startIsEdit = false;
                            this.setting.host.endIsEdit = false;
                            this.setting.host.stipendIsEdit = false;
                            this.setting.host.sponsorIsEdit = false;

                            this.setting.visa.programIsEdit = false;
                            this.setting.visa.sevisIsEdit = false;
                            this.setting.visa.scheduleIsEdit = false;

                            this.setting.flightUS.departureIsEdit = false;
                            this.setting.flightUS.departureTimeIsEdit = true;
                            this.setting.flightUS.departureFlightIsEdit = false;
                            this.setting.flightUS.departureAirlineIsEdit = false;
                            this.setting.flightUS.arrivalIsEdit = false;
                            this.setting.flightUS.arrivalTimeIsEdit = false;
                            this.setting.flightUS.arrivalFlightIsEdit = false;
                            this.setting.flightUS.arrivalAirlineIsEdit = false;

                            this.setting.flightMNL.departureIsEdit = false;
                            this.setting.flightMNL.departureTimeIsEdit = false;
                            this.setting.flightMNL.departureFlightIsEdit = false;
                            this.setting.flightMNL.departureAirlineIsEdit = false;
                            this.setting.flightMNL.arrivalIsEdit = false;
                            this.setting.flightMNL.arrivalTimeIsEdit = false;
                            this.setting.flightMNL.arrivalFlightIsEdit = false;
                            this.setting.flightMNL.arrivalAirlineIsEdit = false;
                            break;
                        case 'us_departure_flight' :
                            this.setting.host.nameIsEdit = false;
                            this.setting.host.positionIsEdit = false;
                            this.setting.host.locationIsEdit = false;
                            this.setting.host.housingIsEdit = false;
                            this.setting.host.startIsEdit = false;
                            this.setting.host.endIsEdit = false;
                            this.setting.host.stipendIsEdit = false;
                            this.setting.host.sponsorIsEdit = false;

                            this.setting.visa.programIsEdit = false;
                            this.setting.visa.sevisIsEdit = false;
                            this.setting.visa.scheduleIsEdit = false;

                            this.setting.flightUS.departureIsEdit = false;
                            this.setting.flightUS.departureTimeIsEdit = false;
                            this.setting.flightUS.departureFlightIsEdit = true;
                            this.setting.flightUS.departureAirlineIsEdit = false;
                            this.setting.flightUS.arrivalIsEdit = false;
                            this.setting.flightUS.arrivalTimeIsEdit = false;
                            this.setting.flightUS.arrivalFlightIsEdit = false;
                            this.setting.flightUS.arrivalAirlineIsEdit = false;

                            this.setting.flightMNL.departureIsEdit = false;
                            this.setting.flightMNL.departureTimeIsEdit = false;
                            this.setting.flightMNL.departureFlightIsEdit = false;
                            this.setting.flightMNL.departureAirlineIsEdit = false;
                            this.setting.flightMNL.arrivalIsEdit = false;
                            this.setting.flightMNL.arrivalTimeIsEdit = false;
                            this.setting.flightMNL.arrivalFlightIsEdit = false;
                            this.setting.flightMNL.arrivalAirlineIsEdit = false;
                            break;
                        case 'us_departure_airline' :
                            this.setting.host.nameIsEdit = false;
                            this.setting.host.positionIsEdit = false;
                            this.setting.host.locationIsEdit = false;
                            this.setting.host.housingIsEdit = false;
                            this.setting.host.startIsEdit = false;
                            this.setting.host.endIsEdit = false;
                            this.setting.host.stipendIsEdit = false;
                            this.setting.host.sponsorIsEdit = false;

                            this.setting.visa.programIsEdit = false;
                            this.setting.visa.sevisIsEdit = false;
                            this.setting.visa.scheduleIsEdit = false;

                            this.setting.flightUS.departureIsEdit = false;
                            this.setting.flightUS.departureTimeIsEdit = false;
                            this.setting.flightUS.departureFlightIsEdit = false;
                            this.setting.flightUS.departureAirlineIsEdit = true;
                            this.setting.flightUS.arrivalIsEdit = false;
                            this.setting.flightUS.arrivalTimeIsEdit = false;
                            this.setting.flightUS.arrivalFlightIsEdit = false;
                            this.setting.flightUS.arrivalAirlineIsEdit = false;

                            this.setting.flightMNL.departureIsEdit = false;
                            this.setting.flightMNL.departureTimeIsEdit = false;
                            this.setting.flightMNL.departureFlightIsEdit = false;
                            this.setting.flightMNL.departureAirlineIsEdit = false;
                            this.setting.flightMNL.arrivalIsEdit = false;
                            this.setting.flightMNL.arrivalTimeIsEdit = false;
                            this.setting.flightMNL.arrivalFlightIsEdit = false;
                            this.setting.flightMNL.arrivalAirlineIsEdit = false;
                            break;
                        case 'us_arrival_date' :
                            this.setting.host.nameIsEdit = false;
                            this.setting.host.positionIsEdit = false;
                            this.setting.host.locationIsEdit = false;
                            this.setting.host.housingIsEdit = false;
                            this.setting.host.startIsEdit = false;
                            this.setting.host.endIsEdit = false;
                            this.setting.host.stipendIsEdit = false;
                            this.setting.host.sponsorIsEdit = false;

                            this.setting.visa.programIsEdit = false;
                            this.setting.visa.sevisIsEdit = false;
                            this.setting.visa.scheduleIsEdit = false;

                            this.setting.flightUS.departureIsEdit = false;
                            this.setting.flightUS.departureTimeIsEdit = false;
                            this.setting.flightUS.departureFlightIsEdit = false;
                            this.setting.flightUS.departureAirlineIsEdit = false;
                            this.setting.flightUS.arrivalIsEdit = true;
                            this.setting.flightUS.arrivalTimeIsEdit = false;
                            this.setting.flightUS.arrivalFlightIsEdit = false;
                            this.setting.flightUS.arrivalAirlineIsEdit = false;

                            this.setting.flightMNL.departureIsEdit = false;
                            this.setting.flightMNL.departureTimeIsEdit = false;
                            this.setting.flightMNL.departureFlightIsEdit = false;
                            this.setting.flightMNL.departureAirlineIsEdit = false;
                            this.setting.flightMNL.arrivalIsEdit = false;
                            this.setting.flightMNL.arrivalTimeIsEdit = false;
                            this.setting.flightMNL.arrivalFlightIsEdit = false;
                            this.setting.flightMNL.arrivalAirlineIsEdit = false;
                            break;
                        case 'us_arrival_time' :
                            this.setting.host.nameIsEdit = false;
                            this.setting.host.positionIsEdit = false;
                            this.setting.host.locationIsEdit = false;
                            this.setting.host.housingIsEdit = false;
                            this.setting.host.startIsEdit = false;
                            this.setting.host.endIsEdit = false;
                            this.setting.host.stipendIsEdit = false;
                            this.setting.host.sponsorIsEdit = false;

                            this.setting.visa.programIsEdit = false;
                            this.setting.visa.sevisIsEdit = false;
                            this.setting.visa.scheduleIsEdit = false;

                            this.setting.flightUS.departureIsEdit = false;
                            this.setting.flightUS.departureTimeIsEdit = false;
                            this.setting.flightUS.departureFlightIsEdit = false;
                            this.setting.flightUS.departureAirlineIsEdit = false;
                            this.setting.flightUS.arrivalIsEdit = false;
                            this.setting.flightUS.arrivalTimeIsEdit = true;
                            this.setting.flightUS.arrivalFlightIsEdit = false;
                            this.setting.flightUS.arrivalAirlineIsEdit = false;

                            this.setting.flightMNL.departureIsEdit = false;
                            this.setting.flightMNL.departureTimeIsEdit = false;
                            this.setting.flightMNL.departureFlightIsEdit = false;
                            this.setting.flightMNL.departureAirlineIsEdit = false;
                            this.setting.flightMNL.arrivalIsEdit = false;
                            this.setting.flightMNL.arrivalTimeIsEdit = false;
                            this.setting.flightMNL.arrivalFlightIsEdit = false;
                            this.setting.flightMNL.arrivalAirlineIsEdit = false;
                            break;
                        case 'us_arrival_flight' :
                            this.setting.host.nameIsEdit = false;
                            this.setting.host.positionIsEdit = false;
                            this.setting.host.locationIsEdit = false;
                            this.setting.host.housingIsEdit = false;
                            this.setting.host.startIsEdit = false;
                            this.setting.host.endIsEdit = false;
                            this.setting.host.stipendIsEdit = false;
                            this.setting.host.sponsorIsEdit = false;

                            this.setting.visa.programIsEdit = false;
                            this.setting.visa.sevisIsEdit = false;
                            this.setting.visa.scheduleIsEdit = false;

                            this.setting.flightUS.departureIsEdit = false;
                            this.setting.flightUS.departureTimeIsEdit = false;
                            this.setting.flightUS.departureFlightIsEdit = false;
                            this.setting.flightUS.departureAirlineIsEdit = false;
                            this.setting.flightUS.arrivalIsEdit = false;
                            this.setting.flightUS.arrivalTimeIsEdit = false;
                            this.setting.flightUS.arrivalFlightIsEdit = true;
                            this.setting.flightUS.arrivalAirlineIsEdit = false;

                            this.setting.flightMNL.departureIsEdit = false;
                            this.setting.flightMNL.departureTimeIsEdit = false;
                            this.setting.flightMNL.departureFlightIsEdit = false;
                            this.setting.flightMNL.departureAirlineIsEdit = false;
                            this.setting.flightMNL.arrivalIsEdit = false;
                            this.setting.flightMNL.arrivalTimeIsEdit = false;
                            this.setting.flightMNL.arrivalFlightIsEdit = false;
                            this.setting.flightMNL.arrivalAirlineIsEdit = false;
                            break;
                        case 'us_arrival_airline' :
                            this.setting.host.nameIsEdit = false;
                            this.setting.host.positionIsEdit = false;
                            this.setting.host.locationIsEdit = false;
                            this.setting.host.housingIsEdit = false;
                            this.setting.host.startIsEdit = false;
                            this.setting.host.endIsEdit = false;
                            this.setting.host.stipendIsEdit = false;
                            this.setting.host.sponsorIsEdit = false;

                            this.setting.visa.programIsEdit = false;
                            this.setting.visa.sevisIsEdit = false;
                            this.setting.visa.scheduleIsEdit = false;

                            this.setting.flightUS.departureIsEdit = false;
                            this.setting.flightUS.departureTimeIsEdit = false;
                            this.setting.flightUS.departureFlightIsEdit = false;
                            this.setting.flightUS.departureAirlineIsEdit = false;
                            this.setting.flightUS.arrivalIsEdit = false;
                            this.setting.flightUS.arrivalTimeIsEdit = false;
                            this.setting.flightUS.arrivalFlightIsEdit = false;
                            this.setting.flightUS.arrivalAirlineIsEdit = true;

                            this.setting.flightMNL.departureIsEdit = false;
                            this.setting.flightMNL.departureTimeIsEdit = false;
                            this.setting.flightMNL.departureFlightIsEdit = false;
                            this.setting.flightMNL.departureAirlineIsEdit = false;
                            this.setting.flightMNL.arrivalIsEdit = false;
                            this.setting.flightMNL.arrivalTimeIsEdit = false;
                            this.setting.flightMNL.arrivalFlightIsEdit = false;
                            this.setting.flightMNL.arrivalAirlineIsEdit = false;
                            break;
                        case 'mnl_departure_date' :
                            this.setting.host.nameIsEdit = false;
                            this.setting.host.positionIsEdit = false;
                            this.setting.host.locationIsEdit = false;
                            this.setting.host.housingIsEdit = false;
                            this.setting.host.startIsEdit = false;
                            this.setting.host.endIsEdit = false;
                            this.setting.host.stipendIsEdit = false;
                            this.setting.host.sponsorIsEdit = false;

                            this.setting.visa.programIsEdit = false;
                            this.setting.visa.sevisIsEdit = false;
                            this.setting.visa.scheduleIsEdit = false;

                            this.setting.flightUS.departureIsEdit = false;
                            this.setting.flightUS.departureTimeIsEdit = false;
                            this.setting.flightUS.departureFlightIsEdit = false;
                            this.setting.flightUS.departureAirlineIsEdit = false;
                            this.setting.flightUS.arrivalIsEdit = false;
                            this.setting.flightUS.arrivalTimeIsEdit = false;
                            this.setting.flightUS.arrivalFlightIsEdit = false;
                            this.setting.flightUS.arrivalAirlineIsEdit = false;

                            this.setting.flightMNL.departureIsEdit = true;
                            this.setting.flightMNL.departureTimeIsEdit = false;
                            this.setting.flightMNL.departureFlightIsEdit = false;
                            this.setting.flightMNL.departureAirlineIsEdit = false;
                            this.setting.flightMNL.arrivalIsEdit = false;
                            this.setting.flightMNL.arrivalTimeIsEdit = false;
                            this.setting.flightMNL.arrivalFlightIsEdit = false;
                            this.setting.flightMNL.arrivalAirlineIsEdit = false;
                            break;
                        case 'mnl_departure_time' :
                            this.setting.host.nameIsEdit = false;
                            this.setting.host.positionIsEdit = false;
                            this.setting.host.locationIsEdit = false;
                            this.setting.host.housingIsEdit = false;
                            this.setting.host.startIsEdit = false;
                            this.setting.host.endIsEdit = false;
                            this.setting.host.stipendIsEdit = false;
                            this.setting.host.sponsorIsEdit = false;

                            this.setting.visa.programIsEdit = false;
                            this.setting.visa.sevisIsEdit = false;
                            this.setting.visa.scheduleIsEdit = false;

                            this.setting.flightUS.departureIsEdit = false;
                            this.setting.flightUS.departureTimeIsEdit = false;
                            this.setting.flightUS.departureFlightIsEdit = false;
                            this.setting.flightUS.departureAirlineIsEdit = false;
                            this.setting.flightUS.arrivalIsEdit = false;
                            this.setting.flightUS.arrivalTimeIsEdit = false;
                            this.setting.flightUS.arrivalFlightIsEdit = false;
                            this.setting.flightUS.arrivalAirlineIsEdit = false;

                            this.setting.flightMNL.departureIsEdit = false;
                            this.setting.flightMNL.departureTimeIsEdit = true;
                            this.setting.flightMNL.departureFlightIsEdit = false;
                            this.setting.flightMNL.departureAirlineIsEdit = false;
                            this.setting.flightMNL.arrivalIsEdit = false;
                            this.setting.flightMNL.arrivalTimeIsEdit = false;
                            this.setting.flightMNL.arrivalFlightIsEdit = false;
                            this.setting.flightMNL.arrivalAirlineIsEdit = false;
                            break;
                        case 'mnl_departure_flight' :
                            this.setting.host.nameIsEdit = false;
                            this.setting.host.positionIsEdit = false;
                            this.setting.host.locationIsEdit = false;
                            this.setting.host.housingIsEdit = false;
                            this.setting.host.startIsEdit = false;
                            this.setting.host.endIsEdit = false;
                            this.setting.host.stipendIsEdit = false;
                            this.setting.host.sponsorIsEdit = false;

                            this.setting.visa.programIsEdit = false;
                            this.setting.visa.sevisIsEdit = false;
                            this.setting.visa.scheduleIsEdit = false;

                            this.setting.flightUS.departureIsEdit = false;
                            this.setting.flightUS.departureTimeIsEdit = false;
                            this.setting.flightUS.departureFlightIsEdit = false;
                            this.setting.flightUS.departureAirlineIsEdit = false;
                            this.setting.flightUS.arrivalIsEdit = false;
                            this.setting.flightUS.arrivalTimeIsEdit = false;
                            this.setting.flightUS.arrivalFlightIsEdit = false;
                            this.setting.flightUS.arrivalAirlineIsEdit = false;

                            this.setting.flightMNL.departureIsEdit = false;
                            this.setting.flightMNL.departureTimeIsEdit = false;
                            this.setting.flightMNL.departureFlightIsEdit = true;
                            this.setting.flightMNL.departureAirlineIsEdit = false;
                            this.setting.flightMNL.arrivalIsEdit = false;
                            this.setting.flightMNL.arrivalTimeIsEdit = false;
                            this.setting.flightMNL.arrivalFlightIsEdit = false;
                            this.setting.flightMNL.arrivalAirlineIsEdit = false;
                            break;
                        case 'mnl_departure_airline' :
                            this.setting.host.nameIsEdit = false;
                            this.setting.host.positionIsEdit = false;
                            this.setting.host.locationIsEdit = false;
                            this.setting.host.housingIsEdit = false;
                            this.setting.host.startIsEdit = false;
                            this.setting.host.endIsEdit = false;
                            this.setting.host.stipendIsEdit = false;
                            this.setting.host.sponsorIsEdit = false;

                            this.setting.visa.programIsEdit = false;
                            this.setting.visa.sevisIsEdit = false;
                            this.setting.visa.scheduleIsEdit = false;

                            this.setting.flightUS.departureIsEdit = false;
                            this.setting.flightUS.departureTimeIsEdit = false;
                            this.setting.flightUS.departureFlightIsEdit = false;
                            this.setting.flightUS.departureAirlineIsEdit = false;
                            this.setting.flightUS.arrivalIsEdit = false;
                            this.setting.flightUS.arrivalTimeIsEdit = false;
                            this.setting.flightUS.arrivalFlightIsEdit = false;
                            this.setting.flightUS.arrivalAirlineIsEdit = false;

                            this.setting.flightMNL.departureIsEdit = false;
                            this.setting.flightMNL.departureTimeIsEdit = false;
                            this.setting.flightMNL.departureFlightIsEdit = false;
                            this.setting.flightMNL.departureAirlineIsEdit = true;
                            this.setting.flightMNL.arrivalIsEdit = false;
                            this.setting.flightMNL.arrivalTimeIsEdit = false;
                            this.setting.flightMNL.arrivalFlightIsEdit = false;
                            this.setting.flightMNL.arrivalAirlineIsEdit = false;
                            break;
                        case 'mnl_arrival_date' :
                            this.setting.host.nameIsEdit = false;
                            this.setting.host.positionIsEdit = false;
                            this.setting.host.locationIsEdit = false;
                            this.setting.host.housingIsEdit = false;
                            this.setting.host.startIsEdit = false;
                            this.setting.host.endIsEdit = false;
                            this.setting.host.stipendIsEdit = false;
                            this.setting.host.sponsorIsEdit = false;

                            this.setting.visa.programIsEdit = false;
                            this.setting.visa.sevisIsEdit = false;
                            this.setting.visa.scheduleIsEdit = false;

                            this.setting.flightUS.departureIsEdit = false;
                            this.setting.flightUS.departureTimeIsEdit = false;
                            this.setting.flightUS.departureFlightIsEdit = false;
                            this.setting.flightUS.departureAirlineIsEdit = false;
                            this.setting.flightUS.arrivalIsEdit = false;
                            this.setting.flightUS.arrivalTimeIsEdit = false;
                            this.setting.flightUS.arrivalFlightIsEdit = false;
                            this.setting.flightUS.arrivalAirlineIsEdit = false;

                            this.setting.flightMNL.departureIsEdit = false;
                            this.setting.flightMNL.departureTimeIsEdit = false;
                            this.setting.flightMNL.departureFlightIsEdit = false;
                            this.setting.flightMNL.departureAirlineIsEdit = false;
                            this.setting.flightMNL.arrivalIsEdit = true;
                            this.setting.flightMNL.arrivalTimeIsEdit = false;
                            this.setting.flightMNL.arrivalFlightIsEdit = false;
                            this.setting.flightMNL.arrivalAirlineIsEdit = false;
                            break;
                        case 'mnl_arrival_time' :
                            this.setting.host.nameIsEdit = false;
                            this.setting.host.positionIsEdit = false;
                            this.setting.host.locationIsEdit = false;
                            this.setting.host.housingIsEdit = false;
                            this.setting.host.startIsEdit = false;
                            this.setting.host.endIsEdit = false;
                            this.setting.host.stipendIsEdit = false;
                            this.setting.host.sponsorIsEdit = false;

                            this.setting.visa.programIsEdit = false;
                            this.setting.visa.sevisIsEdit = false;
                            this.setting.visa.scheduleIsEdit = false;

                            this.setting.flightUS.departureIsEdit = false;
                            this.setting.flightUS.departureTimeIsEdit = false;
                            this.setting.flightUS.departureFlightIsEdit = false;
                            this.setting.flightUS.departureAirlineIsEdit = false;
                            this.setting.flightUS.arrivalIsEdit = false;
                            this.setting.flightUS.arrivalTimeIsEdit = false;
                            this.setting.flightUS.arrivalFlightIsEdit = false;
                            this.setting.flightUS.arrivalAirlineIsEdit = false;

                            this.setting.flightMNL.departureIsEdit = false;
                            this.setting.flightMNL.departureTimeIsEdit = false;
                            this.setting.flightMNL.departureFlightIsEdit = false;
                            this.setting.flightMNL.departureAirlineIsEdit = false;
                            this.setting.flightMNL.arrivalIsEdit = false;
                            this.setting.flightMNL.arrivalTimeIsEdit = true;
                            this.setting.flightMNL.arrivalFlightIsEdit = false;
                            this.setting.flightMNL.arrivalAirlineIsEdit = false;
                            break;
                        case 'mnl_arrival_flight' :
                            this.setting.host.nameIsEdit = false;
                            this.setting.host.positionIsEdit = false;
                            this.setting.host.locationIsEdit = false;
                            this.setting.host.housingIsEdit = false;
                            this.setting.host.startIsEdit = false;
                            this.setting.host.endIsEdit = false;
                            this.setting.host.stipendIsEdit = false;
                            this.setting.host.sponsorIsEdit = false;

                            this.setting.visa.programIsEdit = false;
                            this.setting.visa.sevisIsEdit = false;
                            this.setting.visa.scheduleIsEdit = false;

                            this.setting.flightUS.departureIsEdit = false;
                            this.setting.flightUS.departureTimeIsEdit = false;
                            this.setting.flightUS.departureFlightIsEdit = false;
                            this.setting.flightUS.departureAirlineIsEdit = false;
                            this.setting.flightUS.arrivalIsEdit = false;
                            this.setting.flightUS.arrivalTimeIsEdit = false;
                            this.setting.flightUS.arrivalFlightIsEdit = false;
                            this.setting.flightUS.arrivalAirlineIsEdit = false;

                            this.setting.flightMNL.departureIsEdit = false;
                            this.setting.flightMNL.departureTimeIsEdit = false;
                            this.setting.flightMNL.departureFlightIsEdit = false;
                            this.setting.flightMNL.departureAirlineIsEdit = false;
                            this.setting.flightMNL.arrivalIsEdit = false;
                            this.setting.flightMNL.arrivalTimeIsEdit = false;
                            this.setting.flightMNL.arrivalFlightIsEdit = true;
                            this.setting.flightMNL.arrivalAirlineIsEdit = false;
                            break;
                        case 'mnl_arrival_airline' :
                            this.setting.host.nameIsEdit = false;
                            this.setting.host.positionIsEdit = false;
                            this.setting.host.locationIsEdit = false;
                            this.setting.host.housingIsEdit = false;
                            this.setting.host.startIsEdit = false;
                            this.setting.host.endIsEdit = false;
                            this.setting.host.stipendIsEdit = false;
                            this.setting.host.sponsorIsEdit = false;

                            this.setting.visa.programIsEdit = false;
                            this.setting.visa.sevisIsEdit = false;
                            this.setting.visa.scheduleIsEdit = false;

                            this.setting.flightUS.departureIsEdit = false;
                            this.setting.flightUS.departureTimeIsEdit = false;
                            this.setting.flightUS.departureFlightIsEdit = false;
                            this.setting.flightUS.departureAirlineIsEdit = false;
                            this.setting.flightUS.arrivalIsEdit = false;
                            this.setting.flightUS.arrivalTimeIsEdit = false;
                            this.setting.flightUS.arrivalFlightIsEdit = false;
                            this.setting.flightUS.arrivalAirlineIsEdit = false;

                            this.setting.flightMNL.departureIsEdit = false;
                            this.setting.flightMNL.departureTimeIsEdit = false;
                            this.setting.flightMNL.departureFlightIsEdit = false;
                            this.setting.flightMNL.departureAirlineIsEdit = false;
                            this.setting.flightMNL.arrivalIsEdit = false;
                            this.setting.flightMNL.arrivalTimeIsEdit = false;
                            this.setting.flightMNL.arrivalFlightIsEdit = false;
                            this.setting.flightMNL.arrivalAirlineIsEdit = true;
                            break;
                    }
                }
            }
        })
    </script>
@endsection
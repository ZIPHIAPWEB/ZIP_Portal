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
                <div class="box-body" style="overflow-x: auto">
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
                            <label for="" class="control-label">Filter By Status</label>
                            <select v-model="filter.status" class="form-control input-sm">
                                <option value="" selected>All</option>
                                <option value="New Applicant">New Applicant</option>
                                <option value="Called">Called</option>
                                <option value="Assessed">Assessed</option>
                                <option value="Confirmed">Confirmed</option>
                                <option value="Hired">Hired</option>
                                <option value="For Visa Interview">For Visa Interview</option>
                                <option value="For PDOS & CFO">For PDOS & CFO</option>
                                <option value="Program Proper">Program Proper</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Filter By Branch</label>
                            <select v-model="filter.branch" name="" id="" class="form-control input-sm">
                                <option value="" selected>All</option>
                                <option value="MANILA">Manila</option>
                                <option value="PAMPANGA">Pampanga</option>
                                <option value="CEBU">Cebu</option>
                                <option value="BACOLOD">Bacolod</option>
                                <option value="DAVAO">Davao</option>
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
                            <th class="text-center" style="width: 10%">Email</th>
                            <th class="text-center" style="width: 10%">First Name</th>
                            <th class="text-center" style="width: 10%">Middle Name</th>
                            <th class="text-center" style="width: 10%">Last Name</th>
                            <th class="text-center" style="width: 10%">Contact</th>
                            <th class="text-center" style="width: 10%">School</th>
                            <th class="text-center" style="width: 10%">Branch</th>
                            <th class="text-center" style="width: 10%">Program</th>
                            <th class="text-center" style="width: 10%">Recent Action</th>
                            <th class="text-center" style="width: 10%">Action</th>
                        </thead>
                        <tbody v-if="filteredStudents.length > 0">
                            <tr v-if="loading.table">
                                <td valign="top" colspan="15" class="text-center">
                                    <span class="fa fa-circle-o-notch fa-spin"></span>
                                </td>
                            </tr>
                            <tr v-else v-for="student in filteredStudents">
                                <td class="text-sm text-center">@{{ student.created_at }}</td>
                            <td class="text-center"><span :style="statusColor(student.application_status)" class="label label-sm">@{{ student.application_status }} @{{ (student.application_status == 'Called') ? `: ${student.contacted_status}` : '' }}</span></td>
                                <td class="text-sm text-center">@{{ student.application_id }}</td>
                                <td class="text-sm text-center">@{{ student.user.email }}</td>
                                <td class="text-sm text-center">@{{ student.first_name }}</td>
                                <td class="text-sm text-center">@{{ student.middle_name }}</td>
                                <td class="text-sm text-center">@{{ student.last_name }}</td>
                                <td class="text-sm text-center">@{{ student.mobile_number }}/@{{ student.home_number }}</td>
                                <td class="text-sm text-center"><div v-if="student.tertiary.school"> @{{ student.tertiary.school.name }}</div></td>
                                <td class="text-sm text-center">@{{ student.branch }}</td>
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
                <!--<div class="box-footer">
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
                </div>-->
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
                                    <a href="#tab-basic-req" data-toggle="tab" aria-expanded="true">Preliminary Reqts</a>
                                </li>
                                <li>
                                    <a href="#tab-visa-req" data-toggle="tab" aria-expanded="true">Visa Sponsor Reqts.</a>
                                </li>
                                <li>
                                    <a href="#tab-additional-req" data-toggle="tab" aria-expanded="true">Additional Reqts.</a>
                                </li>
                                <li>
                                    <a href="#tab-payment-req" data-toggle="tab" aria-expanded="true">Payment Reqts.</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active m-t-10" id="tab-profile">
                                    <section id="program" v-if="student.application_status == 'New Applicant' || student.application_status == 'Assessed'">
                                        <table class="table table-condensed table-striped table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td class="text-sm" style="width: 25%">
                                                        Program
                                                    </td>
                                                    <td class="text-bold">
                                                        <select @change="setProgram(selProgram)" v-model="selProgram" class="form-control input-sm">
                                                            <option value="">@{{ student.program ? student.program.name : '' }}</option>
                                                            <option v-for="program in programs.data" :value="program.id">@{{ program.name }}</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </section>
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
                                                            <option value="Called">Called</option>
                                                            <option value="Assessed">Assessed</option>
                                                            <option value="Confirmed">Confirmed</option>
                                                            <option value="Hired">Hired</option>
                                                            <option value="ForVisaInterview">For Visa Interview</option>
                                                            <option value="ForPDOSCFO">For PDOS & CFO</option>
                                                            <option value="ProgramProper">Program Proper</option>
                                                            <option value="Canceled">Cancel</option>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr v-if="student.application_status === 'Called'">
                                                <td class="text-sm">
                                                    Contacted Status
                                                </td>
                                                <td class="text-bold text-center">
                                                    <div class="form-group-sm">
                                                        <select @change="setContactStatus" class="form-control">
                                                        <option value="">@{{ student.contacted_status }}</option>
                                                            <option value="1st Attempt - CBR">1st Attempt - CBR</option>
                                                            <option value="2nd Attempt - CBR">2nd Attempt - CBR</option>
                                                            <option value="3rd Attempt - CBR">3rd Attempt - CBR</option>
                                                            <option value="Scheduled For Assessment">Scheduled For Assessment</option>
                                                            <option value="Client Undecided">Client Undecided</option>
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
                                                    <div class="form-group col-xs-12 col-md-6">
                                                        <label class="label-control">SEVIS ID</label>
                                                        <input v-model="visa.sevis" type="text" class="form-control input-sm" placeholder="Enter the SEVIS ID">
                                                    </div>
                                                    <div class="form-group col-xs-12 col-md-6">
                                                        <label class="control-label">Program ID</label>
                                                        <input v-model="visa.programId" type="text" class="form-control input-sm" placeholder="Enter the Program ID">
                                                    </div>
                                                    <div class="form-group col-xs-12 col-md-6">
                                                        <label class="control-label">Trial Schedule</label>
                                                        <input v-model="visa.trial_schedule" type="date" class="form-control input-sm">
                                                    </div>
                                                    <div class="form-group col-xs-12 col-md-6">
                                                        <label class="control-label">Trial Time</label>
                                                        <input v-model="visa.trial_time" type="text" class="form-control input-sm" placeholder="Enter trial time">
                                                    </div>
                                                    <div class="form-group col-xs-12 col-md-6">
                                                        <label class="control-label">Interview Schedule</label>
                                                        <input v-model="visa.schedule" type="date" class="form-control input-sm">
                                                    </div>
                                                    <div class="form-group col-xs-12 col-md-6">
                                                        <label class="control-label">Interview Time</label>
                                                        <input v-model="visa.time" type="text" class="form-control input-sm" placeholder="Enter interview time">
                                                    </div>
                                                    <div class="form-group-sm col-xs-12">
                                                        <button @click="submitForVisaInterview()" class="btn btn-primary btn-flat btn-block btn-sm">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <section v-if="show.pdoscfo">
                                            <div class="box box-primary">
                                                <div class="box-header">
                                                    <div class="box-tools pull-right">
                                                        <button @click="show.pdoscfo = false;" class="btn btn-box-tool">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="box-body">
                                                    <div class="form-group col-xs-12 col-md-6">
                                                        <label class="label-control">PDOS Schedule</label>
                                                        <input v-model="program.pdos_schedule" type="date" class="form-control input-sm">
                                                    </div>
                                                    <div class="form-group col-xs12 col-md-6">
                                                        <label class="label-control">PDOS Time</label>
                                                        <input v-model="program.pdos_time" type="text" class="form-control input-sm">
                                                    </div>
                                                    <div class="form-group col-xs-12 col-md-6">
                                                        <label class="label-control">CFO Schedule</label>
                                                        <input v-model="program.cfo_schedule" type="date" class="form-control input-sm">
                                                    </div>
                                                    <div class="form-group col-xs-12 col-md-6">
                                                        <label class="label-control">CFO Time</label>
                                                        <input v-model="program.cfo_time" type="text" class="form-control input-sm">
                                                    </div>
                                                    <div class="form-group-sm col-xs-12">
                                                        <button @click="submitForPDOSAndCFO()" class="btn btn-primary btn-flat btn-block btn-sm">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <section v-if="show.cancel">
                                            <div class="box box-primary">
                                                <div class="box-header">
                                                    <div class="box-tools pull-right">
                                                        <button @click="show.cancel = false;" class="btn btn-box-tool">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="box-body">
                                                    <div class="form-group col-xs-6">
                                                        <label for="" class="control-label">Reason</label>
                                                        <select v-model="cancel.status" class="form-control input-sm">
                                                            <option value="">Select Reason Of Cancellation</option>
                                                            <option value="Cancel: Unqualified">Unqualified</option>
                                                            <option value="Cancel: Visa Denial">Visa Denial</option>
                                                            <option value="Cancel: Program Cancellation">Program Cancellation</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group-sm col-xs-12">
                                                        <button @click="setCancellationStatus" class="btn btn-primary btn-flat btn-block btn-sm">Submit</button>
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
                                                    Email
                                                </td>
                                                <td v-cloak class="text-sm text-bold">
                                                    @{{ student.user.email }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Skype ID
                                                </td>
                                                <td v-cloak class="text-sm text-bold">
                                                    @{{ student.skype_id }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Facebook URL
                                                </td>
                                                <td v-cloak class="text-sm text-bold">
                                                    <a :href="student.fb_email">@{{ student.fb_email }}</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Branch
                                                </td>
                                                <td v-cloak class="text-sm text-bold">
                                                    @{{ student.branch }}
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
                                                        Tertiary Level
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-sm" style="width: 200px">
                                                        School
                                                    </td>
                                                    <td v-cloak v-if="student.tertiary.school" class="text-sm text-bold">
                                                        @{{ student.tertiary.school.name }}
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
                                                        Start Date
                                                    </td>
                                                    <td v-cloak class="text-sm text-bold">
                                                        @{{ student.tertiary.start_date }}
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
                                        <table class="table table-striped table-bordered table-condensed">
                                            <tr>
                                                <td colspan="2" class="text-bold">
                                                    Secondary Level
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
                                            <!--
                                            <tr>
                                                <td class="text-sm">
                                                    Start Date
                                                </td>
                                                <td v-cloak class="text-sm text-bold">
                                                    @{{ student.secondary.start_date }}
                                                </td>
                                            </tr>
                                            -->
                                            <tr>
                                                <td class="text-sm">
                                                    Date Graduated
                                                </td>
                                                <td v-cloak class="text-sm text-bold">
                                                    @{{ student.secondary.date_graduated | toFormattedDateString }}
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
                                    <section v-if="student.application_status === 'Hired' || student.application_status === 'For Visa Interview' || student.application_status === 'For PDOS & CFO' || student.application_status === 'Program Proper'" id="host-company-details">
                                        <label class="control-label">Host Company Details</label>
                                        <table class="table table-striped table-bordered table-condensed">
                                            <tr>
                                                <td colspan="2">
                                                    <button v-if="!settings.hostCompanyIsEdit" @click="settings.hostCompanyIsEdit = true" class="btn btn-primary btn-xs pull-right"><span class="fa fa-pencil"></span></button>
                                                    <div v-else>
                                                        <button @click="settings.hostCompanyIsEdit = false" class="btn btn-danger btn-xs pull-right"><span class="fa fa-times"></span></button>
                                                        <button @click="updateHostCompanyDetails" class="btn btn-success btn-xs pull-right" style="margin-right: 5px"><span class="fa fa-check"></span></button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm" style="width: 200px">
                                                    Visa Sponsor
                                                </td>
                                                <td v-if="!settings.hostCompanyIsEdit" v-cloak class="text-bold">
                                                    <label class="text-sm">@{{ student.sponsor.name }}</label>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group-sm">
                                                        <select v-model="host.sponsor" class="form-control input-sm">
                                                            <option value="">Select visa sponsor</option>
                                                            <option v-for="sponsor in sponsors" :value="sponsor.id">@{{ sponsor.name }}</option>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Host Company
                                                </td>
                                                <td v-if="!settings.hostCompanyIsEdit" v-cloak class="text-bold">
                                                    <label class="text-sm">@{{ student.company.name }}</label>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group-sm">
                                                        <select v-model="host.name" class="form-control input-sm">
                                                            <option value="">Select host company</option>
                                                            <option v-for="host in hosts" :value="host.id">@{{ host.name }}</option>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Location
                                                </td>
                                                <td v-if="!settings.hostCompanyIsEdit" v-cloak class="text-bold">
                                                    <label class="text-sm">@{{ student.location }}</label>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group-sm">
                                                        <select v-model="host.place" class="form-control input-sm">
                                                            <option value="">Select Location</option>
                                                            <option v-for="state in states" :value="state.display_name">@{{ state.name }}</option>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Housing Address
                                                </td>
                                                <td v-if="!settings.hostCompanyIsEdit" v-cloak class="text-bold">
                                                    <label class="text-sm">@{{ student.housing_details }}</label>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group-sm">
                                                        <input v-model="host.housing" type="text" class="form-control input-sm" placeholder="Enter housing address">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Position
                                                </td>
                                                <td v-if="!settings.hostCompanyIsEdit" v-cloak class="text-bold">
                                                    <label class="text-sm">@{{ student.position }}</label>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group-sm">
                                                        <select v-model="host.position" class="form-control input-sm">
                                                            <option value="">Select Position</option>
                                                            <option v-for="position in positions" :value="position.display_name">@{{ position.name }}</option>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Stipend Per Hour
                                                </td>
                                                <td v-if="!settings.hostCompanyIsEdit" v-cloak class="text-bold">
                                                    <label class="text-sm">@{{ student.stipend }}</label>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group-sm">
                                                        <input v-model="host.stipend" type="text" class="form-control input-sm" placeholder="Enter applicant stipend">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">Start Date</td>
                                                <td v-if="!settings.hostCompanyIsEdit">
                                                    <label class="text-sm">@{{ student.program_start_date | toFormattedDateString }}</label>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group-sm">
                                                        <input v-model="host.start" type="date" class="form-control input-sm">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">End Date</td>
                                                <td v-if="!settings.hostCompanyIsEdit">
                                                    <label class="text-sm">@{{ student.program_end_date | toFormattedDateString }}</label>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group-sm">
                                                        <input v-model="host.end" type="date" class="form-control input-sm">
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </section>
                                    <section v-if="student.application_status === 'For Visa Interview' || student.application_status === 'For PDOS & CFO' || student.application_status === 'Program Proper'" id="visa-interview-details">
                                        <label class="control-label">Visa Interview Details</label>
                                        <table class="table table-striped table-bordered table-condensed">
                                            <tr>
                                                <td colspan="2">
                                                    <button v-if="!settings.visaInterviewIsEdit" @click="settings.visaInterviewIsEdit = true" class="btn btn-primary btn-xs pull-right"><span class="fa fa-pencil"></span></button>
                                                    <div v-else>
                                                        <button @click="settings.visaInterviewIsEdit = false" class="btn btn-danger btn-xs pull-right"><span class="fa fa-times"></span></button>
                                                        <button @click="updateVisaInterviewDetails" class="btn btn-success btn-xs pull-right" style="margin-right: 5px;"><span class="fa fa-check"></span></button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm" style="width: 200px">
                                                    Program ID Number
                                                </td>
                                                <td v-if="!settings.visaInterviewIsEdit" v-cloak class="text-bold">
                                                    <label class="text-sm">@{{ student.program_id_no }}</label>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group-sm">
                                                        <input v-model="visa.programId" type="text" class="form-control input-sm" placeholder="Enter Program ID Number...">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    SEVIS ID
                                                </td>
                                                <td v-if="!settings.visaInterviewIsEdit" v-cloak class="text-bold">
                                                    <label class="text-sm">@{{ student.sevis_id }}</label>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group-sm">
                                                        <input v-model="visa.sevis" type="text" class="form-control input-sm" placeholder="Enter SEVIS ID...">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Visa Interview Schedule
                                                </td>
                                                <td v-if="!settings.visaInterviewIsEdit">
                                                    <label class="text-sm">@{{ student.visa_interview_schedule | toFormattedDateString }}</label>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group-sm">
                                                        <input v-model="visa.schedule" type="date" class="form-control input-sm">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Visa Interview Time
                                                </td>
                                                <td v-if="!settings.visaInterviewIsEdit">
                                                    <label class="text-sm">@{{ student.visa_interview_time }}</label>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group-sm">
                                                        <input v-model="visa.time" type="text" class="form-control input-sm" placeholder="Enter visa interview time...">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Trial Interview Schedule
                                                </td>
                                                <td v-if="!settings.visaInterviewIsEdit">
                                                   <label class="text-sm">@{{ student.trial_interview_schedule | toFormattedDateString }}</label>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group-sm">
                                                        <input v-model="visa.trial_schedule" type="date" class="form-control input-sm">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Trial Interview Time
                                                </td>
                                                <td v-if="!settings.visaInterviewIsEdit">
                                                    <label class="text-sm">@{{ student.trial_interview_time }}</label>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group-sm">
                                                        <input v-model="visa.trial_time" type="text" class="form-control input-sm" placeholder="Enter trial interview time...">
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </section>
                                    <section v-if="student.application_status === 'For PDOS & CFO' || student.application_status === 'Program Proper'" id="PDOS">
                                        <label class="control-label">PDOS & CFO Details</label>
                                        <table class="table table-striped table-bordered table-condensed">
                                            <tr>
                                                <td colspan="2"ass="text-sm">
                                                    <button v-if="!settings.pdoscfoIsEdit" @click="settings.pdoscfoIsEdit = true" class="btn btn-primary btn-xs pull-right"><span class="fa fa-pencil"></span></button>
                                                    <div v-else>
                                                        <button @click="settings.pdoscfoIsEdit = false" class="btn btn-danger btn-xs pull-right"><span class="fa fa-times"></span></button>
                                                        <button @click="updatePDOSCFODetails" class="btn btn-success btn-xs pull-right" style="margin-right: 5px"><span class="fa fa-check"></span></button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm" style="width: 200px;">
                                                    PDOS Schedule
                                                </td>
                                                <td v-if="!settings.pdoscfoIsEdit" class="text-bold">
                                                    <label class="text-sm">@{{ student.pdos_schedule | toFormattedDateString}}</label>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group-sm">
                                                        <input v-model="program.pdos_schedule" type="date" class="form-control input-sm">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    PDOS Time
                                                </td>
                                                <td v-if="!settings.pdoscfoIsEdit" class="text-bold">
                                                    <label class="text-sm">@{{ student.pdos_time }}</label>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group-sm">
                                                        <input v-model="program.pdos_time" type="text" class="form-control" placeholder="Enter PDOS Schedule">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    CFO Schedule
                                                </td>
                                                <td v-if="!settings.pdoscfoIsEdit" class="text-bold">
                                                    <label class="text-sm">@{{ student.cfo_schedule | toFormattedDateString}}</label>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group-sm">
                                                        <input v-model="program.cfo_schedule" type="date" class="form-control input-sm">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    CFO Time
                                                </td>
                                                <td v-if="!settings.pdoscfoIsEdit" class="text-bold">
                                                    <label class="text-sm">@{{ student.cfo_time }}</label>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group-sm">
                                                        <input v-model="program.cfo_time" type="text" class="form-control input-sm" placeholder="Enter CFO Schedule Time">
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </section>
                                    <section v-if="student.application_status === 'Hired' || student.application_status === 'For Visa Interview' || student.application_status === 'For PDOS & CFO' || student.application_status === 'Program Proper'" id="flight-details">
                                        <label class="control-label">Flight Details</label>
                                        <table class="table table-striped table-bordered table-condensed">
                                            <tr>
                                                <td class="text-sm text-bold">
                                                    Departure from MANILA
                                                </td>
                                                <td>
                                                    <button v-if="!settings.departureFromManila" @click="settings.departureFromManila = true" class="btn btn-primary btn-xs pull-right"><span class="fa fa-pencil"></span></button>
                                                    <div v-else>
                                                        <button @click="settings.departureFromManila = false" class="btn btn-danger btn-xs pull-right"><span class="fa fa-times"></span></button>
                                                        <button @click="updateDepartureMNL" class="btn btn-success btn-xs pull-right" style="margin-right: 5px"><span class="fa fa-check"></span></button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm" style="width: 200px">
                                                    Date
                                                </td>
                                                <td v-if="!settings.departureFromManila" v-cloak class="text-bold">
                                                    <label class="text-sm">@{{ student.mnl_departure_date | toFormattedDateString}}</label>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group-sm">
                                                        <input v-model="departure_mnl.mnl_departure_date" type="date" class="form-control input-sm">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Time
                                                </td>
                                                <td v-if="!settings.departureFromManila" v-cloak class="text-bold">
                                                    <label for="" class="text-sm">@{{ student.mnl_departure_time }}</label>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group-sm">
                                                        <input v-model="departure_mnl.mnl_departure_time" type="time" class="form-control input-sm">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Flight No.
                                                </td>
                                                <td v-if="!settings.departureFromManila" v-cloak class="text-bold">
                                                    <label for="" class="text-sm">@{{ student.mnl_departure_flight_no }}</label>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group-sm">
                                                        <input v-model="departure_mnl.mnl_departure_flight_no" type="text" class="form-control input-sm">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Airlines
                                                </td>
                                                <td v-if="!settings.departureFromManila" v-cloak class="text-bold">
                                                    <label for="" class="text-sm">@{{ student.mnl_departure_airline }}</label>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group-sm">
                                                        <select v-model="departure_mnl.mnl_departure_flight" name="" id="" class="form-control input-sm">
                                                            <option value="">Select Airlines</option>
                                                            <option value="PAL">Philippine Airlines</option>
                                                            <option value="AirAsia">Air Asia</option>
                                                            <option value="Alaska Airlines">Alaska Airlines</option>
                                                            <option value="Korean Air">Korean Air</option>
                                                            <option value="Delta Airlines Inc.">Delta Airlines Inc.</option>
                                                            <option value="Jetstar Japan Co Ltd">Jetstar Japan Co Ltd</option>
                                                            <option value="Asiana Airlines">Asiana Airlines</option>
                                                            <option value="Japan Airlines">Japan Airlines</option>
                                                            <option value="Cathay Pacific Airways">Cathay Pacific Airways</option>
                                                            <option value="Cathay Dragon">Cathay Dragon</option>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>

                                        <table class="table table-striped table-bordered table-condensed">
                                            <tr>
                                                <td class="text-sm text-bold">
                                                    Arrival to US
                                                </td>
                                                <td>
                                                    <button v-if="!settings.arrivalToUs" @click="settings.arrivalToUs = true" class="btn btn-primary btn-xs pull-right"><span class="fa fa-pencil"></span></button>
                                                    <div v-else>
                                                        <button @click="settings.arrivalToUs = false" class="btn btn-danger btn-xs pull-right"><span class="fa fa-times"></span></button>
                                                        <button @click="updateArrivalUS" class="btn btn-success btn-xs pull-right" style="margin-right: 5px"><span class="fa fa-check"></span></button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm" style="width: 200px;">
                                                    Date
                                                </td>
                                                <td v-if="!settings.arrivalToUs" v-cloak class="text-bold">
                                                    <label class="text-sm">@{{ student.us_arrival_date | toFormattedDateString }}</label>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group-sm">
                                                        <input v-model="arrival_us.us_arrival_date" type="date" class="form-control input-sm">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Time
                                                </td>
                                                <td v-if="!settings.arrivalToUs" v-cloak class="text-bold">
                                                    <label for="" class="text-sm">@{{ student.us_arrival_time }}</label>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group-sm">
                                                        <input v-model="arrival_us.us_arrival_time" type="time" class="form-control input-sm">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Flight No.
                                                </td>
                                                <td v-if="!settings.arrivalToUs" v-cloak class="text-bold">
                                                    <label for="" class="text-sm">@{{ student.us_arrival_flight_no }}</label>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group-sm">
                                                        <input v-model="arrival_us.us_arrival_flight_no" type="text" class="form-control input-sm">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Airlines
                                                </td>
                                                <td v-if="!settings.arrivalToUs" v-cloak class="text-bold">
                                                    <label for="" class="text-sm">@{{ student.us_arrival_airline }}</label>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group-sm">
                                                        <select v-model="arrival_us.us_arrival_flight" name="" id="" class="form-control input-sm">
                                                            <option value="">Select Airlines</option>
                                                            <option value="PAL">Philippine Airlines</option>
                                                            <option value="AirAsia">Air Asia</option>
                                                            <option value="Alaska Airlines">Alaska Airlines</option>
                                                            <option value="Korean Air">Korean Air</option>
                                                            <option value="Delta Airlines Inc.">Delta Airlines Inc.</option>
                                                            <option value="Jetstar Japan Co Ltd">Jetstar Japan Co Ltd</option>
                                                            <option value="Asiana Airlines">Asiana Airlines</option>
                                                            <option value="Japan Airlines">Japan Airlines</option>
                                                            <option value="Cathay Pacific Airways">Cathay Pacific Airways</option>
                                                            <option value="Cathay Dragon">Cathay Dragon</option>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>

                                        <table class="table table-striped table-bordered table-condensed">
                                            <tr>
                                                <td class="text-sm text-bold">
                                                    Departure from US
                                                </td>
                                                <td>
                                                    <button v-if="!settings.departureFromUs" @click="settings.departureFromUs = true" class="btn btn-primary btn-xs pull-right"><span class="fa fa-pencil"></span></button>
                                                    <div v-else>
                                                        <button @click="settings.departureFromUs = false" class="btn btn-danger btn-xs pull-right"><span class="fa fa-times"></span></button>
                                                        <button @click="updateDepartureUS" class="btn btn-success btn-xs pull-right" style="margin-right: 5px"><span class="fa fa-check"></span></button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm" style="width: 200px">
                                                    Date
                                                </td>
                                                <td v-if="!settings.departureFromUs" v-cloak class="text-bold">
                                                    <label class="text-sm">@{{ student.us_departure_date | toFormattedDateString}}</label>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group-sm">
                                                        <input v-model="departure_us.us_departure_date" type="date" class="form-control input-sm">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Time
                                                </td>
                                                <td v-if="!settings.departureFromUs" v-cloak class="text-bold">
                                                    <label for="" class="text-sm">@{{ student.us_departure_time }}</label>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group-sm">
                                                        <input v-model="departure_us.us_departure_time" type="time" class="form-control input-sm">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Flight No.
                                                </td>
                                                <td v-if="!settings.departureFromUs" v-cloak class="text-bold">
                                                    <label for="" class="text-sm">@{{ student.us_departure_flight_no }}</label>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group-sm">
                                                        <input v-model="departure_us.us_departure_flight_no" type="text" class="form-control input-sm">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Airlines
                                                </td>
                                                <td v-if="!settings.departureFromUs" v-cloak class="text-bold">
                                                    <label for="" class="text-sm">@{{ student.us_departure_airline }}</label>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group-sm">
                                                        <select v-model="departure_us.us_departure_flight" name="" id="" class="form-control input-sm">
                                                            <option value="">Select Airlines</option>
                                                            <option value="PAL">Philippine Airlines</option>
                                                            <option value="AirAsia">Air Asia</option>
                                                            <option value="Alaska Airlines">Alaska Airlines</option>
                                                            <option value="Korean Air">Korean Air</option>
                                                            <option value="Delta Airlines Inc.">Delta Airlines Inc.</option>
                                                            <option value="Jetstar Japan Co Ltd">Jetstar Japan Co Ltd</option>
                                                            <option value="Asiana Airlines">Asiana Airlines</option>
                                                            <option value="Japan Airlines">Japan Airlines</option>
                                                            <option value="Cathay Pacific Airways">Cathay Pacific Airways</option>
                                                            <option value="Cathay Dragon">Cathay Dragon</option>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>

                                        <table class="table table-striped table-bordered table-condensed">
                                            <tr>
                                                <td class="text-sm text-bold">
                                                    Arrival to MANILA
                                                </td>
                                                <td>
                                                    <button v-if="!settings.arrivalToManila" @click="settings.arrivalToManila = true" class="btn btn-primary btn-xs pull-right"><span class="fa fa-pencil"></span></button>
                                                    <div v-else>
                                                        <button @click="settings.arrivalToManila = false" class="btn btn-danger btn-xs pull-right"><span class="fa fa-times"></span></button>
                                                        <button @click="updateArrivalMNL" class="btn btn-success btn-xs pull-right" style="margin-right: 5px"><span class="fa fa-check"></span></button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm" style="width: 200px;">
                                                    Date
                                                </td>
                                                <td v-if="!settings.arrivalToManila" v-cloak class="text-bold">
                                                    <label class="text-sm">@{{ student.mnl_arrival_date | toFormattedDateString }}</label>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group-sm">
                                                        <input v-model="arrival_mnl.mnl_arrival_date" type="date" class="form-control input-sm">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Time
                                                </td>
                                                <td v-if="!settings.arrivalToManila" v-cloak class="text-bold">
                                                    <label for="" class="text-sm">@{{ student.mnl_arrival_time }}</label>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group-sm">
                                                        <input v-model="arrival_mnl.mnl_arrival_time" type="time" class="form-control input-sm">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Flight No.
                                                </td>
                                                <td v-if="!settings.arrivalToManila" v-cloak class="text-bold">
                                                    <label for="" class="text-sm">@{{ student.mnl_arrival_flight_no }}</label>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group-sm">
                                                        <input v-model="arrival_mnl.mnl_arrival_flight_no" type="text" class="form-control input-sm">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Airlines
                                                </td>
                                                <td v-if="!settings.arrivalToManila" v-cloak class="text-bold">
                                                    <label for="" class="text-sm">@{{ student.mnl_arrival_airline }}</label>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group-sm">
                                                        <select v-model="arrival_mnl.mnl_arrival_flight" name="" id="" class="form-control input-sm">
                                                            <option value="">Select Airlines</option>
                                                            <option value="PAL">Philippine Airlines</option>
                                                            <option value="AirAsia">Air Asia</option>
                                                            <option value="Alaska Airlines">Alaska Airlines</option>
                                                            <option value="Korean Air">Korean Air</option>
                                                            <option value="Delta Airlines Inc.">Delta Airlines Inc.</option>
                                                            <option value="Jetstar Japan Co Ltd">Jetstar Japan Co Ltd</option>
                                                            <option value="Asiana Airlines">Asiana Airlines</option>
                                                            <option value="Japan Airlines">Japan Airlines</option>
                                                            <option value="Cathay Pacific Airways">Cathay Pacific Airways</option>
                                                            <option value="Cathay Dragon">Cathay Dragon</option>
                                                        </select>
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
                                                <button @click="openInNewTab(requirement.student_preliminary.id, 'preliminary')" class="btn btn-warning btn-flat btn-xs"><span class="fa fa-eye"></span> View</button>
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
                                            <th>Requirement</th>
                                            <th class="text-center">Bank Code</th>
                                            <th class="text-center">Reference No</th>
                                            <th class="text-center">Date Deposit</th>
                                            <th class="text-center">Bank Account No</th>
                                            <th class="text-center">Amount</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Verified</th>
                                            <th class="text-center">Action</th>
                                        </thead>
                                        <tbody>
                                        <tr v-for="requirement in paymentRequirements">
                                            <td class="text-sm">@{{ requirement.name }}</td>
                                            <td class="text-center text-sm">@{{ requirement.student_payment ? requirement.student_payment.bank_code : '' }}</td>
                                            <td class="text-center text-sm">@{{ requirement.student_payment ? requirement.student_payment.reference_no : '' }}</td>
                                            <td class="text-center text-sm">@{{ requirement.student_payment ? requirement.student_payment.date_deposit : '' }}</td>
                                            <td class="text-center text-sm">@{{ requirement.student_payment ? requirement.student_payment.bank_account_no : '' }}</td>
                                            <td class="text-center text-sm">@{{ requirement.student_payment ? requirement.student_payment.amount : '' }}</td>
                                            <td class="text-center">
                                                <span v-if="requirement.student_payment.status" class="fa fa-check text-green"></span>
                                                <span v-else class="fa fa-times text-red"></span>
                                            </td>
                                            <td class="text-center">
                                                <span v-if="requirement.student_payment.acknowledgement" class="fa fa-check text-green"></span>
                                                <span v-else class="fa fa-times text-red"></span>
                                            </td>
                                            <td class="text-center">
                                                <button @click="openInNewTab(requirement.student_payment.id, 'payment')" class="btn btn-warning btn-flat btn-xs"><span class="fa fa-eye"></span> View</button>
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
                                            <td style="width: 70%" class="text-sm">@{{ requirement.name }}</td>
                                            <td class="text-center">
                                                <span v-if="requirement.student_visa.status" class="fa fa-check text-green"></span>
                                                <span v-else class="fa fa-times text-red"></span>
                                            </td>
                                            <td class="text-center">
                                                <button @click="openInNewTab(requirement.student_visa.id, 'visa')" class="btn btn-warning btn-flat btn-xs"><span class="fa fa-eye"></span> View</button>
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
                                                    <button @click="openInNewTab(requirement.student_additional.id, 'additional')" class="btn btn-warning btn-flat btn-xs"><span class="fa fa-eye"></span> View</button>
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
                programs: [],
                hasRecords: true,
                hosts: [],
                states: [],
                positions: [],
                sponsors: [],
                students: [],
                student: {
                    user: [],
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
                    status: '',
                    branch: ''
                },
                appStatus: '',
                visaStatus: '',
                selProgram: '',
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
                    "School"                         : "tertiary.school.display_name",
                    "Course"                         : "tertiary.degree",
                    "Contact"                        : "home_number",
                    "Program"                        : "program.display_name",
                    "E-mail Address"                 : "user.email",
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
                    visa: false,
                    pdoscfo: false,
                    programProper: false,
                    cancel: false,
                },
                field: '',
                host: {
                    name: '',
                    position: '',
                    place: '',
                    housing: '',
                    stipend: '',
                    start: '',
                    end: '',
                    sponsor: ''
                },
                visa: {
                    sevis: '',
                    programId: '',
                    schedule: '',
                    time: '',
                    trial_schedule: '',
                    trial_time: ''
                },
                program: {
                    pdos_schedule: '',
                    pdos_time: '',
                    cfo_schedule: '',
                    cfo_time: ''
                },
                departure_mnl: {
                    mnl_departure_date: '',
                    mnl_departure_time: '',
                    mnl_departure_flight_no: '',
                    mnl_departure_flight: ''
                },
                departure_us: {
                    us_departure_date: '',
                    us_departure_time: '',
                    us_departure_flight_no: '',
                    us_departure_flight: ''
                },
                arrival_mnl: {
                    mnl_arrival_date: '',
                    mnl_arrival_time: '',
                    mnl_arrival_flight_no: '',
                    mnl_arrival_flight: '',
                },
                arrival_us: {
                    us_arrival_date: '',
                    us_arrival_time: '',
                    us_arrival_flight_no: '',
                    us_arrival_flight: ''
                },
                cancel: {
                    status: ''
                },
                settings: {
                    hostCompanyIsEdit: false,
                    visaInterviewIsEdit: false,
                    pdoscfoIsEdit: false,
                    departureFromManila: false,
                    arrivalToUs: false,
                    departureFromUs: false,
                    arrivalToManila: false,
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
                    program: {
                        pdosIsEdit: false,
                        cfoIsEdit: false
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
            computed: {
                filteredStudents () {
                    return this.students.filter(e => {
                        return e.last_name.toLowerCase().includes(this.filterName.toLowerCase());
                    })
                },
            },
            mounted: function() {
                this.loadStudents();
                this.loadHostCompany();
                this.loadVisaSponsor();
                this.loadStates();
                this.loadPositions();
                this.loadPrograms();
            },
            filters: {
                toFormattedDateString: function (value) {
                    let d = new Date(value);
                    let months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                    
                    if (value) {
                        return `${months[d.getMonth()]} ${d.getDate()}, ${d.getFullYear()}`;
                    } else {
                        return '';
                    }
                }
            },
            methods: {
                statusColor (status) {
                    switch (status) {
                        case 'New Applicant':
                            return 'background: #ecb021;'
                        break;

                        case 'Called':
                            return 'background: #ec8023;'
                        break;

                        case 'Assessed':
                            return 'background: #d25b27;'
                        break;

                        case 'Confirmed':
                            return 'background: #bd3d26;'
                        break;

                        case 'Hired':
                            return 'background: #bd3d26;'
                        break;

                        case 'For Visa Interview':
                            return 'background: #174275;'
                        break;

                        case 'For PDOS & CFO':
                            return 'background: #15335c;'
                        break;

                        case 'Program Proper':
                            return 'background: #118542;'
                        break;

                        case 'Cancel: Unqualified':
                            return 'background: #b92025;'
                        break;
                        
                        case 'Cancel: Visa Denial':
                            return 'background: #b92025;'
                        break;

                        case 'Cancel: Program Cancellation':
                            return 'background: #b92025;'
                        break;
                    }
                    
                },
                filterStatus () {
                    let formData = new FormData();
                    formData.append('program_id', programId);
                    formData.append('status', this.filter.status);
                    formData.append('branch', this.filter.branch);
                    formData.append('from', this.filter.from);
                    formData.append('to', this.filter.to);
                    this.loading.table = true;
                    axios.post(`/filter/status`, formData)
                        .then((response) => {
                            this.loading.table = false;
                            this.students = response.data.data;
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
                loadPrograms() {
                    axios.get('/helper/program/view')
                        .then((response) => {
                            this.programs = response.data;
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
                openInNewTab (id, requirement) {
                    let url = '';

                    switch(requirement) {
                        case 'preliminary':
                            url = `/studPreliminary/download?requirement_id=${id}`;
                            break;
                        case 'additional':
                            url = `/studAdditional/download?requirement_id=${id}`;
                            break;
                        case 'payment':
                            url = `/studPayment/download?requirement_id=${id}`;
                            break;
                        case 'visa':
                            url = `/studVisa/download?requirement_id=${id}`;
                            break;
                    }

                    axios.get(url)
                        .then((response) => {
                            if(requirement == 'payment') {
                                win = window.open(`${response.data}`, '_blank');
                                win.focus();
                            } else {
                                win = window.open(`https://docs.google.com/gview?url=${response.data}&embedded=true`, '_blank');
                                win.focus();
                            }
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
                            var win = window.open(response.data);
                            win.focus();
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
                            var win = window.open(response.data);
                            win.focus();
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
                            var win = window.open(response.data);
                            win.focus();
                        })
                },
                setApplicationStatus(status) {
                    this.appStatus = '';
                    switch (status) {
                        case 'Assessed':
                            if (this.student.application_status == 'Called') {
                                this.loading.modal = true;
                                axios.post(`/coor/${this.student.user_id}/application/${status}`)
                                    .then(({data}) => {
                                        this.loadStudents(programId);
                                        this.viewStudent(this.student.user_id);
                                        this.loading.modal = false;
                                        swal({
                                            title: data,
                                            type: 'success',
                                            confirmButonText: 'Continue'
                                        })
                                    }).catch((error) => {
                                        swal({
                                            title: 'Something went wrong.',
                                            type: 'error',
                                            confirmButonText: 'Go Back!'
                                        })
                                    })
                            } else {
                                alert('You Cannot Revert Application Status.');
                            }
                            break;
                        case 'Called':
                            if (this.student.application_status == 'New Applicant') {
                                this.loading.modal = true;
                                axios.post(`/coor/${this.student.user_id}/application/${status}`)
                                    .then(({data}) => {
                                        this.loadStudents(programId);
                                        this.viewStudent(this.student.user_id);
                                        this.loading.modal = false;
                                        swal({
                                            title: data,
                                            type: 'success',
                                            confirmButonText: 'Continue'
                                        })
                                    }).catch((error) => {
                                        swal({
                                            title: 'Something went wrong.',
                                            type: 'error',
                                            confirmButonText: 'Go Back!'
                                        })
                                    })
                            } else {
                                alert('You Cannot Revert Application Status.');
                            }
                        break;
                        case 'Confirmed':
                            if (this.student.application_status == 'Assessed') {
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
                            } else {
                                alert('You Cannot Revert Application Status.');
                            }
                            break;
                        case 'Hired':
                            if (this.student.application_status == 'Confirmed') {
                                this.show.assessed = false;
                                this.show.hired = true;
                                this.show.visa = false;
                            } else {
                                alert('You Cannot Revert Application Status.');
                            }
                            break;
                        case 'ForVisaInterview':
                            if (this.student.application_status == 'Hired') {
                                this.show.assessed = false;
                                this.show.visa = true;
                                this.show.hired = false;
                            } else {
                                alert('You Cannot Revert Application Status.');
                            }
                            break;
                        case 'ForPDOSCFO': 
                            if(this.student.application_status == 'For Visa Interview') {
                                this.show.assessed = false;
                                this.show.visa = false;
                                this.show.hired = false;
                                this.show.pdoscfo = true;
                                this.show.programProper = false;
                            } else {
                                alert('You Cannot Revert Application Status.');
                            }
                            break;
                        case 'ProgramProper':
                            this.loading.modal = false;
                            if(this.student.application_status == 'For PDOS & CFO') {
                                axios.post(`/coor/${this.student.user_id}/application/ProgramProper`)
                                    .then((response) => {
                                        this.loadStudents(programId);
                                        this.viewStudent(this.student.user_id);
                                        this.loading.modal = false;
                                        swal({
                                            title: response.data,
                                            type: 'success',
                                            confirmButtonText: 'Continue'
                                        }).catch((error) => {
                                            swal({
                                                title: 'Something went wrong!',
                                                type: 'error',
                                                confirmButonText: 'Go Back!'
                                            })
                                        })
                                    })
                            } else {
                                alert('You Cannot Revert Application Status');
                            }
                            break;
                        case 'Canceled':
                            this.show.cancel = true;
                            break;
                    }
                },
                setProgram(program) {
                    axios.post(`/coor/${this.student.user_id}/program/${program}`)
                        .then((response) => {
                            swal({
                                title: response.data,
                                type: 'success',
                                confirmButtonText: 'Continue'
                            });
                            this.loadStudents(programId);
                            $('#student-modal').modal('hide');
                        })
                },
                setInterviewStatus(status) {
                    this.visaStatus = '';
                    switch (status) {
                        case 'Approved':
                            axios.post(`/coor/${this.student.user_id}/visa/${status}`)
                                .then((response) => {
                                    this.loadStudents(programId);
                                    this.viewStudent(this.student.user_id);
                                    swal({
                                        title: response.data,
                                        type: 'success',
                                        confirmButonText: 'Continue'
                                    })
                                });
                            break;
                        case 'Denied':
                            axios.post(`/coor/${this.student.user_id}/visa/${status}`)
                                .then((response) => {
                                    this.loadStudents(programId);
                                    this.viewStudent(this.student.user_id);
                                    swal({
                                        title: response.data,
                                        type: 'success',
                                        confirmButonText: 'Continue'
                                    })
                                });
                            break;
                    }
                },
                setContactStatus(e) {
                    axios.post(`/coor/${this.student.user_id}/setContactStatus`, { status: e.target.value })
                        .then((response) => {
                            this.loadStudents(programId);
                            this.viewStudent(this.student.user_id);
                            swal({
                                title: response.data,
                                type: 'success',
                                confirmButonText: 'Continue'
                            })
                        })
                        .catch(error => {
                            console.log(error);
                        })
                },
                setCancellationStatus() {
                    this.loading.modal = true;
                    axios.post(`/coor/${this.student.user_id}/application/Cancelled`, this.cancel)
                        .then((response) => {
                            this.loadStudents(programId);
                            this.viewStudent(this.student.user_id);
                            this.loading.modal = false;
                            this.show.cancel = false;
                            alert(response.data);
                        })
                        .catch((error) => {
                            console.log(error);
                        })
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
                            this.loading.modal = false;
                            swal({
                                title: 'All Fields are Required!',
                                type: 'error',
                                confirmButtonText: 'Go Back!'
                            })
                    })
                },
                submitForVisaInterview() {
                    this.loading.modal = true;
                    axios.post(`/coor/${this.student.user_id}/application/ForVisaInterview`, this.visa)
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
                submitForPDOSAndCFO() {
                    this.loading.modal = true;
                    axios.post(`/coor/${this.student.user_id}/application/ForPDOSCFO`, this.program)
                        .then((response) => {
                            this.loadStudents(programId);
                            this.viewStudent(this.student.user_id);
                            this.loading.modal = false;
                            this.show.pdoscfo = false;
                            swal({
                                title: response.data,
                                type: 'success',
                                confirmButtonText: 'Continue'
                            })
                        }).catch((error) => {
                            swal({
                                title: 'Something went wrong!',
                                type: 'error',
                                confirmButonText: 'Go Back!'
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
                                    this.loadBasicRequirements(programId, this.student.user_id);
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
                                    this.loadAdditionalRequirement(programId, this.student.user_id);
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
                                    this.loadVisaRequirements(requirement.sponsor_id, this.student.user_id);
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
                updateHostCompanyDetails() {
                    this.loading.modal = true;
                    axios.post(`/coor/updateHostCompanyDetails/${this.student.user_id}`, this.host)
                        .then(({data}) => {
                            this.loading.modal = false;
                            this.settings.hostCompanyIsEdit = false;
                            this.loadStudents(programId);
                            this.viewStudent(this.student.user_id);
                            alert(data.message);
                        }).catch((error) => {
                            this.loading.modal = false;
                        })
                },
                updateVisaInterviewDetails() {
                    this.loading.modal = true;
                    axios.post(`/coor/updateVisaInterviewDetails/${this.student.user_id}`, this.visa)
                        .then(({data}) => {
                            this.loading.modal = false;
                            this.settings.visaInterviewIsEdit = false;
                            this.loadStudents(programId);
                            this.viewStudent(this.student.user_id);
                            alert(data.message);
                        }).catch((error) => {
                            this.loading.modal = false;
                        });
                },
                updatePDOSCFODetails() {
                    this.loading.modal = true;
                    axios.post(`/coor/updatePDOSCFODetails/${this.student.user_id}`, this.program)
                        .then(({data}) => {
                            this.loading.modal = false;
                            this.settings.pdoscfoIsEdit = false;
                            this.loadStudents(programId);
                            this.viewStudent(this.student.user_id);
                            alert(data.message);
                        }).catch((error) => {
                            this.loading.modal = false;
                        });
                },
                updateDepartureMNL() {
                    this.loading.modal = true;
                    axios.post(`/coor/updateDepartureMNL/${this.student.user_id}`, this.departure_mnl)
                        .then(({data}) => {
                            this.loading.modal = false;
                            this.settings.departureFromManila = false;
                            this.loadStudents(programId);
                            this.viewStudent(this.student.user_id);
                            alert(data.message);
                        }).catch((error) => {
                            this.loading.modal = false;
                        });
                },
                updateArrivalUS() {
                    this.loading.modal = true;
                    axios.post(`/coor/updateArrivalUS/${this.student.user_id}`, this.arrival_us)
                        .then(({data}) => {
                            this.loading.modal = false;
                            this.settings.arrivalToUs = false;
                            this.loadStudents(programId);
                            this.viewStudent(this.student.user_id);
                            alert(data.message);
                        }).catch((error) => {
                            this.loading.modal = false;
                        });
                },
                updateDepartureUS() {
                    this.loading.modal = true;
                    axios.post(`/coor/updateDepartureUS/${this.student.user_id}`, this.departure_us)
                        .then(({data}) => {
                            this.loading.modal = false;
                            this.settings.departureFromUs = false;
                            this.loadStudents(programId);
                            this.viewStudent(this.student.user_id);
                            alert(data.message);
                        }).catch((error) => {
                            this.loading.modal = false;
                        });
                },
                updateArrivalMNL() {
                    this.loading.modal = true;
                    axios.post(`/coor/updateArrivalMNL/${this.student.user_id}`, this.arrival_mnl)
                        .then(({data}) => {
                            this.loading.modal = false;
                            this.settings.arrivalToManila = false;
                            this.loadStudents(programId);
                            this.viewStudent(this.student.user_id);
                            alert(data.message);
                        }).catch((error) => {
                            this.loading.modal = false;
                        });
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
            }
        })
    </script>
@endsection
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
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-flat btn-sm"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                            <download-excel
                                    class="btn btn-success btn-flat btn-sm"
                                    :data="testData"
                                    :fields="testField"
                                    name="{{ date('Ymd') }}.xls"
                                    title="ZIP Generated Report">
                                <span class="glyphicon glyphicon-export"></span> Export
                            </download-excel>
                        </div>
                    </form>
                    <div class="form-group-sm pull-right">
                        <input v-model="filterName" type="text" class="form-control" placeholder="Search By Name">
                    </div>
                    <table class="table table-bordered table-striped table-condensed">
                        <thead>
                            <th>Date of Application</th>
                            <th>Status</th>
                            <th>Application ID</th>
                            <th>Full Name</th>
                            <th>Program</th>
                            <th>Course</th>
                            <th>Contact</th>
                            <th>School</th>
                            <th>Recent Activity</th>
                            <th>Action</th>
                        </thead>
                        <tbody v-if="hasRecords">
                            <tr v-if="loading.table">
                                <td valign="top" colspan="15" class="text-center">
                                    <span class="fa fa-circle-o-notch fa-spin"></span>
                                </td>
                            </tr>
                            <tr v-else v-for="student in students">
                                <td class="text-sm">@{{ student.created_at }}</td>
                                <td><span class="label label-warning text-sm">@{{ student.application_status }}</span></td>
                                <td class="text-sm">@{{ student.application_id }}</td>
                                <td class="text-sm">@{{ student.first_name }}&nbsp;@{{ student.middle_name[0] }}.&nbsp; @{{ student.last_name }}</td>
                                <td class="text-sm">@{{ student.program }}</td>
                                <td class="text-sm">@{{ student.course }}</td>
                                <td class="text-sm">@{{ student.mobile_number }}/@{{ student.home_number }}</td>
                                <td class="text-sm">@{{ student.school }}</td>
                                <td></td>
                                <td>
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
                                                        <input v-model="host.place" type="text" class="form-control input-sm" placeholder="Place of Assignment">
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
                                                    @{{ student.birthdate }}
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
                                                    Address
                                                </td>
                                                <td v-cloak class="text-sm text-bold">
                                                    @{{ student.address }}
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
                                    <section id="school-details">
                                        <label class="control-label">School Details</label>
                                        <table class="table table-striped table-bordered table-condensed">
                                            <tr>
                                                <td class="text-sm" style="width: 200px">
                                                    College
                                                </td>
                                                <td v-cloak class="text-sm text-bold">
                                                    @{{ student.school }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Course
                                                </td>
                                                <td v-cloak class="text-sm text-bold">
                                                    @{{ student.course }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Year Level
                                                </td>
                                                <td v-cloak class="text-sm text-bold">
                                                    @{{ student.year }}
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
                                                    <label class="text-sm">@{{ student.sponsor }}</label>
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
                                                    <label class="text-sm">@{{ student.company }}</label>
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
                                                        <input v-model="field" type="text" class="form-control input-sm">
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
                                                        <input v-model="field" type="text" class="form-control input-sm" placeholder="Enter position title">
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
                                                    <label class="text-sm">@{{ student.program_start_date }}</label>
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
                                                    <label class="text-sm">@{{ student.program_end_date }}</label>
                                                    <a @click="hideField('end')" href="#" class="pull-right"><span class="fa fa-edit"></span></a>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group">
                                                        <input v-model="field" type="date" class="form-control input-sm">
                                                        <span class="input-group-btn">
                                                    <button @click="updateField('program_start_date', field); setting.host.endIsEdit = false; field = '';" class="btn btn-primary btn-flat btn-sm">Update</button>
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
                                                <td class="text-sm" style="width: 200px">
                                                    Departure Date
                                                </td>
                                                <td v-if="!setting.flight.departureIsEdit" v-cloak class="text-bold">
                                                    <label class="text-sm">@{{ student.date_of_departure }}</label>
                                                    <a @click="hideField('departure')" href="#" class="pull-right"><span class="fa fa-edit"></span></a>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group">
                                                        <input v-model="field" type="text" class="form-control input-sm">
                                                        <span class="input-group-btn">
                                                <button @click="updateField('date_of_departure', field); setting.flight.departureIsEdit = false; field = '';" class="btn btn-primary btn-flat btn-sm">Update</button>
                                            </span>
                                                        <span class="input-group-btn">
                                                <button @click="setting.flight.departureIsEdit = false; field = '';" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                            </span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-sm">
                                                    Arrival Date
                                                </td>
                                                <td v-if="!setting.flight.arrivalIsEdit" v-cloak class="text-bold">
                                                    <label class="text-sm">@{{ student.date_of_arrival }}</label>
                                                    <a @click="hideField('arrival')" href="#" class="pull-right"><span class="fa fa-edit"></span></a>
                                                </td>
                                                <td v-else>
                                                    <div class="input-group">
                                                        <input v-model="field" type="text" class="form-control input-sm">
                                                        <span class="input-group-btn">
                                                <button @click="updateField('date_of_arrival', field); setting.flight.arrivalIsEdit = false; field = '';" class="btn btn-primary btn-flat btn-sm">Update</button>
                                            </span>
                                                        <span class="input-group-btn">
                                                <button @click="setting.flight.arrivalIsEdit = false; field = '';" class="btn btn-danger btn-flat btn-sm">Cancel</button>
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
                                            <td class="text-sm">@{{ requirement.name }}</td>
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
                                            <td class="text-sm">@{{ requirement.name }}</td>
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
                sponsors: [],
                students: [],
                student: [],
                basicRequirements: [],
                paymentRequirements: [],
                visaRequirements: [],
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
                    "Date of Application"            : "created_at",
                    "Application ID"                 : "application_id",
                    "Fullname"                       : "first_name",
                    "Program"                        : "program",
                    "School"                         : "school",
                    "Course"                         : "course",
                    "Contact"                        : "home_number",
                    "E-mail Address"                 : "fb_email",
                    "Status"                         : "application_status",
                    "Host Company Assignment"        : "company",
                    "Place of Assignment"            : "location",
                    "Stipend"                        : "stipend",
                    "VISA Appoinment"                : "visa_interview_schedule",
                    "Departure Date"                 : "date_of_departure",
                    "Arrival Date"                   : "date_of_arrival",
                    "Program Start Date"             : "program_start_date",
                    "Program End Date"               : "program_end_date"
                },
                show: {
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
                    flight: {
                        departureIsEdit: false,
                        arrivalIsEdit: false
                    }
                },
            },
            mounted: function() {
                this.loadStudents(programId);
                this.loadHostCompany();
                this.loadVisaSponsor();
            },
            watch: {
                filterName: function() {
                    if (this.filterName) {
                        this.loading.table = true;
                        axios.get(`/filter/student/${programId}/${this.filterName}`)
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
            methods: {
                filterStatus () {
                    this.loading.table = true;
                    axios.get(`/filter/status/${programId}/${this.filter.from}/${this.filter.to}/${this.filter.status}`)
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

                    axios.get(`/helper/status/${programId}/${this.filter.from}/${this.filter.to}/${this.filter.status}`)
                        .then((response) => {
                            this.loading.table = false;
                            if (response.data.data.length > 0) {
                                this.hasRecords = true;
                                this.testData = response.data.data;
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
                loadStudents (programId) {
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
                    axios.get(`/stud/view/${studentId}`)
                        .then((response) => {
                            this.student = response.data.data;
                            this.loadBasicRequirements(programId, response.data.data.user_id);
                            this.loadPaymentRequirements(programId, response.data.data.user_id);
                            this.loadVisaRequirements(response.data.data.visa_sponsor_id, response.data.data.user_id);
                            $('#student-modal').modal('show');
                        })
                },
                loadBasicRequirements (programId, userId) {
                    axios.get(`/coor/requirement/basic/${programId}/${userId}`)
                        .then((response) => {
                            this.basicRequirements = response.data.data;
                        })
                },
                downloadBasicRequirement (id) {
                    axios.get(`/download/basic/requirement/${id}`)
                        .then((response) => {
                            const link = document.createElement('a');
                            link.href = response.data;
                            link.setAttribute('download', '');
                            document.body.appendChild(link);
                            link.click();
                        })
                },
                loadPaymentRequirements (programId, userId) {
                    axios.get(`/coor/requirement/payment/${programId}/${userId}`)
                        .then((response) => {
                            this.paymentRequirements = response.data.data;
                        })
                },
                downloadPaymentRequirement (id) {
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
                            this.show.hired = true;
                            this.show.visa = false;
                            break;
                        case 'For Visa Interview':
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

                            this.setting.flight.departureIsEdit = false;
                            this.setting.flight.arrivalIsEdit = false;
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

                            this.setting.flight.departureIsEdit = false;
                            this.setting.flight.arrivalIsEdit = false;
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

                            this.setting.flight.departureIsEdit = false;
                            this.setting.flight.arrivalIsEdit = false;
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

                            this.setting.flight.departureIsEdit = false;
                            this.setting.flight.arrivalIsEdit = false;
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

                            this.setting.flight.departureIsEdit = false;
                            this.setting.flight.arrivalIsEdit = false;
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

                            this.setting.flight.departureIsEdit = false;
                            this.setting.flight.arrivalIsEdit = false;
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

                            this.setting.flight.departureIsEdit = false;
                            this.setting.flight.arrivalIsEdit = false;
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

                            this.setting.flight.departureIsEdit = false;
                            this.setting.flight.arrivalIsEdit = false;
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

                            this.setting.flight.departureIsEdit = false;
                            this.setting.flight.arrivalIsEdit = false;
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

                            this.setting.flight.departureIsEdit = false;
                            this.setting.flight.arrivalIsEdit = false;
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

                            this.setting.flight.departureIsEdit = false;
                            this.setting.flight.arrivalIsEdit = false;
                            break;
                        case 'departure' :
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

                            this.setting.flight.departureIsEdit = true;
                            this.setting.flight.arrivalIsEdit = false;
                            break;
                        case 'arrival' :
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

                            this.setting.flight.departureIsEdit = false;
                            this.setting.flight.arrivalIsEdit = true;
                            break;
                    }
                }
            }
        })
    </script>
@endsection
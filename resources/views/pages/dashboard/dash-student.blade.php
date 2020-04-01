@extends('layouts.student-app')

@section('title', 'Students')

@section('content')
    <div id="app" class="m-t-10" v-cloak>
        <div class="col-md-3 col-xs-12">
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <a href="javascript:void(0)" @click="selectPhoto()">
                        <img class="profile-user-img img-responsive img-circle" :src="student.profile_picture | avatar" alt="User profile picture"/>
                    </a>
                    <h5 class="profile-username text-center" style="font-size: 17px; padding-bottom: 0px; margin-top: 12px;">@{{ student.first_name }}&nbsp; @{{ student.last_name }}</h5>
                    <p class="text-muted text-center">@{{ student.program.name }}</p>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Program ID</b>
                            <a v-if="!student.application_id" class="pull-right text-green text-sm">No Assigned Program ID</a>
                            <a v-else class="pull-right text-green text-sm">@{{ student.application_id }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Application Status</b>
                            <a class="pull-right text-green text-sm">@{{ student.application_status }}</a>
                        </li>
                    </ul>
                    <a href="{{ route('dash.student') }}" class="btn btn-primary btn-block">
                        <b>Profile</b>
                    </a>
                </div>
            </div>
            <div v-if="student.application_status == 'New Applicant'"></div>
            <div v-else-if="student.application_status == 'Assessed'"></div>
            <div v-else class="panel-group m-b-5">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" href="#collapse1">
                                Program Requirements
                            </a>
                        </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <a href="{{ route('req.basic') }}">
                                    Part 1: Preliminary Documents
                                    <i class="fa fa-arrow-right pull-right"></i>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('req.visa') }}">
                                    Part 2: Visa Sponsor Forms
                                    <i class="fa fa-arrow-right pull-right"></i>
                                </a></li>
                            <li class="list-group-item">
                                <a href="{{ route('req.additional') }}">
                                    Part 3: Additional Requirements
                                    <i class="fa fa-arrow-right pull-right"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div v-if="student.application_status == 'New Applicant'"></div>
            <div v-else-if="student.application_status == 'Assessed'"></div>
            <div v-else class="panel-group m-b-5">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a href="{{ route('student.program-status') }}">Program Information</a>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="panel-group m-b-5">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a href="{{ route('req.payment') }}">Payment Requirements</a>
                        </h4>
                    </div>
                </div>
            </div>
            <!--<div class="panel-group m-b-5">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a href="{{ route('portal.chat-student') }}">Chat your Coordinator</a>
                        </h4>
                    </div>
                </div>
            </div>-->
        </div>
        <div class="col-md-9 col-xs-12">
            <div class="nav-tabs-custom">
                <button v-show="isAuthorize" v-if="!settings.personalIsEdit" @click="settings.personalIsEdit = true;" class="btn btn-xs btn-primary pull-right m-t-10 m-r-10"><span class="fa fa-pencil"></span></button>
                <div v-else>
                        <button @click="cancelPersonalDetails" class="btn btn-xs btn-danger pull-right m-t-10 m-r-10"><span class="fa fa-times"></span></button>
                        <button @click="updatePersonalDetails" class="btn btn-xs btn-success pull-right m-t-10" style="margin-right: 5px"><span class="fa fa-check"></span></button>
                </div>
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#profile" data-toggle="tab" aria-expanded="true">
                            <span class="fa fa-user"></span>
                            <label for="" class="control-label">Personal Details</label>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="profile">
                        <table class="table table-striped table-bordered table-condensed">
                            <tbody>
                                <tr>
                                    <td style="width: 35%;">First name</td>
                                    <td v-if="!settings.personalIsEdit">
                                        <label class="text-bold"> @{{ student.first_name }}</label>
                                    </td>
                                    <td v-else>
                                        <div class="input-group-sm">
                                            <input v-model="personal.first_name" type="text" class="form-control input-sm">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Middle name</td>
                                    <td v-if="!settings.personalIsEdit">
                                        <label class="text-bold">@{{ student.middle_name }}</label>
                                    </td>
                                    <td v-else>
                                        <div class="input-group-sm">
                                            <input v-model="personal.middle_name" type="text" class="form-control input-sm">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Last name</td>
                                    <td v-if="!settings.personalIsEdit">
                                        <label class="text-bold">@{{ student.last_name }}</label>
                                    </td>
                                    <td v-else>
                                        <div class="input-group-sm">
                                            <input :placeholder="student.last_name" v-model="personal.last_name" type="text" class="form-control input-sm">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Birthdate</td>
                                    <td v-if="!settings.personalIsEdit">
                                        <label class="text-bold">@{{ student.birthdate | toFormattedDateString }}</label>
                                    </td>
                                    <td v-else>
                                        <div class="input-group-sm">
                                            <input v-model="personal.birthdate" type="date" class="form-control input-sm">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Gender</td>
                                    <td v-if="!settings.personalIsEdit">
                                        <label class="text-bold">@{{ student.gender }}</label>
                                    </td>
                                    <td v-else>
                                        <div class="input-group-sm">
                                            <select v-model="personal.gender" class="form-control input-sm">
                                                <option active value="" hidden>@{{ student.gender }}</option>
                                                <option value="">Select gender</option>
                                                <option value="MALE">Male</option>
                                                <option value="FEMALE">Female</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Skype ID</td>
                                    <td v-if="!settings.personalIsEdit">
                                        <label class="text-bold">@{{ student.skype_id }}</label>
                                    </td>
                                    <td v-else>
                                        <div class="input-group-sm">
                                            <input v-model="personal.skype_id" type="text" class="form-control input-sm">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Facebook URL</td>
                                    <td v-if="!settings.personalIsEdit" class="text-bold">
                                        <a :href="'/' + student.fb_email" target="_blank">@{{ student.fb_email }}</a>
                                    </td>
                                    <td v-else>
                                        <div class="input-group-sm">
                                            <input v-model="personal.fb_email" type="text" class="form-control input-sm">
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="nav-tabs-custom">
                <button v-show="isAuthorize" v-if="!settings.educationIsEdit" @click="settings.educationIsEdit = true;" class="btn btn-xs btn-primary pull-right m-t-10 m-r-10"><span class="fa fa-pencil"></span></button>
                <div v-else>
                    <button @click="cancelEducationalDetails" class="btn btn-danger btn-xs pull-right m-t-10 m-r-10"><span class="fa fa-times"></span></button>
                    <button @click="updateEducationalDetails" class="btn btn-xs btn-success pull-right m-t-10 m-r-10"><span class="fa fa-check"></span></button>
                </div>
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#educational" data-toggle="tab" aria-expanded="true">
                            <span class="fa fa-users"></span>
                            <label for="" class="control-label">Educational Background</label>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="education" class="tab-pane active">
                        <table class="table table-striped table-bordered table-condensed">
                            <tbody>
                                <tr>
                                <td colspan="2"><label class="control-label">Tertiary Level @{{ student.tertiary.school.name }}</label></td>
                                </tr>
                                <tr>
                                    <td>School</td>
                                    <td v-if="!settings.educationIsEdit">
                                        <label for="" class="text-bold" v-if="student.tertiary.school">@{{ student.tertiary.school.name }}</label>
                                    </td>
                                    <td v-else>
                                        <div class="input-group-sm">
                                            <select v-model="education.t_school_name" class="form-control input-sm">
                                                <option value="">Select School</option>
                                                <option v-for="school in schools.data" :value="school.id">@{{ school.name }}</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td v-if="!settings.educationIsEdit">
                                        <label for="" class="text-bold">@{{ student.tertiary.address }}</label>
                                    </td>
                                    <td v-else>
                                        <div class="input-group-sm">
                                            <input v-model="education.t_address" type="text" class="form-control input-sm">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Degree</td>
                                    <td v-if="!settings.educationIsEdit">
                                        <label for="" class="text-bold">@{{ student.tertiary.degree }}</label>
                                    </td>
                                    <td v-else>
                                        <div class="input-group-sm">
                                            <select v-model="education.t_degree" class="form-control input-sm">
                                                <option selected hidden>@{{ student.tertiary.degree }}</option>
                                                <option value="">Select Degree</option>
                                                <option v-for="degree in degrees" :value="degree.name">@{{ degree.display_name }}</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Start Date</td>
                                    <td v-if="!settings.educationIsEdit">
                                        <label for="" class="text-bold">@{{ student.tertiary.start_date | toFormattedDateString }}</label>
                                    </td>
                                    <td v-else>
                                        <div class="input-group-sm">
                                            <input v-model="education.t_start_date" type="date" class="form-control input-sm">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Date Graduated (<i>expected</i>)</td>
                                    <td v-if="!settings.educationIsEdit">
                                        <label for="" class="text-bold">@{{ student.tertiary.date_graduated | toFormattedDateString }}</label>
                                    </td>
                                    <td v-else>
                                        <div class="input-group-sm">
                                            <input v-model="education.t_end_date" type="date" class="form-control input-sm">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"><label class="control-label">Secondary Level</label></td>
                                </tr>
                                <tr>
                                    <td>School</td>
                                    <td v-if="!settings.educationIsEdit">
                                        <label for="" class="text-bold">@{{ student.secondary.school_name }}</label>
                                    </td>
                                    <td v-else>
                                        <div class="input-group-sm">
                                            <input v-model="education.s_school_name" type="text" class="form-control input-sm">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td v-if="!settings.educationIsEdit">
                                        <label for="" class="text-bold">@{{ student.secondary.address }}</label>
                                    </td>
                                    <td v-else>
                                        <div class="input-group-sm">
                                            <input v-model="education.s_address" type="text" class="form-control input-sm">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Start Date</td>
                                    <td v-if="!settings.educationIsEdit">
                                        <label for="" class="text-bold">@{{ student.secondary.start_date | toFormattedDateString }}</label>
                                    </td>
                                    <td v-else>
                                        <div class="input-group-sm">
                                            <input v-model="education.s_start_date" type="date" class="form-control input-sm">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Date Graduated</td>
                                    <td v-if="!settings.educationIsEdit">
                                        <label for="" class="text-bold">@{{ student.secondary.date_graduated | toFormattedDateString }}</label>
                                    </td>
                                    <td v-else>
                                        <div class="input-group-sm">
                                            <input v-model="education.s_end_date" type="date" class="form-control input-sm">
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="nav-tabs-custom">
                <button v-show="isAuthorize" v-if="!settings.contactIsEdit" @click="settings.contactIsEdit = true;" class="btn btn-xs btn-primary pull-right m-t-10 m-r-10"><span class="fa fa-pencil"></span></button>
                <div v-else>
                    <button @click="cancelContactDetails" class="btn btn-danger btn-xs pull-right m-t-10 m-r-10"><span class="fa fa-times"></span></button>
                    <button @click="updateContactDetails" class="btn btn-xs btn-success pull-right m-t-10" style="margin-right: 5px"><span class="fa fa-check"></span></button>
                </div>
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#contact" data-toggle="tab" aria-expanded="true">
                            <span class="fa fa-users"></span>
                            <label for="" class="control-label">Contact Details</label>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="contact" class="tab-pane active">
                        <table class="table table-striped table-bordered table-condensed">
                            <tbody>
                                <tr>
                                    <td style="width: 20%;">Present Address</td>
                                    <td v-if="!settings.contactIsEdit">
                                        <label class="text-bold">@{{ student.permanent_address }}</label>
                                    </td>
                                    <td v-else>
                                        <div class="input-group-sm">
                                            <input v-model="contact.permanent_address" type="text" class="form-control input-sm">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 20%;">Permanent Address</td>
                                    <td v-if="!settings.contactIsEdit">
                                        <label class="text-bold">@{{ student.provincial_address }}</label>
                                    </td>
                                    <td v-else>
                                        <div class="input-group-sm">
                                            <input v-model="contact.provincial_address" type="text" class="form-control input-sm">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Home number</td>
                                    <td v-if="!settings.contactIsEdit">
                                        <label class="text-bold">@{{ student.home_number }}</label>
                                    </td>
                                    <td v-else>
                                        <div class="input-group-sm">
                                            <input v-model="contact.home_number" type="text" class="form-control input-sm">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Mobile number</td>
                                    <td v-if="!settings.contactIsEdit">
                                        <label class=" text-bold">@{{ student.mobile_number }}</label>
                                    </td>
                                    <td v-else>
                                        <div class="input-group-sm">
                                            <input v-model="contact.mobile_number" type="text" class="form-control input-sm">
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="nav-tabs-custom">
                <button v-show="isAuthorize" v-if="!settings.parentIsEdit" @click="settings.parentIsEdit = true;" class="btn btn-xs btn-primary pull-right m-t-10 m-r-10"><span class="fa fa-pencil"></span></button>
                <div v-else>
                    <button @click="cancelParentDetails" class="btn btn-danger btn-xs pull-right m-t-10 m-r-10"><span class="fa fa-times"></span></button>
                    <button @click="updateParentDetails" class="btn btn-xs btn-success pull-right m-t-10" style="margin-right: 5px"><span class="fa fa-check"></span></button>
                </div>
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#family" data-toggle="tab" aria-expanded="true">
                            <span class="fa fa-users"></span>
                            <label for="" class="control-label">Family Details</label>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="family" class="tab-pane active">
                        <table class="table table-striped table-bordered table-condensed">
                            <tbody>
                            <tr>
                                <td colspan="2">
                                    <label for="" class="control-label">Father</label>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 35%" >First Name</td>
                                <td v-if="!settings.parentIsEdit">
                                    <label for="" class="text-bold">@{{ student.father.first_name }}</label>
                                </td>
                                <td v-else>
                                    <div class="input-group-sm">
                                        <input v-model="parent.f_first_name" type="text" class="form-control input-sm">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Middle Name</td>
                                <td v-if="!settings.parentIsEdit">
                                    <label for="" class="text-bold">@{{ student.father.middle_name }}</label>
                                </td>
                                <td v-else>
                                    <div class="input-group-sm">
                                        <input v-model="parent.f_middle_name" type="text" class="form-control input-sm">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Last Name</td>
                                <td v-if="!settings.parentIsEdit">
                                    <label for="" class="text-bold">@{{ student.father.last_name }}</label>
                                </td>
                                <td v-else>
                                    <div class="input-group-sm">
                                        <input v-model="parent.f_last_name" type="text" class="form-control input-sm">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Occupation</td>
                                <td v-if="!settings.parentIsEdit">
                                    <label for="" class="text-bold">@{{ student.father.occupation }}</label>
                                </td>
                                <td v-else>
                                    <div class="input-group-sm">
                                        <input v-model="parent.f_occupation" type="text" class="form-control input-sm">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Company</td>
                                <td v-if="!settings.parentIsEdit">
                                    <label for="" class="text-bold">@{{ student.father.company }}</label>
                                </td>
                                <td v-else>
                                    <div class="input-group-sm">
                                        <input v-model="parent.f_company" type="text" class="form-control input-sm">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Contact No.</td>
                                <td v-if="!settings.parentIsEdit">
                                    <label for="" class="text-bold">@{{ student.father.contact_no }}</label>
                                </td>
                                <td v-else>
                                    <div class="input-group-sm">
                                        <input v-model="parent.f_contact_no" type="text" class="form-control input-sm">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><label for="" class="control-label">Mother</label></td>
                            </tr>
                            <tr>
                                <td>First Name</td>
                                <td v-if="!settings.parentIsEdit">
                                    <label for="" class="text-bold">@{{ student.mother.first_name }}</label>
                                </td>
                                <td v-else>
                                    <div class="input-group-sm">
                                        <input v-model="parent.m_first_name" type="text" class="form-control input-sm">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Middle Name</td>
                                <td v-if="!settings.parentIsEdit">
                                    <label for="" class="text-bold">@{{ student.mother.middle_name }}</label>
                                </td>
                                <td v-else>
                                    <div class="input-group-sm">
                                        <input v-model="parent.m_middle_name" type="text" class="form-control input-sm">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Last Name</td>
                                <td v-if="!settings.parentIsEdit">
                                    <label for="" class="text-bold">@{{ student.mother.last_name }}</label>
                                </td>
                                <td v-else>
                                    <div class="input-group-sm">
                                        <input v-model="parent.m_last_name" type="text" class="form-control input-sm">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Occupation</td>
                                <td v-if="!settings.parentIsEdit">
                                    <label for="" class="text-bold">@{{ student.mother.occupation }}</label>
                                </td>
                                <td v-else>
                                    <div class="input-group-sm">
                                        <input v-model="parent.m_occupation" type="text" class="form-control input-sm">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Company</td>
                                <td v-if="!settings.parentIsEdit">
                                    <label for="" class="text-bold">@{{ student.mother.company }}</label>
                                </td>
                                <td v-else>
                                    <div class="input-grou-sm">
                                        <input v-model="parent.m_company" type="text" class="form-control input-sm">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Contact No.</td>
                                <td v-if="!settings.parentIsEdit">
                                    <label for="" class="text-bold">@{{ student.mother.contact_no }}</label>
                                </td>
                                <td v-else>
                                    <div class="input-group-sm">
                                        <input v-model="parent.m_contact_no" type="text" class="form-control input-sm">
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="nav-tabs-custom">
                <button v-show="isAuthorize" @click="createExperienceDetails" class="btn btn-primary btn-xs pull-right m-t-10 m-r-10"><span class="fa fa-plus"></span></button>
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#work-experience" data-toggle="tab" aria-expanded="true">
                            <span class="fa fa-users"></span>
                            <label for="" class="control-label">Work Experiences/On-the-Job Training</label>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="work-experience" class="tab-pane active">
                        <table v-for="exp in student.experience" class="table table-striped table-bordered table-condensed">
                            <tbody>
                                <tr>
                                    <td colspan="2">
                                        <div v-show="isAuthorize" v-if="settings.experienceIsEdit != exp.id">
                                            <button @click="deleteExperienceDetails(exp.id)" class="btn btn-danger btn-xs pull-right"><span class="fa fa-trash"></span></button>
                                            <button @click="editExperienceDetails(exp.id)" class="btn btn-primary btn-xs pull-right" style="margin-right: 5px;"><span class="fa fa-pencil"></span></button>
                                        </div>
                                        <div v-else>
                                            <button @click="settings.experienceIsEdit = 0" class="btn btn-danger btn-xs pull-right"><span class="fa fa-times"></span></button>
                                            <button @click="updateExperienceDetails(exp.id)" class="btn btn-success btn-xs pull-right" style="margin-right: 5px;"><span class="fa fa-check"></span></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 35%;">Company Name</td>
                                    <td v-if="settings.experienceIsEdit != exp.id">
                                        <label for="" class="text-bold">@{{ exp.company }}</label>
                                    </td>
                                    <td v-else>
                                        <div class="input-group-sm">
                                            <input v-model="experience.company_name" type="text" class="form-control input-sm">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Company Address</td>
                                    <td v-if="settings.experienceIsEdit != exp.id">
                                        <label for="" class="text-bold">@{{ exp.address }}</label>
                                    </td>
                                    <td v-else>
                                        <div class="input-group-sm">
                                            <input v-model="experience.company_address" type="text" class="form-control input-sm">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Start Date</td>
                                    <td v-if="settings.experienceIsEdit != exp.id">
                                        <label for="" class="text-bold">@{{ exp.start_date | toFormattedDateString }}</label>
                                    </td>
                                    <td v-else>
                                        <div class="input-group-sm">
                                            <input v-model="experience.start_date" type="date" class="form-control input-sm">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>End Date</td>
                                    <td v-if="settings.experienceIsEdit != exp.id">
                                        <label for="" class="text-bold">@{{ exp.end_date | toFormattedDateString }}</label>
                                    </td>
                                    <td v-else>
                                        <div class="input-group-sm">
                                            <input v-model="experience.end_date" type="date" class="form-control input-sm">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Job Description</td>
                                    <td v-if="settings.experienceIsEdit != exp.id">
                                        <label for="" class="text-bold">@{{ exp.description }}</label>
                                    </td>
                                    <td v-else>
                                        <div class="input-group-sm">
                                            <input v-model="experience.job_description" type="text" class="form-control input-sm">
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        

        <div class="modal fade" id="view-event" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
            <form>
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"></h4>
                        </div>
                        <div class="modal-body">
                            <div class="box box-solid">
                                <div class="box-body">
                                    <div>
                                        <label>@{{ event.name }}</label>
                                        <label class="pull-right">@{{ event.date }}</label>
                                    </div>
                                    <div class="m-t-10">
                                        <p class="text-justify">
                                            @{{ event.description }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </form>
        </div><!-- /.modal -->

        <div class="modal fade" id="photo-upload" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"></h4>
                        </div>
                        <div class="modal-body">
                            <input type="file" ref="file" @change="handleFileUpload()">
                        </div>
                        <div class="modal-footer clearfix">
                            <button @click="uploadPhoto()" class="btn btn-primary btn-flat btn-block">Upload File</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
@endsection

@section('script')
    <script>
        const app = new Vue({
            el: '#app',
            data: {
                student: [],
                degrees: [],
                schools: [],
                basicRequirements: {
                    links: {
                        prev: '',
                        next: ''
                    }
                },
                paymentRequirements:{
                    links: {
                        prev: '',
                        next: ''
                    }
                },
                visaRequirements: {
                    links: {
                        prev: '',
                        next: ''
                    }
                },
                events: [],
                event: [],
                user_id: '{{ Auth::user()->id }}',
                settings: {
                    personalIsEdit: false,
                    contactIsEdit: false,
                    parentIsEdit: false,
                    educationIsEdit: false,
                    experienceIsEdit: false
                },
                personal: {
                    first_name: '',
                    middle_name: '',
                    last_name: '',
                    birthdate: '',
                    gender: '',
                    skype_id: '',
                    fb_email: ''
                },
                contact: {
                    permanent_address: '',
                    provincial_address: '',
                    home_number: '',
                    mobile_number: ''
                },
                parent: {
                    f_first_name: '',
                    f_middle_name: '',
                    f_last_name: '',
                    f_occupation: '',
                    f_company: '',
                    f_contact_no: '',

                    m_first_name: '',
                    m_middle_name: '',
                    m_last_name: '',
                    m_occupation: '',
                    m_company: '',
                    m_contact_no: ''
                },
                education: {
                    t_school_name: '',
                    t_address: '',
                    t_degree: '',
                    t_start_date: '',
                    t_end_date: '',

                    s_school_name: '',
                    s_address: '',
                    s_start_date: '',
                    s_end_date: ''
                },
                experience: {
                    company_name: '',
                    company_address: '',
                    start_date: '',
                    end_date: '',
                    job_description: ''
                },
                field: '',
                loading: false,
                file: ''
            },
            computed: {
                isAuthorize () {
                    if (this.student.application_status === "Program Proper") {
                        return false;
                    } else if (this.student.application_status === "For PDOS & CFO") {
                        return false;
                    } else {
                        return true;
                    }
                }
            },
            mounted: function() {
                this.loadStudentDetails();
                this.loadEvents();
                this.loadDegrees();
                this.loadSchools();
            },
            filters: {
                avatar: function (value) {
                    if (!value) {
                        return 'https://placeimg.com/150/150/any'
                    } else {
                        return `/uploaded/${value}`
                    }
                },
                toFormattedDateString: function (value) {
                    let d = new Date(value);
                    let months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                    return `${months[d.getMonth()]} ${d.getDate()}, ${d.getFullYear()}`;
                }
            },
            methods: {
                handleFileUpload () {
                    this.file = this.$refs.file.files[0];
                },
                loadSchools() {
                    axios.get(`/school/view`)
                        .then((response) => {
                            this.schools = response.data;
                        }).catch((error) => {
                        console.log(error);
                    });
                },
                loadDegrees() {
                    axios.get('/degree/getAll')
                        .then((response) => {
                            this.degrees = response.data;
                        });
                },
                loadStudentDetails() {
                    axios.get(`/stud/view?id=${this.user_id}`)
                        .then((response) => {
                            this.student = response.data.data;
                            this.program_id = response.data.data.program_id;

                            this.personal.first_name = response.data.data.first_name;
                            this.personal.middle_name = response.data.data.middle_name;
                            this.personal.last_name = response.data.data.last_name;
                            this.personal.birthdate = response.data.data.birthdate;
                            this.personal.gender = response.data.data.gender;
                            this.personal.skype_id = response.data.data.skype_id;
                            this.personal.fb_email = response.data.data.fb_email;

                            this.education.t_school_name = response.data.data.tertiary.school_name;
                            this.education.t_address = response.data.data.tertiary.address;
                            this.education.t_degree = response.data.data.tertiary.degree;
                            this.education.t_start_date = response.data.data.tertiary.start_date;
                            this.education.t_end_date = response.data.data.tertiary.date_graduated;
                            this.education.s_school_name = response.data.data.secondary.school_name;
                            this.education.s_address = response.data.data.secondary.address;
                            this.education.s_start_date = response.data.data.secondary.start_date;
                            this.education.s_end_date = response.data.data.secondary.date_graduated;

                            this.contact.permanent_address = response.data.data.permanent_address;
                            this.contact.provincial_address = response.data.data.provincial_address;
                            this.contact.home_number = response.data.data.home_number;
                            this.contact.mobile_number = response.data.data.mobile_number;

                            this.parent.f_first_name = response.data.data.father.first_name;
                            this.parent.f_middle_name = response.data.data.father.middle_name;
                            this.parent.f_last_name = response.data.data.father.last_name;
                            this.parent.f_occupation = response.data.data.father.occupation;
                            this.parent.f_company = response.data.data.father.company;
                            this.parent.f_contact_no = response.data.data.father.contact_no;

                            this.parent.m_first_name = response.data.data.mother.first_name;
                            this.parent.m_middle_name = response.data.data.mother.middle_name;
                            this.parent.m_last_name = response.data.data.mother.last_name;
                            this.parent.m_occupation = response.data.data.mother.occupation;
                            this.parent.m_company = response.data.data.mother.company;
                            this.parent.m_contact_no = response.data.data.mother.contact_no;
                        }).catch((error) => {
                            console.log(error);
                    })
                },
                loadEvents() {
                    axios.get('/event/view')
                        .then((response) => {
                            this.events = response.data.data;
                        }).catch((error) => {
                            console.log(error);
                    })
                },
                pagination(link, type) {
                    axios.get(link)
                        .then((response) => {
                            switch (type) {
                                case 'basic':
                                    this.basicRequirements = response.data;
                                    break;
                                case 'payment':
                                    this.paymentRequirements = response.data;
                                    break;
                                case 'visa':
                                    this.visaRequirements = response.data;
                                    break;
                            }
                        })
                },
                viewProfile() {
                    $('#profile-modal').modal('show');
                },
                viewEvent(id) {
                    this.event = _.find(this.events, (obj) => { return obj.id === id });
                    $('#view-event').modal('show');
                },
                selectPhoto () {
                    $('#photo-upload').modal('show');
                },
                uploadPhoto () {
                    let formData = new FormData();
                    formData.append('file', this.file);

                    axios.post(`/stud/photo/upload`, formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                        .then((response) => {
                            this.loadStudentDetails();
                            $('#photo-upload').modal('hide');
                            swal({
                                title: 'Success',
                                type: 'success',
                                confirmButtonText: 'Continue'
                            })
                        });
                },
                updatePersonalDetails() {
                    this.loading = true; 
                    axios.post(`/stud/updatePersonalDetails`, this.personal)
                        .then(({data}) => {
                            this.loading = false;
                            this.settings.personalIsEdit = false;
                            this.loadStudentDetails();
                            swal({
                                title: data.message,
                                type: 'success',
                                confirmButtonText: 'Continue'
                            })
                        }).catch((error) => {
                            this.loading = false;
                            swal({
                                title: 'Something went wrong',
                                type: 'error',
                                confirmButtonText: 'Go Back!'
                            })
                    })
                },
                cancelPersonalDetails() {
                    this.settings.personalIsEdit = false;
                },
                updateContactDetails() {
                    this.loading = true;
                    axios.post(`/stud/updateContactDetails`, this.contact)
                        .then(({data}) => {
                            this.loading = false;
                            this.settings.contactIsEdit = false;
                            this.loadStudentDetails();
                            swal({
                                title: data.message,
                                type: 'success',
                                confirmButtonText: 'Continue'
                            }).catch((error) => {
                                this.loading = false;
                                swal({
                                    title: 'Something went wrong.',
                                    type: 'error',
                                    confirmButtonText: 'Go Back!'
                                })
                            })
                        })
                },
                cancelContactDetails() {
                    this.settings.contactIsEdit = false;
                },
                updateParentDetails() {
                    this.loading = true;
                    axios.post('/stud/updateParentDetails', this.parent)
                        .then(({data}) => {
                            this.loading = false;
                            this.settings.parentIsEdit = false;
                            this.loadStudentDetails();
                            swal({
                                title: data.message,
                                type: 'success',
                                confirmButtonText : 'Continue'
                            }).catch((error) => {
                                this.loading = false;
                                swal({
                                    title: 'Something went wrong.',
                                    type: 'error',
                                    confirmButtonText: 'Go Back!'
                                })
                            })
                        })
                },
                cancelParentDetails() {
                    this.settings.parentIsEdit = false;
                    this.parent.f_first_name = '';
                    this.parent.f_middle_name = '';
                    this.parent.f_last_name = '';
                    this.parent.f_occupation = '';
                    this.parent.f_company = '';
                    this.parent.f_contact_no = '';

                    this.parent.m_first_name = '';
                    this.parent.m_middle_name = '';
                    this.parent.m_last_name = '';
                    this.parent.m_occupation = '';
                    this.parent.m_company = '';
                    this.parent.m_contact_no = '';

                },
                updateEducationalDetails() {
                    this.loading = true;
                    axios.post('/stud/updateEducationalDetails', this.education)
                        .then(({data}) => {
                            this.loading = false;
                            this.settings.educationIsEdit = false;
                            this.loadStudentDetails();
                            swal({
                                title: data.message,
                                type: 'success',
                                confirmButtonText: 'Continue'
                            })
                            }).catch((error) => {
                                this.loading = false;
                                swal({
                                    title: 'Something went wrong.',
                                    type: 'error',
                                    confirmButtonText: 'Go Back!'
                                })
                            })
                },
                cancelEducationalDetails() {
                    this.settings.educationIsEdit = false;
                },
                updateExperienceDetails(id) {
                    this.loading = true;
                    axios.post(`/stud/updateExperienceDetails/${id}`, this.experience)
                        .then(({data}) => {
                            this.loading = false;
                            this.settings.experienceIsEdit = false;
                            this.loadStudentDetails();
                            swal({
                                title: data.message,
                                type: 'success',
                                confirmButtonText: 'Continue'
                            })
                        }).catch((error) => {
                            this.loading = false;
                            swal({
                                title: 'Something went wrong.',
                                type: 'error',
                                confirmButtonText: 'Go Back!'
                            })
                        })
                },
                cancelExperienceDetails() {
                    this.settings.experienceIsEdit = false;
                    this.experience.company_name = '';
                    this.experience.company_address = '';
                    this.experience.start_date = '';
                    this.experience.end_date = '';
                    this.experience.job_description = '';
                },
                createExperienceDetails() {
                    axios.post('/stud/addExperienceDetails')
                        .then(({data}) => {
                            this.loadStudentDetails();
                            console.log(data.message);
                        })
                },
                editExperienceDetails(id) {
                    this.settings.experienceIsEdit = id;
                    this.experience.company_name = '';
                    this.experience.company_address = '';
                    this.experience.start_date = '';
                    this.experience.end_date = '';
                    this.experience.job_description = '';
                },
                deleteExperienceDetails(id) {
                    axios.post(`/stud/deleteExperienceDetails/${id}`)
                        .then(({data}) => {
                            this.loadStudentDetails()
                            swal({
                                title: data.message,
                                type: 'success',
                                confirmButtonText: 'Continue'
                            })
                        })
                        .catch((error) => {
                            swal({
                                title: 'Something went wrong!',
                                type: 'error',
                                confirmButtonText: 'Go Back!'
                            })
                        })
                }
            }
        });
    </script>
@endsection
@extends('layouts.app')

@section('title', 'Students')

@section('content')
    <div id="app" v-cloak>
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <a href="javascript:void(0)" @click="selectPhoto()">
                        <img class="profile-user-img img-responsive img-circle" :src="student.profile_picture | avatar" alt="User profile picture"/>
                    </a>
                    <h3 class="profile-username text-center">@{{ student.first_name }}&nbsp; @{{ student.last_name }}</h3>
                    <p class="text-muted text-center">@{{ student.program }}</p>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item" v-if="student.application_id">
                            <b>Program ID</b>
                            <a class="pull-right text-green text-sm">@{{ student.application_id }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Application Status</b>
                            <a class="pull-right text-green text-sm">@{{ student.application_status }}</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <i class="fa fa-calendar"></i>
                    <label for="" class="control-label">Schedule of Events</label>
                </div>
                <div class="box-body">
                    <ul class="products-list product-list-in-box">
                        <li class="item" v-if="events == 0">
                            No Upcoming Event
                        </li>
                        <li v-else class="item" v-for="event in events">
                            <div class="product-img">
                                <img src="http://via.placeholder.com/50x50" alt="">
                            </div>
                            <div class="product-info">
                                <a href="javascript:void(0)" class="product-title" @click="viewEvent(event.id)">
                                    @{{ event.name }}
                                    <span class="label label-primary pull-right">@{{ event.date }}</span>
                                </a>
                                <span class="product-description">
                                    @{{ event.description }}
                                </span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="nav-tabs-custom">
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
                                    <td v-if="!setting.firstNameIsEdit">
                                        <label class="text-bold"> @{{ student.first_name }}</label>
                                        <a @click="hideField('firstName');" href="#" class="pull-right">
                                            <span class="fa fa-edit"></span>
                                        </a>
                                    </td>
                                    <td v-else>
                                        <div class="input-group">
                                            <input v-model="field" type="text" class="form-control input-sm">
                                            <span class="input-group-btn">
                                                    <button @click="updateField('first_name', field); setting.firstNameIsEdit = false;" class="btn btn-primary btn-flat btn-sm">Update</button>
                                                </span>
                                            <span class="input-group-btn">
                                                    <button @click="setting.firstNameIsEdit = false;" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                                </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Middle name</td>
                                    <td v-if="!setting.middleNameIsEdit">
                                        <label class="text-bold">@{{ student.middle_name }}</label>
                                        <a @click="hideField('middleName');" href="#" class="pull-right">
                                            <span class="fa fa-edit"></span>
                                        </a>
                                    </td>
                                    <td v-else>
                                        <div class="input-group">
                                            <input v-model="field" type="text" class="form-control input-sm">
                                            <span class="input-group-btn">
                                                    <button @click="updateField('middle_name', field); setting.middleNameIsEdit = false;" class="btn btn-primary btn-flat btn-sm">Update</button>
                                                </span>
                                            <span class="input-group-btn">
                                                    <button @click="setting.middleNameIsEdit = false;" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                                </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Last name</td>
                                    <td v-if="!setting.lastNameIsEdit">
                                        <label class="text-bold">@{{ student.last_name }}</label>
                                        <a @click="hideField('lastName');" href="#" class="pull-right">
                                            <span class="fa fa-edit"></span>
                                        </a>
                                    </td>
                                    <td v-else>
                                        <div class="input-group">
                                            <input v-model="field" type="text" class="form-control input-sm">
                                            <span class="input-group-btn">
                                                    <button @click="updateField('last_name', field); setting.lastNameIsEdit = false;" class="btn btn-primary btn-flat btn-sm">Update</button>
                                                </span>
                                            <span class="input-group-btn">
                                                    <button @click="setting.lastNameIsEdit = false;" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                                </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Birthdate</td>
                                    <td v-if="!setting.birthDateIsEdit">
                                        <label class="text-bold">@{{ student.birthdate }}</label>
                                        <a @click="hideField('birthdate');" href="#" class="pull-right">
                                            <span class="fa fa-edit"></span>
                                        </a>
                                    </td>
                                    <td v-else>
                                        <div class="input-group">
                                            <input v-model="field" type="date" class="form-control input-sm">
                                            <span class="input-group-btn">
                                                    <button @click="updateField('birthdate', field); setting.birthDateIsEdit = false;" class="btn btn-primary btn-flat btn-sm">Update</button>
                                                </span>
                                            <span class="input-group-btn">
                                                    <button @click="setting.birthDateIsEdit = false;" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                                </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Gender</td>
                                    <td v-if="!setting.genderIsEdit">
                                        <label class="text-bold">@{{ student.gender }}</label>
                                        <a @click="hideField('gender');" href="#" class="pull-right">
                                            <span class="fa fa-edit"></span>
                                        </a>
                                    </td>
                                    <td v-else>
                                        <div class="input-group">
                                            <select v-model="field" class="form-control input-sm">
                                                <option value="">Select gender</option>
                                                <option value="MALE">Male</option>
                                                <option value="FEMALE">Female</option>
                                            </select>
                                            <span class="input-group-btn">
                                                    <button @click="updateField('gender', field); setting.genderIsEdit = false;" class="btn btn-primary btn-flat btn-sm">Update</button>
                                                </span>
                                            <span class="input-group-btn">
                                                    <button @click="setting.genderIsEdit = false;" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                                </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 20%;">Permanent Address</td>
                                    <td v-if="!setting.addressIsEdit">
                                        <label class="text-bold">@{{ student.permanent_address }}</label>
                                        <a @click="hideField('address');" href="#" class="pull-right">
                                            <span class="fa fa-edit"></span>
                                        </a>
                                    </td>
                                    <td v-else>
                                        <div class="input-group">
                                            <input v-model="field" type="text" class="form-control input-sm">
                                            <span class="input-group-btn">
                                                    <button @click="updateField('permanent_address', field); setting.addressIsEdit = false;" class="btn btn-primary btn-flat btn-sm">Update</button>
                                                </span>
                                            <span class="input-group-btn">
                                                    <button @click="setting.addressIsEdit = false;" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                                </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 20%;">Provincial Address</td>
                                    <td v-if="!setting.addressIsEdit">
                                        <label class="text-bold">@{{ student.provincial_address }}</label>
                                        <a @click="hideField('address');" href="#" class="pull-right">
                                            <span class="fa fa-edit"></span>
                                        </a>
                                    </td>
                                    <td v-else>
                                        <div class="input-group">
                                            <input v-model="field" type="text" class="form-control input-sm">
                                            <span class="input-group-btn">
                                                    <button @click="updateField('provincial_address', field); setting.addressIsEdit = false;" class="btn btn-primary btn-flat btn-sm">Update</button>
                                                </span>
                                            <span class="input-group-btn">
                                                    <button @click="setting.addressIsEdit = false;" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                                </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Home number</td>
                                    <td v-if="!setting.homeNumberIsEdit">
                                        <label class="text-bold">@{{ student.home_number }}</label>
                                        <a @click="hideField('homeNumber');" href="#" class="pull-right">
                                            <span class="fa fa-edit"></span>
                                        </a>
                                    </td>
                                    <td v-else>
                                        <div class="input-group">
                                            <input v-model="field" type="number" class="form-control input-sm">
                                            <span class="input-group-btn">
                                                    <button @click="updateField('home_number', field); setting.homeNumberIsEdit = false;" class="btn btn-primary btn-flat btn-sm">Update</button>
                                                </span>
                                            <span class="input-group-btn">
                                                    <button @click="setting.homeNumberIsEdit = false;" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                                </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Mobile number</td>
                                    <td v-if="!setting.mobileNumberIsEdit">
                                        <label class=" text-bold">@{{ student.mobile_number }}</label>
                                        <a @click="hideField('mobileNumber');" href="#" class="pull-right">
                                            <span class="fa fa-edit"></span>
                                        </a>
                                    </td>
                                    <td v-else>
                                        <div class="input-group">
                                            <input v-model="field" type="number" class="form-control input-sm">
                                            <span class="input-group-btn">
                                                    <button @click="updateField('mobile_number', field); setting.mobileNumberIsEdit = false;" class="btn btn-primary btn-flat btn-sm">Update</button>
                                                </span>
                                            <span class="input-group-btn">
                                                    <button @click="setting.mobileNumberIsEdit = false;" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                                </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Skype ID</td>
                                    <td v-if="!setting.skypeIdIsEdit">
                                        <label class="text-bold">@{{ student.skype_id }}</label>
                                        <a @click="hideField('skypeId');" href="#" class="pull-right">
                                            <span class="fa fa-edit"></span>
                                        </a>
                                    </td>
                                    <td v-else>
                                        <div class="input-group">
                                            <input v-model="field" type="text" class="form-control input-sm">
                                            <span class="input-group-btn">
                                                <button @click="updateField('skype_id', field); setting.skypeIdIsEdit = false;" class="btn btn-primary btn-flat btn-sm">Update</button>
                                            </span>
                                            <span class="input-group-btn">
                                                <button @click="setting.skypeIdIsEdit = false;" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Facebook Email</td>
                                    <td class="text-bold">
                                        @{{ student.fb_email }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="nav-tabs-custom">
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
                                    <td style="width: 35%" colspan="2"><label for="" class="control-label">Father</label></td>
                            </tr>
                            <tr>
                                <td colspan="">First Name</td>
                                <td v-if="!father.firstNameIsEdit">
                                    <label for="" class="text-bold">@{{ student.father.first_name }}</label>
                                    <a @click="hideField('fatherFirstName');" class="pull-right">
                                        <span class="fa fa-edit"></span>
                                    </a>
                                </td>
                                <td v-else>
                                    <div class="input-group">
                                        <input v-model="field" type="text" class="form-control input-sm">
                                        <span class="input-group-btn">
                                            <button @click="updateFather('first_name', field); father.firstNameIsEdit = false;" class="btn btn-primary btn-flat btn-sm">Update</button>
                                        </span>
                                        <span class="input-group-btn">
                                            <button @click="father.firstNameIsEdit = false;" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Middle Name</td>
                                <td v-if="!father.middleNameIsEdit">
                                    <label for="" class="text-bold">@{{ student.father.middle_name }}</label>
                                    <a @click="hideField('fatherMiddleName');" class="pull-right">
                                        <span class="fa fa-edit"></span>
                                    </a>
                                </td>
                                <td v-else>
                                    <div class="input-group">
                                        <input v-model="field" type="text" class="form-control input-sm">
                                        <span class="input-group-btn">
                                            <button @click="updateFather('middle_name', field); father.middleNameIsEdit = false;" class="btn btn-primary btn-flat btn-sm">Update</button>
                                        </span>
                                        <span class="input-group-btn">
                                            <button @click="father.middleNameIsEdit = false;" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Last Name</td>
                                <td v-if="!father.lastNameIsEdit">
                                    <label for="" class="text-bold">@{{ student.father.last_name }}</label>
                                    <a @click="hideField('fatherLastName');" class="pull-right">
                                        <span class="fa fa-edit"></span>
                                    </a>
                                </td>
                                <td v-else>
                                    <div class="input-group">
                                        <input v-model="field" type="text" class="form-control input-sm">
                                        <span class="input-group-btn">
                                            <button @click="updateFather('last_name', field); father.lastNameIsEdit = false;" class="btn btn-primary btn-flat btn-sm">Update</button>
                                        </span>
                                        <span class="input-group-btn">
                                            <button @click="father.lastNameIsEdit = false;" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Occupation</td>
                                <td v-if="!father.occupationIsEdit">
                                    <label for="" class="text-bold">@{{ student.father.occupation }}</label>
                                    <a @click="hideField('fatherOccupation');" class="pull-right">
                                        <span class="fa fa-edit"></span>
                                    </a>
                                </td>
                                <td v-else>
                                    <div class="input-group">
                                        <input v-model="field" type="text" class="form-control input-sm">
                                        <span class="input-group-btn">
                                            <button @click="updateFather('occupation', field); father.occupationIsEdit = false;" class="btn btn-primary btn-flat btn-sm">Update</button>
                                        </span>
                                        <span class="input-group-btn">
                                            <button @click="father.occupationIsEdit = false;" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Company</td>
                                <td v-if="!father.companyIsEdit">
                                    <label for="" class="text-bold">@{{ student.father.company }}</label>
                                    <a @click="hideField('fatherCompany');" class="pull-right">
                                        <span class="fa fa-edit"></span>
                                    </a>
                                </td>
                                <td v-else>
                                    <div class="input-group">
                                        <input v-model="field" type="text" class="form-control input-sm">
                                        <span class="input-group-btn">
                                            <button @click="updateFather('company', field); father.companyIsEdit = false;" class="btn btn-primary btn-flat btn-sm">Update</button>
                                        </span>
                                        <span class="input-group-btn">
                                            <button @click="father.companyIsEdit = false;" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Contact No.</td>
                                <td v-if="!father.contactNumberIsEdit">
                                    <label for="" class="text-bold">@{{ student.father.contact_no }}</label>
                                    <a @click="hideField('fatherContactNumber');" class="pull-right">
                                        <span class="fa fa-edit"></span>
                                    </a>
                                </td>
                                <td v-else>
                                    <div class="input-group">
                                        <input v-model="field" type="text" class="form-control input-sm">
                                        <span class="input-group-btn">
                                            <button @click="updateFather('contact_no', field); father.contactNumberIsEdit = false;" class="btn btn-primary btn-flat btn-sm">Update</button>
                                        </span>
                                        <span class="input-group-btn">
                                            <button @click="father.contactNumberIsEdit = false;" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><label for="" class="control-label">Mother</label></td>
                            </tr>
                            <tr>
                                <td>First Name</td>
                                <td v-if="!mother.firstNameIsEdit">
                                    <label for="" class="text-bold">@{{ student.mother.first_name }}</label>
                                    <a @click="hideField('motherFirstName');" class="pull-right">
                                        <span class="fa fa-edit"></span>
                                    </a>
                                </td>
                                <td v-else>
                                    <div class="input-group">
                                        <input v-model="field" type="text" class="form-control input-sm">
                                        <span class="input-group-btn">
                                            <button @click="updateMother('first_name', field); mother.firstNameIsEdit = false;" class="btn btn-primary btn-flat btn-sm">Update</button>
                                        </span>
                                        <span class="input-group-btn">
                                            <button @click="mother.firstNameIsEdit = false;" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Middle Name</td>
                                <td v-if="!mother.middleNameIsEdit">
                                    <label for="" class="text-bold">@{{ student.mother.middle_name }}</label>
                                    <a @click="hideField('motherMiddleName');" class="pull-right">
                                        <span class="fa fa-edit"></span>
                                    </a>
                                </td>
                                <td v-else>
                                    <div class="input-group">
                                        <input v-model="field" type="text" class="form-control input-sm">
                                        <span class="input-group-btn">
                                            <button @click="updateMother('middle_name', field); mother.middleNameIsEdit = false;" class="btn btn-primary btn-flat btn-sm">Update</button>
                                        </span>
                                        <span class="input-group-btn">
                                            <button @click="mother.middleNameIsEdit = false;" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Last Name</td>
                                <td v-if="!mother.lastNameIsEdit">
                                    <label for="" class="text-bold">@{{ student.mother.last_name }}</label>
                                    <a @click="hideField('motherLastName');" class="pull-right">
                                        <span class="fa fa-edit"></span>
                                    </a>
                                </td>
                                <td v-else>
                                    <div class="input-group">
                                        <input v-model="field" type="text" class="form-control input-sm">
                                        <span class="input-group-btn">
                                            <button @click="updateMother('last_name', field); mother.lastNameIsEdit = false;" class="btn btn-primary btn-flat btn-sm">Update</button>
                                        </span>
                                        <span class="input-group-btn">
                                            <button @click="mother.lastNameIsEdit = false;" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Occupation</td>
                                <td v-if="!mother.occupationIsEdit">
                                    <label for="" class="text-bold">@{{ student.mother.occupation }}</label>
                                    <a @click="hideField('motherOccupation');" class="pull-right">
                                        <span class="fa fa-edit"></span>
                                    </a>
                                </td>
                                <td v-else>
                                    <div class="input-group">
                                        <input v-model="field" type="text" class="form-control input-sm">
                                        <span class="input-group-btn">
                                            <button @click="updateMother('occupation', field); mother.occupationIsEdit = false;" class="btn btn-primary btn-flat btn-sm">Update</button>
                                        </span>
                                        <span class="input-group-btn">
                                            <button @click="mother.occupationIsEdit = false;" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Company</td>
                                <td v-if="!mother.companyIsEdit">
                                    <label for="" class="text-bold">@{{ student.mother.company }}</label>
                                    <a @click="hideField('motherCompany');" class="pull-right">
                                        <span class="fa fa-edit"></span>
                                    </a>
                                </td>
                                <td v-else>
                                    <div class="input-group">
                                        <input v-model="field" type="text" class="form-control input-sm">
                                        <span class="input-group-btn">
                                            <button @click="updateMother('company', field); mother.companyIsEdit = false;" class="btn btn-primary btn-flat btn-sm">Update</button>
                                        </span>
                                        <span class="input-group-btn">
                                            <button @click="mother.companyIsEdit = false;" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Contact No.</td>
                                <td v-if="!mother.contactNumberIsEdit">
                                    <label for="" class="text-bold">@{{ student.mother.contact_no }}</label>
                                    <a @click="hideField('motherContactNumber');" class="pull-right">
                                        <span class="fa fa-edit"></span>
                                    </a>
                                </td>
                                <td v-else>
                                    <div class="input-group">
                                        <input v-model="field" type="text" class="form-control input-sm">
                                        <span class="input-group-btn">
                                            <button @click="updateMother('contact_no', field); mother.contactNumberIsEdit = false;" class="btn btn-primary btn-flat btn-sm">Update</button>
                                        </span>
                                        <span class="input-group-btn">
                                            <button @click="mother.contactNumberIsEdit = false;" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="nav-tabs-custom">
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
                                    <td colspan="2" style="width: 35%;"><label for="" class="control-label">Primary Level</label></td>
                                </tr>
                                <tr>
                                    <td>School</td>
                                    <td v-if="!primary.schoolNameIsEdit">
                                        <label for="" class="text-bold">@{{ student.primary.school_name }}</label>
                                        <a @click="hideField('primarySchoolName');" class="pull-right">
                                            <span class="fa fa-edit"></span>
                                        </a>
                                    </td>
                                    <td v-else>
                                        <div class="input-group">
                                            <input v-model="field" type="text" class="form-control input-sm">
                                            <span class="input-group-btn">
                                                <button @click="updatePrimary('school_name', field); primary.schoolNameIsEdit = false;" class="btn btn-primary btn-flat btn-sm">Update</button>
                                            </span>
                                            <span class="input-group-btn">
                                                <button @click="primary.schoolNameIsEdit = false;" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td v-if="!primary.addressIsEdit">
                                        <label for="" class="text-bold">@{{ student.primary.address }}</label>
                                        <a @click="hideField('primaryAddress');" class="pull-right">
                                            <span class="fa fa-edit"></span>
                                        </a>
                                    </td>
                                    <td v-else>
                                        <div class="input-group">
                                            <input v-model="field" type="text" class="form-control input-sm">
                                            <span class="input-group-btn">
                                                <button @click="updatePrimary('address', field); primary.addressIsEdit = false;" class="btn btn-primary btn-flat btn-sm">Update</button>
                                            </span>
                                            <span class="input-group-btn">
                                                <button @click="primary.addressIsEdit = false;" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Date Graduated</td>
                                    <td v-if="!primary.graduatedIsEdit">
                                        <label for="" class="text-bold">@{{ student.primary.date_graduated }}</label>
                                        <a @click="hideField('primaryGraduated');" class="pull-right">
                                            <span class="fa fa-edit"></span>
                                        </a>
                                    </td>
                                    <td v-else>
                                        <div class="input-group">
                                            <input v-model="field" type="date" class="form-control input-sm">
                                            <span class="input-group-btn">
                                                <button @click="updatePrimary('date_graduated', field); primary.graduatedIsEdit = false;" class="btn btn-primary btn-flat btn-sm">Update</button>
                                            </span>
                                            <span class="input-group-btn">
                                                <button @click="primary.graduatedIsEdit = false;" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"><label class="control-label">Secondary Level</label></td>
                                </tr>
                                <tr>
                                    <td>School</td>
                                    <td v-if="!secondary.schoolNameIsEdit">
                                        <label for="" class="text-bold">@{{ student.secondary.school_name }}</label>
                                        <a @click="hideField('secondarySchoolName');" class="pull-right">
                                            <span class="fa fa-edit"></span>
                                        </a>
                                    </td>
                                    <td v-else>
                                        <div class="input-group">
                                            <input v-model="field" type="text" class="form-control input-sm">
                                            <span class="input-group-btn">
                                                <button @click="updateSecondary('school_name', field); secondary.schoolNameIsEdit = false;" class="btn btn-primary btn-flat btn-sm">Update</button>
                                            </span>
                                            <span class="input-group-btn">
                                                <button @click="secondary.schoolNameIsEdit = false;" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td v-if="!secondary.addressIsEdit">
                                        <label for="" class="text-bold">@{{ student.secondary.address }}</label>
                                        <a @click="hideField('secondaryAddress');" class="pull-right">
                                            <span class="fa fa-edit"></span>
                                        </a>
                                    </td>
                                    <td v-else>
                                        <div class="input-group">
                                            <input v-model="field" type="text" class="form-control input-sm">
                                            <span class="input-group-btn">
                                                <button @click="updateSecondary('address', field); secondary.addressIsEdit = false;" class="btn btn-primary btn-flat btn-sm">Update</button>
                                            </span>
                                            <span class="input-group-btn">
                                                <button @click="secondary.addressIsEdit = false;" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Date Graduated</td>
                                    <td v-if="!secondary.graduatedIsEdit">
                                        <label for="" class="text-bold">@{{ student.secondary.date_graduated }}</label>
                                        <a @click="hideField('secondaryGraduated');" class="pull-right">
                                            <span class="fa fa-edit"></span>
                                        </a>
                                    </td>
                                    <td v-else>
                                        <div class="input-group">
                                            <input v-model="field" type="date" class="form-control input-sm">
                                            <span class="input-group-btn">
                                                <button @click="updateSecondary('date_graduated', field); secondary.graduatedIsEdit = false;" class="btn btn-primary btn-flat btn-sm">Update</button>
                                            </span>
                                            <span class="input-group-btn">
                                                <button @click="secondary.graduatedIsEdit = false;" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"><label class="control-label">Tertiary Level</label></td>
                                </tr>
                                <tr>
                                    <td>School</td>
                                    <td v-if="!tertiary.schoolNameIsEdit">
                                        <label for="" class="text-bold">@{{ student.tertiary.school_name }}</label>
                                        <a @click="hideField('tertiarySchoolName');" class="pull-right">
                                            <span class="fa fa-edit"></span>
                                        </a>
                                    </td>
                                    <td v-else>
                                        <div class="input-group">
                                            <input v-model="field" type="text" class="form-control input-sm">
                                            <span class="input-group-btn">
                                                <button @click="updateTertiary('school_name', field); tertiary.schoolNameIsEdit = false;" class="btn btn-primary btn-flat btn-sm">Update</button>
                                            </span>
                                            <span class="input-group-btn">
                                                <button @click="tertiary.schoolNameIsEdit = false;" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td v-if="!tertiary.addressIsEdit">
                                        <label for="" class="text-bold">@{{ student.tertiary.address }}</label>
                                        <a @click="hideField('tertiaryAddress');" class="pull-right">
                                            <span class="fa fa-edit"></span>
                                        </a>
                                    </td>
                                    <td v-else>
                                        <div class="input-group">
                                            <input v-model="field" type="text" class="form-control input-sm">
                                            <span class="input-group-btn">
                                                <button @click="updateTertiary('address', field); tertiary.addressIsEdit = false;" class="btn btn-primary btn-flat btn-sm">Update</button>
                                            </span>
                                            <span class="input-group-btn">
                                                <button @click="tertiary.addressIsEdit = false;" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Degree</td>
                                    <td v-if="!tertiary.degreeIsEdit">
                                        <label for="" class="text-bold">@{{ student.tertiary.degree }}</label>
                                        <a @click="hideField('tertiaryDegree');" class="pull-right">
                                            <span class="fa fa-edit"></span>
                                        </a>
                                    </td>
                                    <td v-else>
                                        <div class="input-group">
                                            <input v-model="field" type="text" class="form-control input-sm">
                                            <span class="input-group-btn">
                                                <button @click="updateTertiary('degree', field); tertiary.degreeIsEdit = false;" class="btn btn-primary btn-flat btn-sm">Update</button>
                                            </span>
                                            <span class="input-group-btn">
                                                <button @click="tertiary.degreeIsEdit = false;" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Date Graduated (<i>expected</i>)</td>
                                    <td v-if="!tertiary.graduatedIsEdit">
                                        <label for="" class="text-bold">@{{ student.tertiary.date_graduated }}</label>
                                        <a @click="hideField('tertiaryGraduated');" class="pull-right">
                                            <span class="fa fa-edit"></span>
                                        </a>
                                    </td>
                                    <td v-else>
                                        <div class="input-group">
                                            <input v-model="field" type="date" class="form-control input-sm">
                                            <span class="input-group-btn">
                                                <button @click="updateTertiary('date_graduated', field); tertiary.graduatedIsEdit = false;" class="btn btn-primary btn-flat btn-sm">Update</button>
                                            </span>
                                            <span class="input-group-btn">
                                                <button @click="tertiary.graduatedIsEdit = false;" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="nav-tabs-custom">
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
                                    <td style="width: 35%;">Company Name</td>
                                    <td class="text-bold">
                                        @{{ exp.company }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Company Address</td>
                                    <td class="text-bold">
                                        @{{ exp.address }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Employment Period</td>
                                    <td class="text-bold">
                                        @{{ exp.start_date }} > @{{ exp.end_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Job Description</td>
                                    <td class="text-bold">
                                        @{{ exp.description }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="profile-modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="overlay-wrapper" :style="{ display: loading ? 'block' : 'none' }">
                        <div class="overlay">
                            <i class="fa fa-circle-o-notch fa-spin fa-2x"></i>
                        </div>
                    </div>
                    <div class="modal-header">
                        <label for="" class="control-label"><i class="fa fa-user"></i>  User Profile</label>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <label class="control-label">Personal Details</label>
                        <table class="table table-striped table-bordered table-condensed">
                            <tbody>
                                <tr>
                                    <td class="text-sm" style="width: 20%;">First name</td>
                                    <td v-if="!setting.firstNameIsEdit" class="text-center">
                                        <label class="text-sm text-bold"> @{{ student.first_name }}</label>
                                        <a @click="hideField('firstName');" href="#" class="pull-right">
                                            <span class="fa fa-edit"></span>
                                        </a>
                                    </td>
                                    <td v-else>
                                        <div class="input-group">
                                            <input v-model="field" type="text" class="form-control input-sm">
                                            <span class="input-group-btn">
                                                    <button @click="updateField('first_name', field); setting.firstNameIsEdit = false;" class="btn btn-primary btn-flat btn-sm">Update</button>
                                                </span>
                                            <span class="input-group-btn">
                                                    <button @click="setting.firstNameIsEdit = false;" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                                </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-sm">Middle name</td>
                                    <td v-if="!setting.middleNameIsEdit" class="text-center">
                                        <label class="text-sm text-bold">@{{ student.middle_name }}</label>
                                        <a @click="hideField('middleName');" href="#" class="pull-right">
                                            <span class="fa fa-edit"></span>
                                        </a>
                                    </td>
                                    <td v-else>
                                        <div class="input-group">
                                            <input v-model="field" type="text" class="form-control input-sm">
                                            <span class="input-group-btn">
                                                    <button @click="updateField('middle_name', field); setting.middleNameIsEdit = false;" class="btn btn-primary btn-flat btn-sm">Update</button>
                                                </span>
                                            <span class="input-group-btn">
                                                    <button @click="setting.middleNameIsEdit = false;" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                                </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-sm">Last name</td>
                                    <td v-if="!setting.lastNameIsEdit" class="text-center">
                                        <label class="text-sm text-bold">@{{ student.last_name }}</label>
                                        <a @click="hideField('lastName');" href="#" class="pull-right">
                                            <span class="fa fa-edit"></span>
                                        </a>
                                    </td>
                                    <td v-else>
                                        <div class="input-group">
                                            <input v-model="field" type="text" class="form-control input-sm">
                                            <span class="input-group-btn">
                                                    <button @click="updateField('last_name', field); setting.lastNameIsEdit = false;" class="btn btn-primary btn-flat btn-sm">Update</button>
                                                </span>
                                            <span class="input-group-btn">
                                                    <button @click="setting.lastNameIsEdit = false;" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                                </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-sm">Birthdate</td>
                                    <td v-if="!setting.birthDateIsEdit" class="text-center">
                                        <label class="text-sm text-bold">@{{ student.birthdate }}</label>
                                        <a @click="hideField('birthdate');" href="#" class="pull-right">
                                            <span class="fa fa-edit"></span>
                                        </a>
                                    </td>
                                    <td v-else>
                                        <div class="input-group">
                                            <input v-model="field" type="date" class="form-control input-sm">
                                            <span class="input-group-btn">
                                                    <button @click="updateField('birthdate', field); setting.birthDateIsEdit = false;" class="btn btn-primary btn-flat btn-sm">Update</button>
                                                </span>
                                            <span class="input-group-btn">
                                                    <button @click="setting.birthDateIsEdit = false;" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                                </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-sm">Gender</td>
                                    <td v-if="!setting.genderIsEdit" class="text-center">
                                        <label class="text-sm text-bold">@{{ student.gender }}</label>
                                        <a @click="hideField('gender');" href="#" class="pull-right">
                                            <span class="fa fa-edit"></span>
                                        </a>
                                    </td>
                                    <td v-else>
                                        <div class="input-group">
                                            <select v-model="field" class="form-control input-sm">
                                                <option value="">Select gender</option>
                                                <option value="MALE">Male</option>
                                                <option value="FEMALE">Female</option>
                                            </select>
                                            <span class="input-group-btn">
                                                    <button @click="updateField('gender', field); setting.genderIsEdit = false;" class="btn btn-primary btn-flat btn-sm">Update</button>
                                                </span>
                                            <span class="input-group-btn">
                                                    <button @click="setting.genderIsEdit = false;" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                                </span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <label class="control-label">Contact Details</label>
                        <table class="table table-striped table-bordered table-condensed">
                            <tbody>
                                <tr>
                                    <td class="text-sm" style="width: 20%;">Address</td>
                                    <td v-if="!setting.addressIsEdit" class="text-center">
                                        <label class="text-sm text-bold">@{{ student.address }}</label>
                                        <a @click="hideField('address');" href="#" class="pull-right">
                                            <span class="fa fa-edit"></span>
                                        </a>
                                    </td>
                                    <td v-else>
                                        <div class="input-group">
                                            <input v-model="field" type="text" class="form-control input-sm">
                                            <span class="input-group-btn">
                                                    <button @click="updateField('address', field); setting.addressIsEdit = false;" class="btn btn-primary btn-flat btn-sm">Update</button>
                                                </span>
                                            <span class="input-group-btn">
                                                    <button @click="setting.addressIsEdit = false;" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                                </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-sm">Home number</td>
                                    <td v-if="!setting.homeNumberIsEdit" class="text-center">
                                        <label class="text-sm text-bold">@{{ student.home_number }}</label>
                                        <a @click="hideField('homeNumber');" href="#" class="pull-right">
                                            <span class="fa fa-edit"></span>
                                        </a>
                                    </td>
                                    <td v-else>
                                        <div class="input-group">
                                            <input v-model="field" type="number" class="form-control input-sm">
                                            <span class="input-group-btn">
                                                    <button @click="updateField('home_number', field); setting.homeNumberIsEdit = false;" class="btn btn-primary btn-flat btn-sm">Update</button>
                                                </span>
                                            <span class="input-group-btn">
                                                    <button @click="setting.homeNumberIsEdit = false;" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                                </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-sm">Mobile number</td>
                                    <td v-if="!setting.mobileNumberIsEdit" class="text-center">
                                        <label class="text-sm text-bold">@{{ student.mobile_number }}</label>
                                        <a @click="hideField('mobileNumber');" href="#" class="pull-right">
                                            <span class="fa fa-edit"></span>
                                        </a>
                                    </td>
                                    <td v-else>
                                        <div class="input-group">
                                            <input v-model="field" type="number" class="form-control input-sm">
                                            <span class="input-group-btn">
                                                    <button @click="updateField('mobile_number', field); setting.mobileNumberIsEdit = false;" class="btn btn-primary btn-flat btn-sm">Update</button>
                                                </span>
                                            <span class="input-group-btn">
                                                    <button @click="setting.mobileNumberIsEdit = false;" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                                </span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <label class="control-label">School Details</label>
                        <table class="table table-striped table-bordered table-condensed">
                            <tbody>
                                <tr>
                                    <td class="text-sm" style="width: 20%;">School</td>
                                    <td v-if="!setting.schoolIsEdit" class="text-center">
                                        <label class="text-sm text-bold">@{{ student.school }}</label>
                                        <a @click="hideField('school');" href="#" class="pull-right">
                                            <span class="fa fa-edit"></span>
                                        </a>
                                    </td>
                                    <td v-else>
                                        <div class="input-group">
                                            <select v-model="field" class="form-control input-sm">
                                                <option value="">Select school</option>
                                            </select>
                                            <span class="input-group-btn">
                                                <button @click="updateField('school', field); setting.schoolIsEdit = false;" class="btn btn-primary btn-flat btn-sm">Update</button>
                                            </span>
                                            <span class="input-group-btn">
                                                <button @click="setting.schoolIsEdit = false;" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-sm">Course</td>
                                    <td v-if="!setting.courseIsEdit" class="text-center">
                                        <label class="text-sm text-bold">@{{ student.course }}</label>
                                        <a @click="hideField('course');" href="#" class="pull-right">
                                            <span class="fa fa-edit"></span>
                                        </a>
                                    </td>
                                    <td v-else>
                                        <div class="input-group">
                                            <input v-model="field" type="text" class="form-control input-sm">
                                            <span class="input-group-btn">
                                                <button @click="updateField('course', field); setting.courseIsEdit = false;" class="btn btn-primary btn-flat btn-sm">Update</button>
                                            </span>
                                            <span class="input-group-btn">
                                                <button @click="setting.courseIsEdit = false;" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-sm">Skype ID</td>
                                    <td v-if="!setting.skypeIdIsEdit" class="text-center">
                                        <label class="text-sm text-bold">@{{ student.skype_id }}</label>
                                        <a @click="hideField('skypeId');" href="#" class="pull-right">
                                            <span class="fa fa-edit"></span>
                                        </a>
                                    </td>
                                    <td v-else>
                                        <div class="input-group">
                                            <input v-model="field" type="text" class="form-control input-sm">
                                            <span class="input-group-btn">
                                                <button @click="updateField('skype_id', field); setting.skypeIdIsEdit = false;" class="btn btn-primary btn-flat btn-sm">Update</button>
                                            </span>
                                            <span class="input-group-btn">
                                                <button @click="setting.skypeIdIsEdit = false;" class="btn btn-danger btn-flat btn-sm">Cancel</button>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

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
                setting: {
                    firstNameIsEdit: false,
                    middleNameIsEdit: false,
                    lastNameIsEdit: false,
                    birthDateIsEdit: false,
                    genderIsEdit: false,
                    addressIsEdit: false,
                    homeNumberIsEdit: false,
                    mobileNumberIsEdit: false,
                    schoolIsEdit: false,
                    courseIsEdit: false,
                    skypeIdIsEdit: false
                },
                father: {
                    firstNameIsEdit: false,
                    middleNameIsEdit: false,
                    lastNameIsEdit: false,
                    occupationIsEdit: false,
                    companyIsEdit: false,
                    contactNumberIsEdit: false
                },
                mother: {
                    firstNameIsEdit: false,
                    middleNameIsEdit: false,
                    lastNameIsEdit: false,
                    occupationIsEdit: false,
                    companyIsEdit: false,
                    contactNumberIsEdit: false
                },
                primary: {
                    schoolNameIsEdit: false,
                    addressIsEdit: false,
                    graduatedIsEdit: false
                },
                secondary: {
                    schoolNameIsEdit: false,
                    addressIsEdit: false,
                    graduatedIsEdit: false
                },
                tertiary: {
                    schoolNameIsEdit: false,
                    addressIsEdit: false,
                    degreeIsEdit: false,
                    graduatedIsEdit: false
                },
                field: '',
                loading: false,
                file: ''
            },
            mounted: function() {
                this.loadStudentDetails();
                this.loadEvents();
            },
            filters: {
                avatar: function (value) {
                    if (!value) {
                        return 'https://placeimg.com/150/150/any'
                    } else {
                        return `/storage/${value}`
                    }
                }
            },
            methods: {
                handleFileUpload () {
                    this.file = this.$refs.file.files[0];
                },
                loadStudentDetails() {
                    axios.get(`/stud/view?id=${this.user_id}`)
                        .then((response) => {
                            this.student = response.data.data;
                            this.program_id = response.data.data.program_id;
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
                updateField(field, input) {
                    this.loading = true;
                    let formData = new FormData();
                    formData.append('field', input);
                    axios.post(`/coor/update/${field}/${this.student.user_id}`, formData)
                        .then((response) => {
                            this.loading = false;
                            this.field = '';
                            this.loadStudentDetails();
                            swal({
                                title: `${field} Updated!`,
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
                updateFather(field, input) {
                    this.loading = true;
                    let formData = new FormData();
                    formData.append('field', input);
                    axios.post(`/father/${field}/${this.student.father.id}/update`, formData)
                        .then((response) => {
                            this.loading = false;
                            this.field = '';
                            this.loadStudentDetails();
                            swal({
                                title: response.data.message,
                                type: 'success',
                                confirmButtonText: 'Continue'
                            });
                        }).catch((error) => {
                            this.loading = false;
                            swal({
                                title: 'Something went wrong',
                                type: 'error',
                                confirmButtonText: 'Go Back'
                            })
                    })
                },
                updateMother(field, input) {
                    this.loading = true;
                    let formData = new FormData();
                    formData.append('field', input);
                    axios.post(`/mother/${field}/${this.student.mother.id}/update`, formData)
                        .then((response) => {
                            this.loading = false;
                            this.field = '';
                            this.loadStudentDetails();
                            swal({
                                title: response.data.message,
                                type: 'success',
                                confirmButtonText: 'Continue'
                            });
                        }).catch((error) => {
                        this.loading = false;
                        swal({
                            title: 'Something went wrong',
                            type: 'error',
                            confirmButtonText: 'Go Back'
                        })
                    })
                },
                updatePrimary(field, input) {
                    this.loading = true;
                    let formData = new FormData();
                    formData.append('field', input);
                    axios.post(`/primary/${field}/${this.student.primary.id}/update`, formData)
                        .then((response) => {
                            this.loading = false;
                            this.field = '';
                            this.loadStudentDetails();
                            swal({
                                title: response.data.message,
                                type: 'success',
                                confirmButtonText: 'Continue'
                            });
                        }).catch((error) => {
                            this.loading = false;
                            swal({
                                title: 'Something went wrong',
                                type: 'error',
                                confirmButtonText: 'Go Back'
                            })
                    })
                },
                updateSecondary(field, input) {
                    this.loading = true;
                    let formData = new FormData();
                    formData.append('field', input);
                    axios.post(`/secondary/${field}/${this.student.secondary.id}/update`, formData)
                        .then((response) => {
                            this.loading = false;
                            this.field = '';
                            this.loadStudentDetails();
                            swal({
                                title: response.data.message,
                                type: 'success',
                                confirmButtonText: 'Continue'
                            });
                        }).catch((error) => {
                        this.loading = false;
                        swal({
                            title: 'Something went wrong',
                            type: 'error',
                            confirmButtonText: 'Go Back'
                        })
                    })
                },
                updateTertiary(field, input) {
                    this.loading = true;
                    let formData = new FormData();
                    formData.append('field', input);
                    axios.post(`/tertiary/${field}/${this.student.tertiary.id}/update`, formData)
                        .then((response) => {
                            this.loading = false;
                            this.field = '';
                            this.loadStudentDetails();
                            swal({
                                title: response.data.message,
                                type: 'success',
                                confirmButtonText: 'Continue'
                            });
                        }).catch((error) => {
                        this.loading = false;
                        swal({
                            title: 'Something went wrong',
                            type: 'error',
                            confirmButtonText: 'Go Back'
                        })
                    })
                },
                hideField(field) {
                    switch (field) {
                        case 'firstName':
                            this.setting.firstNameIsEdit = true;
                            this.setting.middleNameIsEdit = false;
                            this.setting.lastNameIsEdit = false;
                            this.setting.birthDateIsEdit = false;
                            this.setting.genderIsEdit = false;
                            this.setting.addressIsEdit = false;
                            this.setting.homeNumberIsEdit = false;
                            this.setting.mobileNumberIsEdit = false;
                            this.setting.schoolIsEdit = false;
                            this.setting.courseIsEdit = false;
                            this.setting.skypeIdIsEdit = false;
                            break;
                        case 'middleName':
                            this.setting.firstNameIsEdit = false;
                            this.setting.middleNameIsEdit = true;
                            this.setting.lastNameIsEdit = false;
                            this.setting.birthDateIsEdit = false;
                            this.setting.genderIsEdit = false;
                            this.setting.addressIsEdit = false;
                            this.setting.homeNumberIsEdit = false;
                            this.setting.mobileNumberIsEdit = false;
                            this.setting.schoolIsEdit = false;
                            this.setting.courseIsEdit = false;
                            this.setting.skypeIdIsEdit = false;
                            break;
                        case 'lastName':
                            this.setting.firstNameIsEdit = false;
                            this.setting.middleNameIsEdit = false;
                            this.setting.lastNameIsEdit = true;
                            this.setting.birthDateIsEdit = false;
                            this.setting.genderIsEdit = false;
                            this.setting.addressIsEdit = false;
                            this.setting.homeNumberIsEdit = false;
                            this.setting.mobileNumberIsEdit = false;
                            this.setting.schoolIsEdit = false;
                            this.setting.courseIsEdit = false;
                            this.setting.skypeIdIsEdit = false;
                            break;
                        case 'birthdate':
                            this.setting.firstNameIsEdit = false;
                            this.setting.middleNameIsEdit = false;
                            this.setting.lastNameIsEdit = false;
                            this.setting.birthDateIsEdit = true;
                            this.setting.genderIsEdit = false;
                            this.setting.addressIsEdit = false;
                            this.setting.homeNumberIsEdit = false;
                            this.setting.mobileNumberIsEdit = false;
                            this.setting.schoolIsEdit = false;
                            this.setting.courseIsEdit = false;
                            this.setting.skypeIdIsEdit = false;
                            break;
                        case 'gender':
                            this.setting.firstNameIsEdit = false;
                            this.setting.middleNameIsEdit = false;
                            this.setting.lastNameIsEdit = false;
                            this.setting.birthDateIsEdit = false;
                            this.setting.genderIsEdit = true;
                            this.setting.addressIsEdit = false;
                            this.setting.homeNumberIsEdit = false;
                            this.setting.mobileNumberIsEdit = false;
                            this.setting.schoolIsEdit = false;
                            this.setting.courseIsEdit = false;
                            this.setting.skypeIdIsEdit = false;
                            break;
                        case 'address':
                            this.setting.firstNameIsEdit = false;
                            this.setting.middleNameIsEdit = false;
                            this.setting.lastNameIsEdit = false;
                            this.setting.birthDateIsEdit = false;
                            this.setting.genderIsEdit = false;
                            this.setting.addressIsEdit = true;
                            this.setting.homeNumberIsEdit = false;
                            this.setting.mobileNumberIsEdit = false;
                            this.setting.schoolIsEdit = false;
                            this.setting.courseIsEdit = false;
                            this.setting.skypeIdIsEdit = false;
                            break;
                        case 'homeNumber':
                            this.setting.firstNameIsEdit = false;
                            this.setting.middleNameIsEdit = false;
                            this.setting.lastNameIsEdit = false;
                            this.setting.birthDateIsEdit = false;
                            this.setting.genderIsEdit = false;
                            this.setting.addressIsEdit = false;
                            this.setting.homeNumberIsEdit = true;
                            this.setting.mobileNumberIsEdit = false;
                            this.setting.schoolIsEdit = false;
                            this.setting.courseIsEdit = false;
                            this.setting.skypeIdIsEdit = false;
                            break;
                        case 'mobileNumber':
                            this.setting.firstNameIsEdit = false;
                            this.setting.middleNameIsEdit = false;
                            this.setting.lastNameIsEdit = false;
                            this.setting.birthDateIsEdit = false;
                            this.setting.genderIsEdit = false;
                            this.setting.addressIsEdit = false;
                            this.setting.homeNumberIsEdit = false;
                            this.setting.mobileNumberIsEdit = true;
                            this.setting.schoolIsEdit = false;
                            this.setting.courseIsEdit = false;
                            this.setting.skypeIdIsEdit = false;
                            break;
                        case 'school':
                            this.setting.firstNameIsEdit = false;
                            this.setting.middleNameIsEdit = false;
                            this.setting.lastNameIsEdit = false;
                            this.setting.birthDateIsEdit = false;
                            this.setting.genderIsEdit = false;
                            this.setting.addressIsEdit = false;
                            this.setting.homeNumberIsEdit = false;
                            this.setting.mobileNumberIsEdit = false;
                            this.setting.schoolIsEdit = true;
                            this.setting.courseIsEdit = false;
                            this.setting.skypeIdIsEdit = false;
                            break;
                        case 'course':
                            this.setting.firstNameIsEdit = false;
                            this.setting.middleNameIsEdit = false;
                            this.setting.lastNameIsEdit = false;
                            this.setting.birthDateIsEdit = false;
                            this.setting.genderIsEdit = false;
                            this.setting.addressIsEdit = false;
                            this.setting.homeNumberIsEdit = false;
                            this.setting.mobileNumberIsEdit = false;
                            this.setting.schoolIsEdit = false;
                            this.setting.courseIsEdit = true;
                            this.setting.skypeIdIsEdit = false;
                            break;
                        case 'skypeId':
                            this.setting.firstNameIsEdit = false;
                            this.setting.middleNameIsEdit = false;
                            this.setting.lastNameIsEdit = false;
                            this.setting.birthDateIsEdit = false;
                            this.setting.genderIsEdit = false;
                            this.setting.addressIsEdit = false;
                            this.setting.homeNumberIsEdit = false;
                            this.setting.mobileNumberIsEdit = false;
                            this.setting.schoolIsEdit = false;
                            this.setting.courseIsEdit = false;
                            this.setting.skypeIdIsEdit = true;
                            break;
                        case 'fatherFirstName':
                            this.father.firstNameIsEdit = true;
                            this.father.middleNameIsEdit = false;
                            this.father.lastNameIsEdit = false;
                            this.father.occupationIsEdit = false;
                            this.father.companyIsEdit = false;
                            this.father.contactNumberIsEdit = false;
                            break;
                        case 'fatherMiddleName':
                            this.father.firstNameIsEdit = false;
                            this.father.middleNameIsEdit = true;
                            this.father.lastNameIsEdit = false;
                            this.father.occupationIsEdit = false;
                            this.father.companyIsEdit = false;
                            this.father.contactNumberIsEdit = false;
                            break;
                        case 'fatherLastName':
                            this.father.firstNameIsEdit = false;
                            this.father.middleNameIsEdit = false;
                            this.father.lastNameIsEdit = true;
                            this.father.occupationIsEdit = false;
                            this.father.companyIsEdit = false;
                            this.father.contactNumberIsEdit = false;
                            break;
                        case 'fatherOccupation':
                            this.father.firstNameIsEdit = false;
                            this.father.middleNameIsEdit = false;
                            this.father.lastNameIsEdit = false;
                            this.father.occupationIsEdit = true;
                            this.father.companyIsEdit = false;
                            this.father.contactNumberIsEdit = false;
                            break;
                        case 'fatherCompany':
                            this.father.firstNameIsEdit = false;
                            this.father.middleNameIsEdit = false;
                            this.father.lastNameIsEdit = false;
                            this.father.occupationIsEdit = false;
                            this.father.companyIsEdit = true;
                            this.father.contactNumberIsEdit = false;
                            break;
                        case 'fatherContactNumber':
                            this.father.firstNameIsEdit = false;
                            this.father.middleNameIsEdit = false;
                            this.father.lastNameIsEdit = false;
                            this.father.occupationIsEdit = false;
                            this.father.companyIsEdit = false;
                            this.father.contactNumberIsEdit = true;
                            break;
                        case 'motherFirstName':
                            this.mother.firstNameIsEdit = true;
                            this.mother.middleNameIsEdit = false;
                            this.mother.lastNameIsEdit = false;
                            this.mother.occupationIsEdit = false;
                            this.mother.companyIsEdit = false;
                            this.mother.graduatedIsEdit = false;
                            break;
                        case 'motherMiddleName':
                            this.mother.firstNameIsEdit = false;
                            this.mother.middleNameIsEdit = true;
                            this.mother.lastNameIsEdit = false;
                            this.mother.occupationIsEdit = false;
                            this.mother.companyIsEdit = false;
                            this.mother.graduatedIsEdit = false;
                            break;
                        case 'motherLastName':
                            this.mother.firstNameIsEdit = false;
                            this.mother.middleNameIsEdit = false;
                            this.mother.lastNameIsEdit = true;
                            this.mother.occupationIsEdit = false;
                            this.mother.companyIsEdit = false;
                            this.mother.graduatedIsEdit = false;
                            break;
                        case 'motherOccupation':
                            this.mother.firstNameIsEdit = false;
                            this.mother.middleNameIsEdit = false;
                            this.mother.lastNameIsEdit = false;
                            this.mother.occupationIsEdit = true;
                            this.mother.companyIsEdit = false;
                            this.mother.contactNumberIsEdit = false;
                            break;
                        case 'motherCompany':
                            this.mother.firstNameIsEdit = false;
                            this.mother.middleNameIsEdit = false;
                            this.mother.lastNameIsEdit = false;
                            this.mother.occupationIsEdit = false;
                            this.mother.companyIsEdit = true;
                            this.mother.graduatedIsEdit = false;
                            break;
                        case 'motherContactNumber':
                            this.mother.firstNameIsEdit = false;
                            this.mother.middleNameIsEdit = false;
                            this.mother.lastNameIsEdit = false;
                            this.mother.occupationIsEdit = false;
                            this.mother.companyIsEdit = false;
                            this.mother.contactNumberIsEdit = true;
                            break;
                        case 'primarySchoolName':
                            this.primary.schoolNameIsEdit = true;
                            this.primary.addressIsEdit = false;
                            this.primary.graduatedIsEdit = false;
                            break;
                        case 'primaryAddress':
                            this.primary.schoolNameIsEdit = false;
                            this.primary.addressIsEdit = true;
                            this.primary.graduatedIsEdit = false;
                            break;
                        case 'primaryGraduated':
                            this.primary.schoolNameIsEdit = false;
                            this.primary.addressIsEdit = false;
                            this.primary.graduatedIsEdit = true;
                            break;
                        case 'secondarySchoolName':
                            this.secondary.schoolNameIsEdit = true;
                            this.secondary.addressIsEdit = false;
                            this.secondary.graduatedIsEdit = false;
                            break;
                        case 'secondaryAddress':
                            this.secondary.schoolNameIsEdit = false;
                            this.secondary.addressIsEdit = true;
                            this.secondary.graduatedIsEdit = false;
                            break;
                        case 'secondaryGraduated':
                            this.secondary.schoolNameIsEdit = false;
                            this.secondary.addressIsEdit = false;
                            this.secondary.graduatedIsEdit = true;
                            break;
                        case 'tertiarySchoolName':
                            this.tertiary.schoolNameIsEdit = true;
                            this.tertiary.addressIsEdit = false;
                            this.tertiary.degreeIsEdit = false;
                            this.tertiary.graduatedIsEdit = false;
                            break;
                        case 'tertiaryAddress':
                            this.tertiary.schoolNameIsEdit = false;
                            this.tertiary.addressIsEdit = true;
                            this.tertiary.degreeIsEdit = false;
                            this.tertiary.graduatedIsEdit = false;
                            break;
                        case 'tertiaryDegree':
                            this.tertiary.schoolNameIsEdit = false;
                            this.tertiary.addressIsEdit = false;
                            this.tertiary.degreeIsEdit = true;
                            this.tertiary.graduatedIsEdit = false;
                            break;
                        case 'tertiaryGraduated':
                            this.tertiary.schoolNameIsEdit = false;
                            this.tertiary.addressIsEdit = false;
                            this.tertiary.degreeIsEdit = false;
                            this.tertiary.graduatedIsEdit = true;
                            break;
                    }
                }
            }
        });
    </script>
@endsection
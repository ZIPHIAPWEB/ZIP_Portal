@extends('layouts.app')

@section('title', 'Program Status')

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
                        <li class="list-group-item">
                            <b>Program ID</b>
                            <a class="pull-right text-green text-sm">@{{ student.application_id }}</a>
                        </li>
                        <li class="list-group-item" v-if="student.application_status != 'New Applicant' || student.application_status != 'Assessed'">
                            <b>Program Coordinator</b>
                            <a class="pull-right text-green text-sm">@{{ student.coordinator.firstName }} @{{ student.coordinator.lastName }}</a>
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
                        <a href="#host" data-toggle="tab" aria-expanded="true">
                            <span class="fa fa-user"></span>
                            <label for="" class="control-label">Host Company Details</label>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="host" class="tab-pane active">
                        <table class="table table-striped table-bordered table-condensed">
                            <tbody>
                                <tr>
                                    <td style="width: 35%;">Visa Sponsor</td>
                                    <td class="text-bold">
                                        @{{ student.sponsor.display_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Host Company</td>
                                    <td class="text-bold">
                                        @{{ student.company.name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Housing Address</td>
                                    <td class="text-bold">
                                        @{{ student.housing_details }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Position</td>
                                    <td class="text-bold">
                                        @{{ student.position }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Stipend</td>
                                    <td class="text-bold">
                                        @{{ student.stipend }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Start Date</td>
                                    <td class="text-bold">
                                        @{{ student.program_start_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>End Date</td>
                                    <td class="text-bold">
                                        @{{ student.program_end_date }}
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
                        <a href="#program-status" data-toggle="tab" aria-expanded="true">
                            <span class="fa fa-building"></span>
                            <label for="" class="control-label">Visa Interview Details</label>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="program-status" class="tab-pane active">
                        <table class="table table-striped table-bordered table-condensed">
                            <tbody>
                                <tr>
                                    <td style="width: 35%;">Program ID Number</td>
                                    <td class="text-bold">
                                        @{{ student.program_id_no }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>SEVIS ID</td>
                                    <td class="text-bold">
                                        @{{ student.sevis_id }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Interview Schedule</td>
                                    <td class="text-bold">
                                        @{{ student.visa_interview_schedule }}
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
                        <a href="#flight" data-toggle="tab" aria-expanded="true">
                            <span class="fa fa-plane"></span>
                            <label for="" class="control-label">Flight Details</label>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="flight" class="tab-pane active">
                        <table class="table table-striped table-bordered table-condensed">
                            <tbody>
                            <tr>
                                <td class="text-bold" colspan="2">Departure From MANILA</td>
                            </tr>
                            <tr>
                                <td style="width: 35%;">Date</td>
                                <td class="text-bold">
                                    @{{ student.us_departure_date }}
                                </td>
                            </tr>
                            <tr>
                                <td>Time</td>
                                <td class="text-bold">
                                    @{{ student.us_departure_time }}
                                </td>
                            </tr>
                            <tr>
                                <td>Flight No.</td>
                                <td class="text-bold">
                                    @{{ student.us_departure_flight_no }}
                                </td>
                            </tr>
                            <tr>
                                <td>Airline</td>
                                <td class="text-bold">
                                    @{{ student.us_departure_airline }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <table class="table table-striped table-bordered table-condensed">
                            <tbody>
                                <tr>
                                    <td class="text-bold" colspan="2">Arrival To US</td>
                                </tr>
                                <tr>
                                    <td style="width: 35%;">Date</td>
                                    <td class="text-bold">
                                        @{{ student.us_arrival_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Time</td>
                                    <td class="text-bold">
                                        @{{ student.us_arrival_time }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Flight No.</td>
                                    <td class="text-bold">
                                        @{{ student.us_arrival_flight_no }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Airline</td>
                                    <td class="text-bold">
                                        @{{ student.us_arrival_airline }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-striped table-bordered table-condensed">
                            <tbody>
                            <tr>
                                <td class="text-bold" colspan="2">Departure From US</td>
                            </tr>
                            <tr>
                                <td style="width: 35%;">Date</td>
                                <td class="text-bold">
                                    @{{ student.mnl_departure_date }}
                                </td>
                            </tr>
                            <tr>
                                <td>Time</td>
                                <td class="text-bold">
                                    @{{ student.mnl_departure_time }}
                                </td>
                            </tr>
                            <tr>
                                <td>Flight No.</td>
                                <td class="text-bold">
                                    @{{ student.mnl_departure_flight_no }}
                                </td>
                            </tr>
                            <tr>
                                <td>Airline</td>
                                <td class="text-bold">
                                    @{{ student.mnl_departure_airline }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <table class="table table-striped table-bordered table-condensed">
                            <tbody>
                            <tr>
                                <td class="text-bold" colspan="2">Arrival To MANILA</td>
                            </tr>
                            <tr>
                                <td style="width: 35%;">Date</td>
                                <td class="text-bold">
                                    @{{ student.mnl_arrival_date }}
                                </td>
                            </tr>
                            <tr>
                                <td>Time</td>
                                <td class="text-bold">
                                    @{{ student.mnl_arrival_time }}
                                </td>
                            </tr>
                            <tr>
                                <td>Flight No.</td>
                                <td class="text-bold">
                                    @{{ student.mnl_arrival_flight_no }}
                                </td>
                            </tr>
                            <tr>
                                <td>Airline</td>
                                <td class="text-bold">
                                    @{{ student.mnl_arrival_airline }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const app = new Vue({
            el: '#app',
            data: {
                student: [],
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
                    }
                }
            }
        });
    </script>
@endsection
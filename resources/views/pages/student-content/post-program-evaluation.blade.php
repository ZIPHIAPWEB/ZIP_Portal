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
                            <b>Application Status</b>
                            <a class="pull-right text-green text-sm">@{{ student.application_status }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Program Coordinator</b>
                            <a class="pull-right text-green text-sm"></a>
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
                        <a href="#program-satisfaction" data-toggle="tab" aria-expanded="true">
                            <span class="fa fa-user"></span>
                            <label for="" class="control-label">Program Satisfaction</label>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="program-satisfaction" class="tab-pane active">
                        <table class="table table-striped table-bordered table-condensed">
                            <tbody>
                                <tr>
                                    <td style="width: 80%;">Meeting the program expectation & objectives</td>
                                    <td class="text-bold text-center">
                                        <select name="" id="" class="form-control input-sm">
                                            <option value="">Select rating</option>
                                            <option value="5">5 - Very Satisfied</option>
                                            <option value="4">4 - Satisfied</option>
                                            <option value="3">3 - Neutral</option>
                                            <option value="2">2 - Dissatisfied</option>
                                            <option value="1">1 - Very Dissatisfied</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Impact of this program on your career development/growth</td>
                                    <td class="text-bold text-center">
                                        <select name="" id="" class="form-control input-sm">
                                            <option value="">Select rating</option>
                                            <option value="5">5 - Very Satisfied</option>
                                            <option value="4">4 - Satisfied</option>
                                            <option value="3">3 - Neutral</option>
                                            <option value="2">2 - Dissatisfied</option>
                                            <option value="1">1 - Very Dissatisfied</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Contribution to your personal growth</td>
                                    <td class="text-bold text-center">
                                        <select name="" id="" class="form-control input-sm">
                                            <option value="">Select rating</option>
                                            <option value="5">5 - Very Satisfied</option>
                                            <option value="4">4 - Satisfied</option>
                                            <option value="3">3 - Neutral</option>
                                            <option value="2">2 - Dissatisfied</option>
                                            <option value="1">1 - Very Dissatisfied</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Understanding about American culture and its workplace</td>
                                    <td class="text-bold text-center">
                                        <select name="" id="" class="form-control input-sm">
                                            <option value="">Select rating</option>
                                            <option value="5">5 - Very Satisfied</option>
                                            <option value="4">4 - Satisfied</option>
                                            <option value="3">3 - Neutral</option>
                                            <option value="2">2 - Dissatisfied</option>
                                            <option value="1">1 - Very Dissatisfied</option>
                                        </select>
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
                            <label for="" class="control-label">Visa Sponsor</label>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="program-status" class="tab-pane active">
                        <table class="table table-striped table-bordered table-condensed">
                            <tbody>
                                <tr>
                                    <td style="width: 80%;">Assistance given by the visa sponsor in terms of your housing</td>
                                    <td class="text-bold text-center">
                                        <select name="" id="" class="form-control input-sm">
                                            <option value="">Select rating</option>
                                            <option value="5">5 - Very Satisfied</option>
                                            <option value="4">4 - Satisfied</option>
                                            <option value="3">3 - Neutral</option>
                                            <option value="2">2 - Dissatisfied</option>
                                            <option value="1">1 - Very Dissatisfied</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Assistance provided by your visa sponsor in terms of work related issue</td>
                                    <td class="text-bold text-center">
                                        <select name="" id="" class="form-control input-sm">
                                            <option value="">Select rating</option>
                                            <option value="5">5 - Very Satisfied</option>
                                            <option value="4">4 - Satisfied</option>
                                            <option value="3">3 - Neutral</option>
                                            <option value="2">2 - Dissatisfied</option>
                                            <option value="1">1 - Very Dissatisfied</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Communication through emails and other mediums</td>
                                    <td class="text-bold text-center">
                                        <select name="" id="" class="form-control input-sm">
                                            <option value="">Select rating</option>
                                            <option value="5">5 - Very Satisfied</option>
                                            <option value="4">4 - Satisfied</option>
                                            <option value="3">3 - Neutral</option>
                                            <option value="2">2 - Dissatisfied</option>
                                            <option value="1">1 - Very Dissatisfied</option>
                                        </select>
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
                            <label for="" class="control-label">Host Company</label>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="flight" class="tab-pane active">
                        <table class="table table-striped table-bordered table-condensed">
                            <tbody>
                                <tr>
                                    <td style="width: 80%;">Treatment by your managers/co-employees at work</td>
                                    <td class="text-bold text-center">
                                        <select name="" id="" class="form-control input-sm">
                                            <option value="">Select rating</option>
                                            <option value="5">5 - Very Satisfied</option>
                                            <option value="4">4 - Satisfied</option>
                                            <option value="3">3 - Neutral</option>
                                            <option value="2">2 - Dissatisfied</option>
                                            <option value="1">1 - Very Dissatisfied</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Quality of program/exposure provided</td>
                                    <td class="text-bold text-center">
                                        <select name="" id="" class="form-control input-sm">
                                            <option value="">Select rating</option>
                                            <option value="5">5 - Very Satisfied</option>
                                            <option value="4">4 - Satisfied</option>
                                            <option value="3">3 - Neutral</option>
                                            <option value="2">2 - Dissatisfied</option>
                                            <option value="1">1 - Very Dissatisfied</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Relevance of your position to your field of study</td>
                                    <td class="text-bold text-center">
                                        <select name="" id="" class="form-control input-sm">
                                            <option value="">Select rating</option>
                                            <option value="5">5 - Very Satisfied</option>
                                            <option value="4">4 - Satisfied</option>
                                            <option value="3">3 - Neutral</option>
                                            <option value="2">2 - Dissatisfied</option>
                                            <option value="1">1 - Very Dissatisfied</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Good Training venue for hospitality/business students from the Philippines</td>
                                    <td class="text-bold text-center">
                                        <select name="" id="" class="form-control input-sm">
                                            <option value="">Select rating</option>
                                            <option value="5">5 - Very Satisfied</option>
                                            <option value="4">4 - Satisfied</option>
                                            <option value="3">3 - Neutral</option>
                                            <option value="2">2 - Dissatisfied</option>
                                            <option value="1">1 - Very Dissatisfied</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Assistance from you manager/HR in addressing your work related concerns</td>
                                    <td class="text-bold text-center">
                                        <select name="" id="" class="form-control input-sm">
                                            <option value="">Select rating</option>
                                            <option value="5">5 - Very Satisfied</option>
                                            <option value="4">4 - Satisfied</option>
                                            <option value="3">3 - Neutral</option>
                                            <option value="2">2 - Dissatisfied</option>
                                            <option value="1">1 - Very Dissatisfied</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Working hours bearing in mind that program is not a money-making program</td>
                                    <td class="text-bold text-center">
                                        <select name="" id="" class="form-control input-sm">
                                            <option value="">Select rating</option>
                                            <option value="5">5 - Very Satisfied</option>
                                            <option value="4">4 - Satisfied</option>
                                            <option value="3">3 - Neutral</option>
                                            <option value="2">2 - Dissatisfied</option>
                                            <option value="1">1 - Very Dissatisfied</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Working environment (Safe and friendly)</td>
                                    <td class="text-bold text-center">
                                        <select name="" id="" class="form-control input-sm">
                                            <option value="">Select rating</option>
                                            <option value="5">5 - Very Satisfied</option>
                                            <option value="4">4 - Satisfied</option>
                                            <option value="3">3 - Neutral</option>
                                            <option value="2">2 - Dissatisfied</option>
                                            <option value="1">1 - Very Dissatisfied</option>
                                        </select>
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
                            <label for="" class="control-label">Home Country Agency</label>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="flight" class="tab-pane active">
                        <table class="table table-striped table-bordered table-condensed">
                            <tbody>
                                <tr>
                                    <td style="width: 80%;">Program orientation and discussion</td>
                                    <td class="text-bold text-center">
                                        <select name="" id="" class="form-control input-sm">
                                            <option value="">Select rating</option>
                                            <option value="5">5 - Very Satisfied</option>
                                            <option value="4">4 - Satisfied</option>
                                            <option value="3">3 - Neutral</option>
                                            <option value="2">2 - Dissatisfied</option>
                                            <option value="1">1 - Very Dissatisfied</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Communication, organization and coordination in the application process from registration, visa processing, departure and arrival</td>
                                    <td class="text-bold text-center">
                                        <select name="" id="" class="form-control input-sm">
                                            <option value="">Select rating</option>
                                            <option value="5">5 - Very Satisfied</option>
                                            <option value="4">4 - Satisfied</option>
                                            <option value="3">3 - Neutral</option>
                                            <option value="2">2 - Dissatisfied</option>
                                            <option value="1">1 - Very Dissatisfied</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Assistance/monitoring provided by your respective program coordinator or officers of ZIP Travel throughout your program</td>
                                    <td class="text-bold text-center">
                                        <select name="" id="" class="form-control input-sm">
                                            <option value="">Select rating</option>
                                            <option value="5">5 - Very Satisfied</option>
                                            <option value="4">4 - Satisfied</option>
                                            <option value="3">3 - Neutral</option>
                                            <option value="2">2 - Dissatisfied</option>
                                            <option value="1">1 - Very Dissatisfied</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Quality of service</td>
                                    <td class="text-bold text-center">
                                        <select name="" id="" class="form-control input-sm">
                                            <option value="">Select rating</option>
                                            <option value="5">5 - Very Satisfied</option>
                                            <option value="4">4 - Satisfied</option>
                                            <option value="3">3 - Neutral</option>
                                            <option value="2">2 - Dissatisfied</option>
                                            <option value="1">1 - Very Dissatisfied</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Overall Work Performance</td>
                                    <td class="text-bold text-center">
                                        <select name="" id="" class="form-control input-sm">
                                            <option value="">Select rating</option>
                                            <option value="5">5 - Very Satisfied</option>
                                            <option value="4">4 - Satisfied</option>
                                            <option value="3">3 - Neutral</option>
                                            <option value="2">2 - Dissatisfied</option>
                                            <option value="1">1 - Very Dissatisfied</option>
                                        </select>
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
                            <label for="" class="control-label">Housing</label>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="flight" class="tab-pane active">
                        <table class="table table-striped table-bordered table-condensed">
                            <tbody>
                                <tr>
                                    <td style="width: 80%;">Safety and Security</td>
                                    <td class="text-bold text-center">
                                        <select name="" id="" class="form-control input-sm">
                                            <option value="">Select rating</option>
                                            <option value="5">5 - Very Satisfied</option>
                                            <option value="4">4 - Satisfied</option>
                                            <option value="3">3 - Neutral</option>
                                            <option value="2">2 - Dissatisfied</option>
                                            <option value="1">1 - Very Dissatisfied</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Accessibility (from-to work, nearby commons)</td>
                                    <td class="text-bold text-center">
                                        <select name="" id="" class="form-control input-sm">
                                            <option value="">Select rating</option>
                                            <option value="5">5 - Very Satisfied</option>
                                            <option value="4">4 - Satisfied</option>
                                            <option value="3">3 - Neutral</option>
                                            <option value="2">2 - Dissatisfied</option>
                                            <option value="1">1 - Very Dissatisfied</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Cost (considering the location and type of housing</td>
                                    <td class="text-bold text-center">
                                        <select name="" id="" class="form-control input-sm">
                                            <option value="">Select rating</option>
                                            <option value="5">5 - Very Satisfied</option>
                                            <option value="4">4 - Satisfied</option>
                                            <option value="3">3 - Neutral</option>
                                            <option value="2">2 - Dissatisfied</option>
                                            <option value="1">1 - Very Dissatisfied</option>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary btn-flat btn-block">Submit</button>
        </div>
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
                field: '',
                loading: false,
                file: ''
            },
            mounted: function() {
                this.loadStudentDetails();
                this.loadEvents();
                setTimeout(() => {
                    this.loadBasicRequirements(this.student.program_id);
                    this.loadPaymentRequirements(this.student.program_id);
                    this.loadVisaRequirements(this.student.visa_sponsor_id);
                }, 1000);
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
                    axios.get(`/stud/view/${this.user_id}`)
                        .then((response) => {
                            this.student = response.data.data;
                            this.program_id = response.data.data.program_id;
                        }).catch((error) => {
                        console.log(error);
                    })
                },
                loadBasicRequirements(programId) {
                    axios.get(`/stud/requirement/basic/${programId}`)
                        .then((response) => {
                            this.basicRequirements = response.data;
                        }).catch((error) => {
                        console.log(error);
                    });
                },
                loadPaymentRequirements(programId) {
                    axios.get(`/stud/requirement/payment/${programId}`)
                        .then((response) => {
                            this.paymentRequirements = response.data;
                        }).catch((error) => {
                        console.log(error);
                    });
                },
                loadVisaRequirements(sponsorId) {
                    axios.get(`/stud/requirement/visa/${sponsorId}`)
                        .then((response) => {
                            this.visaRequirements = response.data;
                        }).catch((error) => {
                        console.log(error);
                    });
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
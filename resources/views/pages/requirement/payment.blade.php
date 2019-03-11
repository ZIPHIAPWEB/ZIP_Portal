@extends('layouts.app')

@section('title', 'Payment Requirement')

@section('sidenav')
    <li class="header">General</li>
    <li>
        <a href="{{ route('dash.student') }}">
            <i class="fa fa-user"></i> <span><small>My Profile</small></span>
        </a>
    </li>
    <li class="header">My Requirements</li>
    <li>
        <a href="{{ route('req.basic') }}">
            <i class="fa fa-book"></i>
            <span><small>Basic Requirements</small></span>
        </a>
    </li>
    <li class="active">
        <a href="{{ route('req.payment') }}">
            <i class="fa fa-dollar"></i>
            <span><small>Payment Requirements</small></span>
        </a>
    </li>
    @if (\App\Student::where('user_id', Auth::user()->id)->first()->visa_sponsor_id)
        <li class="active">
            <a href="{{ route('req.visa') }}">
                <i class="fa fa-plane"></i>
                <span><small>Visa Requirements</small></span>
            </a>
        </li>
    @endif
@endsection

@section('content')
    <div id="app">
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <a href="javascript:void(0)" @click="selectPhoto()">
                        <img class="profile-user-img img-responsive img-circle" :src="student.profile_picture | avatar" alt="User profile picture"/>
                    </a>
                    <h3 class="profile-username text-center">@{{ student.first_name }}&nbsp; @{{ student.last_name }}</h3>
                    <p class="text-muted text-center">@{{ student.program }}</p>
                    <ul class="list-group list-group-unbordered">
                        @if(!DB::table('students')->where('user_id', Auth::user()->id)->first()->application_status == 'New Applicant' || DB::table('students')->where('user_id', Auth::user()->id)->first()->application_status == 'Assessed')
                            <li class="list-group-item">
                                <b>Program ID</b>
                                <a class="pull-right text-green text-sm">@{{ student.application_id }}</a>
                            </li>
                            <li class="list-group-item" v-if="student.application_status != 'New Applicant' || student.application_status != 'Assessed'">
                                <b>Program Coordinator</b>
                                <a class="pull-right text-green text-sm">@{{ student.coordinator.firstName }} @{{ student.coordinator.lastName }}</a>
                            </li>
                        @endif()
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
        <div class="col-xs-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#payment" data-toggle="tab" aria-expanded="true">
                            <span class="fa fa-user"></span>
                            <label for="" class="control-label">Payment Requirements</label>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="payment" class="tab-pane active">
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <th>Requirements</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </thead>
                            <tbody v-if="hasRecords">
                                <tr v-if="loading.table">
                                    <td valign="top" colspan="15" class="text-center">
                                        <span class="fa fa-circle-o-notch fa-spin"></span>
                                    </td>
                                </tr>
                                <tr v-else v-for="requirement in requirements">
                                    <td>@{{ requirement.name }}</td>
                                    <td class="text-center">
                                        <span v-if="requirement.student_payment.status" class="fa fa-check" style="color: green;"></span>
                                        <span v-else class="fa fa-remove" style="color: red"></span>
                                    </td>
                                    <td class="text-center" v-cloak>
                                        <button v-if="requirement.student_payment.status" @click="openInNewTab(requirement)" class="btn btn-warning btn-flat btn-xs"><span class="glyphicon glyphicon-eye-open"></span> View</button>
                                        <button v-if="!requirement.student_payment.status" @click="selectFile(requirement)" class="btn btn-default btn-flat btn-xs"><span class="glyphicon glyphicon-upload"></span> Upload File</button>
                                        <button v-else @click="removeFile(requirement)" class="btn btn-danger btn-flat btn-xs"><span class="glyphicon glyphicon-trash"></span> Remove File</button>
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
                </div>
            </div>
        </div>

        <div class="modal fade" id="file-upload" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
            <form @submit.prevent="submitFile()" enctype="multipart/form-data">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="overlay-wrapper">
                            <div class="overlay" :style="{ display: loading.uploading ? 'block' : 'none' }">
                                <i class="fa fa-circle-o-notch fa-spin fa-2x"></i>
                            </div>
                        </div>
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Upload @{{ modalTitle }}</h4>
                        </div>
                        <div class="modal-body">
                            <input type="file" ref="file" @change="handleFileUpload()">
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary btn-flat btn-block">Upload File</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </form>
        </div><!-- /.modal -->
    </div>
@endsection

@section('script')
    <script>
        const app = new Vue({
            el: '#app',
            data: {
                student: [],
                requirements: [],
                modalTitle: '',
                pReqId: '',
                bReqId: '',
                file: '',
                user_id: '{{ Auth::user()->id }}',
                program_id: "{{ \App\Student::where('user_id', Auth::user()->id)->first()->program_id }}",
                loading: {
                    uploading: false,
                    table: false
                },
                hasRecords: true
            },
            mounted: function() {
                this.loadStudentDetails();
                this.loadEvents();
                this.loadRequirements(this.program_id);
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
                loadEvents() {
                    axios.get('/event/view')
                        .then((response) => {
                            this.events = response.data.data;
                        }).catch((error) => {
                        console.log(error);
                    })
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
                loadRequirements(programId) {
                    this.loading.table = true;
                    axios.get(`/payment/viewUserRequirement?program_id=${programId}&id=${this.user_id}`)
                        .then((response) => {
                            this.loading.table = false;
                            if (response.data.data.length > 0) {
                                this.hasRecords = true;
                                this.requirements = response.data.data;
                            } else {
                                this.hasRecords = false;
                            }
                        }).catch((error) => {
                            this.loading.table = false;
                            console.log(error);
                    })
                },
                selectFile(requirement) {
                    this.pReqId = requirement.id;
                    this.modalTitle = requirement.name;

                    console.log(requirement);
                    $('#file-upload').modal('show');
                },
                handleFileUpload() {
                    this.file = this.$refs.file.files[0];
                    console.log(this.file);
                },
                submitFile() {
                    this.loading.uploading = true;
                    let formData = new FormData();

                    formData.append('file', this.file);

                    axios.post(`/studPayment/store?requirement_id=${this.pReqId}`, formData, {
                        headers : {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                        .then((response) => {
                            this.loading.uploading = false;
                            this.loadRequirements(this.program_id);
                            $('#file-upload').modal('hide');
                            swal({
                                title: response.data.message,
                                type: 'success',
                                confirmButtonText: 'Continue'
                            })
                        }).catch((error) => {
                            this.loading = false;
                            swal({
                                title: 'An Error has occur!',
                                type: 'error',
                                confirmButtonText: 'Go Back'
                            })
                    })
                },
                removeFile(requirement) {
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
                openInNewTab(requirement) {
                    axios.get(`/studPayment/download?requirement_id=${requirement.student_payment.id}`)
                        .then((response) => {
                            win = window.open(response.data, '_blank');
                            win.focus();
                        })
                }
            }
        })
    </script>
@endsection
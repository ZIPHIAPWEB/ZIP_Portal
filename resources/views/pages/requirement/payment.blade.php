@extends('layouts.student-app')

@section('title', 'Payment Requirement')

@section('content')
    <div id="app" class="m-t-10" v-cloak>
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <a href="javascript:void(0)" @click="selectPhoto()">
                        <img class="profile-user-img img-responsive img-circle" :src="student.profile_picture | avatar" alt="User profile picture"/>
                    </a>
                    <h3 class="profile-username text-center">@{{ student.first_name }}&nbsp; @{{ student.last_name }}</h3>
                    <p class="text-muted text-center">@{{ student.program.name }}</p>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Program ID</b>
                            <a v-if="!student.application_id" class="pull-right text-green text-sm">No Program ID Assign</a>
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
                            <a data-toggle="collapse" href="#collapse1">Program Requirements</a>
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
            <!--
            <div class="panel-group m-b-5">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a href="{{ route('portal.chat-student') }}">Chat your Coordinator</a>
                        </h4>
                    </div>
                </div>
            </div>
            -->
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
                                        <button v-if="requirement.student_payment.status" @click="openInNewTab(requirement)" class="btn btn-warning btn-flat btn-xs"><span class="glyphicon glyphicon-eye-open"></span> View Uploaded File</button>
                                        <button v-if="!requirement.student_payment.status" @click="selectFile(requirement)" class="btn btn-default btn-flat btn-xs"><span class="glyphicon glyphicon-upload"></span> Upload File</button>
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
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="">Bank Code</label>
                                        <input v-model="payment.bank_code" type="text" class="form-control input-sm" >
                                        <span class="help-block text-red" v-if="errors.bank_code">Required</span>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="">Reference No.</label>
                                        <input v-model="payment.ref_no" type="text" class="form-control input-sm">
                                        <span class="help-block text-red" v-if="errors.referrence_no">Required</span>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="">Bank Account No.</label>
                                        <input v-model="payment.bank_account" type="text" class="form-control input-sm">
                                        <span class="help-block text-red" v-if="errors.bank_account_no">Required</span>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="">Date Deposit</label>
                                        <input v-model="payment.date" type="date" class="form-control input-sm">
                                        <span class="help-block text-red" v-if="errors.date_deposit">Required</span>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label for="">Amount</label>
                                        <input v-model="payment.amount" type="number" class="form-control input-sm">
                                        <span class="help-block text-red" v-if="errors.amount">Required</span>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label v-if="!payment.file.name" class="btn btn-warning btn-block btn-flat btn-sm">
                                            <span class="glyphicon glyphicon-file"></span>
                                            Deposit Slip
                                            <input style="display: none;" type="file" ref="file" @change="handleFileUpload()">
                                        </label>
                                        <label v-else class="btn btn-warning btn-block btn-flat btn-sm">
                                            <span class="glyphicon glyphicon-file"></span>
                                            @{{ payment.file.name }}
                                            <input style="display: none;" type="file" ref="file" @change="handleFileUpload()">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary btn-flat btn-block">Upload File</button>
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
                        <input type="file" ref="photo" @change="handlePhotoUpload()">
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
                requirements: [],
                modalTitle: '',
                pReqId: '',
                bReqId: '',
                payment: {
                    bank_code: '',
                    ref_no: '',
                    date: '',
                    bank_account: '',
                    amount: '',
                    file: ''
                },
                errors: [],
                photo: '',
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
                        return `/uploaded/${value}`
                    }
                }
            },
            methods: {
                uploadPhoto () {
                    let formData = new FormData();
                    formData.append('file', this.photo);

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
                handlePhotoUpload () {
                    this.photo = this.$refs.photo.files[0];
                },
                selectPhoto () {
                    $('#photo-upload').modal('show');
                },
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
                    this.payment.file = this.$refs.file.files[0];
                },
                submitFile() {
                    this.loading.uploading = true;
                    let formData = new FormData();
                    formData.append('bank_code', this.payment.bank_code);
                    formData.append('reference_no', this.payment.ref_no);
                    formData.append('date_deposit', this.payment.date);
                    formData.append('bank_account', this.payment.bank_account);
                    formData.append('amount', this.payment.amount);
                    formData.append('file', this.payment.file);

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
                            this.errors = error.response.data.errors;
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
                            win = window.open(`https://docs.google.com/gview?url=${response.data}&embedded=true`, '_blank');
                            win.focus();
                        })
                }
            }
        })
    </script>
@endsection
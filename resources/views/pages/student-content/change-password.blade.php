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
                        <li v-if="student.program.name != 'Canada Program'" class="list-group-item">
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
                    <a href="{{ route('student.change-password') }}" class="btn btn-primary btn-block">
                        <b>Change Password</b>
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
                    <div v-if="student.program.name != 'Canada Program'" id="collapse1" class="panel-collapse collapse">
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
                    <div v-else id="collapse1" class="panel-collapse collapse">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <a href="{{ route('req.basic') }}">
                                    Part 1: Preliminary Documents
                                    <i class="fa fa-arrow-right pull-right"></i>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('req.additional') }}">
                                    Part 2: Additional Requirements
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
            <div class="box box-primary">
                <div class="box-body">
                    <div v-if="Object.keys(errors).length > 0" class="alert alert-danger">
                        <ul>
                            <li v-for="error in errors">@{{ error[0] }}</li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <label>Current Password</label>
                        <input v-model="passwordForm.current_password" type="password" class="form-control input-sm" placeholder="Enter your current password.">
                    </div>
                    <div class="form-group">
                        <label>New Password</label>
                        <input v-model="passwordForm.new_password" type="password" class="form-control input-sm" placeholder="Enter your new password">
                    </div>
                    <div class="form-group">
                        <label>Re-type New Password</label>
                        <input v-model="passwordForm.retype_new_password" type="password" class="form-control input-sm" placeholder="Enter your new password">
                    </div>
                    <div>
                        <button @click="changePassword()" class="btn btn-primary btn-flat btn-sm">Submit</button>
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
                user_id: '{{ Auth::user()->id }}',
                passwordForm: {
                    current_password: '',
                    new_password: '',
                    retype_new_password: ''
                },
                errors: []
            },
            mounted: function() {
                this.loadStudentDetails();
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
                changePassword() {
                    let formData = new FormData();
                    formData.append('current_password', this.passwordForm.current_password);
                    formData.append('new_password', this.passwordForm.new_password);
                    formData.append('retype_new_password', this.passwordForm.retype_new_password);
                    
                    axios.post(`/updatePassword`, formData)
                        .then((response) => {
                            alert(response.data.message);
                        })
                        .catch((error) => {
                            this.errors = error.response.data.errors;
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
                }
            }
        });
    </script>
@endsection
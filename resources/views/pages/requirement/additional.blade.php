@extends('layouts.student-app')

@section('title', 'Additional Requirement')

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
            <div class="panel-group m-b-5">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" href="#collapse1">Program Requirements</a>
                        </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse">
                        <ul class="list-group">
                            <li class="list-group-item">
                                Part 1: Preliminary Documents
                                <a href="{{ route('req.basic') }}">
                                    <i class="fa fa-arrow-right pull-right"></i>
                                </a>
                            </li>
                            <li class="list-group-item">
                                Part 2: Visa Sponsor Forms
                                <a href="{{ route('req.visa') }}">
                                    <i class="fa fa-arrow-right pull-right"></i>
                                </a></li>
                            <li class="list-group-item">
                                Part 3: Additional Requirements
                                <a href="{{ route('req.additional') }}">
                                    <i class="fa fa-arrow-right pull-right"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel-group m-b-5">
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
                        <a href="#additional" data-toggle="tab" aria-expanded="true">
                            <span class="fa fa-user"></span>
                            <label for="" class="control-label">Additional Requirements</label>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="additional" class="tab-pane active">
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
                                    <span v-if="requirement.student_additional.status" class="fa fa-check" style="color: green;"></span>
                                    <span v-else class="fa fa-remove" style="color: red"></span>
                                </td>
                                <td class="text-center">
                                    <button v-if="requirement.student_additional.status" @click="openInNewTab(requirement)" class="btn btn-warning btn-flat btn-xs"><span class="glyphicon glyphicon-eye-open"></span> View Uploaded File</button>
                                    <button v-if="requirement.path" @click="downloadFile(requirement)" class="btn btn-primary btn-flat btn-xs"><span class="glyphicon glyphicon-download"></span> Download Program File</button>
                                    <button v-if="!requirement.student_additional.status" @click="selectFile(requirement)" class="btn btn-default btn-flat btn-xs"><span class="glyphicon glyphicon-upload"></span> Upload File</button>
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
                file: '',
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
                    axios.get(`/additional/viewUserRequirement?program_id=${programId}&id=${this.user_id}`)
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

                    axios.post(`/studAdditional/store?requirement_id=${this.pReqId}`, formData, {
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
                            return axios.post(`/studAdditional/remove?requirement_id=${requirement.student_additional.id}`)
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
                downloadFile(requirement) {
                    axios.get(`/additional/download?requirement_id=${requirement.id}`)
                        .then((response) => {
                            const link = document.createElement('a');
                            link.href = response.data;
                            link.setAttribute('download', '');
                            document.body.appendChild(link);
                            link.click();
                        }).catch((error) => {
                        console.log(error);
                    })
                },
                openInNewTab(requirement) {
                    axios.get(`/studAdditional/download?requirement_id=${requirement.student_additional.id}`)
                        .then((response) => {
                            win = window.open(`https://docs.google.com/gview?url=${response.data}&embedded=true`, '_blank');
                            win.focus();
                        })
                }
            }
        })
    </script>
@endsection
@extends('layouts.student-app')

@section('title', 'Basic Requirement')

@section('sidenav')
    <li class="header">General</li>
    <li>
        <a href="{{ route('dash.student') }}">
            <i class="fa fa-user"></i> <span><small>My Profile</small></span>
        </a>
    </li>
    <li class="header">My Requirements</li>
    <li class="active">
        <a href="{{ route('req.basic') }}">
            <i class="fa fa-book"></i>
            <span><small>Basic Requirements</small></span>
        </a>
    </li>
    <li>
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
        <div class="col-xs-12 col-md-3">
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
                    <a href="{{ route('student.change-password') }}" class="btn btn-primary btn-block">
                        <b>Change Password</b>
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
        <div class="col-xs-12 col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#basic" data-toggle="tab" aria-expanded="true">
                            <span class="fa fa-user"></span>
                            <label for="" class="control-label">Basic Requirements</label>
                        </a>
                    </li>
                </ul>
                <div class="tab-content" style="overflow-x: auto">
                    <div id="basic" class="tab-pane active">
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <th>Requirements</th>
                                <th class="text-center">Instruction</th>
                                <th class="text-center">Status</th>
                                <th>Action</th>
                            </thead>
                            <tbody v-if="hasRecords">
                                <tr v-if="loading.table">
                                    <td valign="top" colspan="15" class="text-center">
                                        <span class="fa fa-circle-o-notch fa-spin"></span>
                                    </td>
                                </tr>
                                <tr v-else v-for="requirement in requirements">
                                    <td v-cloak>@{{ requirement.name }}</td>
                                    <td v-cloak class="text-center">
                                        <button v-if="requirement.description" class="btn btn-default btn-xs" data-balloon-length="xlarge" :aria-label="requirement.description" data-balloon-pos="up"><span class="fa fa-info"></span></button>
                                    </td>
                                    <td v-cloak class="text-center">
                                        <span v-if="requirement.student_preliminary.status" class="fa fa-check" style="color: green;"></span>
                                        <span v-else class="fa fa-remove" style="color: red"></span>
                                    </td>
                                    <td class="text-center" v-cloak>
                                        <button v-if="requirement.student_preliminary.status" @click="openInNewTab(requirement)" class="btn btn-warning btn-xs btn-flat"><span class="glyphicon glyphicon-eye-open"></span> View Uploaded File</button>
                                        <button v-if="!requirement.student_preliminary.status" @click="selectFile(requirement)" class="btn btn-default btn-xs btn-flat"><span class="glyphicon glyphicon-upload"></span> Upload File</button>
                                        <button v-if="requirement.path" @click="downloadFile(requirement)" class="btn btn-primary btn-xs btn-flat"><span class="glyphicon glyphicon-download"></span>Download Program File</button>
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
                                <i class="fa fa-circle-o-notch fa-spin"></i>
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
                downloadURL: '',
                loading: {
                    uploading: false,
                    table: false
                },
                hasRecords: true
            },
            mounted: function() {
                console.log(this.$refs);
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
                    axios.get(`/preliminary/viewUserRequirement?program_id=${programId}&id=${this.user_id}`)
                        .then((response) => {
                            this.loading.table = false;
                            if (response.data.data.length > 0) {
                                this.hasRecords = true;
                                this.requirements = response.data.data;
                            } else {
                                this.hasRecords = false;
                            }
                        }).catch((error) => {
                            console.log(error);
                    })
                },
                selectFile(requirement) {
                    this.pReqId = requirement.id;
                    this.modalTitle = requirement.name;
                    $('#file-upload').modal('show');
                },
                handleFileUpload() {
                    this.file = this.$refs.file.files[0];
                },
                submitFile() {
                    this.loading.uploading = true;
                    let formData = new FormData();

                    formData.append('file', this.file);

                    axios.post(`/studPreliminary/store?requirement_id=${this.pReqId}`, formData, {
                        headers: {
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
                    });
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
                            return axios.post(`/studPreliminary/remove?requirement_id=${requirement.student_preliminary.id}`)
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
                    const link = document.createElement('a');
                    link.href = '/uploaded/'+ requirement.path;
                    link.setAttribute('download', '');
                    document.body.appendChild(link);
                    link.click();
                },
                openInNewTab(requirement) {
                    axios.get(`/studPreliminary/download?requirement_id=${requirement.student_preliminary.id}`)
                        .then((response) => {
                            win = window.open(`https://docs.google.com/gview?url=${response.data}&embedded=true`, '_blank');
                            win.focus();
                        })
                }
            }
        });
    </script>
@endsection
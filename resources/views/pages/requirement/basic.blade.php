@extends('layouts.app')

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
    <div id="app">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title text-center">Basic Requirement</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped table-condensed">
                        <thead>
                            <th>Requirements</th>
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
                                    <span v-if="requirement.status" class="fa fa-check" style="color: green;"></span>
                                    <span v-else class="fa fa-remove" style="color: red"></span>
                                </td>
                                <td v-cloak>
                                    <button v-if="!requirement.status" @click="selectFile(requirement)" class="btn btn-default btn-xs btn-flat"><span class="glyphicon glyphicon-upload"></span> Upload File</button>
                                    <button v-if="requirement.path" @click="downloadFile(requirement)" class="btn btn-primary btn-xs btn-flat"><span class="glyphicon glyphicon-download"></span>Download File</button>
                                    <button v-if="requirement.status" @click="removeFile(requirement)" class="btn btn-danger btn-xs btn-flat"><span class="glyphicon glyphicon-trash"></span> Remove File</button>
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
    </div>
@endsection

@section('script')
    <script>
        const app = new Vue({
            el: '#app',
            data: {
                requirements: [],
                modalTitle: '',
                pReqId: '',
                bReqId: '',
                file: '',
                program_id: "{{ \App\Student::where('user_id', Auth::user()->id)->first()->program_id }}",
                downloadURL: '',
                loading: {
                    uploading: false,
                    table: false
                },
                hasRecords: true
            },
            mounted: function() {
                this.loadRequirements(this.program_id);
            },
            methods: {
                loadRequirements(programId) {
                    this.loading.table = true;
                    axios.get(`/stud/requirement/basic/${programId}`)
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
                    this.pReqId = requirement.pReqId;
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

                    axios.post(`/stud/requirement/basic/upload/${this.pReqId}`, formData, {
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
                            return axios.post(`/stud/requirement/basic/remove/${requirement.bReqId}`)
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
                    axios.get(`/download/basic/form/${requirement.pReqId}`)
                        .then((response) => {
                            const link = document.createElement('a');
                            link.href = response.data;
                            link.setAttribute('download', '');
                            document.body.appendChild(link);
                            link.click();
                        }).catch((error) => {
                            console.log(error);
                    })
                }
            }
        });
    </script>
@endsection
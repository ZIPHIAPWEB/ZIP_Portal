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
    <li>
        <a href="{{ route('req.visa') }}">
            <i class="fa fa-plane"></i>
            <span><small>Visa Requirements</small></span>
        </a>
    </li>
@endsection

@section('content')
    <div id="app">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title text-center">Payment Requirement</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped table-condensed">
                        <thead>
                            <th>Requirements</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </thead>
                        <tbody v-cloak>
                            <tr v-for="requirement in requirements">
                                <td>@{{ requirement.name }}</td>
                                <td class="text-center">
                                    <span v-if="requirement.status" class="fa fa-check" style="color: green;"></span>
                                    <span v-else class="fa fa-remove" style="color: red"></span>
                                </td>
                                <td class="text-center">
                                    <button @click="selectFile(requirement)" class="btn btn-default btn-flat btn-xs"><span class="glyphicon glyphicon-upload"></span> Upload File</button>
                                    <button @click="removeFile(requirement)" class="btn btn-danger btn-flat btn-xs"><span class="glyphicon glyphicon-trash"></span> Remove File</button>
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
                            <div class="overlay" :style="{ display: loading ? 'block' : 'none' }">
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
                requirements: [],
                modalTitle: '',
                pReqId: '',
                bReqId: '',
                file: '',
                program_id: "{{ \App\Student::where('user_id', Auth::user()->id)->first()->program_id }}",
                loading: false
            },
            mounted: function() {
                this.loadRequirements(this.program_id);
            },
            methods: {
                loadRequirements(programId) {
                    axios.get(`/stud/requirement/payment/${programId}`)
                        .then((response) => {
                            this.requirements = response.data.data;
                            console.log(response.data.data);
                        }).catch((error) => {
                            console.log(error);
                    })
                },
                selectFile(requirement) {
                    this.pReqId = requirement.pReqId;
                    this.modalTitle = requirement.name;

                    console.log(requirement);
                    $('#file-upload').modal('show');
                },
                handleFileUpload() {
                    this.file = this.$refs.file.files[0];
                    console.log(this.file);
                },
                submitFile() {
                    this.loading = true;
                    let formData = new FormData();

                    formData.append('file', this.file);

                    axios.post(`/stud/requirement/payment/upload/${this.pReqId}`, formData, {
                        headers : {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                        .then((response) => {
                            this.loading = false;
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
                    }).then((isConfirm) => {
                        if (isConfirm.value) {
                            swal.showLoading();
                            this.bReqId = requirement.bReqId;
                            this.bReqId = requirement.bReqId;
                            axios.post(`/stud/requirement/payment/remove/${this.bReqId}`)
                                .then((response) => {
                                    this.loadRequirements(this.program_id);
                                    swal({
                                        title: response.data.message,
                                        type: 'success',
                                        confirmButtonText: 'Continue'
                                    })
                                }).catch((error) => {
                                    swal({
                                        title: 'An Error has occur',
                                        type: 'error',
                                        confirmButtonText: 'Go Back!'
                                    })
                            })
                        }
                    })
                }
            }
        })
    </script>
@endsection
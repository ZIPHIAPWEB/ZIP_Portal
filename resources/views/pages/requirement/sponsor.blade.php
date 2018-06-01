@extends('layouts.app')

@section('title', 'Visa Sponsor Requirement')

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
            <span class="pull-right-container">
                            <small class="label pull-right bg-red">0</small>
                        </span>
        </a>
    </li>
    <li>
        <a href="{{ route('req.payment') }}">
            <i class="fa fa-dollar"></i>
            <span><small>Payment Requirements</small></span>
            <span class="pull-right-container">
                            <small class="label pull-right bg-red">0</small>
                        </span>
        </a>
    </li>
    <li>
        <a href="{{ route('req.visa') }}">
            <i class="fa fa-plane"></i>
            <span><small>Visa Requirements</small></span>
            <span class="pull-right-container">
                            <small class="label pull-right bg-red">0</small>
                        </span>
        </a>
    </li>
@endsection

@section('content')
    <div id="app">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title text-center">Visa Sponsor Requirement</h3>
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
                                <td>
                                    <button @click="selectFile(requirement)" class="btn btn-default btn-xs btn-flat"><span class="glyphicon glyphicon-upload"></span> Upload File</button>
                                    <button v-if="requirement.path" @click="downloadFile(requirement)" class="btn btn-primary btn-xs btn-flat"><span class="glyphicon glyphicon-download"></span> Download File</button>
                                    <button @click="removeFile(requirement)" class="btn btn-danger btn-xs btn-flat"><span class="glyphicon glyphicon-trash"></span> Remove File</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal fade" id="file-upload" tabindex="-1" role="dialog">
            <form @submit.prevent="submitFile()" enctype="multipart/form-data">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Upload @{{ modalTitle }}</h4>
                        </div>
                        <div class="modal-body">
                            <input type="file" ref="file" @change="handleFileUpload()">
                        </div>
                        <div class="modal-footer clearfix">
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
                sponsor_id: "{{ \App\Student::where('user_id', Auth::user()->id)->first()->visa_sponsor_id }}"
            },
            mounted: function() {
                this.loadRequirements(this.sponsor_id);
            },
            methods: {
                loadRequirements(sponsorId) {
                    axios.get(`/stud/requirement/visa/${sponsorId}`)
                        .then((response) => {
                            this.requirements = response.data.data;
                        }).catch((error) => {
                            console.log(error);
                    });
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
                    let formData = new FormData();

                    formData.append('file', this.file);

                    axios.post(`/stud/requirement/visa/upload/${this.pReqId}`, formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                        .then((response) => {
                            this.loadRequirements(this.sponsor_id);
                            $('#file-upload').modal('hide');
                        }).catch((error) => {
                            console.log(error);
                    })
                },
                removeFile(requirement) {
                    this.bReqId = requirement.bReqId;
                    axios.post(`/stud/requirement/visa/remove/${this.bReqId}`)
                        .then((response) => {
                            this.loadRequirements(this.sponsor_id);
                        }).catch((error) => {
                            alert('No file to remove');
                    })
                },
                downloadFile(requirement) {
                    axios.get(`/download/sponsor/form/${requirement.pReqId}`)
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
        })
    </script>
@endsection
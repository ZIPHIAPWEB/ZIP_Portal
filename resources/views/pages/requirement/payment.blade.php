@extends('layouts.app')

@section('title', 'Payment Requirement')

@section('content')
    <div id="app">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title text-center">Payment Requirement</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th>Requirements</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </thead>
                        <thead v-cloak>
                            <tr v-for="requirement in requirements">
                                <td>@{{ requirement.name }}</td>
                                <td class="text-center">
                                    <span v-if="requirement.status" class="fa fa-check fa-2x" style="color: green;"></span>
                                    <span v-else class="fa fa-remove fa-2x" style="color: red"></span>
                                </td>
                                <td class="text-center">
                                    <button @click="selectFile(requirement)" class="btn btn-default btn-flat btn-sm"><span class="glyphicon glyphicon-upload"></span> Upload File</button>
                                    <button @click="removeFile(requirement)" class="btn btn-danger btn-flat btn-sm"><span class="glyphicon glyphicon-trash"></span> Remove File</button>
                                </td>
                            </tr>
                        </thead>
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
                file: ''
            },
            mounted: function() {
                this.loadRequirements(6);
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
                    let formData = new FormData();

                    formData.append('file', this.file);

                    axios.post(`/stud/requirement/payment/upload/${this.pReqId}`)
                        .then((response) => {
                            this.loadRequirements(6);
                            $('#file-upload').modal('hide');
                            console.log(response);
                        }).catch((error) => {
                            console.log(error);
                    })
                },
                removeFile(requirement) {
                    this.bReqId = requirement.bReqId;
                    axios.post(`/stud/requirement/payment/remove/${this.bReqId}`)
                        .then((response) => {
                            this.loadRequirements(6);
                            console.log(response);
                        }).catch((error) => {
                            alert('No file to remove');
                    })
                }
            }
        })
    </script>
@endsection
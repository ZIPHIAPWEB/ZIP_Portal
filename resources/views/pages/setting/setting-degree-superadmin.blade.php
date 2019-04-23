@extends('layouts.app')

@section('title', 'Degree Setting')

@section('content')
    <div id="app">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <button @click="openModal()" class="btn btn-primary btn-sm btn-flat pull-right m-b-10"><span class="glyphicon glyphicon-plus"></span>&nbsp; Create</button>
                    <table class="table table-striped table-bordered">
                        <thead>
                        <th>Name</th>
                        <th>Display Name</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                        </thead>
                        <tbody v-if="hasRecords">
                        <tr v-if="loading.table">
                            <td valign="top" colspan="15" class="text-center">
                                <span class="fa fa-circle-o-notch fa-spin"></span>
                            </td>
                        </tr>
                        <tr v-else v-for="degree in degrees">
                            <td v-cloak>@{{ degree.name }}</td>
                            <td v-cloak>@{{ degree.display_name }}</td>
                            <td v-cloak>@{{ degree.created_at }}</td>
                            <td v-cloak>@{{ degree.updated_at }}</td>
                            <td v-cloak>
                                <button @click="editModal(degree)" class="btn btn-success btn-xs btn-flat"><span class="glyphicon glyphicon-pencil"></span></button>
                                <button @click="removeDegree(degree)" class="btn btn-danger btn-xs btn-flat"><span class="glyphicon glyphicon-trash"></span></button>
                            </td>
                        </tr>
                        </tbody>
                        <tbody v-else>
                        <tr >
                            <td valign="top" colspan="15" class="text-center">
                                No Records
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal fade" id="degree-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Degree</h4>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label>Name</label>
                                <input v-model="degree.name" type="text" class="form-control" placeholder="Enter Position">
                            </div>
                            <div class="form-group">
                                <label>Display Name</label>
                                <input v-model="degree.display_name" type="text" class="form-control" placeholder="Enter Display Name">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer clearfix">
                        <button @click="actionDegree" class="btn btn-success btn-block btn-flat">Add</button>
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
                degrees: [],
                degree: {
                    name: '',
                    display_name: ''
                },
                loading: {
                    table: false
                },
                hasRecords: false,
                url: ''
            },
            mounted() {
                this.loadDegrees();
            },
            methods: {
                loadDegrees() {
                    this.loading.table = true;
                    axios.get('/degree/getAll')
                        .then((response) => {
                            this.loading.table = false;
                            this.degrees = response.data;
                            if (response.data.length == 0) {
                                this.hasRecords = false;
                            } else {
                                this.hasRecords = true;
                            }
                        })
                },
                openModal() {
                    this.url = '/degree/store';
                    $('#degree-modal').modal('show');
                },
                editModal(degree) {
                    this.url = `/degree/update/${degree.id}`;
                    $('#degree-modal').modal('show');
                },
                removeDegree(degree) {
                    axios.post(`/degree/delete/${degree.id}`)
                        .then((response) => {
                            this.loadDegrees();
                        });
                },
                actionDegree() {
                    axios.post(this.url, this.degree)
                        .then((response) => {
                            this.degree.name = '';
                            this.degree.display_name = '';
                            this.loadDegrees();
                            $('#degree-modal').modal('hide');
                            alert(response.message);
                        })
                }
            }
        })
    </script>
@endsection
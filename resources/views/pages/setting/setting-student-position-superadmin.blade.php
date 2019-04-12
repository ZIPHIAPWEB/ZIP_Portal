@extends('layouts.app')

@section('title', 'Student Position')

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
                            <tr v-else v-for="position in positions">
                                <td v-cloak>@{{ position.name }}</td>
                                <td v-cloak>@{{ position.display_name }}</td>
                                <td v-cloak>@{{ position.created_at }}</td>
                                <td v-cloak>@{{ position.updated_at }}</td>
                                <td v-cloak>
                                    <button @click="editModal(position)" class="btn btn-success btn-xs btn-flat"><span class="glyphicon glyphicon-pencil"></span></button>
                                    <button @click="removePosition(position)" class="btn btn-danger btn-xs btn-flat"><span class="glyphicon glyphicon-trash"></span></button>
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
        <div class="modal fade" id="position-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Position</h4>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label>Name</label>
                                <input v-model="position.name" type="text" class="form-control" placeholder="Enter Position">
                            </div>
                            <div class="form-group">
                                <label>Display Name</label>
                                <input v-model="position.display_name" type="text" class="form-control" placeholder="Enter Display Name">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer clearfix">
                        <button @click="actionPosition()" class="btn btn-success btn-block btn-flat">Add</button>
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
                positions: [],
                loading: {
                    table: false
                },
                hasRecords: true,
                position: {
                    name: '',
                    display_name: ''
                },
                url: ''
            },
            mounted () {
                this.loadPosition();
            },
            methods: {
                loadPosition () {
                    this.loading.table = true;
                    axios.get('/position/getAll')
                        .then((response) => {
                            this.loading.table = false;
                            this.positions = response.data
                            if (response.data.length == 0) {
                                this.hasRecords = false;
                            } else {
                                this.hasRecords = true;
                            }
                        });
                },
                openModal() {
                    this.url = '/position/store';
                    $('#position-modal').modal('show');
                },
                editModal(position) {
                    this.url = `/position/update/${position.id}`;
                    $('#position-modal').modal('show');
                },
                removePosition(position) {
                    axios.post(`/position/delete/${position.id}`)
                        .then((response) => {
                            this.loadPosition();
                        })
                },
                actionPosition () {
                    let formData = new FormData();
                    formData.append('name', this.position.name);
                    formData.append('display_name', this.position.display_name);
                    axios.post(this.url, formData)
                        .then((response) => {
                            this.position.name = '';
                            this.position.display_name = '';
                            this.loadPosition();
                            $('#position-modal').modal('hide');
                            alert(response.message);
                        });
                }
            }
        });
    </script>
@endsection
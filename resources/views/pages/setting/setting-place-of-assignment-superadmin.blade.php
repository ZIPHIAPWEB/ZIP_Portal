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
                        <th>State</th>
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
                        <tr v-else v-for="state in states">
                            <td v-cloak>@{{ state.name }}</td>
                            <td v-cloak>@{{ state.display_name }}</td>
                            <td v-cloak>@{{ state.created_at }}</td>
                            <td v-cloak>@{{ state.updated_at }}</td>
                            <td v-cloak>
                                <button @click="editModal(state)" class="btn btn-success btn-xs btn-flat"><span class="glyphicon glyphicon-pencil"></span></button>
                                <button @click="deleteState(state)" class="btn btn-danger btn-xs btn-flat"><span class="glyphicon glyphicon-trash"></span></button>
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
        <div class="modal fade" id="state-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">State</h4>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label>Name</label>
                                <input v-model="state.name" type="text" class="form-control" placeholder="Enter Position">
                            </div>
                            <div class="form-group">
                                <label>Display Name</label>
                                <input v-model="state.display_name" type="text" class="form-control" placeholder="Enter Display Name">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer clearfix">
                        <button @click="actionState()" class="btn btn-success btn-block btn-flat">@{{ button }}</button>
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
                states: [],
                loading: {
                    table: false
                },
                hasRecords: true,
                state: {
                    name: '',
                    display_name: ''
                },
                url: '',
                button: 'Add'
            },
            mounted () {
                this.loadStates();
            },
            methods: {
                loadStates () {
                    axios.get('/state/getAll')
                        .then((response) => {
                            this.states = response.data;
                        });
                },
                openModal() {
                    this.url = '/state/store';
                    this.button = 'Add';
                    $('#state-modal').modal('show');
                },
                editModal(state) {
                    this.url = `/state/update/${state.id}`;
                    this.state.name = state.name;
                    this.state.display_name = state.display_name;
                    this.button = 'Update';
                    $('#state-modal').modal('show');
                },
                actionState () {
                    let formData = new FormData();
                    formData.append('name', this.state.name);
                    formData.append('display_name', this.state.display_name);
                    axios.post(this.url, formData)
                        .then((response) => {
                            this.loadStates();
                            $('#state-modal').modal('hide');
                        })
                },
                deleteState (state) {
                    axios.post(`/state/delete/${state.id}`)
                        .then((response) => {
                            this.loadStates();
                            alert(response.data.message);
                        })
                }
            }
        });
    </script>
@endsection
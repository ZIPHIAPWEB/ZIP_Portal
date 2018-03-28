@extends('layouts.app')

@section('title', 'Roles')

@section('content')
    <div id="app">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-body">
                    <button @click="createRole()" class="btn btn-primary btn-flat btn-sm m-b-10 pull-right"><span class="glyphicon glyphicon-plus"></span>&nbsp; Create</button>
                    <table id="role-table" class="table table-bordered table-striped">
                        <thead>
                        <th>#</th>
                        <th>Name</th>
                        <th>Display Name</th>
                        <th>Description</th>
                        <th>Created At</th>
                        <th>Action</th>
                        </thead>
                        <tbody>
                            <tr v-for="role in roles.data">
                                <td>@{{ role.id }}</td>
                                <td>@{{ role.name }}</td>
                                <td>@{{ role.display_name }}</td>
                                <td>@{{ role.description }}</td>
                                <td>@{{ role.created_at }}</td>
                                <td>
                                    <button @click="editRole(role.id)" class="btn btn-success btn-flat btn-xs"><span class="glyphicon glyphicon-pencil"></span></button>
                                    <button @click="deleteRole(role.id)" class="btn btn-danger btn-flat btn-xs"><span class="glyphicon glyphicon-trash"></span></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            <li>
                                <a @click="previous()">«</a>
                            </li>
                            <li>
                                <a>@{{ current_page }}</a>
                            </li>
                            <li>
                                <a>of</a>
                            </li>
                            <li>
                                <a>@{{ last_page }}</a>
                            </li>
                            <li>
                                <a @click="next()">»</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="role-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 id="modal-title" class="modal-title">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        <form id="role-form">
                            <div class="form-group">
                                <label for="role-name">Name:</label>
                                <input name="role-name" type="text" class="form-control">
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label for="role-display-name">Display Name:</label>
                                <input name="role-display-name" type="text" class="form-control">
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label for="role-description">Description:</label>
                                <input name="role-description" type="text" class="form-control">
                                <span class="help-block"></span>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button @click="storeRole()" id="submit" class="btn btn-success btn-flat btn-block">Save changes</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
@endsection()

@section('script')
    <script>
        const app = new Vue({
            el: '#app',
            data: {
                roles: [],
                links: [],
                current_page: '',
                last_page: '',
                errors: []
            },
            mounted: function() {
                this.loadRoles();
            },
            methods: {
                previous() {
                    axios(this.links.prev)
                        .then((response) => {
                            this.roles = response.data;
                            this.links = response.data.links;
                            this.current_page = response.data.meta.current_page;
                            this.last_page = response.data.meta.last_page;
                        }).catch((error) => {
                            console.log(error);
                    })
                },
                next() {
                    axios(this.links.next)
                        .then((response) => {
                            this.roles = response.data;
                            this.links = response.data.links;
                            this.current_page = response.data.meta.current_page;
                            this.last_page = response.data.meta.last_page;
                        }).catch((error) => {
                        console.log(error);
                    })
                },
                loadRoles() {
                    axios('/role/view')
                        .then((response) => {
                            this.roles = response.data;
                            this.links = response.data.links;
                            this.current_page = response.data.meta.current_page;
                            this.last_page = response.data.meta.last_page;
                        }).catch((error) => {
                            console.log(error);
                    });
                },
                createRole() {
                    $('#role-form').attr('action', '/role/store');
                    $('#role-form')[0].reset();
                    $('.modal-title').text('Add Role');
                    $('#submit').text('Save');
                    $('#role-modal').modal('show');
                },
                editRole(id) {
                    axios(`/role/edit/${id}`)
                        .then((response) => {
                            $('#role-form').attr('action', `/role/update/${id}`);
                            $('.modal-title').text('Edit Role');
                            $('#submit').text('Update');
                            $('input[name=role-name]').val(response.data.name);
                            $('input[name=role-display-name]').val(response.data.display_name);
                            $('input[name=role-description]').val(response.data.description);
                            $('#role-modal').modal('show');
                        }).catch((error) => {
                            console.log(error);
                    });
                },
                deleteRole(id) {
                    axios(`/role/delete/${id}`)
                        .then((response) => {
                            this.loadRoles();
                        }).catch((error) => {
                            console.log(error);
                    });
                },
                storeRole() {
                    let url = $('#role-form').attr('action');
                    let formData = new FormData($('#role-form')[0]);
                    axios({ url: url, method: 'post', data: formData })
                        .then((response) => {
                            this.loadRoles();
                            $('#role-modal').modal('hide');
                        }).catch((error) => {
                            console.log(error);
                            this.errors = error.errors;
                    })
                }
            }
        });
    </script>
@endsection()
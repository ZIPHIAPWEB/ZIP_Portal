@extends('layouts.app')

@section('title', 'Roles')

@section('sidenav')
    <li class="{{ Route::currentRouteNamed('dash.superadmin') ? 'active' : '' }}">
        <a href="{{ route('dash.superadmin') }}">
            <i class="fa fa-dashboard"></i> <span><small>Dashboard</small></span>
        </a>
    </li>
    <li class="header">Administrative</li>
    <li class="treeview {{ Route::currentRouteNamed('um.students') ? 'active' : '' }}{{ Route::currentRouteNamed('um.coordinators') ? 'active' : '' }}{{ Route::currentRouteNamed('um.sponsors') ? 'active' : '' }}">
        <a href="#">
            <i class="fa fa-users"></i>
            <span><small>User Management</small></span>
            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{ Route::currentRouteNamed('um.students') ? 'active' : '' }}"><a href="{{ route('um.students') }}"><i class="fa fa-circle-o"></i> <span><small>Students</small></span></a></li>
            <li class="{{ Route::currentRouteNamed('um.coordinators') ? 'active' : '' }}"><a href="{{ route('um.coordinators') }}"><i class="fa fa-circle-o"></i> <span><small>Coordinators</small></span></a></li>
        </ul>
    </li>
    <li class="treeview {{ Route::currentRouteNamed('ac.role') ? 'active' : '' }}{{ Route::currentRouteNamed('ac.permission') ? 'active' : '' }}">
        <a href="#">
            <i class="fa fa-key"></i>
            <span><small>Access Control Management</small></span>
            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{ Route::currentRouteNamed('ac.role') ? 'active' : '' }}"><a href="{{ route('ac.role') }}"><i class="fa fa-circle-o"></i> <small>Roles</small></a></li>
        </ul>
    </li>
    <li>
        <a href="#">
            <i class="fa fa-desktop"></i> <span><small>Website Content Management</small></span>
        </a>
    </li>
    <li class="header">Settings</li>
    <li class="treeview {{ Route::currentRouteNamed('s.school') ? 'active' : '' }}{{ Route::currentRouteNamed('s.host') ? 'active' : '' }}{{ Route::currentRouteNamed('s.programs') ? 'active' : '' }}{{ Route::currentRouteNamed('s.sponsors') ? 'active' : '' }}">
        <a href="#">
            <i class="fa fa-gear"></i> <span><small>General</small></span>
            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{ Route::currentRouteNamed('s.programs') ? 'active' : '' }}"><a href="{{ route('s.programs') }}"><i class="fa fa-circle-o"></i> <small>Program</small></a></li>
            <li class="{{ Route::currentRouteNamed('s.sponsors') ? 'active' : '' }}"><a href="{{ route('s.sponsors') }}"><i class="fa fa-circle-o"></i> <small>Visa Sponsor</small></a></li>
            <li class="{{ Route::currentRouteNamed('s.host') ? 'active' : '' }}"><a href="{{ route('s.host') }}"><i class="fa fa-circle-o"></i> <small>Host Company</small></a></li>
            <li class="{{ Route::currentRouteNamed('s.school') ? 'active' : '' }}"><a href="{{ route('s.school') }}"><i class="fa fa-circle-o"></i> <small>School</small></a></li>
        </ul>
    </li>
@endsection

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
                        <tbody v-if="hasRecords">
                            <tr v-if="loading.table">
                                <td valign="top" colspan="15" class="text-center">
                                    <span class="fa fa-circle-o-notch fa-spin"></span>
                                </td>
                            </tr>
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
                        <tbody v-else>
                            <tr>
                                <td valign="top" colspan="15" class="text-center">
                                    No Records
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
                        <h4 id="modal-title" class="modal-title">@{{ title }}</h4>
                    </div>
                    <div class="modal-body">
                        <form id="role-form">
                            <div class="form-group">
                                <label for="role-name">Name:</label>
                                <input @keyup.enter="storeRole()" v-model="role.name" name="role-name" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="role-display-name">Display Name:</label>
                                <input @keyup.enter="storeRole()" v-model="role.display_name" name="role-display-name" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="role-description">Description:</label>
                                <input @keyup.enter="storeRole()" v-model="role.description" name="role-description" type="text" class="form-control">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button @click="storeRole()" id="submit" class="btn btn-success btn-flat btn-block">@{{ button }} changes</button>
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
                role: {
                    name: '',
                    display_name: '',
                    description: ''
                },
                roles: [],
                links: [],
                current_page: '',
                last_page: '',
                url: '',
                title: '',
                button: '',
                loading: {
                    table: false
                },
                hasRecords: true
            },
            mounted: function() {
                this.loadRoles();
            },
            methods: {
                previous() {
                    this.loading.table = true;
                    axios.get(this.links.prev)
                        .then((response) => {
                            this.loading.table = false;
                            if (response.data.data.length > 0) {
                                this.hasRecords = true;
                                this.roles = response.data;
                                this.links = response.data.links;
                                this.current_page = response.data.meta.current_page;
                                this.last_page = response.data.meta.last_page;
                            } else {
                                this.hasRecords = false;
                            }
                        }).catch((error) => {
                            console.log(error);
                    })
                },
                next() {
                    this.loading.table = true;
                    axios.get(this.links.next)
                        .then((response) => {
                            this.loading.table = false;
                            if (response.data.data.length > 0) {
                                this.hasRecords = true;
                                this.roles = response.data;
                                this.links = response.data.links;
                                this.current_page = response.data.meta.current_page;
                                this.last_page = response.data.meta.last_page;
                            } else {
                                this.hasRecords = false;
                            }
                        }).catch((error) => {
                        console.log(error);
                    })
                },
                loadRoles() {
                    this.loading.table = true;
                    axios.get('/role/view')
                        .then((response) => {
                            this.loading.table = false;
                            if (response.data.data.length > 0) {
                                this.hasRecords = true;
                                this.roles = response.data;
                                this.links = response.data.links;
                                this.current_page = response.data.meta.current_page;
                                this.last_page = response.data.meta.last_page;
                            } else {
                                this.hasRecords = false;
                            }
                        }).catch((error) => {
                            console.log(error);
                    });
                },
                createRole() {
                    this.url = '/role/store';
                    this.title = 'Add Role';
                    this.button = 'Save';

                    this.role.name = '';
                    this.role.display_name = '';
                    this.role.description = '';

                    $('#role-modal').modal('show');
                },
                editRole(id) {
                    axios.get(`/role/edit/${id}`)
                        .then((response) => {
                            this.url = `/role/update/${id}`;
                            this.title = 'Edit Role';
                            this.button = 'Update';

                            this.role.name = response.data.name;
                            this.role.display_name = response.data.display_name;
                            this.role.description = response.data.description;

                            $('#role-modal').modal('show');
                        }).catch((error) => {
                            console.log(error);
                    });
                },
                deleteRole(id) {
                    axios.get(`/role/delete/${id}`)
                        .then((response) => {
                            this.loadRoles();
                        }).catch((error) => {
                            console.log(error);
                    });
                },
                storeRole() {
                    axios.post(this.url, this.role)
                        .then((response) => {
                            this.loadRoles();
                            $('#role-modal').modal('hide');
                        }).catch((error) => {
                            console.log(error.response);
                    })
                }
            }
        });
    </script>
@endsection()
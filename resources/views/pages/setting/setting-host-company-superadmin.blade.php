@extends('layouts.app')

@section('title', 'Host Company Setting')

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
            <span class="text-sm">User Management</span>
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
            <span class="text-sm">Access Control Management</span>
            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{ Route::currentRouteNamed('ac.role') ? 'active' : '' }}"><a href="{{ route('ac.role') }}"><i class="fa fa-circle-o"></i> <small>Roles</small></a></li>
        </ul>
    </li>
    <li class="{{ Route::currentRouteNamed('sa.events') ? 'active' : '' }}">
        <a href="{{ route('sa.events') }}">
            <i class="fa fa-calendar"></i> <span class="text-sm">Event Management</span>
        </a>
    </li>
    <li class="{{ Route::currentRouteNamed('sa.cms') ? 'active' : '' }}">
        <a href="{{ route('sa.cms') }}">
            <i class="fa fa-desktop"></i>
            <span class="text-sm">Website Content Management</span>
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
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <button @click="createHost()" class="btn btn-primary btn-sm btn-flat pull-right m-b-10"><span class="glyphicon glyphicon-plus"></span>&nbsp; Create</button>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <th>Name</th>
                            <th>State</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </thead>
                        <tbody v-if="hasRecords">
                            <tr v-if="loading.table">
                                <td valign="top" colspan="15" class="text-center">
                                    <span class="fa fa-circle-o-notch fa-spin"></span>
                                </td>
                            </tr>
                            <tr v-else v-for="host in hosts">
                                <td v-cloak>@{{ host.name }}</td>
                                <td v-cloak>@{{ host.states }}</td>
                                <td v-cloak>@{{ host.created_at }}</td>
                                <td v-cloak>
                                    <button @click="editHost(host.id)" class="btn btn-success btn-xs btn-flat"><span class="glyphicon glyphicon-pencil"></span></button>
                                    <button @click="deleteHost(host.id)" class="btn btn-danger btn-xs btn-flat"><span class="glyphicon glyphicon-trash"></span></button>
                                </td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr v-else>
                                <td valign="top" colspan="15" class="text-center">
                                    No Records
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        <li>
                            <a @click="previous()">«</a>
                        </li>
                        <li>
                            <a v-cloak>@{{ current_page }}</a>
                        </li>
                        <li>
                            <a>of</a>
                        </li>
                        <li>
                            <a v-cloak>@{{ last_page }}</a>
                        </li>
                        <li>
                            <a @click="next()">»</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="modal fade" id="host-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">@{{ title }} Host</h4>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="host-name">Name</label>
                                <input v-model="host.name" type="text" class="form-control" placeholder="Enter Host Name...">
                            </div>
                            <div class="form-group">
                                <label for="host-state">State</label>
                                <input v-model="host.state" type="text" class="form-control" placeholder="Enter Host State...">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer clearfix">
                        <button @click="storeHost()" class="btn btn-success btn-block btn-flat">@{{ button }}</button>
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
                title: '',
                button: '',
                url: '',
                hosts: [],
                host: {
                    name: '',
                    state: ''
                },
                links: [],
                current_page: '',
                last_page: '',
                loading: {
                    table: false
                },
                hasRecords: true
            },
            mounted: function() {
                this.loadHost();
            },
            methods: {
                loadHost() {
                    this.loading.table = true;
                    axios.get('/host/view')
                        .then((response) => {
                            this.loading.table = false;
                            if (response.data.data.length > 0) {
                                this.hasRecords = true;
                                this.hosts = response.data.data;
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
                createHost() {
                    this.host.name = '';
                    this.host.state = '';
                    this.title = 'Create';
                    this.button = 'Add';
                    this.url = '/host/store';
                    $('#host-modal').modal('show');
                },
                editHost(id) {
                    axios.get(`/host/edit/${id}`)
                        .then((response) => {
                            this.host.name = response.data.data.name;
                            this.host.state = response.data.data.states;
                            this.title = 'Edit';
                            this.button = 'Update';
                            this.url = `/host/${id}/update`;
                            $('#host-modal').modal('show');
                        }).catch((error) => {
                            console.log(error);
                    });
                },
                storeHost() {
                    axios.post(this.url, this.host)
                        .then((response) => {
                            this.loadHost();
                            $('#host-modal').modal('hide');
                            console.log(response);
                        }).catch((error) => {
                            console.log(error);
                    });
                },
                deleteHost(id) {
                    axios.get(`/host/delete/${id}`)
                        .then((response) => {
                            this.loadHost();
                            console.log(response);
                        }).catch((error) => {
                            console.log(error);
                    });
                },
                previous() {
                    this.loading.table = true;
                    axios.get(this.links.prev)
                        .then((response) => {
                            this.loading.table = false;
                            if (response.data.data.length > 0) {
                                this.hasRecords = true;
                                this.hosts = response.data.data;
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
                next() {
                    this.loading.table = true;
                    axios.get(this.links.next)
                        .then((response) => {
                            this.loading.table = false;
                            if (response.data.data.length > 0) {
                                this.hasRecords = true;
                                this.hosts = response.data.data;
                                this.links = response.data.links;
                                this.current_page = response.data.meta.current_page;
                                this.last_page = response.data.meta.last_page;
                            } else {
                                this.hasRecords = false;
                            }
                        }).catch((error) => {
                        console.log(error);
                    });
                }
            }
        });
    </script>
@endsection
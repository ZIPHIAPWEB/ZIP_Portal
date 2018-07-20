@extends('layouts.app')

@section('title', 'Coordinators')

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
            <li class="{{ Route::currentRouteNamed('um.sponsors') ? 'active' : '' }}"><a href="{{ route('um.sponsors') }}"><i class="fa fa-circle-o"></i> <span><small>Visa Sponsors</small></span></a></li>
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
            <li class="{{ Route::currentRouteNamed('ac.permission') ? 'active' : '' }}"><a href="{{ route('ac.permission') }}"><i class="fa fa-circle-o"></i> <small>Permissions</small></a></li>
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
    <div id="app" v-cloak>
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <b>Coordinator</b>
                </div>
                <div class="box-body">
                    <table id="coordinator-table" class="table table-bordered table-striped table-condensed">
                        <thead>
                            <th></th>
                            <th class="text-center">Username</th>
                            <th class="text-center">E-mail</th>
                            <th class="text-center">Fullname</th>
                            <th class="text-center">Department</th>
                            <th class="text-center">Position</th>
                            <th class="text-center">Contact</th>
                            <th class="text-center">Action</th>
                        </thead>
                        <tbody>
                            <tr v-if="coordinators.length === 0">
                                <td valign="top" colspan="15" class="text-center">No Records</td>
                            </tr>
                            <tr v-else v-for="coordinator in coordinators">
                                <td class="text-center">
                                    <i v-if="coordinator.isOnline" class="fa fa-circle text-success"></i>
                                    <i v-else class="fa fa-circle text-danger"></i>
                                </td>
                                <td class="text-sm text-center">@{{ coordinator.name }}</td>
                                <td class="text-sm text-center">@{{ coordinator.email }}</td>
                                <td class="text-sm text-center">@{{ coordinator.firstName }} @{{ coordinator.lastName }}</td>
                                <td class="text-sm text-center">@{{ coordinator.department }}</td>
                                <td class="text-sm text-center">@{{ coordinator.position }}</td>
                                <td class="text-sm text-center">@{{ coordinator.contact }}</td>
                                <td class="text-center">
                                    <button @click="ViewLogs(coordinator)" class="btn btn-default btn-flat btn-xs"><i class="fa fa-file"></i>&nbsp; Logs</button>
                                    <button @click="ActivateCoordinator(coordinator.verified, coordinator.user_id)" class="btn btn-warning btn-flat btn-xs"><span class="fa fa-cogs"></span>&nbsp; @{{ coordinator.verified ? 'Deactivate' : 'Activate' }}</button>
                                    <button @click="DeleteCoordinator(coordinator.user_id)" class="btn btn-danger btn-flat btn-xs"><span class="fa fa-trash"></span>&nbsp; Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer clearfix">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        <li>
                            <a @click="previous()">«</a>
                        </li>
                        <li>
                            <a>@{{ meta.current_page }}</a>
                        </li>
                        <li>
                            <a>of</a>
                        </li>
                        <li>
                            <a>@{{ meta.last_page }}</a>
                        </li>
                        <li>
                            <a @click="next()">»</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="modal fade" id="logs-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped table-bordered table-condensed">
                            <thead>
                                <th>Client</th>
                                <th class="text-center">Logs</th>
                                <th class="text-center">Action</th>
                            </thead>
                            <tbody>
                                <tr v-if="actions.length === 0">
                                    <td valign="top" colspan="15" class="text-center">No Records</td>
                                </tr>
                                <tr v-else v-for="item in actions">
                                    <td class="text-sm">@{{ item.first_name }} @{{ item.last_name }}</td>
                                    <td class="text-center text-sm">@{{ item.actions }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-default btn-flat btn-xs"><span class="glyphicon glyphicon-trash"></span></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()

@section('script')
    <script>
        const app = new Vue({
            el: '#app',
            data: {
                coordinators: [],
                links: [],
                meta: [],
                actions: []
            },
            mounted: function() {
                this.loadCoordinators();
            },
            methods: {
                previous: function () {
                    axios.get(this.links.prev)
                        .then((response) => {
                            this.coordinators = response.data.data;
                            this.links = response.data.links;
                            this.meta = response.data.meta;
                        }).catch((error) => {
                            console.log(error);
                    })
                },
                next: function () {
                    axios.get(this.links.next)
                        .then((response) => {
                            this.coordinators = response.data.data;
                            this.links = response.data.links;
                            this.meta = response.data.meta;
                        }).catch((error) => {
                        console.log(error);
                    })
                },
                loadCoordinators: function () {
                    axios.get('/coor/show')
                        .then((response) => {
                            this.coordinators = response.data.data;
                            this.links = response.data.links;
                            this.meta = response.data.meta;
                        }).catch((error) => {
                            console.log(error);
                    });
                },
                ViewLogs: function (coordinator) {
                    this.ViewActions(coordinator.user_id);
                    $('#logs-modal').modal('show');
                },
                ViewActions: function (userId) {
                    axios.get(`/sa/coor/actions/view/coordinator/${userId}`)
                        .then((response) => {
                            this.actions = response.data.data;
                        })
                },
                ActivateCoordinator: function (isActivated, userId) {
                    switch (isActivated) {
                        case 0:
                            axios.post(`/sa/coor/activate/${userId}`)
                                .then((response) => {
                                    swal({
                                        toast: true,
                                        position: 'top-right',
                                        title: response.data.message,
                                        type: 'success',
                                        showConfirmButton: false,
                                        timer: 3000
                                    })
                                    this.loadCoordinators();
                                });
                            break;

                        case 1:
                            axios.post(`/sa/coor/deactivate/${userId}`)
                                .then((response) => {
                                    swal({
                                        toast: true,
                                        position: 'top-right',
                                        title: response.data.message,
                                        type: 'warning',
                                        showConfirmButton: false,
                                        timer: 3000
                                    })
                                    this.loadCoordinators();
                                });
                            break;
                    }

                },
                DeleteCoordinator: function (userId) {
                    console.log(`${userId} deleted...`);
                }
            }
        });
    </script>
@endsection()
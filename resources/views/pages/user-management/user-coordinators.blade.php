@extends('layouts.app')

@section('title', 'Coordinators')

@section('content')
    <div id="app" v-cloak>
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <b>Coordinator</b>
                    <div class="pull-right">
                        <button @click="loadCoordinators" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-refresh"></span> Refresh</button>
                    </div>
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
                        <tbody v-if="hasRecords">
                            <tr v-if="loading.table">
                                <td valign="top" colspan="15" class="text-center">
                                    <span class="fa fa-circle-o-notch fa-spin"></span>
                                </td>
                            </tr>
                            <tr v-else v-for="coordinator in coordinators">
                                <td class="text-center">
                                    <i v-if="coordinator.isOnline" class="fa fa-circle text-success"></i>
                                    <i v-else class="fa fa-circle text-danger"></i>
                                </td>
                                <td class="text-sm text-center">@{{ coordinator.name }}</td>
                                <td class="text-sm text-center">@{{ coordinator.email }}</td>
                                <td class="text-sm text-center">@{{ coordinator.firstName }} @{{ coordinator.lastName }}</td>
                                <td class="text-sm text-center">@{{ coordinator.program }}</td>
                                <td class="text-sm text-center">@{{ coordinator.position }}</td>
                                <td class="text-sm text-center">@{{ coordinator.contact }}</td>
                                <td class="text-center">
                                    <button @click="ViewLogs(coordinator)" class="btn btn-default btn-flat btn-xs"><i class="fa fa-file"></i>&nbsp; Logs</button>
                                    <button @click="ActivateCoordinator(coordinator.verified, coordinator.user_id)" class="btn btn-warning btn-flat btn-xs"><span class="fa fa-cogs"></span>&nbsp; @{{ coordinator.verified ? 'Deactivate' : 'Activate' }}</button>
                                    <button @click="DeleteCoordinator(coordinator.user_id)" class="btn btn-danger btn-flat btn-xs"><span class="fa fa-trash"></span>&nbsp; Delete</button>
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
                actions: [],
                loading: {
                    table: false
                },
                hasRecords: true
            },
            mounted: function() {
                this.loadCoordinators();
            },
            methods: {
                previous: function () {
                    this.loading.table = true;
                    axios.get(this.links.prev)
                        .then((response) => {
                            this.loading.table = false;
                            if (response.data.data.length > 0) {
                                this.hasRecords = true;
                                this.coordinators = response.data.data;
                                this.links = response.data.links;
                                this.meta = response.data.meta;
                            } else {
                                this.hasRecords = false;
                            }
                        }).catch((error) => {
                            this.hasRecords = false;
                    })
                },
                next: function () {
                    this.loading.table = true;
                    axios.get(this.links.next)
                        .then((response) => {
                            this.loading.table = false;
                            if (response.data.data.length > 0) {
                                this.hasRecords = true;
                                this.coordinators = response.data.data;
                                this.links = response.data.links;
                                this.meta = response.data.meta;
                            } else {
                                this.hasRecords = false;
                            }
                        }).catch((error) => {
                            this.hasRecords = false;
                    })
                },
                loadCoordinators: function () {
                    this.loading.table = true;
                    axios.get('/coor/show')
                        .then((response) => {
                            this.loading.table = false;
                            if (response.data.data.length > 0) {
                                this.hasRecords = true;
                                this.coordinators = response.data.data;
                                this.links = response.data.links;
                                this.meta = response.data.meta;
                            } else {
                                this.hasRecords = false;
                            }
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
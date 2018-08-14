@extends('layouts.app')

@section('title', 'Events')

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
            <li class="{{ Route::currentRouteNamed('um.sponsors') ? 'active' : '' }}"><a href="{{ route('um.sponsors') }}"><i class="fa fa-circle-o"></i> <span><small>Visa Sponsors</small></span></a></li>
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
            <li class="{{ Route::currentRouteNamed('ac.permission') ? 'active' : '' }}"><a href="{{ route('ac.permission') }}"><i class="fa fa-circle-o"></i> <small>Permissions</small></a></li>
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
    <div id="app" v-cloak>
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <b>Event Management</b>
                </div>
                <div class="box-body">
                    <button @click="createEvent()" class="btn btn-primary btn-flat btn-sm pull-right m-b-5"><span class="fa fa-plus"></span> Create</button>
                    <table class="table table-bordered table-striped table-condensed">
                        <thead>
                            <th>Event Date</th>
                            <th class="text-center">Event Name</th>
                            <th class="text-center">Event Description</th>
                            <th class="text-center">Action</th>
                        </thead>
                        <tbody v-if="hasRecords">
                            <tr v-if="loading.table">
                                <td valign="top" colspan="15" class="text-center">
                                    <span class="fa fa-circle-o-notch fa-spin"></span>
                                </td>
                            </tr>
                            <tr v-else v-for="event in events">
                                <td>@{{ event.date }}</td>
                                <td class="text-sm text-center">@{{ event.name }}</td>
                                <td class="text-center text-sm" style="display: block; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">@{{ event.description }}</td>
                                <td class="text-center">
                                    <button @click="editEvent(event.id)" class="btn btn-success btn-flat btn-xs">
                                        <span class="fa fa-pencil"></span>
                                    </button>
                                    <button @click="deleteEvent(event.id)" class="btn btn-danger btn-flat btn-xs">
                                        <span class="fa fa-trash"></span>
                                    </button>
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

        <div class="modal fade" id="create-event" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"><span class="fa fa-calendar"></span> Create Event</h4>
                        </div>
                        <div class="modal-body">
                            <form @submit.prevent="saveEvent">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input v-model="event.date" type="date" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input v-model="event.name" type="text" class="form-control" placeholder="Event Name">
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <input v-model="event.description" type="text" class="form-control" placeholder="Event Description">
                                </div>
                                <button type="submit" class="btn btn-primary btn-flat btn-block">Save</button>
                            </form>
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
                events: [],
                event: {
                    date: '',
                    name: '',
                    description: ''
                },
                url: '',
                loading: {
                    table: false
                },
                hasRecords: true
            },
            mounted: function () {
                this.loadEvents();
            },
            methods: {
                loadEvents() {
                    this.loading.table = true;
                    axios.get('/event/view')
                        .then((response) => {
                            this.loading.table = false;
                            if (response.data.data.length > 0) {
                                this.hasRecords = true;
                                this.events = response.data.data;
                            } else {
                                this.hasRecords = false;
                            }
                        })
                        .catch((error) => {
                            console.log(error);
                        })
                },
                createEvent() {
                    this.url = '/event/store';
                    $('#create-event').modal('show');
                },
                editEvent(id) {
                    axios.get(`/event/${id}/edit`)
                        .then((response) => {
                            this.event.date = response.data.data.date;
                            this.event.name = response.data.data.name;
                            this.event.description = response.data.data.description;

                            this.url = `/event/${id}/update`;
                            $('#create-event').modal('show');
                        })
                        .catch((error) => {
                            console.log(error);
                        })
                },
                deleteEvent(id) {
                    axios.post(`/event/${id}/delete`)
                        .then((response) => {
                            this.loadEvents();
                            swal({
                                title: `${response.data.data.name} deleted.`,
                                type: 'success',
                                confirmButtonText: 'Continue'
                            })
                        })
                        .catch((error) => {
                            console.log(error);
                        })
                },
                saveEvent() {
                    let formData = new FormData();
                    formData.append('date', this.event.date);
                    formData.append('name', this.event.name);
                    formData.append('description', this.event.description);

                    axios.post(this.url, formData)
                        .then((response) => {
                            this.loadEvents();
                            this.clearField();
                            $('#create-event').modal('hide');
                            swal({
                                title: `${response.data.data.name} Added.`,
                                type: 'success',
                                confirmButtonText: 'Continue'
                            })
                        })
                        .catch((error) => {
                            console.log(error);
                        })
                },
                clearField() {
                    this.event.data = '';
                    this.event.name = '';
                    this.event.description = '';
                }
            }
        })
    </script>
@endsection
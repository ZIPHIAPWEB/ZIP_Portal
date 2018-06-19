@extends('layouts.app')

@section('title', 'Students')

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
                    <h3 class="box-title">Students</h3>
                </div>
                <div class="box-body">
                    <div class="form-group pull-right">
                        <input type="text" class="form-control input-sm" placeholder="Search Name">
                    </div>
                    <table class="table table-bordered table-striped table-condensed">
                        <thead>
                            <th>Date of Application</th>
                            <th>Status</th>
                            <th>Application ID</th>
                            <th>Fullname</th>
                            <th>Program</th>
                            <th>Course</th>
                            <th>Contact</th>
                            <th>School</th>
                            <th>Activated</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <tr v-for="student in students">
                                <td>@{{ student.created_at }}</td>
                                <td>@{{ student.application_status }}</td>
                                <td>@{{ student.application_id | isEmpty }}</td>
                                <td>@{{ student.first_name }} @{{ student.middle_name[0] }}. @{{ student.last_name }}</td>
                                <td>@{{ student.program }}</td>
                                <td>@{{ student.course }}</td>
                                <td>@{{ student.home_number }}/@{{ student.mobile_number }}</td>
                                <td>@{{ student.college }}</td>
                                <td>@{{ student.verified | verify }}</td>
                                <td>
                                    <button class="btn btn-default btn-flat btn-xs">View</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer clearfix">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        <li>
                            <a @click="PreviousPage()" href="#">«</a>
                        </li>
                        <li>
                            <a>@{{ meta.current_page }}</a>
                        </li>
                        <li>
                            <a>to</a>
                        </li>
                        <li>
                            <a>@{{ meta.last_page }}</a>
                        </li>
                        <li>
                            <a @click="NextPage()" href="#">»</a>
                        </li>
                    </ul>
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
                students: [],
                links: [],
                meta: []
            },
            mounted () {
                this.LoadStudents();
            },
            methods: {
                PreviousPage: function () {
                    axios.get(this.links.prev)
                        .then((response) => {
                            this.students = response.data.data;
                            this.links = response.data.links;
                            this.meta = response.data.meta;
                        })
                },
                NextPage: function () {
                    axios.get(this.links.next)
                        .then((response) => {
                            this.students = response.data.data;
                            this.links = response.data.links;
                            this.meta = response.data.meta;
                        })
                },
                LoadStudents: function () {
                    axios.get(`/stud/show`)
                        .then((response) => {
                            this.students = response.data.data;
                            this.links = response.data.links;
                            this.meta = response.data.meta
                        })
                }
            },
            filters: {
                verify: value => {
                    if (value === 1) {
                        return 'Activated';
                    } else {
                        return 'Not Yet Activated';
                    }
                },
                isEmpty: value => {
                    if (!value) {
                        return 'Not confirmed Yet';
                    } else {
                        return value;
                    }
                }
            }
        })
    </script>
@endsection()
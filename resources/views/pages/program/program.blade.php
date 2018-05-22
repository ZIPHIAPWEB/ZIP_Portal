@extends('layouts.app')

@section('title', \App\Program::find($program)->name . ' Program')

@section('sidenav')
    <li class="header">Program</li>
    <li class="treeview" id="coordinator">
        <a href="#">
            <i class="fa fa-key"></i>
            <span><small>Student's Program(s)</small></span>
            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
        </a>
        <ul class="treeview-menu" >
            <li v-for="program in programs"><a :href="url + program.id"><i class="fa fa-circle-o"></i><small>@{{ program.name }}</small></a></li>
        </ul>
    </li>
@endsection

@section('content')
    <div id="app">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title text-center">{{ \App\Program::find($program)->name }} Students</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped table-condensed">
                        <thead>
                            <td>Date of Application</td>
                            <td>Status</td>
                            <td>Application ID</td>
                            <td>Full Name</td>
                            <td>Program</td>
                            <td>Course</td>
                            <td>Contact</td>
                            <td>School</td>
                            <td>Recent Activity</td>
                            <td>Action</td>
                        </thead>
                        <tbody>
                            <tr v-for="student in students">
                                <td>@{{ student.created_at }}</td>
                                <td>@{{ student.application_status }}</td>
                                <td>@{{ student.application_id }}</td>
                                <td>@{{ student.first_name }}&nbsp;@{{ student.middle_name[0] }}.&nbsp; @{{ student.last_name }}</td>
                                <td>@{{ student.program }}</td>
                                <td>@{{ student.course }}</td>
                                <td>@{{ student.mobile_number }}/@{{ student.home_number }}</td>
                                <td>@{{ student.school }}</td>
                                <td></td>
                                <td>
                                    <button class="btn btn-default btn-flat btn-xs">View</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let programId = '{{ $program }}';

        const sidenav = new Vue({
            el: '#sidenav',
            data: {
                url: '/portal/c/program/',
                programs: []
            },
            mounted: function() {
                this.loadPrograms();
            },
            methods: {
                loadPrograms() {
                    axios.get('/helper/program/view')
                        .then((response) => {
                            this.programs = response.data.data;
                        })
                }
            }
        });

        const app = new Vue({
            el: '#app',
            data: {
                students: []
            },
            mounted: function() {
                this.loadStudents(programId);
            },
            methods: {
                loadStudents(programId) {
                    axios.get(`/coor/program/${programId}`)
                        .then((response) => {
                            this.students = response.data.data;
                        })
                }
            }
        })
    </script>
@endsection
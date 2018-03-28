@extends('layouts.app')

@section('title', 'Students')

@section('content')
    <div id="app">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <b>Students</b>
                </div>
                <div class="box-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <th>#</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <tr v-for="student in students.data">
                                <td>@{{ student.id }}</td>
                                <td>@{{ student.name }}</td>
                                <td>@{{ student.email }}</td>
                                <td>
                                    <button class="btn btn-default btn-flat btn-xs"><span class="glyphicon glyphicon-eye-open"></span>&nbsp; View</button>&nbsp;
                                    <button class="btn btn-warning btn-flat btn-xs"><span class="fa fa-cogs"></span>&nbsp; @{{ student.verified === 0 ? 'Active' : 'Not Active' }}</button>
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
@endsection()

@section('script')
    <script>
        const app = new Vue({
            el: '#app',
            data: {
                students: [],
                links: [],
                current_page: '',
                last_page: ''
            },
            mounted: function() {
                this.loadStudents();
            },
            methods: {
                previous() {
                    axios(this.links.prev)
                        .then((response) => {
                            this.students = response.data;
                            this.links = response.data.links;
                            this.current_page = response.data.meta.current_page;
                            this.last_page = response.data.meta.last_page;
                        }).catch((error) => {
                            console.log(error);
                    });
                },
                next() {
                    axios(this.links.next)
                        .then((response) => {
                            this.students = response.data;
                            this.links = response.data.links;
                            this.current_page = response.data.meta.current_page;
                            this.last_page = response.data.meta.last_page;
                        }).catch((error) => {
                        console.log(error);
                    });
                },
                loadStudents() {
                    axios('/stud/show')
                        .then((response) => {
                            this.students = response.data;
                            this.links = response.data.links;
                            this.current_page = response.data.meta.current_page;
                            this.last_page = response.data.meta.last_page;
                        }).catch((error) => {
                            console.log(error);
                    });
                }
            }
        })
    </script>
@endsection()
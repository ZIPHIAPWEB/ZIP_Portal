@extends('layouts.app')

@section('title', 'School Setting')

@section('content')
    <div id="app">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <button @click="createSchool()" class="btn btn-primary btn-flat btn-sm pull-right m-b-10"><span class="glyphicon glyphicon-plus"></span>&nbsp;Create</button>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th>Name</th>
                            <th>Display Name</th>
                            <th>Description</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <tr v-for="school in schools">
                                <td v-cloak>@{{ school.name }}</td>
                                <td v-cloak>@{{ school.display_name }}</td>
                                <td v-cloak>@{{ school.description }}</td>
                                <td v-cloak>@{{ school.created_at }}</td>
                                <td v-cloak>
                                    <button @click="editSchool(school.id)" class="btn btn-success btn-flat btn-xs"><span class="glyphicon glyphicon-pencil"></span></button>
                                    <button @click="deleteSchool(school.id)" class="btn btn-danger btn-flat btn-xs"><span class="glyphicon glyphicon-trash"></span></button>
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
        <div class="modal fade" id="school-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">@{{ title }}</h4>
                    </div>
                    <div class="modal-body">
                        <form action="">
                            <div class="form-group">
                                <label for="school-name">Name:</label>
                                <input v-model="school.name" type="text" name="school-name" class="form-control" placeholder="Enter name...">
                            </div>
                            <div class="form-group">
                                <label for="school-display-name">Display Name:</label>
                                <input v-model="school.display_name" type="text" name="school-display-name" class="form-control" placeholder="Enter display name...">
                            </div>
                            <div class="form-group">
                                <label for="school-description">Description:</label>
                                <input v-model="school.description" type="text" name="school-description" class="form-control" placeholder="Enter description...">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer clearfix">
                        <button @click="storeSchool()" class="btn btn-success btn-flat btn-block">@{{ button }}</button>
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
                schools: [],
                school: {
                    name: '',
                    display_name: '',
                    description: ''
                },
                title: '',
                button: '',
                url: '',
                links: [],
                current_page: '',
                last_page: ''
            },
            mounted: function() {
                this.loadSchool();
            },
            methods: {
                previous() {
                    axios.get(this.links.prev)
                        .then((response) => {
                            this.schools = response.data.data;
                            this.links = response.data.links;
                            this.current_page = response.data.meta.current_page;
                            this.last_page = response.data.meta.last_page;
                        }).catch((error) => {
                            console.log(error);
                    });
                },
                next() {
                    axios.get(this.links.next)
                        .then((response) => {
                            this.schools = response.data.data;
                            this.links = response.data.links;
                            this.current_page = response.data.meta.current_page;
                            this.last_page = response.data.meta.last_page;
                        }).catch((error) => {
                            console.log(error);
                    });
                },
                loadSchool() {
                    axios.get('/school/view')
                        .then((response) => {
                            this.schools = response.data.data;
                            this.links = response.data.links;
                            this.current_page = response.data.meta.current_page;
                            this.last_page = response.data.meta.last_page;
                        }).catch((error) => {
                            console.log(error);
                    });
                },
                createSchool() {
                    this.title = 'Create School';
                    this.button = 'Add';
                    this.url = '/school/store';
                    this.school.name = '';
                    this.school.display_name = '';
                    this.school.description = '';
                    $('#school-modal').modal('show');
                },
                editSchool(id) {
                    axios.get(`/school/${id}/edit`)
                        .then((response) => {
                            this.title = 'Edit School';
                            this.button = 'Update';
                            this.url = `/school/${id}/update`;
                            this.school.name = response.data.data.name;
                            this.school.display_name = response.data.data.display_name;
                            this.school.description = response.data.data.description;
                            $('#school-modal').modal('show');
                        }).catch((error) => {
                            console.log(error);
                    });
                },
                storeSchool() {
                    axios.post(this.url, this.school)
                        .then((response) => {
                            this.loadSchool();
                            $('#school-modal').modal('hide');
                        }).catch((error) => {
                            console.log(error);
                    });
                },
                deleteSchool(id) {
                    axios.post(`/school/${id}/delete`)
                        .then((response) => {
                            console.log(response.data);
                            this.loadSchool();
                        }).catch((error) => {
                            console.log(error);
                    });
                }
            }
        })
    </script>
@endsection
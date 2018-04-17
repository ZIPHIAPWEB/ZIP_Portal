@extends('layouts.app')

@section('title', 'Program Setting')

@section('content')
    <div id="app">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <button @click="createProgram()" class="btn btn-primary btn-flat btn-sm pull-right m-b-10"><span class="glyphicon glyphicon-plus"></span>&nbsp; Create</button>
                    <table id="program-table" class="table table-striped table-bordered">
                        <thead>
                            <th>Name</th>
                            <th>Display Name</th>
                            <th>Description</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <tr v-if="programs.length === 0">
                                <td valign="top" colspan="15" class="text-center">No Records</td>
                            </tr>
                            <tr v-else v-for="program in programs">
                                <td>@{{ program.name }}</td>
                                <td>@{{ program.display_name }}</td>
                                <td>@{{ program.description }}</td>
                                <td>
                                    <button @click="viewRequirements(program.id)" class="btn btn-primary btn-flat btn-xs" data="add"><span class="glyphicon glyphicon-plus"></span></button>&nbsp;
                                    <button @click="editProgram(program.id)" class="btn btn-success btn-flat btn-xs" data="edit"><span class="glyphicon glyphicon-pencil"></span></button>&nbsp;
                                    <button @click="deleteProgram(program.id)" class="btn btn-danger btn-flat btn-xs" data="delete"><span class="glyphicon glyphicon-trash"></span></button>
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

        <div class="modal fade" id="program-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">@{{ program.display_name }} Requirements</h4>
                    </div>
                    <div class="modal-body clearfix">
                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input v-model="requirement.name" type="text" class="form-control" placeholder="Enter Name"/>
                                </div>
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <input v-model="requirement.description" type="text" class="form-control" placeholder="Enter Description"/>
                                </div>

                                <button @click="storeRequirement()" class="btn btn-primary btn-flat btn-block btn-sm pull-right m-b-10">@{{ req_button }}</button>
                            </div>
                        </div>
                        <table id="program-single-table" class="table table-striped table-bordered">
                            <thead>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <tr v-if="requirements.length === 0">
                                    <td valign="top" colspan="15" class="text-center">No Records</td>
                                </tr>
                                <tr v-else v-for="requirement in requirements">
                                    <td>@{{ requirement.name }}</td>
                                    <td>@{{ requirement.description }}</td>
                                    <td>
                                        <button @click="editRequirement(requirement.id)" class="btn btn-success btn-flat btn-xs"><span class="glyphicon glyphicon-pencil"></span></button>&nbsp;
                                        <button @click="deleteRequirement(requirement.id)" class="btn btn-danger btn-flat btn-xs"><span class="glyphicon glyphicon-trash"></span></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <ul class="pagination pagination-sm no-margin pull-right">
                            <li>
                                <a @click="previousRequirement()">«</a>
                            </li>
                            <li>
                                <a>@{{ req_current_page }}</a>
                            </li>
                            <li>
                                <a>of</a>
                            </li>
                            <li>
                                <a>@{{ req_last_page }}</a>
                            </li>
                            <li>
                                <a @click="nextRequirement()">»</a>
                            </li>
                        </ul>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div class="modal fade" id="program-single-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">@{{ modal_title }}</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="program-name">Name</label>
                            <input v-model="program.name" type="text" class="form-control" placeholder="Type Program Name...">
                        </div>
                        <div class="form-group">
                            <label for="program-display-name">Display Name</label>
                            <input v-model="program.display_name" type="text" class="form-control" placeholder="Type Display Name...">
                        </div>
                        <div class="form-group">
                            <label for="program-description">Description</label>
                            <input v-model="program.description" type="text" class="form-control" placeholder="Type Description...">
                        </div>
                    </div>
                    <div class="modal-footer clearfix">
                        <button @click="storeProgram()" class="btn btn-success btn-flat btn-block">@{{ button }} Program</button>
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
                programs: [],
                program: {
                    name: '',
                    display_name: '',
                    description: ''
                },
                links: [],
                current_page: '',
                last_page: '',
                modal_title: '',
                url: '',
                button: '',

                requirements: [],
                requirement: {
                    program_id: '',
                    name: '',
                    description: ''
                },
                req_links: [],
                req_current_page: '',
                req_last_page: '',
                req_url: '',
                req_button: '',
            },
            mounted: function() {
                this.loadPrograms();
            },
            methods: {
                previous() {
                    axios.get(this.links.prev)
                        .then((response) => {
                            this.programs = response.data.data;
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
                            this.programs = response.data.data;
                            this.links = response.data.links;
                            this.current_page = response.data.meta.current_page;
                            this.last_page = response.data.meta.last_page;
                        }).catch((error) => {
                            console.log(error);
                    });
                },
                loadPrograms() {
                    axios.get('/program/view')
                        .then((response) => {
                            this.programs = response.data.data;
                            this.links = response.data.links;
                            this.current_page = response.data.meta.current_page;
                            this.last_page = response.data.meta.last_page;
                        }).catch((error) => {
                            console.log(error);
                    });
                },
                createProgram() {
                    this.url = '/program/store';
                    this.modal_title = 'Create Program';
                    this.button = 'Save';
                    this.program.name = '';
                    this.program.display_name = '';
                    this.program.description = '';

                    $('#program-single-modal').modal('show');
                },
                editProgram(id) {
                    this.modal_title = 'Edit Program';
                    this.url = `/program/${id}/update`;
                    this.button = 'Update';
                    axios.get(`/program/edit/${id}`)
                        .then((response) => {
                            this.program.name = response.data.data.name;
                            this.program.display_name = response.data.data.display_name;
                            this.program.description = response.data.data.description;
                            $('#program-single-modal').modal('show');
                        }).catch((error) => {
                            console.log(error);
                    });
                },
                storeProgram() {
                    axios.post(this.url, this.program)
                        .then((response) => {
                            this.loadPrograms();
                            $('#program-single-modal').modal('hide');
                        }).catch((error) => {
                            console.log(error);
                    });
                },
                deleteProgram(id) {
                    axios.get(`/program/delete/${id}`)
                        .then((response) => {
                            this.loadPrograms();
                            $('#program-single-modal').modal('hide');
                        }).catch((error) => {
                            console.log(error);
                    })
                },
                loadRequirements(id) {
                    axios.get(`/program/${id}/requirements/view`)
                        .then((response) => {
                            this.requirements = response.data.data;
                            this.req_links = response.data.links;
                            this.req_current_page = response.data.meta.current_page;
                            this.req_last_page = response.data.meta.last_page;
                        }).catch((error) => {
                            console.log(error);
                    });
                },
                nextRequirement() {
                    axios.get(this.req_links.next)
                        .then((response) => {
                            this.requirements = response.data.data;
                            this.req_links = response.data.links;
                            this.req_current_page = response.data.meta.current_page;
                            this.req_last_page = response.data.meta.last_page;
                        }).catch((error) => {
                        console.log(error);
                    });
                },
                prevRequirement() {
                    axios.get(this.req_links.prev)
                        .then((response) => {
                            this.requirements = response.data.data;
                            this.req_links = response.data.links;
                            this.req_current_page = response.data.meta.current_page;
                            this.req_last_page = response.data.meta.last_page;
                        }).catch((error) => {
                        console.log(error);
                    });
                },
                viewRequirements(id) {
                    axios.get(`/program/edit/${id}`)
                        .then((response) => {
                            this.loadRequirements(id);
                            this.program.name = response.data.data.name;
                            this.program.display_name = response.data.data.display_name;
                            this.program.description = response.data.data.description;

                            this.req_url = '/program/requirement/store';
                            this.req_button = 'Add';
                            this.requirement.program_id = id;
                            $('#program-modal').modal('show');
                        }).catch((error) => {
                        console.log(error);
                    });
                },
                editRequirement(id) {
                    axios.get(`/program/requirement/${id}/edit`)
                        .then((response) => {
                            this.req_url = `/program/requirement/${id}/update`;
                            this.req_button = 'Update';
                            this.requirement.name = response.data.data.name;
                            this.requirement.description = response.data.data.description;
                        }).catch((error) => {
                            console.log(error);
                    });
                },
                storeRequirement() {
                    axios.post(this.req_url, this.requirement)
                        .then((response) => {
                            if (this.req_button === 'Update') {
                                alert('Requirement Updated');
                                this.req_button = 'Add';
                                this.requirement.name = '';
                                this.requirement.description = '';
                            } else {
                                this.requirement.name = '';
                                this.requirement.description = '';
                                alert('Requirement Added');
                            }

                            this.loadRequirements(this.requirement.program_id);
                        }).catch((error) => {
                            console.log(error);
                    });
                },
                deleteRequirement(id) {
                    axios.get(`/program/requirement/${id}/delete`)
                        .then((response) => {
                            this.loadRequirements(this.requirement.program_id);
                        }).catch((error) => {
                            console.log(error);
                    });
                }
            }
        });
    </script>
@endsection
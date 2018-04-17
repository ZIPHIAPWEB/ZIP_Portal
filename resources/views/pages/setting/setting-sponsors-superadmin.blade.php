@extends('layouts.app')

@section('title', 'Visa Sponsors')

@section('content')
    <div id="app">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-body">
                    <button @click="create()" class="btn btn-primary btn-flat btn-sm m-b-10 pull-right"><span class="glyphicon glyphicon-plus"></span>&nbsp; Create</button>
                    <table id="sponsor-table" class="table table-striped table-bordered">
                        <thead>
                            <th>Name</th>
                            <th>Display Name</th>
                            <th>Description</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <tr v-if="sponsors.length === 0">
                                <td valign="top" colspan="15" class="text-center">No Records</td>
                            </tr>
                            <tr v-else v-for="sponsor in sponsors">
                                <td>@{{ sponsor.name }}</td>
                                <td>@{{ sponsor.display_name }}</td>
                                <td>@{{ sponsor.description }}</td>
                                <td>@{{ sponsor.created_at }}</td>
                                <td>
                                    <button @click="createRequirements(sponsor.id)" class="btn btn-primary btn-flat btn-xs"><span class="glyphicon glyphicon-plus"></span></button>
                                    <button @click="editSponsor(sponsor.id)" class="btn btn-success btn-flat btn-xs"><span class="glyphicon glyphicon-pencil"></span></button>
                                    <button @click="deleteSponsor(sponsor.id)" class="btn btn-danger btn-flat btn-xs"><span class="glyphicon glyphicon-trash"></span></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        <li>
                            <a @click="prev()">«</a>
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

        <div class="modal fade" id="view-requirements-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">@{{ sponsor.name }} Requirements</h4>
                    </div>
                    <div class="modal-body clearfix">
                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input @keyup.enter="storeRequirement()" v-model="requirement.name" type="text" class="form-control" placeholder="Enter Name"/>
                                </div>
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <input @keyup.enter="storeRequirement()" v-model="requirement.description" type="text" class="form-control" placeholder="Enter Description"/>
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

        <div class="modal fade" id="create-sponsor-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">@{{ title }} Sponsor</h4>
                    </div>
                    <div class="modal-body">
                        <form action="">
                            <div class="form-group">
                                <label for="sponsor-name">Name</label>
                                <input @keyup.enter="storeSponsor()" v-model="sponsor.name" type="text" name="sponsor-name" class="form-control" placeholder="Enter Sponsor Name...">
                            </div>
                            <div class="form-group">
                                <label for="sponsor-display-name">Display Name</label>
                                <input @keyup.enter="storeSponsor()" v-model="sponsor.display_name" type="text" name="sponsor-display-name" class="form-control" placeholder="Enter Sponsor Display Name...">
                            </div>
                            <div class="form-group">
                                <label for="sponsor-description">Description</label>
                                <input @keyup.enter="storeSponsor()" v-model="sponsor.description" type="text" name="sponsor-description" class="form-control" placeholder="Enter Sponsor Description...">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer clearfix">
                        <button @click="storeSponsor()" class="btn btn-success btn-flat btn-block">@{{ button }} Sponsor</button>
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

                sponsors: [],
                sponsor: {
                    name: '',
                    display_name: '',
                    description: ''
                },
                url: '',
                links: [],
                current_page: '',
                last_page: '',

                req_button: '',
                requirements: [],
                requirement: {
                    sponsor_id: '',
                    name: '',
                    description: ''
                },
                req_url: '',
                req_links: [],
                req_current_page: 1,
                req_last_page: 1
            },
            mounted: function() {
                this.viewSponsor();
            },
            methods: {
                prev() {
                    axios.get(this.links.prev)
                        .then((response) => {
                            this.sponsors = response.data.data;
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
                            this.sponsors = response.data.data;
                            this.links = response.data.links;
                            this.current_page = response.data.meta.current_page;
                            this.last_page = response.data.meta.last_page;
                        }).catch((error) => {
                            console.log(error);
                    });
                },
                create() {
                    this.url = '/sponsor/store';
                    this.sponsor.name = '';
                    this.sponsor.display_name = '';
                    this.sponsor.description = '';

                    this.title = 'Create';
                    this.button = 'Add';
                    $('#create-sponsor-modal').modal('show');
                },
                viewSponsor() {
                    axios.get('/sponsor/view')
                        .then((response) => {
                            this.sponsors = response.data.data;
                            this.links = response.data.links;
                            this.current_page = response.data.meta.current_page;
                            this.last_page = response.data.meta.last_page;
                        }).catch((error) => {
                            console.log(error);
                    });
                },
                editSponsor(id) {
                    axios.get(`/sponsor/${id}/edit`)
                        .then((response) => {
                            this.url = `/sponsor/${id}/update`;
                            this.sponsor.name = response.data.data.name;
                            this.sponsor.display_name = response.data.data.display_name;
                            this.sponsor.description = response.data.data.description;

                            this.title = 'Edit';
                            this.button = 'Update';
                            $('#create-sponsor-modal').modal('show');
                        }).catch((error) => {
                        console.log(error);
                    });
                },
                storeSponsor() {
                    axios.post(this.url, this.sponsor)
                        .then((response) => {
                            this.viewSponsor();
                            this.sponsor.name = '';
                            this.sponsor.display_name = '';
                            this.sponsor.description = '';

                            $('#create-sponsor-modal').modal('hide');
                        }).catch((error) => {
                            console.log(error);
                    });
                },
                deleteSponsor(id) {
                    axios.get(`/sponsor/${id}/delete`)
                        .then((response) => {
                            this.viewSponsor();
                        }).catch((error) => {
                        console.log(error);
                    });
                },
                createRequirements(id) {
                    axios.get(`/sponsor/${id}/edit`)
                        .then((response) => {
                            this.sponsor.name = response.data.data.name;
                            this.sponsor.display_name = response.data.data.display_name;
                            this.sponsor.description = response.data.data.description;

                            this.req_url = '/sponsor/requirement/store';
                            this.req_button = 'Add';
                            this.requirement.name = '';
                            this.requirement.description = '';
                            this.requirement.sponsor_id = id;
                            this.viewRequirements(id);
                            $('#view-requirements-modal').modal('show');
                        }).catch((error) => {
                            console.log(error);
                    });
                },
                viewRequirements(id) {
                    axios.get(`/sponsor/${id}/requirements/view`)
                        .then((response) => {
                            this.requirements = response.data.data;
                            this.req_links = response.data.links;
                            this.req_current_page = response.data.meta.current_page;
                            this.req_last_page = response.data.meta.last_page;

                        }).catch((error) => {
                            console.log(error);
                    });
                },
                editRequirement(id) {
                    axios.get(`/sponsor/requirement/${id}/edit`)
                        .then((response) => {
                            this.req_url = `/sponsor/requirement/${id}/update`;
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
                            this.req_url = '/sponsor/requirement/store';
                            this.req_button = 'Add';

                            this.requirement.name = '';
                            this.requirement.description = '';
                            this.viewRequirements(this.requirement.sponsor_id);
                        }).catch((error) => {
                        console.log(error);
                    });
                },
                deleteRequirement(id) {
                    axios.get(`/sponsor/requirement/${id}/delete`)
                        .then((response) => {
                            console.log(response);
                            this.viewRequirements(this.requirement.sponsor_id);
                        }).catch((error) => {
                            console.log(error);
                    })
                },
            }
        });
    </script>
@endsection
@extends('layouts.app')

@section('title', 'Visa Sponsors')

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
                        <tbody v-if="hasRecords">
                            <tr v-if="loading.table">
                                <td valign="top" colspan="15" class="text-center">
                                    <span class="fa fa-circle-o-notch fa-spin"></span>
                                </td>
                            </tr>
                            <tr v-else v-for="sponsor in sponsors">
                                <td v-cloak>@{{ sponsor.name }}</td>
                                <td v-cloak>@{{ sponsor.display_name }}</td>
                                <td v-cloak>@{{ sponsor.description }}</td>
                                <td v-cloak>@{{ sponsor.created_at }}</td>
                                <td v-cloak>
                                    <button @click="createRequirements(sponsor.id)" class="btn btn-primary btn-flat btn-xs"><span class="glyphicon glyphicon-plus"></span></button>
                                    <button @click="editSponsor(sponsor.id)" class="btn btn-success btn-flat btn-xs"><span class="glyphicon glyphicon-pencil"></span></button>
                                    <button @click="deleteSponsor(sponsor.id)" class="btn btn-danger btn-flat btn-xs"><span class="glyphicon glyphicon-trash"></span></button>
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
                <div class="box-footer">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        <li>
                            <a @click="prev()">«</a>
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
                                <form enctype="multipart/form-data" @submit.prevent="storeRequirement()">
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input v-model="requirement.name" type="text" class="form-control" placeholder="Enter Name"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Description</label>
                                        <input v-model="requirement.description" type="text" class="form-control" placeholder="Enter Description"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="">File (Optional)</label>
                                        <input type="file" ref="file" @change="handleFileUpload">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-flat btn-block btn-sm pull-right m-b-10">@{{ req_button }}</button>
                                </form>
                            </div>
                        </div>
                        <table id="program-single-table" class="table table-striped table-bordered table-condensed">
                            <thead>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Path</th>
                            <th>Action</th>
                            </thead>
                            <tbody>
                            <tr v-if="requirements.length === 0">
                                <td valign="top" colspan="15" class="text-center">No Records</td>
                            </tr>
                            <tr v-else v-for="requirement in requirements">
                                <td v-cloak>@{{ requirement.name }}</td>
                                <td v-cloak>@{{ requirement.description }}</td>
                                <td v-cloak>@{{ requirement.path }}</td>
                                <td v-cloak>
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
                                <a v-cloak>@{{ req_current_page }}</a>
                            </li>
                            <li>
                                <a>of</a>
                            </li>
                            <li>
                                <a v-cloak>@{{ req_last_page }}</a>
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
                    description: '',
                    file: ''
                },
                req_url: '',
                req_links: [],
                req_current_page: 1,
                req_last_page: 1,
                loading: {
                    table: false
                },
                hasRecords: true
            },
            mounted: function() {
                this.loadSponsor();
            },
            methods: {
                prev() {
                    this.loading.table = true;
                    axios.get(this.links.prev)
                        .then((response) => {
                            this.loading.table = false;
                            if (response.data.data.length > 0) {
                                this.hasRecords = true;
                                this.sponsors = response.data.data;
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
                                this.sponsors = response.data.data;
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
                create() {
                    this.url = '/sponsor/store';
                    this.sponsor.name = '';
                    this.sponsor.display_name = '';
                    this.sponsor.description = '';

                    this.title = 'Create';
                    this.button = 'Add';
                    $('#create-sponsor-modal').modal('show');
                },
                loadSponsor() {
                    this.loading.table = true;
                    axios.get('/sponsor/view')
                        .then((response) => {
                            this.loading.table = false;
                            if (response.data.data.length > 0) {
                                this.hasRecords = true;
                                this.sponsors = response.data.data;
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
                            this.loadSponsor();
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
                            this.loadSponsor();
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

                            this.req_url = '/visa/store';
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
                    axios.get(`/visa/view`, {
                        params: {
                            sponsor_id: id
                        }
                    })
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
                    axios.get(`/visa/edit`, {
                        params: {
                            id: id
                        }
                    })
                        .then((response) => {
                            this.req_url = `/visa/update?id=${id}`;
                            this.req_button = 'Update';

                            this.requirement.name = response.data.data.name;
                            this.requirement.description = response.data.data.description;
                        }).catch((error) => {
                            console.log(error);
                    });
                },
                storeRequirement() {
                    let formData = new FormData();
                        formData.append('sponsor_id', this.requirement.sponsor_id);
                        formData.append('name', this.requirement.name);
                        formData.append('description', this.requirement.description);
                        formData.append('file', this.requirement.file);
                    axios.post(this.req_url, formData, {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        })
                        .then((response) => {
                            this.req_button = 'Add';
                            this.requirement.name = '';
                            this.requirement.description = '';

                            this.viewRequirements(this.requirement.sponsor_id);
                        }).catch((error) => {
                        console.log(error);
                    });
                },
                deleteRequirement(id) {
                    axios.post(`/visa/delete`, {
                        id: id
                    })
                        .then((response) => {
                            console.log(response);
                            this.viewRequirements(this.requirement.sponsor_id);
                        }).catch((error) => {
                            console.log(error);
                    })
                },
                handleFileUpload() {
                    this.requirement.file = this.$refs.file.files[0];
                }
            }
        });
    </script>
@endsection
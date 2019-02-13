@extends('layouts.app')

@section('title', 'Program Setting')

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
                        <tbody v-if="hasRecords.table">
                            <tr v-if="loading.table">
                                <td valign="top" colspan="15" class="text-center">
                                    <span class="fa fa-circle-o-notch fa-spin"></span>
                                </td>
                            </tr>
                            <tr v-else v-for="program in programs">
                                <td v-cloak>@{{ program.name }}</td>
                                <td v-cloak>@{{ program.display_name }}</td>
                                <td v-cloak>@{{ program.description }}</td>
                                <td v-cloak>
                                    <button @click="viewRequirements(program.id)" class="btn btn-primary btn-flat btn-xs" data="add"><span class="glyphicon glyphicon-plus"></span></button>&nbsp;
                                    <button @click="editProgram(program.id)" class="btn btn-success btn-flat btn-xs" data="edit"><span class="glyphicon glyphicon-pencil"></span></button>&nbsp;
                                    <button @click="deleteProgram(program.id)" class="btn btn-danger btn-flat btn-xs" data="delete"><span class="glyphicon glyphicon-trash"></span></button>
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

        <div class="modal fade" id="program-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" v-cloak>@{{ program.display_name }} Requirements</h4>
                    </div>
                    <div class="modal-body">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab_1" data-toggle="tab" aria-expanded="true">Preliminary</a>
                                </li>
                                <li class="">
                                    <a href="#tab_2" data-toggle="tab" aria-expanded="false">Additional</a>
                                </li>
                                <li class="">
                                    <a href="#tab_3" data-toggle="tab" aria-expanded="false">Payment</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane clearfix active" id="tab_1">
                                    <div class="box box-primary">
                                        <div class="box-body">
                                            <form enctype="multipart/form-data" @submit.prevent="storePreliminaryRequirement()">
                                                <div class="form-group">
                                                    <label for="">Name</label>
                                                    <input @keyup.enter="storePreliminaryRequirement()" v-model="requirement.name" type="text" class="form-control" placeholder="Enter Name"/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Description</label>
                                                    <input @keyup.enter="storePreliminaryRequirement()" v-model="requirement.description" type="text" class="form-control" placeholder="Enter Description"/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">File (optional)</label>
                                                    <input type="file" ref="file" @change="handleFileUpload">
                                                </div>
                                                <button class="btn btn-primary btn-flat btn-block btn-sm pull-right m-b-10">@{{ req_button }}</button>
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
                                            <tr v-if="preliminary.length === 0">
                                                <td valign="top" colspan="15" class="text-center">No Records</td>
                                            </tr>
                                            <tr v-else v-for="requirement in preliminary.data">
                                                <td v-cloak>@{{ requirement.name }}</td>
                                                <td v-cloak>@{{ requirement.description }}</td>
                                                <td v-cloak>@{{ requirement.path }}</td>
                                                <td v-cloak>
                                                    <button @click="editPreliminaryRequirement(requirement.id)" class="btn btn-success btn-flat btn-xs"><span class="glyphicon glyphicon-pencil"></span></button>&nbsp;
                                                    <button @click="deletePreliminaryRequirement(requirement.id)" class="btn btn-danger btn-flat btn-xs"><span class="glyphicon glyphicon-trash"></span></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane clearfix" id="tab_2">
                                    <div class="box box-primary">
                                        <div class="box-body">
                                            <form enctype="multipart/form-data" @submit.prevent="storeAdditionalRequirement()">
                                                <div class="form-group">
                                                    <label for="">Name</label>
                                                    <input @keyup.enter="storeAdditionalRequirement()" v-model="requirement.name" type="text" class="form-control" placeholder="Enter Name"/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Description</label>
                                                    <input @keyup.enter="storeAdditionalRequirement()" v-model="requirement.description" type="text" class="form-control" placeholder="Enter Description"/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">File (optional)</label>
                                                    <input type="file" ref="file" @change="handleFileUpload">
                                                </div>
                                                <button class="btn btn-primary btn-flat btn-block btn-sm pull-right m-b-10">@{{ req_button }}</button>
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
                                        <tr v-if="additional.length === 0">
                                            <td valign="top" colspan="15" class="text-center">No Records</td>
                                        </tr>
                                        <tr v-else v-for="requirement in additional.data">
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
                                </div>

                                <div class="tab-pane clearfix" id="tab_3">
                                    <div class="box box-primary">
                                        <div class="box-body">
                                            <form enctype="multipart/form-data" @submit.prevent="storePaymentRequirement()">
                                                <div class="form-group">
                                                    <label for="">Name</label>
                                                    <input @keyup.enter="storePaymentRequirement()" v-model="requirement.name" type="text" class="form-control" placeholder="Enter Name"/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Description</label>
                                                    <input @keyup.enter="storePaymentRequirement" v-model="requirement.description" type="text" class="form-control" placeholder="Enter Description"/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">File (optional)</label>
                                                    <input type="file" ref="file" @change="handleFileUpload">
                                                </div>
                                                <button class="btn btn-primary btn-flat btn-block btn-sm pull-right m-b-10">@{{ req_button }}</button>
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
                                        <tr v-if="additional.length === 0">
                                            <td valign="top" colspan="15" class="text-center">No Records</td>
                                        </tr>
                                        <tr v-else v-for="requirement in payments.data">
                                            <td v-cloak>@{{ requirement.name }}</td>
                                            <td v-cloak>@{{ requirement.description }}</td>
                                            <td v-cloak>@{{ requirement.path }}</td>
                                            <td v-cloak>
                                                <button @click="editPaymentRequirement(requirement.id)" class="btn btn-success btn-flat btn-xs"><span class="glyphicon glyphicon-pencil"></span></button>&nbsp;
                                                <button @click="deletePaymentRequirement(requirement.id)" class="btn btn-danger btn-flat btn-xs"><span class="glyphicon glyphicon-trash"></span></button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
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
                            <input @keyup.enter="storeProgram()" v-model="program.name" type="text" class="form-control" placeholder="Type Program Name...">
                        </div>
                        <div class="form-group">
                            <label for="program-display-name">Display Name</label>
                            <input @keyup.enter="storeProgram()" v-model="program.display_name" type="text" class="form-control" placeholder="Type Display Name...">
                        </div>
                        <div class="form-group">
                            <label for="program-description">Description</label>
                            <input @keyup.enter="storeProgram()" v-model="program.description" type="text" class="form-control" placeholder="Type Description...">
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

                preliminary: [],
                visa: [],
                additional: [],
                requirement: {
                    program_id: '',
                    name: '',
                    description: '',
                    file: ''
                },
                prelim_url: '/preliminary/store',
                add_url: '/additional/store',
                pay_url: '/payment/store',
                req_button: '',

                payments: [],
                payment: {
                    program_id: '',
                    name: '',
                    description: '',
                },
                payment_links: [],
                payment_current_page: '',
                payment_last_page: '',
                payment_url: '',
                payment_button: '',
                loading: {
                    table: false
                },
                hasRecords: {
                    table : true
                }
            },
            mounted: function() {
                this.loadPrograms();
            },
            methods: {
                viewAllRequirement(programId) {
                    this.loadPreliminaryRequirement(programId);
                    this.loadAdditionalRequirement(programId);
                    this.loadPaymentRequirement(programId);
                },
                // Program CRUD
                previous() {
                    this.loading.table = true;
                    axios.get(this.links.prev)
                        .then((response) => {
                            this.loading.table = false;
                            if (response.data.data.length > 0) {
                                this.hasRecords.table = true;
                                this.programs = response.data.data;
                                this.links = response.data.links;
                                this.current_page = response.data.meta.current_page;
                                this.last_page = response.data.meta.last_page;
                            } else {
                                this.hasRecords.table = false;
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
                                this.hasRecords.table = true;
                                this.programs = response.data.data;
                                this.links = response.data.links;
                                this.current_page = response.data.meta.current_page;
                                this.last_page = response.data.meta.last_page;
                            } else {
                                this.hasRecords.table = false;
                            }
                        }).catch((error) => {
                            console.log(error);
                    });
                },
                loadPrograms() {
                    this.loading.table = true;
                    axios.get('/program/view')
                        .then((response) => {
                            this.loading.table = false;
                            if (response.data.data.length > 0) {
                                this.hasRecords.table = true;
                                this.programs = response.data.data;
                                this.links = response.data.links;
                                this.current_page = response.data.meta.current_page;
                                this.last_page = response.data.meta.last_page;
                            } else {
                                this.hasRecords.table = false;
                            }
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
                //Requirements CRUD
                loadPreliminaryRequirement(program_id) {
                    axios.get('/preliminary/view', {
                        params: {
                            program_id: program_id
                        }
                    })
                        .then((response) => {
                            this.preliminary = response.data;
                        })
                },
                editPreliminaryRequirement(id) {
                    axios.get('/preliminary/edit', {
                        params: {
                            id: id
                        }
                    })
                        .then((response) => {
                            this.prelim_url = `/preliminary/update?id=${id}`;
                            this.req_button = 'Update';
                            this.requirement.name = response.data.data.name;
                            this.requirement.description = response.data.data.description;
                        })
                },
                storePreliminaryRequirement() {
                    let formData = new FormData();
                    formData.append('program_id', this.requirement.program_id);
                    formData.append('name', this.requirement.name);
                    formData.append('description', this.requirement.description);
                    formData.append('file', this.requirement.file);
                    axios.post(this.prelim_url, formData)
                        .then((response) => {
                            alert(response.data.message);
                            this.requirement.name = '';
                            this.requirement.description = '';
                            this.prelim_url = '/preliminary/store';
                            this.req_button = 'Add';
                            this.loadPreliminaryRequirement(this.requirement.program_id);
                        });
                },
                deletePreliminaryRequirement(id) {
                    axios.post('/preliminary/delete', {
                        id: id
                    })
                        .then((response) => {
                            alert(response.data.message);
                            this.loadPreliminaryRequirement(this.requirement.program_id);
                        })
                },
                loadAdditionalRequirement(program_id) {
                    axios.get('/additional/view', {
                        params: {
                            program_id
                        }
                    })
                        .then((response) => {
                            this.additional = response.data;
                        })
                },
                editAdditionalRequirement(id) {
                    axios.get('/additional/edit', {
                        params: {
                            id: id
                        }
                    })
                        .then((response) => {
                            this.add_url = `/additional/update?id=${id}`;
                            this.req_button = 'Update';
                            this.requirement.name = response.data.data.name;
                            this.requirement.description = response.data.data.description;
                        });
                },
                storeAdditionalRequirement() {
                    let formData = new FormData();
                    formData.append('program_id', this.requirement.program_id);
                    formData.append('name', this.requirement.name);
                    formData.append('description', this.requirement.description);
                    formData.append('file', this.requirement.file);
                    axios.post(this.add_url, formData)
                        .then((response) => {
                            alert(response.data.message);
                            this.requirement.name = '';
                            this.requirement.description = '';
                            this.add_url = '/additional/store';
                            this.req_button = 'Add';
                            this.loadAdditionalRequirement(this.requirement.program_id);
                        })
                },
                deleteAdditionalRequirement(id) {
                    axios.post('/additional/delete', {
                        id:id
                    })
                        .then((response) => {
                            alert(response.data.message);
                            this.loadAdditionalRequirement(this.requirement.program_id);
                        })
                },
                loadPaymentRequirement(program_id) {
                    axios.get('/payment/view', {
                        params: {
                            program_id
                        }
                    })
                        .then((response) => {
                            this.payments = response.data;
                        })
                },
                editPaymentRequirement(id) {
                    axios.get('/payment/edit', {
                        params: {
                            id: id
                        }
                    })
                        .then((response) => {
                            this.pay_url = `/payment/update?id=${id}`;
                            this.req_button = 'Update';
                            this.requirement.name = response.data.data.name;
                            this.requirement.description = response.data.data.description;
                        })
                },
                storePaymentRequirement() {
                    let formData = new FormData();
                    formData.append('program_id', this.requirement.program_id);
                    formData.append('name', this.requirement.name);
                    formData.append('description', this.requirement.description);
                    axios.post(this.pay_url, formData)
                        .then((response) => {
                            alert(response.data.message);
                            this.requirement.name = '';
                            this.requirement.description = '';
                            this.pay_url = '/payment/store';
                            this.req_button = 'Add';
                            this.loadPaymentRequirement(this.requirement.program_id);
                        })
                },
                deletePaymentRequirement() {
                    axios.post('/payment/delete', {
                        id: id
                    })
                        .then((response) => {
                            alert(response.data.message);
                            this.loadPaymentRequirement(this.requirement.program_id);
                        })
                },
                viewRequirements(id) {
                    axios.get(`/program/edit/${id}`)
                        .then((response) => {
                            this.viewAllRequirement(id);
                            this.program.name = response.data.data.name;
                            this.program.display_name = response.data.data.display_name;
                            this.program.description = response.data.data.description;
                            this.req_button = 'Add';
                            this.requirement.program_id = id;
                            $('#program-modal').modal('show');
                        }).catch((error) => {
                        console.log(error);
                    });
                },
                handleFileUpload() {
                    this.requirement.file = this.$refs.file.files[0];
                },
                //Payment CRUD
                loadPayments(id) {
                    axios.get(`/program/${id}/payments/view`)
                        .then((response) => {
                            this.payments = response.data.data;
                            this.payment_links = response.data.links;
                            this.payment_current_page = response.data.meta.current_page;
                            this.payment_last_page = response.data.meta.last_page;
                        }).catch((error) => {
                        console.log(error);
                    });
                },
                nextPayment() {
                    axios.get(this.payment_links.next)
                        .then((response) => {
                            this.payments = response.data.data;
                            this.payment_links = response.data.links;
                            this.payment_current_page = response.data.meta.current_page;
                            this.payment_last_page = response.data.meta.last_page;
                        }).catch((error) => {
                        console.log(error);
                    });
                },
                prevPayment() {
                    axios.get(this.payment_links.prev)
                        .then((response) => {
                            this.payments = response.data.data;
                            this.payment_links = response.data.links;
                            this.payment_current_page = response.data.meta.current_page;
                            this.payment_last_page = response.data.meta.last_page;
                        }).catch((error) => {
                        console.log(error);
                    });
                },
                viewPayments(id) {
                    axios.get(`/program/edit/${id}`)
                        .then((response) => {
                            this.loadPayments(id);
                            this.program.name = response.data.data.name;
                            this.program.display_name = response.data.data.display_name;
                            this.program.description = response.data.data.description;

                            this.payment_url = '/program/payment/store';
                            this.payment_button = 'Add';
                            this.payment.program_id = id;
                            $('#program-modal').modal('show');
                        }).catch((error) => {
                        console.log(error);
                    });
                },
                editPayment(id) {
                    axios.get(`/program/payment/${id}/edit`)
                        .then((response) => {
                            this.payment_url = `/program/payment/${id}/update`;
                            this.payment_button = 'Update';
                            this.payment.name = response.data.data.name;
                            this.payment.description = response.data.data.description;
                        }).catch((error) => {
                        console.log(error);
                    });
                },
                storePayment() {
                    axios.post(this.payment_url, this.payment)
                        .then((response) => {
                            if (this.payment_button === 'Update') {
                                alert('Requirement Updated');
                                this.payment_button = 'Add';
                                this.payment.name = '';
                                this.payment.description = '';
                            } else {
                                this.payment.name = '';
                                this.payment.description = '';
                                alert('Requirement Added');
                            }

                            this.loadPayments(this.payment.program_id);
                        }).catch((error) => {
                        console.log(error);
                    });
                },
                deletePayment(id) {
                    axios.get(`/program/payment/${id}/delete`)
                        .then((response) => {
                            this.loadPayments(this.payment.program_id);
                        }).catch((error) => {
                        console.log(error);
                    });
                }
            }
        });
    </script>
@endsection
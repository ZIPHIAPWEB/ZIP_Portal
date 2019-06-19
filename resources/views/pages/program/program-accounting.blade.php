@extends('layouts.app')

@section('title', \App\Program::find($program)->name . ' Program')

@section('sidenav')
    <li class="header">General</li>
    <li>
        <a href="{{ route('dash.admin') }}">
            <i class="fa fa-dashboard"></i> <span><small>Dashboard</small></span>
        </a>
    </li>
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
            <li v-for="program in programs">
                <a :href="url + program.id">
                    <i class="fa fa-circle-o"></i>
                    <small>@{{ program.name }}</small>
                </a>
            </li>
        </ul>
    </li>
@endsection

@section('content')
    <div id="app">
        <div class="col-sm-12">
            <div class="box box-primary">
                <div class="box-header box-border">
                    <h3 class="box-title text-center">{{ \App\Program::find($program)->name }} Students</h3>
                    <div class="pull-right">
                        <button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-refresh"></span> Refresh</button>
                    </div>
                </div>
                <div class="box-body">
                    <form action="" class="form-inline pull-left m-b-10">
                        <div class="form-group">
                            <label for="" class="control-label">From Date:</label>
                            <input type="date" class="form-control input-sm">
                        </div>&nbsp;
                        <div class="form-group">
                            <label for="" class="control-label">To Date:</label>
                            <input type="date" class="form-control input-sm">
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Filter by Program</label>
                            <select name="" id="" class="form-control input-sm">
                                <option value="" selected>All</option>
                                <option value="New Applicant">New Applicant</option>
                                <option value="Assessed">Assessed</option>
                                <option value="Confirmed">Confirmed</option>
                                <option value="Hired">Hired</option>
                                <option value="For Visa Interview">For Visa Interview</option>
                                <option value="For PDOS & CFO">For PDOS & CFO</option>
                                <option value="Program Proper">Program Proper</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">Filter by Branch</label>
                            <select name="" id="" class="form-control input-sm">
                                <option value="">All</option>
                                <option value="MANILA">Manila</option>
                                <option value="PAMPANGA">Pampanga</option>
                                <option value="CEBU">Cebu</option>
                                <option value="BACOLOD">Bacolod</option>
                                <option value="DAVAO">Davao</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-flat btn-sm"><span class="glyphicon glyphicon-filter"></span>Filter</button>
                        </div>
                    </form>
                    <div class="form-group-sm pull-right">
                        <input v-model="filterName" type="text" class="form-control" placeholder="Search By Last Name">
                    </div>
                    <table class="table table-bordered table-striped table-condensed">
                        <thead>
                            <th class="text-center" style="width: 10%">Date of Application</th>
                            <th class="text-center" style="width: 10%">Status</th>
                            <th class="text-center" style="width: 10%">Application ID</th>
                            <th class="text-center" style="width: 10%">First Name</th>
                            <th class="text-center" style="width: 10%">Middle Name</th>
                            <th class="text-center" style="width: 10%">Last Name</th>
                            <th class="text-center" style="width: 10%">School</th>
                            <th class="text-center" style="width: 10%">Branch</th>
                            <th class="text-center" style="width: 10%">Program</th>
                            <th class="text-center" style="width: auto">1st Pay</th>
                            <th class="text-center" style="width: auto">2nd Pay</th>
                            <th class="text-center" style="width: auto">3rd Pay</th>
                            <th class="text-center" style="width: auto">4th Pay</th>
                            <th class="text-center" style="width: 10%">Action</th>
                        </thead>
                        <tbody>
                            <tr v-for="student in students">
                                <td class="text-sm text-center">@{{ student.created_at }}</td>
                                <td class="text-sm text-center"><span class="label label-warning label-sm">@{{ student.application_status }}</span></td>
                                <td class="text-sm text-center">@{{ student.application_id }}</td>
                                <td class="text-sm text-center">@{{ student.first_name }}</td>
                                <td class="text-sm text-center">@{{ student.middle_name }}</td>
                                <td class="text-sm text-center">@{{ student.last_name }}</td>
                                <td class="text-sm text-center">@{{ student.tertiary.school.name }}</td>
                                <td class="text-sm text-center">@{{ student.branch }}</td>
                                <td class="text-sm text-center">@{{ student.program.name }}</td>
                                <td class="text-sm text-center" v-for="payment in student.payment">
                                    <span v-if="payment.student_payment.status" class="fa fa-check text-green"></span>
                                    <span v-else class="fa fa-remove text-red"></span>
                                </td>
                                <td class="text-sm text-center">
                                    <button @click="viewPayments(student.user_id)" class="btn btn-primary btn-flat btn-xs">View</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal fade" id="payment-modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                                <th class="text-center" style="width: 10%">Requirement</th>
                                <th class="text-center" style="width: 10%">Bank Code</th>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let programId = {{ $program }}
        const sidenav = new Vue({
            el: '#sidenav',
            data: {
                url: '/portal/ac/program-acc/',
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
            mounted: function () {
                this.loadStudents();
            },
            methods: {
                loadStudents() {
                    axios.get(`/acc/program/${programId}`)
                        .then((response) => {
                            this.students = response.data;
                            console.log(response.data);
                        })
                },
                viewPayments($userId) {
                    alert($userId);
                    $('#payment-modal').modal('show');
                }
            }
        })
    </script>
@endsection
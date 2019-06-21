@extends('layouts.app')

@section('title', 'Dashboard')

@section('sidenav')
    <li class="header">General</li>
    <li>
        <a href="{{ route('dash.accounting') }}">
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
    <div id="app" v-cloak>
        <div class="col-xs 12">
            <div class="container">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Statistic Summary of {{ date('Y') }}</h3>
                        <div class="pull-right">
                            <select v-model="summaryFilter" class="form-control input-sm">
                                <option value="All">All</option>
                                <option value="SWT - Spring">Summer Work and Travel - Spring</option>
                                <option value="SWT - Summer">Summer Work and Travel - Summer</option>
                                <option value="Career Training">Career Training</option>
                                <option value="Internship">Internship</option>
                            </select>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="progress-group">
                                    <span class="progress-text">New Applicant</span>
                                    <span class="progress-number">@{{ summary.newApplicant }}/@{{ totalStudents }}</span>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-success" :style="{ width: summary.newApplicant / totalStudents * 100 + '%' }"></div>
                                    </div>
                                </div>
                                <div class="progress-group">
                                    <span class="progress-text">Confirmed</span>
                                    <span class="progress-number">@{{ summary.confirmed }}/@{{ totalStudents }}</span>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-danger" :style="{ width: summary.confirmed / totalStudents * 100 + '%' }"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="progress-group">
                                    <span class="progress-text">Assessed</span>
                                    <span class="progress-number">@{{ summary.assessed }}/@{{ totalStudents }}</span>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-aqua" :style="{ width: summary.assessed / totalStudents * 100 + '%' }"></div>
                                    </div>
                                </div>
                                <div class="progress-group">
                                    <span class="progress-text">Hired</span>
                                    <span class="progress-number">@{{ summary.hired }}/@{{ totalStudents }}</span>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-warning" :style="{ width: summary.hired / totalStudents * 100 + '%' }"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="progress-group">
                                    <span class="progress-text">For Visa Interview</span>
                                    <span class="progress-number">@{{ summary.forVisaInterview }}/@{{ totalStudents }}</span>
                                    <div class="progress active">
                                        <div class="progress-bar progress-bar-aqua progress-bar-striped" :style="{ width: summary.forVisaInterview / totalStudents * 100 + '%' }"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="progress-group">
                                    <span class="progress-text">Visa Approved</span>
                                    <span class="progress-number">@{{ summary.visaApproved }}/@{{ totalStudents }}</span>
                                    <div class="progress active">
                                        <div class="progress-bar progress-bar-yellow progress-bar-striped" :style="{ width: summary.visaApproved / totalStudents * 100 + '%' }"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="progress-group">
                                    <span class="progress-text">Visa Denied</span>
                                    <span class="progress-number">@{{ summary.visaDenied }}/@{{ totalStudents }}</span>
                                    <div class="progress active">
                                        <div class="progress-bar progress-bar-success progress-bar-striped" :style="{ width: summary.visaDenied / totalStudents * 100 + '%' }"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let program_id = 'Test';

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
                totalStudents: 0,
                summary: {
                    newApplicant: 0,
                    assessed: 0,
                    confirmed: 0,
                    hired: 0,
                    forVisaInterview: 0,
                    visaApproved: 0,
                    visaDenied: 0
                },
                summaryFilter: ''
            },
            watch: {
                summaryFilter: function (value) {
                    this.TotalApplicants(value);
                    this.CountApplicants('New Applicant', value);
                    this.CountApplicants('Assessed', value);
                    this.CountApplicants('Confirmed', value);
                    this.CountApplicants('Hired', value);
                    this.CountApplicants('For Visa Interview', value);
                    this.CountApplicants('Approved', value);
                    this.CountApplicants('Denied', value);
                }
            },
            mounted () {
                this.summaryFilter = 'All';
            },
            methods: {
                TotalApplicants (program) {
                    axios.get(`/helper/applicant/${program}`)
                        .then((response) => {
                            this.totalStudents = response.data;
                        })
                },
                CountApplicants (status, program) {
                    axios.get(`/helper/${status}/${program}`)
                        .then((response) => {
                            switch (status) {
                                case 'New Applicant':
                                    this.summary.newApplicant = response.data;
                                    break;
                                case 'Assessed':
                                    this.summary.assessed = response.data;
                                    break;
                                case 'Confirmed':
                                    this.summary.confirmed = response.data;
                                    break;
                                case 'Hired':
                                    this.summary.hired = response.data;
                                    break;
                                case 'For Visa Interview':
                                    this.summary.forVisaInterview = response.data;
                                    break;
                                case 'Approved':
                                    this.summary.visaApproved = response.data;
                                    break;
                                case 'Denied':
                                    this.summary.visaDenied = response.data;
                                    break;
                            }
                        })
                }
            }
        })
    </script>
@endsection
@extends('layouts.app')

@section('title', 'Dashboard')

@section('sidenav')
    <li class="header">General</li>
    <li>
        <a href="{{ route('dash.coordinator') }}">
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
            <li v-for="program in programs"><a :href="url + program.id"><i class="fa fa-circle-o"></i><small>@{{ program.name }}</small></a></li>
        </ul>
    </li>
@endsection

@section('content')
    <div id="app" v-cloak>
        <div class="col-xs-12">
            <div class="container">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Summary Details</h3>
                        <a @click="refresh()" href="#" class="pull-right"><span class="glyphicon glyphicon-refresh"></span></a>
                    </div>
                    <div class="box-body">
                        <div class="col-xs-4">
                            <label class="control-label">Applicant</label>
                            <div class="col-xs-12">
                                <label for="">New Applicant:</label> @{{ newApplicant }} <br>
                                <label for="">Assessed:</label> @{{ assessed }} <br>
                                <label for="">Confirmed:</label> @{{ confirmed }} <br>
                                <label for="">Hired:</label> @{{ hired }} <br>
                                <label for="">Denied:</label> @{{ denied }} <br>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <label for="" class="control-label">Visa</label>
                            <div class="col-xs-12">
                                <label for="">Approved:</label> @{{ visaApproved }} <br>
                                <label for="">Denied:</label> @{{ visaDenied }} <br>
                                <label for="">For Visa Interview:</label> @{{ visaInterview }} <br>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <label for="" class="control-label">Program</label>
                            <div class="col-xs-12">
                                <label for="">Summer Work and Travel - Spring:</label> @{{ swtSpring }}<br>
                                <label for="">Summer Work and Travel - Summer:</label> @{{ swtSummer }} <br>
                                <label for="">Internship:</label> @{{ internship }} <br>
                                <label for="">Career Training:</label> @{{ careerTraining }} <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="container">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Summer Work and Travel - Spring Details</h3>
                        <a @click="refresh('Summer Work and Travel - Spring')" href="#" class="pull-right"><span class="glyphicon glyphicon-refresh"></span></a>
                    </div>
                    <div class="box-body">
                        <div class="col-xs-6">
                            <label class="control-label">Applicant</label>
                            <div class="col-xs-12">
                                <label for="">New Applicant:</label> @{{ spring.newApplicant }} <br>
                                <label for="">Assessed:</label> @{{ spring.assessed }} <br>
                                <label for="">Confirmed:</label> @{{ spring.confirmed }} <br>
                                <label for="">Hired:</label> @{{ spring.hired }} <br>
                                <label for="">Denied:</label> @{{ spring.canceled }} <br>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <label for="" class="control-label">Visa</label>
                            <div class="col-xs-12">
                                <label for="">Approved:</label> @{{ spring.visaApproved }} <br>
                                <label for="">Denied:</label> @{{ spring.visaDenied }} <br>
                                <label for="">For Visa Interview:</label> @{{ spring.visaInterview }} <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="container">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Summer Work and Travel - Summer Details</h3>
                        <a @click="refresh('Summer Work and Travel - Summer')" href="#" class="pull-right"><span class="glyphicon glyphicon-refresh"></span></a>
                    </div>
                    <div class="box-body">
                        <div class="col-xs-6">
                            <label class="control-label">Applicant</label>
                            <div class="col-xs-12">
                                <label for="">New Applicant:</label> @{{ summer.newApplicant }} <br>
                                <label for="">Assessed:</label> @{{ summer.assessed }} <br>
                                <label for="">Confirmed:</label> @{{ summer.confirmed }} <br>
                                <label for="">Hired:</label> @{{ summer.hired }} <br>
                                <label for="">Denied:</label> @{{ summer.canceled }} <br>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <label for="" class="control-label">Visa</label>
                            <div class="col-xs-12">
                                <label for="">Approved:</label> @{{ summer.visaApproved }} <br>
                                <label for="">Denied:</label> @{{ summer.visaDenied }} <br>
                                <label for="">For Visa Interview:</label> @{{ summer.visaInterview }} <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="container">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Internship Details</h3>
                        <a @click="refresh('Internship')" href="#" class="pull-right"><span class="glyphicon glyphicon-refresh"></span></a>
                    </div>
                    <div class="box-body">
                        <div class="col-xs-6">
                            <label class="control-label">Applicant</label>
                            <div class="col-xs-12">
                                <label for="">New Applicant:</label> @{{ intern.newApplicant }} <br>
                                <label for="">Assessed:</label> @{{ intern.assessed }} <br>
                                <label for="">Confirmed:</label> @{{ intern.confirmed }} <br>
                                <label for="">Hired:</label> @{{ intern.hired }} <br>
                                <label for="">Denied:</label> @{{ intern.canceled }} <br>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <label for="" class="control-label">Visa</label>
                            <div class="col-xs-12">
                                <label for="">Approved:</label> @{{ intern.visaApproved }} <br>
                                <label for="">Denied:</label> @{{ intern.visaDenied }} <br>
                                <label for="">For Visa Interview:</label> @{{ intern.visaInterview }} <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="container">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">Career Training Details</h3>
                        <a @click="refresh('Career Training')" href="#" class="pull-right"><span class="glyphicon glyphicon-refresh"></span></a>
                    </div>
                    <div class="box-body">
                        <div class="col-xs-6">
                            <label class="control-label">Applicant</label>
                            <div class="col-xs-12">
                                <label for="">New Applicant:</label> @{{ career.newApplicant }} <br>
                                <label for="">Assessed:</label> @{{ career.assessed }} <br>
                                <label for="">Confirmed:</label> @{{ career.confirmed }} <br>
                                <label for="">Hired:</label> @{{ career.hired }} <br>
                                <label for="">Denied:</label> @{{ career.canceled }} <br>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <label for="" class="control-label">Visa</label>
                            <div class="col-xs-12">
                                <label for="">Approved:</label> @{{ career.visaApproved }} <br>
                                <label for="">Denied:</label> @{{ career.visaDenied }} <br>
                                <label for="">For Visa Interview:</label> @{{ career.visaInterview }} <br>
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
                newApplicant: 0,
                assessed: 0,
                confirmed: 0,
                hired: 0,
                canceled: 0,

                visaApproved: 0,
                visaDenied: 0,
                visaInterview: 0,

                swtSpring: 0,
                swtSummer: 0,
                internship: 0,
                careerTraining: 0,

                summer: {
                    newApplicant: 0,
                    assessed: 0,
                    confirmed: 0,
                    hired: 0,
                    canceled: 0,
                    visaApproved: 0,
                    visaDenied: 0,
                    visaInterview: 0
                },
                spring: {
                    newApplicant: 0,
                    assessed: 0,
                    confirmed: 0,
                    hired: 0,
                    canceled: 0,
                    visaApproved: 0,
                    visaDenied: 0,
                    visaInterview: 0
                },
                career: {
                    newApplicant: 0,
                    assessed: 0,
                    confirmed: 0,
                    hired: 0,
                    canceled: 0,
                    visaApproved: 0,
                    visaDenied: 0,
                    visaInterview: 0
                },
                intern: {
                    newApplicant: 0,
                    assessed: 0,
                    confirmed: 0,
                    hired: 0,
                    canceled: 0,
                    visaApproved: 0,
                    visaDenied: 0,
                    visaInterview: 0
                }
            },
            mounted: function() {
                let program = ['', 'Summer Work and Travel - Summer', 'Summer Work and Travel - Spring', 'Internship', 'Career Training'];
                console.log(program[0]);
                for (let i = 0; i < program.length; i++) {
                    this.applicantCount('New Applicant', program[i]);
                    this.applicantCount('Assessed', program[i]);
                    this.applicantCount('Confirmed', program[i]);
                    this.applicantCount('Hired', program[i]);
                    this.applicantCount('Denied', program[i]);

                    this.visaCount('Approved', program[i]);
                    this.visaCount('Denied', program[i]);
                    this.applicantCount('For Visa Interview', program[i]);
                }

                this.programCount(5);
                this.programCount(9);
                this.programCount(7);
                this.programCount(8);
            },
            methods: {
                refresh(program) {
                    this.applicantCount('New Applicant', program);
                    this.applicantCount('Assessed', program);
                    this.applicantCount('Confirmed', program);
                    this.applicantCount('Hired', program);
                    this.applicantCount('Denied', program);

                    this.visaCount('Approved', program);
                    this.visaCount('Denied', program);
                    this.applicantCount('For Visa Interview', program);

                    this.programCount(5);
                    this.programCount(9);
                    this.programCount(7);
                    this.programCount(8);
                },
                applicantCount(filter, program) {
                    axios.get(`/helper/applicant/${filter}/${program}`)
                        .then((response) => {
                            switch (program) {
                                case 'Summer Work and Travel - Summer':
                                    switch (filter) {
                                        case 'New Applicant':
                                            this.summer.newApplicant = response.data;
                                            break;
                                        case 'Assessed':
                                            this.summer.assessed = response.data;
                                            break;
                                        case 'Confirmed':
                                            this.summer.confirmed = response.data;
                                            break;
                                        case 'Hired':
                                            this.summer.hired = response.data;
                                            break;
                                        case 'Canceled':
                                            this.summer.canceled = response.data;
                                            break;
                                        case 'For Visa Interview':
                                            this.summer.visaInterview = response.data;
                                            break;
                                    }
                                    break;
                                case 'Summer Work and Travel - Spring':
                                    switch (filter) {
                                        case 'New Applicant':
                                            this.spring.newApplicant = response.data;
                                            break;
                                        case 'Assessed':
                                            this.spring.assessed = response.data;
                                            break;
                                        case 'Confirmed':
                                            this.spring.confirmed = response.data;
                                            break;
                                        case 'Hired':
                                            this.spring.hired = response.data;
                                            break;
                                        case 'Canceled':
                                            this.spring.canceled = response.data;
                                            break;
                                        case 'For Visa Interview':
                                            this.spring.visaInterview = response.data;
                                            break;
                                    }
                                    break;
                                case 'Internship':
                                    switch (filter) {
                                        case 'New Applicant':
                                            this.intern.newApplicant = response.data;
                                            break;
                                        case 'Assessed':
                                            this.intern.assessed = response.data;
                                            break;
                                        case 'Confirmed':
                                            this.intern.confirmed = response.data;
                                            break;
                                        case 'Hired':
                                            this.intern.hired = response.data;
                                            break;
                                        case 'Canceled':
                                            this.intern.canceled = response.data;
                                            break;
                                        case 'For Visa Interview':
                                            this.intern.visaInterview = response.data;
                                            break;
                                    }
                                case 'Career Training':
                                    switch (filter) {
                                        case 'New Applicant':
                                            this.career.newApplicant = response.data;
                                            break;
                                        case 'Assessed':
                                            this.career.assessed = response.data;
                                            break;
                                        case 'Confirmed':
                                            this.career.confirmed = response.data;
                                            break;
                                        case 'Hired':
                                            this.career.hired = response.data;
                                            break;
                                        case 'Canceled':
                                            this.career.canceled = response.data;
                                            break;
                                        case 'For Visa Interview':
                                            this.career.visaInterview = response.data;
                                            break;
                                    }
                                    break;
                                default:
                                    switch (filter) {
                                        case 'New Applicant':
                                            this.newApplicant = response.data;
                                            break;
                                        case 'Assessed':
                                            this.assessed = response.data;
                                            break;
                                        case 'Confirmed':
                                            this.confirmed = response.data;
                                            break;
                                        case 'Hired':
                                            this.hired = response.data;
                                            break;
                                        case 'Canceled':
                                            this.canceled = response.data;
                                            break;
                                        case 'For Visa Interview':
                                            this.visaInterview = response.data;
                                            break;
                                    }
                                    break;
                            }
                        })
                },
                visaCount(filter, program) {
                    axios.get(`/helper/visa/${filter}/${program}`)
                        .then((response) => {
                            switch (program) {
                                case 'Summer Work and Travel - Summer':
                                    switch (filter) {
                                        case 'Approved':
                                            this.summer.visaApproved = response.data;
                                            break;
                                        case 'Denied':
                                            this.summer.visaDenied = response.data;
                                            break;
                                    }
                                    break;
                                case 'Summer Work and Travel - Spring':
                                    switch (filter) {
                                        case 'Approved':
                                            this.spring.visaApproved = response.data;
                                            break;
                                        case 'Denied':
                                            this.spring.visaDenied = response.data;
                                            break;
                                    }
                                    break;
                                case 'Career Training':
                                    switch (filter) {
                                        case 'Approved':
                                            this.career.visaApproved = response.data;
                                            break;
                                        case 'Denied':
                                            this.career.visaDenied = response.data;
                                            break;
                                    }
                                    break;
                                case 'Internship':
                                    switch (filter) {
                                        case 'Approved':
                                            this.intern.visaApproved = response.data;
                                            break;
                                        case 'Denied':
                                            this.intern.visaDenied = response.data;
                                            break;
                                    }
                                    break;
                                default:
                                    switch (filter) {
                                        case 'Approved':
                                            this.visaApproved = response.data;
                                            break;
                                        case 'Denied':
                                            this.visaDenied = response.data;
                                            break;
                                    }
                                    break;
                            }
                        })
                },
                programCount(filter) {
                    axios.get(`/helper/program/${filter}`)
                        .then((response) => {
                            switch (filter) {
                                case 5:
                                    this.swtSpring = response.data;
                                    break;
                                case 9:
                                    this.swtSummer = response.data;
                                    break;
                                case 7:
                                    this.internship = response.data;
                                    break;
                                case 8:
                                    this.careerTraining = response.data;
                                    break;
                            }
                        })
                }
            }
        })
    </script>
@endsection
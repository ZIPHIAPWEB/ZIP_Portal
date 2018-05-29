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
    <div id="app">
        <div class="col-xs-12">
            <div class="container-fluid">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Coordinator Details</h3>
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
                denied: 0,

                visaApproved: 0,
                visaDenied: 0,
                visaInterview: 0,

                swtSpring: 0,
                swtSummer: 0,
                internship: 0,
                careerTraining: 0
            },
            mounted: function() {
                this.applicantCount('New Applicant');
                this.applicantCount('Assessed');
                this.applicantCount('Confirmed');
                this.applicantCount('Hired');
                this.applicantCount('Denied');

                this.visaCount('Approved');
                this.visaCount('Denied');
                this.visaCount('For Visa Interview');

                this.programCount(5);
                this.programCount(9);
                this.programCount(7);
                this.programCount(8);
            },
            methods: {
                refresh() {
                    this.applicantCount('New Applicant');
                    this.applicantCount('Assessed');
                    this.applicantCount('Confirmed');
                    this.applicantCount('Hired');
                    this.applicantCount('Denied');

                    this.visaCount('Approved');
                    this.visaCount('Denied');
                    this.visaCount('For Visa Interview');

                    this.programCount(5);
                    this.programCount(9);
                    this.programCount(7);
                    this.programCount(8);
                },
                applicantCount(filter) {
                    axios.get(`/helper/applicant/${filter}`)
                        .then((response) => {
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
                                case 'Denied':
                                    this.denied = response.data;
                                    break;
                            }
                        })
                },
                visaCount(filter) {
                    axios.get(`/helper/visa/${filter}`)
                        .then((response) => {
                            switch (filter) {
                                case 'Approved':
                                    this.visaApproved = response.data;
                                    break;
                                case 'Denied':
                                    this.visaDenied = response.data;
                                    break;
                                case 'For Visa Interview':
                                    this.visaInterview = response.data;
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
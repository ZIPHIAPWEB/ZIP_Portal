@extends('layouts.app')

@section('title', 'Dashboard')

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
    <div id="app" v-cloak>
        <div class="col-xs 12">
            <div class="container">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Statistic Summary of {{ date('Y') }}</h3>
                        <div class="pull-right">
                            <select v-model="summaryFilter" class="form-control input-sm">
                                <option value="All">All</option>
                                <option v-for="program in programs" :value="program.id">@{{ program.name }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="progress-group">
                                <span class="progress-text">New Applicant</span>
                                    <span class="progress-number">@{{ getNewApplications }}/@{{ getAllStudents }}</span>
                                    <div class="progress">
                                        <div class="progress-bar bg-new-applicant" :style="{ width: getNewApplications / getAllStudents * 100 + '%' }"></div>
                                    </div>
                                </div>
                                
                                <div class="progress-group">
                                <span class="progress-text">Confirmed</span>
                                    <span class="progress-number">@{{ getConfirmed }}/@{{ getAllStudents }}</span>
                                    <div class="progress">
                                        <div class="progress-bar bg-confirmed" :style="{ width: getConfirmed / getAllStudents * 100 + '%' }"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="progress-group">
                                    <span class="progress-text">Assessed</span>
                                    <span class="progress-number">@{{ getAssessed }}/@{{ getAllStudents }}</span>
                                    <div class="progress">
                                        <div class="progress-bar bg-assessed" :style="{ width: getAssessed / getAllStudents * 100 + '%' }"></div>
                                    </div>
                                </div>
                                <div class="progress-group">
                                <span class="progress-text">Called</span>
                                    <span class="progress-number">@{{ getContacted }}/@{{ getAllStudents }}</span>
                                    <div class="progress">
                                        <div class="progress-bar bg-called" :style="{ width: getContacted / getAllStudents * 100 + '%' }"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="progress-group">
                                <span class="progress-text">Hired</span>
                                    <span class="progress-number">@{{ getHired }}/@{{ getAllStudents }}</span>
                                    <div class="progress">
                                        <div class="progress-bar bg-hired" :style="{ width: getHired / getAllStudents * 100 + '%' }"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-3">
                                <div class="progress-group">
                                <span class="progress-text">For Visa Interview</span>
                                    <span class="progress-number">@{{ getForVisaInterview }}/@{{ getAllStudents }}</span>
                                    <div class="progress active">
                                        <div class="progress-bar bg-visa-interview" :style="{ width: getForVisaInterview / getAllStudents * 100 + '%' }"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="progress-group">
                                    <span class="progress-text">Visa Approved</span>
                                    <span class="progress-number">@{{ getVisaApproved }}/@{{ getAllStudents }}</span>
                                    <div class="progress active">
                                        <div class="progress-bar progress-bar-yellow progress-bar-striped" :style="{ width: getVisaApproved / getAllStudents * 100 + '%' }"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="progress-group">
                                <span class="progress-text">Visa Denied</span>
                                    <span class="progress-number">@{{ getVisaDenied }}/@{{ getAllStudents }}</span>
                                    <div class="progress active">
                                        <div class="progress-bar progress-bar-success progress-bar-striped" :style="{ width: getVisaDenied / getAllStudents * 100 + '%' }"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="progress-group">
                                    <span class="progress-text">Cancelled</span>
                                    <span class="progress-number">@{{ getCancelled }}/@{{ getAllStudents }}</span>
                                    <div class="progress active">
                                        <div class="progress-bar bg-cancelled" :style="{ width: getCancelled / getAllStudents * 100 + '%' }"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="progress-group">
                                    <span class="progress-text">For PDOS & CFO</span>
                                    <span class="progress-number">@{{ getForPdosCfo }}/@{{ getAllStudents }}</span>
                                    <div class="progress active">
                                        <div class="progress-bar bg-for-pdos-cfo" :style="{width: getForPdosCfo / getAllStudents * 100 + '%' }"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="progress-group">
                                    <span class="progress-text">Program Proper</span>
                                    <span class="progress-number">@{{ getProgramProper }}/@{{ getAllStudents }}</span>
                                    <div class="progress active">
                                        <div class="progress-bar bg-program-proper" :style="{ width: getProgramProper / getAllStudents * 100 + '%' }"></div>
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
                url: '/portal/c/program-admin/',
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
                students: [],
                programs: [],
                summaryFilter: ''
            },
            computed: {
                getAllStudents() {
                    return this.students.filter(e => {
                        if (this.summaryFilter == 'All') {
                            return e;
                        } else {
                            return e.program_id == this.summaryFilter;
                        }
                    }).length;
                },
                getNewApplications() {
                    return this.students.filter(e => {
                        if (this.summaryFilter == 'All') {
                            return e
                        } else {
                            return e.program_id == this.summaryFilter;
                        }
                    }).filter(e => {
                        return e.application_status == 'New Applicant';
                    }).length;
                },
                getAssessed() {
                    return this.students.filter(e => {
                        if (this.summaryFilter == 'All') {
                            return e
                        } else {
                            return e.program_id == this.summaryFilter;
                        }
                    }).filter(e => {
                        return e.application_status == 'Assessed';
                    }).length;
                },
                getContacted() {
                    return this.students.filter(e => {
                        if (this.summaryFilter == 'All') {
                            return e
                        } else {
                            return e.program_id == this.summaryFilter;
                        }
                    }).filter(e => {
                        return e.application_status == 'Contacted';
                    }).length;
                },
                getConfirmed() {
                    return this.students.filter(e => {
                        if (this.summaryFilter == 'All') {
                            return e
                        } else {
                            return e.program_id == this.summaryFilter;
                        }
                    }).filter(e => {
                        return e.application_status == 'Confirmed';
                    }).length;
                },
                getHired() {
                    return this.students.filter(e => {
                        if (this.summaryFilter == 'All') {
                            return e
                        } else {
                            return e.program_id == this.summaryFilter;
                        }
                    }).filter(e => {
                        return e.application_status == 'Hired';
                    }).length;
                },
                getForVisaInterview() {
                    return this.students.filter(e => {
                        if (this.summaryFilter == 'All') {
                            return e
                        } else {
                            return e.program_id == this.summaryFilter;
                        }
                    }).filter(e => {
                        return e.application_status == 'For Visa Interview';
                    }).length;
                },
                getForPdosCfo() {
                    return this.students.filter(e => {
                        if (this.summaryFilter == 'All') {
                            return e
                        } else {
                            return e.program_id == this.summaryFilter;
                        }
                    }).filter(e => {
                        return e.application_status == 'For PDOS & CFO';
                    }).length;
                },
                getProgramProper() {
                    return this.students.filter(e => {
                        if (this.summaryFilter == 'All') {
                            return e
                        } else {
                            return e.program_id == this.summaryFilter;
                        }
                    }).filter(e => {
                        return e.application_status == 'Program Proper';
                    }).length;
                },
                getVisaApproved() {
                    return this.students.filter(e => {
                        if (this.summaryFilter == 'All') {
                            return e
                        } else {
                            return e.program_id == this.summaryFilter;
                        }
                    }).filter(e => {
                        return e.visa_interview_status == 'Approved';
                    }).length;
                },
                getVisaDenied() {
                    return this.students.filter(e => {
                        if (this.summaryFilter == 'All') {
                            return e
                        } else {
                            return e.program_id == this.summaryFilter;
                        }
                    }).filter(e => {
                        return e.visa_interview_status == 'Disapproved';
                    }).length;
                },
                getCancelled() {
                    return this.students.filter(e => {
                        if (this.summaryFilter == 'All') {
                            return e
                        } else {
                            return e.program_id == this.summaryFilter;
                        }
                    }).filter(e => {
                        return e.application_status == 'Cancel: Unqualified' || e.application_status == 'Cancel: Visa Denial' || e.application_status == 'Cancel: Program Cancellation';
                    }).length;
                }
            },
            mounted () {
                this.summaryFilter = 'All';
                this.getAllStudentCount();
                this.loadPrograms();
            },
            methods: {
                loadPrograms() {
                    axios.get('/helper/program/view')
                        .then((response) => {
                            this.programs = response.data.data;
                        })
                },
                getAllStudentCount() {
                    axios.get(`/helper/getAllStudentCount`)
                        .then((response) => {
                            this.students = response.data;
                        })
                }
            }
        })
    </script>
@endsection
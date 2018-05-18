@extends('layouts.app')

@section('title', 'Students')

@section('content')
    <div id="app">
        <div class="col-xs-12">
            <div class="container">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title ">Student Details</h3>
                    </div>
                    <div class="box-body">
                        <label class="label-control">Program Status</label>
                        <table class="table table-striped table-bordered table-condensed m-b-10">
                            <tbody>
                                <tr>
                                    <td>Application Status</td>
                                    <td class="text-bold text-red">@{{ student.application_status }}</td>
                                </tr>
                                <tr>
                                    <td>Visa Interview Status</td>
                                    <td>@{{ student.view_interview_status }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <label v-if="student.host_company_id" class="label-control">Hired Company Details</label>
                        <table v-if="student.host_company_id" class="table table-striped table-bordered table-condensed m-b-10">
                            <tbody>
                                <tr>
                                    <td>Host Company</td>
                                    <td>@{{ student.host_company_id }}</td>
                                </tr>
                                <tr>
                                    <td>Position</td>
                                    <td>@{{ student.position }}</td>
                                </tr>
                                <tr>
                                    <td>Location</td>
                                    <td>@{{ student.location }}</td>
                                </tr>
                                <tr>
                                    <td>Stipend</td>
                                    <td>@{{ student.stipend }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <label class="label-control">Other Contact Details</label>
                        <table class="table table-striped table-bordered table-condensed m-b-10">
                            <tbody>
                                <tr>
                                    <td>Facebook Account</td>
                                    <td>@{{ student.fb_email }}</td>
                                </tr>
                                <tr>
                                    <td>Skype ID</td>
                                    <td>@{{ student.skype_id }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <label class="label-control">Student Details</label>
                        <table class="table table-striped table-bordered table-condensed">
                            <tbody>
                            <tr>
                                <td>First Name</td>
                                <td class="text-bold">@{{ student.first_name }}</td>
                            </tr>
                            <tr>
                                <td>Middle Name</td>
                                <td class="text-bold">@{{ student.middle_name }}</td>
                            </tr>
                            <tr>
                                <td>Last Name</td>
                                <td class="text-bold">@{{ student.last_name }}</td>
                            </tr>
                            <tr>
                                <td>Date of Birth</td>
                                <td class="text-bold">@{{ student.birthdate }}</td>
                            </tr>
                            <tr>
                                <td>Gender</td>
                                <td class="text-bold">@{{ student.gender }}</td>
                            </tr>
                            <tr>
                                <td>Home Number</td>
                                <td class="text-bold">@{{ student.home_number }}</td>
                            </tr>
                            <tr>
                                <td>Mobile Number</td>
                                <td class="text-bold">@{{ student.mobile_number }}</td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td class="text-bold">@{{ student.address }}</td>
                            </tr>
                            <tr>
                                <td>School</td>
                                <td class="text-bold">@{{ student.school }}</td>
                            </tr>
                            <tr>
                                <td>Year Level</td>
                                <td class="text-bold">@{{ student.year }}</td>
                            </tr>
                            <tr>
                                <td>Course</td>
                                <td class="text-bold">@{{ student.course }}</td>
                            </tr>
                            <tr>
                                <td>Program</td>
                                <td class="text-bold">@{{ student.program }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title text-center">Payment Details</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                            <th>Requirements</th>
                            <th class="text-center">Uploaded</th>
                            </thead>
                            <tbody>
                            <tr v-for="requirement in paymentRequirements">
                                <td>@{{ requirement.name }}</td>
                                <td class="text-center">
                                    <span v-if="requirement.status" class="fa fa-check" style="color: green;"></span>
                                    <span v-else class="fa fa-remove" style="color: red;"></span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title text-center">Basic Requirement</h3>
                    </div>
                    <div class="box-body" v-cloak>
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                            <th>Requirements</th>
                            <th class="text-center">Uploaded</th>
                            </thead>
                            <tbody>
                            <tr v-for="requirement in basicRequirements">
                                <td>@{{ requirement.name }}</td>
                                <td class="text-center">
                                    <span v-if="requirement.status" class="fa fa-check" style="color: green;"></span>
                                    <span v-else class="fa fa-remove" style="color: red;"></span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div v-if="student.visa_sponsor_id" class="container">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title text-center">Visa Requirements</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-striped table-condensed">
                            <thead>
                            <th>Requirements</th>
                            <th class="text-center">Uploaded</th>
                            </thead>
                            <tbody>
                            <tr v-for="requirement in visaRequirements">
                                <td>@{{ requirement.name }}</td>
                                <td class="text-center">
                                    <span v-if="requirement.status" class="fa fa-check" style="color: green;"></span>
                                    <span v-else class="fa fa-remove" style="color: red;"></span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="file-upload" tabindex="-1" role="dialog">
            <form>
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"></h4>
                        </div>
                        <div class="modal-body">

                        </div>
                        <div class="modal-footer clearfix">
                            <button class="btn btn-primary btn-flat btn-block">Upload File</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </form>
        </div><!-- /.modal -->
    </div>
@endsection

@section('script')
    <script>
        const app = new Vue({
            el: '#app',
            data: {
                student: [],
                basicRequirements: [],
                paymentRequirements: [],
                visaRequirements: [],
                user_id: '{{ Auth::user()->id }}',
            },
            created: function() {
                this.loadStudentDetails();
            },
            mounted: function() {
                setTimeout(() => {
                    this.loadBasicRequirements(this.student.program_id);
                    this.loadPaymentRequirements(this.student.program_id);
                    this.loadVisaRequirements(this.student.visa_sponsor_id);
                }, 500);
            },
            methods: {
                loadStudentDetails() {
                    axios.get(`/stud/view/${this.user_id}`)
                        .then((response) => {
                            this.student = response.data.data;
                            this.program_id = response.data.data.program_id;
                        }).catch((error) => {
                            console.log(error);
                    })
                },
                loadBasicRequirements(programId) {
                    axios.get(`/stud/requirement/basic/${programId}`)
                        .then((response) => {
                            this.basicRequirements = response.data.data;
                            console.log(response.data.data);
                        }).catch((error) => {
                        console.log(error);
                    });
                },
                loadPaymentRequirements(programId) {
                    axios.get(`/stud/requirement/payment/${programId}`)
                        .then((response) => {
                            this.paymentRequirements = response.data.data;
                            console.log(response.data.data);
                        }).catch((error) => {
                            console.log(error);
                    });
                },
                loadVisaRequirements(sponsorId) {
                    axios.get(`/stud/requirement/visa/${sponsorId}`)
                        .then((response) => {
                            this.visaRequirements = response.data.data;
                            console.log(response.data.data);
                        }).catch((error) => {
                            console.log(error);
                    });
                }
            }
        });
    </script>
@endsection
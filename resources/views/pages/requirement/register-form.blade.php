@extends('layouts.auth-app')

@section('title', 'Registration Form')

@section('content')
    <div id="app">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 m-t-50">
                    <div class="register-logo">
                        <a href="{{ route('welcome') }}"><b>ZIP TRAVEL </b>Portal</a>
                    </div>

                    <div class="box box-default">
                        <div class="box-body">
                            <p class="login-box-msg">Fill-Up all the required fields</p>

                            <form @submit.prevent="validate()">
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-4 col-md-4">
                                        <label for="">First Name: <i class="text-red">*</i></label>
                                        <input v-model="student.firstName" type="text" class="form-control">
                                        <span class="help-block text-red" v-if="errors.firstName">@{{ errors.firstName[0] }}</span>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-4 col-md-4">
                                        <label for="">Middle Name: </label>
                                        <input v-model="student.middleName" type="text" class="form-control">
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-4 col-md-4">
                                        <label for="">Last Name: <i class="text-red">*</i></label>
                                        <input v-model="student.lastName" type="text" class="form-control">
                                        <span class="help-block text-red" v-if="errors.lastName">@{{ errors.lastName[0] }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-6 col-md-6">
                                        <label for="">Date of Birth: <i class="text-red">*</i></label>
                                        <input v-model="student.birthDate" type="date" class="form-control">
                                        <span class="help-block text-red" v-if="errors.birthDate">@{{ errors.birthDate[0] }}</span>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-6 col-md-6">
                                        <label for="">Gender: <i class="text-red">*</i></label>
                                        <select v-model="student.gender" class="form-control ">
                                            <option value="">Select Gender</option>
                                            <option value="MALE">Male</option>
                                            <option value="FEMALE">Female</option>
                                        </select>
                                        <span class="help-block text-red" v-if="errors.gender">@{{ errors.gender[0] }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-6 col-md-6">
                                        <label for="">Home Number:</label>
                                        <input v-model="student.homeNumber" type="number" class="form-control" maxlength="11">
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-6 col-md-6">
                                        <label for="">Mobile Number: <i class="text-red">*</i></label>
                                        <input v-model="student.mobileNumber" type="number" class="form-control" maxlength="11">
                                        <span class="help-block text-red" v-if="errors.mobileNumber">@{{ errors.mobileNumber[0] }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-xs-12">
                                        <label for="">Address: <i class="text-red">*</i></label>
                                        <textarea v-model="student.address" class="form-control"></textarea>
                                        <span class="help-block text-red" v-if="errors.address">@{{ errors.address[0] }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-6 col-md-6">
                                        <label for="">Facebook Email <i class="text-red">*</i></label>
                                        <input v-model="student.fb_email" type="email" class="form-control">
                                        <span class="help-block text-red" v-if="errors.fb_email">@{{ errors.fb_email[0] }}</span>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-6 col-md-6">
                                        <label for="">Skype ID <i class="text-red">*</i></label>
                                        <input v-model="student.skype_id" type="text" class="form-control">
                                        <span class="help-block text-red" v-if="errors.skype_id">@{{ errors.skype_id[0] }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-6 col-md-6">
                                        <label for="">School: <i class="text-red">*</i></label>
                                        <select v-model="student.school" class="form-control">
                                            <option value="" active>Select School</option>
                                            <option v-for="item in schools" :value="item.id">@{{ item.name }}</option>
                                        </select>
                                        <span class="help-block text-red" v-if="errors.school">@{{ errors.school[0] }}</span>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-6 col-md-6">
                                        <label for="">Year Level: <i class="text-red">*</i></label>
                                        <select v-model="student.year" class="form-control">
                                            <option value="" active>Select year level</option>
                                            <option value="First Year">First Year</option>
                                            <option value="Second Year">Second Year</option>
                                            <option value="Third Year">Third Year</option>
                                            <option value="Fourth Year">Fourth Year</option>
                                            <option value="Graduated">Graduated</option>
                                        </select>
                                        <span class="help-block text-red" v-if="errors.year">@{{ errors.year[0] }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-xs-12">
                                        <label for="">Course: <i class="text-red">*</i></label>
                                        <input v-model="student.course" type="text" class="form-control">
                                        <span class="help-block text-red" v-if="errors.course">@{{ errors.course[0] }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-xs-12">
                                        <label for="">Program: <i class="text-red">*</i></label>
                                        <select v-model="student.program_id" class="form-control">
                                            <option value="" active>Select your program</option>
                                            <option v-for="program in programs" :value="program.id">@{{ program.display_name }}</option>
                                        </select>
                                        <span class="help-block text-red" v-if="errors.program_id">@{{ errors.program_id[0] }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-xs-12">
                                        <button type="submit" class="btn btn-primary btn-flat btn-block">Validate</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="agreement-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">ZIP Travel Philippines</h4>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer clearfix">
                        <button class="btn btn-danger btn-flat btn-sm pull-right">I Decline</button>
                        <button @click="agree" class="btn btn-success btn-flat btn-sm pull-right m-r-5">I Agree</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <div class="modal fade" id="verify-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Inputted Details</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped table-bordered table-condensed">
                            <tbody>
                                <tr>
                                    <td>First Name</td>
                                    <td class="text-bold">@{{ student.firstName }}</td>
                                </tr>
                                <tr>
                                    <td>Middle Name</td>
                                    <td class="text-bold">@{{ student.middleName }}</td>
                                </tr>
                                <tr>
                                    <td>Last Name</td>
                                    <td class="text-bold">@{{ student.lastName }}</td>
                                </tr>
                                <tr>
                                    <td>Date of Birth</td>
                                    <td class="text-bold">@{{ student.birthDate }}</td>
                                </tr>
                                <tr>
                                    <td>Gender</td>
                                    <td class="text-bold">@{{ student.gender }}</td>
                                </tr>
                                <tr>
                                    <td>Home Number</td>
                                    <td class="text-bold">@{{ student.homeNumber }}</td>
                                </tr>
                                <tr>
                                    <td>Mobile Number</td>
                                    <td class="text-bold">@{{ student.mobileNumber }}</td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td class="text-bold">@{{ student.address }}</td>
                                </tr>
                                <tr>
                                    <td>Facebook Email</td>
                                    <td class="text-bold">@{{ student.fb_email }}</td>
                                </tr>
                                <tr>
                                    <td>Skype ID</td>
                                    <td class="text-bold">@{{ student.skype_id }}</td>
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
                                    <td class="text-bold">@{{ student.program_id }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer clearfix">
                        <button @click="submit" class="btn btn-success btn-flat btn-sm btn-block pull-right">Submit</button>
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
                schools: [],
                programs: [],
                student : {
                    firstName: '',
                    middleName: '',
                    lastName: '',
                    birthDate: '',
                    gender: '',
                    homeNumber: '',
                    mobileNumber: '',
                    address: '',
                    school: '',
                    year: '',
                    course: '',
                    program_id: '',
                    skype_id: '',
                    fb_email: ''
                },
                errors: [],
                loading: false
            },
            mounted: function () {
                $('#agreement-modal').modal('show');
                this.loadSchools();
                this.loadPrograms();
            },
            methods: {
                agree() {
                    $('#agreement-modal').modal('hide');
                },
                disagree() {

                },
                submit() {
                    this.loading = true;
                    axios.post(`/stud/details/store`, this.student)
                        .then((response) => {

                            location.href = '{{ route('dash.student') }}'
                        }).catch((error) => {
                            console.log(error);
                    });
                },
                validate() {
                    axios.post(`/stud/validateDetails`, this.student)
                        .then((response) => {
                            $('#verify-modal').modal('show');
                        }).catch((error) => {
                            this.errors = error.response.data.errors;
                            console.log(error.response.data);
                    });
                },
                loadSchools() {
                    axios.get(`/helper/school/view`)
                        .then((response) => {
                            this.schools = response.data.data;
                        }).catch((error) => {
                            console.log(error);
                    });
                },
                loadPrograms() {
                    axios.get(`/helper/program/view`)
                        .then((response) => {
                            this.programs = response.data.data;
                        }).catch((error) => {
                            console.log(error);
                    });
                }
            }
        });
    </script>
@endsection
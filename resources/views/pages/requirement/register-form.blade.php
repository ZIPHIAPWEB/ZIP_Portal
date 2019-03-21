@extends('layouts.auth-app')

@section('title', 'Registration Form')

@section('content')
    <div id="app" v-cloak>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 m-t-50">
                    <div class="register-logo">
                        <a href="{{ route('logout') }}"><b>ZIP TRAVEL </b>Philippines</a>
                    </div>

                    <div class="box box-default">
                        <div class="box-body">
                            <p class="login-box-msg">Fill-Up all the required fields</p>

                            <form>
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-4 col-md-4">
                                        <label for="">First Name: <i class="text-red">*</i></label>
                                        <input v-model="student.firstName" type="text" class="form-control input-sm" placeholder="First Name">
                                        <span class="help-block text-red" v-if="errors.first_name">@{{ errors.first_name[0] }}</span>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-4 col-md-4">
                                        <label for="">Middle Name: </label>
                                        <input v-model="student.middleName" type="text" class="form-control input-sm" placeholder="Middle Name">
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-4 col-md-4">
                                        <label for="">Last Name: <i class="text-red">*</i></label>
                                        <input v-model="student.lastName" type="text" class="form-control input-sm" placeholder="Last Name">
                                        <span class="help-block text-red" v-if="errors.last_name">@{{ errors.last_name[0] }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-6 col-md-6">
                                        <label for="">Date of Birth: <i class="text-red">*</i></label>
                                        <input v-model="student.birthDate" type="date" class="form-control input-sm">
                                        <span class="help-block text-red" v-if="errors.birthdate">@{{ errors.birthdate[0] }}</span>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-6 col-md-6">
                                        <label for="">Gender: <i class="text-red">*</i></label>
                                        <select v-model="student.gender" class="form-control input-sm">
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
                                        <input v-model="student.homeNumber" type="number" class="form-control input-sm" maxlength="11" placeholder="+63 912 3456 789">
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-6 col-md-6">
                                        <label for="">Mobile Number: <i class="text-red">*</i></label>
                                        <input v-model="student.mobileNumber" type="number" class="form-control input-sm" maxlength="11" placeholder="+63 912 3456 789">
                                        <span class="help-block text-red" v-if="errors.mobile_number">@{{ errors.mobile_number[0] }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-xs-12">
                                        <label for="">Permanent Address: <i class="text-red">*</i></label>
                                        <textarea v-model="student.permanent_address" class="form-control input-sm" placeholder="Permanent Address"></textarea>
                                        <span class="help-block text-red" v-if="errors.address">@{{ errors.address[0] }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-xs-12">
                                        <label for="">Provincial Address: <i class="text-red">*</i></label>
                                        <div class="pull-right">
                                            <label for="" class="text-sm p-r-5">Same as Above</label>
                                            <input v-model="sameAsAbove" type="checkbox" class="pull-right">
                                        </div>
                                        <textarea v-model="student.provincial_address" class="form-control input-sm" placeholder="Provincial Address"></textarea>
                                        <span class="help-block text-red"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-6 col-md-6">
                                        <label for="">Facebook Email <i class="text-red">*</i></label>
                                        <input v-model="student.fb_email" type="email" class="form-control input-sm" placeholder="sample@gmail.com">
                                        <span class="help-block text-red" v-if="errors.fb_email">@{{ errors.fb_email[0] }}</span>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-6 col-md-6">
                                        <label for="">Skype ID <i class="text-red">*</i></label>
                                        <input v-model="student.skype_id" type="text" class="form-control input-sm" placeholder="live:sample_1">
                                        <span class="help-block text-red" v-if="errors.skype_id">@{{ errors.skype_id[0] }}</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-xs-6">
                                        <label for="">Year Level: <i class="text-red">*</i></label>
                                        <select v-model="student.year" class="form-control input-sm">
                                            <option value="">Year Level</option>
                                            <option value="First Year">First Year</option>
                                            <option value="Second Year">Second Year</option>
                                            <option value="Third Year">Third Year</option>
                                            <option value="Fourth Year">Fourth Year</option>
                                            <option value="Graduate">Graduate</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-xs-6">
                                        <label for="">Program: <i class="text-red">*</i></label>
                                        <select v-model="student.program_id" class="form-control input-sm">
                                            <option value="" active>Select your program</option>
                                            <option v-for="program in programs" :value="{ id: program.id, name: program.display_name }">@{{ program.display_name }}</option>
                                        </select>
                                        <span class="help-block text-red" v-if="errors.program_id">@{{ errors.program_id[0] }}</span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-default">
                        <div class="box-body">
                            <p class="login-box-msg">Father's Information</p>

                            <form>
                                <div class="row">
                                    <div class="form-group col-xs-4">
                                        <label for="">First Name <i class="text-red">*</i></label>
                                        <input v-model="father.first_name" type="text" class="form-control input-sm" placeholder="Father's First Name">
                                        <span class="help-block text-red" v-if="errors.f_first_name">required</span>
                                    </div>
                                    <div class="form-group col-xs-4">
                                        <label for="">Middle Name <i class="text-red">*</i></label>
                                        <input v-model="father.middle_name" type="text" class="form-control input-sm" placeholder="Father's Middle Name">
                                        <span class="help-block text-red" v-if="errors.f_middle_name">required</span>
                                    </div>
                                    <div class="form-group col-xs-4">
                                        <label for="">Last Name <i class="text-red">*</i></label>
                                        <input v-model="father.last_name" type="text" class="form-control input-sm" placeholder="Father's Last Name">
                                        <span class="help-block text-red" v-if="errors.f_last_name">required</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-xs-4">
                                        <label for="">Occupation <i class="text-red">*</i></label>
                                        <input v-model="father.occupation" type="text" class="form-control input-sm" placeholder="Father's Occupation">
                                        <span class="help-block text-red" v-if="errors.f_occupation">required</span>
                                    </div>
                                    <div class="form-group col-xs-4">
                                        <label for="">Company <i class="text-red">*</i></label>
                                        <input v-model="father.company" type="text" class="form-control input-sm" placeholder="Father's Company">
                                        <span class="help-block text-red" v-if="errors.f_company">required</span>
                                    </div>
                                    <div class="form-group col-xs-4">
                                        <label for="">Contact No. <i class="text-red">*</i></label>
                                        <input v-model="father.contact_no" type="text" class="form-control input-sm" placeholder="Father's Contact No.">
                                        <span class="help-block text-red" v-if="errors.f_contact">required</span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-default">
                        <div class="box-body">
                            <p class="login-box-msg">Mother's Information</p>

                            <form>
                                <div class="row">
                                    <div class="form-group col-xs-4">
                                        <label for="">First Name <i class="text-red">*</i></label>
                                        <input v-model="mother.first_name" type="text" class="form-control input-sm" placeholder="Mother's First Name">
                                        <span class="help-block text-red" v-if="errors.m_first_name">required</span>
                                    </div>
                                    <div class="form-group col-xs-4">
                                        <label for="">Middle Name <i class="text-red">*</i></label>
                                        <input v-model="mother.middle_name" type="text" class="form-control input-sm" placeholder="Mother's Middle Name">
                                        <span class="help-block text-red" v-if="errors.m_middle_name">required</span>
                                    </div>
                                    <div class="form-group col-xs-4">
                                        <label for="">Last Name <i class="text-red">*</i></label>
                                        <input v-model="mother.last_name" type="text" class="form-control input-sm" placeholder="Mother's Last Name">                                        <span class="help-block text-red" v-if="errors.m_middle_name">required</span>
                                        <span class="help-block text-red" v-if="errors.m_last_name">required</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-xs-4">
                                        <label for="">Occupation <i class="text-red">*</i></label>
                                        <input v-model="mother.occupation" type="text" class="form-control input-sm" placeholder="Mother's Occupation">
                                        <span class="help-block text-red" v-if="errors.m_occupation">required</span>
                                    </div>
                                    <div class="form-group col-xs-4">
                                        <label for="">Company <i class="text-red">*</i></label>
                                        <input v-model="mother.company" type="text" class="form-control input-sm" placeholder="Mother's Company">
                                        <span class="help-block text-red" v-if="errors.m_company">required</span>
                                    </div>
                                    <div class="form-group col-xs-4">
                                        <label for="">Contact No. <i class="text-red">*</i></label>
                                        <input v-model="mother.contact_no" type="text" class="form-control input-sm" placeholder="Mother's Contact No.">
                                        <span class="help-block text-red" v-if="errors.m_contact">required</span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-default">
                        <div class="box-body">
                            <p class="login-box-msg">Primary Education</p>

                            <form @submit.prevent="validate()">
                                <div class="row">
                                    <div class="form-group col-xs-12">
                                        <label for="">School Name <i class="text-red">*</i></label>
                                        <input v-model="primary.school" type="text" class="form-control input-sm" placeholder="Primary School Name">
                                        <span class="help-block text-red" v-if="errors.p_school">required</span>
                                    </div>
                                    <div class="form-group col-xs-6">
                                        <label for="">Address <i class="text-red">*</i></label>
                                        <input v-model="primary.address" type="text" class="form-control input-sm" placeholder="Primary School Address">
                                        <span class="help-block text-red" v-if="errors.p_address">required</span>
                                    </div>
                                    <div class="form-group col-xs-6">
                                        <label for="">Date Graduated <i class="text-red">*</i></label>
                                        <input v-model="primary.date_graduated" type="date" class="form-control input-sm">
                                        <span class="help-block text-red" v-if="errors.p_date_graduated">required</span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-default">
                        <div class="box-body">
                            <p class="login-box-msg">Secondary Education</p>

                            <form>
                                <div class="row">
                                    <div class="form-group col-xs-12">
                                        <label for="">School Name <i class="text-red">*</i></label>
                                        <input v-model="secondary.school" type="text" class="form-control input-sm" placeholder="Secondary School Name">
                                        <span class="help-block text-red" v-if="errors.s_school">required</span>
                                    </div>
                                    <div class="form-group col-xs-6">
                                        <label for="">Address <i class="text-red">*</i></label>
                                        <input v-model="secondary.address" type="text" class="form-control input-sm" placeholder="Secondary School Address">
                                        <span class="help-block text-red" v-if="errors.s_address">required</span>
                                    </div>
                                    <div class="form-group col-xs-6">
                                        <label for="">Date Graduated <i class="text-red">*</i></label>
                                        <input v-model="secondary.date_graduated" type="date" class="form-control input-sm">
                                        <span class="help-block text-red" v-if="errors.s_date_graduated">required</span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-default">
                        <div class="box-body">
                            <p class="login-box-msg">Tertiary Education</p>

                            <form>
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-12">
                                        <label for="">School Name <i class="text-red">*</i></label>
                                        <select v-model="tertiary.school" class="form-control input-sm">
                                            <option value="" active>Select School</option>
                                            <option v-for="item in schools" :value="{ id: item.id, name: item.name }">@{{ item.name }}</option>
                                        </select>
                                        <span class="help-block text-red" v-if="errors.t_school">@{{ errors.school[0] }}</span>
                                    </div>
                                    <div class="form-group col-xs-12">
                                        <label for="">Degree <i class="text-red">*</i></label>
                                        <input v-model="tertiary.degree" type="text" class="form-control input-sm" placeholder="Tertiary Degree">
                                        <span class="help-block text-red" v-if="errors.t_degree">required</span>
                                    </div>
                                    <div class="form-group col-xs-6">
                                        <label for="">Address <i class="text-red">*</i></label>
                                        <input v-model="tertiary.address" type="text" class="form-control input-sm" placeholder="Tertiary School Address">
                                        <span class="help-block text-red" v-if="errors.t_address">required</span>
                                    </div>
                                    <div class="form-group col-xs-6">
                                        <label for="">Date Graduated (<small>date indicated in diploma</small>)<i class="text-red">*</i></label>
                                        <input v-model="tertiary.date_graduated" type="date" class="form-control input-sm">
                                        <span class="help-block text-red" v-if="errors.t_date_graduated">required</span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-default">
                        <div class="box-body">
                            <button class="btn btn-primary btn-xs btn-flat pull-right" @click="deleteElement()">-</button>
                            <button class="btn btn-primary btn-xs btn-flat pull-right" @click="addElement()">+</button>
                            <p class="login-box-msg">Work Experience/On-the-Job Training</p>

                            <form v-for="item in experiences">
                                <div class="row">
                                    <div class="form-group col-xs-12">
                                        <label for="">Company Name <i class="text-red">*</i></label>
                                        <input v-model="item.company" type="text" class="form-control input-sm" placeholder="Company Name">
                                    </div>
                                    <div class="form-group col-xs-12">
                                        <label for="">Address <i class="text-red">*</i></label>
                                        <input v-model="item.address" type="text" class="form-control input-sm" placeholder="Company Address">
                                    </div>
                                    <div class="form-group col-xs-12">
                                        <label for="">Job Description <i class="text-red">*</i></label>
                                        <textarea v-model="item.description"
                                                  class="form-control input-sm" placeholder="Your Job Description"></textarea>
                                    </div>
                                    <div class="form-group col-xs-6">
                                        <label for="">Start Date <i class="text-red">*</i></label>
                                        <input v-model="item.start_date" type="date" class="form-control input-sm">
                                    </div>
                                    <div class="form-group col-xs-6">
                                        <label for="">End Date <i class="text-red">*</i></label>
                                        <div class="pull-right">
                                            <label for="" class="text-sm p-r-5">Present</label>
                                            <input type="checkbox" v-model="item.presentDate">
                                        </div>
                                        <input v-model="item.end_date" type="date" class="form-control input-sm" :disabled="item.presentDate">
                                    </div>
                                </div>
                            </form>
                            <button @click="validate()" class="btn btn-primary btn-block btn-flat btn-sm">Validate</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="agreement-modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">ZIP Travel Philippines</h4>
                    </div>
                    <div class="modal-body">
                        <div class="text-justify">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid blanditiis cumque esse et, expedita fugit inventore iure laborum mollitia nesciunt perspiciatis, provident saepe sequi velit voluptate? Modi pariatur soluta voluptatem! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur deserunt dicta earum enim est ex incidunt maiores maxime natus, officiis, saepe sunt ut, vero! Ad delectus fuga impedit magni natus. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem, consequatur ea error hic recusandae sapiente temporibus unde? Aliquid, amet cumque ipsam, itaque laborum magnam minima necessitatibus recusandae rerum sequi voluptate. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto cupiditate eaque est iure laudantium quo repellat suscipit, totam! Cum cumque mollitia praesentium, quia quibusdam quo repudiandae sunt tenetur veniam voluptate.
                            <br><br>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere nostrum veniam voluptatem. Ab aliquam aliquid consequuntur, cum dicta ea eius, fugiat impedit iure nam provident quaerat recusandae sequi similique, totam! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium aperiam deserunt dolor earum impedit laudantium numquam quaerat rem! At autem, cupiditate eos minima molestias natus placeat quam quidem saepe vitae! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus accusantium adipisci at, dicta error ex fuga illo iure laborum laudantium minus nisi odit quasi quis, quos recusandae repudiandae saepe, veniam.
                            <br><br>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere nostrum veniam voluptatem. Ab aliquam aliquid consequuntur, cum dicta ea eius, fugiat impedit iure nam provident quaerat recusandae sequi similique, totam! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium aperiam deserunt dolor earum impedit laudantium numquam quaerat rem! At autem, cupiditate eos minima molestias natus placeat quam quidem saepe vitae! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus accusantium adipisci at, dicta error ex fuga illo iure laborum laudantium minus nisi odit quasi quis, quos recusandae repudiandae saepe, veniam.
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere nostrum veniam voluptatem. Ab aliquam aliquid consequuntur, cum dicta ea eius, fugiat impedit iure nam provident quaerat recusandae sequi similique, totam! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium aperiam deserunt dolor earum impedit laudantium numquam quaerat rem! At autem, cupiditate eos minima molestias natus placeat quam quidem saepe vitae! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus accusantium adipisci at, dicta error ex fuga illo iure laborum laudantium minus nisi odit quasi quis, quos recusandae repudiandae saepe, veniam.
                        </div>
                    </div>
                    <div class="modal-footer clearfix">
                        <a href="{{ route('logout') }}" class="btn btn-danger btn-flat btn-sm pull-right">I Decline</a>
                        <button @click="agree" class="btn btn-success btn-flat btn-sm pull-right m-r-5">I Agree</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <div class="modal fade" id="verify-modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Please review the details provided to ensure accuracy then submit</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped table-bordered table-condensed">
                            <tbody>
                                <tr>
                                    <td colspan="2" class="text-bold">Personal Details</td>
                                </tr>
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
                                    <td>Permanent Address</td>
                                    <td class="text-bold">@{{ student.permanent_address }}</td>
                                </tr>
                                <tr>
                                    <td>Provincial Address</td>
                                    <td class="text-bold">@{{ student.provincial_address }}</td>
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
                                    <td>Year Level</td>
                                    <td class="text-bold">@{{ student.year }}</td>
                                </tr>
                                <tr>
                                    <td>Course</td>
                                    <td class="text-bold">@{{ student.course }}</td>
                                </tr>
                                <tr>
                                    <td>Program</td>
                                    <td class="text-bold">@{{ student.program_id.name }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-striped table-bordered table-condensed">
                            <tbody>
                                <tr>
                                    <td colspan="2" class="text-bold">Father Details</td>
                                </tr>
                                <tr>
                                    <td>First Name</td>
                                    <td class="text-bold">@{{ father.first_name }}</td>
                                </tr>
                                <tr>
                                    <td>Middle Name</td>
                                    <td class="text-bold">@{{ father.middle_name }}</td>
                                </tr>
                                <tr>
                                    <td>Last Name</td>
                                    <td class="text-bold">@{{ father.last_name }}</td>
                                </tr>
                                <tr>
                                    <td>Occupation</td>
                                    <td class="text-bold">@{{ father.occupation }}</td>
                                </tr>
                                <tr>
                                    <td>Company</td>
                                    <td class="text-bold">@{{ father.company }}</td>
                                </tr>
                                <tr>
                                    <td>Contact No.</td>
                                    <td class="text-bold">@{{ father.contact_no }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-striped table-bordered table-condensed">
                            <tbody>
                                <tr>
                                    <td colspan="2" class="text-bold">Mother Details</td>
                                </tr>
                                <tr>
                                    <td>First Name</td>
                                    <td class="text-bold">@{{ mother.first_name }}</td>
                                </tr>
                                <tr>
                                    <td>Middle Name</td>
                                    <td class="text-bold">@{{ mother.middle_name }}</td>
                                </tr>
                                <tr>
                                    <td>Last Name</td>
                                    <td class="text-bold">@{{ mother.last_name }}</td>
                                </tr>
                                <tr>
                                    <td>Occupation</td>
                                    <td class="text-bold">@{{ mother.occupation }}</td>
                                </tr>
                                <tr>
                                    <td>Company</td>
                                    <td class="text-bold">@{{ mother.company }}</td>
                                </tr>
                                <tr>
                                    <td>Contact No.</td>
                                    <td class="text-bold">@{{ mother.contact_no }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-striped table-bordered table-condensed">
                            <tbody>
                                <tr>
                                    <td colspan="2" class="text-bold">Primary Education</td>
                                </tr>
                                <tr>
                                    <td>School</td>
                                    <td class="text-bold">@{{ primary.school }}</td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td class="text-bold">@{{ primary.address }}</td>
                                </tr>
                                <tr>
                                    <td>Date Graduated</td>
                                    <td class="text-bold">@{{ primary.date_graduated }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-striped table-bordered table-condensed">
                            <tbody>
                                <tr>
                                    <td colspan="2" class="text-bold">Secondary Education</td>
                                </tr>
                                <tr>
                                    <td>School</td>
                                    <td class="text-bold">@{{ secondary.school }}</td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td class="text-bold">@{{ secondary.address }}</td>
                                </tr>
                                <tr>
                                    <td>Date Graduated</td>
                                    <td class="text-bold">@{{ secondary.date_graduated }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-striped table-bordered table-condensed">
                            <tbody>
                            <tr>
                                <td colspan="2" class="text-bold">Tertiary Education</td>
                            </tr>
                            <tr>
                                <td>School</td>
                                <td class="text-bold">@{{ tertiary.school.name }}</td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td class="text-bold">@{{ tertiary.address }}</td>
                            </tr>
                            <tr>
                                <td>Degree</td>
                                <td class="text-bold">@{{ tertiary.degree }}</td>
                            </tr>
                            <tr>
                                <td>Date Graduated</td>
                                <td class="text-bold">@{{ tertiary.date_graduated }}</td>
                            </tr>
                            </tbody>
                        </table>
                        <table class="table table-striped table-condensed">
                            <tbody>
                                <tr>
                                    <td colspan="2" class="text-bold">Experience Details</td>
                                </tr>
                                <tr v-for="experience in experiences">
                                    <td>
                                        <table class="table table-striped table-bordered table-condensed">
                                            <tbody>
                                                <tr>
                                                    <td>Company</td>
                                                    <td class="text-bold">@{{ experience.company }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Address</td>
                                                    <td class="text-bold">@{{ experience.address }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Description</td>
                                                    <td class="text-bold">@{{ experience.description }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Start Date</td>
                                                    <td class="text-bold">@{{ experience.start_date }}</td>
                                                </tr>
                                                <tr>
                                                    <td>End Date</td>
                                                    <td class="text-bold">@{{ experience.end_date }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
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
                school: [],
                programs: [],
                program: [],
                student : {
                    firstName: '',
                    middleName: '',
                    lastName: '',
                    birthDate: '',
                    gender: '',
                    homeNumber: '',
                    mobileNumber: '',
                    provincial_address: '',
                    permanent_address: '',
                    school: '',
                    year: '',
                    course: '',
                    program_id: '',
                    skype_id: '',
                    fb_email: ''
                },
                father: {
                    first_name: '',
                    middle_name: '',
                    last_name: '',
                    occupation: '',
                    company: '',
                    contact_no: ''
                },
                mother: {
                    first_name: '',
                    middle_name: '',
                    last_name: '',
                    occupation: '',
                    company: '',
                    contact_no: '',
                },
                primary: {
                    school: '',
                    address: '',
                    date_graduated: ''
                },
                secondary: {
                    school: '',
                    address: '',
                    date_graduated: ''
                },
                tertiary: {
                    school: '',
                    degree: '',
                    address: '',
                    date_graduated: ''
                },
                experiences: [
                    {
                        company: '',
                        address: '',
                        description: '',
                        start_date: '',
                        end_date: '',
                        presentDate: false
                    }
                ],
                errors: [],
                loading: false,
                sameAsAbove: false,
            },
            mounted: function () {
                $('#agreement-modal').modal('show');
                this.loadSchools();
                this.loadPrograms();
            },
            watch: {
                sameAsAbove: function (value) {
                    if (value) {
                        this.student.provincial_address = this.student.permanent_address;
                    } else {
                        this.student.provincial_address = '';
                    }
                },
                presentDate: function (value) {
                    if (!value) {
                        return true;
                    } else {
                        return false;
                    }
                }
            },
            methods: {
                addElement() {
                    this.experiences.push({
                        company : '',
                        address: '',
                        description: '',
                        start_date: '',
                        end_date: ''
                    });
                },
                deleteElement() {
                    this.experiences.pop();
                },
                agree() {
                    $('#agreement-modal').modal('hide');
                },
                submit() {
                    let formData = new FormData();
                    formData.append('first_name', this.student.firstName);
                    formData.append('middle_name', this.student.middleName);
                    formData.append('last_name', this.student.lastName);
                    formData.append('birthdate', this.student.birthDate);
                    formData.append('gender', this.student.gender);
                    formData.append('home_number', this.student.homeNumber);
                    formData.append('mobile_number', this.student.mobileNumber);
                    formData.append('permanent_address', this.student.permanent_address);
                    formData.append('provincial_address', this.student.provincial_address);
                    formData.append('fb_email', this.student.fb_email);
                    formData.append('skype_id', this.student.skype_id);
                    formData.append('year', this.student.year);
                    formData.append('program_id', this.student.program_id.id);
                    formData.append('f_first_name', this.father.first_name);
                    formData.append('f_middle_name', this.father.middle_name);
                    formData.append('f_last_name', this.father.last_name);
                    formData.append('f_occupation', this.father.occupation);
                    formData.append('f_company', this.father.company);
                    formData.append('f_contact', this.father.contact_no);
                    formData.append('m_first_name', this.mother.first_name);
                    formData.append('m_middle_name', this.mother.middle_name);
                    formData.append('m_last_name', this.mother.last_name);
                    formData.append('m_occupation', this.mother.occupation);
                    formData.append('m_company', this.mother.company);
                    formData.append('m_contact', this.mother.contact_no);
                    formData.append('p_school', this.primary.school);
                    formData.append('p_address', this.primary.address);
                    formData.append('p_date_graduated', this.primary.date_graduated);
                    formData.append('s_school', this.secondary.school);
                    formData.append('s_address', this.secondary.address);
                    formData.append('s_date_graduated', this.secondary.date_graduated);
                    formData.append('t_school', this.tertiary.school.name);
                    formData.append('t_degree', this.tertiary.degree);
                    formData.append('t_address', this.tertiary.address);
                    formData.append('t_date_graduated', this.tertiary.date_graduated);
                    formData.append('experience', JSON.stringify(this.experiences));
                    this.loading = true;
                    axios.post(`/stud/details/store`, formData)
                        .then((response) => {
                            location.href = '{{ route('dash.student') }}'
                        }).catch((error) => {
                            console.log(error);
                    });
                },
                validate() {
                    let formData = new FormData();
                    formData.append('first_name', this.student.firstName);
                    formData.append('middle_name', this.student.middleName);
                    formData.append('last_name', this.student.lastName);
                    formData.append('birthdate', this.student.birthDate);
                    formData.append('gender', this.student.gender);
                    formData.append('home_number', this.student.homeNumber);
                    formData.append('mobile_number', this.student.mobileNumber);
                    formData.append('provincial_address', this.student.provincial_address);
                    formData.append('permanent_address', this.student.permanent_address);
                    formData.append('fb_email', this.student.fb_email);
                    formData.append('skype_id', this.student.skype_id);
                    formData.append('year', this.student.year);
                    formData.append('program_id', this.student.program_id.id);
                    formData.append('f_first_name', this.father.first_name);
                    formData.append('f_middle_name', this.father.middle_name);
                    formData.append('f_last_name', this.father.last_name);
                    formData.append('f_occupation', this.father.occupation);
                    formData.append('f_company', this.father.company);
                    formData.append('f_contact', this.father.contact_no);
                    formData.append('m_first_name', this.mother.first_name);
                    formData.append('m_middle_name', this.mother.middle_name);
                    formData.append('m_last_name', this.mother.last_name);
                    formData.append('m_occupation', this.mother.occupation);
                    formData.append('m_company', this.mother.company);
                    formData.append('m_contact', this.mother.contact_no);
                    formData.append('p_school', this.primary.school);
                    formData.append('p_address', this.primary.address);
                    formData.append('p_date_graduated', this.primary.date_graduated);
                    formData.append('s_school', this.secondary.school);
                    formData.append('s_address', this.secondary.address);
                    formData.append('s_date_graduated', this.secondary.date_graduated);
                    formData.append('t_school', this.tertiary.school.name);
                    formData.append('t_degree', this.tertiary.degree);
                    formData.append('t_address', this.tertiary.address);
                    formData.append('t_date_graduated', this.tertiary.date_graduated);
                    formData.append('experience', JSON.stringify(this.experiences));

                    axios.post(`/stud/validateDetails`, formData)
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
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
                    <div class="progress sm">
                        <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" :style="'width:' + level / 5 * 100 + '%'"></div>
                    </div>
                    <div class="text-center">
                        <i style="font-size: 18px;">
                            <b>IMPORTANT REMINDER: Please complete ALL information for <i style="color: red">successful</i> registration.</b>
                        </i>
                        <br>
                        <i style="font-size: 15px; color: red;">
                            <b>Fields with asterisks (*) are required. Put N/A if not applicable.</b>
                        </i>
                        <br>
                    </div>
                    <div class="box box-default m-t-20">
                        <div class="box-body">
                            <section id="level-one" v-if="level === 1">
                                <h4>
                                    <b>PERSONAL DETAILS</b>
                                </h4>
                                <br>
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
                                        <label for="">Facebook URL <i class="text-red">*</i></label>
                                        <input v-model="student.fb_email" type="text" class="form-control input-sm" placeholder="https://www.facebook.com/sample">
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
                                        <span class="help-block text-red" v-if="errors.year">@{{ errors.year[0] }}</span>
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
                                <div class="row">
                                    <div class="form-group col-xs-12">
                                        <label for="">Nearest ZIP Travel Branch</label>
                                        <select v-model="student.branch" class="form-control input-sm">
                                            <option value="">Select Nearest Branch</option>
                                            <option value="MANILA">Manila</option>
                                            <option value="PAMPANGA">Pampanga</option>
                                            <option value="CEBU">Cebu</option>
                                            <option value="DAVAO">Davao</option>
                                            <option value="BACOLOD">Bacolod</option>
                                        </select>
                                        <span class="help-block text-red" v-if="errors.branch">@{{ errors.branch[0] }}</span>
                                    </div>
                                </div>
                            </section>
                            <section action="" id="level-four" v-if="level === 2">
                                <h4>
                                    <b>EDUCATIONAL BACKGROUND</b>
                                </h4>
                                <br>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <label for="" class="control-label">Tertiary</label>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-12">
                                        <label for="">School Name <i class="text-red">*</i></label>
                                        <select v-model="tertiary.school" class="form-control input-sm">
                                            <option value="" active>Select School</option>
                                            <option v-for="item in schools" :value="{ id: item.id, name: item.name }">@{{ item.name }}</option>
                                            <!--<option value="others">Other school...</option>-->
                                        </select>
                                        <input v-if="tertiary.school == 'others'" v-model="tertiary.other_school" type="text" class="form-control input-sm m-t-10" placeholder="Enter other school">
                                        <span class="help-block text-red" v-if="errors.t_school">required</span>
                                    </div>
                                    <div class="form-group col-xs-12">
                                        <label for="">Degree <i class="text-red">*</i></label>
                                        <select v-model="tertiary.degree" class="form-control input-sm">
                                            <option value="">Select Degree</option>
                                            <option v-for="degree in degrees" :value="degree.name">@{{ degree.display_name }}</option>
                                            <option value="others">Other degree...</option>
                                        </select>
                                        <input v-if="tertiary.degree == 'others'" v-model="tertiary.other_degree" type="text" class="form-control input-sm m-t-10" placeholder="Enter other degree">
                                        <span class="help-block text-red" v-if="errors.t_degree">required</span>
                                    </div>
                                    <div class="form-group col-xs-12">
                                        <label for="">Address <i class="text-red">*</i></label>
                                        <input v-model="tertiary.address" type="text" class="form-control input-sm" placeholder="Tertiary School Address">
                                        <span class="help-block text-red" v-if="errors.t_address">required</span>
                                    </div>
                                    <div class="form-group col-xs-6">
                                        <label for="">Start Date <i class="text-red">*</i></label>
                                        <input v-model="tertiary.start_date" type="date" class="form-control input-sm">
                                        <span class="help-block text-red" v-if="errors.t_start_date">required</span>
                                    </div>
                                    <div class="form-group col-xs-6">
                                        <label for="">Date Graduated (<small>date indicated in diploma</small>)<i class="text-red">*</i></label>
                                        <input v-model="tertiary.date_graduated" type="date" class="form-control input-sm">
                                        <span class="help-block text-red" v-if="errors.t_date_graduated">required</span>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <label for="" class="control-label">Secondary</label>
                                    </div>
                                    <div class="form-group col-xs-12">
                                        <label for="">School Name <i class="text-red">*</i></label>
                                        <input v-model="secondary.school" type="text" class="form-control input-sm" placeholder="Secondary School Name">
                                        <span class="help-block text-red" v-if="errors.s_school">required</span>
                                    </div>
                                    <div class="form-group col-xs-12">
                                        <label for="">Address <i class="text-red">*</i></label>
                                        <input v-model="secondary.address" type="text" class="form-control input-sm" placeholder="Secondary School Address">
                                        <span class="help-block text-red" v-if="errors.s_address">required</span>
                                    </div>
                                    <div class="form-group col-xs-6">
                                        <label for="">Start Date <i class="text-red">*</i></label>
                                        <input v-model="secondary.start_date" type="date" class="form-control input-sm" placeholder="Secondary Start Date">
                                        <span class="help-block text-red" v-if="errors.s_start_date">required</span>
                                    </div>
                                    <div class="form-group col-xs-6">
                                        <label for="">Date Graduated <i class="text-red">*</i></label>
                                        <input v-model="secondary.date_graduated" type="date" class="form-control input-sm">
                                        <span class="help-block text-red" v-if="errors.s_date_graduated">required</span>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <label for="" class="control-label">Primary</label>
                                    </div>
                                    <div class="form-group col-xs-12">
                                        <label for="">School Name <i class="text-red">*</i></label>
                                        <input v-model="primary.school" type="text" class="form-control input-sm" placeholder="Primary School Name">
                                        <span class="help-block text-red" v-if="errors.p_school">required</span>
                                    </div>
                                    <div class="form-group col-xs-12">
                                        <label for="">Address <i class="text-red">*</i></label>
                                        <input v-model="primary.address" type="text" class="form-control input-sm" placeholder="Primary School Address">
                                        <span class="help-block text-red" v-if="errors.p_address">required</span>
                                    </div>
                                    <!--
                                    <div class="form-group col-xs-6">
                                        <label for="">Start Date <i class="text-re">*</i></label>
                                        <input v-model="tertiary.start_date" type="date" class="form-control input-sm" placeholder="Tertiary Start Date">
                                        <span class="help-block text-red" v-if="errors.t_start_date">required</span>
                                    </div>
                                    -->
                                    <div class="form-group col-xs-12">
                                        <label for="">Date Graduated <i class="text-red">*</i></label>
                                        <input v-model="primary.date_graduated" type="month" class="form-control input-sm">
                                        <span class="help-block text-red" v-if="errors.p_date_graduated">required</span>
                                    </div>
                                </div>
                            </section>
                            <section id="level-two" v-if="level === 3">
                                <h4>
                                    <b>CONTACT DETAILS</b>
                                </h4>
                                <br>
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-6 col-md-6">
                                        <label for="">Home Number:</label>
                                        <input v-model="student.homeNumber" type="text" class="form-control input-sm" maxlength="11" placeholder="(02) 673-1234">
                                        <span class="help-block text-red" v-if="errors.home_number">required</span>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-6 col-md-6">
                                        <label for="">Mobile Number: <i class="text-red">*</i></label>
                                        <input v-model="student.mobileNumber" type="number" class="form-control input-sm" maxlength="11" placeholder="+63 912 3456 789">
                                        <span class="help-block text-red" v-if="errors.mobile_number">required</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-xs-12">
                                        <label for="">Present Address: <i class="text-red">*</i></label>
                                        <textarea v-model="student.permanent_address" class="form-control input-sm" placeholder="Permanent Address"></textarea>
                                        <span class="help-block text-red" v-if="errors.provincial_address">required</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-xs-12">
                                        <label for="">Permanent Address: <i class="text-red">*</i></label>
                                        <div class="pull-right">
                                            <label for="" class="text-sm p-r-5">Same as Above</label>
                                            <input v-model="sameAsAbove" type="checkbox" class="pull-right">
                                        </div>
                                        <textarea v-model="student.provincial_address" class="form-control input-sm" placeholder="Provincial Address"></textarea>
                                        <span class="help-block text-red" v-if="errors.permanent_address">required</span>
                                    </div>
                                </div>
                            </section>
                            <section id="level-three" v-if="level === 4">
                                <h4>
                                    <b>PARENT'S DETAILS</b>
                                </h4>
                                <br>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <label for="" class="control-label">Father's Details</label>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-4 col-md-4">
                                        <label for="">First Name <i class="text-red">*</i></label>
                                        <input v-model="father.first_name" type="text" class="form-control input-sm" placeholder="Father's First Name">
                                        <span class="help-block text-red" v-if="errors.f_first_name">required</span>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-4 col-md-4">
                                        <label for="">Middle Name <i class="text-red">*</i></label>
                                        <input v-model="father.middle_name" type="text" class="form-control input-sm" placeholder="Father's Middle Name">
                                        <span class="help-block text-red" v-if="errors.f_middle_name">required</span>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-4 col-md-4">
                                        <label for="">Last Name <i class="text-red">*</i></label>
                                        <input v-model="father.last_name" type="text" class="form-control input-sm" placeholder="Father's Last Name">
                                        <span class="help-block text-red" v-if="errors.f_last_name">required</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-4 col-md-4">
                                        <label for="">Occupation <i class="text-red">*</i></label>
                                        <input v-model="father.occupation" type="text" class="form-control input-sm" placeholder="Father's Occupation">
                                        <span class="help-block text-red" v-if="errors.f_occupation">required</span>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-4 col-md-4">
                                        <label for="">Company <i class="text-red">*</i></label>
                                        <input v-model="father.company" type="text" class="form-control input-sm" placeholder="Father's Company">
                                        <span class="help-block text-red" v-if="errors.f_company">required</span>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-4 col-md-4">
                                        <label for="">Contact No. <i class="text-red">*</i></label>
                                        <input v-model="father.contact_no" type="number" class="form-control input-sm" placeholder="Father's Contact No.">
                                        <span class="help-block text-red" v-if="errors.f_contact">required</span>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <label for="" class="control-label">Mother's Details</label>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-4 col-md-4">
                                        <label for="">First Name <i class="text-red">*</i></label>
                                        <input v-model="mother.first_name" type="text" class="form-control input-sm" placeholder="Mother's First Name">
                                        <span class="help-block text-red" v-if="errors.m_first_name">required</span>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-4 col-md-4">
                                        <label for="">Middle Name <i class="text-red">*</i></label>
                                        <input v-model="mother.middle_name" type="text" class="form-control input-sm" placeholder="Mother's Middle Name">
                                        <span class="help-block text-red" v-if="errors.m_middle_name">required</span>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-4 col-md-4">
                                        <label for="">Last Name <i class="text-red">*</i></label>
                                        <input v-model="mother.last_name" type="text" class="form-control input-sm" placeholder="Mother's Last Name">
                                        <span class="help-block text-red" v-if="errors.m_last_name">required</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-xs-12 col-sm-4 col-md-4">
                                        <label for="">Occupation <i class="text-red">*</i></label>
                                        <input v-model="mother.occupation" type="text" class="form-control input-sm" placeholder="Mother's Occupation">
                                        <span class="help-block text-red" v-if="errors.m_occupation">required</span>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-4 col-md-4">
                                        <label for="">Company <i class="text-red">*</i></label>
                                        <input v-model="mother.company" type="text" class="form-control input-sm" placeholder="Mother's Company">
                                        <span class="help-block text-red" v-if="errors.m_company">required</span>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-4 col-md-4">
                                        <label for="">Contact No. <i class="text-red">*</i></label>
                                        <input v-model="mother.contact_no" type="number" class="form-control input-sm" placeholder="Mother's Contact No.">
                                        <span class="help-block text-red" v-if="errors.m_contact">required</span>
                                    </div>
                                </div>
                            </section>

                            <section id="level-five" v-if="level === 5">
                                <button class="btn btn-primary btn-xs btn-flat pull-right" @click="deleteElement()">Remove</button>
                                <button class="btn btn-primary btn-xs btn-flat pull-right" @click="addElement()">Add</button>
                                <h4>
                                    <b>WORK EXPERIENCE/ON-THE-JOB TRAINING</b>
                                </h4>
                                <br>

                                <s>
                                    <div class="row" v-for="item in experiences">
                                        <div class="form-group col-xs-12">
                                            <label for="">Company Name <i class="text-red">*</i></label>
                                            <input v-model="item.company" type="text" class="form-control input-sm" placeholder="Company Name">
                                            <span class="help-block text-red" v-if="errors.company">required</span>
                                        </div>
                                        <div class="form-group col-xs-12">
                                            <label for="">Address <i class="text-red">*</i></label>
                                            <input v-model="item.address" type="text" class="form-control input-sm" placeholder="Company Address">
                                            <span class="help-block text-red" v-if="errors.address">required</span>
                                        </div>
                                        <div class="form-group col-xs-12">
                                            <label for="">Job Description <i class="text-red">*</i></label>
                                            <textarea v-model="item.description"
                                                      class="form-control input-sm" placeholder="Your Job Description"></textarea>
                                                      <span class="help-block text-red" v-if="errors.description">required</span>
                                        </div>
                                        <div class="form-group col-xs-6">
                                            <label for="">Start Date <i class="text-red">*</i></label>
                                            <input v-model="item.start_date" type="date" class="form-control input-sm">
                                            <span class="help-block text-red" v-if="errors.start_date">required</span>
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
                                </section>
                            </section>
                            <div class="form-group">
                                <button @click="validate" class="btn btn-primary btn-block btn-flat btn-sm">@{{ (level == 5) ? 'Validate' : 'Next' }}</button>
                                <button v-if="level == 1 ? false : true" @click="prevForm()" class="btn btn-primary btn-block btn-flat btn-sm">Previous</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="agreement-modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">ZIP Travel Philippines - Privacy Policy</h4>
                    </div>
                    <div class="modal-body">
                        <div style="height: 78vh; width: 100%; padding: 20px; overflow-y: scroll;">
                                <b>I. PRIVACY POLICY STATEMENT</b>
                                <p style="text-align: justify;">
                                In accordance with the Data Privacy Act of 2019, and in recognition of our clients’ right to privacy and security of their information and documents, Zip Travel Philippines, through this privacy policy, outlines the guidelines of how the company collects, stores, shares, and processes information and documents that the applicants may provide/upload upon registering in the company portal. As such, it is understood that upon registration, the applicant authorizes Zip Travel Philippines, its affiliates, partner schools, visa sponsors, and the pertinent government entities, and organizations, to use any and all information and/or documents that he/she may provide/upload, for the processing of his/her pertinent program application. It is also understood that the applicant authorizes the company, the government of the Philippines, its agencies, and its political subdivisions, and the US government, its agencies, and its political subdivisions, to use such information and/or documents for the enforcement, and to ensure compliance with any pertinent Philippine and US law/s. Rest assured, any and all information and/or document, provided/uploaded in the website portal shall be kept confidential, and shall not be used for anything not related to the processing of the applicant’s program application, and the enforcement and/or compliance with any pertinent Philippine and US law, without the applicant’s consent.
                                </p>               
                                                
                                <b>II.	INFORMATION COLLECTION AND STORAGE</b>
                                <p style="text-align: justify;">
                                Upon registration and in consonant with the needs and requirements of their program application, and pertinent Philippine and US law/s, program applicants may be asked to provide/upload information and/or documents which includes but is not limited to:
                                </p>                                
                                
                                <b>PRELIMINIARY DOCUMENTS:</b>
                                <ul>
                                    <li>Update Resume</li>
                                    <li>General Application/Registration Form</li>
                                    <li>Application Letter/Letter of Introduction/Motivational Letter</li>
                                    <li>2x2 Picture</li>
                                    <li>Casual Photo (with friends or family)</li>
                                    <li>Valid Passport</li>
                                    <li>Copy of Grades/Transcript of Records</li>
                                    <li>Proof of Student Status/Certificate of Graduation/Diploma</li>
                                    <li>Two (2) Recommendation Letters</li>
                                    <li>Certificate of Employment (Applicable to trainee only)</li>
                                    <li>Previous or existing US Visa - if applicable</li>
                                    <li>US Social Security Card - if applicable</li>
                                </ul>
                                
                                <b>VISA SPONSORSHIP FORMS:</b>
                                <ul>
                                    <li>Sponsorship Form 1</li>
                                    <li>Sponsorship Form 2</li>
                                    <li>Sponsorship Form 4</li>
                                    <li>Sponsorship Form 4</li>
                                    <li>Sponsorship Form 5</li>
                                    <li>Sponsorship Form 6</li>
                                </ul>
                                
                                <b>ADDITIONAL DOCUMENTS:</b>
                                <ul>
                                    <li>Affidavit of Financial Support</li>
                                    <li>NBI Clearance</li>
                                    <li>Medical Certificate</li>
                                    <li>Barangay Clearance – Student</li>
                                    <li>Barangay Clearance – Parent</li>
                                    <li>Parent’s Certificate of Employment</li>
                                </ul>
                                
                                <b>PROOF OF PAYMENTS</b>
                                <p style="text-align: justify;">
                                Information and/or documents provided/uploaded by the program applicant in the portal are collected and stored in the server Zip Travel Philippines’ website. The company website and server are accessed, managed, and controlled by Zip Travel Philippines, and is hosted by Contabo, a third-party website hosting platform located in Germany. Be that as it may, Contabo, has no access to any information and document provided/uploaded, and stored in the company website and server.
                                </p>
                                <b>III. INFORMATION SHARING AND PROCESSING</b>
                                <p style="text-align: justify;">
                                Information and/or documents provided/uploaded in the company website and stored in the website server are used for the processing of the applicant’s program application, and the enforcement and compliance with any pertinent Philippine and US laws. In addition, such information and/or documents are forwarded and shared to the company’s affiliates, partner schools, visa sponsors, and the following government entities, and organizations, for the processing of their program application and to ensure compliance with any pertinent Philippine and US law/s
                                </p>
                                <b>Visa Sponsors (such as but not limited to):</b>
                                <ul>
                                    <li>Alliance Abroad Group</li>
                                    <li>InterExchange</li>
                                    <li>Cultural Homestay International</li>
                                    <li>International Cultural Exchange Organization</li>
                                </ul>
                                    
                                <b>IV.	RIGHTS OF THE APPLICANT</b>
                                <p style="text-align: justify;">
                                Upon registration and by providing/uploading information and/or documents needed for the processing of applicant’s program application, and for the enforcement and compliance with any pertinent Philippine and US law/s, Zip Travel Philippines recognizes the applicant’s rights to privacy and security of information and documents. As such, in consonant with Section 16 of the Data Privacy Act of 2012, and any other pertinent Philippine and US law/s, it is recognized that the applicant has the following rights:
                                </p>
                                <ol>
                                    <li>Be informed of the collection, storage, and processing of the provided/uploaded information and/or documents, upon demand.</li>
                                    <li>Be informed of the way the provided/uploaded information and/or documents are accessed, processed, and/or used, the corresponding reasons for such access, processing, and usage, and who or which entities have accessed, processed, and used such information and/or documents, upon demand.</li>
                                    <li>Rectification/amendment of any information and/or documents provided/uploaded, upon demand, provided that there is due compliance with any corresponding processes, and/or pertinent Philippine and US law/s.</li>
                                    <li>Suspension of the accessing, processing, and/or usage, of any information and/or documents provided/uploaded, upon demand, provided that there is due compliance with any corresponding processes, and/or pertinent Philippine and US law/s.</li>
                                    <li>Withdraw, block, delete, or destroy any information and/or documents provided/uploaded, upon demand, provided that there is due compliance with any corresponding processes, and/or pertinent Philippine and US law/s.</li>
                                    <li>Be indemnified for any damages sustained due to false, unlawfully obtained, unauthorized, or improper use of the information and/or documents by the company, provided that such damage is duly proved, and by virtue of a valid judgment by a court of competent jurisdiction rendered against the company.</li>
                                </ol>
                                <b>V. USE OF COOKIES</b>
                                <p style="text-align: justify;">
                                Usage of Zip Travel Philippines’ website entails the sending of cookies, a text file containing alphanumeric characters, to the user’s computer or device. Said cookies ensure that the user has a faster and smoother navigation and access to the company website. It also allows us to track how the user accesses and uses our website, which we could use to improve and provide a better service through our website. Cookies can be controlled or reset through the computer’s or device’s web browser. However, it is advised that the user allows the usage and sending of cookies, since restricting or prohibiting cookies, may disable some of the features and functionality of the website, and may affect the ease of use and navigation.
                                </p>
                                <b>VI.	CHANGES TO THE PRIVACY POLICY</b>
                                <p style="text-align: justify;">
                                Zip Travel Philippines has the right to change/modify/update its Privacy Policy as the needs of its information practices or business practices, and pertinent law/s may require. Any material changes/modifications/updates in the policy shall be posted in the company website. As such, it is encouraged that the applicant or user periodically review the Privacy Policy. Registration by the applicant, and the continued use and access of the website by any user, is deemed to be an implied acceptance to the current Privacy Policy, or to any changes to the policy that may take effect.
                                </p>
                                <p style="text-align: justify;">
                                    For any inquiries or concern regarding Zip Travel Philippines’ Privacy Policy, you may contact us at (632) <b>5598213</b> or email us at <a href="mailto:info@ziptravel.com.ph">info@ziptravel.com.ph</a>.
                                </p>
                                <br>
                                Thank you.
                        </div>
                    </div>
                    <div class="modal-footer clearfix">
                        <button @click="agree" class="btn btn-success btn-flat btn-sm pull-right m-r-5">I Agree</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <div class="modal fade" id="verify-modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="overlay-wrapper">
                        <div class="overlay" :style="{ display: loading ? 'block' : 'none' }">
                            <i class="fa fa-circle-o-notch fa-spin"></i>
                        </div>
                    </div>
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
                                    <td style="width: 30%;">First Name</td>
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
                                    <td>Present Address</td>
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
                                    <td>Program</td>
                                    <td class="text-bold">@{{ student.program_id.name }}</td>
                                </tr>
                                <tr>
                                    <td>ZIP Branch</td>
                                    <td class="text-bold">@{{ student.branch }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-striped table-bordered table-condensed">
                            <tbody>
                                <tr>
                                    <td colspan="2" class="text-bold">Father Details</td>
                                </tr>
                                <tr>
                                    <td style="width: 30%">First Name</td>
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
                                    <td style="width: 30%;">First Name</td>
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
                                    <td style="width: 30%;">School</td>
                                    <td class="text-bold">@{{ primary.school }}</td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td class="text-bold">@{{ primary.address }}</td>
                                </tr>
                                <tr>
                                    <td>Date Graduated</td>
                                    <td class="text-bold">@{{ primary.date_graduated | toFormattedDateString }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-striped table-bordered table-condensed">
                            <tbody>
                                <tr>
                                    <td colspan="2" class="text-bold">Secondary Education</td>
                                </tr>
                                <tr>
                                    <td style="width: 30%;">School</td>
                                    <td class="text-bold">@{{ secondary.school }}</td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td class="text-bold">@{{ secondary.address }}</td>
                                </tr>
                                <tr>
                                    <td>Start Date</td>
                                    <td class="text-bold">@{{ secondary.start_date | toFormattedDateString }}</td>
                                </tr>
                                <tr>
                                    <td>Date Graduated</td>
                                    <td class="text-bold">@{{ secondary.date_graduated | toFormattedDateString }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-striped table-bordered table-condensed">
                            <tbody>
                            <tr>
                                <td colspan="2" class="text-bold">Tertiary Education</td>
                            </tr>
                            <tr>
                                <td style="width: 30%;">School</td>
                                <td class="text-bold">@{{ (tertiary.school == 'others') ? tertiary.other_school : tertiary.school.name }}</td>
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
                                <td>Start Date</td>
                                <td class="text-bold">@{{ tertiary.start_date | toFormattedDateString }}</td>
                            </tr>
                            <tr>
                                <td>Date Graduated</td>
                                <td class="text-bold">@{{ tertiary.date_graduated | toFormattedDateString }}</td>
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
                                                    <td style="width: 30%;">Company</td>
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
                                                    <td class="text-bold">@{{ experience.start_date | toFormattedDateString }}</td>
                                                </tr>
                                                <tr>
                                                    <td>End Date</td>
                                                    <td class="text-bold">@{{ (experience.presentDate == true) ? 'Present' : experience.end_date }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer clearfix">
                        <button :disabled="button_disabled" @click="submit" class="btn btn-success btn-flat btn-sm btn-block pull-right">Submit</button>
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
                button_disabled: false,
                level: 1,
                schools: [],
                school: [],
                programs: [],
                program: [],
                degrees: [],
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
                    fb_email: '',
                    branch: ''
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
                    start_date: '',
                    date_graduated: ''
                },
                tertiary: {
                    school: '',
                    other_school: '',
                    degree: '',
                    other_degree: '',
                    address: '',
                    start_date: '',
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
                sameAsAbove: false
            },
            mounted: function () {
                $('#agreement-modal').modal('show');
                this.loadSchools();
                this.loadPrograms();
                this.loadDegrees();
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
                nextForm() {
                    this.level++;
                },
                prevForm() {
                    this.level--;
                },
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
                    formData.append('s_start_date', this.secondary.start_date);
                    formData.append('s_date_graduated', this.secondary.date_graduated);
                    formData.append('t_school', (this.tertiary.school == 'others') ? this.tertiary.other_school : this.tertiary.school.id);
                    formData.append('t_degree', (this.tertiary.degree == 'others') ? this.tertiary.other_degree : this.tertiary.degree);
                    formData.append('t_address', this.tertiary.address);
                    formData.append('t_start_date', this.tertiary.start_date);
                    formData.append('t_date_graduated', this.tertiary.date_graduated);
                    formData.append('branch', this.student.branch);
                    formData.append('experience', JSON.stringify(this.experiences));
                    this.loading = true;
                    this.button_disabled = true;
                    axios.post(`/stud/details/store`, formData)
                        .then((response) => {
                            this.button_disabled = false;
                            location.href = '{{ route('dash.student') }}'
                        }).catch((error) => {
                            $('#verify-modal').modal('hide')
                            this.button_disabled = false;
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
                    formData.append('program_id', (this.student.program_id) ? this.student.program_id.id : '');
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
                    formData.append('s_start_date', this.secondary.start_date);
                    formData.append('s_date_graduated', this.secondary.date_graduated);
                    formData.append('t_school', (this.tertiary.school) ? this.tertiary.school.name : '');
                    formData.append('t_degree', (this.tertiary.degree == 'others') ? this.tertiary.other_degree : this.tertiary.degree);
                    formData.append('t_address', this.tertiary.address);
                    formData.append('t_start_date', this.tertiary.start_date);
                    formData.append('t_date_graduated', this.tertiary.date_graduated);
                    formData.append('branch', this.student.branch);
                    formData.append('experience', this.experiences);

                    axios.post(`/stud/validateDetails/${this.level}`, formData)
                        .then((response) => {
                            if (this.level == 5) {
                                this.experiences.forEach((item, index) => {
                                    if(item.company == '') {
                                        swal({
                                            title: 'Please fill all the required fields.',
                                            type: 'error',
                                            confirmButtonText: 'Go Back'
                                        })
                                    }
                                    else if(item.address == '') {
                                        swal({
                                            title: 'Please fill all the required fields.',
                                            type: 'error',
                                            confirmButtonText: 'Go Back'
                                        })
                                    }
                                    else if(item.description == '') {
                                        swal({
                                            title: 'Please fill all the required fields.',
                                            type: 'error',
                                            confirmButtonText: 'Go Back'
                                        })
                                    }
                                    else if(item.start_date == '') {
                                        swal({
                                            title: 'Please fill all the required fields.',
                                            type: 'error',
                                            confirmButtonText: 'Go Back'
                                        })
                                    }
                                    else {
                                        $('#verify-modal').modal('show');
                                    }
                                })
                            } else {
                                this.level += 1;
                            }

                            this.errors = '';
                        }).catch((error) => {
                            this.errors = error.response.data.errors;
                            swal({
                                title: 'Please fill all the required fields.',
                                type: 'error',
                                confirmButtonText: 'Go Back'
                            })
                    });
                },
                loadSchools() {
                    axios.get(`/school/view`)
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
                },
                loadDegrees() {
                    axios.get('/degree/getAll')
                        .then((response) => {
                            this.degrees = response.data;
                        })
                        .catch((error) => {
                            console.log(error);
                        })
                }
            }
        });
    </script>
@endsection
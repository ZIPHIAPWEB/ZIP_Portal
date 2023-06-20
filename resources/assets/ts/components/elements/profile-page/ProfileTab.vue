<script setup lang="ts">
import WorkExperienceItem from './WorkExperienceItem.vue';

import StudentAPI from '../../../services/StudentAPI';
import { PersonalType, PersonalInitial } from '../../../types/PersonalType';
import { ContactType, ContactInitial } from '../../../types/ContactType';
import { TertiaryType, TertiaryInitial } from '../../../types/TertiaryType';
import { SecondaryType, SecondaryInitial } from '../../../types/SecondaryType';
import { ParentType, ParentInitial } from '../../../types/ParentType';

import SchoolAPI from '../../../services/SchoolAPI';
import { SchoolType } from '../../../types/SchoolType';

import DegreeAPI from '../../../services/DegreeAPI';
import { DegreeType } from '../../../types/DegreeType';

import { ref, reactive, computed, onMounted } from 'vue';
import { ExperienceType } from '../../../types/ExperienceType';

const profile = ref<any>([]);
const personal = ref<PersonalType>(PersonalInitial);
const education = ref<any>([]);
const tertiary = ref<TertiaryType>(TertiaryInitial);
const secondary = ref<SecondaryType>(SecondaryInitial);
const contact = ref<ContactType>(ContactInitial);
const family = ref<any>([]);
const father = ref<ParentType>(ParentInitial);
const mother = ref<ParentType>(ParentInitial);
const experiences = ref<ExperienceType[]>([]);
const schools = ref<SchoolType[]>([]);
const degrees = ref<DegreeType[]>([]);

const personalIsEdit = ref<boolean>(false);
const contactIsEdit = ref<boolean>(false);
const tertiaryIsEdit = ref<boolean>(false);
const secondaryIsEdit = ref<boolean>(false);
const fatherIsEdit = ref<boolean>(false);
const motherIsEdit = ref<boolean>(false);
const experiencesIsEdit = ref<boolean>(false);
const experiencesIsAdd = ref<boolean>(false);

const toBeExperience = reactive<ExperienceType>({
    company: '',
    address: '',
    start_date: '',
    end_date: '',
    description: ''
});

onMounted(() => {
    loadProfile();
    loadSchool();
    loadDegree();
});

const fullName = computed(() => {
    return `${personal.value.last_name}, ${personal.value.first_name} ${personal.value.middle_name}`;
});

const tertiarySchoolName = computed(() => {
    return schools.value.filter((school: SchoolType) => school.id === tertiary.value.school)[0]?.name;
});

const loadProfile = async () => {
    try {
        const response = await StudentAPI.getStudentProfile();
        profile.value = response.data.data.profile;
        personal.value = response.data.data.profile.personal;
        education.value = response.data.data.profile.education;
        tertiary.value = response.data.data.profile.education.tertiary;
        secondary.value = response.data.data.profile.education.secondary;
        contact.value = response.data.data.profile.contact;
        family.value = response.data.data.profile.family;
        father.value = response.data.data.profile.family.father;
        mother.value = response.data.data.profile.family.mother;
        experiences.value = response.data.data.profile.experience;
        console.log(profile.value);
    } catch (error: any) {
        console.log(error);
    }
}

const loadSchool = async () => {
    try {
        const response = await SchoolAPI.getSchools();
        schools.value = response.data.data.schools;
        console.log(response);
    } catch (error: any) {
        console.log(error);
    }
}

const loadDegree = async () => {
    try {
        const response = await DegreeAPI.getDegrees();
        degrees.value = response.data.data.degrees;
        console.log(response);
    } catch (error: any) {
        console.log(error);
    }
}

const updatePersonalDetails = async () => {
    try {
        const response = await StudentAPI.updatePersonalDetails(personal.value);
        personalIsEdit.value = false;
        console.log(response);
    } catch (error: any) {
        console.log(error);
    }
}

const updateContactDetails = async () => {
    try {
        const response = await StudentAPI.updateContactDetails(contact.value);
        contactIsEdit.value = false;
        console.log(response);
    } catch (error: any) {
        console.log(error);
    }
}

const updateTeriaryDetails = async () => {
    try {
        const response = await StudentAPI.updateTertiaryDetails(tertiary.value);
        tertiaryIsEdit.value = false;
        tertiary.value = response.data.data;
        console.log(response);
    } catch (error: any) {
        console.log(error);
    }
}

const updateSecondaryDetails = async () => {
    try {
        const response = await StudentAPI.updateSecondaryDetails(secondary.value);
        secondaryIsEdit.value = false;
        console.log(response);
    } catch (error: any) {
        console.log(error);
    }
}

const updateFatherDetails = async () => {
    try {
        const response = await StudentAPI.updateFatherDetails(father.value);
        fatherIsEdit.value = false;
        console.log(response);
    } catch (error: any) {
        console.log(error);
    }
}

const updateMotherDetails = async () => {
    try {
        const response = await StudentAPI.updateMotherDetails(mother.value);
        motherIsEdit.value = false;
        console.log(response);
    } catch (error: any) {
        console.log(error);
    }
}

const addWorkExperience = async () => {
    try {
        const response = await StudentAPI.storeWorkExperience(toBeExperience);
        experiences.value.push(response.data.data);
        experiencesIsAdd.value = false;
    } catch (error: any) {
        console.log(error);
    }
}

const removeWorkExperience = (experienceId : number | string) => {
    experiences.value = experiences.value.filter((experience: ExperienceType) => experience.id !== experienceId);
}
</script>

<style scoped>
    .profile-header {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        width: 100%;
        margin: 5px 0;
    }

    .profile-header__title {
        font-weight: bold;
        font-size: 15px;
        margin: 0;
    }

    .profile-content-body {
        height:84vh; 
        overflow-y: auto;
        padding-right: 10px;
    }

    .profile-content-body::-webkit-scrollbar {
        background: transparent;
    }

    .profile-content-body::-webkit-scrollbar-thumb {
       background: #007bff;
       border: 3px solid #FFFFFF;
       border-radius: 5px;
    }
</style>

<template>
    <div class="card card-primary card-outline">
        <div class="card-header p-2">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link mr-2 active" href="#personal" data-toggle="tab">Personal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mr-2" href="#program-info" data-toggle="tab">Program Info</a>
                </li>
            </ul>
        </div><!-- /.card-header -->
    </div>
    
    <div class="profile-content-body">
        <div class="card card-default">
            <div class="card-body">
                <div class="profile-header">
                    <h5 class="profile-header__title">Personal Details</h5>
                    <div class="profile-header__actions">
                        <button v-if="!personalIsEdit" @click="personalIsEdit = true" class="btn btn-primary btn-xs">Edit</button>
                        <button v-if="personalIsEdit" @click="updatePersonalDetails" class="btn btn-success btn-xs mr-1">Save</button>
                        <button v-if="personalIsEdit" @click="personalIsEdit = false" class="btn btn-danger btn-xs">Cancel</button>
                    </div>
                </div>
                <table class="table table-striped table-sm">
                    <tbody>
                        <tr>
                            <td style="width: 40%">First name</td>
                            <td v-if="!personalIsEdit">{{ personal.first_name}}</td>
                            <td v-if="personalIsEdit">
                                <input type="text" class="form-control form-control-sm" v-model="personal.first_name">
                            </td>
                        </tr>
                        <tr>
                            <td>Middle name</td>
                            <td v-if="!personalIsEdit">{{ personal.middle_name }}</td>
                            <td v-if="personalIsEdit">
                                <input type="text" class="form-control form-control-sm" v-model="personal.middle_name">
                            </td>
                        </tr>
                        <tr>
                            <td>Last name</td>
                            <td v-if="!personalIsEdit">{{ personal.last_name }}</td>
                            <td v-if="personalIsEdit">
                                <input type="text" class="form-control form-control-sm" v-model="personal.last_name">
                            </td>
                        </tr>
                        <tr>
                            <td>Birthdate</td>
                            <td v-if="!personalIsEdit">{{ personal.birthdate}}</td>
                            <td v-if="personalIsEdit">
                                <input type="date" class="form-control form-control-sm" v-model="personal.birthdate">
                            </td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td v-if="!personalIsEdit">{{ personal.gender }}</td>
                            <td v-if="personalIsEdit">
                                <select v-model="personal.gender" class="form-control form-control-sm">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Skype ID</td>
                            <td v-if="!personalIsEdit">{{ personal.skype_id }}</td>
                            <td v-if="personalIsEdit">
                                <input type="text" class="form-control form-control-sm" v-model="personal.skype_id">
                            </td>
                        </tr>
                        <tr>
                            <td>Facebook URL</td>
                            <td v-if="!personalIsEdit">{{ personal.fb_email }}</td>
                            <td v-if="personalIsEdit">
                                <input type="text" class="form-control form-control-sm" v-model="personal.fb_email">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card card-default">
            <div class="card-body">
                <div class="profile-header">
                    <h5 class="profile-header__title">Contact Details</h5>
                    <div class="profile-header__actions">
                        <button v-if="!contactIsEdit" @click="contactIsEdit = true" class="btn btn-primary btn-xs">Edit</button>
                        <button v-if="contactIsEdit" @click="updateContactDetails" class="btn btn-success btn-xs mr-1">Save</button>
                        <button v-if="contactIsEdit" @click="contactIsEdit = false" class="btn btn-danger btn-xs">Cancel</button>
                    </div>
                </div>
                <table class="table table-sm table-striped">
                    <tbody>
                        <tr>
                            <td style="width: 40%">Present Address</td>
                            <td v-if="!contactIsEdit">{{ contact.provincial_address }}</td>
                            <td v-if="contactIsEdit">
                                <input type="text" class="form-control form-control-sm" v-model="contact.provincial_address">
                            </td>
                        </tr>
                        <tr>
                            <td>Permanent Address</td>
                            <td v-if="!contactIsEdit">{{ contact.permanent_address}}</td>
                            <td v-if="contactIsEdit">
                                <input type="text" class="form-control form-control-sm" v-model="contact.permanent_address">
                            </td>
                        </tr>
                        <tr>
                            <td>Home number</td>
                            <td v-if="!contactIsEdit">{{ contact.home_number }}</td>
                            <td v-if="contactIsEdit">
                                <input type="text" class="form-control form-control-sm" v-model="contact.home_number">
                            </td>
                        </tr>
                        <tr>
                            <td>Mobile number</td>
                            <td v-if="!contactIsEdit">{{ contact.mobile_number }}</td>
                            <td v-if="contactIsEdit">
                                <input type="text" class="form-control form-control-sm" v-model="contact.mobile_number">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card card-default">
            <div class="card-body">
                <div class="profile-header">
                    <h5 class="profile-header__title">Tertiary</h5>
                    <div class="profile-header__actions">
                        <button v-if="!tertiaryIsEdit" @click="tertiaryIsEdit = true" class="btn btn-primary btn-xs">Edit</button>
                        <button v-if="tertiaryIsEdit" @click="updateTeriaryDetails" class="btn btn-success btn-xs mr-1">Save</button>
                        <button v-if="tertiaryIsEdit" @click="tertiaryIsEdit = false" class="btn btn-danger btn-xs">Cancel</button>
                    </div>
                </div>
                <table class="table table-striped table-sm">
                    <tbody>
                        <tr>
                            <td style="width: 40%">School</td>
                            <td v-if="!tertiaryIsEdit">{{ tertiary.school }}</td>
                            <td v-if="tertiaryIsEdit">
                                <select class="form-control form-control-sm" v-model="tertiary.school">
                                    <option :value="tertiary.school">{{ tertiarySchoolName }}</option>
                                    <!-- <option v-for="school in schools" :value="school.id">{{ school.name }}</option> -->
                                    <option v-for="school in schools" :value="school.id">{{ school.name }}</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td v-if="!tertiaryIsEdit">{{ tertiary.address }}</td>
                            <td v-if="tertiaryIsEdit">
                                <input type="text" class="form-control form-control-sm" v-model="tertiary.address">
                            </td>
                        </tr>
                        <tr>
                            <td>Degree</td>
                            <td v-if="!tertiaryIsEdit">{{ tertiary.degree }}</td>
                            <td v-if="tertiaryIsEdit">
                                <select class="form-control form-control-sm" v-model="tertiary.degree">
                                    <option :value="tertiary.degree">{{ tertiary.degree }}</option>
                                    <option v-for="(degree, index) in degrees" :value="degree.display_name">{{ degree.display_name }}</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Start date</td>
                            <td v-if="!tertiaryIsEdit">{{ tertiary.start_date }}</td>
                            <td v-if="tertiaryIsEdit">
                                <input type="text" class="form-control form-control-sm" v-model="tertiary.start_date">
                            </td>
                        </tr>
                        <tr>
                            <td>Date Graduated (expected)</td>
                            <td v-if="!tertiaryIsEdit">{{ tertiary.date_graduated }}</td>
                            <td v-if="tertiaryIsEdit">
                                <input type="text" class="form-control form-control-sm" v-model="tertiary.date_graduated">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card card-default">
            <div class="card-body">
                <div class="profile-header">
                    <h5 class="profile-header__title">Secondary</h5>
                    <div class="profile-header__actions">
                        <button v-if="!secondaryIsEdit" @click="secondaryIsEdit = true" class="btn btn-primary btn-xs">Edit</button>
                        <button v-if="secondaryIsEdit" @click="updateSecondaryDetails" class="btn btn-success btn-xs mr-1">Save</button>
                        <button v-if="secondaryIsEdit" @click="secondaryIsEdit = false" class="btn btn-danger btn-xs">Cancel</button>
                    </div>
                </div>
                <table class="table table-striped table-sm">
                    <tbody>
                        <tr>
                            <td style="width: 40%">School</td>
                            <td v-if="!secondaryIsEdit">{{ secondary.school_name }}</td>
                            <td v-if="secondaryIsEdit">
                                <input type="text" class="form-control form-control-sm" v-model="secondary.school_name">
                            </td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td v-if="!secondaryIsEdit">{{ secondary.address }}</td>
                            <td v-if="secondaryIsEdit">
                                <input type="text" class="form-control form-control-sm" v-model="secondary.address">
                            </td>
                        </tr>
                        <tr>
                            <td>Start date</td>
                            <td v-if="!secondaryIsEdit">{{ secondary.start_date }}</td>
                            <td v-if="secondaryIsEdit">
                                <input type="date" class="form-control form-control-sm" v-model="secondary.start_date">
                            </td>
                        </tr>
                        <tr>
                            <td>Date Graduated (expected)</td>
                            <td v-if="!secondaryIsEdit">{{ secondary.date_graduated }}</td>
                            <td v-if="secondaryIsEdit">
                                <input type="date" class="form-control form-control-sm" v-model="secondary.date_graduated">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card card-default">
            <div class="card-body">
                <div class="profile-header">
                    <h5 class="profile-header__title">Father Details</h5>
                    <div class="profile-header__actions">
                        <button v-if="!fatherIsEdit" @click="fatherIsEdit = true" class="btn btn-primary btn-xs">Edit</button>
                        <button v-if="fatherIsEdit" @click="updateFatherDetails" class="btn btn-success btn-xs mr-1">Save</button>
                        <button v-if="fatherIsEdit" @click="fatherIsEdit = false" class="btn btn-danger btn-xs">Cancel</button>
                    </div>
                </div>
                <table class="table table-sm table-striped">
                    <tbody>
                        <tr>
                            <td style="width: 40%">First name</td>
                            <td v-if="!fatherIsEdit">{{ father.first_name }}</td>
                            <td v-if="fatherIsEdit">
                                <input type="text" class="form-control form-control-sm" v-model="father.first_name">
                            </td>
                        </tr>
                        <tr>
                            <td>Middle name</td>
                            <td v-if="!fatherIsEdit">{{ father.middle_name }}</td>
                            <td v-if="fatherIsEdit">
                                <input type="text" class="form-control form-control-sm" v-model="father.middle_name">
                            </td>
                        </tr>
                        <tr>
                            <td>Last name</td>
                            <td v-if="!fatherIsEdit">{{ father.last_name }}</td>
                            <td v-if="fatherIsEdit">
                                <input type="text" class="form-control form-control-sm" v-model="father.last_name">
                            </td>
                        </tr>
                        <tr>
                            <td>Occupation</td>
                            <td v-if="!fatherIsEdit">{{ father.occupation }}</td>
                            <td v-if="fatherIsEdit">
                                <input type="text" class="form-control form-control-sm" v-model="father.occupation">
                            </td>
                        </tr>
                        <tr>
                            <td>Company</td>
                            <td v-if="!fatherIsEdit">{{ father.company }}</td>
                            <td v-if="fatherIsEdit">
                                <input type="text" class="form-control form-control-sm" v-model="father.company">
                            </td>
                        </tr>
                        <tr>
                            <td>Contact No.</td>
                            <td v-if="!fatherIsEdit">{{ father.contact_no }}</td>
                            <td v-if="fatherIsEdit">
                                <input type="text" class="form-control form-control-sm" v-model="father.contact_no">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card card-default">
            <div class="card-body" id="mother-details">
                <div class="profile-header">
                    <h5 class="profile-header__title">Mother Details</h5>
                    <div class="profile-header__actions">
                        <button v-if="!motherIsEdit" @click="motherIsEdit = true" class="btn btn-primary btn-xs">Edit</button>
                        <button v-if="motherIsEdit" @click="updateMotherDetails" class="btn btn-success btn-xs mr-1">Save</button>
                        <button v-if="motherIsEdit" @click="motherIsEdit = false" class="btn btn-danger btn-xs">Cancel</button>
                    </div>
                </div>
                <table class="table table-sm table-striped">
                    <tbody>
                        <tr>
                            <td style="width: 40%">First name</td>
                            <td v-if="!motherIsEdit">{{ mother.first_name }}</td>
                            <td v-if="motherIsEdit">
                                <input type="text" class="form-control form-control-sm" v-model="mother.first_name">
                            </td>
                        </tr>
                        <tr>
                            <td>Middle name</td>
                            <td v-if="!motherIsEdit">{{ mother.middle_name }}</td>
                            <td v-if="motherIsEdit">
                                <input type="text" class="form-control form-control-sm" v-model="mother.middle_name">
                            </td>
                        </tr>
                        <tr>
                            <td>Last name</td>
                            <td v-if="!motherIsEdit">{{ mother.last_name }}</td>
                            <td v-if="motherIsEdit">
                                <input type="text" class="form-control form-control-sm" v-model="mother.last_name">
                            </td>
                        </tr>
                        <tr>
                            <td>Occupation</td>
                            <td v-if="!motherIsEdit">{{ mother.occupation }}</td>
                            <td v-if="motherIsEdit">
                                <input type="text" class="form-control form-control-sm" v-model="mother.occupation">
                            </td>
                        </tr>
                        <tr>
                            <td>Company</td>
                            <td v-if="!motherIsEdit">{{ mother.company }}</td>
                            <td v-if="motherIsEdit">
                                <input type="text" class="form-control form-control-sm" v-model="mother.company">
                            </td>
                        </tr>
                        <tr>
                            <td>Contact No.</td>
                            <td v-if="!motherIsEdit">{{ mother.contact_no }}</td>
                            <td v-if="motherIsEdit">
                                <input type="text" class="form-control form-control-sm" v-model="mother.contact_no">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card card-default">
            <div class="card-body" id="work-experience">
                <div class="profile-header">
                    <h5 class="profile-header__title">Work Experience/On-the-Job Training</h5>
                    <div class="profile-header__actions">
                        <button v-if="!experiencesIsAdd" @click="experiencesIsAdd =  true" class="btn btn-success btn-xs ">Add</button>
                        <button v-if="experiencesIsAdd" @click="addWorkExperience" class="btn btn-primary btn-xs mr-1">Save</button>
                        <button v-if="experiencesIsAdd" @click="experiencesIsAdd =  false" class="btn btn-danger btn-xs">Cancel</button>
                    </div>
                </div>
                <div v-if="experiencesIsAdd == true">
                    <table class="table table-sm table-striped">
                        <tbody>
                            <tr>
                                <td>Company Name</td>
                                <td>
                                    <input v-model="toBeExperience.company" type="text" class="form-control form-control-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>Company Address</td>
                                <td>
                                    <input v-model="toBeExperience.address" type="text" class="form-control form-control-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>Start Date</td>
                                <td>
                                    <input v-model="toBeExperience.start_date" type="date" class="form-control form-control-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>End Date</td>
                                <td>
                                    <input v-model="toBeExperience.end_date" type="date" class="form-control form-control-sm">
                                </td>
                            </tr>
                            <tr>
                                <td>Job Description</td>
                                <td>
                                    <input v-model="toBeExperience.description" type="text" class="form-control form-control-sm">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div v-if="experiences.length > 0 && !experiencesIsAdd">
                    <WorkExperienceItem 
                        v-for="(exp, index) in experiences" 
                        :key="index" 
                        :experienceProps="exp"
                        @deleteExperience="removeWorkExperience"
                    />
                </div>
                <div v-if="experiences.length == 0 && !experiencesIsAdd">
                    <p class="text-center">No work experience yet.</p>
                </div>
            </div>
        </div>
    </div>
</template>
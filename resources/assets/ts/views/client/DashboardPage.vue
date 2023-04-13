<script setup lang="ts">
import ClientLayout from '../../components/layouts/ClientLayout.vue';

import StudentAPI from '../../services/StudentAPI';

import { ref, computed, onMounted } from 'vue';

const profile = ref<any>([]);

onMounted(() => {
    loadProfile();
});

const fullName = computed(() => {
    return `${profile.value.last_name}, ${profile.value.first_name} ${profile.value.middle_name}`;
});

const loadProfile = async () => {
    try {
        const response = await StudentAPI.getStudentProfile();
        profile.value = response.data.data.profile;
        console.log(profile.value);
    } catch (error: any) {
        console.log(error);
    }
}
</script>

<template>
    <ClientLayout>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid" style="padding: 0 2rem;">
                <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                            src="#"
                            alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center py-4">{{ fullName }}</h3>

                        <p class="text-muted text-center" v-if="profile.program_id_no">{{ profile.program_id_no }}</p>

                        <!-- <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Followers</b> <a class="float-right">1,322</a>
                            </li>
                            <li class="list-group-item">
                                <b>Following</b> <a class="float-right">543</a>
                            </li>
                            <li class="list-group-item">
                                <b>Friends</b> <a class="float-right">13,287</a>
                            </li>
                        </ul> -->

                        <button class="btn btn-primary btn-block"><b>Logout</b></button>
                    </div>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">About Me</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <strong><i class="fas fa-book mr-1"></i> Education</strong>

                        <p class="text-muted">
                        B.S. in Computer Science from the University of Tennessee at Knoxville
                        </p>

                        <hr>

                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                        <p class="text-muted">Malibu, California</p>

                        <hr>

                        <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                        <p class="text-muted">
                        <span class="tag tag-danger">UI Design</span>
                        <span class="tag tag-success">Coding</span>
                        <span class="tag tag-info">Javascript</span>
                        <span class="tag tag-warning">PHP</span>
                        <span class="tag tag-primary">Node.js</span>
                        </p>

                        <hr>

                        <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                    </div>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link active" href="#activity" data-toggle="tab">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#timeline" data-toggle="tab">Payments</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#settings" data-toggle="tab">Settings</a>
                            </li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <div id="personal-details" class="mb-4">
                                    <h5>Personal Details</h5>
                                    <table class="table table-striped table-sm">
                                        <tbody>
                                            <tr>
                                                <td>First name</td>
                                                <td>Testing</td>
                                            </tr>
                                            <tr>
                                                <td>Middle name</td>
                                                <td>Testing</td>
                                            </tr>
                                            <tr>
                                                <td>Last name</td>
                                                <td>Testing</td>
                                            </tr>
                                            <tr>
                                                <td>Birthdate</td>
                                                <td>Testing</td>
                                            </tr>
                                            <tr>
                                                <td>Gender</td>
                                                <td>Testing</td>
                                            </tr>
                                            <tr>
                                                <td>Skype ID</td>
                                                <td>Testing</td>
                                            </tr>
                                            <tr>
                                                <td>Facebook URL</td>
                                                <td>Testing</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <hr>
                                <div id="educational-background" class="mb-4">
                                    <h5>Educational Background</h5>
                                    <table class="table table-striped table-sm">
                                        <tbody>
                                            <tr>
                                                <td colspan="2"><b>Tertiary Level</b></td>
                                            </tr>
                                            <tr>
                                                <td>School</td>
                                                <td>test</td>
                                            </tr>
                                            <tr>
                                                <td>Address</td>
                                                <td>test</td>
                                            </tr>
                                            <tr>
                                                <td>Degree</td>
                                                <td>test</td>
                                            </tr>
                                            <tr>
                                                <td>Start date</td>
                                                <td>test</td>
                                            </tr>
                                            <tr>
                                                <td>Date Graduated (expected)</td>
                                                <td>test</td>
                                            </tr>

                                            <tr>
                                                <td colspan="2"><b>Secondary Level</b></td>
                                            </tr>
                                            <tr>
                                                <td>School</td>
                                                <td>test</td>
                                            </tr>
                                            <tr>
                                                <td>Address</td>
                                                <td>test</td>
                                            </tr>
                                            <tr>
                                                <td>Start date</td>
                                                <td>test</td>
                                            </tr>
                                            <tr>
                                                <td>Date Graduated (expected)</td>
                                                <td>test</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <hr>
                                <div id="contact-details">
                                    <h5>Contact Details</h5>
                                    <table class="table table-sm table-striped">
                                        <tbody>
                                            <tr>
                                                <td>Present Address</td>
                                                <td>test</td>
                                            </tr>
                                            <tr>
                                                <td>Permanent Address</td>
                                                <td>test</td>
                                            </tr>
                                            <tr>
                                                <td>Home number</td>
                                                <td>test</td>
                                            </tr>
                                            <tr>
                                                <td>Mobile number</td>
                                                <td>test</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <hr>
                                <div id="family-details">
                                    <h5>Family Details</h5>
                                    <table class="table table-sm table-striped">
                                        <tbody>
                                            <tr>
                                                <td colspan="2"><b>Father</b></td>
                                            </tr>
                                            <tr>
                                                <td>First name</td>
                                                <td>Test</td>
                                            </tr>
                                            <tr>
                                                <td>Middle name</td>
                                                <td>Test</td>
                                            </tr>
                                            <tr>
                                                <td>Last name</td>
                                                <td>Test</td>
                                            </tr>
                                            <tr>
                                                <td>Occupation</td>
                                                <td>Test</td>
                                            </tr>
                                            <tr>
                                                <td>Company</td>
                                                <td>Test</td>
                                            </tr>
                                            <tr>
                                                <td>Contact No.</td>
                                                <td>Test</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><b>Mother</b></td>
                                            </tr>
                                            <tr>
                                                <td>First name</td>
                                                <td>Test</td>
                                            </tr>
                                            <tr>
                                                <td>Middle name</td>
                                                <td>Test</td>
                                            </tr>
                                            <tr>
                                                <td>Last name</td>
                                                <td>Test</td>
                                            </tr>
                                            <tr>
                                                <td>Occupation</td>
                                                <td>Test</td>
                                            </tr>
                                            <tr>
                                                <td>Company</td>
                                                <td>Test</td>
                                            </tr>
                                            <tr>
                                                <td>Contact No.</td>
                                                <td>Test</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <hr>
                                <div id="work-experience">
                                    <h5>Work Experience/On-the-Job Training</h5>
                                    <table class="table table-sm table-striped">
                                        <tbody>
                                            <tr>
                                                <td>Company Name</td>
                                                <td>test</td>
                                            </tr>
                                            <tr>
                                                <td>Company Address</td>
                                                <td>test</td>
                                            </tr>
                                            <tr>
                                                <td>Start Date</td>
                                                <td>test</td>
                                            </tr>
                                            <tr>
                                                <td>End Date</td>
                                                <td>test</td>
                                            </tr>
                                            <tr>
                                                <td>Job Description</td>
                                                <td>test</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <!-- /.tab-pane -->
                            <div class="tab-pane" id="timeline">
                                <!-- The timeline -->
                                <div class="timeline timeline-inverse">
                                <!-- timeline time label -->
                                <div class="time-label">
                                    <span class="bg-danger">
                                    10 Feb. 2014
                                    </span>
                                </div>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <div>
                                    <i class="fas fa-envelope bg-primary"></i>

                                    <div class="timeline-item">
                                    <span class="time"><i class="far fa-clock"></i> 12:05</span>

                                    <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                                    <div class="timeline-body">
                                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                        weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                        jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                        quora plaxo ideeli hulu weebly balihoo...
                                    </div>
                                    <div class="timeline-footer">
                                        <a href="#" class="btn btn-primary btn-sm">Read more</a>
                                        <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                    </div>
                                    </div>
                                </div>
                                <!-- END timeline item -->
                                <!-- timeline item -->
                                <div>
                                    <i class="fas fa-user bg-info"></i>

                                    <div class="timeline-item">
                                    <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                                    <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your friend request
                                    </h3>
                                    </div>
                                </div>
                                <!-- END timeline item -->
                                <!-- timeline item -->
                                <div>
                                    <i class="fas fa-comments bg-warning"></i>

                                    <div class="timeline-item">
                                    <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>

                                    <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                                    <div class="timeline-body">
                                        Take me to your leader!
                                        Switzerland is small and neutral!
                                        We are more like Germany, ambitious and misunderstood!
                                    </div>
                                    <div class="timeline-footer">
                                        <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                                    </div>
                                    </div>
                                </div>
                                <!-- END timeline item -->
                                <!-- timeline time label -->
                                <div class="time-label">
                                    <span class="bg-success">
                                    3 Jan. 2014
                                    </span>
                                </div>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <div>
                                    <i class="fas fa-camera bg-purple"></i>

                                    <div class="timeline-item">
                                    <span class="time"><i class="far fa-clock"></i> 2 days ago</span>

                                    <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                                    <div class="timeline-body">
                                        <img src="https://placehold.it/150x100" alt="...">
                                        <img src="https://placehold.it/150x100" alt="...">
                                        <img src="https://placehold.it/150x100" alt="...">
                                        <img src="https://placehold.it/150x100" alt="...">
                                    </div>
                                    </div>
                                </div>
                                <!-- END timeline item -->
                                <div>
                                    <i class="far fa-clock bg-gray"></i>
                                </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="settings">
                                <form class="form-horizontal">
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputName" placeholder="Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputName2" placeholder="Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                                    <div class="col-sm-10">
                                    <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                    <div class="checkbox">
                                        <label>
                                        <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                                        </label>
                                    </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                    <button type="submit" class="btn btn-danger">Submit</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </ClientLayout>
</template>
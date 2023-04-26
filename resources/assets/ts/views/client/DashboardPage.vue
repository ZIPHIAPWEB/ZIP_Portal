<script setup lang="ts">
import ClientLayout from '../../components/layouts/ClientLayout.vue';
import ProfileTab from '../../components/elements/profile-page/ProfileTab.vue';
import RequirementsTab from '../../components/elements/profile-page/RequirementsTab.vue';

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

                            <h3 class="profile-username text-center py-4">Test Test Test</h3>

                            <p v-if="false" class="text-muted text-center">Sd</p>

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
                            <hr>
                            <button class="btn btn-default btn-block text-left">Profile</button>
                            <button class="btn btn-default btn-block text-left">Payment Requirements</button>
                            <button class="btn btn-default btn-block text-left">Program Requirements</button>
                            <button class="btn btn-default btn-block text-left">Program Information</button>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <ProfileTab />
                </div>
                <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </ClientLayout>
</template>
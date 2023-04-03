<script setup lang="ts">
import { onMounted, onUnmounted } from 'vue';

onMounted(() => {
    document.body.classList.add('layout-top-nav');
});

onUnmounted(() => {
    document.body.classList.remove('layout-top-nav');
});

</script>

<template>
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="padding-top: 50px;">
            <!-- Content Header (Page header) -->
            <!-- <section class="content-header">
                <div class="container">
                    <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Profile</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User Profile</li>
                        </ol>
                    </div>
                    </div>
                </div>
            </section> -->

            <slot />
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
            <b>Version</b> 3.2.0
            </div>
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
        </div>
</template>
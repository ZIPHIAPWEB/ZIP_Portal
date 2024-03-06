<script setup lang="ts">
import { ref, onMounted, onUnmounted, defineProps } from 'vue';
import router from '../../router';

import { useAuthStore } from '../../store/auth';
const authStore = useAuthStore();

onMounted(async () => {
    document.body.classList.add('layout-fixed');    
});

onUnmounted(() => {
    document.body.classList.remove('layout-fixed');
});

const gotoDashboard = () => {
  router.replace({
    'name': "superadmin-dashboard"
  });
}
</script>

<template>
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
              <li class="nav-item">
                  <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
              </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
              <!-- Navbar Search -->
              <li class="nav-item">
                  <a @click.prevent="authStore.logout()" class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                    <span>Logout</span>
                  </a>
              </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="https://ziptravel.com.ph/" class="brand-link">
              <img :src="require('../../../../../public/logo.png')" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
              <span class="brand-text font-weight-light">Zip Travel PH</span>
            </a>
        
            <!-- Sidebar -->
            <div class="sidebar">
              <!-- Sidebar user (optional) -->
              <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div v-if="false" class="image">
                  <img :src="require('../../../../../public/logo.png')" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                  <a href="#" class="d-block">Superadministrator</a>
                </div>
              </div>
        
              <!-- SidebarSearch Form -->
              <!-- <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                  <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                  <div class="input-group-append">
                    <button class="btn btn-sidebar">
                      <i class="fas fa-search fa-fw"></i>
                    </button>
                  </div>
                </div>
              </div> -->
        
              <!-- Sidebar Menu -->
              <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <li class="nav-item">
                    <a href="#" @click.prevent="gotoDashboard" class="nav-link">
                      <i class="nav-icon fas fa-tachometer-alt"></i>
                      <p>
                        Dashboard
                      </p>
                    </a>
                  </li>
                  <li class="nav-header">Administrative</li>
                  <li class="nav-item menu-open">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-copy"></i>
                      <p>
                        User Management
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <router-link class="nav-link" tag="a" :to="{ name: 'superadmin-student-lists'}">
                          <i class="far fa-circle nav-icon"></i>
                          <p class="text-sm" style="vertical-align: text-bottom;">Students</p>
                        </router-link>
                      </li>

                      <li class="nav-item">
                        <router-link class="nav-link" tag="a" :to="{ name: 'superadmin-coords-lists'}">
                          <i class="far fa-circle nav-icon"></i>
                          <p class="text-sm" style="vertical-align: text-bottom;">Coordinators</p>
                        </router-link>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-header">Settings</li>
                  <li class="nav-item menu-open">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-copy"></i>
                      <p>
                        General
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <router-link class="nav-link" tag="a" :to="{ name: 'superadmin-coords-programs'}">
                          <i class="far fa-circle nav-icon"></i>
                          <p class="text-sm" style="vertical-align: text-bottom;">Programs</p>
                        </router-link>
                      </li>
                      <li class="nav-item">
                        <router-link class="nav-link" tag="a" :to="{ name: 'superadmin-program-categories' }">
                          <i class="far fa-circle nav-icon"></i>
                          <p class="text-sm" style="vertical-align: text-bottom;">Program Category</p>
                        </router-link>
                      </li>
                      <li class="nav-item">
                        <router-link class="nav-link" tag="a" :to="{ name: 'superadmin-visa-sponsor' }">
                          <i class="far fa-circle nav-icon"></i>
                          <p class="text-sm" style="vertical-align: text-bottom;">Visa Sponsor</p>
                        </router-link>
                      </li>

                      <li class="nav-item">
                        <router-link class="nav-link" tag="a" :to="{ name: 'superadmin-host-company' }">
                          <i class="far fa-circle nav-icon"></i>
                          <p class="text-sm" style="vertical-align: text-bottom;">Host Company</p>
                        </router-link>
                      </li>

                      <li class="nav-item">
                        <router-link class="nav-link" tag="a" :to="{ name: 'superadmin-school' }">
                          <i class="far fa-circle nav-icon"></i>
                          <p class="text-sm" style="vertical-align: text-bottom;">School</p>
                        </router-link>
                      </li>

                      <!-- <li class="nav-item">
                        <a href="#" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p class="text-sm" style="vertical-align: text-bottom;">Place of Assignment</p>
                        </a>
                      </li> -->

                      <li class="nav-item">
                        <router-link class="nav-link" tag="a" :to="{ name: 'superadmin-degree' }">
                          <i class="far fa-circle nav-icon"></i>
                          <p class="text-sm" style="vertical-align: text-bottom;">Degree</p>
                        </router-link>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item menu-open">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-copy"></i>
                      <p>
                        Requirements
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <router-link class="nav-link" tag="a" :to="{ name: 'superadmin-prelim'}">
                          <i class="far fa-circle nav-icon"></i>
                          <p class="text-sm" style="vertical-align: text-bottom;">Preliminary</p>
                        </router-link>

                        <router-link class="nav-link" tag="a" :to="{ name: 'superadmin-additional'}">
                          <i class="far fa-circle nav-icon"></i>
                          <p class="text-sm" style="vertical-align: text-bottom;">Additional</p>
                        </router-link>

                        <router-link class="nav-link" tag="a" :to="{ name: 'superadmin-coords-programs'}">
                          <i class="far fa-circle nav-icon"></i>
                          <p class="text-sm" style="vertical-align: text-bottom;">Visa Sponsor</p>
                        </router-link>

                        <router-link class="nav-link" tag="a" :to="{ name: 'superadmin-coords-programs'}">
                          <i class="far fa-circle nav-icon"></i>
                          <p class="text-sm" style="vertical-align: text-bottom;">Payment</p>
                        </router-link>
                      </li>
                    </ul>
                  </li>
                </ul>
              </nav>
              <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <div class="content-wrapper">
            <section class="content-header">
              <div class="container-fluid">
                <div class="row mb-2">
                  <div class="col-sm-6">
                    <h1></h1>
                  </div>
                </div>
              </div><!-- /.container-fluid -->
            </section>
            <section class="content">
                <slot />
            </section>
        </div>
    </div>
</template>

<style scoped>
.content-wrapper {
  height: calc(100vh - 57px);
}
</style>
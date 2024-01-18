<script setup lang="ts">
import { ref, onMounted, onUnmounted, defineProps } from 'vue';
import router from '../../router';
import ProgramAPI from '../../services/ProgramAPI';

import { useAuthStore } from '../../store/auth';
const authStore = useAuthStore();

const props = defineProps<{
  title?: string | string[]
}>()

interface IProgramCategory {
  id: number | string;
  name: string;
  display_name: string;
  description: string;
  programs: IProgram[]
}

interface IProgram {
  id: number | string;
  name: string;
  display_name: string;
  description: string;
}

const programs = ref<IProgramCategory[]>([]);


onMounted(async () => {
    document.body.classList.add('layout-fixed');
    
    await loadPrograms();
});

onUnmounted(() => {
    document.body.classList.remove('layout-fixed');
});

const loadPrograms = async () => {
    try {
        const response = await ProgramAPI.getPrograms();
        programs.value = response.data.data.programs;
    } catch (error: any) {
        console.log(error.response);
    }
};

const gotoPage = (slug : string) => {

  router.replace({
    name: "coordinator-program",
    params: {
      name: slug
    }
  });
}

const gotoDashboard = () => {
  router.replace({
    'name': "coordinator-dashboard"
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
            <a href="../../index3.html" class="brand-link">
              <img src="../../../../../public/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
              <span class="brand-text font-weight-light">Zip Travel PH</span>
            </a>
        
            <!-- Sidebar -->
            <div class="sidebar">
              <!-- Sidebar user (optional) -->
              <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div v-if="false" class="image">
                  <img src="../../../../../public/logo.png" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                  <a href="#" class="d-block">Coordinator</a>
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
                  <li v-for="(category, index) in programs" :key="index" :class="{ 'd-none' : category.programs.length == 0 ? true : false }" class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                      <i class="nav-icon fas fa-copy"></i>
                      <p>
                        {{ category.display_name }}
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li v-for="(program, index) in category.programs" :key="index" class="nav-item">
                        <a href="#" @click.prevent="gotoPage(program.name)" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p class="text-sm" style="vertical-align: text-bottom;">{{ program.display_name }}</p>
                        </a>
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
            <section v-if="props.title" class="content-header">
              <div class="container-fluid">
                <div class="row mb-2">
                  <div class="col-sm-6">
                    <h1>{{ props.title }}</h1>
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
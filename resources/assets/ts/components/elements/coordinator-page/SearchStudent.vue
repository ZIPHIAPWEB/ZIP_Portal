<script setup lang="ts">
import { ref } from 'vue';
import { useCoordStudent } from '../../../store/coordStudents'
import AlertService from '../../../services/AlertService';
const coordStudent = useCoordStudent();

const props = defineProps<{
    program: string | string[]
}>();

const searchField = ref<string>('');

const searchHandler = async () => {
    const res = await coordStudent.searchStudentData(props.program, searchField.value);
    if (!res.success) AlertService.error(res.message || 'Failed to search students');
}
</script>

<template>
    <div class="input-group input-group-sm" style="width: 200px;">
        <input v-model="searchField" type="text" name="table_search" class="form-control float-right" placeholder="Search by Surname">

        <div class="input-group-append">
          <button @click="searchHandler()" type="submit" class="btn btn-default">
            <i class="fas fa-search"></i>
          </button>
        </div>
    </div>
</template>
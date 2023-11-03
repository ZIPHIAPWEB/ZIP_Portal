<script setup lang="ts">
import { ref, defineEmits } from 'vue';
import { useCoordSelectedStudent } from '../../../../store/coordSelectedStudent';
const coordSelectedStudentStore = useCoordSelectedStudent();

const emits = defineEmits<{
    (e: 'submitEventTrigger') : void,
    (e: 'cancelEventTrigger') : void
}>();

const reason = ref<string>('');

const cancelStudentHandler = async () => {
    //TODO submit a request on the backend
    await coordSelectedStudentStore.cancelStudentProgram(reason.value);
    emits('submitEventTrigger');
}

</script>

<template>
    <form @submit.prevent="cancelStudentHandler">
        <div class="form-group">
            <label for="reason">Reason</label>
            <select v-model="reason" class="form-control">
                <option value="Unqualified">Unqualified</option>
                <option value="Visa Denial">Visa Denial</option>
                <option value="Program Cancellation">Program Cancellation</option>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-danger btn-block">Cancel student</button>
        </div>
    </form>
</template>
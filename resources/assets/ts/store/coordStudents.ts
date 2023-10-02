import { defineStore } from "pinia";
import CoordinatorApi from "../services/CoordinatorApi";

export const useCoordStudent = defineStore({
    id: 'coordinatorStudent',
    state: () => ({
        isSuccess: false,
        isLoading: false,
        error: undefined,
        students: []
    }),
    getters: {},
    actions: {
        async loadCoordStudentsData() {
            try {
                this.isLoading = true;
                this.isSuccess = false;
                
                const response = await CoordinatorApi.getCoordStudents();
                this.students = response.data;

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error : any) {
                
                this.error = error.response.data.message;
                this.isLoading = false;
                this.isSuccess = false;
            }
        }
    }
});
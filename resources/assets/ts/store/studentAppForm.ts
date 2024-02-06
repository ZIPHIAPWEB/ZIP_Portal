import { defineStore } from "pinia";
import ApplicationFormAPI from "../services/ApplicationFormAPI";
import { ApplicationFormType } from "../types/ApplicationFormType";
import { useAuthStore } from "./auth";

export const useStudentAppFormStore = defineStore({
    id: 'studentAppForm',
    state: () => ({
        isSuccess: false,
        isLoading: false,
        error: [] as any[],
    }),
    actions: {

        async submitApplicationForm(formData : ApplicationFormType) {
            
            try {
                const authStore = useAuthStore();
                
                this.isLoading = true;
                await ApplicationFormAPI.submit(formData);
                this.isLoading = false;

                authStore.$state.auth.is_filled = true;

                this.router.push({ name: 'student-dashboard' });
            } catch (error: any) {
                this.isLoading = false;
                this.isSuccess = false;
                this.error = error.response.data.errors;
            }
        }
    }
})
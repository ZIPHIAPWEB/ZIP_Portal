import { defineStore } from "pinia";
import ApplicationFormAPI from "../services/ApplicationFormAPI";
import { ApplicationFormType } from "../types/ApplicationFormType";
import { useAuthStore } from "./auth";
import { IActionResult } from "../interfaces/IActionResult";

export const useStudentAppFormStore = defineStore({
    id: 'studentAppForm',
    state: () => ({
        isSuccess: false,
        isLoading: false,
        error: [] as any[],
    }),
    actions: {

    async submitApplicationForm(formData : ApplicationFormType) : Promise<IActionResult> {
            const authStore = useAuthStore();
            try {
                this.isLoading = true;
                this.error = []; // Clear previous errors

                const response = await ApplicationFormAPI.submit(formData);

                // Successful submit (204 No Content expected)
                this.isLoading = false;
                this.isSuccess = true;

                // Update auth flag locally
                authStore.$state.auth.is_filled = true;

                return { success: true };
            } catch (err: unknown) {
                this.isLoading = false;
                this.isSuccess = false;

                // Narrow and extract errors/message
                const anyErr = err as any;
                if (anyErr?.response?.data?.errors) {
                    this.error = anyErr.response.data.errors;
                    return { success: false, errors: anyErr.response.data.errors, message: anyErr.response.data.message };
                }

                const message = anyErr?.response?.data?.message || 'An error occurred while submitting your application. Please try again.';
                return { success: false, message };
            }
        }
    }
})
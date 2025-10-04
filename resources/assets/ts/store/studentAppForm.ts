import { defineStore } from "pinia";
import ApplicationFormAPI from "../services/ApplicationFormAPI";
import { ApplicationFormType } from "../types/ApplicationFormType";
import { useAuthStore } from "./auth";
import swal from 'sweetalert2';

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
                this.error = []; // Clear previous errors
                await ApplicationFormAPI.submit(formData);
                this.isLoading = false;
                this.isSuccess = true;

                authStore.$state.auth.is_filled = true;

                // Clear localStorage after successful submission
                localStorage.removeItem('APP_FORM_DATA');

                // Show success alert
                await swal({
                    title: 'Success!',
                    text: 'Your application has been submitted successfully. Press Continue to go to your dashboard.',
                    type: 'success',
                    confirmButtonText: 'Continue',
                    confirmButtonColor: '#3085d6'
                });

                this.router.push({ name: 'student-dashboard' });
            } catch (error: any) {
                this.isLoading = false;
                this.isSuccess = false;
                
                // Handle validation errors
                if (error.response?.data?.errors) {
                    this.error = error.response.data.errors;
                    
                    // Show error alert with first error message
                    const firstErrorKey = Object.keys(error.response.data.errors)[0];
                    const firstErrorMessage = error.response.data.errors[firstErrorKey][0];
                    
                    await swal({
                        title: 'Validation Error',
                        text: firstErrorMessage || 'Please check your form and try again.',
                        type: 'error',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#d33'
                    });
                } else {
                    // Handle general errors
                    await swal({
                        title: 'Error',
                        text: error.response?.data?.message || 'An error occurred while submitting your application. Please try again.',
                        type: 'error',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#d33'
                    });
                }
            }
        }
    }
})
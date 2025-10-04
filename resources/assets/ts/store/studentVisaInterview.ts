import { defineStore } from "pinia";
import StudentAPI from "../services/StudentAPI";
import { IActionResult } from "../interfaces/IActionResult";

export interface IVisaInterview {
    visa_interview_status: string;
    program_id_number: string;
    sevis_id: string;
    visa_interview_schedule: string;
    formatted_visa_interview_schedule: string;
    visa_interview_time: string;
    trial_interview_schedule: string;
    formatted_trial_interview_schedule: string;
    trial_interview_time: string;
}

export interface IStudentVisaInterview {
    isSuccess: boolean;
    isLoading: boolean;
    visaInterview: IVisaInterview | undefined,
    error: string | undefined
}

export const useStudentVisaInterview = defineStore({
    id: 'studentVisaInterview',
    state: () : IStudentVisaInterview => ({
        isSuccess: false,
        isLoading: false,
        visaInterview: {} as IVisaInterview,
        error: undefined
    }),
    getters: {

    },
    actions: {
    async loadVisaInterview(): Promise<IActionResult<IVisaInterview>> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = await StudentAPI.getStudentVisaInterviewDetails();
                this.visaInterview = response.data.data;

                this.isLoading = false;
                this.isSuccess = true;
        return { success: true, data: this.visaInterview };
            } catch (error : any) {
                this.error = error.response.data.message;
                this.isLoading = false;
                this.isSuccess = false;
        return { success: false, message: error.response?.data?.message ?? 'Failed to load visa interview', errors: error.response?.data?.errors ?? {} };
            }
        }
    }
})
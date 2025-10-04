import { defineStore } from "pinia";
import StudentAPI from "../services/StudentAPI";
import { IActionResult } from "../interfaces/IActionResult";

export interface IStudentPdosCfoSchedule {
    pdos_schedule: string;
    formatted_pdos_schedule: string;
    pdos_schedule_time: string;
    cfo_schedule: string;
    formatted_cfo_schedule: string;
    cfo_schedule_time: string;
}

export interface IStudentPdosCfoScheduleState {
    isSuccess: boolean;
    isLoading: boolean;
    schedule: IStudentPdosCfoSchedule | undefined;
    error: undefined;
}

export const useStudentPdosCfoSchedule = defineStore({
    id: 'studentPdosCfoSchedule',
    state: () : IStudentPdosCfoScheduleState => ({
        isLoading: false,
        isSuccess: false,
        schedule: {} as IStudentPdosCfoSchedule,
        error: undefined
    }),
    getters: {

    },
    actions: {
    async loadStudentPdosCfoSchedule(): Promise<IActionResult<any>> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = await StudentAPI.getStudentPdosCfoScheduleDetails();
                this.schedule = response.data.data;

                this.isLoading = false;
                this.isSuccess = true;
                return { success: true, data: this.schedule };
            } catch (error: any) {
                this.error = error.response?.data?.message ?? 'Failed to load PDOS/CFO schedule';
                this.isSuccess = false;
                this.isLoading = false;
                return { success: false, message: error.response?.data?.message ?? 'Failed to load PDOS/CFO schedule', errors: error.response?.data?.errors ?? {} };
            }
        }
    }
})
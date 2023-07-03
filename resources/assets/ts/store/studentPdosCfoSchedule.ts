import { defineStore } from "pinia";
import StudentAPI from "../services/StudentAPI";

export interface IStudentPdosCfoSchedule {
    pdos_schedule: string;
    pdos_schedule_time: string;
    cfo_schedule: string;
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
        schedule: {
            pdos_schedule: '',
            pdos_schedule_time: '',
            cfo_schedule: '',
            cfo_schedule_time: ''
        },
        error: undefined
    }),
    getters: {

    },
    actions: {
        async loadStudentPdosCfoSchedule() {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = await StudentAPI.getStudentPdosCfoScheduleDetails();
                this.schedule = response.data.data;

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error : any) {
                this.error = error.response.data.message;
                this.isSuccess = false;
                this.isLoading = false;
            }
        }
    }
})
import { defineStore } from "pinia";
import StudentAPI from "../services/StudentAPI";

export interface IStudentTertiary {
    id?: string;
    school: string;
    address: string;
    degree: string | number;
    start_date: string;
    date_graduated: string;
    school_id: number | string;
}

export const useStudentTertiaryStore = defineStore({
    id: 'studentTertiary',
    state: () => ({
        isLoading: false,
        isSuccess: false,
        tertiary: {} as IStudentTertiary,
        errors: {} as any
    }),
    getters: {},
    actions: {

        async loadStudentTertiaryDetails() {

            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = await StudentAPI.getStudentTertiaryDetails();
                this.tertiary = response.data.data;

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        },

        async updateStudentTertiaryDetails(data: IStudentTertiary) {

            try {
                this.isLoading = true;
                this.isSuccess = false;

                await StudentAPI.updateTertiaryDetails(data);
                this.tertiary = {...data};

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        }
    }
})
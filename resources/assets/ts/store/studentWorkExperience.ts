import { defineStore } from "pinia";
import StudentAPI from "../services/StudentAPI";

export interface IStudentWorkExperience {
    id?: string | number;
    company: string;
    address: string;
    start_date: string;
    end_date: string;
    description: string;   
}

export const useStudentWorkExperienceStore = defineStore({
    id: 'studentWorkExperience',
    state: () => ({
      isLoading: false,
      isSuccess: false,
      experiences: [] as IStudentWorkExperience[],
      errors: {} as any
    }),
    getters: {},
    actions: {

        async loadWorkExperiences() {

            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = await StudentAPI.getStudentExperienceDetails();
                this.experiences = response.data.data;

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        },

        async storeWorkExperience(data: IStudentWorkExperience) {

            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = await StudentAPI.storeWorkExperience(data);
                this.experiences.unshift(response.data.data);

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        },

        async updateWorkExperience(data: IStudentWorkExperience) {

            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = await StudentAPI.updateWorkExperience(data);
                this.experiences.map((e) => {
                    if (data.id === e.id) {
                        e = response.data.data;
                    }
                });

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        },

        async deleteWorkExperience(data: IStudentWorkExperience) {

            try {
                this.isLoading = true;
                this.isSuccess = false;

                await StudentAPI.deleteWorkExperience(data.id);
                this.experiences = this.experiences.filter(e => e.id !== data.id);

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error : any) {
                this.isLoading = false;
                this.isSuccess = false;
            }
        }
    }
})
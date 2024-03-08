import SuperadminApi from "../services/SuperadminApi";
import { IBaseState } from "../interfaces/IBaseState";
import { IPagination } from "../interfaces/IPagination";
import { defineStore } from "pinia";

export interface ISuperadminSchool {
    id: string | number;
    name: string;
    display_name: string;
    description: string;
    created_at?: string;
}

export interface ISuperadminSchoolState extends IBaseState, IPagination {
    schools: ISuperadminSchool[];
}

export const useSuperadminSchoolStore = defineStore({
    id: 'superadminSchool',
    state: () : ISuperadminSchoolState => ({
        error: undefined,
        isLoading: false,
        isSuccess: false,
        links: [],
        schools: []
    }),
    actions : {
        async loadSuperadminSchools() {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = (await SuperadminApi.getAllSchools()).data;
                this.schools = response.data;

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error) {
                this.isLoading = false;
                this.isLoading = false;
            }
        },
        async storeSuperadminSchool(data : ISuperadminSchool) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.storeSchool(data);
                this.loadSuperadminSchools();

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error) {
                this.isLoading = false;
                this.isLoading = false;
            }
        },
        async updateSuperadminSchool(data : ISuperadminSchool, schoolId : string | number) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.updateSchool(data, schoolId);
                this.loadSuperadminSchools();

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error) {
                this.isLoading = false;
                this.isLoading = false;
            }
        },
        async deleteSuperadminSchool(schoolId : string | number) {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.deleteSchool(schoolId);
                this.loadSuperadminSchools();

                this.isLoading = false;
                this.isSuccess = true;
            } catch (error) {
                this.isLoading = false;
                this.isLoading = false;
            }
        }
    }
})
import SuperadminApi from "../services/SuperadminApi";
import { IBaseState } from "../interfaces/IBaseState";
import { IPagination } from "../interfaces/IPagination";
import { defineStore } from "pinia";
import { IActionResult } from "../interfaces/IActionResult";

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
    async loadSuperadminSchools(): Promise<IActionResult<ISuperadminSchool[]>> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = (await SuperadminApi.getAllSchools()).data;
                this.schools = response.data;

        this.isLoading = false;
        this.isSuccess = true;
        return { success: true, data: this.schools };
            } catch (error) {
        this.isLoading = false;
        this.isSuccess = false;
        return { success: false, message: error?.response?.data?.message ?? 'Failed to load schools', errors: error?.response?.data?.errors ?? {} };
            }
        },
    async storeSuperadminSchool(data : ISuperadminSchool): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.storeSchool(data);
        await this.loadSuperadminSchools();

        this.isLoading = false;
        this.isSuccess = true;
        return { success: true };
            } catch (error) {
        this.isLoading = false;
        this.isSuccess = false;
        return { success: false, message: error?.response?.data?.message ?? 'Failed to store school', errors: error?.response?.data?.errors ?? {} };
            }
        },
    async updateSuperadminSchool(data : ISuperadminSchool, schoolId : string | number): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.updateSchool(data, schoolId);
        await this.loadSuperadminSchools();

        this.isLoading = false;
        this.isSuccess = true;
        return { success: true };
            } catch (error) {
        this.isLoading = false;
        this.isSuccess = false;
        return { success: false, message: error?.response?.data?.message ?? 'Failed to update school', errors: error?.response?.data?.errors ?? {} };
            }
        },
    async deleteSuperadminSchool(schoolId : string | number): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.deleteSchool(schoolId);
        await this.loadSuperadminSchools();

        this.isLoading = false;
        this.isSuccess = true;
        return { success: true };
            } catch (error) {
        this.isLoading = false;
        this.isSuccess = false;
        return { success: false, message: error?.response?.data?.message ?? 'Failed to delete school', errors: error?.response?.data?.errors ?? {} };
            }
        }
    }
})
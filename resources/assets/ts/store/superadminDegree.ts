import { IBaseState } from "../interfaces/IBaseState";
import { IPagination } from "../interfaces/IPagination";
import SuperadminApi from "../services/SuperadminApi";
import { defineStore } from "pinia";
import { IActionResult } from "../interfaces/IActionResult";

export interface ISuperadminDegree {
    id: string | number;
    name: string;
    display_name: string;
    created_at?: string;
}

export interface ISuperadminDegreeState extends IBaseState, IPagination {
    degrees: ISuperadminDegree[]
}

export const useSuperadminDegreeStore = defineStore({
    id: "superadminDegree",
    state: () : ISuperadminDegreeState => ({
        error: undefined,
        isLoading: false,
        isSuccess: false,
        links: [],
        degrees: []
    }),
    actions: {
    async loadSuperadminDegrees(): Promise<IActionResult<ISuperadminDegree[]>> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = (await SuperadminApi.getAllDegrees()).data;
                this.degrees = response.data;

        this.isLoading = false;
        this.isSuccess = true;
        return { success: true, data: this.degrees };
            } catch (error) {
        this.isLoading = false;
        this.isSuccess = false;
        return { success: false, message: error?.response?.data?.message ?? 'Failed to load degrees', errors: error?.response?.data?.errors ?? {} };
            }
        },
    async storeSuperadminDegree(data : ISuperadminDegree): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                (await SuperadminApi.storeDegree(data));
        await this.loadSuperadminDegrees();

        this.isLoading = false;
        this.isSuccess = true;
        return { success: true };
            } catch (error) {
        this.isLoading = false;
        this.isSuccess = false;
        return { success: false, message: error?.response?.data?.message ?? 'Failed to store degree', errors: error?.response?.data?.errors ?? {} };
            }
        },
    async updateSuperadminDegree(data : ISuperadminDegree, degreeId : string | number): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                (await SuperadminApi.updateDegree(data, degreeId));
        await this.loadSuperadminDegrees();

        this.isLoading = false;
        this.isSuccess = true;
        return { success: true };
            } catch (error) {
        this.isLoading = false;
        this.isSuccess = false;
        return { success: false, message: error?.response?.data?.message ?? 'Failed to update degree', errors: error?.response?.data?.errors ?? {} };
            }
        },
    async deleteSuperadminDegree(degreeId : string | number): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                (await SuperadminApi.deleteDegree(degreeId));
        await this.loadSuperadminDegrees();

        this.isLoading = false;
        this.isSuccess = true;
        return { success: true };
            } catch (error) {
        this.isLoading = false;
        this.isSuccess = false;
        return { success: false, message: error?.response?.data?.message ?? 'Failed to delete degree', errors: error?.response?.data?.errors ?? {} };
            }
        }
    }
})
import SuperadminApi from "../services/SuperadminApi";
import { IBaseState } from "../interfaces/IBaseState";
import { IPagination } from "../interfaces/IPagination";
import { defineStore } from "pinia";
import { IActionResult } from "../interfaces/IActionResult";

export interface ISuperadminPrelimRequirement {
    id: string | number;
    name: string;
    description: string;
    path?: string;
    is_active: boolean;
    program_id: string;
    program?: string;
    created_at?: string;
}

export interface ISuperadminPrelimRequirementWithFile extends ISuperadminPrelimRequirement {
    file : File;
}

export interface ISuperadminPrelimRequirementState extends IBaseState, IPagination {
    prelims: ISuperadminPrelimRequirement[];
}

export const useSuperadminPrelimRequirementStore = defineStore({
    id: 'superadminPrelimRequirement',
    state: () : ISuperadminPrelimRequirementState => ({
        error: undefined,
        isLoading: false,
        isSuccess: false,
        prelims: [],
        links: []
    }),
    actions : {
    async loadSuperadminPrelimRequirements(): Promise<IActionResult<ISuperadminPrelimRequirement[]>> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = (await SuperadminApi.getAllPrelimRequirements()).data;
                this.prelims = response.data;
                this.links = response.meta.links;

                this.isLoading = false;
                this.isSuccess = true;
        return { success: true, data: this.prelims };
            } catch (error) {
                this.isLoading = false;
                this.isSuccess = false;
        return { success: false, message: error?.response?.data?.message ?? 'Failed to load prelim requirements', errors: error?.response?.data?.errors ?? {} };
            }
        },
    async storeSuperadminPrelimRequirement(data : ISuperadminPrelimRequirement): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.storePrelimRequirement(data);
                this.loadSuperadminPrelimRequirements();

                this.isLoading = false;
                this.isSuccess = true;
        return { success: true };
            } catch (error) {
                this.isLoading = false;
                this.isSuccess = false;
        return { success: false, message: error?.response?.data?.message ?? 'Failed to store prelim requirement', errors: error?.response?.data?.errors ?? {} };
            }
        },
    async updateSuperadminPrelimRequirement(data : ISuperadminPrelimRequirement, prelimId : string | number): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.updatePrelimRequire(data, prelimId);
                this.loadSuperadminPrelimRequirements();

                this.isLoading = false;
                this.isSuccess = true;
        return { success: true };
            } catch (error) {
                this.isLoading = false;
                this.isSuccess = false;
        return { success: false, message: error?.response?.data?.message ?? 'Failed to update prelim requirement', errors: error?.response?.data?.errors ?? {} };
            }
        },
    async deleteSuperadminPrelimRequirement(prelimId : string | number): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.deletePrelimRequirement(prelimId);
                this.loadSuperadminPrelimRequirements();

                this.isLoading = false;
                this.isSuccess = true;
        return { success: true };
            } catch (error) {
                this.isLoading = false;
                this.isSuccess = false;
        return { success: false, message: error?.response?.data?.message ?? 'Failed to delete prelim requirement', errors: error?.response?.data?.errors ?? {} };
            }
        },
    async uploadSuperadminPrelimRequirementFile(file: File, prelimId : string | number | undefined): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.uploadPrelimReqFile(file, prelimId);
                this.loadSuperadminPrelimRequirements();

                this.isLoading = false;
                this.isSuccess = true;
        return { success: true };
            } catch (error) {
                this.isLoading = false;
                this.isSuccess = false;
        return { success: false, message: error?.response?.data?.message ?? 'Failed to upload prelim file', errors: error?.response?.data?.errors ?? {} };
            }
        },
    async removeSuperadminPrelimRequirementFile(prelimId : string | number): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.removePrelimReqFile(prelimId);
                this.loadSuperadminPrelimRequirements();

                this.isLoading = false;
                this.isSuccess = true;
        return { success: true };
            } catch (error) {
                this.isLoading = false;
                this.isSuccess = false;
        return { success: false, message: error?.response?.data?.message ?? 'Failed to remove prelim file', errors: error?.response?.data?.errors ?? {} };
            }
        }
    }
})
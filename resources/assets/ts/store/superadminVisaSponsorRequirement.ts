import { defineStore } from "pinia";
import { IBaseState } from "../interfaces/IBaseState";
import { IPagination } from "../interfaces/IPagination";
import SuperadminApi from "../services/SuperadminApi";
import { IActionResult } from "../interfaces/IActionResult";

export interface ISuperadminVisaSponsorRequirement {
    id: string | number;
    name: string;
    description: string;
    path?: string;
    is_active: boolean;
    sponsor_id: string;
    sponsor?: string;
    created_at?: string;
}

export interface ISuperadminVisaSponsorRequirementState extends IBaseState, IPagination {
    sponsorReqs: ISuperadminVisaSponsorRequirement[]
}

export const useSuperadminVisaSponsorRequirementStore = defineStore({
    id: 'superadminVisaSponsorRequirement',
    state: () : ISuperadminVisaSponsorRequirementState => ({
        error: undefined,
        isLoading: false,
        isSuccess: false,
        links: [],
        sponsorReqs: []
    }),
    actions: {
    async loadSuperadminVisaSponsorRequriements(): Promise<IActionResult<ISuperadminVisaSponsorRequirement[]>> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                const response = (await SuperadminApi.getAllVisaSponsorRequirements()).data;
                this.sponsorReqs = response.data;
                this.links = response.meta.links;

                this.isLoading = false;
                this.isSuccess = true;
        return { success: true, data: this.sponsorReqs };
            } catch (error) {
                this.isLoading = false;
                this.isSuccess = false;
        return { success: false, message: error?.response?.data?.message ?? 'Failed to load visa sponsor requirements', errors: error?.response?.data?.errors ?? {} };
            }
        },
    async storeSuperadminVisaSponsorRequirement(data : ISuperadminVisaSponsorRequirement): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.storeVisaSponsorRequirement(data);
        await this.loadSuperadminVisaSponsorRequriements();

                this.isLoading = false;
                this.isSuccess = true;
        return { success: true };
            } catch (error) {
                this.isLoading = false;
                this.isSuccess = false;
        return { success: false, message: error?.response?.data?.message ?? 'Failed to store visa sponsor requirement', errors: error?.response?.data?.errors ?? {} };
            }
        },
    async updateSuperadminVisaSponsorRequirement(data : ISuperadminVisaSponsorRequirement, sponsorId : string | number): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.updateVisaSponsorRequirement(data, sponsorId);
        await this.loadSuperadminVisaSponsorRequriements();

                this.isLoading = false;
                this.isSuccess = true;
        return { success: true };
            } catch (error) {
                this.isLoading = false;
                this.isSuccess = false;
        return { success: false, message: error?.response?.data?.message ?? 'Failed to update visa sponsor requirement', errors: error?.response?.data?.errors ?? {} };
            }
        },
    async deleteSuperadminVisaSponsorRequriement(sponsorId : string | number): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.deleteVisaSponsorRequirement(sponsorId);
        await this.loadSuperadminVisaSponsorRequriements();

                this.isLoading = false;
                this.isSuccess = true;
        return { success: true };
            } catch (error) {
                this.isLoading = false;
                this.isSuccess = false;
        return { success: false, message: error?.response?.data?.message ?? 'Failed to delete visa sponsor requirement', errors: error?.response?.data?.errors ?? {} };
            }
        },
    async uploadSuperadminVisaSponsorRequirementFile(file: File, sponsorId : string | number | undefined): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.uploadVisaSponsorReqFile(file, sponsorId);
        await this.loadSuperadminVisaSponsorRequriements();

                this.isLoading = false;
                this.isSuccess = true;
        return { success: true };
            } catch (error) {
                this.isLoading = false;
                this.isSuccess = false;
        return { success: false, message: error?.response?.data?.message ?? 'Failed to upload visa sponsor file', errors: error?.response?.data?.errors ?? {} };
            }
        },
    async removeSuperadminVisaSponsorRequirementFile(sponsorId : string | number): Promise<IActionResult> {
            try {
                this.isLoading = true;
                this.isSuccess = false;

                await SuperadminApi.removeVisaSponsorReqFile(sponsorId);
        await this.loadSuperadminVisaSponsorRequriements();

                this.isLoading = false;
                this.isSuccess = true;
        return { success: true };
            } catch (error) {
                this.isLoading = false;
                this.isSuccess = false;
        return { success: false, message: error?.response?.data?.message ?? 'Failed to remove visa sponsor file', errors: error?.response?.data?.errors ?? {} };
            }
        }
    }
})